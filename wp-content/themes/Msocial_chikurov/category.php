<?php

/**
 *
 * Category page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody" class="category-page test">
	<?php if ( have_posts() ) : ?>	
		<aside class="col-xs-12 subbanner clearfix">
	        <h1 class="cat_heading">
	            <?php echo single_cat_title( '', false ); ?>
	        </h1>
		</aside>
		<div class="clearfix"></div>
		<?php if (is_category(156)) { ?>
			<div class="row"><div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 rasp-wrap">
		<?php } ?>

		<?php do_action('gavernwp_before_loop'); ?>
		
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
	
		<?php gk_content_nav(); ?>
		
		<?php do_action('gavernwp_after_loop'); ?>
		<div class="row pagination_wrap">
			<div class="col-md-5 col-md-offset-5">
			  <?php my_pagenavi(); ?>
			</div>
		</div>
	
	<?php else : ?>
	
		<h1 class="page-title">
			<?php _e( 'Nothing Found', GKTPLNAME ); ?>
		</h1>
	
		<section class="intro">
			<?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', GKTPLNAME ); ?>
		</section>
		
		<?php get_search_form(); ?>
		
	<?php endif; ?>
	<?php if (is_category(156)) { ?>
		</div></div>
	<?php } ?>
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF
