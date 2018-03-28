<!-- This view file shows the list of properties matching a specific category the user has clicked -->
@extends('layouts.002.start')
<!-- Goes to html>head>title -->
@section('title')
{{$category->title}} - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<!-- Page Content -->

<style type="text/css">
  .page-header-bg:before {
    background-image: url('{{asset($category->image)}}');
}

</style>

	<div class="utl-home-banner inner-banner">
		<div class="container">
			<h3>{{$category->title}}</h3>
			<span><i class="icon-hotel"></i></span>
			<ul class="breadcrumb">
				<li><a href="{{url()}}">Home</a></li>
				<li><a href="{{url('types/')}}">Properties</a></li>
			</ul>
		</div>
	</div>
	
	<!--div class="page-header-bg">
		<div class="container">
			 <h1 class="pull-left">
				Properties &#10095; {{$category->title}}
			 </h1>
			 <ol class="breadcrumb pull-right">
				<li><a href="{{url()}}">Home</a></li>
				<li><a href="{{url('types/')}}">Properties</a></li>
				<li class="active">
				   {{$category->title}}
				</li>
			 </ol>
		</div>
	</div-->

	<div class="container" >
		
		@include('include.alerts')
		<?php
		
			$filters = array();
			$filters_check = array();
			foreach($properties as $property)
			{
				foreach($property->classez as $class)
				{
					if(!in_array($class->theclass->slug, $filters_check)) 
					{
						$filter = (object) ['slug'=>$class->theclass->slug,'title'=>$class->theclass->title];
						array_push($filters, $filter);
						array_push($filters_check, $class->theclass->slug);
					}
				}
			}
		?>	
			
			<div class="ka-grid-layout-wrap">
				<div class="col-md-2 col-sm-4 col-xs-12">
					<div class="utl-grid-icon">
						<button class="active"><i class="fa fa-th"></i></button>
						<button><i class="fa fa-th-list"></i></button>
					</div>
				</div>
				<div class="col-md-7 col-sm-4 col-xs-12">
					<div class="utl-items-show">
						<span>Item 1 to 6 of 6 items</span>
						<p class="items-left">Show</p>
						<div class="selectric-wrapper selectric-basic"><div class="selectric-hide-select"><select class="basic" tabindex="0">
							<option value="0">1</option>
							<option value="9">2</option>
							<option value="2">3</option>
							<option value="3">4</option>
							<option value="6">5</option>
							<option value="8">6</option>
						</select></div><div class="selectric"><p class="label">1</p><b class="button">▾</b></div><div class="selectric-items" tabindex="-1" style="width: 66px;"><div class="selectric-scroll"><ul><li data-index="0" class="selected">1</li><li data-index="1" class="">2</li><li data-index="2" class="">3</li><li data-index="3" class="">4</li><li data-index="4" class="">5</li><li data-index="5" class="last">6</li></ul></div></div><input class="selectric-input" tabindex="0"></div>
						<p class="items-right">per page</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="utl-items-show show-2">
						<span class="stor-by">Sort by:</span>
						<div class="selectric-wrapper selectric-basic"><div class="selectric-hide-select"><select class="basic" tabindex="0">
							<option value="0">Default</option>
							<option value="9">Sort By Price</option>
							<option value="2">Sort By Name</option>
						   
						</select></div><div class="selectric"><p class="label">Sort By Price</p><b class="button">▾</b></div><div class="selectric-items" tabindex="-1" style="width: 141px;"><div class="selectric-scroll"><ul><li data-index="0" class="">Default</li><li data-index="1" class="selected">Sort By Price</li><li data-index="2" class="last">Sort By Name</li></ul></div></div><input class="selectric-input" tabindex="0"></div>
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		@if(count($filters)>0)
			<div class="col-md-12">
				<div class="row">
					<ul id="filter-options">
						<li><a class="active" href="#" data-group="all">All</a></li>
						@foreach($filters as $filter)
						<li><a href="#" data-group="{{$filter->slug}}">{{$filter->title}}</a></li>
						@endforeach
					</ul>
				</div>
			</div>
		@endif

		<!-- List of Properties -->


		<main>
			<div class="row" id="filter-results">
				<?php if(count($properties)=='0'){ ?>
				<h2 style="text-align: center">Sorry, no results found for this category!</h2>
				<?php }
				else{ 
						?>
						@foreach ($properties as $property)
						@include('properties._type-article')
						@endforeach
						<?php 
					} 
				?>
			</div>
			<hr/>
		</main>
		
		<div class="utl-pagination pagi-center">
			<ul class="pagination">

				<li class="active"><a href="#">1</a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li>
					<a aria-label="Next" href="#">
					<span aria-hidden="true"><i class="fa fa-angle-right"></i></span>
					</a>
				</li>
			</ul>
		</div>		
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