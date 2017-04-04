<?php

/**
 * GavernWP functions and definitions
 *
 * This file contains core framework operations. It is always
 * loaded before the index.php file no the front-end
 *
 * @package WordPress
 * @subpackage GavernWP
 * @since GavernWP 1.0
 **/

if(!function_exists('gavern_file')) {
	/**
	 *
	 * Function used to get the file absolute path - useful when child theme is used
	 *
	 * @return file absolute path (in the original theme or in the child theme if file exists)
	 *
	 **/
	function gavern_file($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				} else {
					return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
				}
			}
		} else {
			if($path == false) {
				return get_template_directory();
			} else {
				return get_template_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
			}
		}
	}
}

if(!function_exists('gavern_file_uri')) {
	/**
	 *
	 * Function used to get the file URI - useful when child theme is used
	 *
	 * @return file URI (in the original theme or in the child theme if file exists)
	 *
	 **/
	function gavern_file_uri($path) {
		if(is_child_theme()) {
			if($path == false) {
				return get_stylesheet_directory_uri();
			} else {
				if(is_file(get_stylesheet_directory() . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path))) {
					return get_stylesheet_directory_uri() . '/' . $path;
				} else {
					return get_template_directory_uri() . '/' . $path;
				}
			}
		} else {
			if($path == false) {
				return get_template_directory_uri();
			} else {
				return get_template_directory_uri() . '/' . $path;
			}
		}
	}
}
//
if(!class_exists('GavernWP')) {
	// include the framework base class
	require(gavern_file('gavern/base.php'));
}
// load and parse template JSON file.
$config_language = 'en_US';
if(get_locale() != '' && is_dir(get_template_directory() . '/gavern/config/'. get_locale()) && is_dir(get_template_directory() . '/gavern/options/'. get_locale())) {
	$config_language = get_locale();	
}
$json_data = json_decode(file_get_contents(get_template_directory() . '/gavern/config/'.$config_language.'/template.json'));
$tpl_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $json_data->template->name));
// define constant to use with all __(), _e(), _n(), _x() and _xe() usage
define('GKTPLNAME', $tpl_name);
// create the framework object
$tpl = new GavernWP();
// Including file with helper functions
require_once(gavern_file('gavern/helpers/helpers.base.php'));
// Including file with template hooks
require_once(gavern_file('gavern/hooks.php'));
// Including file with template functions
require_once(gavern_file('gavern/functions.php'));
require_once(gavern_file('gavern/user.functions.php'));
require_once(gavern_file('gavern/bp.functions.php'));
// Including file with template filters
require_once(gavern_file('gavern/filters.php'));
// Including file with template widgets
require_once(gavern_file('gavern/widgets.comments.php'));
require_once(gavern_file('gavern/widgets.login.php'));
require_once(gavern_file('gavern/widgets.nsp.php'));
require_once(gavern_file('gavern/widgets.tabs.php'));
require_once(gavern_file('gavern/widgets.buddypress.php'));
require_once(gavern_file('gavern/widgets.grid.titleoverlay.php'));
require_once(gavern_file('gavern/widgets.latestphotos.php'));
// Including file with template admin features
require_once(gavern_file('gavern/helpers/helpers.features.php'));
// Including file with template shortcodes
require_once(gavern_file('gavern/helpers/helpers.shortcodes.php'));
// Including file with template layout functions
require_once(gavern_file('gavern/helpers/helpers.layout.php'));
// Including file with template layout functions - connected with template fragments
require_once(gavern_file('gavern/helpers/helpers.layout.fragments.php'));
// Including file with template branding functions
require_once(gavern_file('gavern/helpers/helpers.branding.php'));
// Including file with template customize functions
require_once(gavern_file('gavern/helpers/helpers.customizer.php'));
// initialize the framework
$tpl->init();
// add theme setup function
add_action('after_setup_theme', 'gavern_theme_setup');
// Theme setup function
function gavern_theme_setup(){
	// access to the global template object
	global $tpl;
	// variable used for redirects
	global $pagenow;		
	// check if the themes.php address with goto variable has been used
	if ($pagenow == 'themes.php' && !empty($_GET['goto'])) {
		/**
		 *
		 * IMPORTANT FACT: if you're using few different redirects on a lot of subpages
		 * we recommend to define it as themes.php?goto=X, because if you want to
		 * change the URL for X, then you can change it on one place below :)
		 *
		 **/
		
		// check the goto value
		switch ($_GET['goto']) {
			// make proper redirect
			case 'gavick-com':
				wp_redirect("http://www.gavick.com");
				break;
			case 'wiki':
				wp_redirect("http://www.gavick.com/documentation");
				break;
			// or use default redirect
			default:
				wp_safe_redirect('/wp-admin/');
				break;
		}
		exit;
	}
	// if the normal page was requested do following operations:
	
    // load and parse template JSON file.
    $json_data = $tpl->get_json('config','template');
    // read the configuration
    $template_config = $json_data->template;
    // save the lowercase non-special characters template name				
    $template_name = strtolower(preg_replace("/[^A-Za-z0-9]/", "", $template_config->name));
    // load the template text_domain
    load_theme_textdomain( $template_name, get_stylesheet_directory() . '/languages' );
}
// scripts enqueue function
function gavern_enqueue_admin_js_and_css() {
	// metaboxes scripts
	wp_enqueue_script('gavern.metabox.js', gavern_file_uri('js/back-end/gavern.metabox.js'));
	// widget rules JS
	wp_register_script('widget-rules-js', gavern_file_uri('js/back-end/widget.rules.js'), array('jquery'));
	wp_enqueue_script('widget-rules-js');
	// widget rules CSS
	wp_register_style('widget-rules-css', gavern_file_uri('css/back-end/widget.rules.css'));
	wp_enqueue_style('widget-rules-css');
	// metaboxes CSS
	wp_register_style('gavern-metabox-css', gavern_file_uri('css/back-end/metabox.css'));
	wp_enqueue_style('gavern-metabox-css');
	// GK News Show Pro Widget back-end CSS
	wp_register_style('nsp-admin-css', gavern_file_uri('css/back-end/nsp.css'));
	wp_enqueue_style('nsp-admin-css');
	// shortcodes database
	if(
		get_locale() != '' && 
		is_dir(get_template_directory() . '/gavern/config/'. get_locale()) && 
		is_dir(get_template_directory() . '/gavern/options/'. get_locale())
	) {
		$language = get_locale();	
	} else {
		$language = 'en_US';
	}
	
	wp_enqueue_script('shortcodes.js', gavern_file_uri('gavern/config/'.$language.'/shortcodes.js'));
}
// this action enqueues scripts and styles: 
// http://wpdevel.wordpress.com/2011/12/12/use-wp_enqueue_scripts-not-wp_print_styles-to-enqueue-scripts-and-styles-for-the-frontend/
add_action('admin_enqueue_scripts', 'gavern_enqueue_admin_js_and_css');

// remove the generator metatag due security reasons
remove_action('wp_head', 'wp_generator');
// EOF

/* Отключаем админ панель для всех, кроме администраторов. */
if (!current_user_can('administrator')):
  show_admin_bar(false);
endif;

define( 'BP_DEFAULT_COMPONENT', 'profile' );

function bp_remove_profile_tabs(){
    global $bp;
    
    bp_core_remove_nav_item('activity');
    bp_core_remove_nav_item('friends');
    bp_core_remove_nav_item('notifications');
    bp_core_remove_nav_item('messages');
    
    bp_core_remove_subnav_item( 'groups', 'invites' );
    
}

add_action( 'bp_setup_nav', 'bp_remove_profile_tabs', 15 );



function get_countrys(){
    global $wpdb;
    
    $countrys = $wpdb->get_results("SELECT country FROM reestr_masters"); 
    
    foreach ($countrys as $contry){        
        $countrys_array[] = $contry->country;        
    }
    
    return $countrys_array;
    
}

function get_states($country){
    global $wpdb;
    
    
    $states = $wpdb->get_results("SELECT state FROM reestr_masters WHERE country = '$country'"); 
    
    foreach ($states as $state){        
        $states_array[] = $state->state;        
    }
    
    return $states_array;
    
}

function get_masters(){
    global $wpdb;
    
    $masters = array();
    
    $countrys = $wpdb->get_results("SELECT DISTINCT country FROM reestr_masters"); 
    
    
    foreach ($countrys as $country){
        
            $states = $wpdb->get_results("SELECT DISTINCT state FROM reestr_masters WHERE country = '$country->country'"); 

            foreach ($states as $state){
                $masters[$country->country][$state->state][] = $wpdb->get_results("SELECT * FROM reestr_masters WHERE state = '$state->state'");
            }
           
    }
     
    return $masters;
    
}

function get_def(){
    global $wpdb;
    
    $masters = array();
    
    $countrys = $wpdb->get_results("SELECT DISTINCT country FROM wp_def_masters"); 
    
    
    foreach ($countrys as $country){
        
            $states = $wpdb->get_results("SELECT DISTINCT state FROM wp_def_masters WHERE country = '$country->country'"); 

            foreach ($states as $state){
                $masters[$country->country][$state->state][] = $wpdb->get_results("SELECT * FROM wp_def_masters WHERE state = '$state->state'");
            }
           
    }
     
    return $masters;
    
}

add_filter('parse_query', 'PluginName_pokaz_1_usery' );
 
function PluginName_pokaz_1_usery( $worpdress_query ) {
  // Проверяем админ ли сейчас сидит. Если получаем утвердительное да, тогда корректируем системный запрос
  // на целевой страничке.
  if ( (!current_user_can('level_10')) and (strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) == true) ) :
    global $current_user;
    $worpdress_query->set( 'author', $current_user->id );
  endif;
}

function rdate($param, $time=0) {
	if(intval($time)==0)$time=time();
	$MonthNames=array("Января", "Февраля", "Марта", "Апреля", "Мая", "Июня", "Июля", "Августа", "Сентября", "Октября", "Ноября", "Декабря");
	if(strpos($param,'M')===false) return date($param, $time);
		else return date(str_replace('M',$MonthNames[date('n',$time)-1],$param), $time);
}

function add_news(){
    global $wpdb;
    
    $news = $wpdb->get_results("SELECT * FROM news");
    
    foreach ($news as $new){
        
        
        if($new->master == 0){
        
            $my_post = array(
                'post_title' => $new->Title,
                'post_content' => $new->Body,
                'post_status' => 'publish',
                'post_author' => 1,
                'post_category' => array(149)
             );
            
            wp_insert_post( $my_post );
        
        }
    }   
    
}

function send_email($to, $from, $subject, $name, $phone){
    
    $headers = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: <$from>";
    
    mail($to, $subject, "$subject<br>$name<br>$from<br>$phone", $headers);
    
    $headers = 'MIME-Version: 1.0' . "\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= "From: Roman Paramonov( chikurov.com ) <info@bablosstudio.ru>";
    
    $message = "Добрый день! Спасибо за вашу заявку, наш специалист свяжется с вами в ближайшее время.";
    
    mail($from, $subject, $message, $headers);
    
}

add_action( 'admin_menu', 'register_subscription_seminar' );

function register_subscription_seminar() {

    //create new top-level menu
    add_menu_page('Запись на семинар', 'Запись на семинар', 'administrator', 'subscription_seminar', 'subscription_seminar',plugins_url('/add.png'));
}


function subscription_seminar() {
    global $wpdb;
       
    if ( isset ( $_POST['table_submit'] ) ){
        
        $ids = implode( ',', $_POST['select_checkbox'] );
        if(!empty($ids)){
            $query = 'DELETE FROM wp_subscription WHERE id IN ('.$ids.')';        
            $wpdb->query($query);
        }
  
    }
    
    if ( isset ( $_POST['add_row'] ) ){
        
        if(!empty($_POST['add_seminar_select'])){
            
            $seminar_id = $_POST['add_seminar_select'];
        
            $group = groups_get_group( array( 'group_id' => $seminar_id ) );
            
            $seminar_date = groups_get_groupmeta( $seminar_id, 'group_plus_header_fieldone');
            $sity_seminar = groups_get_groupmeta( $seminar_id, 'group_plus_header_fieldthree');
            $name = $_POST['add_name'];
            $name_seminar = $wpdb->get_results("SELECT name FROM wp_bp_groups WHERE id = $seminar_id");
            $email = $_POST['add_email'];
            $phone = $_POST['add_phone'];
            $date = date('Y-m-d');
            $master_name = bp_core_get_user_displayname( $group->admins[0]->user_id );
            if(!empty($group->mods[0]->user_id)){
                $assistant = bp_core_get_user_displayname( $group->mods[0]->user_id );
            } else {
                $assistant = bp_core_get_user_displayname( $group->admins[0]->user_id );
            }
            
            $status = $_POST['add_status'];
            
            $wpdb->insert(
                    'wp_subscription',
                    array( 'name_seminar' => $name_seminar[0]->name, 'seminar_master' => $master_name, 'seminar_assistant' => $assistant, 'sity_seminar' => $sity_seminar, 'date_seminar' => $seminar_date, 'name' => $name, 'email' => $email, 'phone' => $phone, 'date_registration' => $date, 'status' => $status ),
                    array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d' )
            );
  
        }
    }
    
    $seminars = $wpdb->get_results("SELECT DISTINCT name_seminar, sity_seminar FROM wp_subscription");
    $city = $wpdb->get_results("SELECT DISTINCT sity_seminar FROM wp_subscription");
    $master = $wpdb->get_results("SELECT DISTINCT seminar_master FROM wp_subscription"); 
    $assistant = $wpdb->get_results("SELECT DISTINCT seminar_assistant FROM wp_subscription");
    
    $all_masters = get_master_to_role('author');
    $all_seminars = $wpdb->get_results("SELECT * FROM wp_bp_groups");
    
       
if(isset($_POST['select_submit']) && (isset($_POST['select_seminar']) || isset($_POST['select_city']) || isset($_POST['select_master']) || isset($_POST['select_assistant']))){
        
        $sql = "";
        
        if(!empty($_POST['select_seminar'])){           
            $select_seminar = $_POST['select_seminar'];
            $sql .= " AND name_seminar = '$select_seminar'";
            if(!empty($_POST['select_city']) || !empty($_POST['select_master']) || !empty($_POST['select_assistant']) || (!empty($_POST['status']) && $_POST['status'] == 1)){
                $sql .= " ";
            }
        }
        
        if(!empty($_POST['select_city'])){           
            $select_city = $_POST['select_city'];
            $sql .= " AND sity_seminar = '$select_city'";
            if(!empty($_POST['select_master']) || !empty($_POST['select_assistant']) || (!empty($_POST['status']) && $_POST['status'] == 1)){
                $sql .= " ";
            }
        }
        
        if(!empty($_POST['select_master'])){           
            $select_master = $_POST['select_master'];
            $sql .= " AND seminar_master = '$select_master'";
            if(!empty($_POST['select_assistant']) || (!empty($_POST['status']) && $_POST['status'] == 1)){
                $sql .= " ";
            }
        }
        
        if(!empty($_POST['status']) && $_POST['status'] == 1){           
            $status = 1;
            $sql .= " AND status = 1";
            if(!empty($_POST['select_assistant'])){
                $sql .= " ";
            }
        }
        
        if(!empty($_POST['select_assistant'])){           
            $select_assistant = $_POST['select_assistant'];
            $sql .= " AND seminar_assistant = '$select_assistant'";
            
        }
            
    }
    
    $subscriptions = $wpdb->get_results("SELECT * FROM wp_subscription WHERE date_seminar >= '".date("Y-m-d")."' $sql ORDER BY id DESC");

?>
<div class="wrap search_clients">
    
    <form action="" name="select" method="post">
        
        <select name="select_seminar" style="width: 200px;">
            <option value="">Семинары</option>
            <?php foreach ($seminars as $seminar){ ?>
                <?php if(!empty($_POST['select_seminar']) && $_POST['select_seminar'] == $seminar->name_seminar){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
            <option value="<?php echo $seminar->name_seminar; ?>" <?php echo $selected; ?>><?php echo $seminar->name_seminar. " (".$seminar->sity_seminar.")"; ?></option>
            <?php } ?>
        </select>
        
        <select name="select_master">
            <option value="">Мастер</option>
            <?php foreach ($master as $m){ ?>
                <?php if(!empty($_POST['select_master']) && $_POST['select_master'] == $m->seminar_master){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
                    <option value="<?php echo $m->seminar_master; ?>" <?php echo $selected; ?>><?php echo $m->seminar_master; ?></option>
            <?php } ?>
        </select>
        
        <select name="select_assistant">
            <option value="">Асистент</option>
            <?php foreach ($assistant as $a){ ?>
                <?php if(!empty($_POST['select_assistant']) && $_POST['select_assistant'] == $a->seminar_assistant){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
                    <option value="<?php echo $a->seminar_assistant; ?>" <?php echo $selected; ?>><?php echo $a->seminar_assistant; ?></option>
            <?php } ?>
        </select>
        
        <select name="select_city">
            <option value="">Город</option>
            <?php foreach ($city as $c){ ?>
                <?php if(!empty($_POST['select_city']) && $_POST['select_city'] == $c->sity_seminar){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
                <option value="<?php echo $c->sity_seminar; ?>" <?php echo $selected; ?>><?php echo $c->sity_seminar; ?></option>
            <?php } ?>
        </select>
        
        <?php 
            if(!empty($_POST['status']) && $_POST['status'] == 1){
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
        
        <input type="checkbox" name="status" class="select-checkbox" <?php echo $selected; ?> value="1"> Предоплата
        <?php  
				$upload = wp_upload_dir();
				$upload_dir = $upload['baseurl'];
        ?>
        
        <input type="submit" name="select_submit" class="select-submit" value="Фильтр">
        
        <a class="export-excel" href="<?php echo $upload_dir.'/excel/simple.xls'; ?>" download>Excel</a>
        
    </form>
    
    <form action="" method="post" name="form-table" class="form-table">
        <h2>Записи на семинары <a href="#" name="add_row" id="add-row"><i class="icon-plus"></i>Добавить</a></h2>
        
        <div class="add-row-block">
            
            <h3>Информация о семинаре</h3>
            
            <select name="add_master_select" id="add-master-select">
                <option value="">Мастер</option>
                <?php foreach ($all_masters as $one_master){
                    
                            echo "<option value='".$one_master['id']."'>".$one_master['name']."</option>";
                    
                } ?>
            </select>
            
            
            <select name="add_seminar_select" id="add-seminar-select">
                <option value="">Семинар</option>
                <?php foreach ($all_seminars as $one_seminar){
                    
                            echo "<option value='".$one_seminar->id."'>".$one_seminar->name."</option>";
                    
                } ?>
            </select>
            
            <div class="">
                
                <h3>Данные участника</h3>
                
                <input type="text" name="add_name" value="" placeholder="Имя">
                <input type="text" name="add_email" value="" placeholder="E-mail">
                <input type="text" name="add_phone" value="" placeholder="Телефон">
                
                
                <div class="">
                    <h4>Залог</h4>
                    <input type="radio" name="add_status" value="1"> Внесен
                    <input type="radio" name="add_status" value="0"> Не внесен
                </div>
                
                <input type="submit" name="add_row" value="Сохранить">
                
            </div>
            
        </div>
    
    <table>
        <thead>
            <tr>
                <td></td>
                <td>№ п/п</td>
                <td>Название семинара</td>
                <td>Мастер</td>
                <td>Дата семинара</td>
                <td>Город</td>
                <td>Имя</td>
                <td>E-mail</td>
                <td>Phone</td>
                <td>Дата</td>
                <td>Залог</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            $upload = wp_upload_dir();
			$upload_dir = $upload['basedir'];
			$upload_dir = $upload_dir . '/excel';
			wp_mkdir_p( $upload_dir );
  
			require_once 'Classes/PHPExcel.php';

			$objPHPExcel = new PHPExcel;

			$objPHPExcel->setActiveSheetIndex(0);

			$active_sheet = $objPHPExcel->getActiveSheet();

			$active_sheet->setTitle("Import Excel");

			$active_sheet ->getColumnDimension('A')->setWidth(7);

			$active_sheet ->getColumnDimension('B')->setWidth(80);
			
			$active_sheet ->getColumnDimension('C')->setWidth(15);
			
			$active_sheet ->getColumnDimension('D')->setWidth(14);
			
			$active_sheet ->getColumnDimension('E')->setWidth(20);
			
			$active_sheet ->getColumnDimension('F')->setWidth(17);
			
			$active_sheet ->getColumnDimension('G')->setWidth(23);
			
			$active_sheet ->getColumnDimension('H')->setWidth(25);
			
			$active_sheet ->getColumnDimension('I')->setWidth(10);
           
            $active_sheet ->getColumnDimension('J')->setWidth(10);
            
            $active_sheet->setCellValue('A1', '№ п/п');
            $active_sheet->setCellValue('B1', 'Название семинара');
            $active_sheet->setCellValue('C1', 'Мастер');
            $active_sheet->setCellValue('D1', 'Дата семинара');
            $active_sheet->setCellValue('E1', 'Имя');
            $active_sheet->setCellValue('F1', 'Город');
            $active_sheet->setCellValue('G1', 'E-mail');
            $active_sheet->setCellValue('H1', 'Phone');
            $active_sheet->setCellValue('I1', 'Дата');
            $active_sheet->setCellValue('J1', 'Залог');
            
            $style = array( 'font' => array( 'bold' => true, 'name' => 'Arial', 'size' => 13 ) );
            
            $active_sheet->getStyle('A1:J1')->applyFromArray($style);

			$i = 2; foreach ($subscriptions as $subscription){ ?>
            <tr>
                <td><input type="checkbox" name="select_checkbox[]" value="<?php echo $subscription->id; ?>"></td>
                <td><?php $active_sheet->setCellValue('A'.$i, $subscription->id);  echo $subscription->id; ?></td>
                <td><?php $active_sheet->setCellValue('B'.$i, $subscription->name_seminar); echo $subscription->name_seminar; ?></td>
                <td><?php $active_sheet->setCellValue('C'.$i, $subscription->seminar_master); echo $subscription->seminar_master; ?></td>
                <td><?php $active_sheet->setCellValue('D'.$i, $subscription->date_seminar); echo $subscription->date_seminar; ?></td>
                <td><?php $active_sheet->setCellValue('E'.$i, $subscription->sity_seminar); echo $subscription->sity_seminar; ?></td>
                <td><?php $active_sheet->setCellValue('F'.$i, $subscription->name); echo $subscription->name; ?></td>
                <td><?php $active_sheet->setCellValue('G'.$i, $subscription->email); echo $subscription->email; ?></td>
                <td><?php $active_sheet->setCellValue('H'.$i, $subscription->phone); echo $subscription->phone; ?></td>
                <td><?php $active_sheet->setCellValue('I'.$i, $subscription->date_registration); echo $subscription->date_registration; ?></td>
                <td>
                    <?php if($subscription->status == 0){ ?>
                    <select name="status_pledge" style="color:red;" class="status-pledge" id="<?php echo $subscription->id; ?>">
                        
                        <option value="0" selected="selected" >Не внесен</option>
                        <option value="1" style="color:green">Вненсен</option>
                    </select>
                    <?php } else { ?>
                    <select name="status_pledge" style="color:green" class="status-pledge" id="<?php echo $subscription->id; ?>">
                        <option value="0" style="color:red;">Не внесен</option>
                        <option value="1" selected="selected">Вненсен</option>
                    </select>
                    <?php } ?>
                    
                </td>
            </tr>
            <?php $subscription->status == 0 ? $active_sheet->setCellValue('J'.$i, "Не внесён") : $active_sheet->setCellValue('J'.$i, "Внесён"); $i++; } 
            
        $obj_writer = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

        $obj_writer ->save($upload_dir.'/simple.xls');
            
            ?>
        </tbody>
    </table>
    
        <input type="submit" name="table_submit" value="Удалить выбранные">
        
    </form>
</div>
<?php }

add_action( 'admin_menu', 'delivery_email' );

function delivery_email() {

    //create new top-level menu
    add_menu_page('E-mail рассылка', 'E-mail рассылка', 'administrator', 'delivery_email_page', 'delivery_email_page',plugins_url('/add.png'));
}

function delivery_email_page(){
    
    if(isset($_POST['delivery_start'])){
        
        $headers[] = 'Content-type: text/html';
        $headers[] = 'From: Чикуров Юрий Валентинович <info@bablosstudio.ru>';
        
        $subject = $_POST['delivery_subject'];
        $message = $_POST['delivery_text'];
        
        if($_POST['delivery_select'] == 'all'){
            // The Query
            $user_query = new WP_User_Query( array( 'fields' => array( 'ID', 'display_name', 'user_login', 'user_nicename', 'user_email', 'user_url' ) ) );

            // User Loop
            if ( ! empty( $user_query->results ) ) {
                foreach ( $user_query->results as $user ) {
                    
                    
                    wp_mail( $user->user_email, $subject, $message, $headers);
                    
                }
            }
        
        } elseif($_POST['delivery_select'] == 'role'){
            
            $role = $_POST['type_role'];
            
            // The Query
            $user_query = new WP_User_Query( array( 'role' => $role, 'fields' => array( 'ID', 'display_name', 'user_login', 'user_nicename', 'user_email', 'user_url' ) ) );

            // User Loop
            if ( ! empty( $user_query->results ) ) {
                foreach ( $user_query->results as $user ) {

                    wp_mail( $user->user_email, $subject, $message, $headers);
                    
                }
            }
            
        } elseif ($_POST['delivery_select'] == 'private'){
            
            $users = $_POST['private_user'];
            
            foreach ($users as $user){
                
                $email = xprofile_get_field_data( 8, $user);
                
                wp_mail( $email, $subject, $message, $headers);
                
            }
            
        } else {
            
        }
    
    }
    
    
    
    ?>

<script> tinymce.init({selector:'textarea'});</script>

    <div class="delivery-select">  
        
        <h2>E-mail рассылка</h2>
        
        <form action="" name="delivery" method="post">
            
            <div class="delivery-type-select">
                <h3>Тип рассылки</h3>

                <select name="delivery_select" id="delivery-select">
                    <option value="no">Выбрать тип</option>
                    <option value="all">Все пользователи</option>
                    <option value="role">По статусу</option>
                    <option value="private">Индивидуальная</option>
                </select>
            </div>
            
            <div class="delivery-type"></div>
            
            <div class="message-text">
                
                <h3>Тема рассылки</h3>
                
                <input type="text" name="delivery_subject" value="">
                
                <textarea name="delivery_text" rows="10" cols="50"></textarea>
                
            </div>
            
            <input type="submit" name="delivery_start" value="Начать рассылку">
            
        </form>
    </div>


<?php
   
}

function get_user_delivery(){
    global $bp;
    
    if($_POST['select']){
        
        $type = $_POST['select'];
        
        if($type == 'all' || $type == 'no'){
            
            die();
            
        } elseif($type == 'role') {
            
            $html = "<select name='type_role'>";
            $html .= "<option value=''>Выберите роль</option>";
            $html .= "<option value='Subscriber'>Мастера</option>";
            $html .= "<option value='Author'>Автор</option>";
            $html .= "</select>";
            
            die($html);
            
        } elseif($type == 'private') {
            
            $html = '<div class="all-column">';
            $i=0;
            // The Query
            $user_query = new WP_User_Query( array( 'fields' => array( 'ID' ) ) );
            
            // User Loop
            if ( ! empty( $user_query->results ) ) {
                foreach ( $user_query->results as $user ) {
                    $name = xprofile_get_field_data( 1, $user->ID);
                    
                    if($i == 0){
                        $html .= '<div class="one-column">';
                    }
                    
                    $html .= "<p><input type='checkbox' name='private_user[]' value='".$user->ID."'> ".$name."</p>";
                    $i++;
                    
                    
                    if($i == 9){
                        $html .= '</div>';
                        $i=0;
                    }
                    
                }
            }
            
            $html .= '</div>';
            
            die($html);
            
        }
        
    }
    
}

add_action( 'wp_ajax_get_user_delivery', 'get_user_delivery' );

// let's start by enqueuing our styles correctly
function wptutsplus_admin_styles() {
    
    wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
    wp_register_style( 'admin_style', gavern_file_uri('css/back-end/admin-style.css') );
    wp_enqueue_style( 'admin_style' );
    wp_enqueue_script('admin-scripts', gavern_file_uri('js/admin-scripts.js'), array('jquery'));
    wp_enqueue_script('jquery-ui-datepicker'); 
}
add_action( 'admin_enqueue_scripts', 'wptutsplus_admin_styles' );

add_action( 'admin_menu', 'add_reestr_masters' );

function add_reestr_masters() {

    //create new top-level menu
    add_menu_page('Добавить мастера', 'Добавить мастера', 'administrator', 'add_masters', 'add_masters',plugins_url('/add.png'));
}


function add_masters() {
    global $wpdb;
    
    $data_country = $wpdb->get_results("SELECT DISTINCT country FROM reestr_masters");
    $data_state = $wpdb->get_results("SELECT DISTINCT state FROM reestr_masters");

    if($_POST['master_submit']){
        
        $db = $_POST['select_db'];
        
        $id = $_POST['master_id'];
        $name = $_POST['name'].' '.$_POST['last_name'].' '.$_POST['midle_name'];
        $options = $_POST['options'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $skype = $_POST['skype'];
        $www = $_POST['www'];
        $vk = $_POST['vkontakte'];
        $facebook = $_POST['facebook'];
        $country_db = $_POST['select_country'];
        $state_db = $_POST['select_state'];
        
        if(empty($id)){
            
            if($db == 'reestr_masters'){
        
                $wpdb->insert(
                        $db,
                        array( 'name' => $name, 'options' => $options, 'phone' => $phone, 'email' => $email, 'www' => $www, 'skype' => $skype, 'vkontakte' => $vk, 'facebook' => $facebook, 'country' => $country_db, 'state' => $state_db ),
                        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
                );

            } elseif($db == 'wp_def_masters'){

                $wpdb->insert(
                        $db,
                        array( 'name' => $name, 'email' => $email, 'phone' => $phone, 'skype' => $skype, 'www' => $www, 'vkontakte' => $vk, 'facebook' => $facebook, 'country' => $country_db, 'state' => $state_db, 'info' => $options ),
                        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
                );

            }
            
        } else {
            
            if($db == 'reestr_masters'){
        
                $wpdb->update(
                        $db,                        
                        array( 'name' => $name, 'options' => $options, 'phone' => $phone, 'email' => $email, 'www' => $www, 'skype' => $skype, 'vkontakte' => $vk, 'facebook' => $facebook, 'country' => $country_db, 'state' => $state_db ),
                        array( 'id' => $id ),
                        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ),
                        array( '%d' )
                );

            } elseif($db == 'wp_def_masters'){

                $wpdb->update(
                        $db,
                        array( 'name' => $name, 'email' => $email, 'phone' => $phone, 'skype' => $skype, 'www' => $www, 'vkontakte' => $vk, 'facebook' => $facebook, 'country' => $country_db, 'state' => $state_db, 'info' => $options ),
                        array( 'id' => $id ),
                        array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ),
                        array( '%d' )
                );

            }
            
        }
        
    }
    
?>
<div class="wrap add-master">
    <h2>Добавить мастера</h2>
    
    <form action="" name="add-master" method="post">
        
        <input type="hidden" name="master_id" id="master-id" value="">
        
        <select name="select_db" id="select-db">
            <option value="">Выбрать базу</option>
            <option value="reestr_masters">Мастера школы</option>
            <option value="wp_def_masters">Специалисты тер. деф.</option>
        </select>
        
        <select name="select_master" id="select-master">
            <option value="">База данных не выбрана</option>
        </select>
        
        <input type="text" name="name" id="name" value="" placeholder="Имя" />
        <input type="text" name="last_name" id="last-name" value="" placeholder="Фамилия" />
        <input type="text" name="midle_name" id="midle-name" value="" placeholder="Отчество" />
         
        <textarea name="options" id="option" cols="80" rows="10" placeholder="Специализация (только для мастеров школы)" ></textarea>
        
        <input type="text" name="email" id="email" value="" placeholder="E-mail" />
        <input type="text" name="phone" id="phone" value="" placeholder="Телефон" />
        <input type="text" name="skype" id="skype" value="" placeholder="Skype" />
        <input type="text" name="www" id="www" value="" placeholder="Адрес сайта" />
        
        <div>
            <input type="text" name="vkontakte" id="vkontakte" value="" placeholder="Вконтакте" />
            <input type="text" name="facebook" id="facebook" value="" placeholder="Facebook" />
            <select name="select_country" id="select-country">
                <option value="">Выбрать страну</option>
                <?php foreach ($data_country as $country){ ?>

                <option value="<?php echo $country->country; ?>"><?php echo $country->country; ?></option>

                <?php } ?>
            </select>
        
            <select name="select_state" id="select-state">
                <option value="">Выбрать город</option>
                <?php foreach ($data_state as $state){ ?>

                <option value="<?php echo $state->state; ?>"><?php echo $state->state; ?></option>

                <?php } ?>
            </select>
        </div>
        <input type="submit" name="master_submit" id="master-submit" value="Добавить">
        
    </form>

</div>
<?php }

add_action('bp_setup_nav', 'mb_bp_profile_menu_posts', 301 );

function mb_bp_profile_menu_posts() {
    global $bp;
    bp_core_new_nav_item(
            array(
            'name' => 'Приемные дни',
            'slug' => 'reception_days', 
            'position' => 90, 
            'default_subnav_slug' => 'reception', // We add this submenu item below 
            'screen_function' => 'mb_author_posts'
            )
    );
    
    bp_core_new_nav_item(
            array(
            'name' => 'Прошедшие семинары',
            'slug' => 'past_seminars', 
            'position' => 70, 
            'default_subnav_slug' => 'past', // We add this submenu item below 
            'screen_function' => 'past_seminars'
            )
    );
    
    bp_core_new_nav_item(
            array(
            'name' => 'Новости',
            'slug' => 'author_news', 
            'position' => 80, 
            'default_subnav_slug' => 'news', // We add this submenu item below 
            'screen_function' => 'author_news'
            )
    );
    
    bp_core_new_nav_item(
            array(
            'name' => 'Книги',
            'slug' => 'author_books', 
            'position' => 95, 
            'default_subnav_slug' => 'books', // We add this submenu item below 
            'screen_function' => 'author_books'
            )
    );
    
    bp_core_new_nav_item(
            array(
            'name' => 'Записавшиеся',
            'slug' => 'logged_seminar', 
            'position' => 100, 
            'default_subnav_slug' => 'logged', // We add this submenu item below 
            'screen_function' => 'logged_seminar'
            )
    );
    
}

function logged_seminar(){	
	add_action( 'bp_template_content', 'show_logged_seminar' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function show_logged_seminar(){
    
    global $bp, $wpdb;
    
    $assistant = bp_core_get_user_displayname(bp_displayed_user_id());
    $subscriptions = $wpdb->get_results("SELECT * FROM wp_subscription WHERE seminar_assistant = '$assistant'");
    
    $seminars = $wpdb->get_results("SELECT DISTINCT name_seminar FROM wp_subscription WHERE seminar_assistant = '$assistant'");
    $city = $wpdb->get_results("SELECT DISTINCT sity_seminar FROM wp_subscription WHERE seminar_assistant = '$assistant'");
    $master = $wpdb->get_results("SELECT DISTINCT seminar_master FROM wp_subscription WHERE seminar_assistant = '$assistant'"); 
    
    if(isset($_POST['select_submit']) && (isset($_POST['select_seminar']) || isset($_POST['select_city']) || isset($_POST['select_master']))){
        
        $sql = 'WHERE';
        
        if(!empty($_POST['select_seminar'])){           
            $select_seminar = $_POST['select_seminar'];
            $sql .= " name_seminar = '$select_seminar'";
            if(!empty($_POST['select_city']) || !empty($_POST['select_master'])){
                $sql .= " AND";
            }
        }
        
        if(!empty($_POST['select_city'])){           
            $select_city = $_POST['select_city'];
            $sql .= " sity_seminar = '$select_city'";
            if(!empty($_POST['select_master'])){
                $sql .= " AND";
            }
        }
        
        if(!empty($_POST['select_master'])){           
            $select_master = $_POST['select_master'];
            $sql .= " seminar_master = '$select_master'";
        }
     
        $subscriptions = $wpdb->get_results("SELECT * FROM wp_subscription $sql AND seminar_assistant = '$assistant' ORDER BY id DESC");
        
    }
    
    ?>
<div class="wrap search_clients">
    
    <?php if($subscriptions){ ?>
    
    <h3>Записи на семинары</h3>
    
    <form action="" name="select" method="post">
        
        <select name="select_seminar" style="width: 300px;">
            <option value="">Семинары</option>
            <?php foreach ($seminars as $seminar){ ?>
                <?php if(!empty($_POST['select_seminar']) && $_POST['select_seminar'] == $seminar->name_seminar){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
            <option value="<?php echo $seminar->name_seminar; ?>" <?php echo $selected; ?>><?php echo $seminar->name_seminar; ?></option>
            <?php } ?>
        </select>
        
        <select name="select_master">
            <option value="">Мастер</option>
            <?php foreach ($master as $m){ ?>
                <?php if(!empty($_POST['select_master']) && $_POST['select_master'] == $m->seminar_master){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
                    <option value="<?php echo $m->seminar_master; ?>" <?php echo $selected; ?>><?php echo $m->seminar_master; ?></option>
            <?php } ?>
        </select>
               
        <select name="select_city">
            <option value="">Город</option>
            <?php foreach ($city as $c){ ?>
                <?php if(!empty($_POST['select_city']) && $_POST['select_city'] == $c->sity_seminar){ 
                    
                    $selected = 'selected="selected"';
                    
                } else { $selected = ''; } ?>
                <option value="<?php echo $c->sity_seminar; ?>" <?php echo $selected; ?>><?php echo $c->sity_seminar; ?></option>
            <?php } ?>
        </select>
        
        <input type="submit" name="select_submit" value="Фильтр">
        
    </form>
    
    <form action="" method="post" name="form-table">

        <table>
            <thead>
                <tr>
                    <td>Семинар</td>
                    <td>Ведущий</td>
                    <td>Дата проведения</td>
                    <td>Город</td>
                    <td>Имя</td>
                    <td>E-mail</td>
                    <td>Phone</td>
                    <td>Дата регистрации</td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($subscriptions as $subscription){ ?>
                <tr>
                    <td><?php echo $subscription->name_seminar; ?></td>
                    <td><?php echo $subscription->seminar_master; ?></td>
                    <td><?php echo $subscription->date_seminar; ?></td>
                    <td><?php echo $subscription->sity_seminar; ?></td>
                    <td><?php echo $subscription->name; ?></td>
                    <td><?php echo $subscription->email; ?></td>
                    <td><?php echo $subscription->phone; ?></td>
                    <td><?php echo $subscription->date_registration; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        
    </form>
    
    <?php } else{ ?>
    
    <p>У вас нет записей на семинары!</p>
    
    <?php } ?>
    
</div>
    
<?php }

function author_books(){	
	add_action( 'bp_template_content', 'show_author_books' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function show_author_books(){
    
    global $bp;
    
    $news = get_posts( array(
            'author'      => bp_displayed_user_id(),
            'orderby'     => 'date',
            'category'    => 150,
            'numberposts' => -1
    )); 
    
//    echo '<pre>';
//    var_dump($news);
//    echo '</pre>';
    ?>
    
<div id="groups-dir-list" class="groups dir-list">
    
    <ul id="groups-list" class="item-list" role="main">
        <?php foreach ($news as $new){ ?>
        <li>
            <div class="item-avatar">
                <?php if(get_the_post_thumbnail($new->ID)){ ?>
                    <a href="<?php echo $new->guid; ?>"><?php echo get_the_post_thumbnail($new->ID, array(50,50)); ?></a>
                <?php } else { ?>
                    <?php echo get_avatar( $new->post_author, 50 ); ?>
                <?php } ?>
            </div>

            <div class="item">
                <div class="item-title"><a href="<?php echo $new->guid; ?>"><?php echo $new->post_title; ?></a>
                </div>
                <span class="seminar-date">Автор: <a href=""><?php echo the_author_meta( 'display_name', $new->post_author );?></a></span>

                <div class="item-desc"><?php echo mb_substr($new->post_content, 0,200); ?></div>

            </div>

            <div class="clear"></div>
        </li>
        <?php } ?>
    </ul>
    
</div>
    
<?php }

function author_news(){	
	add_action( 'bp_template_content', 'show_author_news' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}

function show_author_news(){
    global $bp;
    
    $news = get_posts( array(
            'author'      => bp_displayed_user_id(),
            'orderby'     => 'date',
            'category'    => 149,
            'numberposts' => 10
    )); 
    
//    echo '<pre>';
//    var_dump($news);
//    echo '</pre>';
    ?>
    
<div id="groups-dir-list" class="groups dir-list">
    
    <ul id="groups-list" class="item-list" role="main">
        <?php foreach ($news as $new){ ?>
        <li>
            <div class="item-avatar test">
                <?php if(get_the_post_thumbnail($new->ID)){ ?>
                    <a href="<?php echo $new->guid; ?>"><?php echo get_the_post_thumbnail($new->ID, array(50,50)); ?></a>
                <?php } else { ?>
                    <?php echo get_avatar( $new->post_author, 50 ); ?>
                <?php } ?>
            </div>

            <div class="item">
                <div class="item-title"><a href="<?php echo $new->guid; ?>"><?php echo $new->post_title; ?></a>
                </div>
                <span class="seminar-date">Автор: <a href=""><?php echo the_author_meta( 'display_name', $new->post_author );?></a></span>

                <div class="item-desc"><?php echo mb_substr($new->post_content, 0,200); ?></div>

            </div>

            <div class="clear"></div>
        </li>
        <?php } ?>
    </ul>
    
</div>
    
<?php }

function past_seminars(){	
	add_action( 'bp_template_content', 'show_past_seminars' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}
function show_past_seminars() { 
    global $bp; ?>
    
    <div id="groups-dir-list" class="groups dir-list">
            <?php do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups() ) : ?>

	<?php do_action( 'bp_before_directory_groups_list' ); ?>

	<ul id="groups-list" class="item-list" role="main">

	<?php while ( bp_groups() ) : bp_the_group(); ?>
            
            <?php
                $group = groups_get_group( array( 'group_id' => bp_get_group_id() ) );
                
                $date_end = strtotime(groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldtwo'));
                
                $date_now = date('Y-m-d');
                $dateNow = strtotime($date_now);
                if($date_end < $dateNow){
                $date_end = rdate('d M, Y', $date_end);
                $city = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldthree');
                $date = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldone');
                $min_date = strtotime($date);
                $date_seminar = rdate('d M, Y', $min_date);
                if(bp_displayed_user_id() == 0 || bp_displayed_user_id() == $group->admins[0]->user_id){
            ?>

		<li <?php bp_group_class(); ?>>
			<div class="item-avatar">
                                <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumb&width=50&height=50' ); ?></a>
			</div>

			<div class="item">
                            <div class="item-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a>
                            </div>
                            <span class="seminar-date">Ведуший: <?php echo bp_core_get_userlink($group->admins[0]->user_id); if($group->admins[1]->user_id){ echo ', '.bp_core_get_userlink($group->admins[1]->user_id); } ?> <span>|</span> <?= $city; ?> <span>|</span> <?= $date_seminar; ?> - <?= $date_end; ?></span>

				<div class="item-desc"><?php bp_group_description_excerpt(); ?></div>

				<?php do_action( 'bp_directory_groups_item' ); ?>

			</div>

			<div class="clear"></div>
		</li>

                <?php } } endwhile; ?>

	</ul>

	<?php do_action( 'bp_after_directory_groups_list' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_groups_loop' ); ?>

    </div><!-- #groups-dir-list -->
    
<?php }


function mb_author_posts(){	
	add_action( 'bp_template_content', 'mb_show_posts' );
	bp_core_load_template( apply_filters( 'bp_core_template_plugin', 'members/single/plugins' ) );
}
function mb_show_posts() { 
    global $bp;
    
    
    
$posts = get_posts( array(
        'author'      => bp_displayed_user_id(),
        'orderby'     => 'date',
        'category'    => 152
));
    
    
    // проверяем передали ли нам месяц и год
if (isset($_GET["ym"])) {

    $year = (int) substr($_GET["ym"], 0, 4);
    $month = (int) substr($_GET["ym"], 4, 2);
} else { // иначе выводить текущие месяц и год
    $month = date("m", mktime(0, 0, 0, date('m'), 1, date('Y')));
    $year = date("Y", mktime(0, 0, 0, date('m'), 1, date('Y')));
}

$skip = date("w", mktime(0, 0, 0, $month, 1, $year)) - 1; // узнаем номер дня недели
if ($skip < 0) {
    $skip = 6;
}
$daysInMonth = date("t", mktime(0, 0, 0, $month, 1, $year));       // узнаем число дней в месяце
$calendar_head = '';    // обнуляем calendar head
$calendar_body = '';    // обнуляем calendar boday
$day = 1;       // для цикла далее будем увеличивать значение

for ($i = 0; $i < 6; $i++) { // Внешний цикл для недель 6 с неполыми
    $calendar_body .= '<tr>';       // открываем тэг строки
    for ($j = 0; $j < 7; $j++) {      // Внутренний цикл для дней недели
        if (($skip > 0)or ( $day > $daysInMonth)) { // выводим пустые ячейки до 1 го дня ип после полного количства дней
            $calendar_body .= '<td class="none"> </td>';
            $skip--;
        } else {
                
            if ($j == 6)     // если воскресенье то омечаем выходной
                $calendar_body .= '<td class="holiday" id="' . $day . '">' . $day . '</td>';
            else {   // в противном случае просто выводим день в ячейке
                if ((date(j) == $day) && (date(m) == $month) && (date(Y) == $year)) {//проверяем на текущий день
                    $calendar_body .= '<td class="today day day-active" id="' . $day . '">' . $day . '</td>';
                } else {
                    $calendar_body .= '<td class="day" id="' . $day . '">' . $day . '</td>';
                }
            }               
             
            $day++; // увеличиваем $day
        }
    }
    $calendar_body .= '</tr>'; // закрываем тэг строки
}

// заголовок календаря
$calendar_head = '
  <tr>          
        <th colspan="2"><a href="?ym=' . date("Ym", mktime(0, 0, 0, $month - 1, 1, $year)) . '">« Пред</a></th>
        <th colspan="3">' . rdate("M, Y", mktime(0, 0, 0, $month, 1, $year)) . '</th>
        <th colspan="2"><a href="?ym=' . date("Ym", mktime(0, 0, 0, $month + 1, 1, $year)) . '">След »</a></th>
  </tr>
  <tr>
    <th>Пн</th>
    <th>Вт</th>
    <th>Ср</th>
    <th>Чт</th>
    <th>Пт</th>
    <th>Сб</th>
    <th>Вс</th>
  </tr>';


if($_POST['submit-subscribe']){
        
    $md5 = md5($_POST['subscribe-name'].$_POST['subscribe-email'].$_POST['subscribe-phone']);

    if($md5 == $_POST['bot_test']){

        $name = $_POST['subscribe-name'];
        $email = $_POST['subscribe-email'];
        $phone = $_POST['subscribe-phone'];
        $title = $_POST['priem-day'];

        $to = xprofile_get_field_data(8, bp_displayed_user_id());

        //$to .= ', info@bablosstudio.ru';

        send_email($to, $email, "Запись на $title", $name, $phone);

    }
            
}

    ?>

    <div><a href="#" class="readon" id="subscribe-seminar" style="margin: 10px 20px;">Запись на прием</a></div>
    <div class="clear"></div>
    <div id="reception-day-form" class="seminar-subscribe-form">

        <form action="" method="post" name="form-subscribe">
            <input type="text" name="subscribe-name" id="subscribe-name" value="" placeholder="Имя" />
            <input type="text" name="subscribe-email" id="subscribe-email" value="" placeholder="E-mail" />
            <input type="text" name="subscribe-phone" id="subscribe-phone" value="" placeholder="Телефон" />
            <select name="priem-day">
                <option value="">Выбрать приемный день</option>
                <?php foreach ($posts as $post){ ?>

                <option value="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></option>

                <?php } ?>
            </select>
            <input type="hidden" name="bot_test" id="bot_test" value="">
            <input type="submit" name="submit-subscribe" id="submit-subscribe" value="Отправить" />
        </form>

    </div>
    
<div class="calendar-wrap">
    <!-- таблица для вывода календаря -->
            <table id="calendar" border="1" cellspacing="0" cellpadding="5">
                    <thead>
                            <?php echo $calendar_head; ?>
                    </thead>
                    <tbody>
                            <?php echo $calendar_body; ?>
                    </tbody>
            </table>
            <!-- таблица для вывода календаря -->
           
            <input type="hidden" name="master_id" id="master-id" value="<?php echo bp_displayed_user_id(); ?>" />
            <input type="hidden" name="month_year" id="month-year" value="<?php echo rdate("M, Y", mktime(0, 0, 0, $month, 1, $year)); ?>" />
            <div id="reception_today">
                <div class="wrap-name">Сегодняшний прием</div>
                <?php                    

                    foreach ($posts as $post){
                                              
                        $status = get_post_meta($post->ID, 'reception_status');
                        $today = strtotime(date('Y-m-d'));
                        $value = get_post_meta( $post->ID, 'reception_value');
                        $city = get_post_meta( $post->ID, 'reception_city');
                        
                        if(isset($status[0])){
                            
                            if($status[0] == 'date'){

                                $reception_date = strtotime($value[0]);
                                
                                if($today == $reception_date){ ?>
                                    
                                   <article>                   

                                        <h4><a href="<?php echo $post->guid; ?>" title="" rel="bookmark"><?php echo $post->post_title; ?></a></h4>

                                        <span class="seminar-date">
                                            <a class="url fn n" href="" title="" rel="author"></a>
                                            <?php echo $city[0]; ?>
                                            <span>|</span>
                                            <?php 
                                                $meta_values = get_post_meta( $post->ID, 'reception_date'); 
                                                $date = strtotime($meta_values[0]);
                                            ?>
                                             <?php echo rdate('d M, Y', $date); ?>
                                            <span>|</span>
                                            <a href="<?php echo $post->guid; ?>">Запись на прием</a>
                                        </span>

                                        <section class="summary">
                                                <?php echo mb_substr($post->post_content, 0, 200); ?>
                                        </section>
                                        <a href='<?php echo $post->guid; ?>' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>
                                    </article> 
                                    
                                <?php }
                                
                            } elseif($status[0] == 'monthly'){
                                if($value[0] < date('Y-m-d')){
                                    $data = date_modify(strtotime($value[0]), '+1 months');
                                } else {
                                    $data = strtotime($value[0]);
                                }
                                if($today == $data){
                                 ?>
                                    
                                   <article>                   

                                        <h4><a href="<?php echo $post->guid; ?>" title="" rel="bookmark"><?php echo $post->post_title; ?></a></h4>

                                        <span class="seminar-date">
                                            <a class="url fn n" href="" title="" rel="author"></a>
                                            <?php echo $city[0]; ?>
                                            <span>|</span>
                                             <?php echo rdate('d M, Y'); ?>
                                            <span>|</span>
                                            <a href="<?php echo $post->guid; ?>">Запись на прием</a>
                                        </span>

                                        <section class="summary">
                                                <?php echo mb_substr($post->post_content, 0, 200); ?>
                                        </section>
                                        <a href='<?php echo $post->guid; ?>' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>
                                    </article> 
                                    
                            <?php } } elseif($status[0] == 'weekly'){
                                
                                if($value[0] == date('w')){ ?>
                                    
                                   <article>                   

                                        <h4><a href="<?php echo $post->guid; ?>" title="" rel="bookmark"><?php echo $post->post_title; ?></a></h4>

                                        <span class="seminar-date">
                                            <a class="url fn n" href="" title="" rel="author"></a>
                                            <?php echo $city[0]; ?>
                                            <span>|</span>
                                             <?php echo rdate('d M, Y'); ?>
                                            <span>|</span>
                                            <a href="<?php echo $post->guid; ?>">Запись на прием</a>
                                        </span>

                                        <section class="summary">
                                                <?php echo mb_substr($post->post_content, 0, 200); ?>
                                        </section>
                                        <a href='<?php echo $post->guid; ?>' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>
                                    </article> 
                                    
                                <?php }
                                
                            } elseif($status[0] == 'all_weekly'){
                                
                                if(0 < date('w') && date('w') < 6){ ?>
                                    
                                   <article>                   

                                        <h4><a href="<?php echo $post->guid; ?>" title="" rel="bookmark"><?php echo $post->post_title; ?></a></h4>

                                        <span class="seminar-date">
                                            <a class="url fn n" href="" title="" rel="author"></a>
                                            <?php echo $city[0]; ?>
                                            <span>|</span>
                                             <?php echo rdate('d M, Y'); ?>
                                            <span>|</span>
                                            <a href="<?php echo $post->guid; ?>">Запись на прием</a>
                                        </span>

                                        <section class="summary">
                                                <?php echo mb_substr($post->post_content, 0, 200); ?>
                                        </section>
                                        <a href='<?php echo $post->guid; ?>' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>
                                    </article> 
                                    
                                <?php }
                                
                            }
                            
                        }
                                                                      
                    }
                    
                ?>
            </div>
</div>

    <section id="gk-mainbody-reception">
        
        <div class="wrap-name">Приемные дни</div>
        
        <div class="wrap-reception-days">

            <?php query_posts( array('category_name'=>'reception_days', 'author' => bp_displayed_user_id(), 'showposts' => 10 ) ); if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
            
            <?php
                $today = strtotime(date('Y-m-d'));
                $status = get_post_meta( get_the_ID(), 'reception_status');
                $value = get_post_meta( get_the_ID(), 'reception_value');
                $city = get_post_meta( get_the_ID(), 'reception_city');
                                
                if($status[0] == 'date'){ ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

                                    <?php the_title(); ?>

                            </a></h4>

                            <span class="seminar-date">
                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(sprintf(__('View all posts by %s', GKTPLNAME), get_the_author())); ?>" rel="author"><?php echo get_the_author(); ?></a> 
                                <span>|</span>
                                 <?php echo rdate('d M, Y', strtotime($value[0])); ?> 
                                <span>|</span>
                                 <?php echo $city[0]; ?>
                            </span>

                            <span id="thumb-days"><?php get_template_part( 'layouts/content.post.featured' ); ?></span>

                                <?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
                                <section class="summary">
                                        <?php echo mb_substr(get_the_excerpt(), 0, 175).' ...'; ?>
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
                    
                <?php } elseif ($status[0] == 'weekly') { 
                            switch ($value[0]){
                                case '0':
                                    $data = 'Каждое Воскресенье';
                                    break;
                                case '1':
                                    $data = 'Каждый Понедельник';
                                    break;
                                case '2':
                                    $data = 'Каждый Вторник';
                                    break;
                                case '3':
                                    $data = 'Каждую Среду';
                                    break;
                                case '4':
                                    $data = 'Каждый Четверг';
                                    break;
                                case '5':
                                    $data = 'Каждую Пятницу';
                                    break;
                                case '6':
                                    $data = 'Каждую Субботу';
                                    break;
                            } 
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

                                    <?php the_title(); ?>

                            </a></h4>

                            <span class="seminar-date">
                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(sprintf(__('View all posts by %s', GKTPLNAME), get_the_author())); ?>" rel="author"><?php echo get_the_author(); ?></a> 
                                <span>|</span>
                                 <?php echo $data; ?> 
                                <span>|</span>
                                 <?php echo $city[0]; ?>
                            </span>

                            <span id="thumb-days"><?php get_template_part( 'layouts/content.post.featured' ); ?></span>

                                <?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
                                <section class="summary">
                                        <?php echo mb_substr(get_the_excerpt(), 0, 175).' ...'; ?>
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
                    
                <?php } elseif ($status[0] == 'monthly') { 
                        if($value[0] < date('Y-m-d')){
                            $data = date_modify(strtotime($value[0]), '+1 months');
                            $data_update = date('Y-m-d', $data);
                            $data = rdate('d M, Y', $data);
                            update_post_meta(get_the_ID(), 'reception_value', $data_update);
                        } else {
                            $data = rdate('d M, Y', $value[0]);
                        }
                    ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

                                    <?php the_title(); ?>

                            </a></h4>

                            <span class="seminar-date">
                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(sprintf(__('View all posts by %s', GKTPLNAME), get_the_author())); ?>" rel="author"><?php echo get_the_author(); ?></a> 
                                <span>|</span>
                                 <?php echo $data; ?> 
                                <span>|</span>
                                 <?php echo $city[0]; ?>
                            </span>

                            <span id="thumb-days"><?php get_template_part( 'layouts/content.post.featured' ); ?></span>

                                <?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
                                <section class="summary">
                                        <?php echo mb_substr(get_the_excerpt(), 0, 175).' ...'; ?>
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
                    
                <?php  } elseif ($status[0] == 'all_weekly') { ?>
                    
                    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <h4><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', GKTPLNAME ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">

                                    <?php the_title(); ?>

                            </a></h4>

                            <span class="seminar-date">
                                <a class="url fn n" href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" title="<?php echo esc_attr(sprintf(__('View all posts by %s', GKTPLNAME), get_the_author())); ?>" rel="author"><?php echo get_the_author(); ?></a> 
                                <span>|</span>
                                 Всю неделю 
                                <span>|</span>
                                 <?php echo $city[0]; ?>
                            </span>

                            <span id="thumb-days"><?php get_template_part( 'layouts/content.post.featured' ); ?></span>

                                <?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
                                <section class="summary">
                                        <?php echo mb_substr(get_the_excerpt(), 0, 175).' ...'; ?>
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
                    
                <?php } ?>
            
            <?php endwhile; endif; wp_reset_query(); ?>
        </div>
		
    </section>
    
    <div class="clear"></div>
    
<?php }

 function reception_day(){
     
     if($_POST['day']){
         
         $id = $_POST['id'];
         
         $posts = get_posts( array(
                'author'      => $id,
                'orderby'     => 'date',
                'category'    => 152
        ));
         
        $day = $_POST['day']." ".$_POST['monthyear'];
        $date = strtotime(date('Y-m-'.$_POST['day']));
        $author_url = get_author_posts_url($id);
        $user = get_userdata( $id );
        $day_weekly = '';
         
        $html = "<div class='wrap-name'>Приемный день $day</div>";
        if(!empty($posts)){
                   
            foreach ($posts as $post){
                
                $status = get_post_meta( $post->ID, 'reception_status');
                $value = get_post_meta( $post->ID, 'reception_value');
                $city = get_post_meta( $post->ID, 'reception_city');
                $excerpt = mb_substr($post->post_content, 0, 111);
                
                if($status[0] == 'date'){
                    
                    if($value[0] == $day){                       

                        $html .= "<article><h4><a href='$post->guid'>$post->post_title</a></h4>"
                            . "<span class='seminar-date'>
                                <a class='url fn n' href='$author_url'>$user->display_name</a> 
                                <span>|</span>
                                 $day 
                                <span>|</span>
                                 $city[0]
                                </span>"
                            . "<section class='summary'>$excerpt
                            </section><a href='$post->guid' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>"
                            . "</article>";
                        
                    } 
                    
                } elseif($status[0] == 'monthly'){
                    
                    if($value[0] < date('Y-m-d')){
                        $data = date_modify(strtotime($value[0]), '+1 months');
                        $data_update = date('Y-m-d', $data);
                        $data = rdate('d M, Y', $data);
                        update_post_meta($post->ID, 'reception_value', $data_update);
                    } else {
                        $data = $value[0];
                    }
                    
                    if($data == $day){                       

                        $html .= "<article><h4><a href='$post->guid'>$post->post_title</a></h4>"
                            . "<span class='seminar-date'>
                                <a class='url fn n' href='$author_url'>$user->display_name</a> 
                                <span>|</span>
                                 $day 
                                <span>|</span>
                                 $city[0]
                                </span>"
                            . "<section class='summary'>$excerpt
                            </section><a href='$post->guid' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>"
                            . "</article>";
                        
                    } 
                    
                } elseif($status[0] == 'weekly'){
                    
                    $day_weekly = date('w', $date);
                    
                    if($day_weekly == $value[0]){
                        
                        $html .= "<article><h4><a href='$post->guid'>$post->post_title</a></h4>"
                            . "<span class='seminar-date'>
                                <a class='url fn n' href='$author_url'>$user->display_name</a> 
                                <span>|</span>
                                 $day 
                                <span>|</span>
                                 $city[0]
                                </span>"
                            . "<section class='summary'>$excerpt
                            </section><a href='$post->guid' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>"
                            . "</article>";
                        
                    } 
                    
                } elseif($status[0] == 'all_weekly'){
                    
                    $day_weekly = date('w', $date);
                    
                    if($day_weekly > 0 && $day_weekly < 6){
                        
                        $html .= "<article><h4><a href='$post->guid'>$post->post_title</a></h4>"
                            . "<span class='seminar-date'>
                                <a class='url fn n' href='$author_url'>$user->display_name</a> 
                                <span>|</span>
                                 $day 
                                <span>|</span>
                                 $city[0]
                                </span>"
                            . "<section class='summary'>$excerpt
                            </section><a href='$post->guid' class='readon' id='subscribe-seminar' style='float:right;margin: 10px 20px;'>Запись на прием</a>"
                            . "</article>";
                        
                    } 
                    
                }

            }
        
        } else {
        
        $html .= "<p>Приемные дни отсувствуют!</p>";
        
        }
        
        die($html);
         
     }
     
 }
 
add_action( 'wp_ajax_reception_day', 'reception_day' );
add_action( 'wp_ajax_nopriv_reception_day', 'reception_day' );
 
 function select_master(){
     global $wpdb;
     
     if($_POST['db']){
         
         $db = $_POST['db'];
         
         $masters = $wpdb->get_results("SELECT * FROM $db");
         
         $html = "<option value=''>Выбрать мастера</option>";
         
         foreach ($masters as $master){
             
             $html .= "<option value='$master->id'>$master->name</option>";
             
         }
         
         die($html);
         
     }
     
     
 }
 
 add_action( 'wp_ajax_select_master', 'select_master' );
 
 function change_master(){
     global $wpdb;
     
     if($_POST['id']){
         
         $id = $_POST['id'];        
         $db = $_POST['db'];
         
         $master = $wpdb->get_results("SELECT * FROM $db WHERE id = $id");
                  
         die(json_encode($master[0]));
         
     }
          
 }
 
 add_action( 'wp_ajax_change_master', 'change_master' );
 
 function city_filter(){
     
     if($_POST['city']){
         
         $city = $_POST['city'];
         $user_id = $_POST['id'];
         
         $group_ids =  groups_get_user_groups( $user_id );
         $groups_id = array();

         foreach( $group_ids["groups"] as $id ) {

            $city_s = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
            
            if($city_s == $city){
               $groups_id[] = $id; 
            }

         }
         
         $html = '';
         
         foreach ($groups_id as $group_id){
                          
             $group = groups_get_group( array( 'group_id' => $group_id ) );
             
             $start = groups_get_groupmeta( $group_id, 'group_plus_header_fieldone');
             $end = groups_get_groupmeta( $group_id, 'group_plus_header_fieldtwo');
             $start_s = strtotime($start);
             $end_s = strtotime($end);
             $date = strtotime(date('Y-m-d'));
             $seminar_start = rdate('d M, Y', $start_s);
             $seminar_end = rdate('d M, Y', $end_s);
             $descriptions = mb_substr($group->description, 0, 222);
             $slug = $group->slug;
             $name = $group->name;
             $avatar = bp_core_fetch_avatar(array('object' => 'group', 'item_id' => $group_id ) );
             $vedushi = bp_core_get_userlink($group->admins[0]->user_id);
             if($group->admins[1]->user_id){
                 $vedushi .= ', '.bp_core_get_userlink($group->admins[1]->user_id);
             }
             
             if($start_s > $date){
             
             $html .= "<li>
                            <div class='item-avatar'>
                                            <a href='http://chikurov.com/seminar/$slug'>$avatar</a>
                            </div>

                            <div class='item'>
                                        <div class='item-title'><a href='http://chikurov.com/seminar/$slug'>$name</a>
                                        </div>
                                        <span class='seminar-date'>Ведуший: $vedushi <span>|</span> $city <span>|</span> $seminar_start - $seminar_end</span>

                                    <div class='item-desc'>$descriptions</div>

                            </div>

                            <div class='clear'></div>
                        </li>";
             
             }
             
         }
         
         die($html);
         
     }
     
 }
 
add_action( 'wp_ajax_city_filter', 'city_filter' );
add_action( 'wp_ajax_nopriv_city_filter', 'city_filter' );


function rus2translit($string) {

    $converter = array(

        'а' => 'a',   'б' => 'b',   'в' => 'v',

        'г' => 'g',   'д' => 'd',   'е' => 'e',

        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

        'и' => 'i',   'й' => 'y',   'к' => 'k',

        'л' => 'l',   'м' => 'm',   'н' => 'n',

        'о' => 'o',   'п' => 'p',   'р' => 'r',

        'с' => 's',   'т' => 't',   'у' => 'u',

        'ф' => 'f',   'х' => 'h',   'ц' => 'c',

        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',

        

        'А' => 'A',   'Б' => 'B',   'В' => 'V',

        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

        'И' => 'I',   'Й' => 'Y',   'К' => 'K',

        'Л' => 'L',   'М' => 'M',   'Н' => 'N',

        'О' => 'O',   'П' => 'P',   'Р' => 'R',

        'С' => 'S',   'Т' => 'T',   'У' => 'U',

        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

    );

    return strtr($string, $converter);

}

function str2url($str) {

    // переводим в транслит

    $str = rus2translit($str);

    // в нижний регистр

    $str = strtolower($str);

    // заменям все ненужное нам на "-"

    $str = preg_replace('~[^-a-z0-9_]+~u', '-', $str);

    // удаляем начальные и конечные '-'

    $str = trim($str, "-");

    return $str;

}


function create_new_user(){
    global $wpdb;
    
    $masters = $wpdb->get_results("SELECT * FROM reestr_masters");
       
    foreach ($masters as $master){
        
        $user = get_user_by( 'email', $master->email );
        if( !$user ) {
            
            $username = str2url($master->name);
            $password = $username.'2014';
            $email = $master->email;
            
            $user_id = wp_create_user( $username, $password, $email );
            if( is_wp_error( $user_id ) ) {
   
            } else {
                
                xprofile_set_field_data(1, $user_id, $master->name);
                if($master->options){
                    xprofile_set_field_data(6, $user_id, $master->options);
                    xprofile_set_field_data(7, $user_id, $master->options);
                }
                xprofile_set_field_data(8, $user_id, $master->email);
                if($master->phone){
                    xprofile_set_field_data(9, $user_id, $master->phone);
                }
                if($master->skype){
                    xprofile_set_field_data(10, $user_id, $master->skype);
                }
                if($master->www){
                    xprofile_set_field_data(11, $user_id, $master->www);
                }
                if($master->vkontakte){
                    xprofile_set_field_data(12, $user_id, $master->vkontakte);
                }
                if($master->facebook){
                    xprofile_set_field_data(13, $user_id, $master->facebook);
                }
                if($master->country){
                    xprofile_set_field_data(16, $user_id, $master->country);
                }
                if($master->state){
                    xprofile_set_field_data(17, $user_id, $master->state);
                }
                
                $headers[] = 'Content-type: text/html';
                $headers[] = 'From: Чикуров Юрий Валентинович <info@bablosstudio.ru>';
                
                $message = "<p>Добрый день уважаемый(я) ".$master->name."! На сайте <a href='http://chikurov.com/'>Chikurov.com</a> для вас был создан аккаунт, где вы можете редактировать свою информацию!</p>";
                $message .= "<ul><li>Логин: $username</li>";
                $message .= "<li>Пароль: $password</li></ul>";
                
                wp_mail( $master->email, "Ваш акаунт на сайте Chikurov.com", $message, $headers);
                
            }
            
        }
        
    }
    
    
}

function pc_get_userrole($user_id) {

    $user = new WP_User($user_id);

    $userclean = $user->roles[0];

    return $userclean;

}

function similar_seminar($master_id){
    global $wpdb;
    
    $seminars = $wpdb->get_results("SELECT * FROM wp_bp_groups WHERE creator_id = '$master_id'");
    
    return $seminars;
    
}

function status_pledge(){
    global $wpdb;
    
    if(isset($_POST['status']) && isset($_POST['id'])){
        
        $status = $_POST['status'];
        $id = $_POST['id'];
        
        $wpdb->update( 'wp_subscription',
                array( 'status' => $status ),
                array( 'id' => $id ),
                array( '%d' ),
                array( '%d' )
        );
        
    }
    
}

add_action( 'wp_ajax_status_pledge', 'status_pledge' );

function get_subscriber_user(){
    global $bp;
    
    $masters = array();
    $i = 0;
    $masters['Российская Федерация']['Москва'][0]['name'] = '';
    
    if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) :
        
        while ( bp_members() ) : bp_the_member();
    
            $username = bp_get_member_user_login();
            $userinfo = get_userdatabylogin($username);

            if($userinfo->roles[0] == "subscriber" && $username !== 'admin'){
                
                $country = xprofile_get_field_data(16, bp_get_member_user_id());
                $city = xprofile_get_field_data(17, bp_get_member_user_id());
                $image_country = get_image_country(xprofile_get_field_data(16, bp_get_member_user_id()));
                
                $masters[$country][$city][$i]['name'] = bp_get_member_name();
                $masters[$country][$city][$i]['avatar'] = bp_get_member_avatar('type=full&width=125&height=125');
                $masters[$country][$city][$i]['link'] = bp_get_member_permalink();
                $masters[$country][$city][$i]['vk'] = xprofile_get_field_data(12, bp_get_member_user_id());
                $masters[$country][$city][$i]['f'] = xprofile_get_field_data(13, bp_get_member_user_id());
                $masters[$country][$city][$i]['youtube'] = xprofile_get_field_data(14, bp_get_member_user_id());
                $masters[$country][$city][$i]['email'] = xprofile_get_field_data(8, bp_get_member_user_id());
                $masters[$country][$city][$i]['phone'] = xprofile_get_field_data(9, bp_get_member_user_id());
                $masters[$country][$city][$i]['description'] = xprofile_get_field_data(6, bp_get_member_user_id());
                $masters[$country][$city][$i]['skype'] = xprofile_get_field_data(10, bp_get_member_user_id());
                $masters[$country][$city][$i]['www'] = xprofile_get_field_data(11, bp_get_member_user_id());
                $masters[$country][$city][$i]['city'] = xprofile_get_field_data(17, bp_get_member_user_id());
                $masters[$country][$city][$i]['country'] = xprofile_get_field_data(16, bp_get_member_user_id());
                $masters[$country][$city][$i]['img_country'] = $image_country;
                
                $i++;
            }
    
        endwhile;
        
    endif;
    
    return $masters;
    
}

function get_subscriber_user_def(){
    global $bp;
    
    $masters = array();
    $i = 0;
    $masters['Российская Федерация']['Москва'][0]['name'] = '';
    
    if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) :
        
        while ( bp_members() ) : bp_the_member();
    
            $username = bp_get_member_user_login();
            $userinfo = get_userdatabylogin($username);
            $status = get_the_author_meta( 'user_status_master', bp_get_member_user_id() );

            if($status == 1){
                
                $country = xprofile_get_field_data(16, bp_get_member_user_id());
                $city = xprofile_get_field_data(17, bp_get_member_user_id());
                $image_country = get_image_country(xprofile_get_field_data(16, bp_get_member_user_id()));
                
                $masters[$country][$city][$i]['name'] = bp_get_member_name();
                $masters[$country][$city][$i]['avatar'] = bp_get_member_avatar('type=full&width=125&height=125');
                $masters[$country][$city][$i]['link'] = bp_get_member_permalink();
                $masters[$country][$city][$i]['vk'] = xprofile_get_field_data(12, bp_get_member_user_id());
                $masters[$country][$city][$i]['f'] = xprofile_get_field_data(13, bp_get_member_user_id());
                $masters[$country][$city][$i]['youtube'] = xprofile_get_field_data(14, bp_get_member_user_id());
                $masters[$country][$city][$i]['email'] = xprofile_get_field_data(8, bp_get_member_user_id());
                $masters[$country][$city][$i]['phone'] = xprofile_get_field_data(9, bp_get_member_user_id());
                $masters[$country][$city][$i]['description'] = xprofile_get_field_data(6, bp_get_member_user_id());
                $masters[$country][$city][$i]['skype'] = xprofile_get_field_data(10, bp_get_member_user_id());
                $masters[$country][$city][$i]['www'] = xprofile_get_field_data(11, bp_get_member_user_id());
                $masters[$country][$city][$i]['city'] = xprofile_get_field_data(17, bp_get_member_user_id());
                $masters[$country][$city][$i]['country'] = xprofile_get_field_data(16, bp_get_member_user_id());
                $masters[$country][$city][$i]['img_country'] = $image_country;
                
                $i++;
            }
    
        endwhile;
        
    endif;
    
    return $masters;
    
}

function update_activ(){
    global $wpdb;
    
    $users = $wpdb->get_results("SELECT ID FROM wp_users");
    
//    foreach ($users as $user){
//        
//        add_user_meta( $user->ID, 'last_activity', '2014-07-30 11:29:14' );
//        
//    }
    
    
}

add_filter('pre_site_transient_update_core',create_function('$a', "return null;"));
wp_clear_scheduled_hook('wp_version_check');

function get_master_to_role($role){

    global $bp;
    
    $masters = array();
    $i = 0;
    
    if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) :
        
        while ( bp_members() ) : bp_the_member();
    
            $username = bp_get_member_user_login();
            $userinfo = get_userdatabylogin($username);
    
            if($userinfo->roles[0] == $role || $userinfo->ID == 1){
                
                $masters[$i]['name'] = bp_get_member_name();
                $masters[$i]['id'] = $userinfo->ID;
                
                $i++;
            }
    
        endwhile;
        
    endif;
    
    return $masters;
    
}

function author_seminars(){
    global $wpdb, $bp;
    
    if(isset($_POST['id']) && !empty($_POST['id'])){
        
        $master_id = $_POST['id'];
        
        $seminars = $wpdb->get_results("SELECT * FROM wp_bp_groups WHERE creator_id = '$master_id'");
        
        $name = xprofile_get_field_data(1, $master_id);
        
        $html = "<option value=''>Семинары $name</option>";
        
        foreach ($seminars as $seminar){
            $html .= "<option value='$seminar->id'>$seminar->name</option>";
        }
        
        die($html);
        
    } else {
        $seminars = $wpdb->get_results("SELECT * FROM wp_bp_groups");
             
        $html = "<option value=''>Все семинары</option>";
        
        foreach ($seminars as $seminar){
            $html .= "<option value='$seminar->id'>$seminar->name</option>";
        }
        
        die($html);
    }
        
}


add_action( 'wp_ajax_author_seminars', 'author_seminars' );

function insert_header_wp()
{
    echo "<script src='".includes_url()."js/tinymce/tinymce.min.js?ver=4104-20140822'></script>";
}

add_action( 'in_admin_header', 'insert_header_wp' );

add_action( 'load-post.php', 'custom_options_reception_days_setup' );
add_action( 'load-post-new.php', 'custom_options_reception_days_setup' );

function custom_options_reception_days_setup(){
    
     add_action( 'add_meta_boxes', 'custom_options_reception_days' );
    
}

function custom_options_reception_days() {

    add_meta_box(
      'custom-options-reception-days',      // Unique ID
      'Расписание приемных дней',    // Title
      'custom_options_reception_days_function',   // Callback function
      'post',         // Admin page (or post type)
      'side',         // Context
      'default'         // Priority
    );
  }
  
function custom_options_reception_days_function(){

    wp_nonce_field( basename( __FILE__ ), 'options_post_class_nonce' ); ?>

    <p class="custom-options-city">
        <label for="city">Город</label>
        <input type="text" name="city" class="city" value="">
    </p>
    
    <p class="custom-options-type">
        <label for="select_options_reception_days">Тип приемного дня</label>
        <select name="select_options_reception_days" id="select-options-reception-days">
            <option value="">Выберите тип</option>
            <option value="all_weekly">Всю неделю</option>
            <option value="weekly">Еженедельно</option>
            <option value="monthly">Ежемесячно</option>
            <option value="date">По дате</option>
        </select>
    </p>

    <div class="custom-options-block">
        
        <div id="weekly" class="block-none">
            <select name="weekly">
                <option value="1">Пн</option>
                <option value="2">Вт</option>
                <option value="3">Ср</option>
                <option value="4">Чт</option>
                <option value="5">Пт</option>
                <option value="6">Сб</option>
                <option value="0">Вс</option>
            </select>
        </div>
        
        <div id="monthly" class="block-none">
            <input type="text" name="monthly" class="monthly" value="">
        </div>
        
    </div>
    
<?php }

function save_reception_day($post_id){
    
    if(isset($_POST['select_options_reception_days']) || isset($_POST['city'])){
        
        $status = $_POST['select_options_reception_days'];        
        $value = $_POST[$status];
        $city = $_POST['city'];
        
        update_post_meta($post_id, 'reception_city', $city);
        update_post_meta($post_id, 'reception_status', $status);
        update_post_meta($post_id, 'reception_value', $value);
        
    }
    
}

add_action( 'save_post', 'save_reception_day', 10, 2 );

function get_template_bookmarks(){
    
    if(is_user_logged_in()){
        
        global $current_user;
        get_currentuserinfo();
        $html = '';
        
        $bookmarks = get_user_meta($current_user->ID, 'bookmarks', true);
        
        if(isset($_POST['bookmark_permalink']) && isset($_POST['bookmark_name'])){
                       
            if(!empty($bookmarks)){
                
                $bookmarks[$_POST['bookmark_name']] = $_POST['bookmark_permalink'];
                update_user_meta($current_user->ID, 'bookmarks', $bookmarks);
                
            } else {
                
                $bookmarks[$_POST['bookmark_name']] = $_POST['bookmark_permalink'];
                add_user_meta($current_user->ID, 'bookmarks', $bookmarks);
              
            }
            
            $html .= "<div class='add-bookmarks-block'>";
            $html .= "<a href='#' class='add-bookmarks'>В закладках</a>";
            $html .= "<input type='text' class='display-no' id='bookmark-id' name='' placeholder='Название закладки'>";
            $html .= "</div><div class='get-bookmarks-block'>";
            $html .= "<select name='bookmarks_select' id='bookmarks-select'><option value=''>Выбрать</option>";
                        
            foreach ($bookmarks as $key => $value){

                    $html .= "<option value='$value'>$key</option>";

            }
            
            $html .= "</select>"; 
            
            $html .= "</div>";
            
            die($html);
            
        } else {
        
            $html .= "<div class='add-bookmarks-block'>";
            $html .= "<input type='text' class='display-no' id='bookmark-id' name='' placeholder='Название закладки'>";
            $html .= "<a href='#' class='add-bookmarks'>Добавить в закладки</a>";
            $html .= "</div><div class='get-bookmarks-block'>";
            if(!empty($bookmarks)){
                $html .= "<select name='bookmarks_select' id='bookmarks-select'><option value=''>Выбрать</option>";

                foreach ($bookmarks as $key => $value){

                    $html .= "<option value='$value'>$key</option>";

                }

                $html .= "</select>"; 
                
                $html .= "<a href='' class='bookmark-href'>Перейти</a>";
            }
            $html .= "</div>";

            return $html;
        
        }
        
    }    
    
}

add_action( 'wp_ajax_get_template_bookmarks', 'get_template_bookmarks' );

function get_citi_to_country(){
    global $wpdb;
    
    if(isset($_POST['country'])){
        
        $country = $_POST['country'];
        $country_id = $wpdb->get_results("SELECT id FROM net_country WHERE name_ru = '$country'");
        
        $cities = $wpdb->get_results("SELECT * FROM net_city WHERE country_id = '" . $country_id[0]->id . "' ORDER BY city");
        
        $html .= '<label for="field_17">Город</label>';
        $html .= '<select name="field_17" id="field_17">';
        $html .= '<option value="">Выбрать город</option>';
        
        foreach ($cities as $citi){ 
            
            $html .= '<option value="'.$citi->city.'">'.$citi->city.'</option>';
            
        }
        
        $html .= '</select>';
        
        die($html);
        
    }
    
}

add_action( 'wp_ajax_get_citi_to_country', 'get_citi_to_country' );
add_action( 'wp_ajax_nopriv_get_citi_to_country', 'get_citi_to_country' );

function get_image_country($img_ru){  
    global $wpdb;
    
    $img = $wpdb->get_results("SELECT name_en FROM net_country WHERE name_ru = '$img_ru'");
    
    return $img[0]->name_en;
}

if(isset($_POST['save']) && isset($_POST['group-field-one'])){
    
    global $wpdb;
    
    $last_activity = $_POST['group-field-one'];
    $id = $_POST['group_id'];
    
    $wpdb->update( 'wp_bp_groups_groupmeta',
	array( 'meta_value' => $last_activity ),
	array( 'group_id' => $id,  'meta_key' => 'last_activity' ),
	array( '%s' ),
	array( '%s' )
    );
    
}

function mypo_parse_query_useronly( $wp_query ) {
    if ( strpos( $_SERVER[ 'REQUEST_URI' ], '/wp-admin/edit.php' ) !== false ) {
        if ( !current_user_can( 'level_10' ) ) {
            global $current_user;
            $wp_query->set( 'author', $current_user->id );
        }
    }
}

add_filter('parse_query', 'mypo_parse_query_useronly' );

add_action( 'show_user_profile', 'add_extra_status' );
add_action( 'edit_user_profile', 'add_extra_status' );

function add_extra_status( $user )
{
    ?>
        <h3>Дополнительные данные пользователя</h3>

        <table class="form-table">
            <tr>
                <th><label for="facebook_profile">Специалист Терапивтической Дефрагментации</label></th>
                <td><input type="checkbox" <?php if(get_the_author_meta( 'user_status_master', $user->ID ) == 1){ echo 'checked'; } ?> name="user_status_master" value="1" /></td>
            </tr>  
        </table>
    <?php
}

add_action( 'personal_options_update', 'save_extra_status' );
add_action( 'edit_user_profile_update', 'save_extra_status' );

function save_extra_status( $user_id )
{
    if(empty($_POST['user_status_master'])){
        update_user_meta( $user_id,'user_status_master', 0 );
    } elseif($_POST['user_status_master'] == 1) {
        update_user_meta( $user_id,'user_status_master', 1 );
    }
    
} ?>
<?php require_once( dirname(__FILE__) . '/slickadmin/slickadmin.php' ); ?>
