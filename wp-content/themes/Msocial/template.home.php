<?php

/*
Template Name: Home page
*/

gk_load('header');

?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
<div id="members-wrap">
    <?php $master = get_userdata(1); ?>
    <div class="master-wrap">

        <div class="master-avatar">
            <a href="">
                <?php bp_activity_avatar(array('user_id' => 1, 'type' => 'full')); ?>
            </a>           
        </div>
        
        <div class="master-info">
            
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
        
        <div class="master-medal">
            <div class="ofice_phone"><span style="font-size: 13px;display: block;color: #db4a37;">Запись на семинары и консультации:</span> <b style="position: absolute;left: 0;right: 0;top: 26px;">+7 (495) 255-05-61</b></div>
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
    <div class="masters-wrap">
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
        
        <div class="wrap-name">Семинары</div>
        
        <div class="groups mygroups">

                <?php bp_get_template_part( 'groups/groups-loop' ); ?>

        </div>
        
    </div> 
    
    
</div>



<?php endif; ?>

<?php

gk_load('footer');

// EOF


