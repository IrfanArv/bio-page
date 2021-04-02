<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	
	function __construct()
	{
		parent::__construct();
		
	}

	public function index()
	{
		if ($this->session->userdata('access_token','user_data')) {
			$id = $this->session->userdata('id');
			if(empty($this->Accounts_model->checkLink($id))){
				 	$this->Pages_model->UrlMatch($id);
					$url = $this->Pages_model->getUsername($id);
					$this->data['fetchUser'] = $this->Pages_model->getUserBio($url);
					$this->data['fetchLink'] = $this->Pages_model->getBio($url);
					$this->data['pagetitle'] = 'Dashboard';
					$this->layouts->display('Dashboard', $this->data);
			   }
			   else {
				$this->data['pagetitle'] = 'Welcome';
				$this->layouts->display('SetupAccount', $this->data);
			   }

		}else{
			$this->data['pagetitle'] = 'Bio Page Login';
			$this->data['logintitle'] = 'Hallo';
			$this->data['registitle'] = 'Yuk...';
			$this->data['logingretting'] = 'Senang bertemu dengan Anda kembali.';
			$this->data['regisgretting'] = 'mulai dengan yang GRATIS!!';
			$client = new Google_Client();
			$client->setClientId('365778050065-3243rvuat8ulkmooincjr4a307i1h636.apps.googleusercontent.com'); 
			$client->setClientSecret('9VulPLT3f9Q0tXGDI9rB9n_r'); 
			$client->setRedirectUri('https://webly.id/bio-page/dashboard');
			// $client->setRedirectUri('http://localhost/bio-page/dashboard');
			$client->addScope('email');
			$client->addScope('profile');

			if(isset($_GET["code"])){
				$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);
				if(!isset($token["error"]))
				{
					$client->setAccessToken($token['access_token']);
					$this->session->set_userdata('access_token', $token['access_token']);
					$google_service = new Google_Service_Oauth2($client);					
					$data = $google_service->userinfo->get();
					$current_datetime = date('Y-m-d H:i:s');
					if($this->Accounts_model->google_already($data['id']))
					{
						$user_data = array(
						'first_name' => $data['given_name'],
						'last_name'  => $data['family_name'],
						'email' => $data['email'],
						'picture'=> $data['picture'],
						'modified' => $current_datetime
						);
						$this->Accounts_model->update_google_user($user_data, $data['id']);
					}
					else
					{
						$user_data = array(
						'oauth_provider' => ('google'),
						'oauth_uid' => $data['id'],
						'first_name'  => $data['given_name'],
						'last_name'   => $data['family_name'],
						'email'  => $data['email'],
						'picture' => $data['picture'],
						'created'  => $current_datetime
						);
						$this->Accounts_model->insert_google_user($user_data);
					}
					$this->session->set_userdata('user_data', $user_data);
					$this->session->set_userdata('id', $data['id']);
					
				}
				redirect('dashboard/');
			}

			$this->data['loginGoogle'] = $client->createAuthUrl();
			$redtolog = site_url('Dashboard/login_facebook');
			$this->data['LoginFB'] = $this->facebook->create_auth_url($redtolog);
			$this->layouts->display('Login', $this->data);

		}
	}

	// Setup profile
	public function SetupProfile(){

		$config['upload_path'] = './assets/users/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
		$config['max_size'] = 8000;
	    $config['encrypt_name'] = TRUE;

	    $this->upload->initialize($config);

	    if(!empty($_FILES['image']['name'])){
	        if ($this->upload->do_upload('image')){
				$img = $this->upload->data();
				
				$id		= $this->session->userdata('id');
				$image	= $img['file_name'];
				$link	= $this->input->post('link',TRUE);
				$bio	= $this->input->post('bio',TRUE);
				// $cover	= $this->input->post('cover',TRUE);

                // $path='./assets/users/'.$cover;
				// unlink($path);
				

				$result=$this->Accounts_model->UpdateProfile($id,$link,$bio,$image);
            	echo json_decode($result); 
			}else{
				echo json_encode('STATUS'); 
	        }

	    	}else{
				$id		= $this->session->userdata('id');
				$link	= $this->input->post('link',TRUE);
				$bio	= $this->input->post('bio',TRUE);
				$result=$this->Accounts_model->UpdateProfileNoImage($id,$link,$bio);
            	echo json_decode($result);
			}

	}

	public function AddPage(){
        $data = [
            'account_id' => $this->input->post('id', TRUE)
        ];
        $result = $this->Accounts_model->addLink($data);
        echo json_encode($result);
	}

	public function LinkList(){
		$id = $this->session->userdata('id');
		$linkmember = $this->Pages_model->get_page_member($id);
		$output  = '';
			foreach ($linkmember as $lm) {
				$output .='
					<div class="card add-link">
						<div class="card-body">
							<div class="row link-item">
								<div class="col-3">
									<img class="img-fluid icon-link" src="'.base_url().'/assets/users/album.png" >
										<div class="upload-btn-wrapper-add">
											<button class="btn btn-upload-add" ><i class="fa fa-plus-circle" id="icon-btn"></i></button>
											<input  type="file" id="icon" name="image">
										</div>
								</div>
								<div class="col-7 ">
									';
									if($lm->title == NULL){
										$output .='<div class="title"><input type="text" name="title"  onchange="titleUrl('.$lm->id.')" value="'.$lm->title.'" placeholder="Enter title" class="form-control-url " ></div>';
									}else{
										$output .='<div class="title">'.$lm->title.'</div>';
									}
									if($lm->url == NULL){
										$output .='<div class="url-link"><input type="text" name="url_link" onchange="LinkUrl('.$lm->id.')" placeholder="http://url" value="'.$lm->url.'" class="form-control-url"></div>';
									}else{
										$output .='<div class="url-link">'.$lm->url.'</div>';
									}
									$output .='
								</div>
								<div class="col-2">
								<div class="form-group">
									<div class="switch switch-primary d-inline m-r-10">
										<input type="checkbox" onclick="statusURL('.$lm->id.')"  name="status[]" value="'.$lm->status.'" id="switch-p-1" ';
										if($lm->status == 1){
											$output .='checked= "" ';
										}else{
											$output .='';
										}
										$output .='
										>
										<label for="switch-p-1" class="cr"></label>
									</div>
								</div>
									<a onclick="removeURL('.$lm->id.')" class="btn btn-remove"><i class="fa fa-trash"></i></a>
									
								</div>
							</div>
						</div>
					</div>
				';
			}
		echo $output;
	}

	public function titleUrl($id){
        $data = [
            'title' => $this->input->post('title', TRUE),
        ];
		$result = $this->Pages_model->updateLink($id, $data );
		echo json_encode($result);
	}

	public function LinkUrl($id){
        $data = [
            'url' => $this->input->post('url_link', TRUE),
        ];
		$result = $this->Pages_model->updateLink($id, $data );
		echo json_encode($result);
	}

	public function statusURL($id){
        $data = [
            'status' => $this->input->post('status', TRUE),
        ];
		$result = $this->Pages_model->updateLink($id, $data );
		echo json_encode($result);
	}

	public function removeURL($id)
    {
        $result = $this->Pages_model->deleteURL($id);
        echo json_encode($result);
	}
	
	public function changeIcon($id){

		$config['upload_path'] = './assets/icons/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
	    $config['encrypt_name'] = TRUE;

	    $this->upload->initialize($config);

	    if(!empty($_FILES['image']['name'])){
	        if ($this->upload->do_upload('image')){
				$img = $this->upload->data();
				
				$image	= $img['file_name'];
				
				$data = [
					'icon' => $image,
				];
				$result = $this->Pages_model->updateLink($id, $data );
				echo json_encode($result);
			}else{
				echo json_encode('STATUS'); 
	        }

	    }
	}

	// check url is availabe
	public function checkURL(){
		if($this->Accounts_model->getLink($_POST['link'])){
		echo '<label class="text-danger"><span><i class="fa fa-times" aria-hidden="true">
		</i> Link sudah digunakan</span></label>';
		}
		else {
		echo '<label class="text-success"><span><i class="fa fa-check" aria-hidden="true"></i> Link Tersedia</span></label>';
		}
	}

	public function getBio($id){
		if($this->Pages_model->UrlMatch($id)){
			$url = $this->Pages_model->getUsername($id);
			redirect('/'.$url);
		}
		else {
			echo json_encode('false'); 
		}
	}

	// login regist function
	public function login() {

        $username = $this->input->post('email');
        $password = $this->input->post('password');
        if ($this->input->is_ajax_request()) {

            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() == FALSE) {

                $result = array("status" => false, "msg" => validation_errors(), "url" => "");
            } else {

                $login = $this->Accounts_model->login_customers($username, $password);
                if ($login) {
                    $prevurl = $this->session->userdata('prevURL');
                    if (!empty($prevurl)) {
                        $url = $prevurl;
                    } else {
                        $url = base_url() . 'dashboard';
                    }

                    $result = array("status" => true, "msg" => "", "url" => $url);
                } else {
                    $result = array("status" => false, "msg" => "Opss.. Invalid Login Credentials", "url" => "");

                }

            }
            echo json_encode($result);

        }
	}

	public function login_facebook()
    {
        $code = $this->input->get('code');
        if ($code){
            try{
			$helper = $this->facebook->create_helper();
			$access_token = $this->facebook->get_access_token();
			$this->facebook->set_access_token($access_token);
            } catch (Facebook\Exceptions\FacebookResponseException $e) {
                exit('Graph returned an error: ' . $e->getMessage());
            } catch (Facebook\Exceptions\FacebookSDKException $e) {
                exit('Facebook SDK returned an error: ' . $e->getMessage());
            }
            if (!isset($access_token)) {
                if ($helper->getError()){
                    header('HTTP/1.0 401 Unauthorized');
                    echo "Error: " . $helper->getError() . "\n";
                    echo "Error Code: " . $helper->getErrorCode() . "\n";
                    echo "Error Reason: " . $helper->getErrorReason() . "\n";
                    echo "Error Description: " . $helper->getErrorDescription() . "\n";
                }else{
                    header('HTTP/1.0 400 Bad Request');
                    echo 'Bad request';
                }
                exit;
			}
			$current_datetime = date('Y-m-d H:i:s');
            $user = $this->facebook->get_user();
            $uid = $user['id'];
            $email = $user['email'];
			$name = $user['name'];
			$picture = $user['picture'];
			

            if ($this->Accounts_model->fb_already($email, $uid)){
				$data = array('is_login' => TRUE, 'uid' => $uid);
				$picture_name = strtolower($name);
                $picture_name = str_replace(' ', '-', $picture_name);
                $ch = curl_init($picture['url']);
                $fp = fopen('./assets/users/' . $picture_name .'.jpeg', 'wb');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                fclose($fp);
                $user_data = [
                    'email' => $email,
                    'first_name' => $name,
					'picture' => $picture_name .'.jpeg',
					'modified' => $current_datetime
                ];
				$this->Accounts_model->update_fb_data($user_data, $uid );
				$this->session->set_userdata('user_data', $user_data);
				$this->session->set_userdata('access_token', $access_token);
				$this->session->set_userdata('id', $user['id']);
                redirect('dashboard/');
            }else{
				$picture_name = strtolower($name);
                $picture_name = str_replace(' ', '-', $picture_name);
                $ch = curl_init($picture['url']);
                $fp = fopen('./assets/users/' . $picture_name .'.jpeg', 'wb');
                    curl_setopt($ch, CURLOPT_FILE, $fp);
                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_exec($ch);
                    curl_close($ch);
                fclose($fp);
                $user_data = [
                    'oauth_provider' => 'facebook',
                    'oauth_uid' => $uid,
                    'email' => $email,
                    'first_name' => $name,
					'picture' => $picture_name .'.jpeg',
					'created'  => $current_datetime
                ];
                $this->Accounts_model->insert_fb_user($user_data);
                $data = array('is_login' => TRUE, 'uid' => $uid);
                $this->session->set_userdata('user_data', $user_data);
				$this->session->set_userdata('access_token', $access_token);
				$this->session->set_userdata('id', $user['id']);
                redirect('dashboard');
            }
        }else{
        	show_404();
        }
	}

	public function signup()
	{
		$_acak = substr(sha1(time()), 0, 16);
		if ($this->input->is_ajax_request()) {		
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[account.email]', array('required' => 'Email Required', 'is_unique' => 'Email already registered','valid_email' => 'Invalid Email'));
			$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]|max_length[20]',array('required' => 'Password Required'));
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'required|matches[password]|min_length[8]|max_length[20]',array('required' => 'Confirm Password Required','matches' => 'Password doesnt macth',));

			if ($this->form_validation->run() == FALSE){
				$result = array("status" => false, "msg" => validation_errors(), "url" => "");
			}else{
				$email = $this->input->post('email');
				$password = $this->input->post('password');
				$data = array(
					'oauth_provider' => (''),
					'oauth_uid' =>$_acak,
					'email' => $email,
					'password' => sha1($password),
					
				);
                $login = $this->Accounts_model->signup_customer($data);
                if ($login) {
                    $prevurl = $this->session->userdata('prevURL');
                    if (!empty($prevurl)) {
                        $url = $prevurl;
                    } else {
                        $url = base_url();
                    }
                    $result = array("status" => true, "msg" => "", "url" => $url);
                } else {
					$result = array("status" => false, "msg" => validation_errors(), "url" => "");
                }
			}
			echo json_encode($result);
		}

	}

	public function logout()
	{
	 $this->session->unset_userdata('access_token');
	 $this->session->unset_userdata('user_data');
	 redirect('/');
	}


	
}
