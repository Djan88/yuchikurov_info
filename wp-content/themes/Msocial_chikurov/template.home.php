<?php

/*
Template Name: Home page
*/

gk_load('header');

?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
<div id="members-wrap">

  </div>
</div>
<!--section-home-->
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
  <div id="formuls" class="grey-color terapevtic" style="border-bottom: 1px solid #477ab9;">
    <div class="container padding-box">
      <div class="row header">
        <div class="col-xs-12 textbox text-center">
          <h2 class="black">Терапевтические программы</h2>
          <div class="col-sm-6 col-xs-12 terapevtic_btns row">
            <!-- Nav tabs -->
            <div class="col-md-6 terapevtic_btn"><a class="active"  href="#profile" data-toggle="tab">Wizard Machine</a></div>
            <div class="col-md-6 terapevtic_btn"><a href="#home" data-toggle="tab">Wizard Duos</a></div>
            <div class="col-md-6 terapevtic_btn"><a href="#messages" data-toggle="tab">Braincleaner</a></div>
            <div class="col-md-6 terapevtic_btn"><a href="#settings" data-toggle="tab">Marakata</a></div>
          </div>
          <div class="col-sm-6 col-xs-12 pull-right textbox text-center">
            <!-- Tab panes -->
            <div class="tab-content" style="margin-top: 15px;border-top: 1px solid #ddd;">
              <div class="tab-pane" id="home">
                <div class="row">
                  <div class="col-md-6 terapevtic_text">
                    Терапевтическая машина для коррекции партнерских, семейных и бизнес взаимоотношений.
                    <div><a target="_blank" href="http://wizardduos.ru/">СТРАНИЦА ПРОЕКТА</a></div>
                  </div>
                  <div class="col-md-6 terapevtic_image">
                    <img src="/wp-content/themes/Msocial_chikurov/images/wd_home.png" alt="">
                  </div>
                </div>
              </div>
              <div class="tab-pane active" id="profile">
                <div class="row">
                  <div class="col-md-6 terapevtic_text">
                    Терапевтическая машина для коррекции психосоматики.
                    <div><a target="_blank" href="http://wizardmachine.ru/">СТРАНИЦА ПРОЕКТА</a></div>
                  </div>
                  <div class="col-md-6 terapevtic_image">
                    <img src="/wp-content/themes/Msocial_chikurov/images/wm_home.png" alt="">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="messages">
                <div class="row">
                  <div class="col-md-6 terapevtic_text">
                    Терапевтическая машина для коррекции взаимодействия человека и архетипов.
                    <div><a target="_blank" href="http://braincleaner.ru/">СТРАНИЦА ПРОЕКТА</a></div>
                  </div>
                  <div class="col-md-6 terapevtic_image">
                    <img src="/wp-content/themes/Msocial_chikurov/images/br_home.png" alt="">
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="settings">
                <div class="row">
                  <div class="col-md-6 terapevtic_text">
                    Психодинамическая машина для инверсии травм личной истории в ресурс жизненной силы.
                    <div><a target="_blank" href="http://marakata.ru/">СТРАНИЦА ПРОЕКТА</a></div>
                  </div>
                  <div class="col-md-6 terapevtic_image">
                    <img src="/wp-content/themes/Msocial_chikurov/images/marakata_home.png" alt="">
                  </div>
                </div>
              </div>
            </div>
        </div>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
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
<!-- WELCOME MESSAGE END
========================================================================= -->
<div class="materials-block padding-box">
  <div class="container">
    <div class="row header">
      <div class="col-xs-12">
        <aside class="col-sm-6 col-xs-12 text-center">
          <h2>Формулы</h2>
          <p>На сайте доступен специальный интерфейс: "Лечебный диск".<br>
              Формулы можно использовать как для работы, так и в образовательных целях. Кликая на ту или иную формулу Вы переводите ее в активированное состояние, при наведении мышки на активированную формулу всплывает ее название, а так же полное описание со всеми оказываемыми эффектами.</p>
          <a href="/formuly-bc/" class="btn btn-primary" type="button">Увидеть в действии</a>
          <img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/formuls.png" alt>
        </aside>
        <aside class="col-sm-6 col-xs-12 pull-right text-center">
          <h2>Первоэлементы</h2>
          <p>Для вращения диска необходимо захватить одну из сторон треугольника мышкой и вращать в нужном направлении. При вращении треугольника будут активированы первоэлементы на которые указывают его вершины.<br>Используя устройство с сенсорным экраном можно вращать круг пальцем.</p>
          <a href="/pervoelementy/" class="btn btn-primary" type="button">Увидеть в действии</a>
          <img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/elems.png" alt>
        </aside>
      </div>
    </div>
    <!--container--> 
  </div>
</div><!-- WELCOME MESSAGE END
========================================================================= -->
<div class="blue-color materials-block padding-box">
  <div class="container">
    <div class="row header">
      <div class="col-xs-12 text-white-color">
        <aside class="col-sm-6 col-xs-12 text-center">
          <h2 class="white">Книги доктора Чикурова</h2>
          <p class="white">Перейдя по ссылке вы сможете скачать все книги доктора Чикурова. Книга "Биологическое центрирование" доступна для чтения в удобном формате</p>
          <a href="/members/admin/author_books/" class="btn transparent-btn" type="button">Страница книг</a>
          <img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/book_2.png" alt>
        </aside>
        <aside class="col-sm-6 col-xs-12 pull-right text-center">
          <h2 class="white">Видео доктора Чикурова</h2>
          <p class="white">Видео по Биологичкскому центрированию, мягким мануальным техникам, эстетике лица, "WizardMachine" а так же психодинамическим играм "Девяточка", "Marakata".</p>
          <a target="_blank" href="https://www.youtube.com/user/ThePractik01" class="btn transparent-btn" type="button">Видеоканал</a>
          <img class="img-responsive" src="/wp-content/themes/Msocial_chikurov/images/yt.png" alt>
        </aside>
      </div>
    </div>
    <!--container-->
  </div>
</div>

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


