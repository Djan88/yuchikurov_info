<?php

/**
 * BuddyPress - Groups Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_groups_loop' ); ?>

<?php if ( bp_has_groups() ) : ?>

        <?php
        
            $user_id = bp_displayed_user_id();
            $user_name = bp_get_displayed_user_username();
            
            if($user_id !== 0){
                
                $group_ids =  groups_get_user_groups( $user_id );
                $groups_city = array();
                $date_now = date('Y-m-d');
                
                foreach( $group_ids["groups"] as $id ) {
                    
                    $date_start = groups_get_groupmeta( $id, 'group_plus_header_fieldone');
                    
                    
                    if($date_start >= $date_now){
                                        
                        $groups_city[] = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                    
                    }
                    
                }
                
                
            
            
                $city_groups = array_unique($groups_city);
                echo '<div class="filter-city">';
                echo '<a href="/members/'.$user_name.'/groups/">Все семинары</a>';
                foreach ($city_groups as $city_group){
                    echo '<span id="'.$city_group.'">'.$city_group.'</span>';
                }
                echo '</div>';
            
            }
        
        ?>

	<?php do_action( 'bp_before_directory_groups_list' ); ?>
        <input type="hidden" name="user_id" id="user-id" value="<?php echo $user_id;?>">

	<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 rasp-wrap masonry-portfolio" id="porfolio-masonry">

	<?php while ( bp_groups() ) : bp_the_group(); ?>
            
            <?php
                global $bp;
                $group = groups_get_group( array( 'group_id' => bp_get_group_id() ) );
                
                $date_end = strtotime(groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldtwo'));
                $seminar_id = bp_get_group_id();
                $date_now = date('Y-m-d');
                $dateNow = strtotime($date_now);
                if($date_end > $dateNow){
                $date_end = rdate('d M, Y', $date_end);
                $city = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldthree');
                $date = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldone');
                $min_date = strtotime($date);
                $date_seminar = rdate('d M, Y', $min_date);
                $date_seminar_day = rdate('d', $min_date);
                $date_seminar_month = rdate('m', $min_date);
                $master_id = $group->admins[0]->user_id;
                if ($master_id == 1){
                    $master_filter = 'chicurov';
                } else if ($master_id == 7){
                    $master_filter = 'voloshin';
                } else if ($master_id == 11){
                    $master_filter = 'ivanova';
                } else if ($master_id == 9){
                    $master_filter = 'milakova';
                } else if ($master_id == 5){
                    $master_filter = 'seregina';
                } else if ($master_id == 4149){
                    $master_filter = 'kislitsin';
                } else if ($master_id == 1033){
                    $master_filter = 'malyy';
                }
                if(bp_displayed_user_id() == 0 || bp_displayed_user_id() == $group->admins[0]->user_id){ ?>
                    <?php if ($master_id == 1 || $master_id == 7 || $master_id == 11 || $master_id == 9 || $master_id == 5 || $master_id == 4149 || $master_id == 1033) { ?>
                        <div data-toggle="modal" data-target="#myModal-<?php echo $seminar_id;?>" class="porfolio_smallbox seminar_linear" data-filter="<?php echo $master_filter; ?>">
                            <div class="row">
                                <div class="col-md-2 col-sm-2 col-xs-2 text-center rasp-date">
                                    <div class="rasp_d_i_m">
                                        <span class="rasp_d">
                                            <?php echo $date_seminar_day;?>
                                        </span> 
                                        <span class="devider">/</span>
                                        <span class="devider_small">—</span> 
                                        <span class="rasp_m">
                                            <?php echo $date_seminar_month;?>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-8 col-sm-7 col-xs-7" style="padding-top: 10px; text-align: left;">
                                    <div class="rasp-title"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>
                                    <div class="rasp-content">
                                        <div class="rasp-time">
                                            <span class="fa fa-calendar"></span> <?php echo $date_seminar;?> — <?php echo $date_end;?> | 
                                        </div>
                                        <div class="rasp-adress">
                                            <span class="fa fa-map-marker"></span>  <?= $city; ?></div>
                                    </div>
                                    <div class="rasp-content">
                                        <div class="rasp-time">
                                            <span class="fa fa-phone" style="margin-right: 5px;"></span>
                                            <b>Запись: </b> 
                                            <?php if (bp_get_group_master_telephone()) { ?>
                                              <i class="icon-phone" style="margin-right: 10px;"></i><?php bp_group_master_telephone(); ?>
                                            <?php } else if ($org_yes) { ?>
                                              <i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->mods[0]->user_id); ?>
                                            <?php } else { ?>
                                              <i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->admins[0]->user_id); ?>
                                            <?php } ?> 
                                            | <span class="fa fa-envelope"></span> 
                                            <?php if (bp_get_group_master_email()) { ?>
                                              <a href="mailto:<?php bp_group_master_email(); ?>"><?php bp_group_master_email(); ?></a>
                                            <?php } else if ($org_yes) { ?>
                                              <a href="mailto:<?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?>"><?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?></a>
                                            <?php } else { ?>
                                              <a href="mailto:<?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?>"><?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?></a>
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <div class="rasp-content">
                                        <div class="rasp-time">
                                            <span class="fa fa-user" style="margin-right: 5px;"></span><b>Читает: </b> <a href="<?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = false, $just_link = true); ?>"><?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = true, $just_link = false); ?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-3 col-xs-3 text-center rasp-img">
                                    <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=thumbnail&width=100&height=100' ); ?></a>           
                                </div>

                            </div>
                            <!--showcasebox--> 

                            <div class="clear"></div>
                        </div>
                        <!-- Modal seminar -->
                        <div class="modal fade rasp-modal" id="myModal-<?php echo $seminar_id;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <div class="row">
                                    <div class="col-md-2 col-sm-2 col-xs-2 text-center rasp-date">
                                        <div class="rasp_d_i_m"><span class="rasp_d"><?php echo $date_seminar_day; ?></span> <span class="devider">/</span><span class="devider_small">—</span> <span class="rasp_m"><?php echo $date_seminar_month; ?></span></div>
                                    </div>
                                    <div class="col-md-8 col-sm-7 col-xs-7">
                                        <div class="rasp-title"><?php bp_group_name(); ?></div>
                                        <div class="rasp-content">
                                            <div class="rasp-time">
                                                <span class="fa fa-calendar"></span> <?php echo $date_seminar;?> — <?php echo $date_end;?>
                                            </div>
                                            <div class="rasp-adress">
                                                <span class="fa fa-map-marker"></span> 
                                                <?php if ( bp_get_group_place()) { ?>
                                                 <?php bp_group_place(); ?>
                                                <?php } else { ?>
                                                  <?php echo $city; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-sm-3 col-xs-3 text-center rasp-img">
                                        <?php bp_group_avatar( 'type=thumbnail&width=100&height=100' ); ?>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-body">
                                <div class="rasp-content">
                                    <?php bp_group_description(); ?>
                                </div>
                                <div class="rasp-details">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_time">
                                            <div class="rasp-details_title"><span class="fa fa-users"></span> НА КОГО ОРИЕНТИРОВАН?</div>
                                            <div class="rasp-details_content">
                                                <?php bp_group_for_whom(); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_location">
                                            <div class="rasp-details_title"><span class="fa fa-pencil-square-o"></span> КАК ЗАПИСАТЬСЯ?</div>
                                            <div class="rasp-details_content">
                                                <b style="font-size: 12px;">Предварительная запиcь обязательна</b></br>
                                                <span class="fa fa-phone"></span>
                                                <?php if (bp_get_group_master_telephone()) { ?>
                                                  <i class="icon-phone" style="margin-right: 10px;"></i><?php bp_group_master_telephone(); ?>
                                                <?php } else if ($org_yes) { ?>
                                                  <i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->mods[0]->user_id); ?>
                                                <?php } else { ?>
                                                  <i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->admins[0]->user_id); ?>
                                                <?php } ?> 
                                                </br>
                                                <span class="fa fa-envelope"></span> 
                                                <?php if (bp_get_group_master_email()) { ?>
                                                  <a href="mailto:<?php bp_group_master_email(); ?>"><?php bp_group_master_email(); ?></a>
                                                <?php } else if ($org_yes) { ?>
                                                  <a href="mailto:<?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?>"><?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?></a>
                                                <?php } else { ?>
                                                  <a href="mailto:<?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?>"><?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rasp-details">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_time">
                                            <div class="rasp-details_title"><span class="fa fa-calendar"></span> ДАТЫ СЕМИНАРА</div>
                                            <div class="rasp-details_content"><?php echo $date_seminar;?> — <?php echo $date_end;?></div>
                                        </div>
                                        <div class="col-md-6 col-sm-6 col-xs-6 rasp-details_location">
                                            <div class="rasp-details_title"><span class="fa fa-map-marker"></span> МЕСТО ПРОВЕДЕНИЯ</div>
                                            <div class="rasp-details_content">
                                                <?php if ( bp_get_group_place()) { ?>
                                                 <?php bp_group_place(); ?>
                                                <?php } else { ?>
                                                  <?php echo $city; ?>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="rasp-map">
                                    <?php $seminar_map = '[showyamap] [placemark coordinates="44.741156, 37.743110"/] [/showyamap]';?>
                                    <?php echo do_shortcode($seminar_map); ?>
                                </div>
                                <div class="rasp-order-title">
                                    <div class="rasp-details_title" style="padding-top: 10px;text-align: center;
                                    "><span class="fa fa-pencil"></span> ЗАДАТЬ ВОПРОС ИЛИ ОСТАВИТЬ ЗАЯВКУ</div>
                                </div>
                                <div class="rasp_order">
                                    <div class="row">
                                        <?php bp_group_place_coordinates(); ?>
                                        <?php //echo do_shortcode('[contact-form-7 id="3503" title="Запись на мастер класс"]'); ?>
                                    </div>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Закрыть</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    <?php } ?>

                <?php } } endwhile; ?>

	</div>
    <!--design_showcase--> 

	<?php do_action( 'bp_after_directory_groups_list' ); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( 'There were no groups found.', 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_groups_loop' ); ?>

