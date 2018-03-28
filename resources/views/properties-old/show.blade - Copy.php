@extends('layouts.default.start')

@section('title')

{{$property->title}} - {{$settings->site_title}}

@endsection

@section('contents')


<style type="text/css">
  .inner-banner{
    background-image: url('{{asset($property->images->first()->image)}}') !important;
	
}
.breadcrumb > li + li::before {
  content: "";
}
.utl-home-banner figure::before, .utl-room-grid figure::before, .utl-content-des .thumb figure::before, .utl-tab-services-wrap::before, .news-letter-bg::after, .utl-testimonial-bg::before, .blog-detail-thumb figure a::before, .about_autor::before, .related-post figure::before, .inner-banner::before, .hotel-masonery-thumb::before, .utl-popular-post ul li::before, footer::before {
  bottom: 0;
  content: "";
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
}
.property-description .row{ margin:0 auto; }
.detail-fact { margin-bottom: 30px;}
</style>

<!--div class="utl-home-banner inner-banner">
	<div class="container">
		<h3>About</h3>
		<span><i class="icon-hotel"></i></span>
		<ul class="breadcrumb">
			<li><a href="{{url()}}">Home</a></li>
			<li><a href="">About us</a></li>
		</ul>
	</div>
</div-->

	<div class="utl-home-banner inner-banner">
		<div class="container">
			<h3>
				{!!$property->title!!} 
			</h3>
			<span><i class="icon-hotel"></i></span>
			<ul class="breadcrumb">
				<li><a href="{{url()}}">Home</a></li>
				<li><a href="{{url('types/')}}">Properties</a></li>
				<li class="active"><a href="javascript:void(0);"> {!!$property->title!!} </a></li>
			</ul>
		</div>
	</div>

<section class="page-detail-2">
	<div class="container">
		@include('include.alerts')
		<!-- /.row -->
		<!-- Property Detail -->
		<div class="row">
			<!-- Left/Middle Column :: Property Images/Description/Amenities/Features/Rates/Map -->
			<div class="col-md-8 col-sm-8 col-xs-12 property-description">
			
				<div class="utl-detail-hd">
					<div class="grid2-heading">
						<h3>{!!$property->title!!}</h3>
						<h6>Check out the latest details</h6>
					</div>
					
				</div>
			
				<div class="clearfix"></div>
				@include('properties._show-images')
				@if($property->is_sale=='1')
				<div class="row property-for-sale-info">
					<div class="col-md-6"><i>For Sale:</i><h3>${{$property->sale_price}}</h3></div>
					<div class="col-md-6 text-right">{{$property->address}}<br/>{{$property->city}}<br/>{{$property->zip}}, {{$property->location->title}}</div>
				</div>
				@endif
				@include('properties._show-quick-detail')
				@include('properties._show-description')
				@if($property->is_vacation=='1')
				@if($property->is_rates=='1')
				<div class="clearfix"></div>
				<div class="row">
					@include('properties._show-rates')
				</div>
				@endif
				@endif
				<div class="clearfix"></div>
				
				<div class="comment-3">
					<div class="grid2-heading">
						<h3>Reviews</h3>
					</div>
					<ul>
						<li>
							<div class="comment3-dec">
								<div class="thumb">
									<img src="{{asset('resources/assets/extra-images/comment-3-1.jpg')}}" alt="">
									<div class="thumb-dec">
										<a href="#">Jonathan</a>
										<p>69 Reviews</p>
									</div>
								</div>
								<div class="text-wrap">
									<div class="text">
										<h4><a href="#">“Lorem Porem Ipsum”</a></h4>
										<div class="rating">
											<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
										</div>
										<p>
											Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora 
											torquent per conubia per nostra per inceptos himenaeos. Mauris in erat justo. 
											Nullam ac urna eu felis dapibus.
										</p>
										<div class="text-footer">
											<span class="more more-1">more</span>
											<div class="more-div more-div-1">
												<p>Lorem poem ipsum dolor ?
													<a href="#">07 liked this<i class="fa fa-thumbs-o-up"></i></a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						</li>
						<li>
							
							<div class="comment3-dec">
								<div class="thumb">
								
									<img src="{{asset('resources/assets/extra-images/comment-3-1.jpg')}}" alt="">
									<div class="thumb-dec">
										<a href="#">Jonathan</a>
										<p>69 Reviews</p>
									</div>
								</div>
								<div class="text-wrap">
									<div class="text">
										<h4><a href="#">"Lorem Porem Ipsum”</a></h4>
										<div class="rating">
											<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
										</div>
										<p>
											Sed non mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad 
											litora torquent per conubia per nostra per inceptos himenaeos. Mauris in erat justo. 
											Nullam ac urna eu felis dapibus.
										</p>
										<div class="text-footer">
											<span class="more more-2">more</span>
											<div class="more-div more-div-2">
												<p>Lorem poem ipsum dolor ?
													<a href="#">07 liked this<i class="fa fa-thumbs-o-up"></i></a>
												</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						
						</li>
					</ul>
				</div>
				
				
			</div>
			<!-- Right Column :: Property Detail -->
			<div class="col-md-4 col-sm-4 col-xs-12 booking-form">
				
				@if($property->is_vacation=='1')
					@include('properties._show-booking-calendar')
				@endif
				
				@if($property->is_sale=='1')
					@include('properties._show-send-buying-offer')
				@endif
				
				<br/>
				<br/>
				
				<div class="row">
					<h3>Admin Reviews</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						{!!$property->reviews!!}
					</div>
				</div>
				<br/>
				@if($property->is_vacation=='1')
				@if($settings->is_rental_policies==1)
				<div class="row">
					<h3>Rental Policies</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						{!!$settings->rental_policies!!}
					</div>
				</div>
				@endif
				@endif

				@if($property->is_sale=='1')
				@if($settings->is_sale_policies==1)
				<div class="row">
					<h3>Sale Policies</h3>
				</div>
				<div class="row">
					<div class="col-md-12">
						{!!$settings->sale_policies!!}
					</div>
				</div>
				@endif
				@endif
			</div>
		</div>
			<!-- /.row -->
			<!-- Map of proerty -->
			<div class="row">
				<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
					src="http://maps.google.com/maps?q={{$property->latitude}},{{$property->longitude}}&z=15&output=embed">
				</iframe>
			</div>
	</div>
	
</section>	
<!-- /.container -->
<script>
   $(document).ready(function() {
   
       var $lineitems = [];
       @foreach($lineitems as $lineitem)
       $lineitems.push({
           id: "{{$lineitem->id}}",
           title: "{{$lineitem->title}}",
           slug: "{{$lineitem->slug}}",
           is_required: "{{$lineitem->is_required}}",
           value_type: "{{$lineitem->value_type}}",
           apply_on: "{{$lineitem->apply_on}}",
           value: "{{$lineitem->value}}"
       });
       @endforeach
   
       var calendar = new PropertyCalendar("{{url()}}", "{{$property->slug}}", "NA", 'NA');
       <?php
      $pre_select_date_start = (null!==\Session::get('dates_searched')) ? min(\Session::get('dates_searched')):'NA';
      $pre_select_date_end = (null!==\Session::get('dates_searched')) ? max(\Session::get('dates_searched')):'NA';
      $year = ($pre_select_date_start!='NA')?date('Y',strtotime($pre_select_date_start)):date('Y',strtotime('+2 days')); 
      $month = ($pre_select_date_start!='NA')?date('n',strtotime($pre_select_date_start)):date('n',strtotime('+2 days')); 
      ?>
   
       window.onload = calendar.loadCalendar("{{$year}}", "{{$month}}", "{{$pre_select_date_start}}", "{{$pre_select_date_end}}");
   
       $(document).on('click', '.calendar-navigate', function() {
           var $year = $(this).data("year");
           var $month = $(this).data("month");
           calendar.loadCalendar($year, $month);
       });
   
       <?php if('NA'!==$pre_select_date_start and 'NA'!==$pre_select_date_end ){ ?>
         calendar.preBookingMessage("{{$pre_select_date_start}}", "{{$pre_select_date_end}}");
         calendar.calculatePrice("{{$pre_select_date_start}}", "{{$pre_select_date_end}}");
       <?php } ?>
   
       window.lastClickCycleID = 0;
       window.lastClickedDateValue = 0;
   
       $(document).on('click', '.date-available', function() {
           var $id = $(this).data("cycle");
           var $date = $(this).data("date");
           calendar.selectDates($id, $date, window.lastClickCycleID, window.lastClickedDateValue);
           calendar.saveDatesSearchedToSession($date, window.lastClickedDateValue);
           calendar.preBookingMessage($date, window.lastClickedDateValue);
           calendar.calculatePrice($date, window.lastClickedDateValue);        
           window.lastClickCycleID = $id;
           window.lastClickedDateValue = $date;
       });
   });
   
</script>
<script src="{{asset('js/reservations.js')}}"></script>
@endsection
