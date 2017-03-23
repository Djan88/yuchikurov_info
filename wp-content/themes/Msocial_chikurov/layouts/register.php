<?php

// disable direct access to the file	
defined('GAVERN_WP') or die('Access denied');

global $tpl;

?>

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