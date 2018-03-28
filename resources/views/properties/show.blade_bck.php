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
</style>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCZZVtmb8wiYJ9c1HfLC7KSOoDJS4w1BZ4&callback=initMap">
    </script>
<script type="text/javascript">
   $(document).ready(function() {
      $("#top_nav_8").addClass("active");
});
   function initMap() {
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
      }
</script>
  <div class="bg-opacity-black-70">    
    <div id="map"></div>
     
  </div>
  
<div class="cleafix"></div>
  <form action="{{url('/Filtration')}}" method="post">
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
                <div class="col-sm-12 col-xs-12">
                  <div class="find-home-item custom-select">
                    <input type="text" name="srch_name" id="srch_name" placeholder="Search By Name" class="form-control">
                  </div>
                </div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item custom-select">
                    <select class="selectpicker" name="city" title="Area" data-hide-disabled="true" data-live-search="true">
                      <!-- @if($cities>0)
                      @foreach($cities as $city)
                        <option value="{{$city->city}}">{{$city->city}}</option>
                      @endforeach
                      @endif -->
                      <option value="New York">New York</option>
                                <option value="Los Angeles">Los Angeles</option>
                                <option value="Chicago">Chicago</option>
                                <option value="Houston">Houston</option>
                                <option value="Phoenix">Phoenix</option>
                                <option value="Philadelphia">Philadelphia</option>
                                <option value="San Antonio">San Antonio</option>
                                <option value="San Diego">San Diego</option>
                                <option value="Dallas">Dallas</option>
                                <option value="San Jose">San Jose</option>
                                <option value="Austin">Austin</option>
                                <option value="Jacksonville">Jacksonville</option>
                                <option value="San Francisco">San Francisco</option>
                                <option value="Columbus">Columbus</option>
                                <option value="Indianapolis">Indianapolis</option>
                                <option value="Fort Worth">Fort Worth</option>
                                <option value="Charlotte">Charlotte</option>
                                <option value="Seattle">Seattle</option>
                                <option value="Denver">Denver</option>
                                <option value="El Paso">El Paso</option>
                                <option value="Washington">Washington</option>
                                <option value="Boston">Boston</option>
                                <option value="Detroit">Detroit</option>
                                <option value="Nashville">Nashville</option>
                                <option value="Memphis">Memphis</option>
                                <option value="Portland">Portland</option>
                                <option value="Oklahoma City">Oklahoma City</option>
                                <option value="Las Vegas">Las Vegas</option>
                                <option value="Louisville">Louisville</option>
                                <option value="Baltimore">Baltimore</option>
                                <option value="Milwaukee">Milwaukee</option>
                                <option value="Albuquerque">Albuquerque</option>
                                <option value="Tucson">Tucson</option>
                                <option value="Fresno">Fresno</option>
                                <option value="Sacramento">Sacramento</option>
                                <option value="Mesa">Mesa</option>
                                <option value="Kansas City">Kansas City</option>
                                <option value="Atlanta">Atlanta</option>
                                <option value="Long Beach">Long Beach</option>
                                <option value="Colorado Springs">Colorado Springs</option>
                                <option value="Raleigh">Raleigh</option>
                                <option value="Miami">Miami</option>
                                <option value="Virginia Beach">Virginia Beach</option>
                                <option value="Omaha">Omaha</option>
                                <option value="Oakland">Oakland</option>
                                <option value="Minneapolis">Minneapolis</option>
                                <option value="Tulsa">Tulsa</option>
                                <option value="Arlington">Arlington</option>
                                <option value="New Orleans">New Orleans</option>
                                <option value="Wichita">Wichita</option>
                                <option value="Cleveland">Cleveland</option>
                                <option value="Tampa">Tampa</option>
                                <option value="Bakersfield">Bakersfield</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Honolulu">Honolulu</option>
                                <option value="Anaheim">Anaheim</option>
                                <option value="Santa Ana">Santa Ana</option>
                                <option value="Corpus Christi">Corpus Christi</option>
                                <option value="Riverside">Riverside</option>
                                <option value="Lexington">Lexington</option>
                                <option value="St. Louis">St. Louis</option>
                                <option value="Stockton">Stockton</option>
                                <option value="Pittsburgh">Pittsburgh</option>
                                <option value="Saint Paul">Saint Paul</option>
                                <option value="Cincinnati">Cincinnati</option>
                                <option value="Anchorage">Anchorage</option>
                                <option value="Henderson">Henderson</option>
                                <option value="Greensboro">Greensboro</option>
                                <option value="Plano">Plano</option>
                                <option value="Newark">Newark</option>
                                <option value="Lincoln">Lincoln</option>
                                <option value="Toledo">Toledo</option>
                                <option value="Orlando">Orlando</option>
                                <option value="Chula Vista">Chula Vista</option>
                                <option value="Irvine">Irvine</option>
                                <option value="Fort Wayne">Fort Wayne</option>
                                <option value="Jersey City">Jersey City</option>
                                <option value="Durham">Durham</option>
                                <option value="St. Petersburg">St. Petersburg</option>
                                <option value="Laredo">Laredo</option>
                                <option value="Buffalo">Buffalo</option>
                                <option value="Madison">Madison</option>
                                <option value="Lubbock">Lubbock</option>
                                <option value="Chandler">Chandler</option>
                                <option value="Scottsdale">Scottsdale</option>
                                <option value="Glendale">Glendale</option>
                                <option value="Reno">Reno</option>
                                <option value="Norfolk">Norfolk</option>
                                <option value="Winston Salem">Winston Salem</option>
                                <option value="North Las Vegas">North Las Vegas</option>
                                <option value="Irving">Irving</option>
                                <option value="Chesapeake">Chesapeake</option>
                                <option value="Gilbert">Gilbert</option>
                                <option value="Hialeah">Hialeah</option>
                                <option value="Garland">Garland</option>
                                <option value="Fremont">Fremont</option>
                                <option value="Richmond">Richmond</option>
                                <option value="Boise">Boise</option>
                                <option value="San Bernardino">San Bernardino</option>
                                <option value="Spokane">Spokane</option>
                                <option value="Des Moines">Des Moines</option>
                                <option value="Modesto">Modesto</option>
                                <option value="Birmingham">Birmingham</option>
                                <option value="Tacoma">Tacoma</option>
                                <option value="Fontana">Fontana</option>
                                <option value="Rochester">Rochester</option>
                                <option value="Oxnard">Oxnard</option>
                                <option value="Moreno Valley">Moreno Valley</option>
                                <option value="Fayetteville">Fayetteville</option>
                                <option value="Aurora">Aurora</option>
                                <option value="Glendale">Glendale</option>
                                <option value="Yonkers">Yonkers</option>
                                <option value="Huntington Beach">Huntington Beach</option>
                                <option value="Montgomery">Montgomery</option>
                                <option value="Amarillo">Amarillo</option>
                                <option value="Little Rock">Little Rock</option>
                                <option value="Akron">Akron</option>
                                <option value="Columbus">Columbus</option>
                                <option value="Augusta">Augusta</option>
                                <option value="Grand Rapids">Grand Rapids</option>
                                <option value="Shreveport">Shreveport</option>
                                <option value="Salt Lake City">Salt Lake City</option>
                                <option value="Huntsville">Huntsville</option>
                                <option value="Mobile">Mobile</option>
                                <option value="Tallahassee">Tallahassee</option>
                                <option value="Grand Prairie">Grand Prairie</option>
                                <option value="Overland Park">Overland Park</option>
                                <option value="Knoxville">Knoxville</option>
                                <option value="Port St. Lucie">Port St. Lucie</option>
                                <option value="Worcester">Worcester</option>
                                <option value="Brownsville">Brownsville</option>
                                <option value="Tempe">Tempe</option>
                                <option value="Santa Clarita">Santa Clarita</option>
                                <option value="Newport News">Newport News</option>
                                <option value="Cape Coral">Cape Coral</option>
                                <option value="Providence">Providence</option>
                                <option value="Fort Lauderdale">Fort Lauderdale</option>
                                <option value="Chattanooga">Chattanooga</option>
                                <option value="Rancho Cucamonga">Rancho Cucamonga</option>
                                <option value="Oceanside">Oceanside</option>
                                <option value="Santa Rosa">Santa Rosa</option>
                                <option value="Garden Grove">Garden Grove</option>
                                <option value="Vancouver">Vancouver</option>
                                <option value="Sioux Falls">Sioux Falls</option>
                                <option value="Ontario">Ontario</option>
                                <option value="McKinney">McKinney</option>
                                <option value="Elk Grove">Elk Grove</option>
                                <option value="Jackson">Jackson</option>
                                <option value="Pembroke Pines">Pembroke Pines</option>
                                <option value="Salem">Salem</option>
                                <option value="Springfield">Springfield</option>
                                <option value="Corona">Corona</option>
                                <option value="Eugene">Eugene</option>
                                <option value="Fort Collins">Fort Collins</option>
                                <option value="Peoria">Peoria</option>
                                <option value="Frisco">Frisco</option>
                                <option value="Cary">Cary</option>
                                <option value="Lancaster">Lancaster</option>
                                <option value="Hayward">Hayward</option>
                                <option value="Palmdale">Palmdale</option>
                                <option value="Salinas">Salinas</option>
                                <option value="Alexandria">Alexandria</option>
                                <option value="Lakewood">Lakewood</option>
                                <option value="Springfield">Springfield</option>
                                <option value="Pasadena">Pasadena</option>
                                <option value="Sunnyvale">Sunnyvale</option>
                                <option value="Macon">Macon</option>
                                <option value="Pomona">Pomona</option>
                                <option value="Hollywood">Hollywood</option>
                                <option value="Kansas City">Kansas City</option>
                                <option value="Escondido">Escondido</option>
                                <option value="Clarksville">Clarksville</option>
                                <option value="Joliet">Joliet</option>
                                <option value="Rockford">Rockford</option>
                                <option value="Torrance">Torrance</option>
                                <option value="Naperville">Naperville</option>
                                <option value="Paterson">Paterson</option>
                                <option value="Savannah">Savannah</option>
                                <option value="Bridgeport">Bridgeport</option>
                                <option value="Mesquite">Mesquite</option>
                                <option value="Killeen">Killeen</option>
                                <option value="Syracuse">Syracuse</option>
                                <option value="McAllen">McAllen</option>
                                <option value="Pasadena">Pasadena</option>
                                <option value="Bellevue">Bellevue</option>
                                <option value="Fullerton">Fullerton</option>
                                <option value="Orange">Orange</option>
                                <option value="Dayton">Dayton</option>
                                <option value="Miramar">Miramar</option>
                                <option value="Thornton">Thornton</option>
                                <option value="West Valley City">West Valley City</option>
                                <option value="Olathe">Olathe</option>
                                <option value="Hampton">Hampton</option>
                                <option value="Warren">Warren</option>
                                <option value="Midland">Midland</option>
                                <option value="Waco">Waco</option>
                                <option value="Charleston">Charleston</option>
                                <option value="Columbia">Columbia</option>
                                <option value="Denton">Denton</option>
                                <option value="Carrollton">Carrollton</option>
                                <option value="Surprise">Surprise</option>
                                <option value="Roseville">Roseville</option>
                                <option value="Sterling Heights">Sterling Heights</option>
                                <option value="Murfreesboro">Murfreesboro</option>
                                <option value="Gainesville">Gainesville</option>
                                <option value="Cedar Rapids">Cedar Rapids</option>
                                <option value="Visalia">Visalia</option>
                                <option value="Coral Springs">Coral Springs</option>
                                <option value="New Haven">New Haven</option>
                                <option value="Stamford">Stamford</option>
                                <option value="Thousand Oaks">Thousand Oaks</option>
                                <option value="Concord">Concord</option>
                                <option value="Elizabeth">Elizabeth</option>
                                <option value="Lafayette">Lafayette</option>
                                <option value="Kent">Kent</option>
                                <option value="Topeka">Topeka</option>
                                <option value="Simi Valley">Simi Valley</option>
                                <option value="Santa Clara">Santa Clara</option>
                                <option value="Athens">Athens</option>
                                <option value="Hartford">Hartford</option>
                                <option value="Victorville">Victorville</option>
                                <option value="Abilene">Abilene</option>
                                <option value="Norman">Norman</option>
                                <option value="Vallejo">Vallejo</option>
                                <option value="Berkeley">Berkeley</option>
                                <option value="Round Rock">Round Rock</option>
                                <option value="Ann Arbor">Ann Arbor</option>
                                <option value="Fargo">Fargo</option>
                                <option value="Columbia">Columbia</option>
                                <option value="Allentown">Allentown</option>
                                <option value="Evansville">Evansville</option>
                                <option value="Beaumont">Beaumont</option>
                                <option value="Odessa">Odessa</option>
                                <option value="Wilmington">Wilmington</option>
                                <option value="Arvada">Arvada</option>
                                <option value="Independence">Independence</option>
                                <option value="Provo">Provo</option>
                                <option value="Lansing">Lansing</option>
                                <option value="El Monte">El Monte</option>
                                <option value="Springfield">Springfield</option>
                                <option value="Fairfield">Fairfield</option>
                                <option value="Clearwater">Clearwater</option>
                                <option value="Peoria">Peoria</option>
                                <option value="Rochester">Rochester</option>
                                <option value="Carlsbad">Carlsbad</option>
                                <option value="Westminster">Westminster</option>
                                <option value="West Jordan">West Jordan</option>
                                <option value="Pearland">Pearland</option>
                                <option value="Richardson">Richardson</option>
                                <option value="Downey">Downey</option>
                                <option value="Miami Gardens">Miami Gardens</option>
                                <option value="Temecula">Temecula</option>
                                <option value="Costa Mesa">Costa Mesa</option>
                                <option value="College Station">College Station</option>
                                <option value="Elgin">Elgin</option>
                                <option value="Murrieta">Murrieta</option>
                                <option value="Gresham">Gresham</option>
                                <option value="High Point">High Point</option>
                                <option value="Antioch">Antioch</option>
                                <option value="Inglewood">Inglewood</option>
                                <option value="Cambridge">Cambridge</option>
                                <option value="Lowell">Lowell</option>
                                <option value="Manchester">Manchester</option>
                                <option value="Billings">Billings</option>
                                <option value="Pueblo">Pueblo</option>
                                <option value="Palm Bay">Palm Bay</option>
                                <option value="Centennial">Centennial</option>
                                <option value="Richmond">Richmond</option>
                                <option value="Ventura">Ventura</option>
                                <option value="Pompano Beach">Pompano Beach</option>
                                <option value="North Charleston">North Charleston</option>
                                <option value="Everett">Everett</option>
                                <option value="Waterbury">Waterbury</option>
                                <option value="West Palm Beach">West Palm Beach</option>
                                <option value="Boulder">Boulder</option>
                                <option value="West Covina">West Covina</option>
                                <option value="Broken Arrow">Broken Arrow</option>
                                <option value="Clovis">Clovis</option>
                                <option value="Daly City">Daly City</option>
                                <option value="Lakeland">Lakeland</option>
                                <option value="Santa Maria">Santa Maria</option>
                                <option value="Norwalk">Norwalk</option>
                                <option value="Sandy Springs">Sandy Springs</option>
                                <option value="Hillsboro">Hillsboro</option>
                                <option value="Green Bay">Green Bay</option>
                                <option value="Tyler">Tyler</option>
                                <option value="Wichita Falls">Wichita Falls</option>
                                <option value="Lewisville">Lewisville</option>
                                <option value="Burbank">Burbank</option>
                                <option value="Greeley">Greeley</option>
                                <option value="San Mateo">San Mateo</option>
                                <option value="El Cajon">El Cajon</option>
                                <option value="Jurupa Valley">Jurupa Valley</option>
                                <option value="Rialto">Rialto</option>
                                <option value="Davenport">Davenport</option>
                                <option value="League City">League City</option>
                                <option value="Edison">Edison</option>
                                <option value="Davie">Davie</option>
                                <option value="Las Cruces">Las Cruces</option>
                                <option value="South Bend">South Bend</option>
                                <option value="Vista">Vista</option>
                                <option value="Woodbridge">Woodbridge</option>
                                <option value="Renton">Renton</option>
                                <option value="Lakewood">Lakewood</option>
                                <option value="San Angelo">San Angelo</option>
                                <option value="Clinton">Clinton</option>
                    </select>
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
                  <div class="find-home-item custom-select">
                    <select name="bedrooms" class="selectpicker" title="Bed" data-hide-disabled="true">
                     @for($i=1;$i<=20;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                    </select>
                  </div>
                </div>
                <div class="clearfix"></div>
                <div class="col-sm-3 col-xs-12">
                  <div class="find-home-item custom-select">
                    <select name="bathrooms" class="selectpicker" title="Baths" data-hide-disabled="true">
                    @for($i=1;$i<=20;$i++)
                      <option value="{{$i}}">{{$i}}</option>
                    @endfor
                                        </select>
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
                          <label for="checkbox{{$count}}" class="css-label"><?php echo $value['name']; ?> </label>
                        </a>
                      </li> 
                    <?php if($count==10) { ?>
                    </ul>
                    <ul class="submenu pull-left">
                    <?php } ?>
                    <?php if($count==20) { ?>
                    </ul>
                    <ul class="submenu pull-right">
                    <?php } ?>
                    <?php } ?>    
                    </ul>
                  </fieldset>
                </div>  
              </div>
              <div class="col-md-12 search-drop">
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
                  <div class="row">
                    <div class="col-md-6 special-margin">
                      <div class="form-custom clr_cstm">
                        <label class="custom-label">Location</label>
                        <select id="state_id" name="state_id" class="selectpicker" title="Location" data-hide-disabled="true" data-live-search="true">
                        @foreach($locations as $single)
                        <option value="{{$single->id}}" rel="{{$single->title}}">{{$single->title}}</option>
                        @endforeach
                        </select>
                      </div>
                    <div class="form-custom clr_cstm">
                      <label class="custom-label">Master Bedroom</label>
                      <select name="master_bedroom" class="selectpicker" title="Master Bedroom" data-hide-disabled="true">
                        @for($i=1;$i<=10;$i++)
                          <option value="{{$i}}">{{$i}}</option>
                        @endfor
                      </select>
                    </div>
                    <div class="form-custom clr_cstm">
                      <label class="custom-label">Year Built</label>
                      <select name="year_built" class="selectpicker" title="Year Built" data-hide-disabled="true">
                        <?php $from_year = date("Y",strtotime("-317 year")); ?>
                              @for($i=$from_year;$i<=date('Y');$i++)
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
                      </ul>
                    </div>
                    <div class="form-custom garages">
                      <label class="custom-label">Garage</label>
                      <ul class="submenu pull-left">
                        <li>
                      <input type="radio" name="garages" id="radio101" value="1" >
                      <label for="radio101">  1 Car </label>
                        </li> 
                        <li>
                      <input type="radio" name="garages" id="radio102" value="2" >
                      <label for="radio102">  2 Car </label>
                        </li> 
                        <li>
                      <input type="radio" name="garages" id="radio103" value="3" >
                      <label for="radio103">  3 Car </label>
                        </li> 
                        <li>
                      <input type="radio" name="garages" id="radio104" value="4" >
                      <label for="radio104">  4 Car </label>
                        </li> 
                      </ul>
                    </div>
                  </div>
                <div class="col-md-6">
                  <div class="form-custom">
                    <label class="custom-label">Square Footage</label>
                    <div class="price_filter">
                      <div class="price_slider_amount">           
                        <input type="button"  value="Area :"/>     
                        <input type="text" id="amount1" name="area"  placeholder="Add Your Price" readonly="" />  
                      </div>
                      <div id="slider-range1"></div>
                    </div>         
                  </div>  
                  <div class="form-custom">
                    <label class="custom-label">Beach Access</label>
                    <div class="radio my-radio radio-primary radio-inline">
                      <input type="radio" name="beach_right" id="radio92" value="1">
                      <label for="radio92"> Yes </label>
                    </div> 
                    <div class="radio my-radio radio-primary radio-inline">
                      <input type="radio" name="beach_right" id="radio81" value="0">
                      <label for="radio81">
                        No   
                      </label>
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
                          <h5 class="text-white"><i class="fa fa-envelope"></i> {{$property_user->email}}</h5>
                          <h5 class="text-white"><i class="fa fa-phone"></i> <?php echo preg_replace('/\d{3}/', '$0-', str_replace('.', null, trim($property_user->phone)), 2); ?> </h5>
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
                <div class="col-xs-12"><p class="m-b-20 mt-10"><span class="condition-star">*</span> See <a href="{{url('/pages/term-of-use')}}" target="_blank">Terms and Conditions</a></p></div>
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
                    <p class="m-b-10 mt-10">{{$property->att_fee ? 'Subscribers (seller) pays for closing attorneys fees' : ''}}</p>
                    <p class="m-b-20 mt-10"><span class="condition-star">*</span> See <a href="{{url('/pages/term-of-use')}}" target="_blank">Terms and Conditions</a></p>
                    </div>
                </div>  
              </div>
            </div>
          </div>
          
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
        <?php if (Auth::check() && Auth::user()->role=='owner') {}else{ ?>  
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
          <aside class="widget widget-featured-property">
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
                      @if($property->sale_price!='')
                      <span class="price">${{number_format($property->sale_price,2)}}</span>   
                      @else
                      <span class="price">price not mentioned</span>
                      @endif                                             
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
$("#state_id").change(showmap_search);  
function showmap_search(){
var output = "",$this = $(this);
    if($this.val() != 0){
        output = $this.find('option:selected').attr('rel');
    } 
var showmap = '<iframe width="100%" height="300" src="https://www.mapsdirections.info/en/custom-google-maps/map.php?width=100%&height=400&hl=ru&q='+output+'+(Your%20Town/Province)&ie=UTF8&t=&z=5&iwloc=A&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>' ;
$("#shw_map").html(showmap);  
} 
</script>
<script src="{{asset('js/reservations.js')}}"></script>
@endsection