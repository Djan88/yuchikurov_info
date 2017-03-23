// JavaScript Document
$(document).ready(function() {

    'use strict';


    // ANCHOR SCROLL Top
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 1) {
            jQuery('.dmtop').css({
                bottom: "25px"
            });
        } else {
            jQuery('.dmtop').css({
                bottom: "-100px"
            });
        }
    });
    jQuery('.dmtop').on("click",function() {
        jQuery('html, body').animate({
            scrollTop: '0px'
        }, 800);
        return false;
    });

    // FIXED Menu
    jQuery('.navbar').affix({
        offset: {
            top: 1
        }
    });

    /**********ANCHOR SCROLL SCRIPT STARTS */
    $('a.page-scroll').on("bind", function(event) {
        var $anchor = $(this);
        $('html, body').stop().animate({
            scrollTop: ($($anchor.attr('href')).offset().top - 70)
        }, 1500, 'easeInOutExpo');
        event.preventDefault();
    });
    /**********OUR SERVICES STARTS */

    //Sort random function

    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            $(this).appendTo(owlSelector);
        });
    }

    $(".services-carousel").owlCarousel({
        autoPlay: false,
        slideSpeed: 500,
        items: 4,
        itemsDesktop: [1199, 4],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 2],
        itemsMobile: [667, 1],
        autoHeight: true,
        pagination: false,
        navigation: true,
        transitionStyle: "fade",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

    /************************************************** PORTFOLIO SECTION */

    if ($("#porfolio-masonry").length > 0) {
        var self = $("#porfolio-masonry");
        self.imagesLoaded(function() {
            self.masonry({
                gutter: 0,
                isAnimated: true,
                itemSelector: ".porfolio_smallbox"
            });
        });
        $(".portfolio-section .filter").on("click",function(e) {
            e.preventDefault();
            $(this).parents('#cartegories').find('li a').removeClass('active')
            $(this).addClass('active');
            var filter = $(this).attr("data-filter");

            self.masonryFilter({
                filter: function() {
                    if (!filter) return true;
                    return $(this).attr("data-filter") == filter;
                }
            });
        });
    }

    /*********************************************** TESTIMONIAL SCRIPT */
    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            $(this).appendTo(owlSelector);
        });
    }

    $(".testimonial-carousel").owlCarousel({
        autoPlay: true,
        slideSpeed: 500,
        items: 1,
        itemsDesktop: [1199, 1],
        itemsDesktopSmall: [979, 1],
        itemsTablet: [768, 1],
        itemsMobile: [667, 1],
        autoHeight: true,
        pagination: true,
        navigation: false,
        transitionStyle: "backSlide",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

    /************************************************* PARTNER SCRIPT */
    function random(owlSelector) {
        owlSelector.children().sort(function() {
            return Math.round(Math.random()) - 0.5;
        }).each(function() {
            $(this).appendTo(owlSelector);
        });
    }

    $(".partner-carousel").owlCarousel({
        autoPlay: true,
        slideSpeed: 500,
        items: 6,
        itemsDesktop: [1199, 6],
        itemsDesktopSmall: [979, 3],
        itemsTablet: [768, 3],
        itemsMobile: [667, 1],
        autoHeight: true,
        pagination: false,
        navigation: false,
        transitionStyle: "",
        navigationText: [
            "<i class='fa fa-angle-left'></i>",
            "<i class='fa fa-angle-right'></i>"
        ],
    });

    // Fun Facts
    function count($this) {
        var current = parseInt($this.html(), 10);
        current = current + 1; /* Where 50 is increment */

        $this.html(++current);
        if (current > $this.data('count')) {
            $this.html($this.data('count'));
        } else {
            setTimeout(function() {
                count($this)
            }, 50);
        }
    }

    $(".stat-count").each(function() {
        $(this).data('count', parseInt($(this).html(), 10));
        $(this).html('0');
        count($(this));
    });

    // Search
    var $ctsearch = $('#dmsearch'),
        $ctsearchinput = $ctsearch.find('input.dmsearch-input'),
        $body = $('html,body'),
        openSearch = function() {
            $ctsearch.data('open', true).addClass('dmsearch-open');
            $ctsearchinput.focus();
            return false;
        },
        closeSearch = function() {
            $ctsearch.data('open', false).removeClass('dmsearch-open');
        };

    $ctsearchinput.on('click', function(e) {
        e.stopPropagation();
        $ctsearch.data('open', true);
    });

    $ctsearch.on('click', function(e) {
        e.stopPropagation();
        if (!$ctsearch.data('open')) {

            openSearch();

            $body.off('click').on('click', function(e) {
                closeSearch();
            });

        } else {
            if ($ctsearchinput.val() === '') {
                closeSearch();
                return false;
            }
        }
    });

    // Accordion Toggle
    var iconOpen = 'fa-minus',
        iconClose = 'fa-plus';

    $(document).on('show.bs.collapse hide.bs.collapse', '.accordion', function(e) {
        var $target = $(e.target)
        $target.siblings('.accordion-heading')
            .find('i').toggleClass(iconOpen + ' ' + iconClose);
        if (e.type == 'show')
            $target.prev('.accordion-heading').find('.accordion-toggle').addClass('active');
        if (e.type == 'hide')
            $(this).find('.accordion-toggle').not($target).removeClass('active');
    });


    // tooltip demo
    $("[data-toggle=tooltip]").tooltip();

    // popover demo
    $("[data-toggle=popover]")
        .popover()
});

$(window).load(function() {
    "use strict";

    /* Loading Script */
    $('#loader').fadeOut("slow");

// prettyPhoto
	jQuery('a[data-gal]').each(function() {
		jQuery(this).attr('rel', jQuery(this).data('gal'));
	});  	
	jQuery("a[data-rel^='prettyPhoto']").prettyPhoto({
		animationSpeed:'slow',
		theme:'light_square',
		slideshow:false,
		overlay_gallery: false,
		social_tools:false,
		deeplinking:false
	});
    //CUSTOM
    jQuery('.filter_first').click();
});
