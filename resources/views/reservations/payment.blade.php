<!-- 
1. Enter credit card information to finishe a new reservation created
2. Also helps the customer to come on this page and deposit balance payment if any.
-->

@extends('layouts.default.start')
@section('title')
Payment | {{$property->title}} - {{$settings->site_title}}
@endsection
@section('contents')

<style>
.utl-home-banner figure::before, .utl-room-grid figure::before, .utl-content-des .thumb figure::before, .utl-tab-services-wrap::before, .news-letter-bg::after, .utl-testimonial-bg::before, .blog-detail-thumb figure a::before, .about_autor::before, .related-post figure::before, .inner-banner::before, .hotel-masonery-thumb::before, .utl-popular-post ul li::before, footer::before {
  bottom: 0;
  content: "";
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
}
.pull-top-70{ margin-top:70px; }
#payment-form .form-group .col-md-12 { padding:0; }
#payment-form .form-control { margin-bottom:10px !important; }
#payment-form .btn.btn-primary { font-weight: 300; height: auto; margin: 14px 0; padding: 5px 20px;}
#paypal_form .btn.btn-primary { font-weight: 300; height: auto; margin: 14px 0; padding: 5px 20px;}
.seprator h2{float: left;
    font-size: 17px;
    font-weight: 100;
    margin: 8px 0 10px;
    width: 100%;}
.set h3 { font-size: 19px; font-weight: 100; margin-bottom: 15px;}
.custm-set { color: #777777; float: left; font-size: 31px; margin-top: 5px; text-align: center; width: 100%;}
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
	

<div class="container page-body">
  <!-- Page Heading/Breadcrumbs -->
  
  @include('include.alerts')
  <!-- /.row -->
	<div class="row pull-top-70">
		<div class="col-md-3 hidden">
			<div id="propertyMainImage"> <img class="img-responsive" src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}" /> </div>
			<div class="col-md-12">
				<div class="col-md-5 info-cell-small">
					Bedrooms
					<div class="pull-right">
						<?= $property->bedrooms ?>
					</div>
				</div>
				<div class="col-md-5 info-cell-small">
					Bathrooms
					<div class="pull-right">
						<?= $property->bathrooms ?>
					</div>
				</div>
				<div class="col-md-5 info-cell-small">
					Sleeps
					<div class="pull-right">
						<?= $property->sleeps ?>
					</div>
				</div>
				<div class="col-md-5 info-cell-small">
					Garages
					<div class="pull-right">
						<?= $property->garages ?>
					</div>
				</div>
				<div class="text-center"> 
					@foreach($property->classez as $class)
						<div class="col-md-6">
							<i class="glyphicon glyphicon-ok"></i>
							{{$class->theclass->title}}
						</div>
					@endforeach
				</div>
			</div>
			<nav>
				<ul class="pager">
					<li><a href="{{url('show/'.$property->slug)}}"><span aria-hidden="true">&larr;</span> Property Detail</a></li>
				</ul>
			</nav>
		</div>
		<div class="col-md-7">
			<h3>Confirm Reservation Details</h3>
			<table class="table table-bordered" style="margin-top:20px;" >
				<tr>
					<td>First Name</td>
					<td><?= $reservation->firstname ?></td>
				</tr>
				<tr>
					<td>Last Name</td>
					<td><?= $reservation->lastname ?></td>
				</tr>
				<tr>
					<td>Email</td>
					<td><?= $reservation->email ?></td>
				</tr>
				<tr>
					<td>Phone</td>
					<td><?= $reservation->phone ?></td>
				</tr>
				<tr>
					<td>City</td>
					<td><?= $reservation->city ?></td>
				</tr>
				<tr>
					<td>State</td>
					<td> <?= @$reservation->location->title ?></td>
				</tr>
				<tr>
					<td>Zip</td>
					<td><?= $reservation->zip ?></td>
				</tr>	
			
				<tr>
					<td>Property Name</td>
					<td><?= $property->title ?></td>
				</tr>
				<tr>
					<td>Date of Arrival</td>
					<td><?= date("m/d/Y", strtotime($reservation->date_start)) ?></td>
				</tr>
				<tr>
					<td>Date of Departue</td>
					<td><?= date("m/d/Y", strtotime($reservation->date_end)) ?></td>
				</tr>
			
				<tr>
					<td>Lodging Amount</td>
					<td>${{number_format($reservation->lodging_amount,2)}}</td>
				</tr>
				@foreach ($reservation->services as $addon)
					<tr>
						<td><?= $addon->service->title ?></td>
						<td>
							@if($addon->quantity>'0')
							${{number_format($addon->price/$addon->quantity,2)}} x {{$addon->quantity}}
							@else
							Nill
							@endif
						</td>
					</tr>
				@endforeach
				@foreach ($lineitems as $lineitem)
				<tr>
					<td> <?= $lineitem->title ?></td>
					<td>${{number_format($lineitem->value,2)}}</td>
				</tr>
				@endforeach
				<tr>
					<td>Total Amount</td>
					<td>${{number_format($reservation->total_amount,2)}}</td>
				</tr>
			
			
			<?php 
				$amount_payable = 0;
			?>
			@foreach ($transactions as $transaction)
		  
				<tr>
					<td>Payment</td>
					<td>${{number_format($transaction->amount,2)}}</td>
				</tr>
				<tr>	
					<td>Deposit Term</td>
					<td><?= ucwords($transaction->deposit_term) ?></td>
				</tr>
				<tr>	
					<td>Status</td>
					<td><?= ucwords($transaction->status) ?></td>
				</tr>
				<tr>
					<td>Date Due</td>
					<td>
						<?php
							echo (date("Y-m-d",strtotime($transaction->date_due)) == date('Y-m-d')) ? '<span class="bg-danger">Today</span>' : date("m/d/Y",strtotime($transaction->date_due));
						?>
					</td>
					<?php
						if ($transaction->date_due <= date('Y-m-d') AND $transaction->status=='pending') {
						$payment_id = $transaction->id;
						$amount_payable += $transaction->amount;
					}
					?>
				</tr>
				@endforeach
			</table>

		</div>
		<div class="col-md-4 col-md-offset-1">
			<div class="set-form-layout">
			
				@if($amount_payable>0)
				<div class="row-fluid set">
					<h3>Paying now: ${{number_format($amount_payable,2)}}</h3>
				</div>
				@include('reservations._checkout')
				@else
					All amounts due by today for this reservation have already been paid!
				@endif
		  
			</div>
		</div>
	</div>
  <!-- /.row -->
  <!-- /.row -->
  <hr>
</div>
<!-- /.container -->
@endsection
