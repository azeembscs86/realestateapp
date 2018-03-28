@extends('layouts.default.start')
<?php $page_metas = \App\Pages::where('id', 58)->where('is_active', 1)->first(); ?>
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
User Unsubscribe - {{$settings->site_title}}
@endsection
@section('contents')
<div class="breadcrumbs-area bread-bg-pricing bg-opacity-black-70">    
<div class="container">         
<div class="row">        
<div class="col-xs-12">     
<div class="breadcrumbs">        
<h2 class="breadcrumbs-title">Unsubscribe</h2>  
<ul class="breadcrumbs-list">           	
<li><a href="{{url()}}">Home</a></li>   
<li>Unsubscribe</li>        
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
<p style="text-align:center; font-size:18px;">You have been successfully unsubscribed from our mailing list. <a href="https://www.matchpropertydirect.com/#page-content">Click here</a> to search for property.</p>
</div>
</div>
</div>
</section>
@endsection