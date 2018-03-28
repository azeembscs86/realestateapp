<!-- This view file shows the detailed information of a property the user landed in -->

@extends('layouts.default.start')

<!-- Goes to html>head>title -->

@section('metatits')

{{$property->meta_title}}

@endsection

@section('metadesc')

{{$property->meta_descript}}

@endsection

@section('metakeys')

{{$property->meta_keyword}}

@endsection

@section('title')

{{$property->title}} - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')
<!-- Page Content -->
<style type="text/css">
      #map {
        height: 400px;
        width: 100%;
      }
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      .condition-star{
        color: red;
        font-size: 24px;
      }
      #state_id{
        margin-bottom: 0px;
      }
</style>
  <div class="bg-opacity-black-70">    
    <div id="map"></div>
  </div>
<div class="cleafix"></div>
  <form action="{{url('/Filtration')}}" method="post">
  <div class="find-home-area bg-blue call-to-bg plr-140 pt-50 pb-30">
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
                <div class="col-sm-12 col-xs-12" style="display:none">
                  <div class="find-home-item custom-select">
                    <input type="text" name="srch_name" id="srch_name" placeholder="Search By Name" class="form-control">
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item  custom-select">
                    <select name="category_id" class="selectpicker" title="Property Type" data-hide-disabled="true" required="required">
                      @if($property_types>0)
                      @foreach($property_types as $single)
                        <option value="{{$single->id}}">{{$single->title}}</option>
                      @endforeach
                      @endif                                      
                    </select>
                  </div>
                </div>
				<div class="col-sm-3 col-xs-12" style="display:none;">
                  <div class="find-home-item custom-select">
                   <input type="text" id="city" name="city"  placeholder="Location"/>
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item class-max-price">
                    <input type="number" name="min_price" placeholder="Min Price" min="1" class="form-control">
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item class-max-price">
                    <input type="number" name="max_price" placeholder="Max Price" min="1" class="form-control">
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item  custom-select">
                    <select name="bedrooms" class="selectpicker" title="Bedrooms" data-hide-disabled="true">
                     @for($i=1;$i<=50;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item custom-select">
                    <select name="bathrooms" class="selectpicker" title="Bathrooms" data-hide-disabled="true">
                    @for($i=1;$i<=20;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    </select>
                  </div>
                </div>
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item mb-0-xs">  
                    <button class="button-1 btn-block btn-hover-1" type="submit">SEARCH</button>       
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item mb-0-xs">  
                    <a class="more-filter" style="cursor: pointer;">MORE FILTERS <i class="fa fa-plus"></i></a>       
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
<div class="customScrollSec">
<p>Multiple options can be selected</p>
<ul class="submenu lifestyle pull-left">
<?php $count=0; 
function cmp($a, $b)
{
return strcmp($a["name"], $b["name"]);
}
?>
@if( $lifestyles > 0 )
@foreach( $lifestyles as $single )

<?php $arr[] = array('name'=>$single->title,'id'=>$single->id); ?>
@endforeach
@endif
<?php
usort($arr, "cmp"); 
foreach( $arr as $key=>$value ){
?>
<?php $count++; ?>
<li>
<a href="#">
<input type="checkbox" name="lifestyle[]" id="checkbox{{$count}}" class="css-checkbox" value="<?php echo $value['id']; ?>"/>
<label for="checkbox{{$count}}" class="css-label"><?php echo $value['name']; ?></label>
</a></li>
<?php if($count==10) { ?>
</ul>
<ul class="submenu lifestyle pull-left">
<?php } ?>
<?php if($count==20) { ?>
</ul>
<ul class="submenu lifestyle-third-box pull-right">
<?php } ?>
<?php } ?>
</ul></div></fieldset>
                </div>  
              </div>
              <div class="col-md-12 search-drop" style="display: none">
                <div class="row"> 
                  <fieldset class="my-field-set p-b-7">
                    <legend class="my-legend">Distance</legend>
                    <p>Multiple options can be selected</p>
                    <!-- <div class="price_filter p-b-15">
                      <div class="price_slider_amount">           
                        <input type="button"  value="Distance :"/>     
                        <input type="text" id="amount2" name="distance"  placeholder="Add Your Price" readonly="" />                                                            </div>
                      <div id="slider-range2"></div>
                    </div> -->   
                    <ul class="submenu pull-left distance-list">
                    <?php $count1=1; ?>
                    @if($emt_features>0)
                    @foreach($emt_features as $single)
                    <?php $arr_distance[] = array('name'=>$single->title,'id'=>$single->id); ?>
                    @endforeach
                    @endif  
                    <?php 
                    usort($arr_distance, "cmp"); 
                    foreach( $arr_distance as $key_distance=>$value_distance ){
                    ?>
                    <?php $count1++; ?>
                      <li>
                        <a href="#">
                          <input type="checkbox" name="features[]" id="checkboxF{{$count1}}" class="css-checkbox" value="<?php echo $value_distance['id']; ?>" />
                          <label for="checkboxF{{$count1}}" class="css-label"><?php echo $value_distance['name']; ?></label>
                        </a>
                      </li> 
                      <?php } ?>   
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
<div class="customScrollSec">
    
<div class="row">
    <div class="col-sm-12 col-xs-12 col-md-12">
        <div class="find-home-item custom-select">
<div class="form-custom clr_cstm">
<label class="custom-label">Location</label>
<input type="text" id="state_id" name="state_id"  placeholder="Location" class="btn-group bootstrap-select" />
</div>    
    </div>
 </div>  
</div>    
<div class="row">
<div class="col-md-6 form-custom"> 
                <label class="custom-label">Year Built</label>
                    <select name="year_built" class="selectpicker inner-select" title="Year Built" data-hide-disabled="true">
                        <?php $from_year = date("Y",strtotime("-318 year")); ?>
                              @for($i=$from_year;$i<=date('Y');$i++)
                              <?php $sorting_arr[] = $i; rsort($sorting_arr); ?>
                              @endfor
                              <?php for($j=0;$j<count($sorting_arr);$j++){ ?>
                              <option value="<?php echo $sorting_arr[$j]; ?>"><?php echo $sorting_arr[$j]; ?></option>
                              <?php } ?>
                      </select>
                 
    
    <div class="form-custom clr_cstm" style="display:none">
<label class="custom-label">Master Bedroom</label>
<select name="master_bedroom" class="selectpicker" title="Master Bedroom" data-hide-disabled="true">
@for($i=0;$i<=10;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor
</select>
</div>

<div class="form-custom">
<label class="custom-label">Energy Efficient</label>
<ul class="submenu pull-left">
<li>
<a href="#">
<input type="checkbox" name="geo_thermal_heat" id="checkboxG31" class="css-checkbox" value="1"/>
<label for="checkboxG31" class="css-label "> Geo Thermal Heat</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="solar_panels" id="checkboxG32" class="css-checkbox" value="1"/>
<label for="checkboxG32" class="css-label "> Solar Panels</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="solar_water_heater" id="checkboxG33" class="css-checkbox" value="1"/>
<label for="checkboxG33" class="css-label "> Solar Water Heater</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="windmill" id="checkboxG34" class="css-checkbox" value="1"/>
<label for="checkboxG34" class="css-label "> Windmill</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="energy_star_appliances" id="checkboxG35" class="css-checkbox" value="1"/>
<label for="checkboxG35" class="css-label "> Energy Star Appliances</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="gas_heater" id="checkboxG36" class="css-checkbox" value="1"/>
<label for="checkboxG36" class="css-label "> Gas heater</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="electric_heater" id="checkboxG37" class="css-checkbox" value="1"/>
<label for="checkboxG37" class="css-label "> Electric heater </label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="trash_drop_off" id="checkboxG38" class="css-checkbox" value="1"/>
<label for="checkboxG38" class="css-label "> Trash drop off</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="city_trash_removal" id="checkboxG39" class="css-checkbox" value="1"/>
<label for="checkboxG39" class="css-label "> City Trash removal</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="sepic_tank" id="checkboxG40" class="css-checkbox" value="1"/>
<label for="checkboxG40" class="css-label "> Septic Tank</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="city_sewer" id="checkboxG41" class="css-checkbox" value="1"/>
<label for="checkboxG41" class="css-label "> City sewer</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="city_water" id="checkboxG42" class="css-checkbox" value="1"/>
<label for="checkboxG42" class="css-label "> City Water </label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="well_water" id="checkboxG43" class="css-checkbox" value="1"/>
<label for="checkboxG43" class="css-label "> Well Water</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="ac_central" id="checkboxG44" class="css-checkbox" value="1"/>
<label for="checkboxG44" class="css-label "> Ac central</label>
</a>
</li>
<li>
<a href="#">
<input type="checkbox" name="ac_window_units" id="checkboxG45" class="css-checkbox" value="1"/>
<label for="checkboxG45" class="css-label "> Ac window units</label>
</a>
</li>

<li>
<a href="#">
<input type="checkbox" name="ac_european_room_unit" id="checkboxG46" class="css-checkbox" value="1"/>
<label for="checkboxG46" class="css-label "> AC European room unit</label>
</a>
</li>

</ul>
</div>
</div>
<div class="col-md-6">
<div class="form-custom clr_cstm">
<label class="custom-label">Area (Sq. Feet)</label>
 <input id="amount1" name="min_area" type="number" min="100" class="form-control" placeholder="Min Area" />
 <input id="amount2" name="max_area" type="number" min="100" class="form-control" placeholder="Max Area" />
</div>
<div class="form-custom">
<label class="custom-label">Beach Access</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="beach_right" id="radio92" value="1">
<label for="radio92"> Yes </label>
</div>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="beach_right" id="radio81" value="0">
<label for="radio81"> No </label>
</div>
</div>
<!--<div class="form-custom">
<label class="custom-label">Heat Type</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="heat_type" id="radio62f" value="1" >
<label for="radio62f"> Yes </label>
</div> 
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="heat_type" id="radio61f" value="0">
<label for="radio61f"> No </label>
</div>
</div>-->
<div class="form-custom">
<label class="custom-label">Gated Property</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="gated_property" id="radio52" value="1" >
<label for="radio52"> Yes </label>
</div> 
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="gated_property" id="radio51" value="0">
<label for="radio51"> No </label>
</div>
</div>
<div class="form-custom">
<label class="custom-label">Tennis Court</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="tennis_court" id="radio42" value="1" >
<label for="radio42"> Yes </label>
</div> 
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="tennis_court" id="radio41" value="0">
<label for="radio41"> No </label>
</div>
</div>
<div class="form-custom">
<label class="custom-label">Central Air Conditioning</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="central_air_conditioning" id="radio32" value="1" >
<label for="radio32"> Yes </label>
</div> 
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="central_air_conditioning" id="radio31" value="0">
<label for="radio31"> No </label>
</div>
</div>
<div class="form-custom">
<label class="custom-label">Fireplace</label>
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="fireplace" id="radio22" value="1" >
<label for="radio22"> Yes </label>
</div> 
<div class="radio my-radio radio-primary radio-inline">
<input type="radio" name="fireplace" id="radio21" value="0">
<label for="radio21"> No </label>
</div>
</div>
<div class="form-custom garages">
<label class="custom-label">Garage</label>
<div class="radio my-radio radio-primary">
<input type="radio" name="garages" id="radio100" value="0">
<label for="radio100"> 0 Car </label>
</div>
<div class="radio my-radio radio-primary">
<input type="radio" name="garages" id="radio101" value="1">
<label for="radio101"> 1 Car </label>
</div>
<div class="radio my-radio radio-primary">
<input type="radio" name="garages" id="radio102" value="2">
<label for="radio102"> 2 Car </label>
</div>
<div class="radio my-radio radio-primary">
<input type="radio" name="garages" id="radio103" value="3">
<label for="radio103"> 3 Car </label>
</div>
<div class="radio my-radio radio-primary">
<input type="radio" name="garages" id="radio104" value="4">
<label for="radio104"> 4 Car </label>
</div>
<ul class="submenu" style="display: none;">
    <li>
<input type="radio" name="garages" id="radio101" value="0">
<label for="radio101"> 0 Car </label>
</li> 
<li>
<input type="radio" name="garages" id="radio101" value="1">
<label for="radio101"> 1 Car </label>
</li> 
<li>
<input type="radio" name="garages" id="radio102" value="2">
<label for="radio102"> 2 Car </label>
</li> 
<li>
<input type="radio" name="garages" id="radio103" value="3">
<label for="radio103"> 3 Car </label>
</li> 
<li>
<input type="radio" name="garages" id="radio104" value="4">
<label for="radio104"> 4 Car </label>
</li> 
</ul>
</div>
</div>
</div>
</div>
</fieldset>
          </div>
        </div>  
        <div style="margin-top: 15px;"></div>
                <div class="col-sm-3 col-xs-12">
                    <div class="find-home-item mb-0-xs">  
                       <button class="button-1 btn-block btn-hover-1 mobile-button hidden-lg hidden-md" type="submit">SEARCH</button>       
                    </div>
                </div>
         <div class="form-custom shw_map" id="dynamic_map">
                <div id="map-convas" style="height: 300px; width: 100%;"> </div>
              </div>
        <div id="shw_map" class="form-custom">
          <iframe width="100%" height="300" src="https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=300&hl=ru&q=America+(Your%20Town/Province)&ie=UTF8&t=&z=5&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
        </div>
      </div>
    </div>
  </div>
  </form>               
  <div class="cleafix"></div>
  <div class="properties-details-area pt-115 pb-60 result-cs">
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
            <!--div class="row"-->
              @include('properties._show-description')
            <!--/div-->
                    <div class="row">
                      <div class="col-xs-12">
                      <div class="seller-info-box mt-30">
                      <div class="col-md-4 col-sm-5 col-xs-12">
                        <div class="pro-detail-img">
                        <?php if(empty($property_user->avatar))
                        {
                          $property_user->avatar = 'pictures/no-image.jpg';
                        }
                        ?>
                          <img src="{{url()}}/{{$property_user->avatar}}" width="160" />
                        </div>
                      </div>
                      <div class="col-md-8 col-sm-7 col-xs-12">
                        <div class="user-content img-detail-left">
                          <h4 class="text-white">{{$property_user->firstname}} {{$property_user->lastname}}</h4>
                          <h5 class="text-white"><i class="fa fa-envelope"></i><a href="mailto:{{$property_user->email}}"> {{$property_user->email}}</a></h5>
                          <h5 class="text-white"><i class="fa fa-phone"></i><a href="tel:{{$property_user->phone}}"> <?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($property_user->phone)), 2); ?> </a></h5>
                          <ul class="social-media-list">
                            <?php if($property_user->facebook_url != ''){ ?>
                            <li class="facebook"> <a href="{{$property_user->facebook_url}}" target="_blank"><i class="fa fa-facebook"></i></a> </li>
                            <?php }else{ ?>
                            <li class="facebook"> <a href="#"><i class="fa fa-facebook"></i></a> </li>
                            <?php } ?>
                            <?php if($property_user->twitter_url != ''){ ?>
                            <li class="twitter"> <a href="{{$property_user->twitter_url}}" target="_blank"><i class="fa fa-twitter"></i></a> </li>
                            <?php }else{ ?>
                            <li class="twitter"> <a href="#"><i class="fa fa-twitter"></i></a> </li>
                            <?php } ?>
                            <?php if($property_user->instagram_url != ''){ ?>
                            <li class="instagram"> <a href="{{$property_user->instagram_url}}" target="_blank"><i class="fa fa-instagram"></i></a> </li>
                            <?php }else{ ?>
                            <li class="instagram"> <a href="#"><i class="fa fa-instagram"></i></a> </li>
                            <?php } ?>
                            <?php if($property_user->google_url != ''){ ?>
                            <li class="google-plus"> <a href="{{$property_user->google_url}}" target="_blank"><i class="fa fa-google-plus"></i></a> </li>
                            <?php }else{ ?>
                            <li class="google-plus"> <a href="#"><i class="fa fa-google-plus"></i></a> </li>
                            <?php } ?>
                          </ul>   
                        </div>
                      </div>
                      </div>
                      </div>
                    </div>
                  <div class="clearfix"> </div>
                  <div class="row">
                  <div class="col-xs-12"><h5 class="m-b-20 mt-30">Seller's Information</h5>
                  <div class="col-md-12 user-btm-box m-cs-pro" style="padding-left: 0px;">
                    <div class="col-md-12 property-list text-center">       
                      <p> 
                        <span class="fnt-14 pull-left text-left"><strong>Tell us about you? </strong> {{$property_user->about ? $property_user->about : 'not mentioned'}} </span>
                      </p>
                      <p> 
                        <span class="fnt-14 pull-left text-left"><strong>Tell us about your hobbies? </strong> {{$property_user->hobbies}} </span>
                      </p>
                      <p> 
                        <span class="fnt-14 pull-left text-left"><strong>Tell us about your pets? </strong> {{$property_user->pets}} </span>
                      </p>
                      </div>
                  </div>
                </div>
                <div class="col-xs-12"><p class="m-b-20 mt-10"><span class="condition-star">*</span> See <a href="{{url('/pages/terms-and-conditions')}}" target="_blank">Terms and Conditions</a></p></div>
              </div>
            <div class="clearfix"> </div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="m-b-20">
                  <h5 class="m-b-20 mt-30">Attorney Details</h5>
                    <div class="bg-cos-tab">
                    <table class="attorney-det">
                      <tbody>
                      <tr> <th>Preferred Local Attorney: </th> <td> {{$property->att_name ? $property->att_name : 'not mentioned'}} </td> </tr>
                      <tr> <th>Phone Number: </th> <td> {{$property->att_phone ? preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($property->att_phone)), 2) : 'not mentioned'}} </td> </tr>
                      <tr> <th>Email: </th> <td> {{$property->att_email ? $property->att_email : 'not mentioned'}} </td> </tr>
                      <tr> <th>PO Box: </th> <td> {{$property->att_pobox ? $property->att_pobox : 'not mentioned'}} </td> </tr>
                      <tr> <th>Zip Code: </th> <td> {{$property->att_zipcode ? $property->att_zipcode : 'not mentioned'}} </td> </tr>
                      <tr> <th>Address: </th> <td> {{$property->att_address ? $property->att_address : 'not mentioned'}} {{$property->att_city ?', '.$property->att_city : 'not mentioned'}} {{$property->att_state ?', '.$property->att_state : 'not mentioned'}} </td> </tr>
                      </tbody>
                    </table>
                    <!--<p class="m-b-10 mt-10">{{$property->att_fee ? 'Subscribers (seller) pays for closing attorneys fees' : ''}}</p>-->
                    <p class="m-b-20 mt-10"><span class="condition-star">*</span> See <a href="{{url('/pages/terms-and-conditions')}}" target="_blank">Terms and Conditions</a></p>
                    </div>
                </div>  
              </div>
            </div>
          </div>
       </div>
        <div class="col-md-4 col-sm-4 col-xs-12">
        <?php if (Auth::check() && Auth::user()->role=='owner') { ?>
          <div class="chat" style="margin-bottom: 20px;">
        <?php if(Auth::check()) { ?>
        <a href="{{url('chat/')}}/{{Auth::user()->id}}/{{$property->user_id}}"><button type="button" class="button-orange btn-block">
        <span>
          <i class="fa fa-commenting-o"></i>
        </span>
        Chat With Seller</button></a>
        <?php } else { ?>
        <a href="{{url('registerredirect/')}}"><button type="button" class="button-orange btn-block">
        <span>
          <i class="fa fa-commenting-o"></i>
        </span>
        Chat With Seller</button></a>
        <?php } ?>
        </div>
        @include('properties._show-send-buying-offer')
          <?php }else{ ?>  
        <div class="chat" style="margin-bottom: 20px;">
        <?php if(Auth::check() and Auth::user()->role=='user') { ?>
        <a href="{{url('chat/')}}/{{Auth::user()->id}}/{{$property->user_id}}"><button type="button" class="button-orange btn-block">
        <span>
          <i class="fa fa-commenting-o"></i>
        </span>
        Chat With Seller</button></a>
        <?php } else { ?>
        <a href="{{url('registerredirect/')}}"><button type="button" class="button-orange btn-block">
        <span>
          <i class="fa fa-commenting-o"></i>
        </span>
        Chat With Seller</button></a>
        <?php } ?>
        </div>
          @include('properties._show-send-buying-offer')
        <?php } ?>  
          <aside class="widget widget-featured-property" style="display:none;">
            <h5>Featured Property</h5>
            <div class="row">
              <!-- flat-item -->     
                @if(count($featured_properties)>0)    
                @foreach($featured_properties as $single)
              <div class="col-md-12 col-sm-6 col-xs-12">
                <div class="flat-item">
                  <div class="flat-item-image">
                  <?php if($single->is_sold=='0' and $single->is_featured=='1') { ?>
                    <span class="for-sale">Featured</span> 
                    <?php } else if($single->is_sold=='1') { ?>
                    <span class="for-sale">Sold</span>
                    <?php } ?>   
                    <a href="{{url('show/'.$single->slug)}}">
                      @if(isset($property->images->first()->image))
                        <img class="img-responsive" src="{{asset($single->images->first()->image)}}" alt="{{$single->title}}">
                      @else
                        <img class="img-responsive" src="{{asset('pictures/placeholder.png')}}" alt="No Image Available">
                      @endif
                    </a>   
                    <div class="flat-link">     
                      <a href="{{url('show/'.$single->slug)}}">More Details</a>      
                    </div>
                    <ul class="flat-desc">
                      <li> 
                        <img src="{{ asset('resources/images/icons/4.png') }}" alt=""> <span>{{$single->area}} sqft</span> 
                      </li>
                      <li>   
                        <img src="{{ asset('resources/images/icons/5.png') }}" alt=""> <span>{{$single->bedrooms}}</span>   
                      </li>
                      <li>
                        <img src="{{ asset('resources/images/icons/6.png') }}" alt=""><span>{{$single->bathrooms}}</span> 
                      </li>
                    </ul>
                  </div>
                  <div class="flat-item-info">
                    <div class="flat-title-price">
                      <h5><a href="{{url('show/'.$single->slug)}}">{{$single->title}} </a></h5>
                      <?php if(isset($_COOKIE['user_currency'])){ ?>
                      <span class="price"><?php echo $_COOKIE['currency_symbol'].' '.EnvatoUser::calculateCurrency($property->currency_code,$_COOKIE['user_currency'],$property->sale_price); ?></span>
                      <?php }else{ ?> 
                      <span class="price">{{$property->currency_code}}{{$property->sale_price}}<!-- ${{number_format($property->sale_price,2)}} --></span>
                      <?php } ?>
                     <!--  @if($property->sale_price!='')
                      <span class="price">${{number_format($property->sale_price,2)}}</span>   
                      @else
                      <span class="price">price not mentioned</span>
                      @endif                                        -->      
                    </div>
                    <p><img src="{{ asset('resources/images/icons/location.png') }}" alt="">{{$property->address}}, {{$property->city}}</p>
                  </div>
                </div>
              </div>
              @endforeach              
              @endif
            </div>
          </aside>
        </div>
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
<script type="text/javascript">
   $(document).ready(function() {
      $("#top_nav_8").addClass("active");
});
   function initMap() { 
      $("#dynamic_map").hide();
        var uluru = {lat: {{$property->latitude}}, lng: {{$property->longitude}}};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 14,
          center: uluru
        });
        var contentString = '{{$property->address}}';
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
          title: 'Uluru (Ayers Rock)'
        });
        marker.addListener('click', function() {
          infowindow.open(map, marker);
        });
     var city = document.getElementById('city');
     var autocompletecity = new google.maps.places.Autocomplete(city);
     autocompletecity.addListener('place_changed', function() {
     var placcitye   = autocompletecity.getPlace();        
    if (!placecity.geometry) {
    window.alert("Autocomplete's returned place contains no geometry");
    return;
    }
    });   
    var city_state = document.getElementById('state_id');
    var autocomplete = new google.maps.places.Autocomplete(city_state);
    autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
    window.alert("Autocomplete's returned place contains no geometry");
    return;
    }
    var properties = [];
    var latitude = " ";
    var logitude = " ";
    var map_zoom;
    var state_city =$("input[name=state_id]").val();
    if (state_city.indexOf(',') > -1) { 
           map_zoom=13;
            }else
            {
                map_zoom=5;
            }
    $.ajax({       
    method: "POST",
            type: "json",
            url: '{{url("property-by-location")}}',
            data: {"city_name": state_city, "_token": "{{ csrf_token() }}"},
            cache: false,
            encode  : true,
            success: function(response){
            var lat = place.geometry.location.lat();
            var lng = place.geometry.location.lng();
            var property = jQuery.parseJSON(response);            
            $.each(property, function(key, value) {          
            properties.push({"id":value.id,"title":value.title, "latitude":value.latitude, "longitude":value.longitude, "address":value.address, "description":value.description,"slug":value.slug,"propertyimage":value.image});
            //alert(value.title + "," + value.address + ",latitude " + value.latitude + ",longitude " +value.longitude);
            });
            // alert(properties);       
            var map = new google.maps.Map(document.getElementById('map-convas'), {
            zoom: map_zoom,
                    center: new google.maps.LatLng(lat, lng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            var locations = [];
            //10 property 
            // property
            var infowindow = new google.maps.InfoWindow();
            var marker;
            for (i = 0; i < properties.length; i++) {
            var loc = properties[i]; //object                
            var address = loc.address;
            var lat = loc.latitude; //lat
            var longti = loc.longitude;
            marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, longti),
            map: map
            });
            google.maps.event.addListener(marker, 'click', (function(marker,i) {
            return function() {
             var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<img src="https://www.matchpropertydirect.com/'+properties[i]['propertyimage']+'" width="250" height="120"/>'+
    '<div id="bodyContent">'+'<a target="_blank" href="https://www.matchpropertydirect.com/show/'+properties[i]['slug']+'")}}><h4 id="firstHeading" class="firstHeading">'+properties[i]['title']+'</h4></a>' +
    '</div>'+
    '</div>'+
    '</div>';
            infowindow.setContent(contentString);
            infowindow.open(map, marker);
            }
            })(marker, i));
            }
            var showmap = '<iframe width="100%" height="300" src="https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=300&hl=ru&q=' + place.formatted_address + '+(Your%20Town/Province)&ie=UTF8&t=&z=5&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>';
            $("#shw_map").hide();
            $("#dynamic_map").show();
            },
    });
    });
      }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGzCcxLqVTlfq7ktS6EKycZxIoBAoOhm0&amp;sensor=false&amp;libraries=places&callback=initMap"></script>
<script src="{{asset('js/reservations.js')}}"></script>
@endsection