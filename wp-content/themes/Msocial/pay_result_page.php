<?php

/**
 *
 * Template Name:  Pay Result (system)
 *
 **/

//get vars
$OutSum = $_GET['OutSum'];
$InvId = $_GET['InvId'];
$SignatureValue = $_GET['SignatureValue'];
$shParams = array();
$shParamsSign = '';
foreach ($_GET as $gkey => $gval){
    if(substr($gkey, 0, 3) === 'shp'){
        $shParams[$gkey] = $gval;
        $shParamsSign .= ':' . $gkey . '=' . $gval;
    }
}

$test = $shParams['shptest'];

//validate signature
if (strtolower($SignatureValue) !== md5($OutSum . ':' . $InvId . ':romashka2' . $shParamsSign)){
    if($test) echo 'signature error';
    die();
}

$user = get_user_by('id', $shParams['shpuser']);

//echo '<pre>';
//echo 'Пользователь ' . $user->display_name . '(#' . $user->ID . ', ' . $user->user_login . ', ' . $user->user_email . ') заплатил ' . $OutSum . ' рублей.';
////print_r($user);
//echo '</pre>';

//validate summ
if ($OutSum < 25000){
    if ($test) {
        die('OutSum error');
    } else {
        wp_mail('info@bablosstudio.ru', 'Несовпадение суммы оплаты на chikurov.com', 'Пользователь ' . $user->display_name . '(' . $user->ID . ', ' . $user->user_login . ', ' . $user->user_email . ') заплатил ' . $OutSum . ' рублей.' );
        die();
    }
}

//add role to user
if($test && !in_array('administrator', (array)$user->roles)) die('test ok');

$user->caps['pay_video'] = 1;
update_user_meta( $user->ID, $user->cap_key, $user->caps );
$user->get_role_caps();
$user->update_user_level_from_caps();

echo 'OK' . $InvId;


