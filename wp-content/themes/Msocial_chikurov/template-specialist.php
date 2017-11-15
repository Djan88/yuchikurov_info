<?php

/*
Template Name: Reestr specialist page
*/

gk_load('header');

do_action( 'bp_before_directory_members_page' ); ?>
<aside class="col-xs-12 subbanner">
    <h1>Реестр специалистов"</h1>
</aside>
<div class="clear"></div>
<!-- PLANS PRICING STARTS
========================================================================= -->
<div class="grey-color">
    <div class="container padding-box" id="pricing">
        <div class="row header">
            <article class="col-xs-12 textbox text-center">
                <h2 class="black">Реестр специалистов</h2>
                <!-- <p>Подзаголовок</p> -->
                <aside class="col-xs-12 col-sm-4 reestr">
                    <div class="col-sm-12 plan1">
                        <h3>Реестр мастеров</h3>
                        <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/master.1.png" class="mastera" style="padding-top: 33px;"></div>
                        <a class="btn btn-primary btn-lg" href="/members/">Посмотреть</a>
                    </div>
                </aside>
                <aside class="col-xs-12 col-sm-4 reestr">
                    <div class="col-sm-12 plan1">
                        <h3>Терапевтическая дефрагментация</h3>
                        <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/defra.png" class="defragments"></div>
                        <a class="btn btn-primary btn-lg" href="/терапевтическая-дефрагментация/">Посмотреть</a>
                    </div>
                </aside>
                <aside class="col-xs-12 col-sm-4 reestr">
                    <div class="col-sm-12 plan1">
                        <h3>Биологическое центрирование</h3>
                        <div class="pakage_price"><img src="/wp-content/themes/Msocial_chikurov/images/bc_2.png" class="mastera" style="width: 73%;padding-bottom: 19px;padding-top: 20px;"></div>
                        <a class="btn btn-primary btn-lg" href="/biologicheskoe-centrirovanie-specialisty/">Посмотреть</a>
                    </div>
                </aside>
                <!-- <aside class="col-xs-12 col-sm-3 reestr">
                  <div class="col-sm-12 plan1">
                    <h3>Специалисты Wizardmachine</h3>
                    <div class="pakage_price"><img src="/wp-content/themes/Msocial/images/wm_wd.png" class="mastera" style="width: 73%;padding-bottom: 19px;padding-top: 20px;"></div>
                    <a class="btn btn-primary btn-lg" href="/specialisty-wizard/">Посмотреть</a>
                  </div>
                </aside> -->
            </article>
        </div>
        <!--container-->
    </div>
</div>
<!-- PLANS PRICING END
========================================================================= -->

<!-- #buddypress -->

<?php do_action( 'bp_after_directory_members_page' ); 

gk_load('footer');?>
