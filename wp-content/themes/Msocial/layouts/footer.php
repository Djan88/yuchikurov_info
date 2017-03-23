<?php 
    
    /**
     *
     * Template footer
     *
     **/
    
    // create an access to the template main object
    global $tpl;
    
    // disable direct access to the file    
    defined('GAVERN_WP') or die('Access denied');
    
?>
        <footer id="gk-footer">
            <div class="gk-page">           
                <?php gavern_menu('footermenu', 'gk-footer-menu'); ?>
            </div>
        </footer>
        
        <?php if(get_option($tpl->name . '_styleswitcher_state', 'Y') == 'Y') : ?>
        <div id="gk-style-area">
            <?php for($i = 0; $i < count($tpl->styles); $i++) : ?>
            <div class="gk-style-switcher-<?php echo $tpl->styles[$i]; ?>">
                <?php 
                    $j = 1;
                    foreach($tpl->style_colors[$tpl->styles[$i]] as $stylename => $link) : 
                ?> 
                <a href="#<?php echo $link; ?>" id="gk-color<?php echo $j++; ?>"><?php echo $stylename; ?></a>
                <?php endforeach; ?>
            </div>
            <?php endfor; ?>
        </div>
        <?php endif; ?>
        
    </div> <!-- #gk-content-wrapper -->
</div> <!-- #gk-bg -->

<?php gk_load('login'); ?>

<?php gk_load('social'); ?>

<?php do_action('gavernwp_footer'); ?>

<?php 
    echo stripslashes(
        htmlspecialchars_decode(
            str_replace( '&#039;', "'", get_option($tpl->name . '_footer_code', ''))
        )
    ); 
?>

<?php wp_footer(); ?>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-416286-11']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<?php do_action('gavernwp_ga_code'); ?>
<script src="<?php bloginfo('template_url'); ?>/js/script.js"></script>
</body>
</html>
