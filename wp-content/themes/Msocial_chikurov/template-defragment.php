<?php

/*
Template Name: Reestr defragment page
*/

gk_load('header');

do_action( 'bp_before_directory_members_page' ); ?>
<aside class="col-xs-12 subbanner">
    <h1>Специалисты: "ТЕРАПЕВТИЧЕСКАЯ ДЕФРАГМЕНТАЦИЯ"</h1>
</aside>
<div class="clear"></div>
<div id="buddypress">
    <div class="container padding-box">
    <div class="grey-color" id="team">
        <div class="container padding-box">
            <div class="row header">
                <?php do_action( 'bp_before_directory_members' ); ?>

                <?php do_action( 'bp_before_directory_members_content' ); ?>

                <?php do_action( 'bp_before_directory_members_tabs' ); ?>
                <form action="" method="post" id="members-directory-form" class="dir-form">
                    <?php do_action( 'bp_before_members_loop' ); ?>
                    <?php do_action( 'bp_before_directory_members_list' ); ?>
                      
                    <?php $masters_ar = get_subscriber_user_def(); ?>

                    <?php foreach ($masters_ar as $country => $value){ ?>

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
                                    <p><i class="icon-envelope"></i><a href="mail:<?php echo $master['email']; ?>"><?php echo $master['email']; ?></a></p>
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
                    
                    <?php } ?>
                    <?php do_action( 'bp_directory_members_content' ); ?>

                    <?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

                    <?php do_action( 'bp_after_directory_members_content' ); ?>
                </form>
            </div>
        </div>
    </div>
        
        

	<?php do_action( 'bp_after_directory_members' ); ?>
</div>
</div>

<!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); 

gk_load('footer');?>
