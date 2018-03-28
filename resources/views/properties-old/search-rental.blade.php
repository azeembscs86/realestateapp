<!-- This view file shows resulted items in response of user's search -->
@extends('layouts.default.start')
<!-- Goes to html>head>title -->
@section('title')
Search Results - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<!-- Page Content -->
<style type="text/css">

<style>
.inner-banner::before {
  background: #000 none repeat scroll 0 0 !important;
  content: "";
  float: left;
  height: 100%;
  left: 0;
  opacity: 0.75 !important;
  position: absolute;
  top: 0;
  width: 100%;
}
  .page-header-bg:before {
    <?php if(count($properties)>'0'){ ?>
    background-image: url('{{asset($properties[0]->images->first()->image)}}');
    <?php } ?>
}
</style>
	<div class="inner-banner">
		<div class="container">
			<h3>Search Vacation Properties &#10095; {{count($properties)}} results found!</h3>
			<span><i class="icon-hotel"></i></span>
			<ul class="breadcrumb">
				<li><a href="{{url()}}">Home</a></li>
				<li><a href="{{url('types/')}}">Properties</a></li>
			</ul>
		</div>
	</div>


  



<div class="container ">
  <!-- /.row -->
  <main>
  @include('include.alerts')

<?php
$filters = array();
$filters_check = array();
foreach($properties as $property){
foreach($property->classez as $class){
  if(!in_array($class->theclass->slug, $filters_check)) 
    {
      $filter = (object) ['slug'=>$class->theclass->slug,'title'=>$class->theclass->title];
      array_push($filters, $filter);
      array_push($filters_check, $class->theclass->slug);
    }
}
}
?>
@if(count($filters)>0)
<div class="col-md-12">

  <ul id="filter-options">
    <li><a class="active" href="#" data-group="all">All</a></li>
    @foreach($filters as $filter)
    <li><a href="#" data-group="{{$filter->slug}}">{{$filter->title}}</a></li>
    @endforeach
  </ul>

</div>
@endif




  <!-- List of Properties -->
    <section class="row" id="filter-results">
    <?php if(count($properties)=='0'){ ?>
      <h2 style="text-align: center">Sorry, no results found for your search</h2>
    <?php }else{ ?>

      @foreach ($properties as $property)
      @include('properties._search-rental-article')
      @endforeach
    
    <?php } ?>

    </section>
  <!-- End List of Properties -->
    <hr/>
  </main>
</div>
<!-- /.container -->


@endsection


@section('javascript')
<script src="{{ asset('js/jquery.shuffle.min.js') }}" type="text/javascript"></script>

<script>
    $(document).ready(function() {

      /* initialize shuffle plugin */
      var $grid = $('#filter-results');

      $grid.shuffle({
        itemSelector: '.item' // the selector for the items in the grid
      });

      /* reshuffle when user clicks a filter item */
      $('#filter-options a').click(function (e) {
        e.preventDefault();

        // set active class
        $('#filter-options a').removeClass('active');
        $(this).addClass('active');

        // get group name from clicked item
        var groupName = $(this).attr('data-group');

        // reshuffle grid
        $grid.shuffle('shuffle', groupName );
      });

    });
  </script>

@endsection