<?php

/**
 *
 * Template Name:  Pay Video Page
 *
 **/

global $tpl;

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody">

    <h1><?php the_title(); ?></h1>

    <?php
    $user = wp_get_current_user();
    ?>

    <?php if(in_array('pay_video', (array)$user->roles)): ?>
    <?php //если пользователь имеет роль 'pay_video', то показываем ему контент ?>

        <?php the_post(); ?>

        <?php get_template_part( 'content', 'page' ); ?>

        <?php if(get_option($tpl->name . '_pages_show_comments_on_pages', 'Y') == 'Y') : ?>
            <?php comments_template( '', true ); ?>
        <?php endif; ?>

    <?php elseif($user->ID): ?>
    <?php //если пользователь авторизован, но у него нет роли 'pay_video', то показываем ему форму оплаты ?>

    <p>Доступ к этому видео платный. Вы можете оплатить видео нажав на кнопку оплата или связаться с Парамоновым Романом по телефону +7 (495) 255-05-61 или по емейл info@bablosstudio.ru для получения деталей оплаты альтернативными методами.</p>
    <p>После оплаты Вы получите доступ к видео, которое Вы сможете просматривать на сайте chikurov.com в любое удобное для Вас время.</p>

            <?php
                $sMerchantLogin = 'chikurov';
                $nOutSum = '25000.00';
                $nInvId = '0';
                $sMerchantPass1 = 'romashka1';
                $sInvDesc = 'Доступ к видеоматериалам по биологическому центрированию на сайте chikurov.com';
                $shParams = array(
                    'shpuser'=>$user->ID
                );
                if($_GET['test'] == 1) $shParams['shptest'] = 1;
                ksort($shParams);
                $shParamsSign = '';
            ?>

            <?php if($shParams['shptest'] == 1): ?>
            <form action="http://test.robokassa.ru/Index.aspx" method="POST" class="pay-form">
            <?php else: ?>
            <form action="https://merchant.roboxchange.com/Index.aspx" method="POST" class="pay-form">
            <?php endif; ?>
                <input type="hidden" name="MrchLogin" value="<?=$sMerchantLogin?>">
                <input type="hidden" name="OutSum" value="<?=$nOutSum?>">
                <input type="hidden" name="InvId" value="<?=$nInvId?>">
                <input type="hidden" name="Desc" value="<?=$sInvDesc?>">
                <?php foreach ($shParams as $shKey => $shValue): ?>
                    <?php $shParamsSign .= ':' . $shKey . '=' . $shValue ?>
                    <input type="hidden" name="<?=$shKey?>" value="<?=$shValue?>">
                <?php endforeach; ?>
                <input type="hidden" name="SignatureValue" value="<?=md5($sMerchantLogin.':'.$nOutSum.':'.$nInvId.':'.$sMerchantPass1 . $shParamsSign)?>">
                <input type="submit" value="оплатить" class="pay-form__submit">
            </form>

    <?php else: ?>
    <?php //если пользователь не авторизован, то призываем его авторизоваться ?>
    
        <div class="content-not-login">
            <div class="content-center">
                <p>Данная страница доступна только <a href="<?=site_url()?>/registration/">зарегистрированным</a> (авторизированным) пользователям.</p>
                <p>Для продолжения, пожалуйста, <a href="<?=site_url()?>/wp-login.php?action=login" id="gk-login-content">зайдите в свой аккаунт!</a></p>
                <p>Если забыли пароль, то посмотреть, как его восстановить, Вы можете <a href="<?=site_url()?>/как-восстановить-пароль/">здесь</a>.</p>
                <p>Если у Вас нет еще аккаунта - <a href="<?=site_url()?>/registration/">зарегистрируйтесь!</a></p>
            </div>
        </div>

    <?php endif; ?>

</section>

<?php

gk_load('after');
gk_load('footer');

// EOF