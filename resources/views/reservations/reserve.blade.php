<!-- 
1. Reserving a property
2. Showing preview image of property
3. Showing calculations of reservation total amount
4. Filling out customer detail form 
-->
@extends('layouts.default.start')
@section('title')
Reserve | {{$property->title}} - {{$settings->site_title}}
@endsection
@section('contents')
<link rel="stylesheet" href="http://fontawesome.io/assets/font-awesome/css/font-awesome.css" />
<style>
.utl-home-banner figure::before, .utl-room-grid figure::before, .utl-content-des .thumb figure::before, .utl-tab-services-wrap::before, .news-letter-bg::after, .utl-testimonial-bg::before, .blog-detail-thumb figure a::before, .about_autor::before, .related-post figure::before, .inner-banner::before, .hotel-masonery-thumb::before, .utl-popular-post ul li::before, footer::before {
  bottom: 0;
  content: "";
  left: 0;
  position: absolute;
  right: 0;
  top: 0;
}
.set-the { margin-bottom: 15px; margin-top: 10px;}
.checkbox input[type="checkbox"]:checked + label::after {
  content: "";
  font-family: "FontAwesome";
}
.btn-shrt { border-radius: 0!important; padding: 6px !important;}
  .breadcrumbs-area {
    background-image: url('{{asset($property->images->first()->image)}}');
	background-position:center center;
}
.form-horizontal .control-label { text-align: left;}
.set-form-layout input[type="text"], input[type="email"], input[type="password"] { margin-bottom: 0;}
.set-form-layout .btn.btn-primary { margin: 15px 0 0;}
.update-addons-total{ line-height:10px;}
.update-reservation-price{ height:30px !important; }
.col-sm-12.col-xs-12.checkbox {
  border-color: #cccccc;
  border-style: solid;
  border-width: 1px 0 0;
  line-height: 46px;
  margin: 0 15px;
  padding-top: 0;
}
.col-sm-12.col-xs-12.checkbox >.control-label { padding-top:0; }
.row.tax-form {
  margin-top: 20px;
}
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
	<?php /*<div class="utl-home-banner inner-banner">
		<div class="container">
			<h3>Booking - {{ $property->title }} </h3>
			<span><i class="icon-hotel"></i></span>
			<ul class="breadcrumb">
				<li><a href="{{url()}}">Home</a></li>
				<li><a href="properties.php">Booking</a></li>
				<li class="active"><a href="properties.php"> {{ $property->title }} </a></li>
			</ul>
		</div>
	</div>*/ ?>

	<div class="properties-details-area pt-115 pb-60">
		<div class="container">
			<!-- Page Heading/Breadcrumbs -->
			@include('include.alerts')

			<!-- /.row -->
			<!-- Property Brief Information -->
			  <div class="row">
					<form class="form-horizontal pull-top-70" role="form" method="post" action="{{url('reserve')}}/{{$property->slug}}/{{date('Y-m-d',strtotime($date_start))}}/{{date('Y-m-d',strtotime($date_end))}}/store">
						<div class="col-md-8 col-sm-8 pull-top-7" >
							<div class="row">
								<div class="col-md-4 col-sm-4 col-xs-12">
									<div id="propertyMainImage"> 
										<img class="img-responsive" src="{{asset($property->images->first()->image)}}" alt="{!!$property->title!!}" > 
									</div>
									<div class="row hidden">
										<div class="col-md-6 info-cell">
											<i class="fa fa-bed"></i> Bedrooms 
											<div class="pull-right">
												{{ $property->bedrooms }}
											</div>
										</div>
										<div class="col-md-6 info-cell">
											<i class="fa fa-bath"></i> Baths
											<div class="pull-right">
												{{ $property->bathrooms }}
											</div>
										</div>
										<div class="col-md-6 info-cell">
											<i class="fa fa-user"></i> Sleeps
											<div class="pull-right">
												{{ $property->sleeps }}
											</div>
										</div>
										<div class="col-md-6 info-cell">
											<i class="fa fa-car"></i> Garages
											<div class="pull-right">
												{{ $property->garages }}
											</div>
										</div>
										<div class="info-cell"> 
											<div class="col-md-12">
												@foreach($property->classez as $class)
													<i class="glyphicon glyphicon-ok"></i>
													{{$class->theclass->title}}
												@endforeach
											</div>
										</div>
									</div>
									<!--nav>
										<ul class="pager">
											<li><a href="{{url('show/'.$property->slug)}}"><span aria-hidden="true">&larr;</span> Property Detail</a></li>
										</ul>
									</nav-->
								</div>
								<div class="col-md-8 col-sm-8 col-xs-12" >
									<div class="row">
										<h3>Booking Details</h3>
										<table class="table table-striped">
											<tbody class="design-set">
												<tr>
													<td>Date of Arrival</td>
													<td>{{ ($date_start) }}</td>
												</tr>
												<tr>
													<td>Date of Departue</td>
													<td>{{ ($date_end) }}</td>
												</tr>
												<tr>
													<td>Lodging Amount</td>
													<td>@if(is_numeric($lodging_amount)) ${{number_format($lodging_amount,2)}} @else 'Error!' @endif</td>
												</tr>
											</tbody>
										</table>
										<input type="hidden" id="calculated-lodging-price" value="@if(is_numeric($lodging_amount)){{$lodging_amount}}@endif" />
									</div>
								</div>
								<div class="col-md-12" style="margin-top:30px;">
									<h3 style="margin-bottom:20px;">Addon Services</h3>
									<div class="addons">
										@foreach ($addons as $addon)
										<div class="col-sm-12 col-xs-12" style="border-bottom: 1px solid #ccc; padding: 15px 0;">
											<div class="col-sm-3 col-xs-3" style="padding-left:0;">
												<img data-toggle="modal" data-target="#addonModal-{{$addon->id}}" class="img-responsive" src="{{asset($addon->image)}}" alt="{!!$addon->title!!}" > 
											</div>

											<div class="col-sm-9 col-xs-9">
												<strong>{!!$addon->title!!}</strong> - ${{number_format($addon->price,2)}}
												<input type="hidden" id="addon-price-{{$addon->id}}" value="{{number_format($addon->price,2)}}" />
												<input type="hidden" id="addon-price-total-{{$addon->id}}" class="addon-total" />
												<div class="pull-right">
													{!!$addon->summary!!}
												</div>				

												<!-- Trigger the modal with a button -->
												<!-- Modal -->
												<div id="addonModal-{{$addon->id}}" class="modal fade" role="dialog">
													<div class="modal-dialog">
														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close" data-dismiss="modal">&times;</button>
																<h4 class="modal-title">{!!$addon->title!!}</h4>
															</div>
															<div class="modal-body">
																<div class="row">
																	<div class="col-md-6">
																		{!!$addon->description!!}
																		Price per Unit: ${{number_format($addon->price,2)}}
																	</div>
																	<div class="col-md-6">
																		<img class="img-responsive img-rounded image-200" src="{{asset($addon->image)}}" alt="{!!$addon->title!!}" >
																	</div>
																</div>
															</div>
															<div class="modal-footer">
																<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
															</div>
														</div>
													</div>
												</div>

												<div class="row" style="margin-top:15px;">
													<div class="col-sm-1 col-xs-3 control-label">
														Qty: 
													</div>
													<div class="col-sm-3 col-xs-6 set-the">
														<div class="input-group">
															<span class="input-group-btn">
																<button type="button" class="btn-shrt btn btn-default btn-number update-addons-total update-reservation-price" data-type="minus" data-field="quantity_{{$addon->id}}" data-id="{{$addon->id}}" />
																	<span class="glyphicon glyphicon-minus"></span>
																</button>
															</span>
															<input type="text" id="addon-quantity-{{$addon->id}}" name="quantity_{{$addon->id}}" class="form-control input-number update-addons-total update-reservation-price" value="0" min="0" max="999" data-id="{{$addon->id}}" />
															<span class="input-group-btn">
																<button type="button" class="btn-shrt btn btn-default btn-number update-addons-total update-reservation-price" data-type="plus" data-field="quantity_{{$addon->id}}" data-id="{{$addon->id}}" />
																	<span class="glyphicon glyphicon-plus"></span>
																</button>
															</span>
														</div>
													</div>
												</div>
												<a href="#" class="btn btn-info btn-xs pull-left" data-toggle="modal" data-target="#addonModal-{{$addon->id}}">View Detail</a>
											</div>
										</div>
									  @endforeach
									</div>
									<div class="dl-horizontal">
										<input type="hidden" id="calculated-addons-price" />
										<p class="pull-right" style="margin:15px 0; padding-bottom:13px;  border-bottom:1px solid #ccc; text-align:right; width:100%"> <b>Addons Total</b> $<span id="calculated-addons-price-html">0.00</span></p>
									</div>

									<script type="text/javascript">
										$('.btn-number').click(function(e){
											e.preventDefault();
											fieldName = $(this).attr('data-field');
											type      = $(this).attr('data-type');
											var input = $("input[name='"+fieldName+"']");
											var currentVal = parseInt(input.val());
											if (!isNaN(currentVal)) {
												if(type == 'minus') {
													if(currentVal > input.attr('min')) {
														input.val(currentVal - 1).change();
													} 
													if(parseInt(input.val()) == input.attr('min')) {
														  //$(this).attr('disabled', true);
														  //i disabled it because it should continue addons price calculation
													}

												}else if(type == 'plus') {

													if(currentVal < input.attr('max')) {
														  input.val(currentVal + 1).change();
													}
													if(parseInt(input.val()) == input.attr('max')) {
														  //$(this).attr('disabled', true);
														  //i disabled it because it should continue addons price calculation
													}

												}
											}else {
													input.val(0);
											}

										});
										$('.input-number').focusin(function(){
											$(this).data('oldValue', $(this).val());
										});
										$('.input-number').change(function() {
											minValue =  parseInt($(this).attr('min'));
											maxValue =  parseInt($(this).attr('max'));
											valueCurrent = parseInt($(this).val());
											  
											name = $(this).attr('name');
											if(valueCurrent >= minValue) {
												$(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
											}else {
												alert('Sorry, the minimum value was reached');
												$(this).val($(this).data('oldValue'));
											}
											if(valueCurrent <= maxValue) {
												$(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
											}else {
													alert('Sorry, the maximum value was reached');
													$(this).val($(this).data('oldValue'));
											}
											  
										});
										  $(".input-number").keydown(function (e) {
												  // Allow: backspace, delete, tab, escape, enter and .
												  if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
													   // Allow: Ctrl+A
													  (e.keyCode == 65 && e.ctrlKey === true) || 
													   // Allow: home, end, left, right
													  (e.keyCode >= 35 && e.keyCode <= 39)) {
														   // let it happen, don't do anything
														   return;
												  }
												  // Ensure that it is a number and stop the keypress
												  if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
													  e.preventDefault();
												  }
											  });

										$(document).on('click keyup', '.update-addons-total', function() {

											fieldID = $(this).attr('data-id');
											price = $("#addon-price-"+fieldID).val()*1;
											quantity = $("#addon-quantity-"+fieldID).val()*1;
											total = price * quantity;
											$("#addon-price-total-"+fieldID).val(total);

												var addonsGrandTotal = 0;
												$(".addon-total").each(function(){
													addonsGrandTotal += +$(this).val();
												});
												addonsGrandTotal = addonsGrandTotal.toFixed(2);
												$("#calculated-addons-price").val(addonsGrandTotal);
												$("#calculated-addons-price-html").html(addonsGrandTotal);
										});

									</script>
								</div>
							</div>
							<div class="row tax-form" style="overflow: hidden; width: 770px;">
								<div class="col-md-12">
									<h3>Taxes &amp; Add Ons</h3>
									<div class="form-group">
									  @foreach ($lineitems as $lineitem)
									  <div class="col-sm-12 col-xs-12 checkbox">
										@if ($lineitem->is_required == '1')
										<div class="col-sm-4 col-xs-4 control-label">
										  {!!$lineitem->title!!}
										</div>
										<div class="col-sm-3 col-xs-3"> <small>required</small> 
										</div>
										<div class="col-sm-5 col-xs-5">@if ($lineitem->value_type == "fixed")
										  ${{number_format($lineitem->value,2)}}
										  @endif
										  @if ($lineitem->value_type == "percentage")
										  {{$lineitem->value}}%
										  @endif
										</div>
										@else
										<div class="col-sm-4 col-xs-4 control-label">
										  {!!$lineitem->title!!}
										</div>
										<div class="col-sm-3 col-xs-3">
										<label for="lineitem-{{$lineitem->id}}" style="opacity:0"></label>
										  <input name="{!!$lineitem->slug!!}" type="checkbox" id="lineitem-{{$lineitem->id}}" 
											class="update-reservation-price" style="opacity:1;margin-top:8px !important;outline:none;" > 
										  Add 
										</div>
										<div class="col-sm-5 col-xs-5">
										  @if ($lineitem->value_type == "fixed")
										  ${{number_format($lineitem->value,2)}}
										  @endif
										  @if ($lineitem->value_type == "percentage")
										  {{$lineitem->value}}%
										  @endif
										</div>
										@endif
									  </div>
									  @endforeach
									</div>
									<textarea style="display:none" id="sub-total-detail" name="sub_total_detail">@if(is_numeric($lodging_amount)){{$lodging_amount}}@endif</textarea>
									<div class="row dl-horizontal text-right">
										<div class="col-md-7"><h3></h3></div>
										<div class="col-md-5"><h3>Total Amount:  $<span id="calculated-total-amount">Can not proceed!</span></h3></div>
									</div>
								</div>
							</div>
						</div>
					<div class="col-md-4 col-sm-4 col-xs-12">
						<aside class="widget widget-featured-property">
							<h5>Contact Details</h5>
						
							<div class="set-form-layout">
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">First Name<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="firstname" type="text" value="@if(old('firstname')){!! old('firstname') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">Last Name<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="lastname" type="text" value="@if(old('lastname')){!! old('lastname') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">Email<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="email" type="text" value="@if(old('email')){!! old('email') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">Phone<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="phone" type="text" value="@if(old('phone')){!! old('phone') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">City<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="city" type="text" value="@if(old('city')){!! old('city') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">State<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<select name="state" class="form-control"  >
											<option value="" @if (!old('state') or old('state') == '') {{ 'selected="selected"' }} @endif > - select - </option>
											@foreach ($states as $state)
											<option value="{{ $state->id }}"
											@if (old('state') == $state->id) {!!'selected="selected"'!!}@endif
											>{!!$state->title!!}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-12 col-xs-12 control-label">Zip<font color="#FF0000">*</font></label>
									<div class="col-sm-12 col-xs-12">
										<input name="zip" type="text" value="@if(old('zip')){!! old('zip') !!}@endif" class="form-control"  />
									</div>
								</div>
								<div class="form-group text-right">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
									<div class="col-md-12">	
										<button type="submit" class="btn btn-primary"> 
											Payment <span class="glyphicon glyphicon-chevron-right"></span> 
										</button>
									</div>
								</div>
							</div>
						</aside>
					</div>
				</form>
			  </div>
		</div>
	</div>
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
  
      var calendar = new PropertyCalendar("{{url()}}", "{{$property->slug}}", "NA", $lineitems);
      <?php
      $pre_select_date_start = (null!==\Session::get('dates_searched')) ? min(\Session::get('dates_searched')):'NA';
      $pre_select_date_end = (null!==\Session::get('dates_searched')) ? max(\Session::get('dates_searched')):'NA';
      $year = ($pre_select_date_start!='NA')?date('Y',strtotime($pre_select_date_start)):date('Y',strtotime('+2 days')); 
      $month = ($pre_select_date_start!='NA')?date('n',strtotime($pre_select_date_start)):date('n',strtotime('+2 days'));
      ?> 
  
      window.onload = calendar.AddRemoveLineItems();
  
      $(document).on('click keyup', '.update-reservation-price', function() {
          calendar.AddRemoveLineItems();
      });
  
  
  });
  
</script>
<script src="{{asset('js/reservations.js')}}"></script>
@endsection
