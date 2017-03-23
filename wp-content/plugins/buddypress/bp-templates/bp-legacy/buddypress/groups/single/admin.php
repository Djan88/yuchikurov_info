<div class="container padding-box" id="contact-form">
<div class="row">
  <article class="col-xs-12 textbox text-center">
    <h2 class="black"><a class="anchor" href="/" name="edit_seminar"></a>Редактировать семинар</h2>
    <div class="col-sm-9 col-xs-12 inquiry-form">
<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
	<div class="btn-group edit_event_list">
		<?php bp_group_admin_tabs(); ?>
	</div>
</div><!-- .item-list-tabs -->

<form action="<?php bp_group_admin_form_action(); ?>" name="group-settings-form" id="test group-settings-form" class="standard-form" method="post" enctype="multipart/form-data" role="main">
    <input type="hidden" name="group_id" value="<?php bp_group_id(); ?>">
<?php do_action( 'bp_before_group_admin_content' ); ?>

<?php /* Edit Group Details */ ?>
<?php if ( bp_is_group_admin_screen( 'edit-details' ) ) : ?>

	<?php do_action( 'bp_before_group_details_admin' ); ?>
	<table class="table table-striped table-hover table-bordered">
	  <tr>
	  	<td style="width: 30%;"><label for="group-name"><?php _e( 'Group Name (required)', 'buddypress' ); ?></label></td>
	  	<td><input style="width: 100%;" type="text" name="group-name" id="group-name" value="<?php bp_group_name(); ?>" aria-required="true" /></td>
	  </tr>
	  <tr>
	  	<td><label for="group-desc"><?php _e( 'Group Description (required)', 'buddypress' ); ?></label></td>
	  	<td><textarea name="group-desc" id="group-desc" aria-required="true"><?php bp_group_description_editable(); ?></textarea></td>
	  </tr>
		<tr>
			<td><label for="group-for-whom">Для кого предназначен семинар:</label></td>
			<td><textarea name="group-for-whom" id="group-for-whom" aria-required="true"><?php bp_group_for_whom(); ?></textarea></td>
		</tr>
		<tr>
			<td style="width: 30%;"><label for="group-place">Место проведения</label></td>
			<td><input style="width: 100%;" type="text" name="group-place" id="group-place" value="<?php bp_group_place(); ?>" /></td>
		</tr>
		<tr>
			<td style="width: 30%;"><label for="group-place-coordinates">Координаты места проведения</label></td>
			<td><input style="width: 100%;" type="text" name="group-place-coordinates" id="group-place-coordinates" value="<?php bp_group_place_coordinates(); ?>" /></td>
		</tr>
		<?php do_action( 'groups_custom_group_fields_editable' ); ?>
		<tr>
			<td colspan="2" style="width: 30%;"><label for="group-place">Данные организатора</label></td>
		</tr>
		<tr>
			<td style="width: 30%;"><label for="group-master-fio">ФИО</label></td>
			<td><input style="width: 100%;" type="text" name="group-master-fio" id="group-master-fio" value="<?php bp_group_master_fio(); ?>" /></td>
		</tr>
		<tr>
			<td style="width: 30%;"><label for="group-master-telephone">Телефон</label></td>
			<td><input style="width: 100%;" type="text" name="group-master-telephone" id="group-master-telephone" value="<?php bp_group_master_telephone(); ?>" /></td>
		</tr>
		<tr>
			<td style="width: 30%;"><label for="group-master-email">E-mail</label></td>
			<td><input style="width: 100%;" type="text" name="group-master-email" id="group-master-email" value="<?php bp_group_master_email(); ?>" /></td>
		</tr>

	  <tr>
	  	<td colspan="2">
	  		<label for="group-notifiy-members">
	  			<input type="checkbox" name="group-notify-members" value="1" /> <?php _e( 'Notify group members of these changes via email', 'buddypress' ); ?>
	  		</label>
	  	</td>
	  </tr>
	  <tr>
	  	<td colspan="2">
	  		<?php do_action( 'bp_after_group_details_admin' ); ?>

	  		<p><input type="submit" class="btn btn-primary btn-lg" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" id="save" name="save" /></p>
	  	</td>
	  </tr>
	</table>

	
	<?php wp_nonce_field( 'groups_edit_group_details' ); ?>

<?php endif; ?>

<?php /* Manage Group Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-settings' ) ) : ?>

	<?php do_action( 'bp_before_group_settings_admin' ); ?>

	<?php if ( bp_is_active( 'forums' ) ) : ?>

		<?php if ( bp_forums_is_installed_correctly() ) : ?>

			<div class="checkbox">
				<label><input type="checkbox" name="group-show-forum" id="group-show-forum" value="1"<?php bp_group_show_forum_setting(); ?> /> <?php _e( 'Enable discussion forum', 'buddypress' ); ?></label>
			</div>

			<hr />

		<?php endif; ?>

	<?php endif; ?>
	<table class="table table_event_edit table-bordered table-striped table-hover">
		<tr>
			<th colspan="3"><h4><?php _e( 'Privacy Options', 'buddypress' ); ?></h4></th>
		</tr>
		<tr>
			<td colspan="3">
				<label class="edit_list_privat">
					<input type="radio" name="group-status" value="public"<?php bp_group_show_status_setting( 'public' ); ?> />
					<strong><?php _e( 'This is a public group', 'buddypress' ); ?></strong>
					<ul>
						<li><?php _e( 'Any site member can join this group.', 'buddypress' ); ?></li>
						<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'buddypress' ); ?></li>
						<li><?php _e( 'Group content and activity will be visible to any site member.', 'buddypress' ); ?></li>
					</ul>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label class="edit_list_privat">
					<input type="radio" name="group-status" value="private"<?php bp_group_show_status_setting( 'private' ); ?> />
					<strong><?php _e( 'This is a private group', 'buddypress' ); ?></strong>
					<ul>
						<li><?php _e( 'Only users who request membership and are accepted can join the group.', 'buddypress' ); ?></li>
						<li><?php _e( 'This group will be listed in the groups directory and in search results.', 'buddypress' ); ?></li>
						<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'buddypress' ); ?></li>
					</ul>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<label class="edit_list_privat">
					<input type="radio" name="group-status" value="hidden"<?php bp_group_show_status_setting( 'hidden' ); ?> />
					<strong><?php _e( 'This is a hidden group', 'buddypress' ); ?></strong>
					<ul>
						<li><?php _e( 'Only users who are invited can join the group.', 'buddypress' ); ?></li>
						<li><?php _e( 'This group will not be listed in the groups directory or search results.', 'buddypress' ); ?></li>
						<li><?php _e( 'Group content and activity will only be visible to members of the group.', 'buddypress' ); ?></li>
					</ul>
				</label>
			</td>
		</tr>
		<tr>
			<th colspan="3"><h4><?php _e( 'Group Invitations', 'buddypress' ); ?></h4></th>
		</tr>
		<tr>
			<td colspan="3"><?php _e( 'Which members of this group are allowed to invite others?', 'buddypress' ); ?></td>
		</tr>
		<tr>
			<td>
				<label>
					<input type="radio" name="group-invite-status" value="members"<?php bp_group_show_invite_status_setting( 'members' ); ?> />
					<strong><?php _e( 'All group members', 'buddypress' ); ?></strong>
				</label>
			</td>
			<td>
				<label>
					<input type="radio" name="group-invite-status" value="mods"<?php bp_group_show_invite_status_setting( 'mods' ); ?> />
					<strong><?php _e( 'Group admins and mods only', 'buddypress' ); ?></strong>
				</label>
			</td>
			<td>
				<label>
					<input type="radio" name="group-invite-status" value="admins"<?php bp_group_show_invite_status_setting( 'admins' ); ?> />
					<strong><?php _e( 'Group admins only', 'buddypress' ); ?></strong>
				</label>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<?php do_action( 'bp_after_group_settings_admin' ); ?>
				<input type="submit" class="btn btn-primary btn-lg" value="<?php _e( 'Save Changes', 'buddypress' ); ?>" id="save" name="save" />
				<?php wp_nonce_field( 'groups_edit_group_settings' ); ?>
			</td>
		</tr>
	</table>

<?php endif; ?>

<?php /* Group Avatar Settings */ ?>
<?php if ( bp_is_group_admin_screen( 'group-avatar' ) ) : ?>
	<table class="table table_event_edit table-bordered table-striped table-hover">
		
			<?php if ( 'upload-image' == bp_get_avatar_admin_step() ) : ?>
				<tr>
					<td><?php _e("Upload an image to use as an avatar for this group. The image will be shown on the main group page, and in search results.", 'buddypress' ); ?></td>
				</tr>
				<tr>
					<td>
						<input style="margin: 15px auto;" type="file" name="file" id="file" />
						<input type="submit" class="btn btn-primary" name="upload" id="upload" value="<?php _e( 'Upload Image', 'buddypress' ); ?>" />
						<input type="hidden" name="action" id="action" value="bp_avatar_upload" />
					</td>
				</tr>
					<?php if ( bp_get_group_has_avatar() ) : ?>
				<tr>
						<td><?php _e( "If you'd like to remove the existing avatar but not upload a new one, please use the delete avatar button.", 'buddypress' ); ?>

						<?php bp_button( array( 'id' => 'delete_group_avatar', 'component' => 'groups', 'wrapper_id' => 'delete-group-avatar-button', 'link_class' => 'edit btn btn-primary', 'link_href' => bp_get_group_avatar_delete_link(), 'link_title' => __( 'Delete Avatar', 'buddypress' ), 'link_text' => __( 'Delete Avatar', 'buddypress' ) ) ); ?></td>
				</tr>
					<?php endif; ?>

					<?php wp_nonce_field( 'bp_avatar_upload' ); ?>

			<?php endif; ?>
			<?php if ( 'crop-image' == bp_get_avatar_admin_step() ) : ?>
				<tr>
					<td>
						<h4><?php _e( 'Crop Avatar', 'buddypress' ); ?></h4>
					</td>
				</tr>
				
				<tr>
					<td>
						<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-to-crop" class="avatar" alt="<?php _e( 'Avatar to crop', 'buddypress' ); ?>" />
					</td>
				</tr>
				
				<tr>
					<div id="avatar-crop-pane">
						<img src="<?php bp_avatar_to_crop(); ?>" id="avatar-crop-preview" class="avatar" alt="<?php _e( 'Avatar preview', 'buddypress' ); ?>" />
					</div>
				</tr>
				
				<tr>
					<td>
						<input type="submit" name="avatar-crop-submit" id="avatar-crop-submit" value="<?php _e( 'Crop Image', 'buddypress' ); ?>" />

						<input type="hidden" name="image_src" id="image_src" value="<?php bp_avatar_to_crop_src(); ?>" />
						<input type="hidden" id="x" name="x" />
						<input type="hidden" id="y" name="y" />
						<input type="hidden" id="w" name="w" />
						<input type="hidden" id="h" name="h" />

						<?php wp_nonce_field( 'bp_avatar_cropstore' ); ?>
					</td>
				</tr>
				
			<?php endif; ?>
		
	</table>

<?php endif; ?>

<?php /* Manage Group Members */ ?>
<?php if ( bp_is_group_admin_screen( 'manage-members' ) ) : ?>

	<?php do_action( 'bp_before_group_manage_members_admin' ); ?>
	<table class="table table_event_edit table-bordered table-striped table-hover">
		<tr>
			<th colspan="2"><h4><?php _e( 'Administrators', 'buddypress' ); ?></h4></th>
		</tr>
		<?php if ( bp_has_members( '&include='. bp_group_admin_ids() ) ) : ?>

			<?php while ( bp_members() ) : bp_the_member(); ?>
			<tr>
				<td>
				<?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'full', 'width' => 120, 'height' => 120, 'alt' => sprintf( __( 'Profile picture of %s', 'buddypress' ), bp_get_member_name() ) ) ); ?></td>
				<td>
				<h5>
					<a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
					<?php if ( count( bp_group_admin_ids( false, 'array' ) ) > 1 ) : ?>
					<span class="small">
						<a class="button confirm admin-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', 'buddypress' ); ?></a>
					</span>
					<?php endif; ?>
				</h5>
				</td>
			</tr>
			<?php endwhile; ?>

		<?php endif; ?>
		<?php if ( bp_group_has_moderators() ) : ?>
			<tr>
				<td colspan="2"><h4><?php _e( 'Moderators', 'buddypress' ); ?></h4></td>
			</tr>
			<?php if ( bp_has_members( '&include=' . bp_group_mod_ids() ) ) : ?>

					<?php while ( bp_members() ) : bp_the_member(); ?>
					<tr>
						<td>
							<?php echo bp_core_fetch_avatar( array( 'item_id' => bp_get_member_user_id(), 'type' => 'full', 'width' => 120, 'height' => 120, 'alt' => sprintf( __( 'Profile picture of %s', 'buddypress' ), bp_get_member_name() ) ) ); ?>
						</td>
						<td>
							<h5>
								<a href="<?php bp_member_permalink(); ?>"> <?php bp_member_name(); ?></a>
								<span class="small">
									<a href="<?php bp_group_member_promote_admin_link( array( 'user_id' => bp_get_member_user_id() ) ); ?>" class="button confirm mod-promote-to-admin" title="<?php _e( 'Promote to Admin', 'buddypress' ); ?>"><?php _e( 'Promote to Admin', 'buddypress' ); ?></a>
									<a class="button confirm mod-demote-to-member" href="<?php bp_group_member_demote_link( bp_get_member_user_id() ); ?>"><?php _e( 'Demote to Member', 'buddypress' ); ?></a>
								</span>
							</h5>
						</td>
					</tr>
					<?php endwhile; ?>

			<?php endif; ?>

		<?php endif ?>
			<tr>
				<th colspan="2"><h4><?php _e("Members", "buddypress"); ?></h4></th>
			</tr>
			
			<?php if ( bp_group_has_members( 'per_page=15&exclude_banned=false' ) ) : ?>

				<?php if ( bp_group_member_needs_pagination() ) : ?>

					<tr>

						<td>
							<?php bp_group_member_pagination_count(); ?>
						</td>

						<td>
							<?php bp_group_member_admin_pagination(); ?>
						</td>

					</tr>

				<?php endif; ?>

					<?php while ( bp_group_members() ) : bp_group_the_member(); ?>
					<tr>
						<td>
							<?php bp_group_member_avatar_mini(); ?>
						</td>
						<td>
							<h5>
								<?php bp_group_member_link(); ?>

								<?php if ( bp_get_group_member_is_banned() ) _e( '(banned)', 'buddypress' ); ?>

								<span class="small">

								<?php if ( bp_get_group_member_is_banned() ) : ?>

									<a href="<?php bp_group_member_unban_link(); ?>" class="button confirm member-unban" title="<?php _e( 'Unban this member', 'buddypress' ); ?>"><?php _e( 'Remove Ban', 'buddypress' ); ?></a>

								<?php else : ?>

									<a href="<?php bp_group_member_ban_link(); ?>" class="button confirm member-ban" title="<?php _e( 'Kick and ban this member', 'buddypress' ); ?>"><?php _e( 'Kick &amp; Ban', 'buddypress' ); ?></a>
									<a href="<?php bp_group_member_promote_mod_link(); ?>" class="button confirm member-promote-to-mod" title="<?php _e( 'Promote to Mod', 'buddypress' ); ?>"><?php _e( 'Promote to Mod', 'buddypress' ); ?></a>
									<a href="<?php bp_group_member_promote_admin_link(); ?>" class="button confirm member-promote-to-admin" title="<?php _e( 'Promote to Admin', 'buddypress' ); ?>"><?php _e( 'Promote to Admin', 'buddypress' ); ?></a>

								<?php endif; ?>

									<a href="<?php bp_group_member_remove_link(); ?>" class="button confirm" title="<?php _e( 'Remove this member', 'buddypress' ); ?>"><?php _e( 'Remove from group', 'buddypress' ); ?></a>

									<?php do_action( 'bp_group_manage_members_admin_item' ); ?>

								</span>
							</h5>
						</td>
					</tr>

					<?php endwhile; ?>

			<?php else: ?>

				<tr>
					<td colspan="2"><?php _e( 'This group has no members.', 'buddypress' ); ?></td>
				</tr>

			<?php endif; ?>

	</table>


	

	<?php do_action( 'bp_after_group_manage_members_admin' ); ?>

<?php endif; ?>

<?php /* Manage Membership Requests */ ?>
<?php if ( bp_is_group_admin_screen( 'membership-requests' ) ) : ?>

	<?php do_action( 'bp_before_group_membership_requests_admin' ); ?>

	<?php if ( bp_group_has_membership_requests() ) : ?>

		<ul id="request-list" class="item-list">
			<?php while ( bp_group_membership_requests() ) : bp_group_the_membership_request(); ?>

				<li>
					<?php bp_group_request_user_avatar_thumb(); ?>
					<h4><?php bp_group_request_user_link(); ?> <span class="comments"><?php bp_group_request_comment(); ?></span></h4>
					<span class="activity"><?php bp_group_request_time_since_requested(); ?></span>

					<?php do_action( 'bp_group_membership_requests_admin_item' ); ?>

					<div class="action">

						<?php bp_button( array( 'id' => 'group_membership_accept', 'component' => 'groups', 'wrapper_class' => 'accept', 'link_href' => bp_get_group_request_accept_link(), 'link_title' => __( 'Accept', 'buddypress' ), 'link_text' => __( 'Accept', 'buddypress' ) ) ); ?>

						<?php bp_button( array( 'id' => 'group_membership_reject', 'component' => 'groups', 'wrapper_class' => 'reject', 'link_href' => bp_get_group_request_reject_link(), 'link_title' => __( 'Reject', 'buddypress' ), 'link_text' => __( 'Reject', 'buddypress' ) ) ); ?>

						<?php do_action( 'bp_group_membership_requests_admin_item_action' ); ?>

					</div>
				</li>

			<?php endwhile; ?>
		</ul>

	<?php else: ?>

		<div id="message" class="info">
			<p><?php _e( 'There are no pending membership requests.', 'buddypress' ); ?></p>
		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_group_membership_requests_admin' ); ?>

<?php endif; ?>

<?php do_action( 'groups_custom_edit_steps' ) // Allow plugins to add custom group edit screens ?>

<?php /* Delete Group Option */ ?>
<?php if ( bp_is_group_admin_screen( 'delete-group' ) ) : ?>

	<?php do_action( 'bp_before_group_delete_admin' ); ?>

	<div id="message" class="info">
		<p><?php _e( 'WARNING: Deleting this group will completely remove ALL content associated with it. There is no way back, please be careful with this option.', 'buddypress' ); ?></p>
	</div>

	<label><input type="checkbox" name="delete-group-understand" id="delete-group-understand" value="1" onclick="if(this.checked) { document.getElementById('delete-group-button').disabled = ''; } else { document.getElementById('delete-group-button').disabled = 'disabled'; }" /> <?php _e( 'I understand the consequences of deleting this group.', 'buddypress' ); ?></label>

	<?php do_action( 'bp_after_group_delete_admin' ); ?>

	<div class="submit">
		<input type="submit" disabled="disabled" value="<?php _e( 'Delete Group', 'buddypress' ); ?>" id="delete-group-button" name="delete-group-button" />
	</div>

	<?php wp_nonce_field( 'groups_delete_group' ); ?>

<?php endif; ?>

<?php /* This is important, don't forget it */ ?>
	<input type="hidden" name="group-id" id="group-id" value="<?php bp_group_id(); ?>" />

<?php do_action( 'bp_after_group_admin_content' ); ?>

</form><!-- #group-settings-form -->
         </div>
       </article>
     </div>
     <!--container--> 
     </div>       
	<!--grey-color-->
