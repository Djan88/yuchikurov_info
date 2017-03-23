<?php

/**
 *
 * Author page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody">
	<?php if ( have_posts() ) : ?>
	
		<?php the_post(); ?>
	
                <?php 
                    $email = xprofile_get_field_data(8, get_the_author_meta( 'ID' ));
                    $phone = xprofile_get_field_data(9, get_the_author_meta( 'ID' ));
                    $skype = xprofile_get_field_data(10, get_the_author_meta( 'ID' ));
                ?>
    
		<h1 class="page-title author">
                        <?php echo '<a href="/members/'.get_the_author_meta('user_login', get_the_author_meta( 'ID' )).'">'; ?>
                        <?php echo get_avatar(get_the_author_meta( 'ID' ), 52); ?>                
			<?php printf( __( '%s %s', GKTPLNAME ), get_the_author_meta('first_name', get_the_author_meta( 'ID' )), get_the_author_meta('last_name', get_the_author_meta( 'ID' )) ); ?>
                        <?php echo '</a>'; ?>
                    <div>
                        <?php if($email){ ?>
                        <span><i class="icon-envelope"></i><a href="mail:<?php echo $email; ?>"><?php echo $email; ?></a></span>
                        <?php } if($phone){ ?>
                        <span><i class="icon-phone"></i><?php echo $phone; ?></span>
                        <?php } if($skype){ ?>
                        <span><i class="icon-skype"></i><?php echo $skype; ?></span>
                        <?php } ?>
                    </div>
                </h1>

		<?php rewind_posts(); ?>
	
		<?php gk_author(true); ?>
	
		<?php do_action('gavernwp_before_loop'); ?>
	
		<?php while ( have_posts() ) : the_post(); ?>
                    <?php if(in_category('149')){ ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
                    <?php } ?>
		<?php endwhile; ?>
		
		<?php gk_content_nav(); ?>
		
		<?php do_action('gavernwp_after_loop'); ?>
	
	<?php else : ?>
		<h1 class="page-title">
			<?php _e( 'Nothing Found', GKTPLNAME ); ?>
		</h1>
	
		<section class="intro">
			<?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', GKTPLNAME ); ?>
		</section>
		
		<?php get_search_form(); ?>
	<?php endif; ?>
</section>


<?php

gk_load('after');
gk_load('footer');

// EOF