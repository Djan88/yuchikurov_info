<?php
/*
Template Name:  Posts
*/

global $tpl;

gk_load('header');
gk_load('before');

?>


	<section id="gk-mainbody">
		
            <?php query_posts( array('category_name'=>'posts', 'showposts' => 10 ) ); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php get_template_part( 'layouts/content.post.featured' ); ?>

                

                    <header>
                        <?php get_template_part( 'layouts/content.post.header' ); ?>
                        <?php gk_post_meta(); ?>
                    </header>



                    <?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
                    <section class="summary">
                            <?php the_excerpt(); ?>

                            <a href="<?php echo get_permalink(get_the_ID()); ?>" class="readon"><?php _e('Подробнее', GKTPLNAME); ?></a>
                    </section>
                    <?php else : ?>
                    <section class="content">
                            <?php the_content( __( 'Read more', GKTPLNAME ) ); ?>

                            <?php gk_post_fields(); ?>
                            <?php gk_post_links(); ?>
                    </section>
                    <?php endif; ?>

                    <?php get_template_part( 'layouts/content.post.footer' ); ?>
            </article>
            
            <?php endwhile; endif; wp_reset_query(); ?>
		
	</section>


<?php

gk_load('after');
gk_load('footer');

// EOF    
