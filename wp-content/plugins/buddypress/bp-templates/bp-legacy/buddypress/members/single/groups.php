<?php

/**
 * BuddyPress - Users Groups
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="item-list-tabs no-ajax" id="subnav" role="navigation">
    <?php if ( bp_is_my_profile() ) { ?>
    <a class="btn btn-warning" href="/seminar/create/">Создать семинар</a>
    <?php } ?>
    
</div><!-- .item-list-tabs -->

<?php

switch ( bp_current_action() ) :

	// Home/My Groups
	case 'my-groups' :
		do_action( 'bp_before_member_groups_content' ); ?>

		<div class="groups mygroups">

			<?php bp_get_template_part( 'groups/groups-loop' ); ?>

		</div>

		<?php do_action( 'bp_after_member_groups_content' );
		break;

	// Group Invitations
	case 'invites' :
		bp_get_template_part( 'members/single/groups/invites' );
		break;

	// Any other
	default :
		bp_get_template_part( 'members/single/plugins' );
		break;
endswitch;
