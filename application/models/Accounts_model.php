<?php

class Accounts_model extends CI_Model {

    function __construct() {
        parent :: __construct();

    }

// Manual login
    function login_customers($username, $password) {
        $remember = $this->input->post('remember');
        $this->db->select('email,password,id,type_account,first_name,last_name,picture,oauth_uid');
        $this->db->where('email', $username);
        $this->db->where('password', sha1($password));
        $q = $this->db->get('account');
        $user = $q->result();
        $num = $q->num_rows();
        if ($num > 0) {
            if (empty ($remember)) {
                $this->session->sess_expire_on_close = TRUE;
            } 

            $user_data = array(
                'oauth_uid' => $user[0]->oauth_uid,
                'role' => $user[0]->type_account,
                'picture'=> $user[0]->picture,
                'first_name' => $user[0]->first_name,
                'last_name'  => $user[0]->last_name,
				'email' => $user[0]->email,
                );
                $this->session->set_userdata('access_token', $user[0]->oauth_uid);
                $this->session->set_userdata('id', $user[0]->oauth_uid);
                $this->session->set_userdata('user_data', $user_data);
            return true;
        }
        else {
            return false;
        }
    }
// Google Login
    function google_already($id)
    {
        $this->db->where('oauth_uid', $id);
        $query = $this->db->get('account');
        if($query->num_rows() > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }



    function update_google_user($data, $id)
    {
        $this->db->where('oauth_uid', $id);
        $this->db->update('account', $data);
    }

    function insert_google_user($data)
    {
        $this->db->insert('account', $data);
    }

// Facebook Login

        public function insert_fb_user($data)
        {
            $this->db->insert('account', $data);

            return $this->db->insert_id();
        }

        public function fb_already($email, $uid)
        {
            $check = $this->db
                ->where(array('email' => $email, 'oauth_provider' => 'facebook', 'oauth_uid' => $uid))
                ->get('account');
            return ($check->num_rows() > 0) ? TRUE : FALSE;
        }

        function update_fb_data($data, $id)
        {
            $this->db->where('oauth_uid', $id);
            $this->db->update('account', $data);
        }

        public function get_facebook_user_data($uid)
        {
            $data = $this->db
                ->where(array('oauth_provider' => 'facebook', 'oauth_uid' => $uid))
                ->get('account');
            return $data->row();
        }

        public function signup_customer($data)
        {
            $this->db->insert('account', $data);
            return $this->db->insert_id();
        }

// check url
        public function getLink($link)
        {
            $this->db->where('link' , $link);
            $query = $this->db->get('account');

            if($query->num_rows()>0){
            return true;
            }
            else {
            return false;
            }
        }

// check url session
    public function checkLink($id)
    {
        $this->db->where('oauth_uid',$id);
        $this->db->where('link', NULL);
        $query = $this->db->get('account');
        if($query->num_rows()>0){
        return true;
        }
        else {
        return false;
        }
    }

// Update Profile
    function UpdateProfile($id,$link,$bio,$image){
        $this->db->where('oauth_uid', $id);
        $data = array(
                'link' => $link,
                'bio' => $bio,
                'picture' => $image
            );  
        $result= $this->db->update('account',$data);
        return $result;
    }

    function UpdateProfileNoImage($id,$link,$bio){
        $this->db->where('oauth_uid', $id);
        $data = array(
                'link' => $link,
                'bio' => $bio
            );  
        $result= $this->db->update('account',$data);
        return $result;
    }

// Bio Page
    public function addLink($data)
    {
        $this->db->insert('page', $data);
        return $this->db->insert_id();
    }
       

}


