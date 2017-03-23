<?php

/**
 *
 * 404 Page
 *
 **/
 
global $tpl; 

gk_load('header');
gk_load('before');

?>

<section id="gk-mainbody" class="page404 text-center">
	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 login-box">
	  <aside class="col-xs-12 textbox error_box">
	    <h3>Ошибка!<span>Похоже страницы которую вы ищите не существует</span></h3>
	    <h1>404</h1>
	    <div class="input-group">
	    	<form role="search" id="searchform" action="<?php bloginfo('siteurl'); ?>" method="get">
    	        <input id="s" class="form-control" type="text" name="s" value="" placeholder="Попробуйте воспользоваться поиском по сайту">
    	        <span class="input-group-btn">
    	        	<input id="go" class="btn btn-default" type="submit" value="">
    	        </span>
	    	</form>
	    </div>
	    <div class="clearfix"></div>
	    <!--textbox--> 
	  </aside>
	  <div class="copyright-text">© 2017 - Все права защищены.<a href="http://www.chikurov.com/">chikurov.com</a></div>
	  <!--login-box--> 
	</div>
</section>

<?php

gk_load('after');
gk_load('footer');

// EOF
