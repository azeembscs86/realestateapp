<!-- 
  | Template Main File 
  | Contains commonly required scripts and files
  | - Bootstrap
  | - jQuery
  | - Datepicker
  | - Preloader
  | - Navigation: Drop Down Menu
  | - LightGallery
  | - Application CSS (property.css)
  | - Common CSS code (style.css)
  | - Header: Reserve Online - Commonly included everywhere on the site
  | - Footer - Commonly included everywhere on the site
  | Includes partial files and pieces of results
  | - Browser Title as per the page opened
  | - Main Contents as per the page opened
  | - Javascript as per the page opened
-->
<?php ob_start("ob_gzhandler"); ?> 
<!DOCTYPE html>
<html lang="en">
	<head>
	
	    
		
		
		<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    	<meta name="description" content="@yield('metadesc')"/>
    	<meta name="keywords" content="@yield('metakeys')"/>
    	<title>@yield('metatits')</title>
    	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries @yield('title')-->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    	<!--[if lt IE 9]>
    	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    	<![endif]-->
    	<link rel="stylesheet" href="{{ asset('resources/bootstrap-3.3.5-dist/css/bootstrap.min.css') }}">
    	<link rel="stylesheet" href="{{ asset('resources/font-awesome-4.3.0/css/font-awesome.min.css') }}">
    	<link rel="stylesheet" href="{{ asset('resources/plugins/pace/themes/green/pace-theme-flat-top.css')}}" />
    	<!--<link rel="stylesheet" href="{{ asset('resources/plugins/datepicker-eyecon/css/datepicker.css') }}">-->
		<!--<link rel="stylesheet" href="{{ asset('css/all-main.css') }}">-->
		<link rel="stylesheet" href="{{ asset('css/all-main.css') }}">
		<link rel="stylesheet" href="{{ asset('css/core.css') }}">
		<link rel="stylesheet" href="{{ asset('css/shortcode/shortcodes.css') }}">
		<!--<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
		<link rel="stylesheet" href="{{ asset('css/colorbox.css') }}">-->
    	<link rel="stylesheet" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/css/unite-gallery.css')}}" type="text/css" />
    	<link rel="stylesheet" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/themes/default/ug-theme-default.css')}}" type="text/css" />
    	<link id="themefile" rel="stylesheet" type="text/css" href="<?= (null !== @$_COOKIE['themefile'])?$_COOKIE['themefile']:asset('/css/property-theme-001.css')?>" media="screen" />

    	<!--<link id="themefile" rel="stylesheet" type="text/css" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/css/chosen.css')}}" media="screen" />-->

    	<!--<link id="themefile" rel="stylesheet" type="text/css" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/css/jquery.bxslider.css')}}" media="screen" />-->
		<script src="{{ asset('js/jquery.min.js') }}"></script>
		<script src="{{ asset('js/mCustomScrollbar.js') }}"></script>
	<script src="{{asset('resources/plugins/pace/pace.js')}}"></script>
	<script src="{{ asset('resources/plugins/datepicker-eyecon/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
	<script src="{{ asset('/js/main-menu-script.js') }}" type="text/javascript"></script>
	<script type="text/javascript" src="{{ asset('resources/plugins/unveil-master/jquery.unveil.js')}}"></script>
	<script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-common-libraries.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-functions.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-slider.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-gallery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/jquery.bxslider.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/themes/compact/ug-theme-compact.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/jquery.colorbox.js')}}"></script>
  <script>
jQuery(document).ready(function($){ 	
			if($(window).width() <= 768){
				$(".main-menu .has-sub").click(function(){
					$(this).children("ul").slideToggle();
				});
			}
		});
</script>  
 	
	<style type="text/css">
		.show{display: block !important;}
	body, html, .main {
	    height: 100%;
	}

	section {
	    min-height: 100%;
	}
	.main-menu ul{
margin-bottom:0px ;
}

.main-header-area .logo-area {
    margin-top: 16px;
}
.main-header-area .main-menu ul li.active:after {
    bottom: 12px;
}
.main-header-area .logo-area {
    padding: 0px 0;
    }
	</style>
	</head>
 	<body class="wide-layout" cz-shortcut-listen="true"> 
		<div class="wrapper">
			<header>
				<div class="main-header-area">
					<div class="container">
						<div class="row">
							<div class="col-xs-12 text-right">
								<ul class="list-inline list-unstyled list-login">
								    <?php if (Auth::check()){ ?>

									    <?php if (Auth::user()->role=='owner'){ ?>
									<li><a class="loginbutton" href="{{url('/auth/logout')}}">Logout</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/owner/dashboard')}}">Seller Maintenance Panel</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/chat/2/0')}}">Buyer Communication</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/owner/properties')}}">Upload Property</a></li>
									<?php } ?>
									<?php if (Auth::user()->role=='user'){ ?>
									<li><a class="loginbutton" href="{{url('/auth/logout')}}">Logout</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/owner/dashboard')}}">Buyers Options</a></li>
									<?php } if (Auth::user()->role=='admin'){ ?>
									<li><a class="loginbutton" href="{{url('/auth/logout')}}">Logout</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/admin/dashboard')}}">Dashboard</a></li>
									<?php } ?>
									<?php }else{ ?>
									<li><a class="loginbutton" href="{{url('/register')}}">Sign Up</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/login')}}">Buyer Login</a></li>
									<li>|</li>
									<li><a class="loginbutton" href="{{url('/login')}}">Seller Login</a></li>
									<?php } ?>
								</ul>
							<div class="showcurrency">
							<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
							<select name="currency" id="currency" onchange="change_currency(this.value);">
							<option value="USD" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'USD') { echo 'selected="selected"'; }else{} ?>>US Dollar ($)</option>
							<option value="GBP" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'GBP') { echo 'selected="selected"'; }else{} ?>>United Kingdom (GBP)</option>
							<option value="EUR" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'EUR') { echo 'selected="selected"'; }else{} ?>> Euro (EUR)</option>
							<option value="AED" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'AED') { echo 'selected="selected"'; }else{} ?>>United Arab Emirates (AED)</option>
							<option value="AUD" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'AUD') { echo 'selected="selected"'; }else{} ?>>Australian Dollar (AUD)</option>
							<option value="CAD" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'CAD') { echo 'selected="selected"'; }else{} ?>>Canadian Dollar (CAD)</option>
							<option value="JPY" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'JPY') { echo 'selected="selected"'; }else{} ?>>Japanese Yen (JPY)</option>
							<option value="SAR" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'SAR') { echo 'selected="selected"'; }else{} ?>>Saudi Riyal (SAR)</option>
							<option value="ZAR" <?php if(isset($_COOKIE['user_currency']) && $_COOKIE['user_currency'] == 'ZAR') { echo 'selected="selected"'; }else{} ?>>South African Rand (ZAR)</option>
							</select>
							<?php //echo 'http://'.$_SERVER['HTTP_HOST']$_SERVER['REQUEST_URI'];?>
							<script type="text/javascript">
							function change_currency(value){
								var _token = $('#_token').val();
								$.ajax({
					            url: "https://matchpropertydirect.com/changecurrency",
					            data: {_token:_token,cur: value},
					            type: 'POST',
					            beforeSend: function () {
					            },
					            success: function (result) {
					            	if(result == 'done'){
					            		location.reload();
					            	}
					            },
					            error: function () {
					            }
					        });
							}	
							</script>
								<?php //echo EnvatoUser::calculateCurrency('PKR','AED',300); ?></div>
							<div id="google_translate_element"></div>
<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
							</div>
						</div>
						<div class="row nav-cos-xs">
							<div class="col-lg-3 col-md-3 col-sm-12 col-xs-8">
								<div class="logo-area"> 
									<a href="{{url()}}">
										<img src="{{asset('img/'.$settings->logo_dark)}}" alt="{{$settings->site_title}}" class="img-responsive" width="235px" />
									</a>
								</div>
							</div>
							<div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 mobile-nav">
								@include('layouts.default._navigation')
							</div>
						</div>
					</div>
				</div>
			</header>
			<!-- Body: Page Contents -->
			<!-- Navigation: Top-bar -->
			<!-- Load/Execute the code for contents from the view page. -->
			@yield('contents')
		</div>
		<!-- Footer -->
		<footer id="footer" class="footer-area bg-2 bg-opacity-black-90"> 
			<div class="footer-bottom">
				<div class="container">
				    <div class="row">
				   <p class="text-left5">MatchPropertyDirect is proud to donate 1 percent of the net profits to an animal shelter. We will change each year and choose different areas.</p>
				    </div>
				    <div class="row main-footer">
						<div class="col-md-5 col-xs-12">
							<div class="copyright text-center">
								<p class="text-left"> Use of this website constitutes acceptance of the MatchPropertyDirect <br> &copy; Copyright 2017-Present <b>MatchPropertyDirect</b>, LLC all Rights reserved under U.S. and International Law.</p>
							</div>
						</div>
						<div class="col-md-3 col-xs-12 text-center">
							<ul class="social-icon mt-10 m-t-7">
								<li>  
									<a href="{{$settings->facebook}}"><i class="fa fa-facebook"></i></a>						   
								</li>
								<li>  
									<a href="{{$settings->twitter}}"><i class="fa fa-twitter"></i></a>						   
								</li>
								<li>  
									<a href="{{$settings->googleplus}}"><i class="fa fa-google"></i></a>						   
								</li>
								<li>  
									<a href="{{$settings->linkedin}}"><i class="fa fa-linkedin"></i></a>						   
								</li>
							</ul>
						</div>
						<div class="col-md-4 col-xs-12 sub-links-main">
							<div class="copyright copyr8-cs terms pull-right sub-links">
										<a href="{{url('pages/terms-and-conditions')}}" class="ft-btm-link left-pull">Terms & Conditions</a>
										<a href="{{url('pages/privacy-policy')}}" class="ft-btm-link">Privacy Policy</a>
										<a href="{{url('pages/content-guidelines')}}" class="ft-btm-link">Content Guidelines</a>
									<!--	<a href="{{url('pages/faq')}}" class="ft-btm-link left-pull">FAQ</a>-->
									<p class="text-right text-com-cs">Designed By <a rel="nofollow" target="_blank" href="http://www.craftedium.com/"> Craftedium</a></p>
							</div>
						</div>
					</div>
					<div class="row disclaimer-row">
						<div class="col-xs-12">
							<div class="copyright text-center">
						<p class="text-left disclaimer-text"><span class="disclaimer-h4">Disclaimer : </span>MatchPropertyDirect, LLC asks that the site users only use the site for the purpose of connecting to buy or sell property. We ask that all of our users be completely honest in all representations and actions as well as abiding by all laws.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			

			
		</footer>   

		
		
		
		
		
		
<script src="{{ asset('js/modernizr-2.8.3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/themes/default/ug-theme-default.js')}}"></script>
	<script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/jquery.pajinate.js')}}"></script>
	<script type="text/javascript">
			$(document).ready(function(){
				$('#paging_container7').pajinate({
					num_page_links_to_display : 3,
					items_per_page : 6	
				});
			});	
		</script>
	<!-- End of Footer -->
    <script src="{{ asset('resources/bootstrap-3.3.5-dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toucheffects.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery.nivo.slider.js') }}"></script> 
	<script src="{{ asset('js/ajax-mail.js') }}"></script> 
	<script src="{{ asset('js/plugins.js') }}"></script> 
	<script src="{{ asset('js/main.js') }}"></script>
    <!-- Sliders -->
    <script type="text/javascript">
 	$(document).ready(function(){
   $("#unite-gallery").unitegallery({
    gallery_autoplay:true
   });
 });
</script>
    <script>
      $('.carousel').carousel({
      interval: 5000 //controls the slider speed
      }) 
    </script>
	<script>
		$(document).ready(function(){
			$('.main-menu ul li:last-child a').addClass('button-orange');
			$("#top_nav_43 a").attr("id","scroll-down");
			$("#top_nav_43 a").attr("href","{{url()}}/#page-content");
			 $(".main-menu ul li:last-child a").prepend("<span><i class='fa fa-sign-in'></i></span>");
		});
		$(document).on("click", ".more-filter", function () {
			$('.search-home').addClass('show');
			$(".search-home").fadeIn(300);
			if($(window).width() < 768)
				$(".button-1.btn-block.btn-hover-1").fadeOut(300);
				$(".button-1.btn-block.btn-hover-1.mobile-button").fadeIn(300);
			$(".more-filter").addClass("closefilter");
			$('.closefilter').removeClass('more-filter');
		});
		$(document).on("click", ".closefilter", function () {
			$(".closefilter").addClass("more-filter");
			$('.more-filter').removeClass('closefilter');
			$('.search-home').removeClass('show');
			if($(window).width() < 768)
				$(".button-1.btn-block.btn-hover-1").fadeIn(300);
				$(".button-1.btn-block.btn-hover-1.mobile-button").fadeOut(300);
		});
	</script>
	<script>
		$(function() {
			$(".img-preload").unveil(300);
		});
    </script>
    <!-- Customize Date Picker -->
    <!-- IntersectionObserver polyfill -->
    <style type="text/css">
	.b-lazy {
       opacity:0;
       transform: scale(3);
       transition: all 500ms;
    }
    .b-loaded {
       opacity:1;
       transform: scale(1);
    }
</style>
    <script src="{{ asset('js/blazy.min.js') }}"></script>
<script>
    window.bLazy = new Blazy({
		container: '.wrapper',
		success: function(element){
			console.log("Element loaded: ", element.nodeName);
		}
	});
	</script>
  </script>
    <!-- End of Customize Date Picker -->
    <!-- Picture Gallery -->
    <!-- jQuery required >= 1.8.0  | jQuery already included in the head jquery-2.1.0.js -->
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lightgallery.js')}}"></script>
    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <!-- lightgallery plugins -->
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-video.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/chosen.jquery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/init.js')}}"></script>
    <!-- End of Picture Gallery -->
    <!-- Load the javascript code defined in the view page. -->
    @yield('javascript')
	 <script>
      $(window).load(function(){
        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var checkin = $('#checkin').datepicker({
			onRender: function(date) {
				return date.valueOf() < now.valueOf() ? 'disabled' : '';
			}
        }).on('changeDate', function(ev) {
      
        if (ev.date.valueOf() > checkout.date.valueOf()) {
			var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
		$('#checkout')[0].focus();
        }).data('datepicker');
        var checkout = $('#checkout').datepicker({
			onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
        }
        }).on('changeDate', function(ev) {
          checkout.hide();
        }).data('datepicker');
      });
      /* Config Date Picker */
      $(window).load(function(){
      var nowTemp = new Date();
      var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
      var checkin = $('#arrival').datepicker({
      onRender: function(date) {
        return date.valueOf() < now.valueOf() ? 'disabled' : '';
      }
      }).on('changeDate', function(ev) {
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.setValue(newDate);
      }
      checkin.hide();
      $('#departure')[0].focus();
      }).data('datepicker');
      var checkout = $('#departure').datepicker({
      onRender: function(date) {
        return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
      }
      }).on('changeDate', function(ev) {
      checkout.hide();
      }).data('datepicker');
      });
      /* End Config Date Picker SET-2 */
    </script>
<script>
	$('a[href*="#"]')
  .not('[href="#"]')
  .not('[href="#0"]')
  .click(function(event) {
    if (
      location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') 
      && 
      location.hostname == this.hostname
    ) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
      if (target.length) {
        event.preventDefault();
        $('html, body').animate({
          scrollTop: target.offset().top
        }, 1000, function() {
          var $target = $(target);
          $target.focus();
          if ($target.is(":focus")) { // Checking if the target was focused
            return false;
          } else {
            $target.attr('tabindex','-1'); // Adding tabindex for elements not focusable
            $target.focus(); // Set focus again
          };
        });
      }
    }
  });
	</script>
<script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">require(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us17.list-manage.com","uuid":"5d0811f0a3afc6ea5a33e15d3","lid":"14a354c4c4"}) })</script>
  </body>
</html>