@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 39)->where('is_active', 1)->first(); ?>
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

<div class="breadcrumbs-area bread-bg-howitworks bg-opacity-black-70">    
<div class="container">         
<div class="row">        
<div class="col-xs-12">     
<div class="breadcrumbs">        
<h2 class="breadcrumbs-title">How It Works</h2>  
<ul class="breadcrumbs-list">           	
	<li><a href="{{url()}}">Home</a></li>   
	<li>How It Works</li>        
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
<h3>How MatchPropertyDirect&trade; Works</h3>
<h6>MatchPropertyDirect&trade; matches sellers and buyers for a property direct sale</h6>
<p>Sellers will input the details of their home for a fee and have direct contact with potential buyers to negotiate a sale. It will remove the role of a middle men and their commission. It will allow the purchasers to have an intimate understanding of the home and its location.</p>
<div class="howItWorksArea">
<div class="row">
<div class="col-md-6 col-xs-12 mb-30">
<div class="howItWorksWrap">
<div class="left wow animated fadeInLeft sell-icon" data-wow-delay="0.2s">
<!--<img src="{{asset('pictures/logo-hiw.png')}}" alt="">-->
</div>
<div class="right">
<p class="secTitle wow animated fadeInLeft" data-wow-delay="0.6s"><span class="count">1</span><span class="title">Do you have something to sell?</span></p>
<p class="description wow animated fadeInLeft" data-wow-delay="0.8s">Create a listing through our Seller Login using your own words, description, photos and more !</p>
</div>
</div>
</div>
<div class="col-md-6 col-xs-12 mb-30">
<div class="howItWorksWrap">
<div class="left wow animated fadeInLeft something-icon" data-wow-delay="1.2s">
</div>
<div class="right">
<p class="secTitle wow animated fadeInLeft" data-wow-delay="1.5s"><span class="count">2</span><span class="title">Want to buy something?</span></p>
<p class="description wow animated fadeInLeft" data-wow-delay="1.8s">Just search ! Creating a login will allow you to set criterion for the type of real estate you are looking for. You’ll be notified as new properties are loaded to our site that meet any of your criteria.</p>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-md-6 col-xs-12 mb-30">
<div class="howItWorksWrap">
<div class="left wow animated fadeInLeft cost-icon" data-wow-delay="2.1s">
</div>
<div class="right">
<p class="secTitle wow animated fadeInLeft" data-wow-delay="2.4s"><span class="count">3</span><span class="title">What does it cost?</span></p>
<p class="description wow animated fadeInLeft" data-wow-delay="2.7s">Seller’s pay $59 monthly, $159 for a 6 months subscription or $259 for an annual subscription to list a property. Buyers search for free !</p>
</div>
</div>
</div>
<div class="col-md-6 col-xs-12 mb-30">
<div class="howItWorksWrap">
<div class="left wow fadeInLeft different-icon" data-wow-delay="3s">
</div>
<div class="right">
<p class="secTitle wow animated fadeInLeft" data-wow-delay="3.3s"><span class="count">4</span><span class="title">Why is this site different</span></p>
<p class="description wow animated fadeInLeft" data-wow-delay="3.7s">
We introduce buyers and sellers worldwide or around the corner, by email, online chat, social media or by phone ! Meet the people, love the home, close with local attorney.
</p>
</div>
</div>
</div>
</div>
</div>
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