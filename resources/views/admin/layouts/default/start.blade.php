<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>{!!$settings->site_title!!} | Admin Panel</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Bootstrap 3.3.4 -->
    <link href="{{asset('/admin/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="{{asset('/admin/plugins/datatables/dataTables.bootstrap.css')}}" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{asset('/admin/dist/css/AdminLTE.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
      page. However, you can choose any other skin. Make sure you
      apply the skin class to the body tag so the changes take effect.
      -->
    <link href="{{asset('/admin/dist/css/skins/skin-green.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- Custom Styling -->
    <link href="{{ asset('/admin/_noblesoft/css/style.css') }}" rel="stylesheet" />
    <script src="{{asset('admin/_noblesoft/js/custom-functions.js')}}"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:/ -->
    <!--[if lt IE 9]>
    <script src="https:/oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https:/oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- Cropper -->
    <link href="{{asset('admin/_noblesoft/cropper/dist/cropper.css')}}" rel="stylesheet">
    <!-- Preview Settings -->
    <link href="{{asset('admin/_noblesoft/cropper/_noblesoft/css/main.css')}}" rel="stylesheet">
    <script src="{{asset('admin/_noblesoft/cropper/dist/cropper.js')}}"></script>
    <!-- Custom Javascript for Cropping -->
    <script src="{{asset('admin/_noblesoft/cropper/_noblesoft/js/main.js')}}"></script>
    <!-- End Cropper -->
  </head>
  <body class="skin-green sidebar-mini">
	<div class="wrapper">
		<!-- Main Header -->
		<header class="main-header">
			<!-- Logo -->
			<a href="{{url()}}" class="logo" target="_blank">
				<!-- mini logo for sidebar mini 50x50 pixels -->
				<span class="logo-mini"><b>MPD</b></span>
				<!-- logo for regular state and mobile devices -->
				<span class="logo-lg"><b>MatchPropertyDirect</b></span>
			</a>
			<!-- Header Navbar -->
			<nav class="navbar navbar-static-top" role="navigation">
				<!-- Sidebar toggle button-->
				<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
					<span class="sr-only">Toggle navigation</span>
				</a>
				<ul class="nav navbar-nav pull-left">
					<li>
						<a href="{{url()}}" class="own-design"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to Site</a>
					</li>
				</ul>
				<div class="navbar-custom-menu pull-right">
          <div class="lang">
              <style>
                .currency{
                    width: 49%;float: left;margin-right: 2%;color: #666;margin-top: 4px;height: 33px;font-size: 14px;
                }
                #google_translate_element{
                    float: left;
                    width: 49%;
                }
                .main-header .navbar-custom-menu, .main-header .navbar-right{
                    width: 53%;
                }
                @media (max-width: 767px){
                    .main-header .navbar-custom-menu {
                            width: 95% !important;
                    }
                }
            </style>
            <select name="currency" class="currency">
    			<option value="USD" selected="selected">US Dollar ($)</option>
    			<option value="GBP">United Kingdom (£)</option>
    			<option value="EUR"> Euro (€)</option>
    			<option value="AED">United Arab Emirates (AED)</option>
    			<option value="AUD">Australian Dollar (AU$)</option>
    			<option value="CAD">Canadian Dollar (CA$)</option>
    			<option value="JPY">Japanese Yen (J¥)</option>
    			
    			<!--<option value="ZAR" >South African Rand (ZAR)</option>-->
			</select>
            <div id="google_translate_element"></div>
            <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
            }
          $(window).load(function(){
              $(".goog-logo-link").empty();
              $('.goog-te-gadget').html($('.goog-te-gadget').children());
          })
            </script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
          </div>
					<ul class="nav navbar-nav">
					  <!-- User Account Menu -->
						<li class="dropdown user user-menu">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php if($user->avatar == ''){ ?>
                 <img src="{{url('pictures/avatar-1.png')}}" class="user-image" alt="User Image"/>
                <?php }else{ ?>
							  <img src="{{asset($user->avatar)}}" class="user-image" alt="User Image"/>
                <?php } ?>
							  <span class="hidden-xs">{{$user->firstname}} {{$user->lastname}}</span>
							</a>
							<ul class="dropdown-menu">
								<li class="user-header">
                  <?php if($user->avatar == ''){ ?>
                  <img src="{{url('pictures/avatar-1.png')}}" class="img-circle" alt="User Image" />
                  <?php }else{ ?>
									<img src="{{asset($user->avatar)}}" class="img-circle" alt="User Image" />
                  <?php } ?>
									<p>
									  {{$user->firstname}} {{$user->lastname}} - {{$user->designation}}
									  <small><?=date('F, Y',strtotime($user->created_at))?></small>
									</p>
								</li>
								<li class="user-footer">
									<div class="pull-left">
                    <?php if (Auth::user()->role=='owner' || Auth::user()->role=='user'){ ?>
										<a href="{{url('/owner/users')}}" class="btn btn-default btn-flat">Profile</a>
                    <?php }else{ ?>
                    <a href="{{url('/admin/users')}}" class="btn btn-default btn-flat">Profile</a>
                    <?php } ?>
									</div>
									<div class="pull-right">
										<a href="{{url('/auth/logout')}}" class="btn btn-default btn-flat">Sign out</a>
									</div>
								</li>
							</ul>
						</li>
					  <!-- Control Sidebar Toggle Button -->
					</ul>
				</div>
			</nav>
		</header>
		<!-- Left side column. contains the logo and sidebar -->
		<aside class="main-sidebar">
			@include('admin.layouts.default._sidebar')
		</aside>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				@yield('heading')
				@include('admin.layouts.partials.alerts')
			</section>
			<!-- Main content -->
			<section class="content">
				<!-- Your Page Content Here -->
				@yield('contents')
			</section>
			<!-- /.content -->
		</div>
      <!-- /.content-wrapper -->
      <!-- Main Footer -->
      </div>
    <!-- ./wrapper -->
    <!-- REQUIRED JS SCRIPTS -->
    <!-- Bootstrap 3.3.2 JS -->
    <script src="{{asset('/admin/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- DATA TABLES SCRIPT -->
    <script src="{{asset('/admin/plugins/datatables/jquery.dataTables.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('/admin/plugins/datatables/dataTables.bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- SlimScroll -->
    <script src="{{asset('/admin/plugins/slimScroll/jquery.slimscroll.min.js')}}" type="text/javascript"></script>
    <!-- FastClick -->
    <script src="{{asset('/admin/plugins/fastclick/fastclick.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/admin/dist/js/app.min.js')}}" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('/admin/dist/js/demo.js')}}" type="text/javascript"></script>
    <!-- page script -->
    <script type="text/javascript">
      $(function () {
        $(".datatable-full").dataTable();
        $('.datatable-first-column-asc').dataTable({
          "order": [[ 0, 'asc' ]]          
        });
        $('.datatable-first-column-desc').dataTable({
          "order": [[ 0, 'desc' ]]          
        });
      });
    </script>
    <!-- Include Date Range Picker -->
    <!-- Include Required Prerequisites -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />
    <script type="text/javascript">
      $(function() {
        //Initialize Select2 Elements
    $('.select2').select2()
          $('.date-range').daterangepicker({
              "autoApply": true
          }, function(start, end, label) {
            console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
          });
      });
    </script>
    <!-- End of Date Picker -->
    <script type="text/javascript">
      {!! @$js !!}
    </script>
    <script type="text/javascript" charset="utf-8">
      //<![CDATA[
      jQuery(function() {
        jQuery('.sidebar-menu li').each(function() {
          var href = jQuery(this).find('a').attr('href');
          if (href === window.location.href) {
            jQuery(this).addClass('active');
          }
        });
      });  
      //]]>
    </script>
    <script type='text/javascript'>
      $('.reload-page').on('click', function() {
        $('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
        window.location.reload();
      });
      $('#iframeModal, #iframeModalSimple').on('hidden.bs.modal', function() {
        var checkproperty = $('#checkproperty').val();
        if(checkproperty == 'addproperty'){
          $('#iframeModal').modal({
          backdrop: 'static',
          keyboard: true
        });
          var answer = confirm("Do you want to save data? Please click save button.")
          if (answer) {
          }
          else {
              $('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
                window.location.reload();
          }
          }else{
              $('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
              window.location.reload();
          }
        //$('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
        //window.location.reload();
      })
      $(document).on("click", ".drft", function () {
        var answer = confirm("Do you want to save data? Please click save button.")
          if (answer) {
          }
          else {
              $('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
                window.location.reload();
          }
      });  
      $(document).on("click", ".colse", function () {
        var answer = confirm("Do you want to save data? Please click save button.")
          if (answer) {
          }
          else {
              $('.content').html('<h1>Refreshing...</h1><i class="fa fa-refresh fa-spin"></i>');
                window.location.reload();
          }
      });
      $(document).on("click", ".tst", function () {
        document.getElementById('checkproperty').value = 'addproperty';
        $(".drft").removeAttr("data-dismiss");
        $(".drft").removeAttr("aria-label");
        $("#svprop").addClass("colse");
        $("#svprop").removeAttr("data-dismiss");
      }); 
      $(document).on("click", ".ediprop", function () {
        document.getElementById('checkproperty').value = '';
       });  
    </script>
    <script type="text/javascript" src="{{asset('admin/_noblesoft/tinymce/tinymce.min.js')}}"></script>
    <script type="text/javascript">
      tinymce.init({
          selector: ".mceEditor",
          /*inline: true,*/
          plugins: [
              "advlist autolink lists link image charmap print preview anchor",
              "searchreplace visualblocks code fullscreen",
              "insertdatetime media table contextmenu paste"
          ],
          toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
      });
    </script>
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-68834369-1', 'auto');
  ga('send', 'pageview');
</script>
  </body>
</html>
