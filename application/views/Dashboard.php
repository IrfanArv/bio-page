
	<?php foreach ($fetchUser as $fu){ ?>
	<nav class="navbar navbar-expand-lg navbar-light bg-light">
		<a class="navbar-brand" href="<?php echo base_url() ?>"> <span class="copyright">MediaX.id</span> </a>
		<button id="menu" class="navbar-toggler" data-container="body" data-toggle="popover" data-html="true"  data-content="
		<a class='dropdown-item' href='#'>My Account</a>
		<a class='dropdown-item' href='#'>Help</a>
		<a class='dropdown-item' href='#'>Referensikan Teman</a>
		<hr class='menu'>
		<a class='dropdown-item' href='<?php echo base_url().'dashboard/logout'?>'>Logout</a>
		">
		<i class="fa fa-th-large"></i>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			<li class="nav-item">
				<a class="nav-link" href="#">My Account</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Help</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#">Referensikan Teman</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url().'dashboard/logout'?>">Logout</a>
			</li>

		</div>

	</nav>

	<div class="container-user-list">
		<div class="row">
			<div class="col">
			<a href="<?php echo base_url().$fu->link?>" target="_new"">
				<img class="img-radius usr-list" src="
				<?php
					if (empty($fu->picture) ){
						echo base_url('assets/users/blank.png');
					}elseif(empty($fu->last_name)){
						echo base_url('assets/users/' . $fu->picture);
					}else{
						echo $fu->picture;
					}
				?>
				">
			</a>
				<i class="fa fa-plus-circle add2 " aria-hidden="true"></i>
			</div>
		</div>
		<div class="row">
			<div class="col">
				
				<ul class="nav nav-pills mb-3" id="menu-tab" role="tablist">
					<li class="nav-item">
						<a class="nav-link active" id="pills-link-tab" data-toggle="pill" href="#pills-link" role="tab" aria-controls="pills-link" aria-selected="false">Link</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-tampilan-tab" data-toggle="pill" href="#pills-tampilan" role="tab" aria-controls="pills-tampilan" aria-selected="true">Tampilan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-analisa-tab" data-toggle="pill" href="#pills-analisa" role="tab" aria-controls="pills-analisa" aria-selected="false">Analisa</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" id="pills-more-tab" data-toggle="pill" href="#pills-more" role="tab" aria-controls="pills-more" aria-selected="false">More</a>
					</li>
				</ul>
				<div class="tab-content" id="menu-tabContent">
					<div class="tab-pane fade active show" id="pills-link" role="tabpanel" aria-labelledby="pills-link-tab">
						
						<button type="button" href="javascript:void(0)" class="btn btn-default">Tambahkan Link Baru</button>

						<div class="content-dashboard" id="content_card">

                            

							
                        </div>

					</div>
					<div class="tab-pane fade" id="pills-tampilan" role="tabpanel" aria-labelledby="pills-tampilan-tab">
						<p class="mb-0">Content tampilan
						</p>
					</div>
					<div class="tab-pane fade" id="pills-analisa" role="tabpanel" aria-labelledby="pills-analisa-tab">
						<p class="mb-0">Content analisa
						</p>
					</div>
					<div class="tab-pane fade" id="pills-more" role="tabpanel" aria-labelledby="pills-more-tab">
						<p class="mb-0">content more</p>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>
	<?php }?>

	<script>
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
	
