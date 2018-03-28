<!-- Search Result Items: Included as partial file on search page. -->



				<?php
				   $filter_keys = '"all", ';
				   foreach( $property->classez as $class ) { $filter_keys .= '"'.$class->theclass->slug . '", '; }
				   ?>
   
   
				<div class="col-md-4 col-sm-6 col-xs-12">
					<div class="flat-item">
					   <div class="flat-item-image">
					   @if($property->is_featured=='1')
						  <span class="for-sale">Featured</span>
					   @endif	  
						@if($property->is_sold=='1')
<span class="for-sale sold"><img class="img-responsive" src="{{asset('pictures/puppy-sold-new.png')}}" alt="Sold"></span> 
@endif
						  @if(isset($property->images->first()->image))
						<img class="img-responsive b-lazy {{$property->images->first()->image_class}}" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($property->images->first()->image)}}" alt="{{$property->title}}">
						@else
						<img class="img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">
						@endif
						  <div class="flat-link"> 
						  <a href="{{url('show/'.$property->slug)}}">More Details</a>     
						  </div>
						  <ul class="flat-desc">
							 <li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/4.png') }}" alt=""><span>{{$property->area ? $property->area : '0'}}</span></li>
							 <li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/5.png') }}" alt=""><span>{{$property->bedrooms}}</span></li>
							 <li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/6.png') }}" alt=""><span>{{$property->bathrooms}}</span> </li>
						  </ul>
					   </div>
					   <div class="flat-item-info">
							<div class="flat-title-price">
								<h5><a href="#">{{$property->title}} </a></h5>
									<span class="price">
											
											@if($property->is_sale=='1')
											${{$property->sale_price}}
											
											@endif
									</span>                                        
							</div>
							<p><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/location.png') }}" alt="">{{$property->city}}, {{$property->zip}}, {{@$property->location->title}}</p>
					   </div>
					</div>
				 </div>
			