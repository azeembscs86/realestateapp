<!-- This view file shows resulted items in response of user's search -->

@extends('layouts.default.start')

<!-- Goes to html>head>title -->

@section('title')

Search Results - {{$settings->site_title}}

@endsection

<!-- Yields body of the page inside the template -->

@section('contents')

<!-- Page Content -->

<style type="text/css">
    #state_id{
      margin-bottom: 0px;
    }
  .page-header-bg:before {

    <?php if(count($properties)>'0'){ ?>

    background-image: url('{{asset($properties[0]->images->first()->image)}}');

    <?php } ?>

	

}

.wrapper { padding-bottom:50px; }

</style>
   <div class="breadcrumbs-area bread-bg-3 bg-opacity-black-70">    
		<div class="container">         
			<div class="row">        
				<div class="col-xs-12">     
					<div class="breadcrumbs">        
						<h2 class="breadcrumbs-title">{{count($properties)}} results found!</h2>  
						<ul class="breadcrumbs-list">           				
							<li><a href="{{url()}}">Home</a></li>
							<li><a href="{{url('types/')}}">Properties</a></li>
							<li class="active">
							   Search
							</li>      
						</ul>                  
					</div>         
				</div>         
			</div>            
		</div>        
	</div>
<form action="{{url('/Filtration')}}" method="post" class="m-t-0 result-cont">
  <section id="page-content" class="page-wrapper">        
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
                <div class="col-sm-12 col-xs-12">
                    <div class="find-home-item custom-select" style="display:none">
                    <input type="text" name="srch_name" id="srch_name" placeholder="Search by Name" class="form-control">
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
                <!--Remove location field-->
                <div class="col-sm-3 col-xs-12" style="display: none">
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
                    @for($i=1;$i<=50;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    </select>
                  </div>
                </div>
                <!--Remove Property Type field-->
                
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
              <div class="col-md-12 search-drop" style="display: none;">
                <div class="row"> 
                  <fieldset class="my-field-set p-b-7">
                    <legend class="my-legend">Distance</legend>
                    <p>Multiple options can be selected</p>
                    <!-- <div class="price_filter p-b-15">
                      <div class="price_slider_amount">           
                        <input type="button"  value="Distance :"/>     
                        <input type="text" id="amount2" name="distance"  placeholder="Add Your Price" readonly="" />                                                            </div>
                      <div id="slider-range2"></div>
                    </div>-->  
                    <ul class="submenu pull-left distance-list">
                    <?php $count1=1; ?>
                    @if($emt_features>0)
                    @foreach($emt_features as $single)
                    <?php $count1++; ?>
                      <li>
                        <a href="#">
                          <input type="checkbox" name="features[]" id="checkboxF{{$count1}}" class="css-checkbox" value="{{$single->id}}" />
                          <label for="checkboxF{{$count1}}" class="css-label"> {{$single->title}}</label>
                        </a>
                      </li> 
                      @endforeach
                    @endif     
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
    <div class="col-md-12">
    
     <div class="form-custom clr_cstm">
        <label class="custom-label">Location</label>
        <input type="text" id="state_id" name="state_id"  placeholder="Location" class="btn-group bootstrap-select" />
    </div>
        
    </div>
    
    </div>    
<div class="row">
<div class="col-md-6 form-custom">
<div class="  custom-select">
                <label class="custom-label">Year Built</label>
                    <select name="year_built" class="selectpicker inner-select space-bot" title="Year Built" data-hide-disabled="true">
                        <?php $from_year = date("Y",strtotime("-318 year")); ?>
                              @for($i=$from_year;$i<=date('Y');$i++)
                              <?php $sorting_arr[] = $i; rsort($sorting_arr); ?>
                              @endfor
                              <?php for($j=0;$j<count($sorting_arr);$j++){ ?>
                              <option value="<?php echo $sorting_arr[$j]; ?>"><?php echo $sorting_arr[$j]; ?></option>
                              <?php } ?>
                      </select>
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
</section>
</form>
<div class="container page-body filtr-cs">
<?php $searchedtab = 'sale'; ?>
  <!-- /.row -->
  <main>
  @include('include.alerts')
<?php
$filters = array();
$filters_check = array();
foreach($properties as $property){
foreach($property->classez as $class){
  if(!in_array($class->theclass->slug, $filters_check)) 
    {
      $filter = (object) ['slug'=>$class->theclass->slug,'title'=>$class->theclass->title];
      array_push($filters, $filter);
      array_push($filters_check, $class->theclass->slug);
    }
}
}
?>
<!-- List of Properties -->
    <section class="row" id="filter-results">

    <?php if(count($properties)=='0'){ ?>

<script>
 
    /*  $(document).ready(function(){

        $(".inline").colorbox({inline:true, width:"50%"});

        });*/

    </script>

      <h2 style="text-align: center">Sorry. No results matching your search criteria were found. If you want to be notified by email when the property is available. <?php echo $searh_name; ?> <a class='inline' style="text-decoration: underline;" href="#"  data-toggle="modal" data-target="#notification">Click Here</a></h2>


<!-- Modal -->
<div id="notification" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Notify</h4>
      </div>
      <div class="modal-body">
        <form name="customer_notification" id="customer_notification" method="post" action="{{url('/customnotify')}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

       <input type="hidden" name="searchkey" id="searchkey" value="<?php echo $searh_name; ?>">

       <input type="hidden" name="cityname" id="cityname" value="<?php echo $city_name; ?>">

       <input type="hidden" name="minprice" id="minprice" value="<?php echo $minprice; ?>">

       <input type="hidden" name="maxprice" id="maxprice" value="<?php echo $maxprice; ?>">

       <input type="hidden" name="bedrooms_no" id="bedrooms_no" value="<?php echo $bedrooms_no; ?>">

       <input type="hidden" name="bathrooms_no" id="bathrooms_no" value="<?php echo $bathrooms_no; ?>"> 

       <input type="hidden" name="categoryid" id="categoryid" value="<?php echo $categoryid; ?>">

       <input type="hidden" name="stateid" id="stateid" value="<?php echo $stateid; ?>">

       <input type="hidden" name="masterbedroom" id="masterbedroom" value="<?php echo $masterbedroom; ?>">

       <input type="hidden" name="yearbuilt" id="yearbuilt" value="<?php echo $yearbuilt; ?>">

       <input type="hidden" name="garages_no" id="garages_no" value="<?php echo $garages_no; ?>">

       <input type="hidden" name="beachright" id="beachright" value="<?php echo $beachright; ?>">

       <input type="hidden" name="staffaccomodation" id="staffaccomodation" value="<?php echo $staffaccomodation; ?>">

       <input type="hidden" name="heattype" id="heattype" value="<?php echo $heattype; ?>">

       <input type="hidden" name="gatedproperty" id="gatedproperty" value="<?php echo $gatedproperty; ?>">

       <input type="hidden" name="tenniscourt" id="tenniscourt" value="<?php echo $tenniscourt; ?>">

       <input type="hidden" name="central_air" id="central_air" value="<?php echo $central_air; ?>">

       <input type="hidden" name="fireplace_no" id="fireplace_no" value="<?php echo $fireplace_no; ?>">

       <input type="email" name="customeremail" id="customeremail" required="required" placeholder="Please enter your email" style="padding-left: 15px !important;margin-bottom: 15px !important;color: #000 !important;">

       <input type="submit" name="submit" id="submit" value="submit" class="submit-btn-1 register_btn btn-md btn-about" style="margin-top: 10px;border: 0;">

      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<style type="text/css">
	@media only screen and (max-width : 480px){
	.submit-btn-1.register_btn.btn-md.btn-about{
		width: 100%;
	}
}
</style>
      <!--<div style='display:none'>

      <div id='inline_content' style='padding:10px; background:#fff;'>

      <p><strong>Notify</strong></p>

      <form name="customer_notification" id="customer_notification" method="post" action="{{url('/customnotify')}}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

       <input type="hidden" name="searchkey" id="searchkey" value="<?php echo $searh_name; ?>">

       <input type="hidden" name="cityname" id="cityname" value="<?php echo $city_name; ?>">

       <input type="hidden" name="minprice" id="minprice" value="<?php echo $minprice; ?>">

       <input type="hidden" name="maxprice" id="maxprice" value="<?php echo $maxprice; ?>">

       <input type="hidden" name="bedrooms_no" id="bedrooms_no" value="<?php echo $bedrooms_no; ?>">

       <input type="hidden" name="bathrooms_no" id="bathrooms_no" value="<?php echo $bathrooms_no; ?>"> 

       <input type="hidden" name="categoryid" id="categoryid" value="<?php echo $categoryid; ?>">

       <input type="hidden" name="stateid" id="stateid" value="<?php echo $stateid; ?>">

       <input type="hidden" name="masterbedroom" id="masterbedroom" value="<?php echo $masterbedroom; ?>">

       <input type="hidden" name="yearbuilt" id="yearbuilt" value="<?php echo $yearbuilt; ?>">

       <input type="hidden" name="garages_no" id="garages_no" value="<?php echo $garages_no; ?>">

       <input type="hidden" name="beachright" id="beachright" value="<?php echo $beachright; ?>">

       <input type="hidden" name="staffaccomodation" id="staffaccomodation" value="<?php echo $staffaccomodation; ?>">

       <input type="hidden" name="heattype" id="heattype" value="<?php echo $heattype; ?>">

       <input type="hidden" name="gatedproperty" id="gatedproperty" value="<?php echo $gatedproperty; ?>">

       <input type="hidden" name="tenniscourt" id="tenniscourt" value="<?php echo $tenniscourt; ?>">

       <input type="hidden" name="central_air" id="central_air" value="<?php echo $central_air; ?>">

       <input type="hidden" name="fireplace_no" id="fireplace_no" value="<?php echo $fireplace_no; ?>">

       <input type="email" name="customeremail" id="customeremail" required="required">

       <input type="submit" name="submit" id="submit" value="submit" class="submit-btn-1 register_btn btn-md btn-about" style="margin-top: 10px;border: 0;">

      </form>

      </div>

    </div>-->

    <?php }else{ ?>

      @foreach ($properties as $property)

      @include('properties._search-sale-article')

      @endforeach

    <?php } ?>

    </section>

  <!-- End List of Properties -->

    <hr/>

  </main>

</div>

<!-- /.container -->

@endsection

@section('javascript')

<script src="{{ asset('js/jquery.shuffle.min.js') }}" type="text/javascript"></script>

<script>

    $(document).ready(function() {

      /* initialize shuffle plugin */

      var $grid = $('#filter-results');

      $grid.shuffle({

        itemSelector: '.item' // the selector for the items in the grid

      });

      /* reshuffle when user clicks a filter item */

      $('#filter-options a').click(function (e) {

        e.preventDefault();

        // set active class

        $('#filter-options a').removeClass('active');

        $(this).addClass('active');

        // get group name from clicked item

        var groupName = $(this).attr('data-group');

        // reshuffle grid

        $grid.shuffle('shuffle', groupName );

      });

    });

  </script>

  <script type="text/javascript">
   $(document).ready(function() {
      $("#top_nav_8").addClass("active");
});
   function initMap() {
      $("#dynamic_map").hide();
     var city = document.getElementById('city');
     var autocompletecity = new google.maps.places.Autocomplete(city);
     autocompletecity.addListener('place_changed', function() {
     var placcitye   = autocompletecity.getPlace();        
    if (!placcitye.geometry) {
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
@endsection