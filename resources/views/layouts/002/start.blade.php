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
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>@yield('title')</title>
    <!-- Bootstrap -->
    <link href="{{ asset('resources/bootstrap-3.3.5-dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src='//code.jquery.com/jquery-2.1.0.js'></script>
    <!-- Fonts -->
    <link href="{{ asset('resources/font-awesome-4.3.0/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
    <!-- /. Fonts -->
    <!-- Page Preloading -->
    <script src="{{asset('resources/plugins/pace/pace.js')}}"></script>
    <link href="{{asset('resources/plugins/pace/themes/green/pace-theme-flat-top.css')}}" rel="stylesheet" />
    <!-- /.Page Preloading -->
    <!-- Date Picker -->
    <script src="{{ asset('resources/plugins/datepicker-eyecon/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
    <link href="{{ asset('resources/plugins/datepicker-eyecon/css/datepicker.css') }}" rel="stylesheet" type="text/css">
    <!-- /. Date Picker -->
    <!-- Menu -->
    <link href="{{ asset('/css/main-menu-styles.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/js/main-menu-script.js') }}" type="text/javascript"></script>
    <!-- /.Menu -->
    <!-- Unit Gallery -->
    <!-- 
      jQuery already included @ jquery-2.1.0.js
      <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/jquery-11.0.min.js')}}"></script> 
      -->
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-common-libraries.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-functions.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-thumbsgeneral.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-thumbsstrip.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-touchthumbs.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-panelsbase.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-strippanel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-gridpanel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-thumbsgrid.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-tiles.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-tiledesign.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-avia.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-slider.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-sliderassets.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-touchslider.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-zoomslider.js')}}"></script> 
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-video.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-gallery.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-lightbox.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-carousel.js')}}"></script>
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/js/ug-api.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/css/unite-gallery.css')}}" type="text/css" />
    <script type="text/javascript" src="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/themes/default/ug-theme-default.js')}}"></script>
    <link rel="stylesheet" href="{{ asset('resources/plugins/unitegallery-master/source/unitegallery/themes/default/ug-theme-default.css')}}" type="text/css" />
    <!-- /. Unit Gallery -->
    <link href="{{ asset('/css/style.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/css/property-main.css') }}" rel="stylesheet" type="text/css">

    <link id="themefile" rel="stylesheet" type="text/css" href="<?= (null !== @$_COOKIE['themefile'])?$_COOKIE['themefile']:asset('/css/property-theme-001.css')?>" media="screen" />


  </head>
  <body>

    <!-- Site Header: Social Media links and Reserve Online -->
    <section id="top" class="colors-top-bar">
       
      <div class="container">
        <div class="pull-left">
          <ul class="socialmarks socialmarks2 ">
            @if(!filter_var($settings->facebook, FILTER_VALIDATE_URL) === false)
            <li><a href="{{$settings->facebook}}" target="_blank" class="facebook"></a></li>
            @endif
            @if(!filter_var($settings->facebook, FILTER_VALIDATE_URL) === false)
            <li><a href="{{$settings->twitter}}" target="_blank" class="twitter"></a></li>
            @endif
            @if(!filter_var($settings->facebook, FILTER_VALIDATE_URL) === false)
            <li><a href="{{$settings->linkedin}}" target="_blank" class="linkedin"></a></li>
            @endif
            @if(!filter_var($settings->facebook, FILTER_VALIDATE_URL) === false)
            <li><a href="{{$settings->googleplus}}" target="_blank" class="googleplus"></a></li>
            @endif
          </ul>
        </div>
        <div class="pull-right">
          <!-- Popup: Reserve Online -->
          @include('include.reserve-online')
        </div>
      </div>
    </section>

    <!-- Navigation: Top-bar -->
    
    <!-- Body: Page Contents -->
    <!-- Load/Execute the code for contents from the view page. -->
    @yield('contents')
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="col-md-4 col-sm-6 footer_links">
          <h3 class="footer_heading">Featured Properties</h3>
          <ul>
            @foreach($footer_properties as $property)
            <li><a href="{{url('show/'.$property->slug)}}">&nbsp;{!!$property->title!!}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-4 col-sm-6 footer_links">
          <h3 class="footer_heading">Featured Pages</h3>
          <ul>
            @foreach($footer_pages as $page)
            <li><a href="{{url($page->category->slug.'/'.$page->slug)}}">&nbsp;{!!$page->title!!}</a></li>
            @endforeach
          </ul>
        </div>
        <div class="col-md-4 col-sm-6 footer_links">
          <h3 class="footer_heading">Contact Us!</h3>
          <p style="color:#8a8888;">{{$settings->site_title}}</p>
          <p style="color:#8a8888;"><i class="fa fa-home"></i>&nbsp;{{$settings->site_address_line_1}} {{$settings->site_address_line_2}}</p>
          <p style="color:#8a8888;"><i class="fa fa-envelope-o"></i>&nbsp;{{$settings->site_email}}</p>
          <p style="color:#8a8888;"><i class="fa fa-phone"></i>&nbsp;{{$settings->site_phone}}</p>
          <p style="color:#8a8888;">{{$settings->business_hours}}</p>
        </div>
        <div class="copyright">
          {!!$settings->site_footer!!}
        </div>
      </div>
    </footer>
    </div>
    <!-- End of Footer -->
    <!-- jQuery required for Bootstrap | already included in the head jquery-2.1.0.js -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="{{ asset('resources/bootstrap-3.3.5-dist/js/bootstrap.min.js') }}"></script>
    <!-- JS -->
    <script src="{{ asset('js/modernizr.custom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toucheffects.js') }}" type="text/javascript"></script>
    <!-- Sliders -->
    <script>
      $('.carousel').carousel({
      
      interval: 5000 //controls the slider speed
      
      })
      
    </script>
    <!-- Customize Date Picker -->
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
    <!-- End of Customize Date Picker -->
    <!-- Picture Gallery -->
    <!-- jQuery required >= 1.8.0  | jQuery already included in the head jquery-2.1.0.js -->
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lightgallery.js')}}"></script>
    <!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js"></script>
    <!-- lightgallery plugins -->
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-fullscreen.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-thumbnail.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-video.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-autoplay.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-zoom.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-hash.js')}}"></script>
    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-pager.js')}}"></script>
    <!-- End of Picture Gallery -->
    <!-- Load the javascript code defined in the view page. -->
    @yield('javascript')
    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
      
      
      
      ga('create', 'UA-68834369-1', 'auto');
      
      ga('send', 'pageview');
      
      
      
    </script>
    @include('include.theme-options')
  </body>
</html>