jQuery(document).ready(function() {
    var valueNow,
        highlighter,
        scr_w = jQuery(window).width(),
        tickSound = new buzz.sound( "/wp-content/themes/Msocial_chikurov/sound/seif", {
            formats: [ "ogg", "mp3" ]
        });
    if (scr_w <= 720) {
        $("#handle1").roundSlider({
            min: 0,
            max: 12000,
            step: 1000,
            value: 0,
            radius: 110,
            sliderType: "min-range",
            editableTooltip: false,
            handleSize: 0,
            tooltipFormat: "changeTooltip"
        });
    } else {
        $("#handle1").roundSlider({
            min: 0,
            max: 12000,
            step: 1000,
            value: 0,
            radius: 200,
            sliderType: "min-range",
            editableTooltip: false,
            handleSize: 0,
            tooltipFormat: "changeTooltip"
        });
    }
    highlighter = function(){
        console.log(jQuery('.rs-handle').attr('aria-valuenow'));
        tickSound.play();
        jQuery('.elem_pos').each(function(index, el) {
            jQuery(this).removeClass('elem_pos_active')
        });
        if (valueNow == 0 || valueNow == 4000 || valueNow == 8000 || valueNow == 12000) {
            jQuery('.elem_pos_d').each(function(index, el) {
                jQuery(this).addClass('elem_pos_active');
            });
        } else if (valueNow == 1000 || valueNow == 5000 || valueNow == 9000) {
            jQuery('.elem_pos_t').each(function(index, el) {
                jQuery(this).addClass('elem_pos_active');
            });
        }  else if (valueNow == 2000 || valueNow == 6000 || valueNow == 10000) {
            jQuery('.elem_pos_r').each(function(index, el) {
                jQuery(this).addClass('elem_pos_active');
            });
        }   else if (valueNow == 3000 || valueNow == 7000 || valueNow == 11000) {
            jQuery('.elem_pos_s').each(function(index, el) {
                jQuery(this).addClass('elem_pos_active');
            });
        }
    }
    $("#handle1").on("drag", function (e) {
        valueNow = jQuery('.rs-handle').attr('aria-valuenow');
        highlighter();
    })

    jQuery('.elem_pos').on("click", function (e) {
        var elPos = jQuery(this).data('ring');
        var elNum = jQuery(this).data('el');
        jQuery('.elem_pos').removeClass('elem_pos_active');
        if(elNum == 1){
            jQuery('.elem_pos_d').addClass('elem_pos_active');
        } else if(elNum == 2){
            jQuery('.elem_pos_t').addClass('elem_pos_active');
        } else if(elNum == 3){
            jQuery('.elem_pos_s').addClass('elem_pos_active');
        } else if(elNum == 4){
            jQuery('.elem_pos_r').addClass('elem_pos_active');
        }
        jQuery('.rs-bar').css('transform', elPos);
        tickSound.play();
    })

});
