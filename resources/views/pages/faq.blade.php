@extends('layouts.default.start')

<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 51)->where('is_active', 1)->first(); ?>
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
						<h2 class="breadcrumbs-title">FAQ</h2>  
						<ul class="breadcrumbs-list">           	
							<li><a href="{{url()}}">Home</a></li>   
							<li>FAQ</li>        
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
					<h3>FAQs</h3>
					<h6>Q: Who can use MatchPropertyDirect?</h6>
					<p>A: Anyone who wants to tell their own story, take control of their own sale and connect directly! For Example:</p>
					<ul>
					<li>Attorneys</li>
					<li>Property Appraisers</li>
					<li>Former Estate Agents</li>
					<li>Former Real Estate Agents</li>
					<li>Anyone that wants to connect directly with the buyer and communicate directly with seller.</li>	
					</ul>
				</div>
			</div>
		</div>
	</section>
@endsection