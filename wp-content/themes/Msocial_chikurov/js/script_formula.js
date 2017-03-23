jQuery(function() {
    var this_time,
        endSound = new buzz.sound( "/wp-content/themes/Msocial_chikurov/sound/rock", {
                formats: [ "ogg", "mp3" ]
            });

    jQuery('body').on('mouseover touchstart', '.formula-wrap.active, .sim_right, .sim_left, .sim_center', function(event) {
        if (!jQuery('.popover_static').hasClass('visible')) {
            jQuery('.popover_static').addClass('visible');
        }
    });
    jQuery('body').on('mouseout', '.formula-wrap.active, .sim_right, .sim_left, .sim_center', function(event) {
        if (jQuery('.popover_static').hasClass('visible')) {
            jQuery('.popover_static').removeClass('visible');
        }
    });
    jQuery('body').on('touchend', '.popover_static', function(event) {
            jQuery('.popover_static').removeClass('visible');
    });

    jQuery('.formula-wrap').on('click touchstart', function(event) {
        jQuery('.popover_static').removeClass('visible');
        if (jQuery(this).hasClass('visible')) {
            
        } else {
            endSound.play();
        }
        jQuery('.popover_static_title').text(jQuery(this).find('svg').data('original-title'))
        jQuery('.popover_static_content').text(jQuery(this).find('svg').data('content'))
        jQuery('.formula-wrap').removeClass('active');
        jQuery(this).addClass('active');
        this_time = jQuery(this).data('time');
        jQuery('.circle_outside').css({
            transform: 'rotate('+this_time+'deg)'
        });
    });
})
