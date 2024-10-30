<div class="combunity-standalone-bar">
	<div class="container combunity-standalone-bar-color">
		<div class="row">
			<div class="combunity-standalone-bar-body">
				<div class="col-xs-7">
					<a href="">
						<?php 
							$bloginfo = get_bloginfo('name');
							echo $bloginfo;
						?>
					</a>
				</div>
				<div class="col-xs-5 combunity-account-info">
					<?php if ( is_user_logged_in() ) { ?>
						<a noblank="true" href="<?php echo Combunity_Api()->get_user_link(get_current_user_id()) ?>"><?php echo __('Welcome, ', 'combunity') ?><u><?php 
							global $current_user;
							echo $current_user->user_login;
						?></u></a>
						<a href="<?php echo Combunity_Api()->getipagelink('logout'); ?>" class="combunity-logout-link" noblank="true">[Logout]</a>
					<?php } else { 
							$ipagelink = Combunity_Api()->getipagelink('login');
						?>
						<a href="<?php echo $ipagelink ?>" noblank="true"><?php echo __('Login', 'combunity') ?></a>
					<?php } ?>
				</div>
			</div>
		</div>	

	</div>
</div>
<div class="container">
	<div class="row combunity-breadcrumb-block">
		<div class="col-xs-6">
			<a target="_blank" href="<?php echo get_permalink( get_option( 'combunity_frontpage' )  ) ?>"><?php echo __('All Forums', 'combunity') ?></a>
			
			<?php
				$cats = Combunity_Api()->get_thread_categories( get_the_ID() );
				if ( sizeof( $cats ) > 0 ){
					$link  = get_term_link( $cats[0]->term_id );
					
					?>
					 > <a href="<?php echo $link ?>" target="_blank"><?php echo  $cats[0]->name  ?></a>
					<?php
				}
			?>
			 > <a href="<?php the_permalink() ?>" target="_blank"><?php echo ucfirst( get_the_title() ) ?></a>
		</div>
		<div class="col-xs-6">
			
		</div>
	</div>
</div>