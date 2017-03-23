<?php
/**
 * Plugin Name: BP Extend Groups Description
 * Plugin URI:  http://ovirium.com/portfolio/bp-extend-groups-description/
 * Description: Give more power to your BuddyPress Groups descriptions.
 * Author:      slaFFik
 * Version:     1.4
 * Author URI:  http://ovirium.com/
 * Network:     true
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action('bp_init', 'bpgd_load');
function bpgd_load(){
    if ( bp_is_active( 'groups' ) && bp_is_groups_component() && bp_is_single_item() ) {

        $enable_words = bp_get_option('bpgd_w_count', '0');
        if($enable_words == 1){
            define('BPGD_W_COUNT', 1);
        }else{
            define('BPGD_W_COUNT', 0);
        }

        $words = bp_get_option('bpgd_words', '25');
        if(is_numeric($words)){
            define('BPGD_WORDS', $words);
        }else{
            define('BPGD_WORDS', 25);
        }

        // Enable shortcodes in group description
        add_filter('bp_get_group_description', 'do_shortcode', 99);

        // hide not ready description
        add_action('bp_group_header_meta', 'bpgd_scripts_pre');
        // display ready description + charCounter
        add_action('wp_enqueue_scripts', 'bpgd_scripts_post');
        // support mentions in descriptions
        add_filter('bp_get_group_description', 'bp_activity_at_name_filter');
        // Less link if the desc is long
        add_filter('bp_get_group_description', 'bpgd_less_desc_link', 9, 1 );

        // styles for counter
        if ( bp_is_group_admin_page() ){
            add_action('wp_head', 'bpgd_styles');
            $redactor = bp_get_option('bpgd_redactor', '1');
            if($redactor == 1){
                define('BPGD_REDACTOR', 1);
                add_action('wp_enqueue_scripts', 'bpgd_redactor_styles');
                add_action('wp_footer', 'bpgd_redactor_init');
            }else{
                define('BPGD_REDACTOR', 0);
            }
        }

        // translate the plugin
        load_plugin_textdomain('bpgd', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/');
    }
}

// Include admin area
if (is_admin()){
    include(dirname(__FILE__) .'/bp-groups-description-admin.php');
}

/************
 * Front-end
 ************/
function bpgd_scripts_pre(){
    //echo '<script>jQuery("#item-header-content #item-meta > p").hide();</script>';
}

function bpgd_redactor_styles(){
    wp_enqueue_style('bpgd_redactor', plugins_url( '_inc/redactor/css/redactor.css' , __FILE__ ));
}
function bpgd_redactor_init(){
    $raw    = WPLANG;
    $locale = 'en_EN';
    if( !empty($raw) && file_exists(dirname(__FILE__) . '/_inc/redactor/langs/' . $raw . '.js') ){
        $locale = $raw;
    } ?>
    <script>
    jQuery(document).ready(function(){
        var textarea = jQuery('textarea[name="group-desc"]');
        textarea.css('line-height', '1.7em');
        //line-height: 2em;
        var desc_width    = textarea.width();
        var bpgd_redactor = textarea.redactor({ toolbar: 'bpgd', lang: '<?php echo $locale; ?>' });
        if(bpgd.w_count == 'on'){
            jQuery('#redactor_frame_group-desc').contents().find('body').charCounter();
        }
        desc_width = (parseInt(desc_width, 10) + parseInt(10, 10)) + 'px';
        jQuery('.redactor_box').css('width', desc_width);
    });
    </script>
    <?php
}

function bpgd_scripts_post(){
    // general group js
    wp_enqueue_script('bpgd_scripts', plugins_url( '_inc/scripts.js' , __FILE__ ), array('jquery'), '1.1');

    // to localize
    $data = array(
                'w_count'  => 'off',
                'words'    => BPGD_WORDS,
                'more'     => __('More', 'bpgd'),
                'counter'  => __('Number of words:', 'bpgd'),
                'redactor' => 'off'
            );

    if (BPGD_W_COUNT == 1)
        $data['w_count'] = 'on';

    // redactor js
    if ( bp_is_group_admin_page() && BPGD_REDACTOR == 1){
        $data['redactor'] = 'on';
        wp_enqueue_script('bpgd_redactor', plugins_url( '_inc/redactor/redactor.min.js' , __FILE__ ), array('bpgd_scripts'), '7.5.3');
    }

    // print js global vars in header
    wp_localize_script( 'bpgd_scripts', 'bpgd', $data );
}

function bpgd_styles(){ ?>
    <style>
    #group-settings-form span.counter{float:right;margin-right:25%}
    #group-settings-form span.counter.warning{color:orange}
    </style>
<?php
}

function bpgd_less_desc_link($desc){
    $array = explode(' ', $desc);
    if(count($array) > BPGD_WORDS)
        //$desc .= ' <a href="#" id="less_desc">'.__('Less', 'bpgd').'</a>';
    return $desc;
}

?>