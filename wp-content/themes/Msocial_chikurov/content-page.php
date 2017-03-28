<?php

/**
 *
 * The template used for displaying page content in page.php
 *
 **/
 
global $tpl;

$show_title = true;

if ((is_page_template('template.fullwidth.php') && ('post' == get_post_type() || 'page' == get_post_type())) || get_the_title() == '') {
    $show_title = false;
}

$classname = '';

if(!$show_title) {
    $classname = 'no-title';
}

if(is_page() && get_option($tpl->name . '_template_show_details_on_pages', 'Y') == 'N') {
    $classname .= ' page-fullwidth';
}

?>
<?php if(is_page(2857)){ ?>
    <?php if($show_title) : ?>
    <?php get_template_part( 'layouts/content.post.featured' ); ?>
    
    <header>
        <?php get_template_part( 'layouts/content.post.header' ); ?>
    </header>
    <?php endif; ?>
    <?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>
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
                <div class="mosaic-block fade member-wrap hidden" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF;">
                    <div class="mosaic-overlay">
                        <a href="<?php bp_member_permalink(); ?>" title="" class="master-name-mosaic"><?php bp_member_name(); ?></a>
                        <?php if($title){ ?>
                        <div class="next-seminar-mosaic">
                            <span class="title-block">Семинар:</span>
                            <a href="/seminar/<?= $slug; ?>" class="seminar-title-mosaic"><?= mb_substr($title, 0, 30)." ..."; ?></a>
                            <span><?= $city; ?> <?= $date_seminar; ?></span>
                        </div>
                        <?php } ?>
                        <ul>
                            <?php if(xprofile_get_field_data( 18, $user_id)){ ?>
                            <li><a href="/members/<?php bp_member_user_login(); ?>/reception_days/">Приемные дни</a></li> | 
                            <?php } ?>
                            <?php if(xprofile_get_field_data( 23, $user_id)){ ?>
                            <li><a href="/members/<?php bp_member_user_login(); ?>/seminar/">Семинары</a></li> | 
                            <?php } ?>                       
                            <li><a href="/author/<?php bp_member_user_login(); ?>">Новости</a></li> | 
                            <li><a href="<?php echo xprofile_get_field_data( 14, $user_id); ?>">Видео</a></li>
                        </ul>
                    </div>
                    <a href="<?php bp_member_permalink(); ?>">
                        <?php bp_member_avatar(); ?>
                    </a>
                    <div class="member-info">
                        <div class="member-information">
                            <a href="<?php bp_member_permalink(); ?>" title=""><?php bp_member_name(); ?></a> 
                            <?php if(xprofile_get_field_data( 17, $user_id)){ ?>
                            <span class="city-master-r"><?php echo xprofile_get_field_data( 17, $user_id); ?></span>
                            <?php } ?>
                        </div>
                        
                        <p>
                            <?php echo mb_substr(strip_tags(xprofile_get_field_data( 6, $user_id)), 0, 45)." ..."; ?>
                        </p>
                    </div>
                </div>  
            <?php } ?>   
        <?php endwhile; ?>  
            <div class="member-wrap hidden" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF;">
                <div class="member-info">
                    <div class="member-information" style="margin-top: 27%; text-align: center;">
                        <a href="/личная-страница/">Занять<br/> свободное <br/> место</a>                        
                    </div>  
                </div>
                <a href="/личная-страница/">
                    <img src="/wp-content/themes/Msocial/images/Google-Plus-icon.png">
                </a>
            </div>  
        </div> 
    </div>
    <?php endif; ?>
<?php } else { ?>
      <!-- BANNER STARTS
        ========================================================================= -->
      <aside class="col-xs-12 subbanner">
        <h1 class="tes"><?php the_title(); ?></h1>
      </aside>
      <div class="clearfix"></div>
      <!-- /. BANNER ENDS
        ========================================================================= --> 
      <!--section-home--> 
      <!--<a class="button bp-title-button" href="http://www.biozentation.de/seminar/create/">Создать семинар</a>-->
    </div>
    <div class="page_content">
        <?php if (is_page(3312)) { ?>
            <?php include(TEMPLATEPATH . '/tpl_formula.php'); ?>
        <?php } else if (is_page(3206)) { ?>
            <?php include(TEMPLATEPATH . '/tpl_bc.php'); ?>
        <?php } else if (is_page(3518)) { ?>
            <div class="col-md-12 container padding-box" id="about-us">
              <div class="row header">
                <article class="col-xs-12 textbox text-center">
                  <h2 class="black">Доктор Юрий Чикуров</h2>
                  <p>Доктор Ю. Чикуров, канд. мед. наук, доцент, специалист в области неврологии и нейрофизиологии. Основоположник новых прогрессивных направлений - Биологическое Центрирование, которое основано на концепте мирового эфира и его механизмах формирования материального мира. Визард-терапия, интерактивный вебпроект braincleaner.ru  , терапевтическая дефрагментация ума, игровая терапевтическая машина Marakata и многое другое. Руководитель Школы Соматической Интеграции.</p>
                </article>
              </div>
              <!--container--> 
            </div>
            <div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 rasp-wrap masonry-portfolio" id="porfolio-masonry">
                <?php bp_get_template_part( 'groups/groups-loop-chikurov' ); ?>
            </div>
        <?php } else { ?>
            <?php the_content(); ?>
        <?php } ?>
        
        <?php gk_post_fields(); ?>
        <?php gk_post_links(); ?>
    </div>
        
        <?php get_template_part( 'layouts/content.post.footer' ); ?>
    </article>
<?php } ?>
