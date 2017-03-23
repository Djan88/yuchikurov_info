<?php
/**
 * BuddyPress - Users Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */
?>

<?php do_action('bp_before_member_header'); ?>

<?php

if($_POST['submit-subscribe']){
        
    $md5 = md5($_POST['subscribe-name'].$_POST['subscribe-email'].$_POST['subscribe-phone']);

    if($md5 == $_POST['bot_test']){

        $name = $_POST['subscribe-name'];
        $name_priem = $_POST['priem-day'];
        $email = $_POST['subscribe-email'];
        $phone = $_POST['subscribe-phone'];

        $to = xprofile_get_field_data(8, bp_displayed_user_id());

        send_email($to, $email, "Запись на $name_priem", $name, $phone);

    }

}


$vkontakte = xprofile_get_field_data(12, bp_displayed_user_id());
$facebook = xprofile_get_field_data(13, bp_displayed_user_id());
$youtube = xprofile_get_field_data(14, bp_displayed_user_id());
$twitter = xprofile_get_field_data(30, bp_displayed_user_id());
$instagram = xprofile_get_field_data(31, bp_displayed_user_id());
$youtube_video = xprofile_get_field_data(15, bp_displayed_user_id());




if ($youtube_video) {
    ?>

    <div id="item-actions" class="hidden">

        <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div> 

            <iframe width="290" height="200" src="//www.youtube.com/embed/<?php echo $youtube_video; ?>" frameborder="0" allowfullscreen=""></iframe>

            <a href="<?php echo $youtube; ?>">Посмотреть все видеозаписи >></a>

    </div>

<?php } ?>


<div class="grey-color" id="team">
  <div class="container padding-box">
    <div class="row header">
      <article class="col-xs-12 textbox text-center">
        <h2 class="black">О МАСТЕРЕ</h2>
      </article>
      <div class="team-box col-xs-12">
        <aside class="team-profile col-sm-3 col-xs-12">
          <div class="image-holder">
            <!-- <img class="img-responsive" src="images/chikurov.jpg" alt=""> -->
            <?php bp_displayed_user_avatar('type=full'); ?>
          </div>
          <div class="team-info text-center">
            <h4><?php the_title(); ?></h4>
            <p class="hidden">
              Основатель школы<br>
              канд. мед. наук, доцент
            </p>
          </div>
        </aside>
        <aside class="team-profile col-sm-9 col-xs-12">
          <p class="justifyed" style="line-height: 24px;"><?php echo xprofile_get_field_data(6, bp_displayed_user_id()); ?></p>
          <p>
              <div class="item-list-tabs no-ajax" id="subnav" role="navigation">
                <div class="btn-group">
                    <?php bp_get_options_nav(); ?>
                </div>
              </div><!-- .item-list-tabs -->

              <?php do_action( 'bp_before_profile_content' ); ?>

              <div class="profile" role="main">

              <?php switch ( bp_current_action() ) :

                // Edit
                case 'edit'   :
                    bp_get_template_part( 'members/single/profile/edit' );
                    break;

                // Change Avatar
                case 'change-avatar' :
                    bp_get_template_part( 'members/single/profile/change-avatar' );
                    break;

                // Compose
                case 'public' :

                    // Display XProfile
                    if ( bp_is_active( 'xprofile' ) )
                        bp_get_template_part( 'members/single/profile/profile-loop' );

                    // Display WordPress profile (fallback)
                    else
                        bp_get_template_part( 'members/single/profile/profile-wp' );

                    break;

                // Any other
                default :
                    bp_get_template_part( 'members/single/plugins' );
                    break;
              endswitch; ?>
              </div><!-- .profile -->

              <?php do_action( 'bp_after_profile_content' ); ?>
          </p>
        </aside>
      </div>
    </div>
    <!--container--> 
  </div>
</div>
<div class="padding-box blue-color">
  <div class="container">
    <div class="row header">
      <article class="col-xs-12 social-icons text-center">
        <h2 class="white">Связаться с мастером</h2>
        <ul class="list-inline">
            <?php if ($vkontakte) { ?>
                <li><a href="<?php echo $vkontakte; ?>"><span class="fa fa-vk"></span>Вконтакте</a></li>
            <?php } ?>
            <?php if ($facebook) { ?>
                <li><a href="<?php echo $facebook; ?>"><span class="fa fa-facebook"></span>facebook</a></li>
            <?php } ?>
            <?php if ($youtube) { ?>
                <li><a href="<?php echo $youtube; ?>"><span class="fa fa-youtube"></span>YouTube</a></li>
            <?php } ?>
            <?php if ($twitter) { ?>
                <li><a href="<?php echo $twitter; ?>"><span class="fa fa-twitter"></span>Twitter</a></li>
            <?php } ?>
            <?php if ($instagram) { ?>
                <li><a href="<?php echo $instagram; ?>"><span class="fa fa-instagram"></span>Instagram</a></li>
            <?php } ?>
        </ul>
        <!--textbox--> 
      </article>
      <!--row--> 
    </div>
    <!--container--> 
  </div>
</div>




<div id="item-header-avatar" class="hidden">

    <a href="<?php bp_displayed_user_link(); ?>">

<?php bp_displayed_user_avatar('type=full'); ?>

    </a>

    <?php if (xprofile_get_field_data(18, bp_get_member_user_id())) { ?>
        <p><a href="#" class="readon" id="subscribe-seminar" style="margin: 10px 0px;">Запись на прием</a></p>
    <?php } ?> 

</div><!-- #item-header-avatar -->

<div id="item-header-content" class="hidden">

    <div class="master-social">

        <?php if ($vkontakte) { ?>
            <a href="<?php echo $vkontakte; ?>"><i class="icon-vk"></i></a></a>
        <?php } ?>

        <?php if ($facebook) { ?>
            <a href="<?php echo $facebook; ?>"><i class="icon-facebook"></i></a>
        <?php } ?>

        <?php if ($youtube) { ?>
            <a href="<?php echo $youtube; ?>"><i class="icon-youtube"></i></a>
        <?php } ?>

        <?php if ($twitter) { ?>
            <a href="<?php echo $twitter; ?>"><i class="icon-twitter"></i></a>
        <?php } ?>

        <?php if ($instagram) { ?>
            <a href="<?php echo $instagram; ?>"><i class="icon-instagram"></i></li>
        <?php } ?>

    </div>

        <?php echo xprofile_get_field_data(6, bp_displayed_user_id()); ?>


</div><!-- #item-header-content -->

        <?php if (xprofile_get_field_data(18, bp_get_member_user_id())) { 
            
            $posts = get_posts( array(
                    'author'      => bp_displayed_user_id(),
                    'orderby'     => 'date',
                    'category'    => 152
            ));
            
        ?>

    <div class="seminar-subscribe-form" style="margin-top: 355px;">

        <form action="" method="post" name="form-subscribe">
            <input type="text" name="subscribe-name" id="subscribe-name" value="" placeholder="Имя" />
            <input type="text" name="subscribe-email" id="subscribe-email" value="" placeholder="E-mail" />
            <input type="text" name="subscribe-phone" id="subscribe-phone" value="" placeholder="Телефон" />
            <select name="priem-day">
                <option value="">Выбрать приемный день</option>
                <?php foreach ($posts as $post){ ?>
                
                <option value="<?php echo $post->post_title; ?>"><?php echo $post->post_title; ?></option>
                    
                <?php } ?>
            </select>
            <input type="hidden" name="bot_test" id="bot_test" value="">
            <input type="submit" name="submit-subscribe" id="submit-subscribe" value="Отправить" />
        </form>

    </div>

<?php } ?>


<?php //do_action('bp_after_member_header'); ?>

<?php //do_action('template_notices'); ?>
