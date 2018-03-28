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
<div class="clearfix"></div>
<section class="page-detail-2">
	<div class="container">
		@include('include.alerts')
		<!-- /.row -->
		<!-- Property Detail -->
		<div class="row">
			<!-- Left/Middle Column :: Property Images/Description/Amenities/Features/Rates/Map -->
			<div class="col-md-8 col-sm-7 col-xs-12 property-description">
			
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
			<div class="col-md-4 col-sm-5 col-xs-12 booking-form">
				
				<div class="tags">
					<div class="servic2">
						<span class="icon-interface"></span>
						<div class="text text-a-center">
							<a href="javascript:void(0);" class="small-btn" id="tgl">Book Now</a>
						</div>
					</div>
					
					@if($property->is_vacation=='1')
					@include('properties._show-booking-calendar')
						@endif
						
						@if($property->is_sale=='1')
							@include('properties._show-send-buying-offer')
						@endif
						
					
					<div class="reservation2 checkbox-detail">
						<h6><span>Food Options</span></h6>
						<div class="clearfix"></div>
						<div class="p-15">
							<div class="checkbox check-img m-b-20">
								<input id="drop-remove1" type="checkbox">
								<label for="drop-remove1"> 
									<img class="img-circle   m-r-10" width="50px" src="{{asset('resources/assets/extra-images/sandwich.jpg')}}"/> Sandwich
								</label>
							</div>
				  
							<div class="checkbox check-img m-b-20">
								<input id="drop-remove2" type="checkbox">
								<label for="drop-remove2">
									<img class="img-circle m-r-10" width="50px" src="{{asset('resources/assets/extra-images/pizza.jpg')}}"/>  Pizza
								</label>
							</div>
							<div class="checkbox m-b-20">
								<input id="drop-remove3" type="checkbox">
								<label for="drop-remove3">
									We Pick a variety for you each day
								</label>
							</div>
							<div class="checkbox">
								<input id="drop-remove4" type="checkbox">
								<label for="drop-remove4">
									Handling food on our own
								</label>
							</div>
						</div>
					</div>
					
					
					<div class="contact-tag">
						<span class=" icon-telephone"></span>
						<div class="text">
							<h6>Need Help?<span> Call us</span></h6>
							<h5>+91 123-234-8545</h5>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /.row -->
	</div>
</section>	
	<!-- Map of proerty -->
	<div class="row-fluid">
		<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
			src="http://maps.google.com/maps?q={{$property->latitude}},{{$property->longitude}}&z=15&output=embed">
		</iframe>
	</div>

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
