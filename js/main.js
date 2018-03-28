(function($){"use strict";jQuery('nav#dropdown').meanmenu();jQuery(window).bind("load",function(){new WOW().init();})
$.scrollUp({scrollText:'<i class="fa fa-angle-up"></i>',easingType:'linear',scrollSpeed:900,animation:'fade'});$('#ensign-nivoslider-3').nivoSlider({effect:'random',slices:15,boxCols:8,boxRows:4,animSpeed:500,pauseTime:5000,prevText:'p<br/>r<br/>e<br/>v',nextText:'n<br/>e<br/>x<br/>t',startSlide:0,directionNav:true,controlNav:true,controlNavThumbs:false,pauseOnHover:true,manualAdvance:false});$("#slider-range").slider({range:true,min:20,max:2500,values:[80,2000],slide:function(event,ui){$("#amount").val("$"+ui.values[0]+" - $"+ui.values[1]);}});$("#amount").val("$"+$("#slider-range").slider("values",0)+" - $"+$("#slider-range").slider("values",1));$("#slider-range1").slider({range:true,min:100,max:60000,values:[0,100],slide:function(event,ui){$("#amount1").val(ui.values[0]+" - "+ui.values[1]+"+ Sqt");}});$("#amount1").val(+$("#slider-range1").slider("values",0)+" -"+$("#slider-range1").slider("values",1)+" Sqt");$("#slider-range2").slider({range:true,min:0,max:1000,values:[0,100],slide:function(event,ui){$("#amount2").val(ui.values[0]+" - "+ui.values[1]+" Miles");}});$("#amount2").val(+$("#slider-range2").slider("values",0)+" -"+$("#slider-range2").slider("values",1)+" Miles");$(".youtube-bg").YTPlayer({videoURL:"Sz_1tkcU0Co",containment:'.youtube-bg',mute:true,loop:true,});})(jQuery);var hth=$('.header-top-bar').height();$(window).on('scroll',function(){if($(this).scrollTop()>hth){$('#sticky-header').addClass("sticky");}else{$('#sticky-header').removeClass("sticky");}});$(document).ready(function(){$("#unite-gallery").unitegallery({gallery_autoplay:true});});$('.carousel').carousel({interval:5000})
$(document).ready(function(){$('.main-menu ul li:last-child a').addClass('button-orange');$(".main-menu ul li:last-child a").prepend("<span><i class='fa fa-search'></i></span>");$(".more-filter").click(function(){$(".search-home").fadeToggle(1500);});});$(function(){$(".img-preload").unveil(300);});


$(document).ready(function(){
	setTimeout(function(){
		$(".popup-overlay, .popup2.pop2").fadeIn('slow');
	}, 3000);
	$(".popup-overlay").click(function(){
		$(".popup-overlay, .popup2.pop2").fadeOut('slow');
	});
});


		(function($){
			$(window).on("load",function(){
				
				$(".customScrollSec").mCustomScrollbar({
					theme:"light-2",
					scrollButtons:{
						enable:false
					},
				});
				
			});
		})(jQuery);
