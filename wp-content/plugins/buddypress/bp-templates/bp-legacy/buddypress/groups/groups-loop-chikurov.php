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
            $seminar_count = 0;
            
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

	<div class="col-xs-12 masonry-portfolio" id="porfolio-masonry">

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
                $chikurov_id = $group->admins[0]->user_id;
                if(bp_displayed_user_id() == 0 || bp_displayed_user_id() == $group->admins[0]->user_id){
            ?>

        <?php if($chikurov_id == 1) { ?>
		<div class="porfolio_smallbox col-sm-4 col-xs-12" data-filter="development">
			<div class="top-section seminar_section">
                <a href="<?php bp_group_permalink(); ?>"><?php bp_group_avatar( 'type=full&width=false&height=false' ); ?></a>
                <div class="seminar_sum">
                    <div class="seminar_name"><a href="<?php bp_group_permalink(); ?>"><?php bp_group_name(); ?></a></div>
                    <div class="seminar_autor">Ведущий: <?php echo bp_core_get_userlink($group->admins[0]->user_id); if($group->admins[1]->user_id){ echo ', '.bp_core_get_userlink($group->admins[1]->user_id); } ?></div>
                    <div class="seminar_description hidden"><?php bp_group_description_excerpt(); ?></div>
                    <div class="seminar_location"><?= $city; ?> | <span class="seminar_date"><?= $date_seminar; ?> - <?= $date_end; ?></span></div>
                </div>
            </div>
            <!--showcasebox--> 

			<div class="clear"></div>
		</div>
        <?php $seminar_count +=1 ;?>
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

