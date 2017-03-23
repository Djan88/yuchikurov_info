<?php
/*
Template Name: FAQ
*/

global $tpl;

gk_load('header');
gk_load('before');

global $more;
$more = 0;

if(isset($_POST['user_submit'])){
    //create_new_user();
}

// get the page number
$paged = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);

query_posts('posts_per_page=' . get_option('posts_per_page') . '&paged=' . $paged . '&orderby=ID' );

?>

<?php if ( have_posts() ) : ?>
	<section id="gk-mainbody">
		<?php if(is_user_logged_in()) { ?>	
		<?php while ( have_posts() ) : the_post(); ?>
                    <?php if(in_category('143')){ ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
                    <?php } ?>
		<?php endwhile; ?>
		
		<?php gk_content_nav(); ?>
		
		<?php wp_reset_query(); ?>
                <?php } else { ?>
            
            <div class="not-login">
                <h3>Страница не доступна!</h3>
                <p>Страница закрыта для не зарегистрированных пользователей. Пожалуйста <a href="/личная-страница/">зарегистрируйтесь</a> или <a href="wp-login.php?action=login">войдите</a> в свою учетную запись!</p>
            </div>
            
                <?php } ?>
            
            
	</section>
<?php else : ?>
	<section id="gk-mainbody">
		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', GKTPLNAME ); ?></h1>
			</header>

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', GKTPLNAME ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</article>
	</section>
<?php endif; ?>

<?php

gk_load('footer');

// EOF
