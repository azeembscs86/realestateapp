<!-- Show the main description of property from database -->

<div class="detail-text detail-fact">
	<div class="grid2-heading">
		<h3>Description</h3>
	</div>
	<div class="text-dec">
		<div class="text">
			{!!$property->description!!}
		</div>
		<div class="retail-thumb">
			<div class="rating">
				<span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
			</div>
			<h5><a href="#">(09) Reviews</a></h5>
			<div class="style-wrap"><i class="style-4"></i></div>
			<h4>Starts From</h4>
			<span class="rate">
				<sup>$</sup>
				269
			</span>
		</div>
	</div>
</div>
	<div class="detail-fact">
		<h3 class="set-title">Admin Reviews</h3>
	
		<div class="col-md-12 txt-set">
			{!!$property->reviews!!}
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	@if($property->is_vacation=='1')
	@if($settings->is_rental_policies==1)
	<div class="detail-fact">
		<h3 class="set-title">Rental Policies</h3>
		<div class="col-md-12 txt-set">
			{!!$settings->rental_policies!!}
		</div>
	</div>
		
	<div class="clearfix"></div>

	@endif
	@endif
	
	@if($property->is_sale=='1')
	@if($settings->is_sale_policies==1)
	<div class="detail-fact">
		<h3 class="set-title">Sale Policies</h3>
		<div class="col-md-12 txt-set">
			{!!$settings->sale_policies!!}
		</div>
	</div>
	
	<div class="clearfix"></div>
	
	@endif
	@endif
	
	

<div class="clearfix"></div>

<!-- Show amenities assigned to this property -->
<div class="row">
	<div class="detail-fact">	
		<h3 class="set-title">Amenities</h3>
		<div class="own-set">
			@foreach ($amenities as $amenity)
			@if($amenity->added->first()->value=='Yes')
				<div class="col-md-3 col-sm-4 col-xs-6">
					<div class="fac-thumb">
						<img src="{{asset('resources/assets/extra-images/dac-1.jpg')}}" alt="">
						<div class="fac-dec">
							<span class="icon-food-1"></span>
							<h6><a href="javascript:void(0);" class="text-a-center p-0">{{$amenity->title}}</a></h6>
						</div>
					</div>
				</div>
			@endif
			@endforeach
		</div>
	</div>
</div>
<!-- Show features assigned to this property -->

<div class="clearfix"></div>


<div class="row">
	<div class="detail-fact">	
		<h3>Features</h3>
		<ul class="features">
			@foreach ($features as $feature)
			@if($feature->added->first()->value!='' and $feature->added->first()->value!='0')
			<li class="col-md-4">
				{{$feature->title}}
				<span class="pull-right">
					<strong>
						{{$feature->added->first()->value}}
					</strong>
				</span>
			</li>
			@endif
			@endforeach
		</ul>
		<hr />
	</div>
</div>



