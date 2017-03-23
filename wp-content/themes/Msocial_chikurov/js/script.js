jQuery( function() {
  var cur_book = 1,
      cur_page_scroll,
      supportsStorage = function(){
      try {
          return 'localStorage' in window && window['localStorage'] !== null;
      } catch (e) {
          return false;
      };
    };
    // Уменьшение лого при прокрутке
    window.onscroll = function() {
      cur_page_scroll = window.pageYOffset;
      if (cur_page_scroll >= 50) {
        if (jQuery('.navbar-brand').hasClass('navbar-brand_small')) {

        } else {
          jQuery('.navbar-brand').addClass('navbar-brand_small')
        }
      } else if (cur_page_scroll < 50) {
        if (jQuery('.navbar-brand').hasClass('navbar-brand_small')) {
          jQuery('.navbar-brand').removeClass('navbar-brand_small')
        }
      }
    }
    // END
    // Запоминание страницы в книге
  if(supportsStorage && localStorage.getItem('cur_page')){
    cur_book = localStorage.getItem('cur_page');
    jQuery('.book_page').addClass('hidden');
    jQuery('.book_page').eq(cur_book-1).removeClass('hidden');
    jQuery('.book_pagination').removeClass('book_pagination_active');
    jQuery('.book_pagination').eq(cur_book-1).addClass('book_pagination_active');
  }
  // END
  // Прокрутка назад
  jQuery('.book_pagination_prev').on('click', function(event) {
    if (cur_book >=2) {
      jQuery('.book_page').addClass('hidden');
      jQuery('.book_page').eq(cur_book-2).removeClass('hidden');
      jQuery('.book_pagination').removeClass('book_pagination_active');
      jQuery('.book_pagination').eq(cur_book-2).addClass('book_pagination_active');
      cur_book = cur_book-1;
      jQuery("html, body").animate( { scrollTop: jQuery( '.subbanner' ).offset().top+50 }, 800 );
    }
  });
  // END
  // Прокрутка вперед
  jQuery('.book_pagination_next').on('click', function(event) {
    if (cur_book <=89) {
      jQuery('.book_page').addClass('hidden');
      jQuery('.book_page').eq(cur_book).removeClass('hidden');
      jQuery('.book_pagination').removeClass('book_pagination_active');
      jQuery('.book_pagination').eq(cur_book).addClass('book_pagination_active');
      cur_book = +cur_book+1;
      jQuery("html, body").animate( { scrollTop: jQuery( '.subbanner' ).offset().top+50 }, 800 );
    }
  });
  // END
  jQuery('body').on('click', '.scroll_block', function(event) {
    var slider_height = jQuery("#slider").height();
    var slider_height = slider_height-50;
    jQuery("body,html").animate({"scrollTop": slider_height},'slow');
  });
  if (jQuery('.request_url')) {
  	jQuery('.request_url').val(window.location.href)
  }
  jQuery('.picked_data').datepicker({
      dateFormat : "yy-mm-dd"
  });
  // SVG LOGO
  var logo = new Vivus('treangle', {type: 'delayed', duration: 200}, function(){
    jQuery('.wom').css({
    fill: '#fff',
    strokeWidth: '0px'
    });
    jQuery('.logo_apple').css('opacity', '1');
  });
  // END
  // Пагинация книги
  jQuery('.book_pagination').on('click', function(event) {
    cur_book = jQuery(this).data('book');
    console.log(cur_book);
    localStorage.setItem('cur_page', cur_book);
    jQuery('.book_page').addClass('hidden');
    jQuery('.book_pagination').removeClass('book_pagination_active');
    jQuery('.book_page').eq(cur_book-1).removeClass('hidden');
    jQuery(this).addClass('book_pagination_active');
    jQuery("html, body").animate( { scrollTop: jQuery( '.subbanner' ).offset().top+50 }, 800 );
  });
  //Запрет вывода прошедших мастер классов
    // if (jQuery('.rasp-wrap')) {
    //   jQuery('.rasp-wrap article').each(function(i,elem) {
    //     var cur_time = new Date();
    //     cur_time = cur_time.getTime()
    //     if (jQuery(this).data('day_str').getTime() > cur_time) {
    //       jQuery(this).addClass('hidden');
    //     }
    //   });
    // }
  // Сортировка мастер классов
    if (jQuery('.rasp-wrap')) {
      var c = jQuery.makeArray(jQuery(".rasp-wrap article"));
      c.sort(function (a, b) {
          a = jQuery(a).data('day');
          b = jQuery(b).data('day');
          return a < b ? -1 : a > b ? 1 : 0
      });
      jQuery(c).appendTo(".rasp-wrap");
    }
  // END
  //Вывод ссылки на мастер класс
    //Функция получения параметров из URL
    function getParameterByName(name, url) {
        if (!url) {
          url = window.location.href;
        }
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    //Если параметр есть
    var modalParam = getParameterByName('modal');
    if (modalParam) {
      modalParam = '#'+modalParam;
      jQuery(modalParam).modal('show');
    }
    // Если параметра нет

    jQuery('.modal').on('show.bs.modal', function (e) {
      console.log(jQuery(this).attr('id'));
    })

    //Заполнение автополей в форме записи на мастер класс
    jQuery('.modal').each(function(index, el) {
      jQuery(el).find('.cur_mc').val(jQuery(el).find('.cur_mc_link').text());
      jQuery(el).find('.cur_mc_title').val(jQuery(el).find('.rasp-title').text());
    });
});
