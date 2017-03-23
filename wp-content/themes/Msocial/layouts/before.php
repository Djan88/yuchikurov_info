<?php 
	
	/**
	 *
	 * Template elements before the page content
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
	// disable direct access to the file	
	defined('GAVERN_WP') or die('Access denied');
	
?>

		<div class="gk-page-wrap<?php if(gk_is_active_sidebar('bottom5') || gk_is_active_sidebar('bottom6')) : ?> gk-footer-border<?php endif; ?>">
			<!-- Mainbody -->			
			<?php if(is_page(1316)) { ?>
				<div class="users-preview hidden">
					<div id="gk-mainbody-columns">
						<h1 style="font-size: 26px;">ПЕРСОНАЛЬНЫЕ СТРАНИЦЫ МАСТЕРОВ</h1>
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
						        <div class="member-wrap" style="width: 32.8%; display: inline-block; margin-right: -4px; margin-bottom: -8px; background: #fff; border: 2px solid #DFDFDF; height: 134px;">
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
					</div>		
			<?php } ?>
			<div id="gk-mainbody-columns" <?php if(get_option($tpl->name . '_page_layout', 'right') == 'left') : ?> class="gk-column-left"<?php endif; ?>>
				<section>
					<?php if(gk_is_active_sidebar('top1')) : ?>
					<div id="gk-top1">
						<div class="widget-area">
							<?php gk_dynamic_sidebar('top1'); ?>
						</div>
					</div>
					<?php endif; ?>
					
					<?php if(gk_is_active_sidebar('top2')) : ?>
					<div id="gk-top2">
						<div class="widget-area">
							<?php gk_dynamic_sidebar('top2'); ?>
						</div>
					</div>
					<?php endif; ?>
				
					<?php if(gk_is_active_sidebar('mainbody_top')) : ?>
					<div id="gk-mainbody-top">
						<?php gk_dynamic_sidebar('mainbody_top'); ?>
					</div>
					<?php endif; ?>
