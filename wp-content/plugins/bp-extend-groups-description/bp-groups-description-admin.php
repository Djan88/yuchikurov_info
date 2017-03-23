<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Small admin area
 */

add_action('admin_init', 'bpgd_admin_init');
function bpgd_admin_init(){
    if (!bp_is_active( 'groups' )) {
        return;
    }

    // Add the main section
    add_settings_section(
        'bpgd_admin',
        __( 'BP Extend Groups Description', 'bpgd' ),
        'bpgd_admin_headline',
        'buddypress');

    add_settings_field(
        'bpgd_redactor',
        __('Rich Editor', 'bpgd'),
        'bpgd_admin_re',
        'buddypress',
        'bpgd_admin');
    add_settings_field(
        'bpgd_w_count',
        __('Words Counter', 'bpgd'),
        'bpgd_admin_wc',
        'buddypress',
        'bpgd_admin');
    add_settings_field(
        'bpgd_words',
        __('Description Excerpt', 'bpgd'),
        'bpgd_admin_wn',
        'buddypress',
        'bpgd_admin');

    register_setting('buddypress', 'bpgd_redactor', 'intval');
    register_setting('buddypress', 'bpgd_w_count',  'intval');
    register_setting('buddypress', 'bpgd_words',    'intval');
}

function bpgd_admin_headline(){
    echo '<p>' .
            __( 'You can modify here the plugin behaviour - enabling/disabling whatever is listed below.', 'bpgd' ) .
        '</p>';
}

function bpgd_admin_re(){ ?>
    <label>
        <input type="checkbox" name="bpgd_redactor"<?php checked( '1', bp_get_option( 'bpgd_redactor', '1' ) ); ?> value="1" /> <?php _e( 'Enable rich editor for Groups Descriptions', 'bpgd' ) ?>
    </label>
    <?php
}

function bpgd_admin_wc(){ ?>
    <label>
        <input type="checkbox" name="bpgd_w_count"<?php checked( '1', bp_get_option( 'bpgd_w_count', '0' ) ); ?> value="1" /> <?php _e( 'Enable words count for Groups Descriptions', 'bpgd' ) ?>
    </label>
    <?php
}

function bpgd_admin_wn(){ ?>
    <label>
        <input type="text" name="bpgd_words" value="<?php echo bp_get_option( 'bpgd_words', '25' ); ?>" /> <?php _e('words', 'bpgd'); ?><br />
    </label>
    <span class="description"><?php _e('Please remember, that HTML tags may decrease a bit (in some cases) the number of words that you see before "Less" link.', 'bpgd'); ?></span>
    <?php
}

/**
 * This hook is only for pre 1.8
 */
add_action('bp_core_admin_screen_fields', 'bpgd_admin_settings');
function bpgd_admin_settings(){
    if ( bp_is_active( 'groups' ) ) { ?>
        <tr>
            <th scope="row"><?php _e( 'Disable rich editor for Groups Descriptions?', 'bpgd' ) ?></th>
            <td>
                <input type="radio" name="bp-admin[bpgd_redactor]"<?php checked( '0', bp_get_option( 'bpgd_redactor', '1' ) ); ?> value="0" /> <?php _e( 'Yes', 'buddypress' ) ?> &nbsp;
                <input type="radio" name="bp-admin[bpgd_redactor]"<?php checked( '1', bp_get_option( 'bpgd_redactor', '1' ) ); ?> value="1" /> <?php _e( 'No', 'buddypress' ) ?>
            </td>
        </tr>
        <tr>
            <th scope="row"><?php _e( 'Disable words count for Groups Descriptions?', 'bpgd' ) ?></th>
            <td>
                <input type="radio" name="bp-admin[bpgd_w_count]"<?php checked( '0', bp_get_option( 'bpgd_w_count', '1' ) ); ?> value="0" /> <?php _e( 'Yes', 'buddypress' ) ?> &nbsp;
                <input type="radio" name="bp-admin[bpgd_w_count]"<?php checked( '1', bp_get_option( 'bpgd_w_count', '1' ) ); ?> value="1" /> <?php _e( 'No', 'buddypress' ) ?>
            </td>
        </tr>
        <tr <?php echo (bp_get_option('bpgd_w_count') != 1?'style="background:#eee"':''); ?>>
            <th scope="row"><?php _e( 'How many words should be displayed before "Less" link appears in Groups Descriptions?', 'bpgd' ) ?></th>
            <td>
                <input type="text" name="bp-admin[bpgd_words]" id="bpgd-words" value="<?php echo bp_get_option( 'bpgd_words', '25' ); ?>" /><br />
                <span class="description"><?php _e('Please remember, that HTML tags may descrease a bit (in some cases) the number of words that you see before "Less" link.', 'bpgd'); ?></span>
            </td>
        </tr>
    <?php
    }
}