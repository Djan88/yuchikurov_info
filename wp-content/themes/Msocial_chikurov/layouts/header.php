<?php 
	
	/**
	 *
	 * Template header
	 *
	 **/
	
	// create an access to the template main object
	global $tpl;
	
?>
<?php do_action('gavernwp_doctype'); ?>
<html <?php do_action('gavernwp_html_attributes'); ?>>
<head>
<title><?php do_action('gavernwp_title'); ?></title>
	<?php do_action('gavernwp_metatags'); ?>
	
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="shortcut icon" href="<?php get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <meta name='yandex-verification' content='67af68895907f13a' />
	<link href="<?php bloginfo('template_url'); ?>/css/all-stylesheets.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('template_url'); ?>/css/rs-slider/settings.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url'); ?>/css/rs-slider/extralayers.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url'); ?>/css/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url'); ?>/css/jquery-ui.structure.min.css" rel="stylesheet" type="text/css">
    <link href="<?php bloginfo('template_url'); ?>/css/jquery-ui.theme.min.css" rel="stylesheet" type="text/css">
	<link href="<?php bloginfo('template_url'); ?>/css/style_formula.css" rel="stylesheet" type="text/css">
    <?php if (is_page(3746)) { ?>
        <link href="<?php bloginfo('template_url'); ?>/css/roundslider.css" rel="stylesheet" type="text/css">
        <link href="<?php bloginfo('template_url'); ?>/css/style_el.css" rel="stylesheet" type="text/css">
    <?php } ?>
	<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/images/favicon.ico" type="image/ico">
    <meta name="yandex-verification" content="f7486773bdfff0eb" />
	<!--[if IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie9.css'); ?>" />
	<![endif]-->
	<!--[if lt IE 9]>
	<link rel="stylesheet" href="<?php echo gavern_file_uri('css/ie8.css'); ?>" />
	<![endif]-->
	
	<?php if(is_singular() && get_option('thread_comments' )) wp_enqueue_script( 'comment-reply' ); ?>
	
	<?php do_action('gavernwp_ie_scripts'); ?>
	
	<?php gk_head_shortcodes(); ?>
	  
	<?php 
	    gk_load('responsive_css'); 
	    
	    if(get_option($tpl->name . "_overridecss_state", 'Y') == 'Y') {
	      wp_enqueue_style('gavern-override', gavern_file_uri('css/override.css'), array('gavern-style'));
	    }
	?>
	
	<?php
	    if(get_option($tpl->name . '_prefixfree_state', 'N') == 'Y') {
	      wp_enqueue_script('gavern-prefixfree', gavern_file_uri('js/prefixfree.js'));
	    } 
	?>
	
	<?php gk_head_style_css(); ?>
	<?php gk_head_style_pages(); ?>
	
	<?php gk_thickbox_load(); ?>
	<?php wp_head(); ?>
	
	<?php do_action('gavernwp_fonts'); ?>
	<?php gk_head_config(); ?>
	<?php wp_enqueue_script("jquery"); ?>
	
	<?php
	    wp_enqueue_script('gavern-scripts', gavern_file_uri('js/gk.scripts.js'), array('jquery'), false, true);
	    wp_enqueue_script('gavern-menu', gavern_file_uri('js/gk.menu.js'), array('jquery', 'gavern-scripts'), false, true);
            wp_enqueue_script('jquery-ui-datepicker');           
            wp_enqueue_script('md5', gavern_file_uri('js/md5.js'), array('jquery', 'gavern-scripts'), false, true);
            wp_enqueue_script('mosaic', gavern_file_uri('js/mosaic.1.0.1.js'), array('jquery', 'gavern-scripts'), false, true);
	?>
	
	<?php do_action('gavernwp_head'); ?>
	
	<?php 
		echo stripslashes(
			htmlspecialchars_decode(
				str_replace( '&#039;', "'", get_option($tpl->name . '_head_code', ''))
			)
		); 
	?>
	
        <script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>
        
	<!--[if lte IE 9]>
	<script src="<?php echo gavern_file_uri('js/ie9.js'); ?>"></script>
	<script src="<?php echo gavern_file_uri('js/selectivizr.js'); ?>"></script>
	<![endif]-->
      <?php wp_head(); ?>
      <?php if (is_user_logged_in()&& !current_user_can('administrator')) { ?>
            <style>
                  html
                  {
                        margin-top: 0!important
                  }
                  #wpadminbar
                  {
                        display: none!important;
                  }
            </style>
      <?php } ?>
</head>
<body <?php do_action('gavernwp_body_attributes'); ?>>	
<div id="loader"></div>
<div id="section-home">
  <header id="header"> 
    <!-- NAVIGATION STARTS
========================================================================= -->
    <nav id="navigation">
      <div class="navbar navbar-inverse" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
          <!--  Logo Starts -->
          <a class="navbar-brand" href="/">
            <img class="logo_bg" src="<?php bloginfo('template_url'); ?>/images/logo chicurov-5.png" alt="">
            <svg id="treangle" version="1.0" xmlns="http://www.w3.org/2000/svg"
             width="300.000000pt" height="350.000000pt" viewBox="0 0 300.000000 350.000000"
             preserveAspectRatio="xMidYMid meet">
            <metadata>
            Created by potrace 1.10, written by Peter Selinger 2001-2011
            </metadata>
            <g transform="translate(0.000000,350.000000) scale(0.050000,-0.050000)"
            fill="#000000" stroke="none">
            <path d="M3092 6889 c-22 -57 -13 -143 18 -169 42 -35 84 61 59 134 -23 63
            -59 80 -77 35z"/>
            <path d="M2813 6705 c-32 -191 12 -325 120 -366 161 -61 123 264 -46 394 l-62
            48 -12 -76z"/>
            <path d="M3294 6696 c-63 -98 -68 -154 -18 -217 l37 -44 45 57 c38 47 44 76
            37 154 -13 136 -37 148 -101 50z"/>
            <path d="M2504 6615 c31 -165 100 -246 200 -232 106 15 29 209 -116 292 -105
            60 -105 60 -84 -60z"/>
            <path d="M2244 6651 c-32 -70 -30 -121 5 -150 65 -54 103 88 45 167 -24 33
            -28 32 -50 -17z"/>
            <path d="M3913 6619 c-53 -42 -72 -125 -34 -149 33 -20 101 67 101 130 0 71 0
            71 -67 19z"/>
            <path d="M2162 6527 c21 -42 38 -101 38 -131 0 -36 11 -56 30 -56 52 0 -4 177
            -75 236 -25 21 -24 10 7 -49z"/>
            <path d="M3594 6529 c-45 -93 -43 -175 5 -218 81 -74 144 63 92 199 -41 108
            -54 111 -97 19z"/>
            <path d="M1760 6528 c0 -112 197 -240 217 -141 19 101 -27 156 -152 180 -60
            11 -65 8 -65 -39z"/>
            <path d="M3103 6347 c-92 -124 -111 -239 -52 -323 100 -142 249 131 189 346
            -32 114 -36 113 -137 -23z"/>
            <path d="M3837 6383 c-175 -112 -532 -578 -495 -647 26 -48 14 -61 209 224 86
            127 213 286 281 355 138 139 139 152 5 68z"/>
            <path d="M4066 6398 c-115 -33 -162 -143 -77 -181 64 -29 140 17 178 109 41
            97 25 108 -101 72z"/>
            <path d="M3323 6252 c-47 -171 87 -328 154 -180 34 75 29 100 -39 177 -77 88
            -91 88 -115 3z"/>
            <path d="M1824 6281 c360 -46 513 -162 754 -569 128 -216 128 -217 156 -165
            24 47 22 63 -26 158 -213 420 -427 574 -818 586 -187 6 -191 6 -66 -10z"/>
            <path d="M2553 6238 c-71 -101 -23 -286 62 -241 79 43 82 145 8 241 l-37 47
            -33 -47z"/>
            <path d="M1501 6221 c-30 -55 -27 -61 27 -61 53 0 102 47 83 79 -22 35 -88 24
            -110 -18z"/>
            <path d="M4287 6196 c-108 -114 -129 -186 -84 -285 77 -168 231 135 160 315
            -12 31 -21 27 -76 -30z"/>
            <path d="M1822 6183 c-56 -78 -54 -83 28 -83 131 0 200 124 76 136 -49 5 -70
            -6 -104 -53z"/>
            <path d="M2065 6064 c-78 -41 -74 -60 22 -110 142 -74 301 -1 206 95 -59 59
            -133 64 -228 15z"/>
            <path d="M3685 6087 c-49 -20 -26 -67 33 -67 69 0 120 49 71 68 -37 14 -68 13
            -104 -1z"/>
            <path d="M3854 6064 c-81 -89 -96 -238 -34 -340 l41 -66 57 40 c105 75 119
            150 51 277 -71 130 -75 134 -115 89z"/>
            <path d="M2855 6023 c-166 -109 -159 -331 7 -242 55 29 75 94 60 194 l-12 85
            -55 -37z"/>
            <path d="M4786 5995 c-62 -69 -70 -91 -47 -133 17 -32 6 -49 -71 -113 -89 -72
            -208 -217 -208 -252 0 -42 40 -8 122 105 48 68 124 154 168 192 44 38 67 63
            50 54 -16 -9 -10 9 15 41 79 100 53 197 -29 106z"/>
            <path d="M1700 5993 c0 -45 118 -202 170 -227 142 -68 212 6 120 126 -55 72
            -290 153 -290 101z"/>
            <path d="M1415 5926 c-72 -11 -69 -29 16 -104 115 -102 263 -88 225 20 -31 90
            -81 108 -241 84z"/>
            <path d="M4404 5854 c-109 -131 -38 -348 76 -234 51 51 51 108 -2 193 -47 76
            -46 76 -74 41z"/>
            <path d="M3501 5811 c-34 -40 -9 -71 55 -70 64 0 133 48 115 78 -20 31 -142
            26 -170 -8z"/>
            <path class="wom" d="M3079 5702 c-23 -114 -56 -174 -246 -449 l-78 -111 -10 -256 -10
            -256 92 -288 c166 -514 108 -621 -467 -859 -230 -95 -341 -245 -260 -349 52
            -65 137 -70 400 -24 535 94 582 6 526 -980 -10 -176 -29 -340 -42 -364 -40
            -73 -28 -100 69 -154 152 -85 210 -56 111 56 -69 79 -65 153 27 452 35 113 58
            247 69 402 15 221 42 341 160 698 65 197 69 338 18 563 l-45 201 43 193 c80
            360 90 461 77 729 -15 295 -12 286 -184 479 -125 140 -149 187 -178 360 -18
            108 -46 92 -72 -43z m173 -383 l104 -169 6 -220 c7 -250 -27 -350 -104 -309
            -46 25 -50 131 -7 188 35 47 38 228 3 273 -163 212 -389 -35 -261 -287 50
            -100 43 -157 -22 -182 -93 -35 -138 444 -54 564 21 29 63 103 93 163 102 204
            102 204 242 -21z m-172 -1989 c0 -48 -5 -50 -130 -50 -73 0 -130 9 -130 20 0
            11 2 20 5 20 3 0 41 14 85 29 125 45 170 40 170 -19z"/>
            <path d="M4069 5705 c-120 -148 -144 -269 -71 -364 l38 -48 60 60 c81 81 108
            185 82 310 -27 125 -38 129 -109 42z"/>
            <path d="M4713 5723 c-62 -68 26 -105 127 -53 72 37 76 61 15 77 -74 20 -107
            15 -142 -24z"/>
            <path d="M980 5705 c0 -61 75 -121 93 -75 16 43 -15 98 -60 106 -21 5 -33 -7
            -33 -31z"/>
            <path d="M3554 5594 c-78 -179 -71 -277 28 -376 121 -121 208 185 108 381 -68
            135 -75 135 -136 -5z"/>
            <path d="M2160 5687 c-16 -6 -43 -14 -58 -19 -38 -12 80 -135 169 -177 137
            -65 321 -8 272 84 -53 98 -251 156 -383 112z"/>
            <path d="M1699 5661 c-162 -49 -171 -82 -40 -139 127 -54 186 -53 253 5 99 85
            -55 182 -213 134z"/>
            <path d="M1209 5635 c-7 -20 -10 -62 -5 -94 l9 -59 -52 36 c-51 36 -121 67
            -121 54 0 -4 34 -29 75 -57 42 -27 93 -82 115 -122 21 -40 51 -73 65 -73 34 0
            32 14 -15 80 -35 49 -36 59 -10 80 41 34 38 86 -9 143 -34 43 -39 44 -52 12z"/>
            <path d="M4627 5531 c-73 -32 -112 -92 -103 -160 13 -98 188 13 226 144 15 54
            -25 59 -123 16z"/>
            <path d="M1380 5489 c0 -91 110 -209 193 -209 88 0 74 164 -18 197 -104 39
            -175 43 -175 12z"/>
            <path d="M4296 5479 c-101 -76 -123 -239 -31 -239 94 0 135 52 135 171 0 121
            -17 132 -104 68z"/>
            <path d="M4933 5459 c-63 -50 -68 -92 -13 -109 78 -25 110 0 176 135 16 33
            -114 12 -163 -26z"/>
            <path d="M973 5447 c-54 -29 -55 -32 -20 -57 101 -70 268 -29 198 49 -44 48
            -99 51 -178 8z"/>
            <path d="M2248 5385 c6 -30 17 -91 24 -135 25 -150 109 -239 239 -254 125 -13
            57 252 -91 353 -129 90 -185 101 -172 36z"/>
            <path d="M1887 5385 c5 -19 16 -57 24 -85 7 -27 33 -72 56 -98 l43 -48 -50 14
            c-318 88 -641 39 -1085 -163 -195 -89 -191 -102 8 -25 628 244 877 218 1525
            -157 209 -121 192 -117 192 -46 0 67 -104 144 -377 282 -168 84 -188 99 -128
            94 38 -3 39 83 2 153 -45 83 -231 153 -210 79z"/>
            <path d="M4660 5297 c-401 -46 -945 -383 -987 -612 -16 -85 -8 -83 122 36 371
            339 784 518 1280 553 l215 15 -130 13 c-174 18 -320 16 -500 -5z"/>
            <path d="M3785 5208 c-99 -83 -117 -186 -46 -266 95 -110 219 105 168 293 -15
            59 -21 57 -122 -27z"/>
            <path d="M884 5246 c-59 -12 -48 -45 35 -101 116 -78 214 -48 160 49 -31 57
            -91 73 -195 52z"/>
            <path d="M5240 5241 c-34 -22 -13 -50 50 -68 67 -20 109 19 60 56 -47 35 -69
            37 -110 12z"/>
            <path d="M4765 5207 c-67 -27 27 -127 119 -127 65 1 136 22 136 41 0 53 -183
            115 -255 86z"/>
            <path d="M1246 5076 c-45 -22 -106 -127 -106 -184 0 -29 9 -28 78 7 81 41 102
            73 102 153 0 53 -9 56 -74 24z"/>
            <path d="M1544 5069 c-47 -33 -104 -129 -104 -174 0 -47 199 -11 243 44 97
            120 -10 220 -139 130z"/>
            <path d="M582 5042 c-54 -35 61 -115 128 -89 38 14 38 36 -1 76 -35 34 -84 40
            -127 13z"/>
            <path d="M4287 5030 c-39 -102 105 -163 252 -106 l51 19 -69 59 c-79 66 -213
            82 -234 28z"/>
            <path d="M872 4917 c-40 -57 -41 -117 -3 -117 34 0 115 98 105 128 -14 41 -70
            34 -102 -11z"/>
            <path d="M1875 4929 c-45 -25 -135 -157 -135 -198 0 -49 267 47 299 108 61
            112 -30 162 -164 90z"/>
            <path d="M3980 4826 c-117 -43 -124 -112 -18 -155 101 -40 314 21 317 91 2 42
            -227 90 -299 64z"/>
            <path d="M2190 4735 c-124 -177 -130 -192 -87 -206 115 -36 316 52 348 153 30
            95 -199 142 -261 53z"/>
            <path d="M2806 1578 c-37 -24 -73 -70 -87 -111 -13 -39 -51 -103 -85 -144
            l-62 -73 64 59 c36 33 80 94 99 137 25 56 60 91 125 125 59 31 76 47 50 48
            -22 0 -69 -18 -104 -41z"/>
            <path d="M3495 1608 c-7 -7 -56 -15 -109 -18 -95 -6 -161 -70 -72 -70 111 0
            166 -72 156 -205 -8 -116 -8 -119 10 -37 26 119 31 120 82 12 50 -106 107
            -148 292 -213 109 -38 126 -51 128 -96 2 -34 6 -39 12 -16 11 43 24 44 87 2
            l49 -34 -48 53 c-27 29 -66 59 -88 66 -129 41 -180 72 -152 91 20 15 13 18
            -28 11 -90 -14 -173 58 -263 231 -45 84 -94 157 -111 161 -40 10 66 54 130 54
            26 0 77 -24 113 -52 l67 -53 -65 63 c-61 58 -157 83 -190 50z"/>
            <path d="M3014 1546 c-6 -9 -25 -74 -44 -146 -26 -100 -50 -143 -107 -195
            l-73 -66 72 41 72 41 48 -176 c26 -96 46 -193 43 -215 -14 -103 -74 -212 -136
            -251 -39 -24 -84 -79 -111 -135 -24 -52 -63 -115 -86 -140 -31 -35 -33 -43 -8
            -34 21 9 36 1 42 -24 6 -25 10 -20 12 17 3 79 55 189 117 246 75 70 76 70 69
            -96 -4 -80 2 -177 13 -215 l19 -68 2 76 c2 71 5 74 47 53 38 -18 37 -14 -10
            29 -72 65 -70 109 16 357 51 145 69 227 62 280 -11 86 -11 85 68 44 59 -30 69
            -54 62 -149 -3 -37 1 -43 14 -22 15 22 23 20 40 -13 12 -22 38 -46 57 -54 29
            -11 28 -5 -7 33 -23 25 -60 87 -81 136 -28 63 -62 102 -113 130 -115 62 -144
            209 -75 389 34 91 15 191 -24 127z"/>
            </g>
            </svg>
            <img src="<?php bloginfo('template_url'); ?>/images/apples-gold.png" class="logo_apple" alt="">
            
          </a> 
          <!-- Logo Ends --> 
        </div>

        <div class="consultation_wrap">
            <div class="consultaiton consultaiton-two pull-right">
                <span><i class="fa fa-phone fa-fw" style="margin-right: 5px;"></i>+7 (495) 135-25-48</span>
            </div>
            <div class="consultaiton consultaiton-one pull-right">
                <a href="#" data-toggle="modal" data-target="#quest">
                    <i class="fa fa-envelope-o fa-fw" style="margin-right: 5px;"></i>ЗАДАТЬ ВОПРОС</a>
            </div>
            <div class="consultaiton header_media pull-right">
                <a href="http://vk.com/id139677998" target="_blank" class="header_socials header_socials_vk"><i class="fa fa-vk" aria-hidden="true"></i></a>
                <a href="https://www.facebook.com/profile.php?id=100012253260685&pnref" target="_blank" class="header_socials header_socials_fb"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a href="https://www.youtube.com/user/ThePractik01/" target="_blank" class="header_socials header_socials_yt"><i class="fa fa-youtube" aria-hidden="true"></i></a>
                <a href="https://www.instagram.com/yuchikurov/" target="_blank" class="header_socials header_socials_in"><i class="fa fa-instagram" aria-hidden="true"></i></a>
            </div>
        </div>
        <div class="collapse navbar-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="/"><span class="fa fa-home"></span></a></li>
            <li><a href="/biologicheskoe-centrirovanie/">Биологическое центрирование</a></li>
            <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">Визардмашины<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="http://wizardmachine.ru/">Wizard Machine</a></li>
                <li><a href="http://wizardduos.ru/">Wizard Duos</a></li>
                <li><a href="http://marakata.ru/">Marakata</a></li>
                <li><a href="http://braincleaner.ru/">Braincleaner</a></li>
                <li><a href="/formuly-bc/">Формулы</a></li>
                <li><a href="/pervoelementy/">Первоэлементы</a></li>
              </ul>
            </li>
            <li><a href="/reestr/ ">Реестр специалистов</a></li>
            <!-- <li><a href="/seminar">Семинары мастеров</a></li> -->
            <?php if (is_user_logged_in()) { ?>
            <?php $current_user = wp_get_current_user();?>
            <li><a href="<?php echo '/members/';?><?php echo $current_user->user_login;?>"><span class="fa fa-user"></span></a></li>
            <?php } ?>
          </ul>
          <ul class="nav navbar-nav nav_top_rt">
<!--            --><?php //if(is_user_logged_in()){ ?>
<!--                  <li><a class="button button-primary button-large" href="--><?php //echo home_url(); ?><!--/wp-login.php?action=logout&_wpnonce=a9698dd03f">Выйти</a></li>-->
<!--            --><?php //} else { ?>
<!--                  <li><a href="/wp-login.php">Войти</a></li>-->
<!--            --><?php //} ?>
            <li class="search" id="dmsearch"><a href="#" class="fa fa-search"></a>
                  <form role="search" id="searchform" action="<?php bloginfo('siteurl'); ?>" method="get">
                        <div class="dm-search-container">
                              <input id="s" class="dmsearch-input" type="text" name="s" value="" placeholder="Поиск по сайту">
                        </div>
                        <input id="go" class="dmsearch-submit" type="submit" value="">
                        <span class="searchicon"></span>
                  </form>
              <!-- end searchform --> 
            </li>
          </ul>
        </div>
        <!--/.nav-collapse --> 
      </div>
      <div class="navspacer"></div>
    </nav>
    <!-- /. NAVIGATION ENDS
========================================================================= --> 
  </header>

		
		
		<?php if(gk_is_active_sidebar('header_bottom')) : ?>
		<div id="gk-header-bottom">
			<div class="widget-area">
				<?php gk_dynamic_sidebar('header_bottom'); ?>
			</div>
		</div>
		<?php endif; ?>
