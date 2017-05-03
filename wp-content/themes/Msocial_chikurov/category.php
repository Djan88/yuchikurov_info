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
            <?php if (is_category(157)||is_category(158)||is_category(161)||is_category(159)||is_category(162)||is_category(160)) { ?>
              <a href="#" class="yt_subscribe">
                <i class="fa fa-youtube-square fa-fw" style="margin-right: 5px;"></i>ПОДПИСАТЬСЯ НА КАНАЛ
              </a>
            <?php } ?>
          </h1>
    </aside>
    <div class="clearfix"></div>
    <?php if (is_category(156)) { ?>
      <div class="row">
        <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 rasp-wrap">
    <?php } else if (is_category(157)||is_category(158)||is_category(161)||is_category(159)||is_category(162)||is_category(160)) { ?>
      <div class="row" style="background-color: #fff;">
        <div class="padding-box">
          <div class="container clearfix">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
              <?php 
                $menu = wp_nav_menu(array('menu' => 'Main Navigation', 'container' => false, menu_class => 'nav nav-tabs nav-stacked' ));
                echo $menu;
              ?>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12" style="background: #eee;">
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
  <?php } else if (is_category(157)) { ?>
    </div></div></div></div>
  <?php } ?>
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF
