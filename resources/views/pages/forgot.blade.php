@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 46)->where('is_active', 1)->first(); ?>
@section('metatits')
{{$page_metas->meta_title}}
@endsection
@section('metadesc')
{{$page_metas->meta_descript}}
@endsection
@section('metakeys')
{{$page_metas->meta_keyword}}
@endsection
@section('title')

Forgot - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')





	<div class="breadcrumbs-area bread-bg-forgotpass bg-opacity-black-70">    

		<div class="container">         

			<div class="row">        

				<div class="col-xs-12">     

					<div class="breadcrumbs">        

						<h2 class="breadcrumbs-title">Forgot</h2>  

						<ul class="breadcrumbs-list">           	

							<li><a href="{{url()}}">Home</a></li>   

							<li>Forgot</li>        

						</ul>                  

					</div>         

				</div>         

			</div>

        </div>

    </div>





	<div class="login-section pt-115 pb-70">           

		<div class="container">                 

			<div class="row">           

				<div class="col-md-6 col-md-offset-3 col-xs-12 ">         

					<div class="registered-customers mb-50">     

						<h5 class="mb-50">FORGOT PASSWORD</h5>    
						@if(session('message'))

						  <div class="alert alert-danger">{{session('message')}}</div>

						@endif  
						<?php if(isset($_GET['send'])){ ?>
						<div class="alert alert-succes">We are sending you new password Please check your email</div>
						<?php } ?>
						<form id="forgot_frm" action="{{url('/sendforgotpass')}}" method="post">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<div class="login-account p-30">    

								<p>If you forgot your password fill the below detail</p>  		

								<div class="form-group  login-icon  m-b-0">

									<i class="fa fa-lock"></i>

									<input name="email" id="email" placeholder="Email Address" type="email" required="required">

								</div>

								<button class="submit-btn-1" type="submit">Reset Password</button>  

							</div>               

						</form>      

					</div>    

				</div>  

			</div>  

		</div>  

	</div>

	

	

	

	

@endsection

@section('javascript')

<script type="text/javascript">

  $(document).ready(function() {

    $('#light-gallery').lightGallery({

      selector: '.light-gallery-item'

    });

  });

</script>



<!-- Picture Gallery -->



    <!-- jQuery already included @ jquery-2.1.0.js -->



    <link type="text/css" rel="stylesheet" href="{{ asset('resources/plugins/lightGallery-master/dist/css/lightgallery.css')}}" />



    <!-- /. Picture Gallery -->

<!-- Picture Gallery/lightGallery -->



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



    <!-- End of Picture Gallery/lightGallery -->



@endsection

