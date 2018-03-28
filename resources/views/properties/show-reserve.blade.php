<!-- This view file shows the detailed information of a property the user landed in -->
@extends('layouts.default.start')
<!-- Goes to html>head>title -->
@section('title')
{{$property->title}} - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<!-- Page Content -->
<style type="text/css">
.page-header-bg:before {
	background-image: url('{{asset($property->images->first()->image)}}');
}
</style>
	<div class="breadcrumbs-area bread-bg-3 bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">{!!$property->title!!}</h2>  
						<ul class="breadcrumbs-list">           				
							<li><a href="{{url()}}">Home</a></li>
							<li><a href="{{url('types/')}}">Properties</a></li>
							<li class="active">
							   {!!$property->title!!}
							</li>      
						</ul>                  
					</div>         
				</div>         
			</div>            
		</div>        
	</div>
	
	<div class="cleafix"></div>
	
	<div class="find-home-area bg-blue call-to-bg plr-140 pt-60 pb-20">
        <div class="container-fluid">
            <div class="row">
				<div class="col-md-3 col-xs-12">
					<div class="section-title text-white">
                       <h3>FIND YOUR</h3>
                       <h2 class="h1">HOME HERE</h2>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="find-homes">
                        <div class="row">
							<div class="col-sm-3 col-xs-12">
								<div class="find-home-item custom-select">
									<select class="selectpicker" title="Town / Province" data-hide-disabled="true" data-live-search="true">
										<optgroup disabled="disabled" label="disabled">
											<option>Town</option>
										</optgroup>
										<optgroup label="Town">
											<option>Town</option>
										</optgroup>
                                    </select>
								</div>
							</div>
							<div class="col-sm-3 col-xs-12">
                                <div class="find-home-item">
									<input type="number" name="quantity" placeholder="Min Price" min="1" max="100" class="form-control">
                                </div>
							</div>
						    <div class="col-sm-3 col-xs-12">
                                <div class="find-home-item">
									<input type="number" name="quantity" placeholder="Max Price" min="100" max="1000" class="form-control">
                                </div>
							</div>
                            <div class="col-sm-3 col-xs-12">
								<div class="find-home-item  custom-select">
									<select class="selectpicker" title="Bed" data-hide-disabled="true">
                                       <option>2 Beds</option>
                                       <option>3 Beds</option>
                                       <option>4 Beds</option>
                                       <option>5 Beds</option>
									</select>
								</div>
							</div>
						    <div class="clearfix"></div>
							<div class="col-sm-3 col-xs-12">
								<div class="find-home-item custom-select">
									<select class="selectpicker" title="Baths" data-hide-disabled="true">
										<option>1 Bath</option>
										<option>2 Baths</option>
										<option>3 Baths</option>
										<option>4 Baths</option>
										<option>5 Baths</option>
									</select>
								</div>
							</div>
                        
							<div class="col-sm-3 col-xs-12">
								<div class="find-home-item  custom-select">
									<select class="selectpicker" title="Property Type" data-hide-disabled="true">
										<option label="Featured">Featured</option>
										<option>Featured</option>                                      
                                    </select>
								</div>
							</div>
                          
							<div class="col-sm-3 col-xs-12">
								<div class="find-home-item mb-0-xs">  
									<a class="button-1 btn-block btn-hover-1" href="#">SEARCH</a>       
								</div>
							</div>
						    
							<div class="col-sm-3 col-xs-12">
								<div class="find-home-item mb-0-xs">  
									<a class="more-filter" href="#">MORE FILTERS <i class="fa fa-plus"></i></a>       
								</div>
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                
              
    <div class="search-home">
		<div class="container">
			<div class="row"> 
				<div class="col-md-6 search-drop">
					<div class="row">	 
						<div class="col-md-12">	
							<div class="row"> 
								<fieldset class="my-field-set">
									<legend class="my-legend">Lifestyle Category</legend>
									<ul class="submenu lifestyle pull-left">
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG1" id="checkboxG1" class="css-checkbox"/>
												<label for="checkboxG1" class="css-label "> 55+/Retirement Community</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG2" id="checkboxG2" class="css-checkbox"/>
												<label for="checkboxG2" class="css-label "> Boating</label>
											</a>
										</li>     
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG3" id="checkboxG3" class="css-checkbox"/>
												<label for="checkboxG3" class="css-label "> Equestrian/Polo</label>
											</a>
										</li>     
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG4" id="checkboxG4" class="css-checkbox"/>
												<label for="checkboxG4" class="css-label "> Golfing</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG5" id="checkboxG5" class="css-checkbox"/>
												<label for="checkboxG5" class="css-label "> Lakefront</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG6" id="checkboxG6" class="css-checkbox"/>
												<label for="checkboxG6" class="css-label "> Waterfront</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG7" id="checkboxG7" class="css-checkbox"/>
												<label for="checkboxG7" class="css-label "> Island Living</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG8" id="checkboxG8" class="css-checkbox"/>
												<label for="checkboxG8" class="css-label "> Riverfront</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG9" id="checkboxG9" class="css-checkbox"/>
												<label for="checkboxG9" class="css-label "> University/College town</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG10" id="checkboxG10" class="css-checkbox"/>
												<label for="checkboxG10" class="css-label "> Yacht Club</label>
											</a>
										</li>     
									</ul>
									<ul class="submenu pull-left"><li>
											<a href="#">
												<input type="checkbox" name="checkboxG11" id="checkboxG11" class="css-checkbox"/>
												<label for="checkboxG11" class="css-label "> Aquatic Activities</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG12" id="checkboxG12" class="css-checkbox"/>
												<label for="checkboxG12" class="css-label "> Mountain</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG13" id="checkboxG13" class="css-checkbox"/>
												<label for="checkboxG13" class="css-label "> Casino</label>
											</a>
										</li>  
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG14" id="checkboxG14" class="css-checkbox"/>
												<label for="checkboxG14" class="css-label "> Fishing</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG15" id="checkboxG15" class="css-checkbox"/>
												<label for="checkboxG15" class="css-label "> Mountain Living</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG16" id="checkboxG16" class="css-checkbox"/>
												<label for="checkboxG16" class="css-label "> Green/Eco Friendly Living</label>
											</a>
										</li> 
												<li>
											<a href="#">
												<input type="checkbox" name="checkboxG17" id="checkboxG17" class="css-checkbox"/>
												<label for="checkboxG17" class="css-label "> Metropolitan</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG18" id="checkboxG18" class="css-checkbox"/>
												<label for="checkboxG18" class="css-label "> Privacy</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG19" id="checkboxG19" class="css-checkbox"/>
												<label for="checkboxG19" class="css-label "> Skiing</label>
											</a>
										</li> 							    										
								
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG20" id="checkboxG20" class="css-checkbox"/>
												<label for="checkboxG20" class="css-label "> Bay/Beach Club</label>
											</a>
										</li> 
										
									</ul>
									<ul class="submenu pull-right">
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG21" id="checkboxG21" class="css-checkbox"/>
												<label for="checkboxG21" class="css-label "> Country Club</label>
											</a>
										</li>     
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG22" id="checkboxG22" class="css-checkbox"/>
												<label for="checkboxG22" class="css-label "> Fly-In</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG23" id="checkboxG23" class="css-checkbox"/>
												<label for="checkboxG23" class="css-label "> Investment Property</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG24" id="checkboxG24" class="css-checkbox"/>
												<label for="checkboxG24" class="css-label "> Historic</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG25" id="checkboxG25" class="css-checkbox"/>
												<label for="checkboxG25" class="css-label "> Ranch/Farm/Plantation</label>
											</a>
										</li>     <li>
											<a href="#">
												<input type="checkbox" name="checkboxG26" id="checkboxG26" class="css-checkbox"/>
												<label for="checkboxG26" class="css-label "> Waterview</label>
											</a>
										</li>     												
									</ul>
								</fieldset>
							</div>  
						</div>
						<div class="col-md-12 search-drop">
							<div class="row"> 
								<fieldset class="my-field-set p-b-7">
									<legend class="my-legend">Distance</legend>
									<div class="price_filter p-b-15">
										<div class="price_slider_amount">           
											<input type="submit"  value="Distance :"/>     
											<input type="text" id="amount2" name="price"  placeholder="Add Your Price" />                                                             </div>
										<div id="slider-range2"></div>
									</div>   
										  
									<ul class="submenu pull-left distance-list">
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG111" id="checkboxG111" class="css-checkbox"/>
												<label for="checkboxG111" class="css-label "> Airport</label>
											</a>
										</li> 

										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG333" id="checkboxG333" class="css-checkbox"/>
												<label for="checkboxG333" class="css-label "> Movie Theater</label>
											</a>
										</li>     
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG444" id="checkboxG444" class="css-checkbox"/>
												<label for="checkboxG444" class="css-label "> Mosque</label>
											</a>
										</li>  
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG555" id="checkboxG555" class="css-checkbox"/>
												<label for="checkboxG555" class="css-label "> Playground</label>
											</a>
										</li>  
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG666" id="checkboxG666" class="css-checkbox"/>
												<label for="checkboxG666" class="css-label "> Park</label>
											</a>
										</li>   
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG777" id="checkboxG777" class="css-checkbox"/>
												<label for="checkboxG777" class="css-label "> Restaurants</label>
											</a>
										</li>   
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG888" id="checkboxG888" class="css-checkbox"/>
												<label for="checkboxG888" class="css-label "> College/University</label>
											</a>
										</li>   
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG999" id="checkboxG999" class="css-checkbox"/>
												<label for="checkboxG999" class="css-label "> Churches</label>
											</a>
										</li>   
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG88" id="checkboxG88" class="css-checkbox"/>
												<label for="checkboxG88" class="css-label "> Museum</label>
											</a>
										</li>    	
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG100" id="checkboxG100" class="css-checkbox"/>
												<label for="checkboxG100" class="css-label "> Zoo</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG101" id="checkboxG101" class="css-checkbox"/>
												<label for="checkboxG101" class="css-label "> Dog Park</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG102" id="checkboxG102" class="css-checkbox"/>
												<label for="checkboxG102" class="css-label "> Beach</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG103" id="checkboxG103" class="css-checkbox"/>
												<label for="checkboxG103" class="css-label "> Live Theater</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG104" id="checkboxG104" class="css-checkbox"/>
												<label for="checkboxG104" class="css-label "> Synagogue/Temples</label>
											</a>
										</li> 
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG105" id="checkboxG105" class="css-checkbox"/>
												<label for="checkboxG105" class="css-label "> Marina</label>
											</a>
										</li> 		
										<li>
											<a href="#">
												<input type="checkbox" name="checkboxG106" id="checkboxG106" class="css-checkbox"/>
												<label for="checkboxG106" class="css-label "> Recreation Center</label>
											</a>
										</li> 													
									</ul>
								</fieldset>
							</div>
						</div>	
					</div>
				</div>		
				<div class="col-md-6 search-drop">
					<div class="row"> 
						<fieldset class="my-field-set">
							<legend class="my-legend">Features Categories</legend>
							<div class="row">
								<div class="col-md-6">
									<div class="form-custom">
										<label class="custom-label">Country / Province</label>
										<select class="selectpicker" title="Country/Province" data-hide-disabled="true">
											<optgroup  label="Countries">
												<option label="Countries">India</option>
												<option>USA</option>
												<option>UK</option>
												<option>Australia</option>                 
											</optgroup>
										</select>
									</div>
									<div class="form-custom">
										<label class="custom-label">Master Bedroom</label>
										<select class="selectpicker" title="Master Bedroom" data-hide-disabled="true">
											<optgroup  label="Bedroom">
												<option label="Bedroom">1st Floor</option>
												<option>2nd Floor</option>
												<option>3rd Floor</option>
												<option>4th Floor</option>                 
											</optgroup>
										</select>
									</div>
									
									<div class="form-custom">
										<label class="custom-label">Year Built</label>
										<select class="selectpicker" title="Year Built" data-hide-disabled="true">
											<optgroup  label="Year Built">
												<option label="Year Built">2017</option>
												<option>2016</option>
												<option>2015</option>
												<option>2014</option>                 
											</optgroup>
										</select>
									</div>
									
									<div class="form-custom">
										<label class="custom-label">Energy Efficent</label>
										<ul class="submenu pull-left">
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG31" id="checkboxG31" class="css-checkbox"/>
													<label for="checkboxG31" class="css-label "> Geo Thermal Heat</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG32" id="checkboxG32" class="css-checkbox"/>
													<label for="checkboxG32" class="css-label "> Solar Panels</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG33" id="checkboxG33" class="css-checkbox"/>
													<label for="checkboxG33" class="css-label "> Solar Water Heater</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG34" id="checkboxG34" class="css-checkbox"/>
													<label for="checkboxG34" class="css-label "> Windmill</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG35" id="checkboxG35" class="css-checkbox"/>
													<label for="checkboxG35" class="css-label "> Energy Star Appliances</label>
												</a>
											</li> 
										</ul>
									</div>
									<div class="form-custom">
										<label class="custom-label">Garage</label>
										<ul class="submenu pull-left">
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG41" id="checkboxG41" class="css-checkbox"/>
													<label for="checkboxG41" class="css-label "> 1 Car</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG42" id="checkboxG42" class="css-checkbox"/>
													<label for="checkboxG42" class="css-label "> 2 Car</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG43" id="checkboxG43" class="css-checkbox"/>
													<label for="checkboxG43" class="css-label "> 3 Car</label>
												</a>
											</li> 
											<li>
												<a href="#">
													<input type="checkbox" name="checkboxG44" id="checkboxG44" class="css-checkbox"/>
													<label for="checkboxG44" class="css-label "> 4 Car</label>
												</a>
											</li> 
											
										</ul>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-custom">		
										<label class="custom-label">Square Footage</label>
										<div class="price_filter">
											<div class="price_slider_amount">           
												<input type="submit"  value="Area :"/>     
												<input type="text" id="amount1" name="price"  placeholder="Add Your Price" />                                                           
											</div>
											<div id="slider-range1"></div>
										</div>         
									</div>	
									<div class="form-custom">
										<label class="custom-label">Beach Right</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio92" id="radio92" value="option92" checked>
											<label for="radio92"> Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio81" id="radio81" value="option81">
											<label for="radio81"> No </label>
										</div>
									</div>
									<div class="form-custom">
										<label class="custom-label">Staff Accomodation</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio62" id="radio62" value="option62" checked>
											<label for="radio62">Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio71" id="radio1" value="option71">
											<label for="radio71"> No </label>
										</div>
									</div>
									<div class="form-custom">
										<label class="custom-label">Heat Type</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio62" id="radio62" value="option62" checked>
											<label for="radio62"> Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio61" id="radio61" value="option61">
											<label for="radi6o1"> No </label>
										</div>
									</div>
									<div class="form-custom">
										<label class="custom-label">Gated Property</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio52" id="radio52" value="option52" checked>
											<label for="radio52"> Yes </label>
										</div>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio1" id="radio51" value="option51">
											<label for="radio51"> No </label>
										</div>
									</div>
									<div class="form-custom">
										<label class="custom-label">Tennis Court</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio42" id="radio42" value="option42" checked>
											<label for="radio42"> Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio1" id="radio41" value="option41">
											<label for="radio41"> No </label>
										</div>
									</div>

									<div class="form-custom">
										<label class="custom-label">Central Air Conditioning</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio32" id="radio32" value="option32" checked>
											<label for="radio32"> Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio31" id="radio31" value="option31">
											<label for="radio31"> No </label>
										</div>
									</div>

									<div class="form-custom">
										<label class="custom-label">Fireplace</label>
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio22" id="radio22" value="option22" checked>
											<label for="radio22"> Yes </label>
										</div> 
										<div class="radio my-radio radio-primary radio-inline">
											<input type="radio" name="radio21" id="radio21" value="option21">
											<label for="radio21"> No </label>
										</div>
									</div>
								</div>
							</div>								
						</fieldset>
					</div>
				</div>	
			</div>
		</div>
	</div>
	<div class="cleafix"></div>

	<div class="properties-details-area pt-115 pb-60">
		<div class="container">
			<div class="row">
			   @include('include.alerts')
			</div>
			<div class="row">
				<div class="col-md-8 col-sm-8 col-xs-12">
					<div class="row">	
						<h3>{!!$property->title!!}</h3>
					</div>
					<div class="pro-details-image">
						@include('properties._show-images')
					</div>
					<div class="pro-details-short-info">
					
						<div class="row">
							@include('properties._show-description')
						</div>
						
						<div class="clearfix"></div>
						
						<div class="row">
							<h3>Admin Reviews</h3>
							{!!$property->reviews!!}
						</div>
						
						<div class="clearfix"></div>
						
						<div class="row">
							<h3>Rental Policies</h3>
						    {!!$settings->rental_policies!!}
						</div>
						
						<div class="clearfix"></div>
						
						<div class="row">
							@if($property->is_vacation=='1')
								@if($property->is_rates=='1')
									@include('properties._show-rates')
								@endif
							@endif	
						</div>
						<div class="row">
							<div class="col-md-6  col-sm-12 col-xs-12"  style="padding-left:0px;">
								<div class="white-box">
									<div class="user-bg"> 
										<!--img src="{{ asset('resources/images/img1.jpg')}}" width="100%"-->
										<div class="overlay-box">
											<div class="user-content">
												<a href="javascript:void(0)" style="float: left; height: 45px; width: 100%;">
													<!--img src="{{ asset('resources/images/genu.jpg')}}" class="thumb-lg img-circle" alt="img" width="100px"-->
												</a>
												<h4 class="text-white">Jenny Deo</h4>
												<h5 class="text-white">info@propertimatch.com</h5>
												<ul class="social-media-list">
													<li class="facebook"> <a href=""><i class="fa fa-facebook"></i></a> </li>
													<li class="twitter"> <a href=""><i class="fa fa-twitter"></i></a> </li>
													<li class="instagram"> <a href=""><i class="fa fa-instagram"></i></a> </li>
													<li class="google-plus"> <a href=""><i class="fa fa-google-plus"></i></a> </li>
												</ul>   
											</div>
										</div>
									</div>
									<div class="user-btm-box">
										<div class="col-md-12 property-list text-center">								
											<p> 
												<span class="fnt-14 pull-left"><strong>Hobbies : </strong> Playing Cricket , Reading Books</span>
											</p>
									    </div>							 
										<div class="col-md-12 property-list text-center">								
											<p>
												<span class="fnt-14 pull-left"><strong>Interest : </strong> Lorem Ipsum is simply dummy text. </span>
											</p>
									    </div>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-sm-12 col-xs-12" style="padding-right:0px;padding-left:0;">
								<form class="add-quick-contact bg-gray"> <h5>Quick Contact</h5>
									<div class="form-group">
										<input placeholder="Your Name" class="form-control" type="text">
									</div>
									<div class="form-group">
										<input placeholder="Email Address" class="form-control" type="email">
									</div>
									<div class="form-group">
										<textarea placeholder="Message" rows="3" class="form-control"></textarea>
									</div>
									<div class="form-group">
										<button type="submit" class="submit-btn-1">SUBMIT</button>
									</div>
								</form>
							</div>
						</div>
					</div>
					
					
					
					<div class="pro-details-agent-review pro-details-short-info">
						<div class="row">
							<div class="col-md-12 col-sm-12 col-xs-12">
								<div class="pro-details-agent p-0">
									<h3>Property Map</h3>
									<iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
										src="http://maps.google.com/maps?q={{$property->latitude}},{{$property->longitude}}&z=15&output=embed">
									</iframe>
								</div>  
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4 col-sm-4 col-xs-12">
					<aside class="widget widget-featured-property">
						<h5>Featured Property</h5>
						<div class="row">
							<!-- flat-item -->                                    
							<div class="col-md-12 col-sm-6 col-xs-12">
								<div class="flat-item">
									<div class="flat-item-image">
										<span class="for-sale">Featured</span>    
										<a href="#">
											<img src="{{ asset('resources/images/flat/1.jpg' )}}" alt="">
										</a>   
										<div class="flat-link">     
											<a href="#">More Details</a>      
										</div>
										<ul class="flat-desc">
											<li> 
												<img src="{{ asset('resources/images/icons/4.png') }}" alt=""> <span>450 sqft</span> 
											</li>
											<li>   
												<img src="{{ asset('resources/images/icons/5.png') }}" alt=""> <span>5</span>   
											</li>
											<li>
												<img src="{{ asset('resources/images/icons/6.png') }}" alt=""><span>3</span> 
											</li>
										</ul>
									</div>
									<div class="flat-item-info">
										<div class="flat-title-price">
											<h5><a href="#">Masons de Villa </a></h5>
											<span class="price">$52,350</span>                                                
										</div>
										<p><img src="{{ asset('resources/images/icons/location.png') }}" alt="">568 E 1st Ave, Ney Jersey</p>
									</div>
								</div>
							</div>
													   
							<div class="col-md-12 col-sm-6 col-xs-12">
								<div class="flat-item">
									<div class="flat-item-image">
										<span class="for-sale">Featured</span>   
										<a href="#"><img src="{{ asset('resources/images/flat/2.jpg') }}" alt=""></a>                                                
										<div class="flat-link">
											<a href="#">More Details</a> 
										</div>
										<ul class="flat-desc">
											<li><img src="{{ asset('resources/images/icons/4.png') }}" alt=""><span>450 sqft</span></li>
											<li><img src="{{ asset('resources/images/icons/5.png') }}" alt=""><span>5</span></li>
											<li><img src="{{ asset('resources/images/icons/6.png') }}" alt=""><span>3</span></li>
										</ul>
									</div>
									<div class="flat-item-info">
										<div class="flat-title-price">
											<h5><a href="#">Masons de Villa </a></h5>
											<span class="price">$52,350</span>                                                
										</div>
										<p><img src="{{ asset('resources/images/icons/location.png')}}" alt="">568 E 1st Ave, Ney Jersey</p>
									</div>
								</div>
							</div>
													
							<div class="col-md-12 hidden-sm col-xs-12">
								<div class="flat-item">
									<div class="flat-item-image">
										<span class="for-sale">Featured</span>                      
										<a href="#"><img src="{{ asset('resources/images/flat/3.jpg') }}" alt=""></a>                                                
										<div class="flat-link">
											<a href="#">More Details</a> 
										</div>
										<ul class="flat-desc">
											<li><img src="{{ asset('resources/images/icons/4.png') }}" alt=""><span>450 sqft</span></li>
											<li><img src="{{ asset('resources/images/icons/5.png') }}" alt=""><span>5</span></li>
											<li><img src="{{ asset('resources/images/icons/6.png') }}" alt=""><span>3</span></li>
										</ul>
									</div>
									<div class="flat-item-info">
										<div class="flat-title-price">
											<h5><a href="#">Masons de Villa </a></h5>
											<span class="price">$52,350</span>                                                
										</div>
										<p><img src="{{ asset('resources/images/icons/location.png') }}" alt="">568 E 1st Ave, Ney Jersey</p>
									</div>
								</div>
							</div>
							
							<div class="col-md-12 col-sm-12 col-xs-12">
								
								@include('properties._show-booking-calendar')
							
							</div>
							
						</div>
					</aside>	
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	
	
	
<?php /*	
<div class="container page-body">
   @include('include.alerts')
   <!-- /.row -->
   <!-- Property Detail -->
   <div class="row">
      @if($property->is_vacation=='1')
      <!-- Left/Middle Column :: Property Images/Description/Amenities/Features/Rates/Map -->
		<div class="col-md-7 property-description">
			@if($property->is_vacation=='1')
			@if($property->is_rates=='1')
			<div class="row">
				@include('properties._show-rates')
			</div>
			@endif
			@endif
		</div>
      <!-- Right Column :: Property Detail -->
      <div class="col-md-5 booking-form">
         @include('properties._show-booking-calendar')
         <br/><br/>
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
      </div>
      @else
      <!-- Left Column :: Property Detail -->
      <div class="col-md-6">
         @include('properties._show-images')
      </div>
      <!-- Middle Column :: Property Detail -->
      <div class="col-md-6">
         @include('properties._show-description')
      </div>
      @endif
      
   </div>
   <!-- /.row -->
   <!-- Map of proerty -->
      <!--div class="row">
         <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
            src="http://maps.google.com/maps?q={{$property->latitude}},{{$property->longitude}}&z=15&output=embed">
         </iframe>
      </div-->
</div>
*/ ?>
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
