jQuery(document).ready(function(){
    var desc_holder = jQuery('body.groups #item-nav');
    var desc_holder_p = jQuery('p', desc_holder);
    var desc_holder_other = jQuery('body.groups #item-nav > :not(p, script)');
    
    function do_desc_changes(){
        var desc_origin = '';
        var desc_holder_p_count = desc_holder_p.length;
        
        // now we need to get content depending on how many paragraphs are there in desc
        if(desc_holder_p_count == 1){
            desc_origin = desc_holder_p.html();
        }else{
            for(var i = 0; i < desc_holder_p_count; i++){
                desc_origin += desc_holder_p[i].innerHTML;
                if ( (i+1) < desc_holder_p_count)
                    desc_origin += '<br/><br/>';
            }
        }
        // in case we have paragraphs - remove them all. We will create later only one
        desc_holder_p.remove();
        
        // lets form the output
        var desc        = desc_origin.split(' ');
        var desc_short  = '';

        if ( desc.length > bpgd.words ){
            for(var i = 0; i < bpgd.words; i++){
                desc_short += desc[i] + ' ';
            }
            desc_short  = '<p>'+desc_short+'... <a href="#" id="more_desc">'+bpgd.more+'</a></p>';
        }else{
            desc_short = desc_origin;
        }
        
        // insert and display
        desc_holder.prepend(desc_short);
        jQuery('p', desc_holder).fadeIn('fast');
        
        return {
                    origin: '<p>'+desc_origin+'</p>',
                    shortened: desc_short,
                    other: desc_holder_other.html()
                };
    }
    
    var desc = do_desc_changes();
    
    // reveal full desc
    jQuery('a#more_desc').on('click', 'a#more_desc', function(e) {
        e.preventDefault();
        desc_holder.html(desc.origin + desc.other);
    });
    // hide full desc
    jQuery('a#more_desc').on('click', 'a#more_desc', function(e) {
        e.preventDefault();
        desc_holder.html(desc.shortened + desc.other);
    });
    
    // plugin to count characters in textarea
    jQuery.fn.charCounter = function(options){
        // default properties
        var defaults = {
            allowed: bpgd.words,
            cssWarning: 'warning',
            counterText: bpgd.counter + ' '
        };
        var options = jQuery.extend(defaults, options);
        if(jQuery('span.counter').length < 1){
            var label = jQuery('label[for=group-desc]');
            jQuery(label).append('<span class="counter"></span>');
        }
        var label_c = jQuery('span.counter', label);
        function calc(obj){
            if(bpgd.redactor == 'off'){
                var desc = jQuery.trim(jQuery(obj).val()).split(' ');
            }else{
                var desc = jQuery.trim(jQuery(obj).html()).split(' ');
            }
            var available = options.allowed - desc.length;
            if(available < 0){
                jQuery(label_c).addClass(options.cssWarning);
            } else {
                jQuery(label_c).removeClass(options.cssWarning);
            }
            jQuery(label_c).html(options.counterText + desc.length);
        };
        this.each(function() {
            calc(this);
            jQuery(this).keyup(function(){calc(this)});
            jQuery(this).change(function(){calc(this)});
        });
    };

    // Display chars
    if(bpgd.redactor == 'off' && bpgd.w_count == 'on'){
        jQuery('textarea[name="group-desc"]').charCounter();
    }
});
