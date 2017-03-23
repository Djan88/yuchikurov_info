<?php
/**
 * Slick Admin
 *
 * Theme options script by Vladimir Anokhin
 * http://ilovecode.ru/
*/

// Make panel available for translation
// Translations can be filed in the /lang/ directory
load_theme_textdomain( 'slickadmin', dirname( __FILE__ ) . '/lang' );

// Load theme options
require_once( dirname( __FILE__ ) . '/theme-options.php' );

define( 'SA_DIR', '/slickadmin');

// Get current theme info
function sa_info( $option = null ) {

	$options = array(
		'themename' => get_current_theme(),
		'shortname' => str_replace( ' ', '_', htmlspecialchars( mb_strtolower( get_current_theme() ) ) ),
		'page' => 'theme-options',
		'option' => 'sa_' . str_replace( ' ', '_', htmlspecialchars( mb_strtolower( get_current_theme() ) ) ) . '_theme_options',
		'dir' => TEMPLATEPATH . SA_DIR,
		'url' => get_bloginfo( 'template_url' ) . SA_DIR,
		'ver' => '1.0.0'
	);
	return ( $option ) ? $options[$option] : $options;
}

// Get option value from database
function sa_option( $option = false ) {

	// Get options from database
	$options = get_option( sa_info( 'option' ) );

	return ( $option ) ? $options[$option] : $options;
}

// Include Slick Admin scripts and styles
function sa_init_head() {

	// Register styles
	wp_register_style( 'slickadmin', sa_info( 'url' ) . '/css/slickadmin.css', false, sa_info( 'ver' ), 'all' );
	wp_register_style( 'slickadmin-colorpicker', sa_info( 'url' ) . '/css/colorpicker.css', false, sa_info( 'ver' ), 'all' );

	// Register scripts
	wp_register_script( 'slickadmin', sa_info( 'url' ) . '/js/slickadmin.js', false, sa_info( 'ver' ), false );
	wp_register_script( 'slickadmin-colorpicker', sa_info( 'url' ) . '/js/colorpicker.js', false, sa_info( 'ver' ), false );

	// Enqueue styles
	wp_enqueue_style( 'slickadmin' );
	wp_enqueue_style( 'slickadmin-colorpicker' );

	// Enqueue scripts
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'slickadmin' );
	wp_enqueue_script( 'slickadmin-colorpicker' );
}

// Create Slick Admin options page
function sa_init_menu() {
	add_menu_page( sa_info( 'themename' ), sa_info( 'themename' ), 'administrator', sa_info( 'page' ), 'sa_page' );
}

add_action( 'admin_init', 'sa_init_head' );
add_action( 'admin_menu', 'sa_init_menu' );

// Insert default settings
function sa_insert_defaults() {

		// Get theme options
		$options = sa_theme_options();

		foreach ( $options as $value ) {
			$defaults[$value['id']] = $value['std'];
		}

		// Insert theme options
		update_option( sa_info( 'option' ), $defaults );
}
// If theme activated
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) { sa_insert_defaults(); }

// Save options
function sa_save_options() {
	if ( $_GET['page'] === sa_info( 'page' ) && $_POST['action'] === 'save' ) {

		$options = sa_theme_options();

		foreach ( $options as $value ) {
			if ( $_POST[$value['id']] != '' ) {
				$new_options[$value['id']] = $_POST[$value['id']];
			} else {
				$new_options[$value['id']] = $value['std'];
			}
		}
		update_option( sa_info( 'option' ), $new_options );
		header( 'Location: admin.php?page=' . sa_info( 'page' ) . '&saved=true' . $_POST['current-tab'] );
		exit;
	}
}
add_action( 'admin_init', 'sa_save_options' );

// Print Slick Admin page
function sa_page() {
	echo '<form action="" method="post">';
	include( dirname( __FILE__ ) . '/template.php' );
	echo '<input type="hidden" name="action" value="save" />';
	echo '<input type="hidden" name="current-tab" value="" />';
	echo '</form>';
}

// Slick Admin notification
function sa_notification() {
	if ( $_GET['saved'] ) {
		echo '<div>' . __('Options saved', 'slickadmin') . '</div>';
	}
}

// Slick Admin footer links
function sa_footer( $sep = '|' ) {

	// Liks in footer
	$links = array(
		__( 'Theme documentation', 'slickadmin' ) => 'http://twitter.com/gn_themes',
		__( 'Twitter', 'slickadmin' ) => 'http://twitter.com/gn_themes',
		__( 'Contact author', 'slickadmin' ) => 'http://ilovecode.ru/',
	);

	$count = count( $links );
	$counter = 0;
	foreach ( $links as $name => $url ) {
		echo ' <a href="' . $url . '" target="_blank" title="' . $name . '">' . $name . '</a> ';
		if ( $counter < $count - 1 ) {
			echo $sep;
		}
		$counter++;
	}
}

// Print tabs
function sa_tabs() {
	$tabs = sa_theme_options();
	foreach ( $tabs as $tab ) {
		switch ( $tab['type'] ) {
			case 'opentab' :
			$icon = '';
			$icon_path = sa_info( 'dir' ) . '/images/tabs/' . $tab['id'] . '.png';
			$icon_url = sa_info( 'url' ) . '/images/tabs/' . $tab['id'] . '.png';
			if ( file_exists( $icon_path ) ) {
				$icon = '<img src="' . $icon_url . '" width="16" height="16" alt="' . $tab['id'] . '" /> ';
			}
			echo '
				<li><a href="#tab-' . $tab['id'] . '">' . $icon . $tab['name'] . '</a></li>';
			break;
		}
	}
}

// Print options
function sa_panes() {

	// Get default options
	$options = sa_theme_options();

	// Get options from database
	$get_options = get_option( sa_info( 'option' ) );

	foreach ( $options as $value ) {
		$id = $value['id'];
		switch ( $value['type'] ) {

			// Open pane
			case 'opentab' :
			echo '<div class="sa-pane" id="pane-' . $value['id'] . '">';
			break;

			// Close pane (+ submit button)
			case 'closetab' :
			echo '<div class="cl"></div><input type="submit" value="' . __('Save changes', 'slickadmin') . '" class="button" /><div class="cl-10"></div></div>';
			break;

			// Open toggle
			case 'opentoggle' :
			echo '<h2 class="sa-box-title-toggle">' . $value['name'] . '</h2><div class="sa-pane-toggle">';
			break;

			// Close toggle
			case 'closetoggle' :
			echo '</div>';
			break;

			// Title
			case 'title' :
			echo '<h2 class="sa-box-title">' . $value['name'] . '</h2>';
			break;

			// Text block
			case 'textblock' :
			echo '<div class="sa-option-box">' . $value['content'] . '</div>';
			break;

			// Text input
			case 'text' :
			echo '<div class="sa-option-box"><div class="sa-option-left">' . $value['name'] . '</div><div class="sa-option-right"><input name="' . $value['id'] . '" id="sa_' . $value['id'] . '" type="text" value="' . stripslashes( htmlspecialchars( $get_options[$id] ) ) . '" class="textfield" /><small>' . $value['desc'] . '</small></div><div class="cl"></div></div>';
			break;

			// Hidden input
			case 'hidden' :
			echo '<input name="' . $value['id'] . '" id="sa_' . $value['id'] . '" type="hidden" value="' . stripslashes( htmlspecialchars( $get_options[$id] ) ) . '" />';
			break;

			// Textarea
			case 'textarea' :
			echo '<div class="sa-option-box"><div class="sa-option-left">' . $value['name'] . '</div><div class="sa-option-right"><textarea name="' . $value['id'] . '" class="textarea">'; if ( $get_options[$id] != '' ) { echo stripslashes( $get_options[$id] ); } else { echo $value['std']; }  echo '</textarea><small>' . $value['desc'] . '</small></div><div class="cl"></div></div>';
			break;

			// Select
			case 'select' :
			echo '<div class="sa-option-box"><div class="sa-option-left">' . $value['name'] . '</div><div class="sa-option-right"><select name="' . $value['id'] . '" class="drop-select">';
			$selectoptions = $value['options'];
			foreach ( $selectoptions as $selectvalue => $selectoption ) {
				$selected = '';
				if ( $get_options[$id] == $selectvalue ) {
					$selected = ' selected="selected"';
				}
				if ( $selectoption == '' ) { $selectoption = $selectvalue; }
				echo '<option' . $selected . ' value="' . stripslashes($selectvalue) . '">' . stripslashes( $selectoption ) . '</option>';
			}
			echo '</select><small>' . $value['desc'] . '</small></div><div class="cl"></div></div>';
			break;

			// Color picker
			case 'color' :
			echo '<div class="sa-option-box"><div class="sa-option-left">' . $value['name'] . '</div><div class="sa-option-right"><input name="' . $value['id'] . '" id="sa_' . $value['id'] . '" type="text" value="' . stripslashes(htmlspecialchars($get_options[$id])) . '" class="textfield color-pick" /><small>' . $value['desc'] . '</small></div><div class="cl"></div></div>';
			break;
		}
	}
}

//wp_dropdown_categories('show_count=1&hierarchical=1&hide_empty=0&selected=8');

?>