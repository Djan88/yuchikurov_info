jQuery(function() {
    jQuery('.video').find('iframe').css('height', '400px');
    var wideoHeight = function(){
        var video_w = parseFloat(jQuery('.video').find('iframe').css('width'));
        jQuery('.video').find('iframe').css('height', video_w/1.5+'px');
    }
    wideoHeight();
    jQuery(window).resize(function() {
      console.log(parseFloat(jQuery('.video').find('iframe').css('width')));
      wideoHeight();
    });
    var flag = false;
    jQuery(".btn_styled").css("boxShadow", "0 0 90px #db4a37 inset");
    setTimeout(function () {
        jQuery(".btn_styled").css("boxShadow", "0 0 90px #db4a37 inset");
        setInterval(function () {
            jQuery(".btn_styled").css("boxShadow", flag? "0 0 90px #db4a37 inset":"0 0 30px #db4a37 inset");
            flag = !flag;
        }, 500)
    }, 2000);
    // if(jQuery('body').find('.member-nav')){
    //     jQuery('.users-preview').addClass('hidden');
    // }
});
