<!-- This view file shows the list of available categories of properties -->
@extends('layouts.default.start')
<!-- Goes to html>head>title -->
<?php $page_metas = \App\Pages::where('id', 41)->where('is_active', 1)->first(); ?>
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
Property Types - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<script type="text/javascript">
   $(document).ready(function() {
      $("#top_nav_8").addClass("active");
});
</script>
<!-- Page Content -->
<div class="breadcrumbs-area bread-bg-3 bg-opacity-black-70">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="breadcrumbs">
<h2 class="breadcrumbs-title">Property Types</h2>
<ul class="breadcrumbs-list">
<li><a href="{{url()}}">Home</a></li>
<li><a href="{{url('types/')}}">Properties</a></li>
<li class="active">Property Types</li>
</ul>
</div>
</div>
</div>
</div>
</div>
	<div class="container page-body space-reducer-responsive">
	<!-- Page Heading/Breadcrumbs -->
	<div class="row">
    <div class="col-lg-12">
      <h1 class="page-header">Property Types</h1>
    </div>
  </div>
  <!-- /.row -->
  @include('include.alerts')
  <!-- List of Categories -->
  <main class="remove-hr-responsive"> 
    <section class="row">
      <?php
        foreach ($categories as $category) {
        ?>
      <article class="col-md-4 col-sm-6 img-portfolio">
        <a href="{{url('type/'.$category->slug)}}">
        @if(is_file($category->image))
        <img class="img-responsive img-hover b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($category->image_small)}}" alt="{{$category->title}}">
        @else
        <img class="img-responsive img-hover b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">
        @endif
        </a>
        <h3 class="text-center"> <a href="{{url('type/'.$category->slug)}}">
          {{$category->title}} <!-- ({{count($category->properties)}}) -->
          </a> 
        </h3>
      </article>
      <?php
        }
        ?>
    </section>
    <hr>
  </main>
</div>
<!-- /.container -->
@endsection
