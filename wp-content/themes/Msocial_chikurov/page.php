<?php

/**
 *
 * Page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>
	<?php the_post(); ?>
	
	<?php get_template_part( 'content', 'page' ); ?>
	
	<?php if(get_option($tpl->name . '_pages_show_comments_on_pages', 'Y') == 'Y') : ?>
	<?php comments_template( '', true ); ?>
	<?php endif; ?>

<?php

gk_load('after');
gk_load('footer');

// EOF
