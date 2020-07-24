$(function () {

    $('#menu').mmenu({
        offCanvas: {
            zposition: "front"
        }
    });

    var menubar = $('.menubar').position();
     $(window).scroll(function (event) {
     if ($(this).scrollTop() > (menubar.top + 130)) {
     $('.menubar').addClass("static");
     }else{
     	$('.menubar').removeClass("static");
     } 
     }); 
     

    $('.nav li').hover(function () {
        $('ul', this).stop().slideDown(200);
    }, function () {
        $('ul', this).stop().hide(100);
    });

    $('.box-pro-hover').hover(function () {
		if ($( window ).width() > 1000)
			$('.pro-hover-attr', this).stop().fadeIn('fast');
    }, function () {
        $('.pro-hover-attr').hide();
    });

	$('.box-mnu .level1 .lv1 a').hover(function(){
		$('.level2-box').hide();
		$('#' + $(this).attr('data-menu')).show();	
	})


    $("#button-btt").click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });

    $('.menuleft li').hover(function () {
        $('ul.mnu-hiden', this).stop().slideDown(200);
    }, function () {
        $('ul.mnu-hiden', this).stop().slideUp(100);
    });

    $(window).scroll(function (event) {
        if ($(this).scrollTop() > 10) {
            $('#button-btt').fadeIn();
        } else {
            $('#button-btt').fadeOut();
        }
    });

    $('.content-tab-scroll img').each(function () {
        $(this).removeAttr('height');
        $(this).css({'height': ''});
    });

	$('.main-cat-home .fa-angle-down').click(function(){
		var x = $(this).parent().parent();
		$('.box-sub-cat-home',x).stop().slideToggle();	
		return false;
	});

   
    $(window).resize(function () {
        if ($(window).width() > 967) {
            $('.box-about-home').css({'height': $('.slide').height()});
        } else {
            $('.box-about-home').css({'height': '230px', 'margin-bottom': '10px'});
        }
    });

    function resize_about_home() {
        if ($(window).width() > 967) {
            $('.box-about-home').css({'height': $('.slide').height()});
        } else {
            $('.box-about-home').css({'height': '230px', 'margin-bottom': '10px'});
        }
    }
    if ($(window).width() > 967) {
        $('#search_mobile').hide();
    }
    $(window).resize(function () {
        if ($(window).width() > 967) {
            $('#search_mobile').hide();
        }
    });
    $('#btnshowsearchmobile').click(function () {
        $('.box-search-mm').slideToggle();
	
    });
    $('#filter_form .combo_filter').change(function () {
        $('#filter_form').submit();
    });
    $('.content-detail img').each(function () {
        $(this).removeAttr('height');
        $(this).css({'height': ''});
    });
    


	$(window).scroll(function (event) {
		if ($(this).scrollTop() > 10) {
			$('.gototop').fadeIn(); 
		} else { 
			$('.gototop').fadeOut(); 
		}
	});
	$(".gototop").click(function() {
	  $("html, body").animate({ scrollTop: 0 }, "slow");
	  return false;
	});
    var divi=0;
    $('.content-detail table').each(function(){
            var me = $(this);
            divi++;
            $('<div id ="div-scroll-'+ divi +'" class="div-scroll" />').insertBefore(me);
             $("#div-scroll-" + divi).html(me);
    });	

	 if ($(window).width() <= 577) {
		$('.title-box-footer a').click(function(){
			var x = $(this).parent().parent();
			$('.colmenufooter',x).stop().slideToggle();
			return false;
		});
	 }
});

