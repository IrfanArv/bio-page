<?php 
$user_data = $this->session->userdata('user_data');
$id = $this->session->userdata('id');
?>
<div class="container">

<!-- Setup Account -->
	<form id="submit" enctype="multipart/form-data">
		<div class="row">
			<!-- Update Profile -->
			<div class="col-sm-12 d-flex justify-content-center wow fadeInRight animated" id="create-profile">
				<div class="header">
					<h3 class="text-left">Buat Profile Link Anda</h3>
				</div>

				
				<div class="content-profile">

					<div class="form-group">
						<label class="label">Nama Link</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text"><?php echo base_url()?></span>
							</div>
							<input type="text" name="link" id="link" value="<?php echo $user_data["first_name"];?>" class="form-control">
							<span id="link_result"></span>
						</div>
					</div>

					<div class="form-group">
						<label class="label-ava">Avatar</label>
					</div>

					<div class="form-group">
						<div class="row">

							<div class="col-4">
								<img class="img-radius avatar" src="
								<?php
									if (empty($user_data["picture"]) ){
										echo base_url('assets/users/blank.png');
									}elseif(empty($user_data["last_name"])){
										echo base_url('assets/users/' . $user_data['picture']);
									}else{
										echo $user_data['picture'];
									}
								?>
								" id="modal-preview">
							</div>

							<div class="col-8 align-self-center">
								<div class="upload-btn-wrapper">
									<button class="btn btn-upload">Upload Avatar Saya</button>
									<input type="hidden" name="cover" value="
									<?php
										if(empty($user_data["last_name"])){
											echo base_url('assets/users/' . $user_data['picture']);
										}else{
											echo $user_data["picture"];
										}
									?>
									">
									<input id="image" type="file" name="image" accept="image/*" onchange="readURL(this);">
								</div>
							</div>

						</div>
					</div>

					<div class="form-group">
						<label class="label" id="counter"></label>
						<textarea class="form-control" name="bio" id="bio" data-status-message="#counter" rows="2"></textarea>
					</div>

					<label class="label">Pilih layout profile Anda</label>
					<div class="theme-choose">
						<i class="fa fa-check-circle"></i>
					</div>

					<div class="row">
						<div class="col-6">

							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-center">
										<div class="profile">
											<img class="img-radius phone" src="<?php echo base_url('assets/users/blank.png'); ?>">
											<hr class="profile-phone">
										</div>
										<div class="profile-list">
											<ul class="list-group">
												<li class="list-group-item"></li>
												<li class="list-group-item"></li>
												<li class="list-group-item"></li>
											</ul>	
										</div>
										
									</div>
								</div>
								<div class="card-footer">
									<span class="copyright-phone">MediaX.id</span>
								</div>
							</div>

						</div>

						<div class="col-6">
							
								<div class="card pro">
								
									<div class="card-body">
										<div class="d-flex justify-content-center">
											<div class="profile">
												<img class="img-fluid album" src="<?php echo base_url('assets/users/album.png'); ?>">
												
											</div>
											<div class="profile-list">
												<ul class="list-group">
													<li class="list-group-item list-pro"></li>
													<li class="list-group-item list-pro"></li>
													<li class="list-group-item list-pro"></li>
												</ul>	
											</div>
											
										</div>
									</div>
									<div class="card-footer-pro">
										<span class="text-muted ">  </span>
									</div>
								</div>
								<div id="lock">
									<div class="lock-icon">
									<i class="fa fa-lock"></i>
									<span class="lock">
										PRO
									</span>
									</div>
								</div>
						</div>

					</div>

					<div class="row mt-5 mb-5">
						<div class="col-12 d-flex justify-content-center">
							<button type="submit" class="btn btn-default">Masukkan Link</button>
						</div>
					</div>	

				</div>
			</div>
			<!-- Update Profile -->
			<!-- Blank Page -->
			<div class="col-sm-12 d-flex justify-content-center wow fadeInRight animated" style="display:none !important;" id="blank_link">
				<div class="header">
					<button type="submit" id="btn-add-link" class="btn btn-default">Tambahkan Link Baru</button>
				</div>
					<div class="blank">
					Anda belum memiliki 
					link apa pun untuk ditampilkan<br><br> 
					Klik tombol di atas 
					untuk menambahkannya.<br><br>
					atau <br><br>
					Anda bisa memasukkannya nanti
					dengan mengklik tombol di bawah <br><br><br>
					<a href="<?php echo base_url() ?>">saya akan masukkan link nanti</a>
					
					</div>
				</div>
			</div>
			<!-- Blank Page -->
		</div>
	</form>
<!-- Setup Account -->
<!-- Add Link Page  -->
	<!-- Addlink -->
	<div class="col-sm-12 d-flex justify-content-center wow fadeInRight animated" style="display:none !important;" id="add_link">
		
		<form id="input_new_link">
			<div class="header">
				<input type="hidden" name="id" id="id" value="<?php echo $id;?>">
				<button type="submit" class="btn btn-default">Masukkan Link</button>
			</div>
		</form>
			<div class="content" id="content_card">
			</div>

			<footer class="footer-add">
				<div class="container">
				<button type="button" id="selesai_setup" class="btn btn-default done">Selesai</button>
				</div>
			</footer>

		</div>
	</div>
	<!-- Addink -->
	<!-- Done Setup -->
	<div class="col-sm-12 d-flex justify-content-center wow fadeInRight animated" style="display:none !important;" id="done_setup">
        <div class="header">
            <h5 class="success">
            SELAMAT <br> <small> anda telah memiliki bio page pertama anda</small></h5>
            <button type="submit" target="_new" onclick="getBio('<?php echo $id?>')" class="btn btn-default tinjau">Tinjau Halaman Bio Page Saya</button>
        </div>
        <div class="benefit">
            benefit anda:
            <br>a
            <br>b
            <br>c
            <br>d
            <br>e
        </div>
        <footer class="footer-add"> 
            <a href="<?php echo base_url() ?>" class="btn btn-default done">Dashboard</a>
        </footer>
    </div>
	<!-- Done Setup -->
<!-- Add Link Page  -->
</div>
<script src="<?php echo base_url(); ?>assets/js/limitText.js"></script>
<script>
	// setupAccount
			$("#submit").on('click', "#btn-add-link", function() {
				$("#add_link").show();
				$('#create-profile').html('').hide();
				$('#blank_link').html('').show();
			});

			$("#add_link").on('click', "#selesai_setup", function() {
				$("#done_setup").show();
				$('#add_link').html('').hide();
				$('#create-profile').html('').hide();
				$('#blank_link').html('').hide();
				
			});

			// hide show function
			$('#bio').limitText();
			$('#link').change(function(){
			var username = $('#link').val();
			var link = username.toLowerCase().replace(/ /g, '-') 
				.replace(/[^\w-]+/g, ''); 
			var username = $('#link').val(link);
			if(link != ''){
				$.ajax({
				url: "<?php echo base_url(); ?>Dashboard/checkURL",
				method: "POST",
				data: {link:link},
				success: function(data){
				$('#link_result').html(data);
				}
				});
			}
			});
			$('#submit').submit(function(e){
            e.preventDefault(); 
                 $.ajax({
                     url:'<?php echo base_url();?>Dashboard/SetupProfile',
                     type:"post",
                     data:new FormData(this),
                     processData:false,
                     contentType:false,
                     cache:false,
                     async:false,
                      success: function(data){
						$('#create-profile').html('').hide();
						
						$('#blank_link').show();
                   }
                 });
			});
	
		 
	function readURL(input, id) {
		id = id || '#modal-preview';
		if (input.files) {
			var reader = new FileReader();
			reader.onload = function(e) {
				$(id).attr('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
			$('#modal-preview').removeClass('hidden');
			$('#start').hide();
		}
	}
	// setupAccount

	// add url page
	
	
	$('#input_new_link').submit(function(e){
        e.preventDefault(); 
            $.ajax({
                url:'<?php echo base_url();?>Dashboard/AddPage',
                type:"POST",
                data:new FormData(this),
                processData:false,
                contentType:false,
                cache:false,
                async:false,
                success: function(data){

					$('#add_link').show();
                    $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
            	}
            });
	});
	
	function titleUrl(id)
    {
        var title = $('input[name="title"]').val();
        $.ajax({
            url:"<?php echo site_url('Dashboard/titleUrl')?>/"+ id,
            method:"POST",
            data: {title:title},
            success:function(data){
                $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
                }
            });
    }

    function LinkUrl(id)
    {
        var url_link = $('input[name="url_link"]').val();
        $.ajax({
            url:"<?php echo site_url('Dashboard/LinkUrl')?>/"+ id,
            method:"POST",
            data: {url_link:url_link},
            success:function(data){
                $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
                }
            });
    }

    function statusURL(id)
    { 
        var status = $('input[name="status"]').is(':checked') ? 1 : 0;
        $.ajax({
            url:"<?php echo site_url('Dashboard/StatusURL')?>/"+ id,
            method:"POST",
            data: {status:status},
            success:function(data){
                $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
                }
            });
        
    }

    function removeURL(id)
    {
        $.ajax({
            url:"<?php echo site_url('Dashboard/removeURL')?>/"+ id,
            method:"POST",
            dataType: "JSON",
            success:function(data){
                $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
                }
                
            });
    }

    function changeIcon(id) {

        var form = $('#icon')[0];
        var data = new FormData(form);
        $.ajax({
            url:"<?php echo site_url('Dashboard/changeIcon')?>/"+ id,
            method:"POST",
            enctype: 'multipart/form-data',
            processData: false,  // Important!
            contentType: false,
            cache: false,
            
            success:function(data){
                $( "#content_card" ).load( "<?php echo base_url('Dashboard/LinkList')?>" );
                }
            });

	}

	function getBio(id)
    {
        $.ajax({
            url:"<?php echo site_url('Dashboard/getBio')?>/"+ id,
            method:"POST",
            success:function(data){
                    window.location.href = data.redirect;
                }
            });
    }
	// add url page
	$(document).ready(function () {
		$.ajax({
			url:"<?php echo base_url();?>Dashboard/LinkList/",
			method:"POST", 
			success:function(data){
				$('#content_card').html(data);
				}
		});
	});
	
		
</script>