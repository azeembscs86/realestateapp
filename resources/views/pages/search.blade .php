<form action="{{url('/Filtration')}}" method="post">
<section id="page-content" class="page-wrapper remove-extra-space">
<div class="find-home-area bg-blue call-to-bg plr-140 pt-50 pb-30">
<div class="container-fluid">
<div class="row">
<div class="col-md-3 col-xs-12">
<div class="section-title text-white">
<h3>FIND YOUR</h3>
<h2 class="h1">HOME HERE</h2>
</div></div>
<div class="col-md-9 col-xs-12">
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
<div class="col-sm-3 col-xs-12">
<div class="find-home-item custom-select">
<select name="year_built" class="selectpicker" title="Year Built" data-hide-disabled="true">
<?php $from_year = date("Y",strtotime("-318 year")); ?>
@for($i=$from_year;$i<=date('Y');$i++)
<?php $sorting_arr[] = $i; rsort($sorting_arr); ?>
@endfor
<?php for($j=0;$j<count($sorting_arr);$j++){ ?>
<option value="<?php echo $sorting_arr[$j]; ?>"><?php echo $sorting_arr[$j]; ?></option>
<?php } ?>
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
<div class="col-md-6 form-custom">
<div class="form-custom clr_cstm">
<label class="custom-label">Location</label>
<input type="text" id="state_id" name="state_id"  placeholder="Location" class="btn-group bootstrap-select" />
</div>
    <div class="form-custom clr_cstm" style="display:none">
<label class="custom-label">Master Bedroom</label>
<select name="master_bedroom" class="selectpicker" title="Master Bedroom" data-hide-disabled="true">
@for($i=0;$i<=10;$i++)
<option value="{{$i}}">{{$i}}</option>
@endfor
</select>
</div>

<div class="form-custom">
<label class="custom-label">Energy Efficent</label>
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
<label for="checkboxG40" class="css-label "> Sepic Tank</label>
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