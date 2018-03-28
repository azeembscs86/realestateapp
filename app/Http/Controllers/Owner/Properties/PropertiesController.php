<?php
namespace App\Http\Controllers\Owner\Properties;
use Redirect;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertiesFormRequest;
use App\Http\Controllers\Owner\OwnerController as Panel;
use Illuminate\Http\Request;
error_reporting(0);
class PropertiesController extends Controller
{
    //List of all properties with actions for edit/add/delete.
    public function index(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        //$properties    = \App\Properties::where('user_id', \Auth::user()->id)->orderBy('id', 'desc')->get();
        $properties    = \App\Properties::where('user_id', \Auth::user()->id)->orderBy('display_order', 'asc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('owner.properties.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('properties', $properties)->with('js', $js);
    }
    public function inquiries(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        if(Auth::user()->role=='owner') {
            $inquiries    = DB::select("SELECT a.*,b.title,b.address,b.city,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and b.user_id='".Auth::user()->id."'"); }
        else
        {
            $inquiries    = DB::select("SELECT a.*,b.title,b.address,b.city,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and a.user_id='".Auth::user()->id."'");
        }
        return view('owner.inquiries.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('inquiries', $inquiries);
    }
    //Form for adding a new property in our database table.
    public function create()
    {
        $categories   = \App\PropertyTypes::orderBy('display_order', 'asc')->get();
        $classes      = \App\PropertyClasses::orderBy('display_order', 'asc')->get();
        $states       = \App\Locations::where('type', 'state')->orderBy('is_active', 1)->orderBy('display_order', 'asc')->get();
        $housekeepers = \App\Facilitators::where('role', 'housekeeper')->where('is_active', '1')->orderBy('firstname', 'asc')->get();
        $vendors      = \App\Facilitators::where('role', 'vendor')->where('is_active', '1')->orderBy('firstname', 'asc')->get();
        $rates        = \App\Seasons::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $amenities    = \App\Amenities::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $features     = \App\Features::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $lifestyles     = DB::table('emt_lifestyle_category')->where('is_active','1')->get();
        $settings     = \App\Settings::find(1);
        $countries     = DB::table('apps_countries')->get();
        $user          = \Auth::user();
        return view('owner.properties.create')->with('settings', $settings)->with('categories', $categories)->with('classes', $classes)->with('states', $states)->with('housekeepers', $housekeepers)->with('vendors', $vendors)->with('rates', $rates)->with('amenities', $amenities)->with('features', $features)->with('lifestyles', $lifestyles)->with('countries',$countries)->with('user', $user);
    }
    //Inserts the form into database table of properties and other tables like, features, amenties, rates, images...
    public function store(Request $request)
    {
        $property        = new \App\Properties();
        if(empty($request->input('title')))
        {
           return redirect('/owner/properties/create')->withErrors('The title field is required.')->withInput();
        }
        if(empty($request->input('category')))
        {
           return redirect('/owner/properties/create')->withErrors('Select Category.')->withInput();
        }
        if(empty($request->input('bedrooms')))
        {
           return redirect('/owner/properties/create')->withErrors('The Bedrooms field is required.')->withInput();
        }
        if(empty($request->input('bathrooms')))
        {
           return redirect('/owner/properties/create')->withErrors('The Bathrooms field is required.')->withInput();
        }
        // if(empty($request->input('garages')))
        // {
        //    return redirect('/owner/properties/create')->withErrors('Select Garages.')->withInput();
        // }
        if(empty($request->input('address')))
        {
           return redirect('/owner/properties/create')->withErrors('The Address field is required.')->withInput();
        }
        if(empty($request->input('city')))
        {
           return redirect('/owner/properties/create')->withErrors('The Town/Province field is required.')->withInput();
        }
        if(empty($request->input('zip')))
        {
           return redirect('/owner/properties/create')->withErrors('The Zip Code field is required.')->withInput();
        }
        if(empty($request->input('year_built')))
        {
           return redirect('/owner/properties/create')->withErrors('Select Year Built.')->withInput();
        }
        // if(empty($request->input('master_bedroom')))
        // {
        //    return redirect('/owner/properties/create')->withErrors('Select Master Bedroom.')->withInput();
        // }
       
        $property->title = $request->input('title');
        $property->slug  = $slug = str_slug($request->input('slug')?$request->input('slug'):$property->title);
        $property->code  = $code = $request->input('code');
        // $duplicate       = \App\Properties::where('slug', $slug)->first();
        // if ($duplicate)
        // {
        //     echo '<script language="javascript">';
        //     echo 'alert("Slug must not be already used!!!.")';
        //     echo '</script>';
        //     exit();
            // return redirect('/admin/properties/create')->withErrors('Slug must not be already used!!!')->withInput();
        //}
        //$duplicate = \App\Properties::where('code', $code)->first();
        // if ($duplicate)
        // {
        //     echo '<script language="javascript">';
        //     echo 'alert("Code/SKU already exists!.")';
        //     echo '</script>';
        //     exit();
            // return redirect('/admin/properties/create')->withErrors('Code/SKU already exists!')->withInput();
        //}
        //The common part of both insert/update code has been put in a single function place called save().
        //Returns success of success, edit, insert id if any.
        list($success, $error, $id) = PropertiesController::save($request, $property);
        //$url="http://107.6.184.93/MatchPropertyDirect/pricing?pid=$id";
        
        //return "<script>window.open('".$url."', '_blank');</script>";
        echo '<script language="javascript">';
            echo 'window.top.location.href = "https://www.matchpropertydirect.com/pricing?pid='.$id.'"';
            echo '</script>';
        //     exit();
        //return redirect('/owner/properties/edit/' . $id)->withMessage($success)->withErrors($error);
    }
    //When you want to enter changes to a specific property
    //Load the edit form
    public function edit($id)
    {
        $property     = \App\Properties::where('id', $id)->first();


        $images       = \App\PropertiesImages::where('property_id', $property->id)->get(); //future: is_active
        $categories   = \App\PropertyTypes::orderBy('display_order', 'asc')->get();
        $classes      = \App\PropertyClasses::orderBy('display_order', 'asc')->get();
        $states       = \App\Locations::where('type', 'state')->where('is_active', 1)->orderBy('display_order', 'asc')->get();
        $housekeepers = \App\Facilitators::where('role', 'housekeeper')->where('is_active', '1')->orderBy('firstname', 'asc')->get();
        $vendors      = \App\Facilitators::where('role', 'vendor')->where('is_active', '1')->orderBy('firstname', 'asc')->get();
        $seasons      = \App\Seasons::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $countries     = DB::table('apps_countries')->get();
        $user          = \Auth::user();
        $rates        = array();
        foreach ($seasons as $season) {
            $Prates = \App\PropertiesRates::where('property_id', $id)->where('season_id', $season->id)->first();
            $array  = (object) array(
                'id' => $season->id,
                'title' => $season->title,
                'season_start_month' => $season->season_start_month,
                'season_start_day' => $season->season_start_day,
                'season_end_month' => $season->season_end_month,
                'season_end_day' => $season->season_end_day,
                'minimum_stay_nights' => @$Prates->minimum_stay_nights,
                'final_payment_days' => @$Prates->final_payment_days,
                'price_daily' => @$Prates->price_daily,
                'is_price_daily' => @$Prates->is_price_daily,
                'price_weekly' => @$Prates->price_weekly,
                'is_price_weekly' => @$Prates->is_price_weekly,
                'price_two_weekly' => @$Prates->price_two_weekly,
                'is_price_two_weekly' => @$Prates->is_price_two_weekly,
                'price_monthly' => @$Prates->price_monthly,
                'is_price_monthly' => @$Prates->is_price_monthly
            );
            array_push($rates, $array);
        } //$seasons as $season
        $amenities       = \App\Amenities::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $amenities_final = array();
        foreach ($amenities as $amenity) {
            $PAmenity = \App\PropertiesAmenities::where('property_id', $id)->where('amenity_id', $amenity->id)->first();
            $array    = (object) array(
                'id' => $amenity->id,
                'title' => $amenity->title,
                'value' => @$PAmenity->value
            );
            array_push($amenities_final, $array);
        } //$amenities as $amenity
        $features       = \App\Features::where('is_active', '1')->orderBy('display_order', 'asc')->get();
        $lifestyles     = DB::table('emt_lifestyle_category')->where('is_active','1')->get();
        $features_final = array();
        foreach ($features as $feature) {
            $PFeature = \App\PropertiesFeatures::where('property_id', $id)->where('feature_id', $feature->id)->first();
            $array    = (object) array(
                'id' => $feature->id,
                'title' => $feature->title,
                'value' => @$PFeature->value,
                'descp' => @$PFeature->feature_descp
            );
            array_push($features_final, $array);
        } //$features as $feature
        return view('owner.properties.edit')->with('property', $property)
        ->with('edit', true)->with('images', $images)
        ->with('categories', $categories)->with('states', $states)
        ->with('classes', $classes)
        ->with('housekeepers', $housekeepers)->with('vendors', $vendors)
        ->with('rates', $rates)
        ->with('amenities', $amenities_final)->with('features', $features_final)->with('lifestyles', $lifestyles)->with('countries',$countries)->with('user', $user);
    }
    //The common part of both insert/update code has been put in a single function place called save().
    public function save($request, $property)
    {
        
        $property->acre        = $request->input('acre');
        $property->country_name      = $request->input('country_name');
        $property->category_id        = $request->input('category');
        $property->currency_code      = $request->input('currency');
        $property->sale_price         = $request->input('sale_price');
        $property->bedrooms           = $request->input('bedrooms');
        $property->bathrooms          = $request->input('bathrooms');
        $property->sleeps             = $request->input('sleeps')? '1' : '0';
        $property->garages            = $request->input('garages');
        $property->minimum_stay_nights            = $request->input('minimum_stay_nights')? '1' : '0';/*upgrade - 12/10/2016 - minimum_nights*/
        $property->address            = $request->input('address');
        $property->city               = $request->input('city');
        $property->state_id           = $request->input('state')? '1' : '0';
        $property->zip                = $request->input('zip');
        $property->latitude           = $request->input('latitude');
        $property->longitude          = $request->input('longitude');
        $property->display_order      = $request->input('display_order');
        $property->is_active          = $request->has('is_active') ? '1' : '1';
        $property->is_featured        = $request->has('is_featured') ? '1' : '0';
        $property->is_new             = $request->has('is_new') ? '1' : '0';
        $property->is_sale            = $request->has('is_sale') ? '1' : '0';
        $property->is_long_term       = $request->has('is_long_term') ? '1' : '0';
        $property->is_vacation        = $request->has('is_vacation') ? '1' : '0';
        $property->is_calendar        = $request->has('is_calendar') ? '1' : '0';
        $property->is_rates           = $request->has('is_rates') ? '1' : '0';
        $property->summary            = $request->input('summary');
        // $property->notes_admin        = $request->input('notes_admin');
        $property->description        = $request->input('description');
        $property->reviews            = $request->input('reviews') ? '1' : '0';
        // $property->is_cleaning_fee    = $request->has('is_cleaning_fee') ? 1 : 0;
        // $property->cleaning_fee_value = $request->input('cleaning_fee_value');
        // $property->is_commission      = $request->has('is_commission') ? 1 : 0;
        // $property->commission_value   = $request->input('commission_value');
        // $property->is_sales_tax       = $request->has('is_sales_tax') ? 1 : 0;
        // $property->sales_tax_value    = $request->input('sales_tax_value');
        // $property->is_lodger_tax      = $request->has('is_lodger_tax') ? 1 : 0;
        // $property->lodger_tax_value   = $request->input('lodger_tax_value');
        // $property->housekeeper_id     = $request->input('housekeeper_id');
        // $property->vendor_id          = $request->input('vendor_id');
        // $property->user_id           = $request->input('user_id');
        // filter fields
        $property->user_id           = Auth::user()->id;
        $property->geo_thermal_heat    = $request->has('geo_thermal_heat') ? 1 : 0;
        $property->solar_panels    = $request->has('solar_panels') ? 1 : 0;
        $property->solar_water_heater    = $request->has('solar_water_heater') ? 1 : 0;
        $property->windmill    = $request->has('windmill') ? 1 : 0;
        $property->energy_star_appliances    = $request->has('energy_star_appliances') ? 1 : 0;
		$property->gas_heater    = $request->has('gas_heater') ? 1 : 0;
	$property->electric_heater    = $request->has('electric_heater') ? 1 : 0;
	$property->trash_drop_off    = $request->has('trash_drop_off') ? 1 : 0;
	$property->city_trash_removal    = $request->has('city_trash_removal') ? 1 : 0;
	$property->sepic_tank    = $request->has('sepic_tank') ? 1 : 0;
	$property->city_sewer    = $request->has('city_sewer') ? 1 : 0;
	$property->city_water    = $request->has('city_water') ? 1 : 0;
	$property->well_water    = $request->has('well_water') ? 1 : 0;
	$property->ac_central    = $request->has('ac_central') ? 1 : 0;
	$property->ac_window_units    = $request->has('ac_window_units') ? 1 : 0;
	$property->ac_european_room_unit    = $request->has('ac_european_room_unit') ? 1 : 0;
	
        $property->beach_right = $request->input('beach_right') ? 1 : 0;
        $property->staff_accomodation = $request->input('staff_accomodation') ? 1 : 0;
        $property->heat_type = $request->input('heat_type') ? 1 : 0;
        $property->gated_property = $request->input('gated_property') ? 1 : 0;
        $property->gated_property = $request->input('gated_property') ? 1 : 0;
        $property->tennis_court = $request->input('tennis_court') ? 1 : 0;
        $property->central_air_conditioning = $request->input('central_air_conditioning') ? 1 : 0;
        $property->fireplace = $request->input('fireplace') ? 1 : 0;
        $property->year_built = $request->input('year_built');
        $property->master_bedroom = $request->input('master_bedroom');
        $property->waterfrontage = $request->input('waterfrontage');
        $property->docking = $request->input('docking') ? 1 : 0;
        $property->pool = $request->input('pool') ? 1 : 0;
        $property->one_storey = $request->input('one_storey') ? 1 : 0;
        $property->two_storey = $request->input('two_storey') ? 1 : 0;
        $property->hot_tub = $request->input('hot_tub') ? 1 : 0;
        $property->hurrican_impact = $request->input('hurrican_impact') ? 1 : 0;
        $property->hurrican_impact_panel = $request->input('hurrican_impact_panel') ? 1 : 0;
        $property->masterbedroom1st = $request->input('masterbedroom1st') ? 1 : 0;
        $property->att_fee = $request->input('att_fee') ? 1 : 0;

        if(!empty($request->input('lifestyle_category')))
        {
            $property->lifestyle_category = implode(",", $request->input('lifestyle_category'));
        }
        $property->area = $request->input('area');
        if(!empty($request->input('att_name')))
        {
            $property->att_name = $request->input('att_name');
        }
        if(!empty($request->input('att_email')))
        {
            $property->att_email = $request->input('att_email');
        }
        if(!empty($request->input('att_phone')))
        {
            $property->att_phone = $request->input('att_phone');
        }
        if(!empty($request->input('att_pobox')))
        {
            $property->att_pobox = $request->input('att_pobox');
        }
        if(!empty($request->input('att_city')))
        {
            $property->att_city = $request->input('att_city');
        }
        if(!empty($request->input('att_state')))
        {
            $property->att_state = $request->input('att_state');
        }
        if(!empty($request->input('att_zipcode')))
        {
            $property->att_zipcode = $request->input('att_zipcode');
        }
        if(!empty($request->input('att_address')))
        {
            $property->att_address = $request->input('att_address');
        }
        
        $property->save();
        $property_id = $property->id;

        $propertyClasses = \App\PropertiesClasses::where('property_id', $property->id);
        $propertyClasses->delete();
        if(null!==$request->input('classes')){
        foreach ($request->input('classes') as $class) {
            $propertyClass              = new \App\PropertiesClasses();
            $propertyClass->property_id = $property->id;
            $propertyClass->class_id    = $class;
            $propertyClass->save();
        }
        }
       //@$success .= 'Property has been successfully saved.<br/>';
        
        if (!empty($property_id)) {
            $fileprefix = 'property-';
            $filepath   = 'pictures/';
            for ($i = 1; $i <= $request->input('images_total'); $i++) {
                if ($request->has('image_delete_' . $i)) {
                    $PImage = \App\PropertiesImages::find($request->get('image_delete_' . $i));
                    $PImage->delete();
                } //$request->has('picture_delete_' . $i)
                if ($request->get('image_db_id_' . $i) != 'NA') {
                    $propertyImage = \App\PropertiesImages::find($request->get('image_db_id_' . $i));
                } //$request->get('image_db_id_' . $i) != 'NA'
                else {
                    $propertyImage = new \App\PropertiesImages();
                }
                $filename = str_replace('tmp/', '', $request->input('tmp_img_path_' . $i));
                if (is_file('tmp/' . $filename)) {
                    \File::move('tmp/' . $filename, $filepath . $fileprefix . $filename);
                    $propertyImage->property_id = $property_id;
                    $propertyImage->image       = $filepath . $fileprefix . $filename;
                    $propertyImage->is_active   = '1';
                    $propertyImage->save();
                    //@$success .= 'Image saved: ' . $propertyImage->image . ' <br/>';

                            $source = $filepath.$fileprefix.$filename;
                            $filesmall = $filepath.$fileprefix.'small-'.$filename;
                            $percent = 0.5;

                            // Get new sizes
                            list($width, $height) = getimagesize($source);
                   
                            $newwidth = $width * $percent;
                            $newheight = $height * $percent;
                        
                            $source = imagecreatefrompng($source);
                            $dest = imagecreatetruecolor($newwidth, $newheight);
                            imagealphablending($dest, false);
                            imagesavealpha($dest,true);
                            $transparent = imagecolorallocatealpha($dest, 255, 255, 255, 127);
                            imagefilledrectangle($dest, 0, 0, $newwidth, $newheight, $transparent);
                            $result = imagecopyresampled($dest, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

                            if ($result) {
                            if (!imagepng($dest,$filesmall)) {
                            @$error .= "Failed to save the resized image file";
                            } //
                            } //$result
                            else {
                            @$error .= "Failed to resize the image file";
                            }

                            imagedestroy($source);
                            imagedestroy($dest);
                            
                    $propertyImage->image_small       = $filesmall;
                    $propertyImage->save();
                    //@$success .= 'Small image saved: ' . $propertyImage->image_small . ' <br/>';

                } //is_file('tmp/' . $filename)
            } //$i = 1; $i <= $request->input('images_total'); $i++
            $property->minimum_stay_nights = $request->get('minimum_stay_nights') ? '1' : '0';;
            $property->final_payment_days  = $request->get('final_payment_days');
            $property->price_daily         = $request->get('price_daily');
            $property->is_price_daily      = $request->has('is_price_daily') ? '1' : '0';
            $property->price_weekly        = $request->get('price_weekly');
            $property->is_price_weekly     = $request->has('is_price_weekly') ? '1' : '0';
            $property->price_two_weekly    = $request->get('price_two_weekly');
            $property->is_price_two_weekly = $request->has('is_price_two_weekly') ? '1' : '0';
            $property->price_monthly       = $request->get('price_monthly');
            $property->is_price_monthly    = $request->has('is_price_monthly') ? '1' : '0';
            $property->save();
            //@$success .= 'Regular prices saved.<br/>';
            $PRates = \App\PropertiesRates::where('property_id', $property_id);
            $PRates->delete();
            $seasons = \App\Seasons::where('is_active', '1')->orderBy('display_order', 'asc')->get();
            foreach ($seasons as $season) {
                $month   = $season->season_start_month;
                $day     = $season->season_start_day;
                $endloop = $season->season_end_month . '-' . $season->season_end_day;
                $date    = '';
                while (1 < 2) { //unlimited loop
                    if ($date == $endloop) {
                        break;
                    } //$date == $endloop
                    while ($day <= 31) {
                        $date                              = $month . '-' . $day;
                        $propertyRate                      = new \App\PropertiesRates();
                        $propertyRate->property_id         = $property_id;
                        $propertyRate->season_id           = $season->id;
                        $propertyRate->date                = $date;
                        $propertyRate->minimum_stay_nights = $request->get('minimum_stay_nights_' . $season->id);
                        $propertyRate->final_payment_days  = $request->get('final_payment_days_' . $season->id);
                        $propertyRate->price_daily         = $request->get('price_daily_' . $season->id);
                        $propertyRate->is_price_daily      = $request->has('is_price_daily_' . $season->id) ? '1' : '0';
                        $propertyRate->price_weekly        = $request->get('price_weekly_' . $season->id);
                        $propertyRate->is_price_weekly     = $request->has('is_price_weekly_' . $season->id) ? '1' : '0';
                        $propertyRate->price_two_weekly    = $request->get('price_two_weekly_' . $season->id);
                        $propertyRate->is_price_two_weekly = $request->has('is_price_two_weekly_' . $season->id) ? '1' : '0';
                        $propertyRate->price_monthly       = $request->get('price_monthly_' . $season->id);
                        $propertyRate->is_price_monthly    = $request->has('is_price_monthly_' . $season->id) ? '1' : '0';
                        $propertyRate->save();
                        if ($date == $endloop) {
                            break;
                        } //$date == $endloop
                        $day++;
                    } //$day <= 31
                    $day = 1;
                    if ($month == '12')
                        $month = 1;
                    else
                        $month++;
                } //1 < 2
                unset($date);
                //@$success .= $season->title.' prices saved.<br/>';
            } //$seasons as $season
            //@$success .= 'Prices saved.<br/>';
            $PFeatures = \App\PropertiesFeatures::where('property_id', $property_id);
            $PFeatures->delete();
            $features = \App\Features::where('is_active', '1')->orderBy('display_order', 'asc')->get();
            foreach ($features as $feature) {
                $propertyFeature              = new \App\PropertiesFeatures();
                $propertyFeature->property_id = $property_id;
                $propertyFeature->feature_id  = $feature->id;
                $propertyFeature->value       = $request->get('feature_value_' . $feature->id);
                $propertyFeature->feature_descp  = $request->get('feature_descp_' . $feature->id);
                $propertyFeature->save();
            } //$features as $feature
            //@$success .= 'Features have been added.<br/>';
            $PAmenities = \App\PropertiesAmenities::where('property_id', $property_id);
            $PAmenities->delete();
            $amenities = \App\Amenities::where('is_active', '1')->orderBy('display_order', 'asc')->get();
            foreach ($amenities as $amenity) {
                $propertyAmenity              = new \App\PropertiesAmenities();
                $propertyAmenity->property_id = $property_id;
                $propertyAmenity->amenity_id  = $amenity->id;
                if ($request->has('amenity_value_' . $amenity->id)) {
                    $propertyAmenity->value = $request->get('amenity_value_' . $amenity->id);
                } //$request->has('amenity_value_' . $amenity->id)
                else {
                    $propertyAmenity->value = 'No';
                }
                $propertyAmenity->save();
            } //$amenities as $amenity
            //@$success .= 'Amenities have been added.<br/>';
        } //!empty($property_id)
        @$success .= 'Propertysaved';
        //return redirect('/owner/properties')->withMessage($success);
        return array(
            @$success,
            @$error,
            $property_id
        );
            // echo '<script language="javascript">';
            // echo 'alert("Property has been saved successfully.")';
            // echo '</script>';
            // exit();
    }
    //Update the database when you submit the edit form
    public function update(PropertiesFormRequest $request)
    {
        $id              = $request->input('id');
        $property        = \App\Properties::find($id);

        $property->title = $request->input('title');
        $property->slug  = $slug = str_slug($property->title);
        $property->code  = $code = $request->input('code');
        $duplicate       = \App\Properties::where('slug', $slug)->where('id', '!=', $id)->first();
        if ($duplicate)
            return redirect('/owner/properties/edit/' . $id)->withErrors('Slug must not be already used!')->withInput();
        $duplicate = \App\Properties::where('code', $code)->where('id', '!=', $id)->first();
        if ($duplicate)
            //return redirect('/owner/properties/edit/' . $id)->withErrors('Code/SKU already exists!')->withInput();
        list($success, $error, $id) = PropertiesController::save($request, $property);
        return redirect('/owner/properties/edit/' . $id)->withMessage($success)->withErrors($error);
    }
    //Delete a property and its sub items
    public function destroy(Request $request, $id)
    {
        $PImage = \App\PropertiesImages::where('property_id', $id);
        $PImage->delete();
        $PRates = \App\PropertiesRates::where('property_id', $id);
        $PRates->delete();
        $PFeatures = \App\PropertiesFeatures::where('property_id', $id);
        $PFeatures->delete();
        $PAmenities = \App\PropertiesAmenities::where('property_id', $id);
        $PAmenities->delete();
        $property = \App\Properties::find($id);
        $property->delete();
        $success = '<h4><i class="fa fa-trash-o" aria-hidden="true"></i> Property Deleted</h4>';
        return redirect('/owner/properties')->withMessage($success);
    }
    public function sold(Request $request, $id)
    {
        DB::table('emt_properties')->where('id',$id)->update(['is_sold'=>'1']);
        $success = 'Property has been marked as Sold<br/>';
        return redirect('/owner/properties')->withMessage($success);
    }
}
