<!-- Search Result Items: Included as partial file on search page. -->
	<?php
		$filter_keys = '"all", ';
		foreach( $property->classez as $class ) { $filter_keys .= '"'.$class->theclass->slug . '", '; }
   ?>
   
   
	<div class="col-md-4 col-sm-6" data-groups='[<?php echo rtrim($filter_keys,', '); ?>]'>
		<div class="utl-our-room">
		
			<figure>
				<img class="img-responsive img-hover" src="{{asset(@$property->images->first()->image_small)}}" alt="{{@$property->title}}">
				<figcaption>
					<a rel="prettyPhoto[gallery2]" href="{{asset(@$property->images->first()->image_small)}}">
						<i class="fa fa-search"></i>
					</a>
				</figcaption>
			</figure>
			
			<div class="text">
				<h5>{{$property->title}} </h5>
				<p>
					{!!$property->summary!!}
				</p>
				<div class="hidden">
					@foreach($property->amenities as $amenity)
					@if($amenity->value=='Yes')
						<div class="col-md-6"><i class="fa fa-check"></i>&nbsp;{{$amenity->amenity->title}}&nbsp;&nbsp;</div>
					@endif
					@endforeach
				</div>
				<div class="retail room-grid-retail">
					<p><i class="fa fa-map-marker"></i> {{$property->city}}, {{$property->zip}}, {{@$property->location->title}}</p>
				</div>					
			
				<center>		
					<a class="btn-3" href="{{url('show/'.$property->slug)}}">View Details</a>
				</center>
			</div>
			
		</div>
	</div>
