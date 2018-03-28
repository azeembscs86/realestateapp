@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 52)->where('is_active', 1)->first(); ?>
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
	How It Works - {{$settings->site_title}}
@endsection

<!-- Yields body of the page inside the template -->

@section('contents')

	<div class="breadcrumbs-area bread-bg-pricing bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Search Notification</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Search Notification</li>        
						</ul>                  
					</div>         
				</div>         
			</div>
        </div>
    </div>
	<section id="page-content" class="page-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-sm-12 pt-80 pb-80 how-it-works-content">
					<h3> MatchPropertyDirect&trade; will notify you as soon as required property is avaialable on our site.</h3>
					<p>*Please check your email junk box if not received in inbox</p>
				</div>
			</div>
		</div>
	</section>
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