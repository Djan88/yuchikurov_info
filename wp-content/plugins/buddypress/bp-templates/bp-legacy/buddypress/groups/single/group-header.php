<?php

do_action( 'bp_before_group_header' );

?>

 <?php
    global $bp, $wpdb;
    $group = groups_get_group( array( 'group_id' => bp_get_group_id() ) );
    $admin = get_userdata( $group->admins[0]->user_id );
    
    if($_POST['submit-subscribe']){
        
        $md5 = md5($_POST['subscribe-name'].$_POST['subscribe-email'].$_POST['subscribe-phone']);
        
        if($md5 == $_POST['bot_test']){
            
            $seminar_date = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldone');
            $seminar_end = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldtwo');
            $sity_seminar = groups_get_groupmeta( bp_get_group_id(), 'group_plus_header_fieldthree');
            $name = $_POST['subscribe-name'];
            $first_name = $_POST['subscribe-first-name'];
            $name_seminar = bp_get_group_name();
            $email = $_POST['subscribe-email'];
            $phone = $_POST['subscribe-phone'];
            $date = date('Y-m-d');
            $master_name = bp_core_get_user_displayname( $group->admins[0]->user_id );
            if(!empty($group->mods[0]->user_id)){
                $assistant = bp_core_get_user_displayname( $group->mods[0]->user_id );
            } else {
                $assistant = bp_core_get_user_displayname( $group->admins[0]->user_id );
            }
            
            $wpdb->insert(
                    'wp_subscription',
                    array( 'name_seminar' => $name_seminar, 'seminar_master' => $master_name, 'seminar_assistant' => $assistant, 'sity_seminar' => $sity_seminar, 'date_seminar' => $seminar_date, 'name' => $first_name.' '.$name, 'email' => $email, 'phone' => $phone, 'date_registration' => $date ),
                    array( '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' )
            );
            
            $to = xprofile_get_field_data(8, $group->mods[0]->user_id);
            $to .= ', '.xprofile_get_field_data(8, $group->admins[0]->user_id);
            
            $to .= ', info@bablosstudio.ru';
            
            $seminar_date = rdate('d M, Y', strtotime($seminar_date));
            $seminar_end = rdate('d M, Y', strtotime($seminar_end));

            send_email($to, $email, "Запись на ".bp_get_group_name()." ( $master_name, $sity_seminar, $seminar_date - $seminar_end )", $first_name.' '.$name, $phone);

        }
            
    }
?>
<div class="padding-box acented_down_blue">
  <div class="container">
    <div class="row header">
      <div class="col-sm-2 col-xs-12"></div>
      <div id="sidebar" class="col-sm-4 col-xs-12">
        <div class="widget">
          <ul class="categories">
                <?php do_action( 'bp_before_group_header_meta' ); ?>
                
                <?php 
                    $id = bp_get_group_id();
                    $date_start = strtotime(groups_get_groupmeta( $id, 'group_plus_header_fieldone')); 
                    $date_start = rdate('d M, Y', $date_start);
                    $date_end = strtotime(groups_get_groupmeta( $id, 'group_plus_header_fieldtwo'));
                    $date_end = rdate('d M, Y', $date_end);
                    $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
                    $name_seminar = bp_get_group_name();
                    $org_yes = bp_core_get_userlink($group->mods[0]->user_id, $no_anchor = false, $just_link = true);
                    $admin_yes = bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = true, $just_link = false);
                    $current_user = wp_get_current_user();
                    $current_user = $current_user->display_name;
                    $seminar_url = (groups_get_groupmeta( $id, 'slug')); 

                ?>
            <li class="clearfix"><span class="sub_tl">Читает</span><a class="main_menu_link" href="<?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = false, $just_link = true); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Узнать больше о мастере"><?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = true, $just_link = false); ?></a></li>
            <li class="clearfix">
              <span class="sub_tl">Адрес</span>
              <a class="main_menu_link" href="#map" data-toggle="tooltip" data-placement="top" title="" data-original-title="Посмотреть карту проезда">
                <?php if ( bp_get_group_place()) { ?>
                 <?php bp_group_place(); ?>
                <?php } else { ?>
                  <?php echo $city; ?>
                <?php } ?>
              </a>
            </li>
            <li class="clearfix"><span class="sub_tl">Дата</span><a class="main_menu_link" href="#"><?= $date_start; ?> - <?= $date_end; ?></a></li>
            <li class="clearfix"><span class="sub_tl">О чем этот семинар?</span><a class="main_menu_link" href="#about" data-toggle="tooltip" data-placement="top" title="" data-original-title="Подробная информация о семинаре" style="max-width: 65%;"><?php echo $name_seminar; ?></a></li>
            <li class="clearfix">
              <span class="sub_tl">Организатор</span>
              <?php if (bp_get_group_master_fio()) { ?>
                <a class="main_menu_link" style="max-width: 65%;"><?php bp_group_master_fio(); ?></a>
              <?php } else if ($org_yes) { ?>
                <a class="main_menu_link" href="<?php echo $org_yes; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Подробная информация о организаторе" style="max-width: 65%;"><?php echo bp_core_get_userlink($group->mods[0]->user_id, $no_anchor = true, $just_link = false); ?></a>
              <?php } else { ?>
                <a class="main_menu_link" href="<?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = false, $just_link = true); ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Подробная информация о организаторе" style="max-width: 65%;"><?php echo bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = true, $just_link = false); ?></a>
              <?php } ?>
              
            </li>
            <li class="clearfix"><span class="sub_tl">Задать вопрос по телефону</span>
              <?php if (bp_get_group_master_telephone()) { ?>
                <a class="main_menu_link" href="#about" style="max-width: 65%;"><i class="icon-phone" style="margin-right: 10px;"></i><?php bp_group_master_telephone(); ?></a>
              <?php } else if ($org_yes) { ?>
                <a class="main_menu_link" href="#about" style="max-width: 65%;"><i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->mods[0]->user_id); ?></a>
              <?php } else { ?>
                <a class="main_menu_link" href="#about" style="max-width: 65%;"><i class="icon-phone" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(9, $group->admins[0]->user_id); ?></a>
              <?php } ?>
              
            </li>
            <li class="clearfix"><span class="sub_tl">Написать организатору</span>
              <?php if (bp_get_group_master_email()) { ?>
                <a class="main_menu_link" href="mailto:<?php bp_group_master_email(); ?>" style="max-width: 65%;"><i class="icon-envelope" style="margin-right: 10px;"></i><?php bp_group_master_email(); ?></a>
              <?php } else if ($org_yes) { ?>
                <a class="main_menu_link" href="mailto:<?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?>" style="max-width: 65%;"><i class="icon-envelope" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?></a>
              <?php } else { ?>
                <a class="main_menu_link" href="mailto:<?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?>" style="max-width: 65%;"><i class="icon-envelope" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?></a>
              <?php } ?>
            </li>
          </ul>
          <div class="row hidden">
            <div class="col-sm-4 col-xs-4 image_full_width">
              <img src="images/master.png" alt=""  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Мастер школы" style="border-radius: 50%; border: 3px solid #f6cd80; margin-top:5px; padding: 0 0 3px 3px;">
            </div>
            <div class="col-sm-4 col-xs-4 image_full_width">
              <img src="images/defra.png" alt=""  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Специалист по терапевтической дефрагментации" style="border-radius: 50%; border: 3px solid #f6cd80; margin-top:5px;">
            </div>
            <div class="col-sm-4 col-xs-4 image_full_width">
              <img src="images/wm_wd.png" alt=""  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Специалист WIZARDMACHINE" style="border-radius: 50%; border: 3px solid #f6cd80; margin-top:5px; padding: 8px;">
            </div>
          </div>
        </div>
      </div>
      <div class="content col-sm-4 col-xs-12 clearfix">
        <div class="col-sm-12 master_photo">
          <div class="image-container he-wrap tpl2" data-effect="slide-right">
          <?php bp_group_avatar('type=full&width=false&height=false&class=img-responsive'); ?>
          <!-- <img class="img-responsive" src="images/face.jpg" alt="master"> -->
          <br>
          <p><a href="#contact-form" class="btn btn-primary btn-lg">Задать вопрос</a></p>
          <?php if (is_user_logged_in()) { ?>
            <?php if ($admin_yes == $current_user || current_user_can('administrator')) { ?>
              <a href="<?php echo bp_get_groups_action_link(); ?>admin/edit-details/#edit_seminar" class="btn btn-primary btn-lg">Редактировать семинар</a>
            <?php } ?>
          <?php } ?>
          </div>
        </div>
        <!-- <div class="clearfix"></div> -->
      </div>
      <div class="col-sm-2 col-xs-12"></div>
    </div>
    <!--container--> 
  </div>
</div>
<!-- SERVIES END
    ========================================================================= --> 
<div id="feature" class="padding-box acented_down_blue">
  <div class="container">
    <div class="row">
      <article class="col-xs-12 textbox justifyed">
        <h2 class="black text-center"><a class="anchor" href="/" name="about"></a>О чем этот семинар</h2>
        <?php bp_group_description(); ?>
      </article>
    </div>
  </div>
</div>
<?php if (bp_get_group_for_whom()) { ?>
<div id="feature" class="blue-color padding-box">
  <div class="container">
    <div class="row">
      <article class="col-xs-12 textbox justifyed">
        <h2 class="white white_circle text-center"><a class="anchor" href="/" name="for"></a>Для кого этот семинар</h2>
        <p class="white text-center"><?php bp_group_for_whom(); ?></p>
      </article>
    </div>
  </div>
</div>
<?php } ?>

<div class="grey-color">
  <div class="container padding-box" id="contact-form">
    <div class="row">
      <article class="col-xs-12 textbox text-center">
        <h2 class="black"><a class="anchor" href="/" name="contact-form"></a>Задать вопрос</h2>
        <div class="col-sm-9 col-xs-12 inquiry-form">
          <?php $master_name = bp_core_get_userlink($group->admins[0]->user_id, $no_anchor = true, $just_link = false); ?>
          <?php if ($master_name == 'Юрий Чикуров') { ?>
            <?php echo do_shortcode( '[contact-form-7 id="3219" title="Запись. Чикуров"]' ); ?>
          <?php } else if ($master_name == 'Доктор Петр Волошин') { ?>
            <?php echo do_shortcode( '[contact-form-7 id="3221" title="Запись. Волошин"]' ); ?>
          <?php } else if ($master_name == 'Ирина Иванова') { ?>
            <?php echo do_shortcode( '[contact-form-7 id="3220" title="Запись. Иванова"]' ); ?>
          <?php } ?>
          <p style="padding-top: 20px;">
            Либо напишите организатору:
            <?php if (bp_get_group_master_email()) { ?>
              <a class="main_menu_link" href="mailto:<?php bp_group_master_email(); ?>" style="max-width: 65%;"> <i class="icon-envelope" style="margin-right: 10px;"></i><?php bp_group_master_email(); ?></a>
            <?php } else if ($org_yes) { ?>
              <a class="main_menu_link" href="mailto:<?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?>" style="max-width: 65%;"> <i class="icon-envelope" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(8, $group->mods[0]->user_id); ?></a>
            <?php } else { ?>
              <a class="main_menu_link" href="mailto:<?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?>" style="max-width: 65%;"> <i class="icon-envelope" style="margin-right: 10px;"></i><?php echo xprofile_get_field_data(8, $group->admins[0]->user_id); ?></a>
            <?php } ?>
          </p>
            <!--inquiry-form"--> 
        </div>
      </article>
    </div>
    <!--container--> 
  </div>
  <!--grey-color--> 
</div>
<?php if (bp_get_group_place()) { ?>
  <!-- GOOGLE MAP STARTS
  ========================================================================= -->
  <div id="feature" class="padding-box blue-color">
    <div class="container">
      <div class="row">
        <article class="col-xs-12 textbox text-center">
          <h2 class="white white_circle text-center"><a class="anchor" href="/" name="map"></a> Адрес и карта проезда</h2>
          <p class="white"><?php bp_group_place(); ?></p>
        </article>
      </div>
    </div>
  </div>
  <div id="map" class="google-map"></div>
  <div class="clear"></div>
  <!-- GOOGLE MAP END
  ========================================================================= -->
<?php } ?>
<div id="feature" class="padding-box blue-color">
  <div class="container">
    <div class="row">
      <article class="col-xs-12 textbox justifyed">
        <h2 class="white white_circle text-center"><a class="anchor" href="/" name="about"></a>Похожие семинары мастера</h2>
           <div class="similar-seminar">
              <div class="list-group">
                <?php 
                    $seminars = similar_seminar($group->admins[0]->user_id);
                    $i=0;
                    foreach ($seminars as $seminar){
                        $date_end = strtotime(groups_get_groupmeta( $seminar->id, 'group_plus_header_fieldtwo'));
                
                        $date_now = date('Y-m-d');
                        $dateNow = strtotime($date_now);
                        if($date_end > $dateNow && $i<3){
                            
                            echo "<a class='list-group-item recent_seminars' href='/seminar/$seminar->slug'>$seminar->name</a>";
                            $i++;
                        }
                    }
                ?>
              </div>
               
               <p class="hidden"><a href="/members/<?php bp_member_user_login(); ?>/groups/">Все семинары >></a></p>
          </div>
      </article>
    </div>
  </div>
</div>
<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script> 
<?php if (bp_get_group_place_coordinates()) { ?>
<script src="http://maps.google.com/maps/api/js?key=AIzaSyCgTNI0r-tN_r5rfGE3ClDOzT0NSeNUOec"></script>
<script>
// Google Map
  var locations = [
    ['<div class="infobox"><h3 class="title">Место проведения</h3></div>', <?php bp_group_place_coordinates(); ?>, 2]
    ];
  
    var map = new google.maps.Map(document.getElementById('map'), {
      
      zoom: 17,
      scrollwheel: false,
      navigationControl: true,
      mapTypeControl: false,
      scaleControl: false,
      draggable: true,
      styles: [ { "stylers": [ { "hue": "#477ab9" },  {saturation: 20},
                {gamma: 1} ] } ],
      center: new google.maps.LatLng(<?php bp_group_place_coordinates(); ?>),
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });
  
    var infowindow = new google.maps.InfoWindow();
  
    var marker, i;
  
    for (i = 0; i < locations.length; i++) {  
    
      marker = new google.maps.Marker({ 
      position: new google.maps.LatLng(locations[i][1], locations[i][2]), 
      map: map ,
      icon: '/wp-content/themes/Msocial_chikurov/images/pin.png'
      });
  
  
      google.maps.event.addListener(marker, 'click', (function(marker, i) {
      return function() {
        infowindow.setContent(locations[i][0]);
        infowindow.open(map, marker);
        
      }
      })(marker, i));
    }
        
      $(document).on( "shown.bs.tab", function( event, data ){
    var center = map.getCenter();
    google.maps.event.trigger(map, "resize");
    map.setCenter(center);
});
</script>
<?php } ?>


<div id="item-header-content" class="hidden">


	<?php do_action( 'bp_before_group_header_meta' ); ?>
    
    <?php 
        $id = bp_get_group_id();
        $date_start = strtotime(groups_get_groupmeta( $id, 'group_plus_header_fieldone')); 
        $date_start = rdate('d M, Y', $date_start);
        $date_end = strtotime(groups_get_groupmeta( $id, 'group_plus_header_fieldtwo'));
        $date_end = rdate('d M, Y', $date_end);
        $city = groups_get_groupmeta( $id, 'group_plus_header_fieldthree');
    ?>

    <div id="item-meta" class="item-seminar">
                
                <?php do_action( 'bp_group_header_actions' ); ?>
                <?php if(bp_loggedin_user_id() == $group->admins[0]->user_id){ ?>
                    <div class="generic-button group-button public">
                        <a href="/добавить-помошника/" class="group-button join-group">Добавить помошника</a>
                    </div>
                <?php } ?>
                            
		<?php do_action( 'bp_group_header_meta' ); ?>            

	</div>
    
    
</div><!-- #item-header-content -->

<div class="description-seminar hidden">
    <div class="seminar-subscribe-form">
    
        <form action="" method="post" name="form-subscribe">
            <input type="text" name="subscribe-name" id="subscribe-name" value="" placeholder="Имя" />
            <input type="text" name="subscribe-first-name" id="subscribe-first-name" value="" placeholder="Фамилия" />
            <input type="text" name="subscribe-email" id="subscribe-email" value="" placeholder="E-mail" />
            <input type="text" name="subscribe-phone" id="subscribe-phone" value="" placeholder="Телефон" />
            <input type="hidden" name="bot_test" id="bot_test" value="">
            <input type="submit" name="submit-subscribe" id="submit-subscribe" value="Отправить" />
        </form>

    </div>
</div>

<?php
do_action( 'bp_after_group_header' );
do_action( 'template_notices' );
?>
