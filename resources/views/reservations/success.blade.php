<!-- Yeah, you get here when made a successful reservation -->
@extends('layouts.default.start')
@section('title')
Successfully Reserved | {{$property->title}} - {{$settings->site_title}}
@endsection
@section('contents')

<style>
.bread-bg-3 {background:url('{{asset($property->images->first()->image)}}'); background-size:cover; background-position:center center;}
</style>
<div class="breadcrumbs-area bread-bg-3 bg-opacity-black-70">    
	<div class="container">         
		<div class="row">        
			<div class="col-xs-12">     
				<div class="breadcrumbs">        
					<h2 class="breadcrumbs-title">Booking - {!!$property->title!!}</h2>  
					<ul class="breadcrumbs-list">           				
						<li><a href="{{url()}}">Home</a></li>
						<li><a href="properties.php">Booking</a></li>
						<li class="active"><a href="properties.php"> {{ $property->title }} </a></li>
					</ul>                  
				</div>         
			</div>         
		</div>            
	</div>        
</div>



<div class="container page-body"  style="margin-top:60px;">
	@include('include.alerts')
  
	<div class="row pb-60">
		

		<div class="col-md-4">
		
			<div id="propertyMainImage"> 
				<img class="img-responsive" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}" /> 
			</div>
			<br>
			
			
			
			
			
			
			<div class="row">
				<div class="col-md-6 info-cell-small div-gray">
					<i class="fa fa-bed"> </i> Bedrooms
					<div class="pull-right">
						{{ $property->bedrooms }}
					</div>
				</div>
				<div class="col-md-6 info-cell-small div-gray">
					<i class="fa fa-bath"> </i> Baths
					<div class="pull-right">
						{{ $property->bathrooms }}
					</div>
				</div>
				<div class="col-md-6 info-cell-small div-gray">
					<i class="fa fa-users"></i> Sleeps
					<div class="pull-right">
						{{ $property->sleeps }}
					</div>
				</div>
				<div class="col-md-6 info-cell-small div-gray">
					<i class="fa fa-car"> </i> Garages
					<div class="pull-right">
						{{ $property->garages }}
					</div>
				</div>
			</div>
			<!--nav>
				<ul class="pager">
					<li><a href="{{url('show/'.$property->slug)}}"><span aria-hidden="true">&larr;</span> Property Detail</a></li>
				</ul>
			</nav-->
		</div>
			
		<div class="col-lg-8">
			<p class="text-success">
				<h2> {{ @$message }} </h2>
			</p>
			<table class="table table-striped">
				<tr>
					<td>Property Name</td>
					<td>
						{{ $property->title }}
					</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>
						{{ $property->address }}
					</td>
				</tr>
				<tr>
					<td>City</td>
					<td>
						{{ $property->city }}
					</td>
				</tr>
				<tr>
					<td>State</td>
					<td>
						{{ $property->title }}
					</td>
				</tr>
				<tr>
					<td>Zip</td>
					<td>
						{{ $property->zip }}
					</td>
				</tr>
			</table>
		
			<p>
				{!! $property->summary !!}
			</p>
		</div>
		
	</div>
</div>
<!-- /.container -->
@endsection
