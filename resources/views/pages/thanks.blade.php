@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 50)->where('is_active', 1)->first(); ?>
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
						<h2 class="breadcrumbs-title">Thanks</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>Thanks</li>        
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
					<h3>Thanks for the payment</h3>
					<p>Payment Received. You are successfully subscribed to one of our plans.</p>
					<a href="{{url('/owner/dashboard')}}" class="pricingBtn submit-btn-1 register_btn btn-md btn-about">Go to Dashboard</a>
				</div>
			</div>
		</div>
	</section>
@endsection