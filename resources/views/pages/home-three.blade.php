@extends('layouts.default.start')
<!-- Goes to html>head>title -->
@section('metatits')
{{$page_home->meta_title}}
@endsection
@section('metadesc')
{{$page_home->meta_descript}}
@endsection
@section('metakeys')
{{$page_home->meta_keyword}}
@endsection
@section('title')
Welcome to our website - {{$settings->site_title}}
@endsection
<!-- Yields body of the page inside the template -->
@section('contents')
<?php /*
@include('include.sliders-003')
*/?>
<script type="text/javascript">
$(document).ready(function() {
$("#top_nav_28").addClass("active");
});
</script>
<style type="text/css">
	#state_id{
		margin-bottom: 0px;
	}
	.search-by-name{
		display: none;
	}
</style>
<div class="slider-1 pos-relative">
<div class="bend niceties preview-1">
<div id="ensign-nivoslider-3" class="slides">
<?php $lazyloadcounter = 0;
foreach ($sliders as $key => $value) { ?>
<img class="b-lazy" data-src="{{url('')}}/<?php echo $value['image']; ?>" src="<?php echo $value['image']; ?>" alt="property for sale by owner" title="#slider-direction-<?php echo $key; ?>" <?php if($lazyloadcounter != 0) { ?> style="display: none;" <?php } $lazyloadcounter++; ?> />
<?php 
$slider_txt[] = $value['title'];
$slider_descp[] = $value['sliderdescp'];
$slider_link[] = $value['slidelink'];
}
?>
</div>
<?php for ($i=0; $i < count($sliders) ; $i++) { ?>
<div id="slider-direction-<?php echo $i; ?>" class="slider-direction">
<div class="slider-content text-center">
<div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
<h4 class="slider-1-title-1"><?php echo $slider_txt[$i]; ?></h4>
</div>
<div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s">
<h1 class="slider-1-title-2"><?php echo $slider_descp[$i]; ?></h1>
</div>
<!--<div class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="2s">     
<a class="slider-button mt-40" href="</?php echo $slider_link[$i]; ?>">Read More</a>
</div>--></div></div>
<?php } ?>
</div>
</div>
<form action="{{url('/Filtration')}}" method="post">
<section id="page-content" class="page-wrapper remove-extra-space">
<div class="find-home-area bg-blue call-to-bg plr-140 pt-50 pb-30">
<div class="container-fluid">
<div class="row">
<div class="col-md-3 col-xs-12">
<div class="section-title text-white space-home">
<h3>FIND YOUR</h3>
<h2 class="h1">HOME HERE</h2>
</div></div>
<div class="col-md-9 col-xs-12">
    <div class="size-color">
        <h3>Welcome to Match Property Direct <sup>TM</sup></h3>  
        <h5>A new concept connecting buyers and sellers directly. Please see our featured properties below. </h5>    
    </div><!--size-color-->
    
<div class="find-homes">
<div class="row">
<div class="col-sm-12 col-xs-12 search-by-name">
<div class="find-home-item custom-select">
<input type="text" name="srch_name" id="srch_name" placeholder="Search By Name" class="form-control">
</div></div>
    
    <div class="col-sm-3 col-xs-12">
<div class="find-home-item  custom-select">
<select name="category_id" class="selectpicker" title="Property Type" data-hide-disabled="true" required="required">
@if($property_types>0)
@foreach($property_types as $single)
<option value="{{$single->id}}">{{$single->title}}</option>
@endforeach
@endif
</select>
</div></div>
    <div class="col-sm-3 col-xs-12" style="display:none;">
<div class="find-home-item custom-select">
<input type="text" id="city" name="city"  placeholder="Location"/>
</div>
</div>
<div class="col-sm-3 col-xs-12">
<div class="find-home-item class-max-price">
<input type="number" name="min_price" placeholder="Min Price" min="1" max="100000" class="form-control">
</div>
</div>
<div class="col-sm-3 col-xs-12">
<div class="find-home-item class-max-price">
<input type="number" name="max_price" placeholder="Max Price" min="1" max="10000000000" class="form-control">
</div>
</div>
<div class="col-sm-3 col-xs-12">
<div class="find-home-item  custom-select">
<select name="bedrooms" class="selectpicker" title="Bed" data-hide-disabled="true">
@for($i=1;$i<=50;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor
</select>
</div>
</div>
<div class="clearfix"></div>
<div class="col-sm-3 col-xs-12">
<div class="find-home-item custom-select">
<select name="bathrooms" class="selectpicker" title="Baths" data-hide-disabled="true">
@for($i=1;$i<=50;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor
</select>
</div>
</div>
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<div class="col-sm-3 col-xs-12">
<div class="find-home-item mb-0-xs">
<button class="button-1 btn-block btn-hover-1" type="submit">SEARCH</button>
</div></div>
<div class="col-sm-3 col-xs-12">
<div class="find-home-item mb-0-xs">
<a class="more-filter" style="cursor: pointer;">MORE FILTERS <i class="fa fa-plus"></i></a>
</div></div></div></div></div></div></div></div>
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
</ul></div></fieldset></div></div>
<div class="col-md-12 search-drop">
<div class="row">
<fieldset class="my-field-set p-b-7" style="display:none">
<legend class="my-legend">Distance</legend>
<p>Multiple options can be selected</p>
<!-- <div class="price_filter p-b-15">
<div class="price_slider_amount">
<input type="button"  value="Distance :"/>
<input type="text" id="amount2" name="distance" placeholder="Add Your Price" readonly="" />
</div>
<div id="slider-range2"></div>
</div> -->
<ul class="submenu pull-left distance-list">
<?php $count1=1; ?>
@if($features>0)
@foreach($features as $single)
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
<label for="checkboxF{{$count1}}" class="css-label"> <?php echo $value_distance['name']; ?></label>
</a>
</li>
<?php } ?>
</ul></fieldset></div></div></div></div>
<div class="col-md-6 search-drop">
<div class="row"> 
<fieldset class="my-field-set">
<legend class="my-legend">Features Categories</legend>
<div class="customScrollSec">
    
<div class="row">
<div class="col-sm-12 col-xs-12">
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
 <select name="year_built" class="selectpicker inner-select space-bot " title="Year Built" data-hide-disabled="true">
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
<div class="form-custom clr_cstm space-bot">
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
<div id="map" style="height: 300px; width: 100%;"> </div>
</div>
<div id="shw_map" class="form-custom"><iframe width='100%' height='300' src='https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=300&hl=ru&q=America+(Your%20Town/Province)&ie=UTF8&t=&z=5&iwloc=A&output=embed' frameborder='0' scrolling='no' marginheight='0' marginwidth='0'></iframe></div>
</div>
</div>
</div>
</section>
</form>
<!-- Featured Properties Section -->
<section class="featured-flat-area pb-80 pt-115">
<div class="container">
<div class="col-md-12">
<div class="section-title-2 text-center">
<h2>Featured PROPERTIES</h2>
<p>Dear Subscriber, Please take a look at these beautiful featured properties from all over the world or around the corner. Just click on the photo and all of the information regarding the property will pop up. It is easy to use and simple to understand. Buyer contacts the seller directly from the information listed or contact their Preferred Local Attorney. We hope you find this a user friendly site and find your Dream Home !</p>
</div>
</div>
</div>
<div class="container">
<div class="featured-flat">
<div class="row">   
@foreach($properties as $property)	
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
<img class="img-responsive b-lazy {{$property->images->first()->image_class}}" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset($property->images->first()->image)}}" alt="property for sale by owner">
@else
<img class="img-responsive b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{asset('pictures/placeholder.png')}}" alt="property for sale by owner">
@endif
<div class="flat-link"> 
<a href="{{url('show/'.$property->slug)}}">More Details</a>     
</div>
<ul class="flat-desc">
<li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/4.png ')}}" alt="property for sale by owner"><span>{{$property->area ? $property->area : '0'}}</span></li>
<li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/5.png ')}}" alt="property for sale by owner"><span> {{$property->bedrooms}} </span></li>
<li><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/6.png ')}}" alt="property for sale by owner"><span> {{$property->bathrooms}}</span></li>
</ul></div>
<div class="flat-item-info">
<div class="flat-title-price">
<h5><a href="{{url('show/'.$property->slug)}}">{{$property->title}}  </a></h5>
<?php if(isset($_COOKIE['currency_symbol'])){ ?>
<div class="price"><?php echo $_COOKIE['currency_symbol'].' '.EnvatoUser::calculateCurrency($property->currency_code,$_COOKIE['user_currency'],$property->sale_price); ?></div>
<?php }else{ ?>	
<div class="price">{{$property->currency_code}}-{{$property->sale_price}}<!-- ${{number_format($property->sale_price,2)}} --></div>
<?php } ?>
</div>
<p>
<img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/location.png')}}" alt="property for sale by owner">
{{$property->city}}, {{$property->zip}}  
</p></div></div></div>
@endforeach
</div></div></div></section>
<!-- /.row -->
<!-- How It Works Section -->
<div class="features-area fix">
<div class="container-fluid">
<div class="row">
<div class="col-lg-8 col-lg-offset-4 col-md-7 col-md-offset-5">
<div class="features-info bg-gray">
<div class="section-title mb-30">
<h3>How</h3>
<h2 class="h1">MatchPropertyDirect&trade; Works</h2>
</div>
<div class="features-desc">
<p style="color: #ff6c2c;font-size: 18px;font-weight: bold;">
<span data-placement="top" data-toggle="tooltip" data-original-title="The name you can trust" class="tooltip-content"></span> MatchPropertyDirect&trade; matches seller's with buyers for a property direct sale.
</p>
</div>
<div class="features-include">
<div class="row">
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">Seller Creates</h6>
<p>Seller creates an account and pays a small fee to sell property online. Buyer searches for free !</p>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">Buyer Choice</h6>
<p>Buyer has a choice to search for property for sale without an account or they can create an account to save their criteria.</p>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">Search Property</h6>
<p>Buyer finds a property that interests them on this home buying website.</p>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">Buyer Connects</h6>
<p>Buyer contacts seller with property for sale.</p>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">No Middle Man</h6>
<p>Buyer and seller communicate directly through phone and email to help facilitate selling your home. No commission !</p>
</div>
</div>
<div class="col-lg-4 col-md-6 col-sm-4 features-points">
<div class="features-include-list">
<h6><img class="b-lazy" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="{{ asset('resources/images/icons/logoBullet.png') }}" alt="property for sale by owner">Closing Cool</h6>
<p>Consult with a local attorney to finish the house purchasing process and real estate closing.</p>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>	
<div class="subscribe-area propertipurpose bg-blue call-to-bg call-to-bg1 plr-140 ptb-50">
<div class="container-fluid">
<div class="row">
<div class="col-md-3 col-sm-4 col-xs-12 spacial-width-subs">
<div class="section-title text-white mt-10">
<h3>MatchPropertyDirect's&trade; </h3>
<h2 class="h1">MISSION</h2>
</div>
</div>
<div class="col-md-9 col-sm-8 col-xs-12 spacial-width-subs">
<div class="subscribe">
<div class="row">
<div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
<p>MatchPropertyDirect&trade; mission is to match buyers and sellers directly worldwide via the internet.</p></div>
<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12 get-started">
<button type="button" class="pull-right" value="Get Started" onclick="location.href='{{url()}}/register';">Get Started</button>
</div></div></div></div></div></div></div>
<script>
    function initMap() {  
    $("#dynamic_map").hide();
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
            url: "property-by-location",
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
            
            var map = new google.maps.Map(document.getElementById('map'), {
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
             var contentString = '<div id="content" class="map-content">'+
		'<div id="siteNotice">'+
		'</div>'+
		'<div id="bodyContent" class="map-body">'+'<img src="https://www.matchpropertydirect.com/'+properties[i]['propertyimage']+'" width="250" height="120"/>'+
		'<a target="_blank" href="https://www.matchpropertydirect.com/show/'+properties[i]['slug']+'")}}><h4 id="firstHeading" class="firstHeading">'+properties[i]['title']+'</h4></a>' +
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
    // Add a Snazzy Info Window to the marker
    var info = new SnazzyInfoWindow({
        marker: marker,
        content: '<h1>Styling with SCSS</h1>' +
                 '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce id urna eu sem fringilla ultrices.</p>' +
                 '<img src="http://www.jaldikr.com/assets/images/MainBanner.jpg" width="100%" height="250px"/>' +
                 '<hr>' +
                 '<em>Snazzy Info Window</em>',
        closeOnMapClick: false
    });
    });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGzCcxLqVTlfq7ktS6EKycZxIoBAoOhm0&amp;sensor=false&amp;libraries=places&callback=initMap"></script>
@endsection