@extends('layouts.002.start')

@section('javascript')
@section('title')
About Us - {{$settings->site_title}}

@endsection


@section('contents')






<div class="utl-home-banner inner-banner">
	<div class="container">
		<h3>About1</h3>
		<span><i class="icon-hotel"></i></span>
		<ul class="breadcrumb">
			<li><a href="{{url()}}">Home</a></li>
			<li><a href="">About us1</a></li>
		</ul>
	</div>
</div>


<div class="utl-content_wrap">
			<section class="utl-aboutus-wrap">
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="text">
								<h4>Who We Are ?</h4>
								<h5>Short Overview</h5>
								<p>Class aptent taciti sociosqu ad litora torquent per conubia nostra perhim. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut aliquam massa nisl quis neque.</p>
								<p>Sed ut imperdiet nisi. Proin condimentum. Etiam pharetra erat sed feugiat velit mauris egestas quam ut aliquam massa nisl quis neque.</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="video-thumb">
							<img src="{{asset('resources/assets/extra-images/services-wrap.jpg')}}">
							</div>
						</div>
					</div>
				</div>
			</section>
			
			
			<section class="utl-tab-services-wrap" style="padding:70px 0;">
				<div class="container">
					<div class="col-md-12">
						<div class="utl-heading-1">
							<h3>Why Choose Us</h3>
							<span><i class="icon-hotel fnt-white"></i></span>
						</div>
					</div>
					<div class="utl-tab-services">
					<ul class="nav nav-tabs tab-services" role="tablist">
						<li role="presentation" class="active"><a href="#food" aria-controls="food" role="tab" data-toggle="tab">
							<i class="icon-food"></i> Food
						</a></li>
						<li role="presentation"><a href="#think" aria-controls="think" role="tab" data-toggle="tab">
							<i class="icon-monitor"></i> Think Labs
						</a></li>
						<li role="presentation"><a href="#setup" aria-controls="setup" role="tab" data-toggle="tab">
							<i class="icon-note"></i> Setup
						</a></li>
						<li role="presentation"><a href="#lab-locations" aria-controls="lab-locations" role="tab" data-toggle="tab">
							<i class="icon-interface"></i> Lab Locations
						</a></li>
					</ul>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="food">
							<div class="tab-services-contant">
								<div class="col-md-5">
									<figure>
										<img src="{{asset('resources/assets/extra-images/services-tab-1.jpg')}}">
									</figure>
								</div>
								<div class="col-md-7">
									<div class="text">
										<span>food options</span>
										<h5>The 4 food options</h5>
										<p>Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut aliquam massa nisl quis neque. </p>
										<p>Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut . </p>
									   								
										<a href="#" class="small-btn shadow-shadow">Read More</a>
									</div>
								
								</div>
							</div>
						
						</div>
						<div role="tabpanel" class="tab-pane" id="think">
						
							<div class="tab-services-contant">
								<div class="col-md-5">
									<figure>
										<img src="{{asset('resources/assets/extra-images/services-tab-2.jpg')}}">
									</figure>
								</div>
								<div class="col-md-7">
									
									<div class="text">
										<span>The Training Labs</span>
										<h5>Think Labs</h5>
										<p>Proin condimentum fermentum nunc. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut aliquam massa nisl quis neque. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.Sed ut imperdiet nisi. Proin condimentum fermentum nunc. </p>
										
										
										
										<a href="#" class="small-btn shadow-shadow">Read More</a>
									</div>
									
								</div>
							</div>
							
						</div>
						<div role="tabpanel" class="tab-pane" id="setup">
							
							<div class="tab-services-contant">
								<div class="col-md-5">
									<figure>
										<img src="{{asset('resources/assets/extra-images/services-tab-3.jpg')}}">
									</figure>
								</div>
								<div class="col-md-7">
								
									<div class="text">
										<span>The Training Labs</span>
										<h5>Setup</h5>
										<p>Proin condimentum fermentum nunc. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut aliquam massa nisl quis neque. </p>
										<p>Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut . </p>
										
										<a href="#" class="small-btn shadow-shadow">Read More</a>
									</div>
									
								</div>
							</div>
							
						</div>
						<div role="tabpanel" class="tab-pane" id="lab-locations">
							
							<div class="tab-services-contant">
								<div class="col-md-5">
									<figure>
										<img src="{{asset('resources/assets/extra-images/services-tab-4.jpg')}}">
									</figure>
								</div>
								<div class="col-md-7">
									
									<div class="text">
										<span>The Training Labs</span>
										<h5>Lab Locations</h5>
										<p>Etiam pharetra erat sed fermentum feugiat velit mauris egestas quam ut aliquam massa nisl quis neque. Sed ut imperdiet nisi. Proin condimentum fermentum nunc.Sed ut imperdiet nisi. Proin condimentum fermentum nunc. </p>
									
										<a href="#" class="small-btn shadow-shadow">Read More</a>
									</div>
								
								</div>
							</div>
							
						</div>
					</div>
				
					</div>
				</div>
			</section>
		
			<section class="our-service-area">
				<div class="container">
				
				<div class="services-wrap">
					
						<div class="col-md-12">
							<div class="utl-heading-1">
								<h3>Our  Services</h3>
								<span><i class="icon-hotel"></i></span>
							</div>
						</div>
					
						<div class="row">
					
							<div class="col-md-3 col-sm-6">
								<div class="services-thumb">
									<span class="icon-location"></span>
									<h5><a href="#">Locations</a></h5>
									<p>Lorem Ipsum is simply dummy text of the printing.</p>
								</div>
							</div>
					
							<div class="col-md-3 col-sm-6">
								<div class="services-thumb">
									<span class="icon-people"></span>
									<h5><a href="#">Training Rooms</a></h5>
											<p>Lorem Ipsum is simply dummy text of the printing.</p>
								</div>
							</div>
						
							<div class="col-md-3 col-sm-6">
								<div class="services-thumb">
									<span class="icon-monitor"></span>
									<h5><a href="#">Book Online</a></h5>
											<p>Lorem Ipsum is simply dummy text of the printing.</p>
								</div>
							</div>
				
							<div class="col-md-3 col-sm-6">
								<div class="services-thumb">
									<span class="icon-food"></span>
									<h5><a href="#">Food Option</a></h5>
											<p>Lorem Ipsum is simply dummy text of the printing.</p>
								</div>
							</div>
							
						</div>
					</div>
				</div>
			</section>
	
			<section class="utl-testimonial-bg">
				<div class="container">
					<div class="col-md-12">
						<div class="utl-heading-1">
							<h3 class="fnt-white">Our Testimonial</h3>
							<span><i class="icon-hotel fnt-white"></i></span>
						</div>
					</div>
					<div id="owl-demo-3" class="owl-carousel owl-theme">
						<div class="item">
							<div class="utl-testimonial-des">
								<figure><img src="{{asset('resources/assets/extra-images/testimonial1.jpg')}}"></figure>
								<div class="text">
									<h5>Rebecca Doe</h5>
									<em>Happy Customer</em>
									<p>Nullam ac urna eu felis sit amet a augue. Sed neque sed ut nisi neque sed ut urna eu felis sit amet. Nemo enim ipsam voluptatem aspernatur aut odit aut fugit.</p>
									<div class="rating">
										<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="utl-testimonial-des">
								<figure><img src="{{asset('resources/assets/extra-images/testimonial1.jpg')}}"></figure>
								<div class="text">
									<h5>Rebecca Doe</h5>
									<em>Happy Customer</em>
									<p>Nullam ac urna eu felis sit amet a augue. Sed neque sed ut nisi neque sed ut urna eu felis sit amet. Nemo enim ipsam voluptatem aspernatur aut odit aut fugit.</p>
									<div class="rating">
										<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
									</div>
								</div>
							</div>
						</div>
						<div class="item">
							<div class="utl-testimonial-des">
								<figure><img src="{{asset('resources/assets/extra-images/testimonial1.jpg')}}"></figure>
								<div class="text">
									<h5>Rebecca Doe</h5>
									<em>Happy Customer</em>
									<p>Nullam ac urna eu felis sit amet a augue. Sed neque sed ut nisi neque sed ut urna eu felis sit amet. Nemo enim ipsam voluptatem aspernatur aut odit aut fugit.</p>
									<div class="rating">
										<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
			 <div class="utl-brand-partner p-t-60">
				<div class="container">
					<div class="utl-heading-1">
			 				<h3>Our Clients</h3>
			 				<span><i class="icon-hotel"></i></span>
			 			</div>
					<div class="row">
						<div id="owl-demo-4" class="owl-carousel owl-theme">
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-1.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-2.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-3.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-4.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-5.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-6.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-1.png')}}"/></figure>
							</div>
							<div class="item">
								<figure><img src="{{asset('resources/assets/extra-images/brand-2.png')}}"/></figure>
							</div>
						</div>
					</div>
				</div>
			</div>
			

		</div>






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
<!--
    <script src="https://cdn.jsdelivr.net/picturefill/2.3.1/picturefill.min.js"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-fullscreen.js')}}"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-thumbnail.js')}}"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-video.js')}}"></script>

  <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-autoplay.js')}}"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-zoom.js')}}"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-hash.js')}}"></script>

    <script src="{{ asset('resources/plugins/lightGallery-master/dist/js/lg-pager.js')}}"></script>
-->
    <!-- End of Picture Gallery/lightGallery -->

@endsection
