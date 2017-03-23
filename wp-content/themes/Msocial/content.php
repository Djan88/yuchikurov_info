<?php

/**
 *
 * The default template for displaying content
 *
 **/

global $tpl; 

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

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php get_template_part( 'layouts/content.post.featured' ); ?>
          		
		<header>
                    <?php get_template_part( 'layouts/content.post.header' ); ?>
                    <?php gk_post_meta(); ?>
		</header>
		
                <?php if(in_category(154) && is_user_logged_in()){ ?>
                    <?php $pages = get_posts(array('category' => 154, 'numberposts' => -1, 'order' => 'ASC')); ?>
                    <div class="select-page-block">  
                    <select name="select_book_page" id="select-book-page">
                        <option value="">Выбрать страницу</option>                     
                        <?php foreach ($pages as $page){ ?>
                        <option value="<?php echo $page->guid; ?>"><?php echo $page->post_title; ?></option>
                        <?php } ?>
                    </select>
                    <a href="" class="select-page">Перейти</a>
                    </div>
                    <div id="bookmark-block"><?php echo get_template_bookmarks(); ?></div>
                    <input type="hidden" name="permalink_page" id="permalink-page" value="<?php echo get_permalink(get_the_ID()); ?>">

                <?php } ?>
            
		<?php if ( (!is_single() && get_option($tpl->name . '_readmore_on_frontpage', 'Y') == 'Y') || is_search() || is_archive() || is_tag() ) : ?>
		<section class="summary">
			<?php the_excerpt(); ?>
			
			<a href="<?php echo get_permalink(get_the_ID()); ?>" class="readon"><?php _e('Подробнее', GKTPLNAME); ?></a>
		</section>
		<?php else : ?>
                    
                <?php if(in_category(154)){ ?>  
                    <section class="content">
                        <?php if(is_user_logged_in()){ ?>
                            <?php the_content( __( 'Read more', GKTPLNAME ) ); ?>

                            <?php gk_post_fields(); ?>
                            <?php gk_post_links(); ?>
                        <?php } else { ?>
                        <div class="content-not-login">
                            <div class="content-center">
                            <p>Данная книга доступна только <a href="http://www.chikurov.com/registration/">зарегистрированным</a> (авторизированным) пользователям.</p> 
                            <p>Для продолжения, пожалуйста, <a href="wp-login.php?action=login" id="gk-login-content">зайдите в свой аккаунт!</a></p>
                            <p>Если забыли пароль, то посмотреть, как его восстановить, Вы можете <a href="http://chikurov.com/как-восстановить-пароль/">здесь</a>.</p>
                            <p>Если у Вас нет еще аккаунта - <a href="http://www.chikurov.com/registration/">зарегистрируйтесь!</a></p>
                            </div>
                        </div>
                        <?php } ?>
                        
                    </section>
                <?php } else {  ?>
                   <section class="content">
			<?php the_content( __( 'Read more', GKTPLNAME ) ); ?>
			
			<?php gk_post_fields(); ?>
			<?php gk_post_links(); ?>
                    
                    
                    </section>
                <?php } ?>
            <?php if(in_category(152)){ ?>
            
            <h3 class="red-header">Запись на приемный день</h3>
            
                    <div class="seminar-subscribe-form-not-none">

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
                    <?php } ?>
            
                    <?php if(in_category(154) && is_user_logged_in()){ ?>
                        <div class="page-nav">
                            <div class="prev-page-nav"><?php previous_post_link('%link', '<< Предыдущая страница', true); ?></div>
                            <div class="next-page-nav"><?php next_post_link('%link', 'Следующая страница >>', true); ?></div>
                        </div>
                    <?php } ?>
		<?php endif; ?>
		
		<?php get_template_part( 'layouts/content.post.footer' ); ?>
	</article>
