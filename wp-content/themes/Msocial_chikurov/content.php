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

<?php if (is_category(156)) { ?>
    <?php
        $seminar_date = get_field('master_class_date');
        $seminar_date_time = $seminar_date.' 00:00:00';
        $seminar_date_formated = strtotime($seminar_date_time);
        $mini_seminar_date = date("d", $seminar_date_formated);
        $mini_seminar_month = date("m", $seminar_date_formated);
        $order_master = get_field('order_master');
        $mini_seminar_date_ordered = $seminar_date_formated+$order_master;
    ?>
    <article data-toggle="modal" data-order="<?php echo $order_master;?>" data-target="#myModal-<?php echo $mini_seminar_date_ordered; ?>" data-day_str="<?php echo $seminar_date_time;?>" data-day="<?php echo $mini_seminar_date_ordered; ?>" id="raspisanie-item post-<?php the_ID();?>" <?php post_class(); ?>>
        <div class="row">
            <div class="col-md-2 col-sm-2 col-xs-2 text-center rasp-date">
                <div class="rasp_d_i_m"><span class="rasp_d"><?php echo $mini_seminar_date;?></span> <span class="devider">/</span><span class="devider_small">—</span> <span class="rasp_m"><?php echo $mini_seminar_month;?></span></div>
            </div>
            <div class="col-md-8 col-sm-7 col-xs-7" style="padding-top: 10px;">
                <div class="rasp-title"><?php the_title(); ?></div>
                <div class="rasp-content">
                    <div class="rasp-time">
                        <span class="fa fa-clock-o"></span> <?php the_field('start_time');?> — <?php the_field('finish-time');?> | 
                    </div>
                    <div class="rasp-adress">
                        <span class="fa fa-map-marker"></span> <?php the_field('event_place'); ?>
                    </div>
                </div>
                <div class="rasp-content">
                    <div class="rasp-time">
                        <span class="fa fa-phone"></span> <?php the_field('event_tel'); ?> | <span class="fa fa-envelope"></span> <a href="mailto:<?php the_field('event_mail'); ?>"><?php the_field('event_mail'); ?></a> | <b>Запиcь обязательна</b>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-3 text-center rasp-img">
                <?php the_post_thumbnail('rasp_thumb'); ?>
            </div>
        </div>
    </article>
    <!-- Modal rasp -->
    <div class="modal fade rasp-modal" id="myModal-<?php echo $mini_seminar_date_ordered; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <div class="row">
                <div class="col-md-2 col-sm-2 col-xs-2 text-center rasp-date">
                    <div class="rasp_d_i_m"><span class="rasp_d"><?php echo $mini_seminar_date;?></span> <span class="devider">/</span><span class="devider_small">—</span> <span class="rasp_m"><?php echo $mini_seminar_month;?></span></div>
                </div>
                <div class="col-md-8 col-sm-7 col-xs-7">
                    <div class="rasp-title"><?php the_title(); ?></div>
                    <div class="rasp-content">
                        <div class="rasp-time">
                            <span class="fa fa-clock-o"></span> <?php the_field('start_time');?> — <?php the_field('finish-time');?>
                        </div>
                        <div class="rasp-adress">
                            <span class="fa fa-map-marker"></span> 
                            <?php the_field('event_place'); ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-2 col-sm-3 col-xs-3 text-center rasp-img">
                    <?php the_post_thumbnail('rasp_thumb'); ?>
                </div>
            </div>
          </div>
          <div class="modal-body">
            <div class="rasp-content">
                <?php the_content(); ?>
            </div>
            <div class="rasp-details">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_time">
                        <div class="rasp-details_title"><span class="fa fa-money"></span> СТОИМОСТЬ</div>
                        <div class="rasp-details_content">
                            Стоимость участия: <?php the_field('org_vznos');?> руб.
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_location">
                        <div class="rasp-details_title"><span class="fa fa-pencil-square-o"></span> КАК ЗАПИСАТЬСЯ?</div>
                        <div class="rasp-details_content">
                            <b style="font-size: 12px;">Предварительная запиcь обязательна</b></br>
                            <span class="fa fa-phone"></span> <?php the_field('event_tel'); ?></br>
                            <span class="fa fa-envelope"></span> <a href="mailto:<?php the_field('event_mail'); ?>"><?php the_field('event_mail'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="rasp-details">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_time">
                        <div class="rasp-details_title"><span class="fa fa-clock-o"></span> ДАТА И ВРЕМЯ</div>
                        <div class="rasp-details_content"><?php the_field('data_and_time');?></div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_location">
                        <div class="rasp-details_title"><span class="fa fa-map-marker"></span> МЕСТО ПРОВЕДЕНИЯ</div>
                        <div class="rasp-details_content"><?php the_field('event_place'); ?></div>
                    </div>
                </div>
            </div>
            <div class="rasp-map">
                <?php echo do_shortcode('[showyamap] [placemark coordinates="55.837287, 37.633060"/] [/showyamap]'); ?>
            </div>
            <div class="rasp-order-title">
                <div class="rasp-details_title" style="padding-top: 10px;text-align: center;
                "><span class="fa fa-pencil"></span> ЗАПИСАТЬСЯ НА МЕРОПРИЯТИЕ</div>
            </div>
            <div class="rasp_order">
                <div class="row">
                    <?php echo do_shortcode('[contact-form-7 id="3503" title="Запись на мастер класс"]'); ?>
                </div>
            </div>
            <div class="rasp-link">
                <div class="rasp-details_title" style="
                    padding-bottom: 10px;
                "><span class="fa fa-link"></span> ПОДЕЛИТЬСЯ ССЫЛКОЙ</div>
                <span class="cur_mc_link">http://www.chikurov.com/category/master-class/?modal=myModal-<?php echo $mini_seminar_date_ordered; ?></span>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
          </div>
        </div>
      </div>
    </div>
<?php } else if (is_category(157)) { ?>
    <h4 class="title"><?php the_title();?></h4>
    <div class="image-container he-wrap tpl2" data-effect="slide-top">
        <?php the_content();?>
    </div>
<?php } else { ?>
    <article id="post-<?php the_ID();?>" <?php post_class(); ?>>
        <?php get_template_part( 'layouts/content.post.featured' ); ?>
                
        <header>
                    <?php get_template_part( 'layouts/content.post.header' ); ?>
                    <?php //gk_post_meta(); ?>
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
            <div class="container" style="padding: 15px 0;">
                <?php the_excerpt(); ?>
                
                <a href="<?php echo get_permalink(get_the_ID()); ?>" class="readon"><?php _e('Подробнее', GKTPLNAME); ?></a>
            </div>
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
                   <div class="padding-box white_bg">
                        <div class="container">
                            <div class="row header">
                                <div class="content col-lg-12 col-md-12 col-sm-12 col-xs-12 clearfix">
                                    <?php the_content( __( 'Read more', GKTPLNAME ) ); ?>
                                    
                                    <?php gk_post_fields(); ?>
                                    <?php gk_post_links(); ?>
                                <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                    </div>
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
<?php } ?>

