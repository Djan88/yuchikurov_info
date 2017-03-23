<?php

/**
 * BuddyPress - Members Loop
 *
 * Querystring is set via AJAX in _inc/ajax.php - bp_legacy_theme_object_filter()
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>
<?php do_action( 'bp_before_members_loop' ); ?>

<?php if ( bp_has_members( bp_ajax_querystring( 'members' ) ) ) : ?>

	<?php do_action( 'bp_before_directory_members_list' ); ?>

	<ul id="members-list" class="item-list hidden" role="main">
    <script>
        jQuery('.users-preview').removeClass('hidden');
    </script>

	<?php while ( bp_members() ) : bp_the_member(); ?>
                       
            <?php if(bp_get_member_user_id() !== 1){ 
                
                $username = bp_get_member_user_login();
                $userinfo = get_userdatabylogin($username);
                
                $vkontakte = xprofile_get_field_data(12, bp_get_member_user_id());
                $facebook = xprofile_get_field_data(13, bp_get_member_user_id());
                $youtube = xprofile_get_field_data(14, bp_get_member_user_id());
                $email = xprofile_get_field_data(8, bp_get_member_user_id());
                $phone = xprofile_get_field_data(9, bp_get_member_user_id());
                $site = xprofile_get_field_data(11, bp_get_member_user_id());
                $home_country = xprofile_get_field_data(16, bp_get_member_user_id());
                $home_city = xprofile_get_field_data(17, bp_get_member_user_id());
                $image_country = get_image_country(xprofile_get_field_data(16, bp_get_member_user_id()));
                
                if($userinfo->roles[0] == "author"){
            ?>

		<li>
			<div class="item-avatar">
				<a href="<?php bp_member_permalink(); ?>"><?php bp_member_avatar(); ?></a>
			</div>

			<div class="item">
				<div class="item-title">
					<a href="<?php bp_member_permalink(); ?>"><?php bp_member_name(); ?></a>
				
                                        <?php if($vkontakte){ ?>
                                            <a class="social-member-button" href="<?php echo $vkontakte; ?>"><i class="icon-vk"></i></a></a>
                                        <?php } ?>

                                        <?php if($facebook){ ?>
                                            <a class="social-member-button" href="<?php echo $facebook; ?>"><i class="icon-facebook"></i></a>
                                        <?php } ?>

                                        <?php if($youtube){ ?>
                                            <a class="social-member-button" href="<?php echo $youtube; ?>"><i class="icon-youtube"></i></a>
                                        <?php } ?>
                                            
                                </div>
                            <?php if($image_country){ ?>
                            <p><img src="/wp-content/themes/Msocial/images/flag/<?php echo $image_country; ?>.png"><?php echo $home_country.','; ?> <?php echo $home_city; ?></p>
                            <?php } ?>
                            <?php if($email){ ?>
                            <p><i class="icon-envelope"></i><a href="mail:<?php echo $email; ?>"><?php echo $email; ?></a></p>
                            <?php } ?>
                            <?php if($phone){ ?>
                            <p><i class="icon-phone"></i><?php echo $phone; ?></p>
                            <?php } ?>
                            <?php if($site){ ?>
                            <p><i class="icon-globe"></i><a class="member-site" href="#" id="<?php echo $site; ?>"><?php echo $site; ?></a></p>
                            <?php } ?>
			</div>


			<div class="clear"></div>
		</li>
                
                <?php } } ?>

	<?php endwhile; ?>

	</ul>

        <?php $masters_ar = get_subscriber_user(); ?>

        <?php foreach ($masters_ar as $country => $value){ ?>
<div class="container padding-box">
<div class="grey-color" id="team">
    <div class="container padding-box">
        <div class="row header">
            <article class="col-xs-12 textbox text-center">
                <h2 class="black"><?php echo $country; ?></h2>
                <?php foreach ($value as $state => $masters){ ?>
                <h3 class="master_city"><?php echo $state; ?></h3>
            </article>  
                <div class="team-box col-xs-12 clearfix">
                    <?php foreach ($masters as $master){ ?>
                        <?php if(!empty($master['name'])){ ?>
                        <aside class="team-profile col-sm-3 col-xs-12">
                            <a href="<?php echo $master['link']; ?>">
                            <div class="image-holder"><?php echo $master['avatar']; ?></div>
                            <div class="team-info text-center">
                            <h4><?php echo $master['name']; ?></h4>
                            <?php if($master['email']){ ?>
                                <p><i class="icon-envelope" style="padding-right: 5px;"></i><a href="mailto:<?php echo $master['email']; ?>"><?php echo $master['email']; ?></a></p>
                            <?php } else { ?>
                                <p><i class="icon-phone"></i><?php echo $master['phone']; ?></p>   
                            <?php } ?>
                            </div>
                            </a>
                        </aside>
                        <?php } ?>
                    <?php } ?>
                </div>
                <div class="clear"></div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
            
            <?php } ?>
            

	<?php do_action( 'bp_after_directory_members_list' ); ?>

	<?php bp_member_hidden_fields(); ?>

<?php else: ?>

	<div id="message" class="info">
		<p><?php _e( "Sorry, no members were found.", 'buddypress' ); ?></p>
	</div>

<?php endif; ?>

<?php do_action( 'bp_after_members_loop' ); ?>
