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
            <div class="mosaic-block fade member-wrap" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF;">
                <div class="mosaic-overlay">
                    <a href="<?php bp_member_permalink(); ?>" title="" class="master-name-mosaic"><?php bp_member_name(); ?></a>
                    <?php if($title){ ?>
                    <div class="next-seminar-mosaic">
                        <span class="title-block">Семинар:</span>
                        <a href="/seminar/<?= $slug; ?>" class="seminar-title-mosaic"><?= mb_substr($title, 0,30)." ..."; ?></a>
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
                <div class="member-info">
                    <div class="member-information">
                        <a href="<?php bp_member_permalink(); ?>" title=""><?php bp_member_name(); ?></a> 
                        <?php if(xprofile_get_field_data( 17, $user_id)){ ?>
                        <span class="city-master-l"><?php echo xprofile_get_field_data( 17, $user_id); ?></span>
                        <?php } ?>                       
                    </div>
                    <p>
                        <?php echo mb_substr(strip_tags(xprofile_get_field_data( 6, $user_id)), 0, 45)." ..."; ?>
                    </p>
                </div>
                <a href="<?php bp_member_permalink(); ?>">
                    <?php bp_member_avatar(); ?>
                </a>
            </div>
            <?php } elseif($i>3 && $userinfo->roles[0] == "author"){ if($i==6){$i=1;} else {$i++;} ?>
                <div class="mosaic-block fade member-wrap" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF;">
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
            <div class="member-wrap" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF;">
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
    <article id="post-<?php the_ID(); ?>" <?php post_class($classname); ?>>
        <?php if($show_title) : ?>
        <?php get_template_part( 'layouts/content.post.featured' ); ?>
        
        <header>
            <?php get_template_part( 'layouts/content.post.header' ); ?>
        </header>
        <?php endif; ?>

        <section class="content">
            <?php the_content(); ?>
            
            <?php gk_post_fields(); ?>
            <?php gk_post_links(); ?>
        </section>
        
        <?php get_template_part( 'layouts/content.post.footer' ); ?>
    </article>
<?php } ?>
