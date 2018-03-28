@extends('layouts.default.start')
<!-- Goes to html>head>title -->
@section('metatits')
{{$page->meta_title}}
@endsection
@section('metadesc')
{{$page->meta_descript}}
@endsection
@section('metakeys')
{{$page->meta_keyword}}
@endsection
@section('title')
{{$page->title}} - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<script type="text/javascript">
$(document).ready(function() {
$("#top_nav_33").addClass("active");
});
</script>
<div class="breadcrumbs-area bread-bg-about bg-opacity-black-70 page{{$page->id}}">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div class="breadcrumbs">
<h2 class="breadcrumbs-title">{{$page->title}}</h2>
<ul class="breadcrumbs-list">
<li><a href="{{url()}}">Home</a></li>
<li>{{$page->title}}</li>
</ul>
</div>
</div>
</div>
</div>
</div>
<div class="container page-body ptb-115">
<!-- Welcome Contents Section -->
<div class="row">
@if(isset($page->images->first()->image) and is_file($page->images->first()->image))
<div class="col-md-6 col-xs-12">
<?php if($page->id == 2){ ?>
<img class="test img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($page->images->first()->image)}}" alt="property for sale near me"> <br/>
<?php }else if($page->id == 47){ ?>
<img class="test img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($page->images->first()->image)}}" alt="buying your first home"> <br/>
<?php }else if($page->id == 48){ ?>
<img class="test img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($page->images->first()->image)}}" alt="selling your home"> <br/>
<?php }else{ ?>
<img class="test img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($page->images->first()->image)}}" alt="{{$page->title}}"> <br/>
<?php } ?>
</div>
<div class="col-md-6 col-xs-12">
{!!$page->contents!!}
</div>
@else
<div class="col-md-12 col-xs-12">
{!!$page->contents!!}
</div>
@endif	
</div>
<!-- /.row -->
<!-- /.row -->
</div>
@endsection
@section('javascript')
<!-- A jQuery plugin that adds cross-browser mouse wheel support. (Optional) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" async></script>
<!-- lightgallery plugins -->
<!-- End of Picture Gallery/lightGallery -->
@endsection