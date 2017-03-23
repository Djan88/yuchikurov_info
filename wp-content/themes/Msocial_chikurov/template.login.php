<?php
/*
Template Name: Login Page
*/

global $tpl;

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody" class="loginpage">
	<?php the_post(); ?>
	
	<h1 class="page-title"><?php the_title(); ?></h1>
	
	<article>
		<section class="intro">
			<?php the_content(); ?>
		</section>
		
		<?php if ( is_user_logged_in() ) : ?>
			<?php 
				
				global $current_user;
				get_currentuserinfo();
			
			?>
			
			<p>
				<?php echo __('Привет, ', GKTPLNAME) . ($current_user->user_firstname) . ' ' . ($current_user->user_lastname) . ' (' . ($current_user->user_login) . ') '; ?>
				 <a href="<?php echo wp_logout_url(); ?>" title="<?php _e('Logout', GKTPLNAME); ?>">
					 <?php _e('Выйти', GKTPLNAME); ?>
				 </a>
			</p>
		
		<?php else : ?>
		    
			<?php 
				wp_login_form(
					array(
						'echo' => true,
						'form_id' => 'loginform',
						'label_username' => __( 'Логин', GKTPLNAME ),
						'label_password' => __( 'Пароль', GKTPLNAME ),
						'label_remember' => __( 'Запомнить', GKTPLNAME ),
						'label_log_in' => __( 'Войти', GKTPLNAME ),
						'id_username' => 'user_login',
						'id_password' => 'user_pass',
						'id_remember' => 'rememberme',
						'id_submit' => 'wp-submit',
						'remember' => true,
						'value_username' => NULL,
						'value_remember' => false 
					)
				); 
			?>
			
			<nav class="small">
				<ul>
					<li>
						<a href="<?php echo home_url(); ?>/wp-login.php?action=lostpassword" title="<?php _e('Password Lost and Found', GKTPLNAME); ?>"><?php _e('Lost your password?', GKTPLNAME); ?></a>
					</li>
					<li>
						<a href="<?php echo home_url(); ?>/wp-login.php?action=register" title="<?php _e('Not a member? Register', GKTPLNAME); ?>"><?php _e('Зарегестрироваться', GKTPLNAME); ?></a>
					</li>
				</ul>
			</nav>
		
		<?php endif; ?>
	
	</article>
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF