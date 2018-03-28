@extends('layouts.default.start')
<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 40)->where('is_active', 1)->first(); ?>
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
Contact Us - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<script type="text/javascript">
$(document).ready(function() {
$("#top_nav_6").addClass("active");
});
</script>
<style>
.section-title h3 { float: left; margin-right: 5px;}
.section-title.mb-30 > h2 { position: relative; top: -3px;}
.own-set { border-color: #cccccc; margin: 10px 0 0; width: 220px;}
.thank-you{font-size: 18px;border: 2px solid #3b5265;margin-top: 15px;font-weight: 400;}
</style>
<div class="breadcrumbs-area bread-bg-contact"> 
<div class="container"> 
<div class="row"> 
<div class="col-xs-12"> 
<div class="breadcrumbs"> 
<h2 class="breadcrumbs-title">Contact Us</h2> 
<ul class="breadcrumbs-list"> 
<li><a href="{{url()}}">Home</a></li> 
<li>Contact Us</li> 
</ul> 
</div> 
</div> 
</div>
</div>
</div>
<div class="container page-body">
<!-- Page Heading/Breadcrumbs -->
<section id="page-content" class="page-wrapper"> 
<div class="contact-area pt-115"> 
<div class=""> 
<div class="row"> 
<div class="col-md-5 col-xs-12"> 
<div class="get-in-toch">
<div class="section-title mb-30"> 
<h3>GET IN</h3> 
<h2>TOUCH</h2> 
<hr class="own-set" /> 
</div> 
<div class="contact-desc mb-50">
<p><span data-placement="top" data-toggle="tooltip" data-original-title="The name you can trust" class="tooltip-content"></span>Please contact us if you have any question or concerns. We will have a response for you as soon as possible. MatchPropertyDirect&trade; welcomes your customer feedback.</p> 
</div> 
<ul class="contact-address"> 
<li> 
<div class="contact-address-icon"> 
<img src="{{ asset('resources/images/icons/location-2.png') }}" alt="">
</div> 
<div class="contact-address-info">
<span>{{$settings->site_address_line_1}}</span>
<span>{{$settings->site_address_line_2}}</span>
</div>
</li>
<li>
<div class="contact-address-icon">
<img src="{{ asset('resources/images/icons/phone-3.png') }}" alt="">
</div>
<div class="contact-address-info">
<span>Telephone : {{$settings->site_phone}}</span>
<span>Telephone : {{$settings->site_phone2}}</span>
</div>
</li>
<li>
<div class="contact-address-icon">
<img src="{{ asset('resources/images/icons/world.png') }}" alt=""> 
</div>
<div class="contact-address-info"> 
<span>Email : {{$settings->site_email}}</span>
<span>Email : {{$settings->site_email2}}</span> 
<span>Web :<a href="{{$settings->site_url}}" target="_blank"> {{$settings->site_url}}</a></span> 
</div> 
</li> 
</ul>
</div>
</div>
<div class="col-md-7 col-xs-12">
<div class="contact-messge contact-bg">
<div class="leave-review">
<h5>Leave a Message</h5>
<form id="contact_frm" action="{{url('/sendcontactemail')}}" method="post">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="text" name="name" placeholder="Your name" required="required"> 
<input type="email" name="email" placeholder="Email" required="required"> 
<textarea name="message" placeholder="Write here" required="required"></textarea> 
<button type="submit" class="submit-btn-1">SUBMIT</button> 
</form>
@if(session('message'))

<div class="alert alert-sucess thank-you">{{session('message')}}</div>

@endif 
</div> 
</div> 
</div> 
</div> 
</div> 
</div> 
<!--</div--->
</section>
<!--body_area end-->
@endsection
