

<!-- FOOTER STARTS
========================================================================= -->
<footer id="footer">
  <div class="container">
    <div class="row header">
      <aside class="col-sm-6 col-xs-12">
        <div class=" col-sm-6 col-xs-12 sitemap">
          <h5 class="white">НАШИ ПРОЕКТЫ</h5>
          <ul class="list-group">
            <li><a target="_blank" href="http://wizardmachine.ru/">WIZARDMACHINE.RU</a></li>
            <li><a target="_blank" href="http://wizardduos.ru/">WIZARDDUOS.RU</a></li>
            <li><a target="_blank" href="http://wizardtarot.ru/">WIZARDTAROT.RU</a></li>
            <li><a target="_blank" href="http://braincleaner.ru/">BRAINCLEANER.RU</a></li>
            <li><a target="_blank" href="http://marakata.ru/">MARAKATA.RU</a></li>
          </ul>
          <h5 class="white">СОЦИАЛЬНЫЕ СЕТИ</h5>
          <ul class="list-group">
            <li><a target="_blank" href="https://vk.com/id139677998">Юрий Чикуров</a></li>
            <li><a target="_blank" href="https://vk.com/wizardmachine">WIZARDMACHINE</a></li>
          </ul>
        </div>
        <div class=" col-sm-6 col-xs-12 sitemap">
          <h5 class="white">КОНТАКТЫ</h5>
          <p><a href="mailto:info@bablosstudio.ru"><i class="fa fa-envelope-o fa-fw" style="margin-right: 5px;"></i>info@bablosstudio.ru</a></br><span class="white"><i class="fa fa-phone fa-fw" style="margin-right: 5px;"></i>+7 (495) 255-05-61</span></p>
          <p>
            <a class="btn btn-block btn-warning" href="#">Cоздать личную страницу</a>
            <div class="yashare-auto-init" data-yashareL10n="ru" data-yashareQuickServices="vkontakte,facebook,twitter,odnoklassniki,moimir" data-yashareTheme="counter"></div>
          </p>
        </div>
      </aside>
      <aside class="col-sm-5 contact-form col-xs-12 pull-right">
        <h5 class="white" style="margin-top: 0;">ЗАДАТЬ ВОПРОС</h5>
        <form id="contact" action="contact.php" name="contactform" method="post">
          <ul class="list-group">
            <li class="fname">
              <input name="name" id="name" type="text" placeholder="Имя:">
            </li>
            <li class="lname">
              <input name="email" id="email" type="text" placeholder="E-mail:">
            </li>
            <li>
              <input name="phone" id="phone" type="text" placeholder="Телефон:">
            </li>
            <li>
              <textarea name="comments" id="comments" cols="5" rows="5" placeholder="Сообщение:"></textarea>
            </li>
          </ul>
          <button type="submit" id="submit" class="btn btn-primary pull-right">Отправить</button>
        </form>
      </aside>
      <div class="col-xs-12 copyright-text">© 2016 - Все права защищены.<a href="http://www.chikurov.com/">chikurov.com</a></div>
      <!--row--> 
    </div>
    <a class="dmtop" href="#page-top"></a> 
    <!--container--> 
  </div>
</footer>
<!-- FOOTER ENDs
========================================================================= -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php bloginfo('template_url'); ?>/js/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php bloginfo('template_url'); ?>/js/bootstrap/bootstrap.min.js"></script>
<!--Jquery Easing--> 
<script src="<?php bloginfo('template_url'); ?>/js/jquery.easing.min.js"></script>
<!-- Owl Carousel --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/owl-carousel/js/owl.carousel.js"></script>
<!-- Popup Scripts --> 
<script src="<?php bloginfo('template_url'); ?>/js/jquery.prettyPhoto.js"></script>
<!-- Contact Form Scripts --> 
<script src="<?php bloginfo('template_url'); ?>/js/jquery.jigowatt.js"></script>
<!-- Custom --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/custom.js"></script>
<!-- Counter Scripts --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/countdown.js"></script>
<!-- Slider Revolution 4.x Scripts --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rs-plugin/jquery.themepunch.tools.min.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/rs-plugin/jquery.themepunch.revolution.min.js"></script> 
<!-- Masonary Porfilio Scripts --> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonary/masonry3.1.4.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonary/masonry.filter.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/masonary/imagesloaded.js"></script> 
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/vivus.js"></script>
<?php if(is_front_page()) { ?>
  <script type="text/javascript">
  jQuery(document).ready(function() {
  	jQuery('.tp-banner').show().revolution(
  	{
  		dottedOverlay:"none",
  		delay:16000,
  		startwidth:1170,
  		startheight:700,
  		hideThumbs:200,
  		
  		thumbWidth:100,
  		thumbHeight:50,
  		thumbAmount:5,
  		
  		navigationType:"bullet",
  		navigationArrows:"solo",
  		navigationStyle:"preview4",
  		
  		touchenabled:"on",
  		onHoverStop:"on",
  		
  		swipe_velocity: 0.7,
  		swipe_min_touches: 1,
  		swipe_max_touches: 1,
  		drag_block_vertical: false,
  								
  		parallax:"mouse",
  		parallaxBgFreeze:"on",
  		parallaxLevels:[7,4,3,2,5,4,3,2,1,0],
  								
  		keyboardNavigation:"off",
  		
  		navigationHAlign:"center",
  		navigationVAlign:"bottom",
  		navigationHOffset:0,
  		navigationVOffset:20,

  		soloArrowLeftHalign:"left",
  		soloArrowLeftValign:"center",
  		soloArrowLeftHOffset:20,
  		soloArrowLeftVOffset:0,

  		soloArrowRightHalign:"right",
  		soloArrowRightValign:"center",
  		soloArrowRightHOffset:20,
  		soloArrowRightVOffset:0,
  				
  		shadow:0,
  		fullWidth:"off",
  		fullScreen:"on",

  		spinner:"spinner4",
  		
  		stopLoop:"off",
  		stopAfterLoops:-1,
  		stopAtSlide:-1,

  		shuffle:"off",
  		
  		autoHeight:"off",						
  		forceFullWidth:"off",						
  						
  		hideThumbsOnMobile:"off",
  		hideNavDelayOnMobile:1500,						
  		hideBulletsOnMobile:"off",
  		hideArrowsOnMobile:"off",
  		hideThumbsUnderResolution:0,
  		
  		hideSliderAtLimit:0,
  		hideCaptionAtLimit:0,
  		hideAllCaptionAtLilmit:0,
  		startWithSlide:0,
  		fullScreenOffsetContainer: "#header"	
  	});
    new Vivus('test', {
        type: 'delayed',
        duration: 300
    }, function(){
      jQuery('.change').css({
        fill: '#fff'
      });
    })
  });	//ready
  </script>
<?php } ?>
<?php wp_footer(); ?>
</body>
</html>
