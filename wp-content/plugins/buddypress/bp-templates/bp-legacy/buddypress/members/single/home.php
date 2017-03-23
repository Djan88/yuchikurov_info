<div id="item-nav" class="member-nav">
        <div class="item-list-tabs no-ajax" id="object-nav" role="navigation">
                <ul class="master_nav">

                        <?php bp_get_displayed_user_nav(); ?>

                        <?php do_action( 'bp_member_options_nav' ); ?>
                    
                        <?php if(bp_get_displayed_user_username() == 'admin') { ?>
                        <li><a href="https://www.youtube.com/user/ThePractik01/">Видео</a></li>
                        <?php } ?>

                        <?php if(bp_is_my_profile() && pc_get_userrole(bp_displayed_user_id()) == 'author') { ?>
                        <li><a href="/wp-admin/edit.php">+ новость</a></li>
                        <li><a href="/wp-admin/edit.php">+ прием. день</a></li>
                        <?php } ?>

                </ul>
        </div>
</div><!-- #item-nav -->
<div id="buddypress" class="member-buddypress">

	<?php do_action( 'bp_before_member_home_content' ); ?>
        <?php if(bp_is_user_profile()){ ?>
	<div id="item-header" role="complementary">
                
		<?php bp_get_template_part( 'members/single/member-header' ) ?>

	</div><!-- #item-header -->
        <?php } ?>

	

	<div id="item-body" role="main">

		<?php do_action( 'bp_before_member_body' );
                
                
		if ( bp_is_user_activity() || !bp_current_component() ) :
			bp_get_template_part( 'members/single/activity' );

		elseif ( bp_is_user_blogs() ) :
			bp_get_template_part( 'members/single/blogs'    );

		elseif ( bp_is_user_friends() ) :
			bp_get_template_part( 'members/single/friends'  );

		elseif ( bp_is_user_groups() ) :
			bp_get_template_part( 'members/single/groups'   );

		elseif ( bp_is_user_messages() ) :
			bp_get_template_part( 'members/single/messages' );

		elseif ( bp_is_user_profile() ) :
			//bp_get_template_part( 'members/single/profile'  );

		elseif ( bp_is_user_forums() ) :
			bp_get_template_part( 'members/single/forums'   );

		elseif ( bp_is_user_notifications() ) :
			bp_get_template_part( 'members/single/notifications' );

		elseif ( bp_is_user_settings() ) :
			bp_get_template_part( 'members/single/settings' );

		// If nothing sticks, load a generic template
		else :
			bp_get_template_part( 'members/single/plugins'  );

		endif;

		do_action( 'bp_after_member_body' ); ?>

	</div><!-- #item-body -->

	<?php do_action( 'bp_after_member_home_content' ); ?>

</div><!-- #buddypress -->
