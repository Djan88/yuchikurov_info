jQuery(document).ready(function() {
	
	// Change opacity of all tabs
	jQuery('#sa-tabs li').children('a').animate({ opacity: 0.4 }, 0);
	
	// Click action
	jQuery('#sa-tabs li').click(function(){
		var tabTarget = jQuery(this).children('a').attr('href').split('#tab-');
		jQuery('#sa-tabs li').removeClass('sa-current-tab').children('a').animate({ opacity: 0.4 }, 0);;
		jQuery(this).addClass('sa-current-tab').children('a').animate({ opacity: 1 }, 0);
		jQuery('#sa-panes .sa-pane').hide();
		jQuery('#pane-' + tabTarget[1]).fadeIn(300);
		jQuery('input[name="current-tab"]').attr('value', '#tab-' + tabTarget[1]);
	});

	// Change opacity on hover
	jQuery('#sa-tabs li').not('.sa-current-tab').children('a').hover(function() {
		jQuery(this).animate({opacity: 1}, 0);
	}, function() {
		jQuery(this).animate({opacity: 0.4}, 0);
		jQuery('#sa-tabs .sa-current-tab').children('a').animate({ opacity: 1 }, 0);
	});
	
	// Open first tab
	jQuery('#sa-tabs li:first').click();
	
	// Open tab from anchor
	var goTab = location.href.split('#');
	jQuery('a[href="#' + goTab[1] + '"]').parent('li').click();
	
	jQuery('.sa-notification div').click(function(){
		jQuery(this).slideUp(300);
	});
	
	// Toggle
	jQuery('.sa-box-title-toggle').click(function() {
		jQuery(this).next('.sa-pane-toggle').slideToggle(400);
	});
	
	// Color picker
	jQuery('.color-pick').ColorPicker({
		onSubmit: function(hsb, hex, rgb, el) {
			jQuery(el).val(hex);
			jQuery(el).ColorPickerHide();
		},
		onBeforeShow: function () {
			jQuery(this).ColorPickerSetColor(this.value);
		}
	})
	.bind('keyup', function(){
		jQuery(this).ColorPickerSetColor(this.value);
	});

});