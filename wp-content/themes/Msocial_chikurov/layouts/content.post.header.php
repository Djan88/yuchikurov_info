<?php

/**
 *
 * The template fragment to show post header
 *
 **/

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl; 

$params = get_post_custom();
$params_title = isset($params['gavern-post-params-title']) ? esc_attr( $params['gavern-post-params-title'][0] ) : 'Y';
$params_aside = isset($params['gavern-post-params-aside']) ? $params['gavern-post-params-aside'][0] : false;
	  
$param_aside = true;
$param_date = true;
	   
if($params_aside) {
	$params_aside = unserialize(unserialize($params_aside));
	$param_aside = $params_aside['aside'] == 'Y';
	$param_date = $params_aside['date'] == 'Y';
}

?>

<?php if(($param_aside) && ($param_date)) : ?>
	<?php if((!is_page_template('template.fullwidth.php') && !is_search() && ('post' == get_post_type() || 'page' == get_post_type())) && get_the_title() != '') : ?>
		<?php if(!('page' == get_post_type() && get_option($tpl->name . '_template_show_details_on_pages', 'Y') == 'N')) : ?>
			<?php if(!('post' == get_post_type() && get_option($tpl->name . '_display_post_details', 'Y') == 'N')) : ?>
			<div>
                            <?php /* ?>
				<time class="header-date" datetime="<?php echo esc_attr(get_the_date('c')); ?>">
					<a href="<?php echo esc_url(get_permalink()); ?>" title="<?php echo esc_attr(get_the_time()); ?>" rel="bookmark">
						<?php echo esc_html(get_the_date('d')); ?>	
						<span><?php echo esc_html(get_the_date('M')); ?></span>
					</a>
				</time>
                             <?php */ ?>
                             
			<?php if(get_post_format() != '') : ?>
				<span class="format gk-format-<?php echo get_post_format(); ?>"></span>
			<?php endif; ?>
			</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

<?php if(get_the_title() != '' && $params_title == 'Y') : ?>
<aside class="col-xs-12 subbanner subbanner_cat clearfix">
    <div class="post-desc">
        <h3>
            <?php if(!is_singular()) : ?>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
            <?php endif; ?>
                <?php the_title(); ?>
            <?php if(!is_singular()) : ?>
            </a>
                
            <?php endif; ?>
            
            <?php if(is_sticky()) : ?>
            <sup>
                <?php _e( 'Featured', GKTPLNAME ); ?>
            </sup>
            <?php endif; ?>
        </h3>
        <hr>
    </div>

</aside>
<div class="clearfix"></div>
<?php endif; ?>

<?php //do_action('gavernwp_before_post_content'); ?>
