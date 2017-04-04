<?php

/*
Template Name: Reestr defragment page
*/

gk_load('header');

do_action( 'bp_before_directory_members_page' ); ?>

<div id="buddypress">

	<?php do_action( 'bp_before_directory_members' ); ?>

	<?php do_action( 'bp_before_directory_members_content' ); ?>

	<?php do_action( 'bp_before_directory_members_tabs' ); ?>

	<form action="" method="post" id="members-directory-form" class="dir-form">

		<div class="item-list-tabs" id="subnav" role="navigation">
			<ul>
				<?php do_action( 'bp_members_directory_member_sub_types' ); ?>
                            
				
			</ul>
		</div>

		<div id="members-dir-list" class="members dir-list"> 
       
                    <?php do_action( 'bp_before_members_loop' ); ?>
                    <?php do_action( 'bp_before_directory_members_list' ); ?>
          
                    
                <?php $masters_ar = get_subscriber_user_def(); ?>

        <?php foreach ($masters_ar as $country => $value){ ?>

        <h2><?php echo $country; ?></h2>    
        
            <?php foreach ($value as $state => $masters){ ?>
        
            <h3><?php echo $state; ?></h3>  

                <ul id="members-list" class="item-list" role="main">

                    <?php foreach ($masters as $master){ ?>
                        <?php if(!empty($master['name'])){ ?>
                        <li>
                                <div class="item-avatar">
                                    <a href="<?php echo $master['link']; ?>"><?php echo $master['avatar']; ?></a>
                                </div>

                            <div class="item" style="margin: 0;">
                                        <div class="item-title">
                                                <a href="<?php echo $master['link']; ?>"><?php echo $master['name']; ?></a>

                                                <?php if($master['vk']){ ?>
                                                    <a class="social-member-button" href="<?php echo $master['vk']; ?>"><i class="icon-vk"></i></a></a>
                                                <?php } ?>

                                                <?php if($master['f']){ ?>
                                                    <a class="social-member-button" href="<?php echo $master['f']; ?>"><i class="icon-facebook"></i></a>
                                                <?php } ?>

                                                <?php if($master['youtube']){ ?>
                                                    <a class="social-member-button" href="<?php echo $master['youtube']; ?>"><i class="icon-youtube"></i></a>
                                                <?php } ?>

                                        </div>

                                    <?php if($master['img_country']){ ?>
                                    <p><img src="/wp-content/themes/Msocial/images/flag/<?php echo $master['img_country']; ?>.png"><?php echo $master['country'].','; ?> <?php echo $master['city']; ?></p>
                                    <?php } ?>
                                    <?php if($master['email']){ ?>
                                    <p><i class="icon-envelope"></i><a href="mail:<?php echo $master['email']; ?>"><?php echo $master['email']; ?></a></p>
                                    <?php } ?>
                                    <?php if($master['phone']){ ?>
                                    <p><i class="icon-phone"></i><?php echo $master['phone']; ?></p>
                                    <?php } ?>
                                    <?php if($master['www']){ ?>
                                    <p><i class="icon-globe"></i><a class="member-site" href="#" id="<?php echo $master['www'];?>"><?php echo $master['www'];?></a></p>
                                    <?php } ?>
                                    <?php if($master['description']){ ?>
                                    <p style="margin-top: 10px;"><?php echo $master['description']; ?></p>
                                    <?php } ?>
 
                                </div>


                                <div class="clear"></div>
                        </li>
                        <?php } ?>
                <?php } ?>
                        
                </ul> 
                
                <?php } ?>
            
            <?php } ?>
            
            <?php do_action( 'bp_after_directory_members_list' ); ?>
            <?php bp_member_hidden_fields(); ?>

            </div><!-- #members-dir-list -->
            
            

		<?php do_action( 'bp_directory_members_content' ); ?>

		<?php wp_nonce_field( 'directory_members', '_wpnonce-member-filter' ); ?>

		<?php do_action( 'bp_after_directory_members_content' ); ?>

	</form><!-- #members-directory-form -->
        
        

	<?php do_action( 'bp_after_directory_members' ); ?>

</div>

<!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); 

gk_load('footer');?>
