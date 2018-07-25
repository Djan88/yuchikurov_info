<?php

/*
Template Name: Reestr specialist page
*/

gk_load('header');

do_action( 'bp_before_directory_members_page' ); ?>
<aside class="col-xs-12 subbanner">
    <h1>Специалисты: "Биологическое центрирование"</h1>
</aside>
<div class="clear"></div>
<div id="buddypress">
    <div class="container padding-box">
    <div class="grey-color" id="team">
        <div class="container padding-box">
            <div class="row header">
                <div class="team-box col-xs-12 clearfix">
                   <?php if(get_field('specialists')): ?>
                    <?php while(has_sub_field('specialists')): ?>
                        <?php
                            $field_user = get_sub_field("specialist_id");
                            $field_user_id = get_userdata($field_user);
                            //$field_user_foto = $field_user['user_avatar'];
                            $field_user_foto = get_avatar($field_user, 270);
                        ?>
                        <aside class="team-profile col-sm-3 col-xs-12 test">
                            <a href="http://www.yuchikurov.info/members/<?php echo $field_user_id->get('user_login'); ?>">
                                <div class="image-holder">
                                    <?php echo $field_user_foto; ?>
                                </div>
                            </a>
                            <div class="team-info text-center">
                                <a href="http://www.yuchikurov.info/members/<?php echo $field_user_id->get('user_login'); ?>">
                                    <h4><?php echo $field_user_id->get('display_name'); ?></h4>
                                </a>
                                <p>
                                    <a href="http://www.yuchikurov.info/members/<?php echo $field_user_id->get('user_login'); ?>"><i class="icon-envelope"></i></a>
                                    <a href="mail:<?php echo $field_user_id->get('user_email'); ?>"><?php echo $field_user_id->get('user_email'); ?></a>
                                </p>
                            </div>
                        </aside>
                    <?php endwhile; ?>
                <?php endif; ?>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>



	<?php do_action( 'bp_after_directory_members' ); ?>
</div>
</div>

<!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); 

gk_load('footer');?>
