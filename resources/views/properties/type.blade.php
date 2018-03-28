<!-- This view file shows the list of properties matching a specific category the user has clicked -->
@extends('layouts.default.start')
<!-- Goes to html>head>title -->
@section('title')
{{$category->title}} - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<!-- Page Content -->

<style type="text/css">
  .page-header-bg:before {background-image: url('{{asset($category->image)}}');}

</style>
<script type="text/javascript">
   $(document).ready(function() {
      $("#top_nav_8").addClass("active");
});
</script>
	<div class="breadcrumbs-area bread-bg-3 bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">Properties</h2>  
						<ul class="breadcrumbs-list">           				
							<li><a href="{{url()}}">Home</a></li>
							<li><a href="{{url('types/')}}">Properties</a></li>
							<li class="active">
							   {!!$category->title!!}
							</li>      
						</ul>                  
					</div>         
				</div>         
			</div>            
		</div>        
	</div>
	<div class="container page-body type-cs-h">

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
		<main class="remove-hr-responsive">
			<div class="row" id="filter-results">
				<?php if(count($properties)=='0'){ ?>
				<h2 style="text-align: center">Sorry, no results found for this category!</h2>
				<?php }else{ ?>
				<div class="featured-flat-area pt-115 pb-80">
					<div class="container">
						<div class="featured-flat">
							<div class="row">
								@foreach ($properties as $property)
								@include('properties._type-article')
								@endforeach
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
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
			$('#filter-options a').click(function (e) 
			{
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
<script type="text/javascript">
$("#state_id").change(showmap_search);	
function showmap_search(){
var output = "",$this = $(this);
    if($this.val() != 0){
        output = $this.find('option:selected').attr('rel');
    } 
var showmap = '<iframe width="100%" height="300" src="https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=300&hl=ru&q='+output+'+(Your%20Town/Province)&ie=UTF8&t=&z=5&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>'	;
$("#shw_map").html(showmap);	
}	
</script>
@endsection