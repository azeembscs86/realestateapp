<?php
namespace App\Http\Controllers;
use Redirect,input,DB,Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SelectDatesController as SelectDates;
use App\Http\Controllers\NavigationController as Nav;
use App\Http\Controllers\Admin\PropertyTypes\PropertyTypesController as PropertyTypes;
use App\Http\Controllers\Admin\Locations\LocationsController as Locations;
use App\Http\Requests\FrontendPropertiesSearch;
use Illuminate\Http\Request;
class PropertiesController extends Controller
{
    //Shows view page of a property detail
    public function show(Request $request, Nav $nav, $slug, $pre_select_date_start = 'NA', $pre_select_date_end = 'NA')
    {
        $property    = \App\Properties::where('slug', $slug)->first();
        $property_id = $property->id;
        $property_user_id = $property->user_id;
        $amenities = \App\Amenities::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $features = \App\Features::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $ratesX   = \DB::table('emt_seasons as S')->where('S.is_active', '1')->leftJoin('emt_properties_rates as PR', 'S.id', '=', 'PR.season_id')->where('PR.property_id', $property->id)->orderBy('S.display_order', 'asc')->groupBy('S.id')->get();
        $rates             = \App\Seasons::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $lineitems         = \App\LineItems::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $clicked_features = DB::select("SELECT a.*,b.title FROM emt_properties_features a,emt_features b where a.property_id='".$property_id."' and a.feature_id=b.id and a.value!=''");
        $featured_properties        = \App\Properties::where('is_featured', '1')->where('is_active', '1')->where('pay_subscription', 1)->orderBy('display_order', 'asc')->take(5)->get();

        //custom filter options
        $cities = DB::select("select DISTINCT(city) from emt_properties");
        $property_types = DB::table('emt_property_types')->where('is_active','1')->get();
        $lifestyles = DB::table('emt_lifestyle_category')->where('is_active','1')->get();
        $emt_features = DB::table('emt_features')->where('is_active','1')->get();
        $property_user = DB::table('users')->where('id',$property_user_id)->first();

        return view('properties.show')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('property', $property)->with('amenities', $amenities)
        ->with('features', $features)->with('rates', $rates)
        ->with('lineitems', $lineitems)->with('pre_select_date_start', $pre_select_date_start)
        ->with('pre_select_date_end', $pre_select_date_end)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties)->with('cities', $cities)->with('property_types', $property_types)->with('lifestyles', $lifestyles)->with('emt_features', $emt_features)->with('clicked_features', $clicked_features)->with('featured_properties', $featured_properties)->with('property_user', $property_user);
    }
    //Shows view page of a property detail for Sale
    public function showSale(Request $request, Nav $nav, $slug, $pre_select_date_start = 'NA', $pre_select_date_end = 'NA')
    {
        $property    = \App\Properties::where('slug', $slug)->first();
        $property_id = $property->id;
        $amenities = \App\Amenities::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $features = \App\Features::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $ratesX   = \DB::table('emt_seasons as S')->where('S.is_active', '1')->leftJoin('emt_properties_rates as PR', 'S.id', '=', 'PR.season_id')->where('PR.property_id', $property->id)->orderBy('S.display_order', 'asc')->groupBy('S.id')->get();
        $rates             = \App\Seasons::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $lineitems         = \App\LineItems::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        return view('properties.show-sale')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('property', $property)->with('amenities', $amenities)
        ->with('features', $features)->with('rates', $rates)
        ->with('lineitems', $lineitems)->with('pre_select_date_start', $pre_select_date_start)
        ->with('pre_select_date_end', $pre_select_date_end)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties);
    }
    //Shows view page of a property detail for reservation
    public function showReserve(Request $request, Nav $nav, $slug, $pre_select_date_start = 'NA', $pre_select_date_end = 'NA')
    {
        $property    = \App\Properties::where('slug', $slug)->first();
        $property_id = $property->id;
        $amenities = \App\Amenities::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $features = \App\Features::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $ratesX   = \DB::table('emt_seasons as S')->where('S.is_active', '1')->leftJoin('emt_properties_rates as PR', 'S.id', '=', 'PR.season_id')->where('PR.property_id', $property->id)->orderBy('S.display_order', 'asc')->groupBy('S.id')->get();
        $rates             = \App\Seasons::where('is_active', 1)->with(array(
            'added' => function($query) use ($property_id)
            {
                $query->where('property_id', $property_id)->get();
            }
        ))->orderBy('display_order', 'asc')->get();
        $lineitems         = \App\LineItems::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        return view('properties.show-reserve')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('property', $property)->with('amenities', $amenities)
        ->with('features', $features)->with('rates', $rates)
        ->with('lineitems', $lineitems)->with('pre_select_date_start', $pre_select_date_start)
        ->with('pre_select_date_end', $pre_select_date_end)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties);
    }



    //Shows categories/types for properties to chose one.
    public function types(Nav $nav)
    {
        $categories        = \App\PropertyTypes::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        return view('properties.types')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties);
    }
    //Shows properties under a specific category/type
    public function indexByType($slug, Nav $nav)
    {
        $category          = \App\PropertyTypes::where('slug', $slug)->first();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $properties        = \App\Properties::where('category_id', $category->id)->where('is_active', '1')->where('pay_subscription', 1)->orderBy('display_order', 'asc')->get();
        
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        //custom filter options
        $cities = DB::select("select DISTINCT(city) from emt_properties");
        $property_types = DB::table('emt_property_types')->where('is_active','1')->get();
        $lifestyles = DB::table('emt_lifestyle_category')->where('is_active','1')->get();
        $features = DB::table('emt_features')->where('is_active','1')->get();
        return view('properties.type')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('category', $category)->with('properties', $properties)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties)->with('cities', $cities)->with('property_types', $property_types)->with('lifestyles', $lifestyles)->with('features', $features);
    }
    //Searches vacation properties available for booking between given dates.
    public function saleSearchRedirect(FrontendPropertiesSearch $request)
    {
            $type = (null!==@$request->get('category'))?$request->get('category'):'all';
            $location = (null!==@$request->get('location'))?$request->get('location'):'all';
            return redirect('sale/search/' . $type . '/' . $location . '/' . $request->input('sleeps'));
    }
    public function saleSearch(Nav $nav, PropertyTypes $propertytypes, Locations $locations, $type = 'all', $location = 'all', $sleeps = '1')
    {

        if($type=='all' AND $location=='all'){

                $properties = \App\Properties::where('is_active', 1)
                ->where('is_sale', 1)
                ->where('sleeps', '>=', $sleeps)
                ->orderBy('display_order','asc')->get();

                //dd(__LINE__. $properties );

        }elseif($type<>'all' AND $location=='all'){

                $category_id = $propertytypes->getPropertyTypeID($type);
                $properties = \App\Properties::where('is_active', 1)
                ->where('is_sale', 1)
                ->where('sleeps', '>=', $sleeps)
                ->where('category_id', $category_id)
                ->orderBy('display_order','asc')->get();

        }elseif($type=='all' AND $location<>'all'){

                $location_id = $locations->getLocationID($location);
                $properties = \App\Properties::where('is_active', 1)
                ->where('is_sale', 1)
                ->where('sleeps', '>=', $sleeps)
                ->where('state_id', $location_id)
                ->orderBy('display_order','asc')->get();

        }else{

                $location_id = $locations->getLocationID($location);
                $category_id = $propertytypes->getPropertyTypeID($type);
                $properties = \App\Properties::where('is_active', 1)
                ->where('is_sale', 1)
                ->where('sleeps', '>=', $sleeps)
                ->where('state_id', $location_id)
                ->where('category_id', $category_id)
                ->orderBy('display_order','asc')->get();
        }  

        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        return view('properties.search-sale')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)->with('selectedtype', $type)->with('selectedlocation', $location)
        ->with('sleeps', $sleeps)->with('properties', $properties)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties);
    }


    //Searches vacation properties available for booking between given dates.
    public function rentalSearchRedirect(FrontendPropertiesSearch $request)
    {
        if ( null!==@$request->get('arrival') and null!==@$request->get('departure') ) {
            
            if(empty($request->get('arrival')) or empty($request->get('departure'))){
                return redirect('rental/search')->withErrors('Search fields can not be empty')->withInput();
            }
            $type = (null!==@$request->get('category'))?$request->get('category'):'all';
            return redirect('rental/search/' . $type . '/' . date('Y-m-d', strtotime($request->input('arrival'))) . '/' . date('Y-m-d', strtotime($request->input('departure'))) . '/' . $request->input('sleeps'));
        } //empty($date_start) or empty($date_end)    //Searches vacation properties available for booking between given dates.
    }
    public function rentalSearch(Nav $nav, SelectDates $selectdates, $type = 'all', PropertyTypes $propertytypes, $date_start = '', $date_end = '', $sleeps = '')
    {

        $date_start = date('Y-m-d', strtotime($date_start));
        $date_end   = date('Y-m-d', strtotime($date_end));
        $selectdates->saveDatesSearchedToSession($date_start, $date_end);
        
        if($type=='all'){

                $properties_vacation = \App\Properties::where('is_active', 1)
                ->where('is_vacation', 1)
                ->where('sleeps', '>=', $sleeps)
                ->with(array(
                    'calendar' => function($query) use ($date_start, $date_end)
                    {
                        $query->whereBetween('date',[$date_start,$date_end])->get();
                    }
                ))->orderBy('display_order','asc')->get();

        }else{

                $category_id = $propertytypes->getPropertyTypeID($type);
                $properties_vacation = \App\Properties::where('is_active', 1)
                ->where('is_vacation', 1)
                ->where('sleeps', '>=', $sleeps)
                ->where('category_id', $category_id)
                ->with(array(
                    'calendar' => function($query) use ($date_start, $date_end)
                    {
                        $query->whereBetween('date',[$date_start,$date_end])->get();
                    }
                ))->orderBy('display_order','asc')->get();
        }  


        $properties          = array();
        $nights            = intval((strtotime($date_end) - strtotime($date_start)) / 86400);
        foreach ($properties_vacation as $property) {
            if (count($property->calendar) == 0) {
                //Available - Property has no dates booked on the calendar 
                $property->price    = $selectdates->calculateLodgingPrice($property->slug, $date_start, $date_end);
                if($property->minimum_stay_nights<=$nights){/*upgrade - 12/10/2016 - minimum_nights*/
                    array_push($properties, $property);
                }

            } //count($property->calendar) == 0
        } //$properties_vacation as $property
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        return view('properties.search-rental')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)->with('selectedtype', $type)
        ->with('date_start', date('m/d/Y', strtotime($date_start)))
        ->with('date_end', date('m/d/Y', strtotime($date_end)))
        ->with('nights', $nights)->with('sleeps', $sleeps)->with('properties', $properties)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties);
    }

    public function Filtration(Nav $nav,Request $request)
    {
        $query = \App\Properties::where('is_active', 1)->where('pay_subscription',1);

        if(!empty($request->input('srch_name'))){
        $query->where('title', 'LIKE',"%{$request->input('srch_name')}%");
        }
        if(!empty($request->input('city'))){
        $query->where('city', $request->input('city'));
        }
        if(!empty($request->input('min_price'))){
        $query->where('sale_price', '>=' , $request->input('min_price'));
        }
        if(!empty($request->input('max_price'))){
        $query->where('sale_price', '<=' , $request->input('max_price'));
        }
        if(!empty($request->input('min_area'))){
        $query->where('area', '>=' , $request->input('min_area'));
        }
        if(!empty($request->input('max_area'))){
        $query->where('area', '<=' , $request->input('max_area'));
        }
        if(!empty($request->input('bedrooms'))){
        $query->where('bedrooms', $request->input('bedrooms'));
        }
        if(!empty($request->input('bathrooms'))){
        $query->where('bathrooms', $request->input('bathrooms'));
        }
        if(!empty($request->input('category_id'))){
        $query->where('category_id', $request->input('category_id'));
        }
        if(!empty($request->input('state_id'))){
        $query->where('state_id', $request->input('state_id'));
        }
        if(!empty($request->input('master_bedroom'))){
        $query->where('master_bedroom', $request->input('master_bedroom'));
        }
        if(!empty($request->input('year_built'))){
        $query->where('year_built', $request->input('year_built'));
        }
        if(!empty($request->input('garages'))){
        $query->where('garages', $request->input('garages'));
        }
        if($request->input('beach_right')!=''){
        $query->where('beach_right', $request->input('beach_right'));
        }
        if($request->input('staff_accomodation')!=''){
        $query->where('staff_accomodation', $request->input('staff_accomodation'));
        }
        if($request->input('heat_type')!=''){
        $query->where('heat_type', $request->input('heat_type'));
        }
        if($request->input('gated_property')!=''){
        $query->where('gated_property', $request->input('gated_property'));
        }
        if($request->input('tennis_court')!=''){
        $query->where('tennis_court', $request->input('tennis_court'));
        }
        if($request->input('central_air_conditioning')!=''){
        $query->where('central_air_conditioning', $request->input('central_air_conditioning'));
        }
        if($request->input('fireplace')!=''){
        $query->where('fireplace', $request->input('fireplace'));
        }
        if(!empty($request->input('features')))
        {
            $featuers = $request->input('features');
            $distance = $request->input('distance');
            $actual_value = explode("-", $distance);
            $min_value = trim($actual_value[0]);
            $max_full_value = trim($actual_value[1]);
            $max_actual_value = explode(" ", $max_full_value);
            $max_value = trim($max_actual_value[0]);
            $all_feature_ids = [];
            foreach ($featuers as $single) {
                $get_all_features = DB::select("select property_id from emt_properties_features where feature_id='".$single."' and value>=".$min_value." and value<=".$max_value."");
                $get_all_features = array_map(function ($value) {
                return (array)$value;
                }, $get_all_features);
                foreach ($get_all_features as $value) {
                   $all_feature_ids[] = $value['property_id']; 
                }
                 
            }
            $query->whereIn('id', $all_feature_ids);
        }
        if(!empty($request->input('lifestyle')))
        {
            $lifestyle = $request->input('lifestyle');
            $all_ids = [];
            foreach ($lifestyle as $single) {
                $get_all = DB::select("select id from emt_properties where find_in_set(".$single.",lifestyle_category)");
                $get_all = array_map(function ($value) {
                return (array)$value;
                }, $get_all);
                foreach ($get_all as $value) {
                   $all_ids[] = $value['id']; 
                }
                 
            }
             $query->whereIn('id', $all_ids);
        }
       
        //$properties = $query->orderBy('display_order','asc')->get();
        $properties = $query->orderBy('display_order','asc')->get();
        $settings          = \App\Settings::find(1);
        $menu_top          = $nav->getHTMLNavigation();
        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();
        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        //custom filter options
        $cities = DB::select("select DISTINCT(city) from emt_properties");
        $property_types = DB::table('emt_property_types')->where('is_active','1')->get();
        $lifestyles = DB::table('emt_lifestyle_category')->where('is_active','1')->get();
        $emt_features = DB::table('emt_features')->where('is_active','1')->get();
        return view('properties.search-sale')->with('settings', $settings)->with('menu_top', $menu_top)
        ->with('categories', $categories)->with('locations', $locations)
        ->with('properties', $properties)
        ->with('footer_pages', $footer_pages)->with('footer_properties', $footer_properties)->with('cities', $cities)->with('property_types', $property_types)->with('lifestyles', $lifestyles)->with('emt_features', $emt_features)->with('searh_name', $request->input('srch_name'))->with('city_name', $request->input('city'))->with('minprice', $request->input('min_price'))->with('maxprice', $request->input('max_price'))->with('bedrooms_no', $request->input('bedrooms'))->with('bathrooms_no', $request->input('bathrooms_no'))->with('categoryid', $request->input('category_id'))->with('stateid', $request->input('state_id'))->with('masterbedroom', $request->input('master_bedroom'))->with('yearbuilt', $request->input('year_built'))->with('garages_no', $request->input('garages'))->with('beachright', $request->input('beach_right'))->with('staffaccomodation', $request->input('staff_accomodation'))->with('heattype', $request->input('heat_type'))->with('gatedproperty', $request->input('gated_property'))->with('tenniscourt', $request->input('tennis_court'))->with('central_air', $request->input('central_air_conditioning'))->with('fireplace_no', $request->input('fireplace'));
    }
    public function chatredirect($id,$agent_id)
    {
        session_start();
        $_SESSION['chat_ses_id'] = $id;
        $_SESSION['chat_ses_agent_id'] = $agent_id;
        return redirect('chat');
    }
    public function registerredirect()
    {
        return redirect('login')->withMessage("Please login as a user before proceed to chat. If you don't have an account with Match Property Direct please proceed to signup.");

    }
    public function customnotify(Request $request)
    {
        $searchkey = $request->input('searchkey');
        $customeremail = $request->input('customeremail');
        $cityname = $request->input('cityname');
        $minprice = $request->input('minprice');
        $maxprice = $request->input('maxprice');
        $bedrooms_no = $request->input('bedrooms_no');
        $bathrooms_no = $request->input('bathrooms_no');
        $categoryid = $request->input('categoryid');
        $stateid = $request->input('stateid');
        $masterbedroom = $request->input('masterbedroom');
        $yearbuilt = $request->input('yearbuilt');
        $garages_no = $request->input('garages_no');
        $beachright = $request->input('beachright');
        $staffaccomodation = $request->input('staffaccomodation');
        $heattype = $request->input('heattype');
        $gatedproperty = $request->input('gatedproperty');
        $tenniscourt = $request->input('tenniscourt');
        $central_air = $request->input('central_air');
        $fireplace_no = $request->input('fireplace_no');

        DB::insert("insert into emt_usernotification (customer_email,search_txt,city_name,minprice,maxprice,bedrooms_no,bathrooms_no,categoryid,stateid,masterbedroom,yearbuilt,garages_no,beachright,staffaccomodation,heattype,gatedproperty,tenniscourt,central_air,fireplace_no) values ('".$customeremail."','".$searchkey."','".$cityname."','".$minprice."','".$maxprice."','".$bedrooms_no."','".$bathrooms_no."','".$categoryid."','".$stateid."','".$masterbedroom."','".$yearbuilt."','".$garages_no."','".$beachright."','".$staffaccomodation."','".$heattype."','".$gatedproperty."','".$tenniscourt."','".$central_air."','".$fireplace_no."')");
       return redirect('/searchnotification');
    }
    
    
    
     public function getPropertyByLocation(Request $request)
    {
        $city_name    = $request->input('city_name');           
        $searchString = ',';  
        if( strpos($city_name, $searchString) !== false ) {
           $emt_features = DB::table('emt_properties')
                   ->join('emt_properties_images', 'emt_properties.id', '=', 'emt_properties_images.property_id')
                   ->select ("emt_properties.title","emt_properties.slug","emt_properties.latitude","emt_properties.longitude","emt_properties.address","emt_properties.description", "emt_properties_images.image")
                   ->where('emt_properties.city',$city_name)->get();
           return response(json_encode($emt_features));
        }else
        {         
         $emt_features = DB::table('emt_properties')
                 ->join('emt_properties_images', 'emt_properties.id', '=', 'emt_properties_images.property_id')
                 ->select ("emt_properties.title","emt_properties.slug","emt_properties.latitude","emt_properties.longitude","emt_properties.address","emt_properties.description", "emt_properties_images.image")
                 ->where('emt_properties.country',$city_name)->get();
         return response(json_encode($emt_features));
        }
    }
    
    
}
