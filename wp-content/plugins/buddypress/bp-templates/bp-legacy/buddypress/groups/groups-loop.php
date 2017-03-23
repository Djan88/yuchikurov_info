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
                        <div class="porfolio_smallbox seminar_linear" data-filter="<?php echo $master_filter; ?>">
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
                                            <span class="fa fa-phone"></span> <?php bp_group_master_telephone(); ?> | <span class="fa fa-envelope"></span> <a href="mailto:yuchikurov@gmail.com">yuchikurov@gmail.com</a>
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

