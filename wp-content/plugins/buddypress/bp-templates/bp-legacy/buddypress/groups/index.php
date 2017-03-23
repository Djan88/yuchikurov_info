<?php do_action( 'bp_before_directory_groups_page' ); ?>

<div class="padding-box" id="portfolio buddypress" style="padding-bottom: 0;">
  <div class="row header">
    <?php do_action( 'bp_before_directory_groups' ); ?>

    <?php do_action( 'bp_before_directory_groups_content' ); ?>

    <article class="col-xs-12 textbox text-center">
      
      <div class="portfolio-section col-xs-12">
        <?php if(is_page(1932)) { ?>
          <h2 class="black">Мастера школы</h2>
          <p>Для отображения семинаров конкретного мастера кликните на имя</p>
          <ul id="cartegories" class="list-inline">
            <li><a data-filter="" class="filter active">Все</a></li>
            <li><a data-filter="chicurov" class="filter">Юрий Чикуров</a></li>
            <li><a data-filter="voloshin" class="filter">Петр Волошин</a></li>
            <li><a data-filter="ivanova" class="filter">Ирина Иванова</a></li>
            <!-- <li><a data-filter="milakova" class="filter">Светлана Милакова</a></li> -->
            <li><a data-filter="seregina" class="filter">Галина Серегина</a></li>
            <li><a data-filter="kislitsin" class="filter">Максим Кислицин</a></li>
            <li><a data-filter="malyy" class="filter">Александр Малый</a></li>
          </ul>
        <?php } ?>
        <form action="" method="post" id="groups-directory-form" class="dir-form">

          <?php do_action( 'template_notices' ); ?>

          

          <div class="item-list-tabs" id="subnav" role="navigation">
            <ul>
              <?php do_action( 'bp_groups_directory_group_types' ); ?>

              
            </ul>
          </div>

          <div id="groups-dir-list" class="groups dir-list">
            <?php bp_get_template_part( 'groups/groups-loop' ); ?>
          </div><!-- #groups-dir-list -->

          <?php do_action( 'bp_directory_groups_content' ); ?>

          <?php wp_nonce_field( 'directory_groups', '_wpnonce-groups-filter' ); ?>

          <?php do_action( 'bp_after_directory_groups_content' ); ?>

        </form>
        <!-- #groups-directory-form -->
        
        <?php do_action( 'bp_after_directory_groups' ); ?>
      </div>
    </article>
  </div>
  <!--portfolio--> 
</div>
<!-- #buddypress -->

<?php do_action( 'bp_after_directory_groups_page' ); ?>
