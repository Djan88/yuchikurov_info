<?php

/*
Template Name: Home page
*/

gk_load('header');

?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
<div id="members-wrap">
  <?php $master = get_userdata(1); ?>
    <?php if(get_field('slider_fields')): ?>
      <?php $slidecount = 0 ?>
      <!-- SLIDER STARTS
        ========================================================================= -->
      <div id="slider" class="hidden">
        <div class="tp-banner-container">
          <div class="tp-banner" >
            <ul>
              <?php while(has_sub_field('slider_fields')): ?>
                <!-- SLIDE  -->
                <li data-transition="slideleft" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-delay="5500" > 
                  <!-- LAYERS --> 
                  <!-- LAYER NR. 1 -->
                  <h1 class="tp-caption lft customout rs-parallaxlevel-0"
                  data-x="left"
                  data-y="100" 
                  data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                  data-speed="700"
                  data-start="1550"
                  data-easing="Power3.easeInOut"
                  data-elementdelay="0.1"
                  data-endelementdelay="0.1"
                  style="z-index: 2; font-size: 35px;">
                    <span style="color:#f6be60;"><?php the_sub_field('title_one') ?></span><br>
                    <?php the_sub_field('title_two') ?><br>
                    <?php the_sub_field('title_three') ?><br>
                    <?php the_sub_field('title_four') ?></h1>
                  <?php if(get_sub_field('slide_btn_one')) { ?> 
                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption tp-resizeme customout rs-parallaxlevel-0"
                    data-x="left"
                    data-y="300" 
                    data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                    data-speed="700"
                    data-start="1400"
                    data-easing="Power3.easeInOut"
                    data-elementdelay="0.1"
                    data-endelementdelay="0.1"
                    style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;"><a class="largeredbtn" target="_blank" href="<?php the_sub_field('slide_btn_link_one') ?>"><?php the_sub_field('slide_btn_one') ?></a></div> 
                  <?php } ?>
                  
                  <?php if(get_sub_field('slide_btn_two')) { ?> 
                  <!-- LAYER NR. 3 -->
                  <div class="tp-caption tp-resizeme customout rs-parallaxlevel-0"
                  data-x="140"
                  data-y="300" 
                  data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                  data-speed="700"
                  data-start="1100"
                  data-easing="Power3.easeInOut"
                  data-elementdelay="0.1"
                  data-endelementdelay="0.1"
                  style="z-index: 12; max-width: auto; max-height: auto; white-space: nowrap;"><a class="largeredbtn" target="_blank" href="<?php the_sub_field('slide_btn_link_two') ?>"><?php the_sub_field('slide_btn_two') ?></a></div>
                  <?php } ?>
                  
                  <?php if(get_sub_field('slide_img')) { ?>
                  <!-- LAYER NR. 5 -->
                  <div class="tp-caption medium_text customin"
                  data-x="600"
                  data-y="80" 
                  data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;"
                  data-speed="500"
                  data-start="2000"
                  data-easing="Power3.easeInOut"
                  data-elementdelay="0.1"
                  data-endelementdelay="0.1"
                  style="z-index: 6;"><img style="height: 400px; width: auto;" src="<?php the_sub_field('slide_img') ?>" alt=""></div>
                  <?php } ?>
                </li>
                <?php 
                  if ($slidecount == 1) {
                    $slidecount = 0;
                  } else {
                    $slidecount = 1;
                  } 
                ?>
            <?php endwhile; ?>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-md-2 col-md-offset-5" style="position:relative;">
          <div class="scroll_block"></div>
        </div>
      </div>
    </div>
    <!-- /. SLIDER ENDS
      ========================================================================= -->
    <?php endif; ?>
  </div>
</div>
<!--section-home-->
<!-- WELCOME MESSAGE STARTS
========================================================================= -->
<div class="clear"></div>
<div class="blue-color padding-box">
  <div class="container">
    <div class="row header">
      <div class="col-xs-12 text-white-color">
        <aside class="col-sm-6 col-xs-12 textlt">
          <h2 class="white">Биологическое центрирование</h2>
          <p class="white">Биологическое Центрирование (БЦ) является учением о принципах формирования здорового и успешного жизнеустройства, проистекающих из него физического здоровья, личностного развития, успешной самореализации в жизни...</p>
          <a href="/biologicheskoe-centrirovanie/" class="btn transparent-btn" type="button">Читать книгу</a>
        </aside>
        <figure class="col-sm-4 col-xs-4 pull-right"><img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/bc.png" alt></figure>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
<!-- PORTFOLIO STARTS
========================================================================= -->
<div class="container padding-box" id="portfolio">
  <div class="row header">
    <article class="col-xs-12">
      <figure class="col-sm-4 col-xs-4 pull-left"><img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/bc_2.png" alt></figure>
      <aside class="col-sm-6 col-xs-12 textbox text-center">
        <h2 class="black">Семинары доктора Чикурова</h2>
        <p class="black" style="text-align: justify;">
          Расписание грядущих семинаров доктора Юрия Чикурова. Кликнув по интересующему мероприятию Вы получите информацию о тематике семинара, его продолжительности. Можете узнать на кого рассчитан семинар, увидеть карту проезда. Воспользовавшись формой Вы можете записаться на мероприятие либо задать интересующий Вас вопрос.
        </p>
        <a href="/seminary-doktora-chikurova/" class="btn btn-primary" type="button">Страница семинаров</a>
      </aside>
      </div>
    </article>
  </div>
  <!--container--> 
</div>
<!-- PORTFOLIO END
========================================================================= -->
<div class="blue-color padding-box">
  <div class="container">
    <div class="row header">
      <div class="col-xs-12 text-white-color">
        <aside class="col-sm-6 col-xs-12 textlt">
          <h2 class="white">Мастер классы</h2>
          <p class="white">Мастер классы доктора Чикурова это однодневные практические мероприятия рассчитанные на небольшие группы. </p>
          <a href="/category/master-class" class="btn transparent-btn" type="button">Страница мастер классов</a>
        </aside>
        <figure class="col-sm-4 col-xs-4 pull-right"><img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/calendar.png" alt></figure>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
<!-- WELCOME MESSAGE END
========================================================================= -->
<div id="formuls" style="border-bottom: 1px solid #477ab9;">
  <div class="container padding-box">
    <div class="row header">
      <div class="col-xs-12">
        <figure class="col-sm-4 col-xs-4 pull-left"><img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/formuls.png" alt></figure>
        <aside class="col-sm-6 col-xs-12 textbox text-center">
          <h2 class="black">Формулы</h2>
          <p class="black" style="text-align: justify;">
            На сайте доступен специальный интерфейс: "Лечебный диск".<br>
            Формулы с этого интерфейса можно использовать как для работы, так и в образовательных целях. Кликая на ту или иную формулу вы переводите ее в активированное состояние, при наведении мышки на активированную формулу всплывает ее название, а так же полное описание со всеми оказываемыми эффектами.
          </p>
          <a href="/formuly-bc/" class="btn btn-primary" type="button">Увидеть в действии</a>
        </aside>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
<?php if (current_user_can('administrator')) { ?>
  <!-- WELCOME MESSAGE END
  ========================================================================= -->
  <div id="formuls" class="grey-color terapevtic" style="border-bottom: 1px solid #477ab9;">
    <div class="container padding-box">
      <div class="row header">
        <div class="col-xs-12 textbox text-center">
          <h2 class="black">Терапевтические программы</h2>
          <div class="col-sm-4 col-xs-4 terapevtic_btns row">
            <!-- Nav tabs -->
              <div class="col-md-6 terapevtic_btn active"><a href="#home" data-toggle="tab">Главная</a></div>
              <div class="col-md-6 terapevtic_btn"><a href="#profile" data-toggle="tab">Профиль</a></div>
              <div class="col-md-6 terapevtic_btn"><a href="#messages" data-toggle="tab">Сообщения</a></div>
              <div class="col-md-6 terapevtic_btn"><a href="#settings" data-toggle="tab">Настройки</a></div>
          </div>
          <div class="col-sm-6 col-xs-12 pull-right textbox text-center">
              <!-- Tab panes -->
              <div class="tab-content">
                <div class="tab-pane active" id="home">1</div>
                <div class="tab-pane" id="profile">2</div>
                <div class="tab-pane" id="messages">3</div>
                <div class="tab-pane" id="settings">4</div>
              </div>
          </div>
        </div>
      </div>
      <!--container--> 
    </div>
  </div>
<?php } ?>
<div class="blue-color padding-box" style="padding-bottom: 80px;">
  <div class="container">
    <div class="row header">
      <div class="col-xs-12 text-white-color">
        <aside class="col-sm-6 col-xs-12 textlt">
          <h2 class="white">Книги доктора Чикурова</h2>
          <p class="white">Перейдя по ссылке вы сможете скачать все книги доктора Чикурова. Книга "Биологическое центрирование" доступна для чтения в удобном формате</p>
          <a href="/members/admin/author_books/" class="btn transparent-btn" type="button">Страница книг</a>
        </aside>
        <figure class="col-sm-4 col-xs-4 pull-right"><img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/book.png" alt></figure>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
<!-- PLANS PRICING STARTS
========================================================================= -->
<div class="grey-color">
  <div class="container padding-box" id="pricing">
    <div class="row header">
      <article class="col-xs-12 textbox text-center">
        <h2 class="black">Реестр специалистов</h2>
        <!-- <p>Подзаголовок</p> -->
        <aside class="col-xs-12 col-sm-4 reestr">
          <div class="col-sm-12 plan1">
            <h3>Реестр мастеров</h3>
            <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/master.1.png" class="mastera" style="padding-top: 33px;"></div>
            <a class="btn btn-primary btn-lg" href="/members/">Посмотреть</a>
          </div>
        </aside>
        <aside class="col-xs-12 col-sm-4 reestr">
          <div class="col-sm-12 plan1">
            <h3>Терапевтическая дефрагментация</h3>
            <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/defra.png" class="defragments"></div>
            <a class="btn btn-primary btn-lg" href="/терапевтическая-дефрагментация/">Посмотреть</a>
          </div>
        </aside>
        <aside class="col-xs-12 col-sm-4 reestr">
          <div class="col-sm-12 plan1">
            <h3>Биологическое центрирование</h3>
            <div class="pakage_price"><img src="/wp-content/themes/Msocial_chikurov/images/bc_2.png" class="mastera" style="width: 73%;padding-bottom: 19px;padding-top: 20px;"></div>
            <a class="btn btn-primary btn-lg" href="/biologicheskoe-centrirovanie-specialisty/">Посмотреть</a>
          </div>
        </aside>
        <!-- <aside class="col-xs-12 col-sm-3 reestr">
          <div class="col-sm-12 plan1">
            <h3>Специалисты Wizardmachine</h3>
            <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/wm_wd.png" class="mastera" style="width: 73%;padding-bottom: 19px;padding-top: 20px;"></div>
            <a class="btn btn-primary btn-lg" href="/specialisty-wizard/">Посмотреть</a>
          </div>
        </aside> -->
      </article>
    </div>
    <!--container--> 
  </div>
</div>
<!-- PLANS PRICING END
========================================================================= -->
<!-- SITEMAP STARTS
    ========================================================================= -->
<div class="service-container black2-color padding-box">
  <div class="container">
    <aside class="col-sm-6 col-xs-12">
      <div class="text-center design_box">
        <div class="icon-box list-inline"><span class="fa fa-newspaper-o"></span></div>
        <h4>Новости</h4>

        <div class="separator"><img src="/wp-content/themes/Msocial_chikurov/images/circle2.png" alt=""></div>
        <ul class="check col-md-8 col-md-offset-2 news_block">
          <?php 
              // WP_Query arguments
              $args_news = array (
                    'cat'              => '149',
                    'posts_per_page'         => '10'
              );

              // The Query
              $query = new WP_Query( $args_news );
              while ($query->have_posts()) : $query->the_post();
              echo '<li>';
              echo '<a href="';
              echo the_permalink();
              echo '">';
              echo the_title()." ...";
              echo '</a>';
              echo '</li>';
              endwhile;
              wp_reset_postdata();
          ?>
          <a class="news_block_a" href="/members/<?php echo $master->user_login; ?>/author_news/">Все новости</a>
        </ul>
      </div>
    </aside>
    <aside class="col-sm-6 col-xs-12">
      <div class="text-center design_box">
        <div class="icon-box list-inline"><span class="fa fa-file-text"></span></div>
        <h4>Статьи</h4>
        <div class="separator"><img src="/wp-content/themes/Msocial_chikurov/images/circle2.png" alt=""></div>
        <ul class="check col-md-8 col-md-offset-2 news_block">
          <?php 
              // WP_Query arguments
              $args_news = array (
                    'cat'              => '148',
                    'posts_per_page'         => '10'
              );

              // The Query
              $query = new WP_Query( $args_news );
              while ($query->have_posts()) : $query->the_post();
              echo '<li>';
              echo '<a href="';
              echo the_permalink();
              echo '">';
              echo the_title()." ...";
              echo '</a>';
              echo '</li>';
              endwhile;
              wp_reset_postdata();
          ?>
          <a class="news_block_a" href="/category/posts/">Все статьи</a>
        </ul>
      </div>
    </aside>
    <!--container--> 
  </div>
  <!--black_con--> 
</div>
<!-- SITEMAP END
========================================================================= -->

    <div class="master-wrap">

        <div class="master-avatar hidden">
            <a href="">
                <?php bp_activity_avatar(array('user_id' => 1, 'type' => 'full')); ?>
            </a>           
        </div>
        
        <div class="master-info hidden">
            
            <a class="master-name hidden" href="/members/admin" title=""><?php echo $master->display_name; ?></a>

            <div class="moreinfo hidden">
                <ul>                    
                    <li><a href="/members/<?php echo $master->user_login; ?>/seminar/">Семинары</a></li>|                   
                    <li><a href="/members/<?php echo $master->user_login; ?>/author_news/">Новости</a></li>|
                    <li><a href="/статьи/">Статьи</a></li>|
                    <li><a href="https://www.youtube.com/user/ThePractik01/">Видео</a></li>|
                    <li><a href="/книги/">Книги</a></li>
                </ul>
            </div>
            
            <?php 
        
                    $group_ids =  groups_get_user_groups( $master->ID ); 
                    
                    $min_date = '';
                    $title = '';
                    $city = '';
                                        
                    foreach( $group_ids["groups"] as $id ) {
                        $group = groups_get_group( array( 'group_id' => $id) );
                        if(($group->admins[0]->user_id == $user_id) || ($group->admins[1]->user_id == $user_id)){
                            $date = groups_get_groupmeta( $id, 'group_plus_header_fieldone');
                            $date = strtotime($date);
                            if($date > strtotime(date('Y-m-d'))){
                                
                                if(empty($min_date)){
                                    $min_date = $date;                           
                                    $title = $group->name;
                                    $slug = $group->slug;
                                    $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                                } else {

                                    if($date < $min_date){
                                        $min_date = $date;
                                        $title = $group->name;
                                        $slug = $group->slug;
                                        $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                                    }
                                } 
                                
                            }
                            
                        }                      
                    }
                    
                    $date_seminar = rdate('d M, Y', $min_date);
                    
                    $latest_post = get_posts( array(
                            'author'      => $master->ID,
                            'orderby'     => 'date',
                            'category'    => 149,
                            'numberposts' => 2
                    ));
                    
                    //var_dump($latest_post);

            ?>
            <div class="next-seminar hidden">
                <span class="title-block">Семинары:</span>
                <a href="/seminar/<?= $slug; ?>" class="seminar-title"><?= substr($title, 0, 111)." ..."; ?></a>
                <span><?= $city; ?> <?= $date_seminar; ?></span>
                <a class="all-seminar" href="/members/<?php echo $master->user_login; ?>/seminar/">Все семинары >></a>
            </div>
            <div class="btns_wrap clearfix">
                <div class="btns_left" style="margin-left: 1%;">
                    <a target="_blank" href="http://wizardmachine.ru/" class="bt">wizardmachine</a>
                    <a target="_blank" href="http://wizardduos.ru/" class="bt">wizardduos</a>
                    <a target="_blank" href="http://wizardknife.ru/" class="bt">wizardknife</a>
                    <a target="_blank" href="/лечебный-день-в-пещерах-чатыр-дага-2/" class="bt btn_styled">Лечебная пещера</a>
                </div>
                <div class="btns_right">
                    <a target="_blank" href="http://braincleaner.ru/" class="bt">braincleaner</a>
                    <a target="_blank" href="/members/" class="bt">мастера школы</a>
                    <a target="_blank" href="https://www.youtube.com/user/ThePractik01/" class="bt">учебное видео</a>
                    <a target="_blank" href="/книги/" class="bt">книги</a>
                </div>
            </div>
        </div>
        
        <div class="master-medal hidden">
            <!-- <div class="ofice_phone"><span style="font-size: 13px;display: block;color: #db4a37;">Запись на семинары и консультации:</span> <b style="position: absolute;left: 0;right: 0;top: 26px;">+7 (495) 255-05-61</b></div> -->
            <div>
                <a href="/members/">
                    <img src="/wp-content/themes/Msocial/images/master.1.png" class="mastera">
                    <span>Реестр</br> мастеров</span>
                </a>
            </div>
            <div style="padding-top: 3px;">
                <a href="/терапевтическая-дефрагментация/">
                    <img src="/wp-content/themes/Msocial/images/defra.png" class="defragments">
                    <span>Реестр специалистов</span>
                </a>
                
            </div>
            <div>
                <a href="/specialisty-wizard/">
                    <img src="/wp-content/themes/Msocial/images/wm_wd.png" class="mastera" style="width: 68%;padding-bottom: 3px;">
                    <span>Специалисты Wizardmachine</span>
                </a>
            </div>
        </div>              
    </div>  
    <div class="masters-wrap hidden">
        <div class="wrap-name hidden" style="background: #eee;">
            <a href="/1-ая-страница/"><i class="icon-book"></i>Читать Книгу</a>
            <a href="biovideo" class="biovideo">Учебное видео по БЦ</a>
            <a href="http://braincleaner.ru/" target="_blank" style="width: auto;padding: 2px 22px;border: 1px #f55 solid;"><i class="icon-gears"></i>Прокачать осознанность</a>
        </div>
        <div class="next-news clearfix" style="margin-right: 2px!important;">
            <span class="title-block wrap-name">Новости</span>
            <div class="main-list-block">
                <?php 
                    // WP_Query arguments
                    $args_news = array (
                          'cat'              => '149',
                          'posts_per_page'         => '20'
                    );

                    // The Query
                    $query = new WP_Query( $args_news );
                    while ($query->have_posts()) : $query->the_post();
                    echo '<a class="news-title" href="';
                    echo the_permalink();
                    echo '">';
                    echo the_title()." ...";
                    echo '</a>';
                    endwhile;
                    wp_reset_postdata();
                ?>
            </div>
            <a class="all-news" href="/members/<?php echo $master->user_login; ?>/author_news/">Все новости >></a>
        </div>
        <div class="next-news next-seminars clearfix" style="margin-left: 2px!important;">
            <span class="title-block wrap-name">Статьи</span>
            <div class="main-list-block">
                <?php 
                    // WP_Query arguments
                    $args_stat = array (
                          'cat'              => '148',
                          'posts_per_page'         => '20'
                    );

                    // The Query
                    $query = new WP_Query( $args_stat );
                    while ($query->have_posts()) : $query->the_post();
                    echo '<a class="news-title" href="';
                    echo the_permalink();
                    echo '">';
                    echo the_title()." ...";
                    echo '</a>';
                    endwhile;
                    wp_reset_postdata(); 
                ?>
            </div>
            <a class="all-news" href="/category/posts/">Все статьи >></a>
        </div>
        <div class="video_wrap hidden">
            <div class="video">
                <?php 
                    $str_video =  stripcslashes(sa_option( 'video_field' ));
                    echo $str_video;
                ?>
            </div>
            <div class="video-right"><?php echo sa_option( 'phone_field' ); ?></div>
        </div>
    <?php 
            $i=1; 
            while ( bp_members() ) : bp_the_member(); 
            $username = bp_get_member_user_login();
            $user_id = bp_get_member_user_id();
            $userinfo = get_userdatabylogin($username);
            
            unset($group_ids);
            
            $group_ids =  groups_get_user_groups( $user_id ); 

            $min_date = '';
            $title = '';
            $city = '';

            foreach( $group_ids["groups"] as $id ) {
                $group = groups_get_group( array( 'group_id' => $id) );
                if(($group->admins[0]->user_id == $user_id) || ($group->admins[1]->user_id == $user_id)){
                    $date = groups_get_groupmeta( $id, 'group_plus_header_fieldone');
                    if(empty($min_date)){
                        $min_date = strtotime($date);                           
                        $title = $group->name;
                        $slug = $group->slug;
                        $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                    } else {
                        $date = strtotime($date);
                        if($date < $min_date && $date > strtotime(date('Y-m-d'))){
                            $min_date = $date;
                            $title = $group->name;
                            $slug = $group->slug;
                            $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                        }
                    } 
                    
                }
            }

            $date_seminar = rdate('d M, Y', $min_date);

            $latest_post = get_posts( array(
                    'author'      => $user_id,
                    'orderby'     => 'date',
                    'category'    => 149,
                    'numberposts' => 1
            ));

            //var_dump($latest_post);
            
            
            if($i<=3 && $userinfo->roles[0] == "author"){ 
                $i++ 
        ?>
        
            
    
        <?php } elseif($i>3 && $userinfo->roles[0] == "author"){ if($i==6){$i=1;} else {$i++;} ?>

              
    
        <?php } ?>   
    
    <?php endwhile; ?>  
     
    </div>
    
    <div id="seminars-wrap">
        
        
        <div class="groups mygroups">

                <?php //bp_get_template_part( 'groups/groups-loop-chikurov' ); ?>

        </div>
        
    </div> 
    
    
</div>



<?php endif; ?>

<?php

gk_load('footer');

// EOF


