<?php include_once('functions.php')		 ?>
		<div class="row  cpost">
			<div class="col-md-12 col-sm-12 col-xs-12" style="">
				<div class="combunity-forum-table-row-background ">
					<div class="row row-eq-height combunity-forum-table-row combunity-forum-post-single-row">
						<div class="col-md-10 col-sm-10 col-xs-12 combunity-forum-post-row-column combunity-forum-post-row-post-title-container">
							<div class="combunity-row">
								<?php 
									include('cpost/user-profile-section.php');
								?>
								<div class="combunity-col combunity-forum-post-info-container">
									<?php
										// var_dump( Combunity_Api() );
										include('cpost/title.php');
									?>
									<div class="combunity-row">
										<div class="combunity-col">
											<?php 
											//get_template_part('template-parts/cpost/belowtitle', ''); 
											include('cpost/belowtitle.php');
											?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-2 col-sm-2  hidden-xs combunity-forum-post-row-column text-center combunity-post-metas">
							<div>
								<div class="combunity-forum-post-icon-block hidden-sm combunity-forum-icon-color"><span class="combunity-post-metas-digits"><?php	echo Co_the_fp_meta( "combunity_post_views", 0 ) ?></span><div class="combunity-post-metas-block-text"><?php echo __('views') ?></div> </div>
								<div class="combunity-forum-post-icon-block combunity-forum-icon-color"><span class="combunity-post-metas-digits"><?php echo get_comments_number(); ?></span><div class="combunity-post-metas-block-text"><?php echo __('replies') ?></div> </div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>