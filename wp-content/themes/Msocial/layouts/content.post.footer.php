<?php

/**
 *
 * The template fragment to show post footer
 *
 **/

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl; 

$tag_list = get_the_tag_list( '', __( ' ', GKTPLNAME ) );

$params = get_post_custom();
$params_aside = isset($params['gavern-post-params-aside']) ? $params['gavern-post-params-aside'][0] : false;

$param_aside = true;
$param_tags = true;

if($params_aside) {
  $params_aside = unserialize(unserialize($params_aside));
  $param_aside = $params_aside['aside'] == 'Y';
  $param_tags = $params_aside['tags'] == 'Y';
}

?>

<?php do_action('gavernwp_after_post_content'); ?>

<?php if(is_singular()) : ?>
	<?php 
		// variable for the social API HTML output
		$social_api_output = gk_social_api(get_the_title(), get_the_ID()); 
	?>

	<?php if($tag_list != '' && $param_tags): ?>
	<p class="tags">
		<?php _e('Tagged under:', GKTPLNAME); ?>
		<?php echo $tag_list; ?>
	</p>
	<?php endif; ?>
		
	<?php if($social_api_output != '' || gk_author(false, true)): ?>
        <footer>
		<?php echo $social_api_output; ?>
		<?php gk_author(); ?>
	</footer>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-416286-11']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
	<?php endif; ?>
<?php endif; ?>