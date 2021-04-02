	<div class="container">
		<?php foreach ($fetchUser as $fu){ ?>
			
			<div class="row">
				<div class="col-sm-12 d-flex justify-content-center">
					<div class="header">
						<img class="img-radius bio" src="
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
						<div class="user-profile">
							@<?php echo $fu->link;?> 
						</div>
						
					</div>
					<div class="content-bio">
						<h5 class="bio"><?php echo $fu->bio;?> </h5>
							
							<div class="row">
								<?php foreach ($fetchLink as $fl){ ?>
									<div class="col-12 d-flex justify-content-center">
										<a href="<?php echo $fl->url?>" target="_new" class="btn btn-block btn-bio"><?php echo $fl->title?></a>
									</div>
								<?php } ?>
							</div>
					</div>

					<footer class="footer">
					<span class="copyright">MediaX.id</span>
					</footer>
				</div>

			</div>
		<?php } ?>
	</div>
