<?php
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Patterns

Route::pattern('id', '\d+');
Route::pattern('slug', '[a-z0-9-]+');
Route::pattern('date_start', '[a-z0-9-]+');
Route::pattern('date_end', '[a-z0-9-]+');
Route::pattern('dates_searched', '[a-z0-9-]+');
Route::pattern('property', '[a-z0-9-]+');
Route::pattern('sleeps', '\d+');
Route::pattern('uniqid', '[a-z0-9]');
Route::pattern('category', '[a-z0-9-]+');
Route::pattern('page', '[a-z0-9-]+');
Route::pattern('scope', '[a-z0-9-]+');
Route::pattern('year', '\d+');
Route::pattern('month', '\d+');
Route::pattern('owner_id', '\d+');
Route::pattern('user_id', '\d+');
Route::pattern('housekeeper_id', '\d+');
Route::pattern('vendor_id', '\d+');
Route::pattern('group_name', '[a-z0-9-]+');
//Route::pattern('pre_select_date_start', '[a-z0-9-]+');
//Route::pattern('pre_select_date_end', '[a-z0-9-]+');
Route::pattern('reservation_id', '[A-Z0-9]+');
Route::pattern('date1', '[a-z0-9-]+');
Route::pattern('date2', '[a-z0-9-]+');
Route::pattern('width', '\d+');
Route::pattern('height', '\d+');
Route::pattern('db_id', '[a-zA-Z0-9]+');
Route::pattern('deletable', '[A-Z]+');
Route::pattern('number', '[a-zA-Z0-9]+');
//Route::pattern('preview_image', '[a-z0-9-]+');
//Route::pattern('tmp_img_path', '[a-z0-9-]+');

Route::get('/db-dump', function () {
    

$file = "dumps/database.sql";
if (File::isFile($file))
{
    $contents = File::get($file);
    DB::unprepared($contents);
    return 'Successfully DUMPED!';
}else{
    return 'Failed to DUMP!';
}


});
// Admin area

Route::get('admin',
function ()
  { //Redirect the admin default page to dashboard.
    return redirect('/admin/dashboard');
  });

//Laravel's default Auth/Password controllers.
Route::controllers(['auth' => 'Auth\AuthController', 'password' => 'Auth\PasswordController', ]);


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['auth', 'admin']],
function ()
  {
    Route::get('/dashboard', ['uses' => 'AdminController@dashboard']); // Dashboard
    Route::get('/sortable/update', ['uses' => 'SortableController@update']); // Updates the display order of entries.
    Route::get('/sortable', ['uses' => 'SortableController@index']); // Loads the view of display order.
    Route::group(['prefix' => 'reservations', 'namespace' => 'Reservations'],
    function ()
      {
        Route::get('/', 'ReservationsController@index'); // show list of Reservations
        Route::get('/search/{date_start?}/{date_end?}', 'ReservationsController@search'); // show new Reservations form
        Route::get('/create/{property?}/{date_start?}/{date_end?}', 'ReservationsController@create'); // save new Reservations
        Route::post('/store/{slug}', 'ReservationsController@store'); // save new Reservations
        Route::get('/show/{id}', 'ReservationsController@show'); // show list of Reservations
        Route::post('/approve', 'ReservationsController@approve'); // approve Reservations
        Route::get('/edit/{slug}', 'ReservationsController@edit'); // edit Reservations form
        Route::post('/update', 'ReservationsController@update'); // update Reservations
        Route::get('/delete/{id}', 'ReservationsController@destroy'); // delete Reservations
      });
    Route::group(['prefix' => 'inquiries', 'namespace' => 'Properties'],
    function ()
      {
        Route::get('/', 'PropertiesController@inquiries'); // show new Properties form
      });
    Route::get('/calendar-view/{year?}/{month?}', ['uses' => 'Reservations\ReservationsController@calendarView']); //Shows all reservations in a month
    Route::group(['prefix' => 'transactions', 'namespace' => 'Transactions'],
    function ()
      {
        Route::get('/', 'TransactionsController@index'); // show list of Transactions
        Route::get('/create', 'TransactionsController@create'); // show new Transactions form
        Route::post('/create', 'TransactionsController@store'); // save new Transactions
        Route::get('/edit/{slug}', 'TransactionsController@edit'); // edit Transactions form
        Route::post('/update', 'TransactionsController@update'); // update Transactions
        Route::get('/delete/{id}', 'TransactionsController@destroy'); // delete Transactions
      });
    Route::group(['prefix' => 'maintenance-jobs', 'namespace' => 'MaintenanceJobs'],
    function ()
      {
        Route::get('/', 'MaintenanceJobsController@index'); // show list of MaintenanceJobs
        Route::get('/create', 'MaintenanceJobsController@create'); // show new MaintenanceJobs form
        Route::post('/create', 'MaintenanceJobsController@store'); // save new MaintenanceJobs
        Route::get('/edit/{slug}', 'MaintenanceJobsController@edit'); // edit MaintenanceJobs form
        Route::post('/update', 'MaintenanceJobsController@update'); // update MaintenanceJobs
        Route::get('/delete/{id}', 'MaintenanceJobsController@destroy'); // delete MaintenanceJobs
      });
    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'],
    function ()
      {
        Route::get('/', 'ReportsController@index'); // run Reports
        Route::get('/owners/{date_start?}/{date_end?}/{owner_id?}', 'ReportsController@owners'); // run Reports
        Route::get('/housekeepers/{date_start?}/{date_end?}/{housekeeper_id?}', 'ReportsController@housekeepers'); // run Reports
        Route::get('/vendors/{date_start?}/{date_end?}/{vendor_id?}', 'ReportsController@vendors'); // run Reports
      });
    Route::group(['prefix' => 'properties', 'namespace' => 'Properties'],
    function ()
      {
        Route::get('/messages', 'PropertiesController@messages'); // show new Properties form
        Route::get('/messages/{from_uname}/{to_uname}', 'PropertiesController@messagesfilter'); // show new Properties form
         // show new Properties form
        Route::get('/create', 'PropertiesController@create'); // show new Properties form
        Route::post('/create', 'PropertiesController@store'); // save new Properties
        Route::get('/edit/{slug}', 'PropertiesController@edit'); // edit Properties form
        Route::post('/update', 'PropertiesController@update'); // update Properties
        Route::get('/delete/{id}', 'PropertiesController@destroy'); // delete Properties
        Route::get('/sold/{id}', 'PropertiesController@sold'); // delete Properties
        Route::get('/{scope?}', 'PropertiesController@index'); // show list of Properties
      });
    Route::group(['prefix' => 'deleteproperties', 'namespace' => 'Deleteproperties'],
    function ()
      {
        Route::get('/', 'PropertiesDeleteController@index'); // show list of deletepropery Properties
        Route::get('/delete/{id}', 'PropertiesDeleteController@destroy'); // delete Properties
      });
    Route::group(['prefix' => 'marksoldproperties', 'namespace' => 'Marksoldproperties'],
    function ()
      {
        Route::get('/', 'PropertiesMarksoldController@index'); // show list of deletepropery Properties
        Route::get('/sold/{id}', 'PropertiesMarksoldController@sold'); // Sold Properties
      });
    Route::group(['prefix' => 'amenities', 'namespace' => 'Amenities'],
    function ()
      {
        Route::get('/', 'AmenitiesController@index'); // show list of Amenities
        Route::get('/create', 'AmenitiesController@create'); // show new Amenities form
        Route::post('/create', 'AmenitiesController@store'); // save new Amenities
        Route::get('/edit/{slug}', 'AmenitiesController@edit'); // edit Amenities form
        Route::post('/update', 'AmenitiesController@update'); // update Amenities
        Route::get('/delete/{id}', 'AmenitiesController@destroy'); // delete Amenities
      });

    Route::group(['prefix' => 'lifestyle', 'namespace' => 'Amenities'],
    function ()
      {
        Route::get('/', 'AmenitiesController@lifestyle'); // show list of Amenities
        Route::get('/create', 'AmenitiesController@createlifestyle'); // show new Amenities form
        Route::post('/create', 'AmenitiesController@storelifestyle'); // save new Amenities
        Route::get('/edit/{slug}', 'AmenitiesController@editlifestyle'); // edit Amenities form
        Route::post('/update', 'AmenitiesController@updatelifestyle'); // update Amenities
        Route::get('/delete/{id}', 'AmenitiesController@deletelifestyle'); // delete Amenities
      });
    Route::group(['prefix' => 'features', 'namespace' => 'Features'],
    function ()
      {
        Route::get('/', 'FeaturesController@index'); // show list of Features
        Route::get('/create', 'FeaturesController@create'); // show new Features form
        Route::post('/create', 'FeaturesController@store'); // save new Features
        Route::get('/edit/{slug}', 'FeaturesController@edit'); // edit Features form
        Route::post('/update', 'FeaturesController@update'); // update Features
        Route::get('/delete/{id}', 'FeaturesController@destroy'); // delete Features
      });    
    Route::group(['prefix' => 'services', 'namespace' => 'Services'],
    function ()
      {
        Route::get('/', 'ServicesController@index'); // show list of Services
        Route::get('/create', 'ServicesController@create'); // show new Services form
        Route::post('/create', 'ServicesController@store'); // save new Services
        Route::get('/edit/{slug}', 'ServicesController@edit'); // edit Services form
        Route::post('/update', 'ServicesController@update'); // update Services
        Route::get('/delete/{id}', 'ServicesController@destroy'); // delete Services
      });
    Route::group(['prefix' => 'line-items', 'namespace' => 'LineItems'],
    function ()
      {
        Route::get('/', 'LineItemsController@index'); // show list of LineItems
        Route::get('/create', 'LineItemsController@create'); // show new LineItems form
        Route::post('/create', 'LineItemsController@store'); // save new LineItems
        Route::get('/edit/{slug}', 'LineItemsController@edit'); // edit LineItems form
        Route::post('/update', 'LineItemsController@update'); // update LineItems
        Route::get('/delete/{id}', 'LineItemsController@destroy'); // delete LineItems
      });
    Route::group(['prefix' => 'seasons', 'namespace' => 'Seasons'],
    function ()
      {
        Route::get('/', 'SeasonsController@index'); // show list of Seasons
        Route::get('/create', 'SeasonsController@create'); // show new Seasons form
        Route::post('/create', 'SeasonsController@store'); // save new Seasons
        Route::get('/edit/{slug}', 'SeasonsController@edit'); // edit Seasons form
        Route::post('/update', 'SeasonsController@update'); // update Seasons
        Route::get('/delete/{id}', 'SeasonsController@destroy'); // delete Seasons
      });
    Route::group(['prefix' => 'property-types', 'namespace' => 'PropertyTypes'],
    function ()
      {
        Route::get('/', 'PropertyTypesController@index'); // show list of PropertyTypes
        Route::get('/create', 'PropertyTypesController@create'); // show new PropertyTypes form
        Route::post('/create', 'PropertyTypesController@store'); // save new PropertyTypes
        Route::get('/edit/{slug}', 'PropertyTypesController@edit'); // edit PropertyTypes form
        Route::post('/update', 'PropertyTypesController@update'); // update PropertyTypes
        Route::get('/delete/{id}', 'PropertyTypesController@destroy'); // delete PropertyTypes
      });
    Route::group(['prefix' => 'property-classes', 'namespace' => 'PropertyClasses'],
    function ()
      {
        Route::get('/', 'PropertyClassesController@index'); // show list of PropertyClasses
        Route::get('/create', 'PropertyClassesController@create'); // show new PropertyClasses form
        Route::post('/create', 'PropertyClassesController@store'); // save new PropertyClasses
        Route::get('/edit/{slug}', 'PropertyClassesController@edit'); // edit PropertyClasses form
        Route::post('/update', 'PropertyClassesController@update'); // update PropertyClasses
        Route::get('/delete/{id}', 'PropertyClassesController@destroy'); // delete PropertyClasses
      });
    Route::group(['prefix' => 'facilitators', 'namespace' => 'Facilitators'],
    function ()
      {
        Route::get('/', 'FacilitatorsController@index'); // show list of Facilitators
        Route::get('/create', 'FacilitatorsController@create'); // show new Facilitators form
        Route::post('/create', 'FacilitatorsController@store'); // save new Facilitators
        Route::get('/edit/{slug}', 'FacilitatorsController@edit'); // edit Facilitators form
        Route::post('/update', 'FacilitatorsController@update'); // update Facilitators
        Route::get('/delete/{id}', 'FacilitatorsController@destroy'); // delete Facilitators
      });
    Route::group(['prefix' => 'owners', 'namespace' => 'Owners'],
    function ()
      {
        Route::get('/', 'OwnersController@index'); // show list of Owners
        Route::get('/userlist', 'OwnersController@indexuser'); // show list of Owners
        Route::get('/create', 'OwnersController@create'); // show new Owners form
        Route::get('/createuser', 'OwnersController@createuser'); // show new Owners form
        Route::post('/create', 'OwnersController@store'); // save new Owners
        Route::post('/createuser', 'OwnersController@storeuser'); // save new Owners
        Route::get('/edit/{slug}', 'OwnersController@edit'); // edit Owners form
        Route::get('/edituser/{slug}', 'OwnersController@edituser'); // edit Owners form
        Route::post('/update', 'OwnersController@update'); // update Owners
        Route::post('/updateuser', 'OwnersController@updateuser'); // update Owners
        Route::get('/delete/{id}', 'OwnersController@destroy'); // delete Owners
        Route::get('/deleteuser/{id}', 'OwnersController@destroyuser'); // delete Owners
        //----------------route added by azeem--------------------------------
        Route::get('/user-reference', 'OwnersController@referenceUser'); // show list of Reference users 
      });
    Route::group(['prefix' => 'sliders', 'namespace' => 'Sliders'],
    function ()
      {
        Route::get('/', 'SlidersController@index'); // show list of Sliders
        Route::get('/create', 'SlidersController@create'); // show new Sliders form
        Route::post('/create', 'SlidersController@store'); // save new Sliders
        Route::get('/edit/{slug}', 'SlidersController@edit'); // edit Sliders form
        Route::post('/update', 'SlidersController@update'); // update Sliders
        Route::get('/delete/{id}', 'SlidersController@destroy'); // delete Sliders
      });
    Route::group(['prefix' => 'pages', 'namespace' => 'Pages'],
    function ()
      {
        Route::get('/index', 'PagesController@index'); // show list of Pages
        Route::get('/create/', 'PagesController@create'); // show new Page form
        Route::post('/create', 'PagesController@store'); // save new Page
        Route::get('/edit/{slug}', 'PagesController@edit'); // edit Page form
        Route::post('/update', 'PagesController@update'); // update Page
        Route::get('/delete/{id}', 'PagesController@destroy'); // delete Page
      });
    Route::group(['prefix' => 'news', 'namespace' => 'News'],
    function ()
      {
        Route::get('/', 'NewsController@index'); // show list of News
        Route::get('/create', 'NewsController@create'); // show new News form
        Route::post('/create', 'NewsController@store'); // save new News
        Route::get('/edit/{slug}', 'NewsController@edit'); // edit News form
        Route::post('/update', 'NewsController@update'); // update News
        Route::get('/delete/{id}', 'NewsController@destroy'); // delete News
      });
    Route::group(['prefix' => 'events', 'namespace' => 'Events'],
    function ()
      {
        Route::get('/', 'EventsController@index'); // show list of Events
        Route::get('/create', 'EventsController@create'); // show new Event form
        Route::post('/create', 'EventsController@store'); // save new Event
        Route::get('/edit/{slug}', 'EventsController@edit'); // edit Event form
        Route::post('/update', 'EventsController@update'); // update Event
        Route::get('/delete/{id}', 'EventsController@destroy'); // delete Event
      });
    Route::group(['prefix' => 'email-templates', 'namespace' => 'EmailTemplates'],
    function ()
      {
        Route::get('/', 'EmailTemplatesController@index'); // show list of EmailTemplates
        Route::get('/edit/{slug}', 'EmailTemplatesController@edit'); // edit EmailTemplates form
        Route::post('/update', 'EmailTemplatesController@update'); // update EmailTemplates
        Route::get('/delete/{id}', 'EmailTemplatesController@destroy'); // delete EmailTemplates
      });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'],
    function ()
      {
        Route::get('/', 'UserController@edit'); // show list of Users
        Route::post('/update', 'UserController@update'); // update Users
      });
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'],
    function ()
      {
        Route::get('/', 'SettingsController@edit'); // show form for Settings
        Route::post('/update', 'SettingsController@update'); // update Settings
      });
    Route::group(['prefix' => 'navigation', 'namespace' => 'Navigation'],
    function ()
      {
        Route::get('/{group_name?}', 'NavigationController@index'); // show list of Navigation
        Route::get('/create/{group_name?}', 'NavigationController@create'); // show new Navigation form
        Route::post('/create', 'NavigationController@store'); // save new Navigation
        Route::get('/edit/{slug}', 'NavigationController@edit'); // edit Navigation form
        Route::post('/update', 'NavigationController@update'); // update Navigation
        Route::post('/updatenavigationstatus', 'NavigationController@updatenavigationstatus'); // update Navigation
        Route::post('/updatenavigationnesting', 'NavigationController@updatenavigationnesting'); // update Navigation
        Route::get('/delete/{id}', 'NavigationController@destroy'); // delete Navigation
      });
    Route::group(['prefix' => 'locations', 'namespace' => 'Locations'],
    function ()
      {
        Route::get('/', 'LocationsController@index'); // show list of Locations
        Route::get('/create', 'LocationsController@create'); // show new Locations form
        Route::post('/create', 'LocationsController@store'); // save new Locations
        Route::get('/edit/{slug}', 'LocationsController@edit'); // edit Locations form
        Route::post('/update', 'LocationsController@update'); // update Locations
        Route::get('/delete/{id}', 'LocationsController@destroy'); // delete Locations
      });
      Route::group(['prefix' => 'coupons', 'namespace' => 'Coupons'],
      function ()
      {
        Route::get('/','CouponsController@index'); //  show list of coupons
        Route::get('/create', 'CouponsController@create'); // show new Coupon form
        Route::post('/create', 'CouponsController@store'); // save new Coupon
        Route::get('/edit/{slug}', 'CouponsController@edit'); // edit Coupon form
        Route::post('/update', 'CouponsController@update'); // update Coupon
        Route::get('/delete/{id}', 'CouponsController@destroy'); // delete Coupon
        Route::get('/deletecoupon/{slug}', 'CouponsController@deletecoupon'); // show new Coupon form
        Route::post('/destroy', 'CouponsController@destroy'); // save new Coupon
        Route::get('/premenantdelete/{slug}', 'CouponsController@premenantDelete'); // delete Coupon
        Route::post('/deletepremenants', 'CouponsController@premenantDelete'); // update Coupon
      });
      
  });
// End of admin area
// Owner area


Route::get('owner',
function ()
  { //Redirect the admin default page to dashboard.
    return redirect('/owner/dashboard');
  });
Route::group(['prefix' => 'owner', 'namespace' => 'Owner', 'middleware' => ['auth', 'owner']],
function ()
  {
    Route::get('/dashboard', ['uses' => 'OwnerController@dashboard']); // Dashboard

    Route::group(['prefix' => 'reservations', 'namespace' => 'Reservations'],
    function ()
      {
        Route::get('/', 'ReservationsController@index'); // show list of Reservations
        Route::get('/search/{date_start?}/{date_end?}', 'ReservationsController@search'); // show new Reservations form
        Route::get('/create/{property?}/{date_start?}/{date_end?}', 'ReservationsController@create'); // save new Reservations
        Route::post('/store/{slug}', 'ReservationsController@store'); // save new Reservations
        Route::get('/show/{id}', 'ReservationsController@show'); // show list of Reservations
        Route::post('/approve', 'ReservationsController@approve'); // approve Reservations
        Route::get('/edit/{slug}', 'ReservationsController@edit'); // edit Reservations form
        Route::post('/update', 'ReservationsController@update'); // update Reservations
        Route::get('/delete/{id}', 'ReservationsController@destroy'); // delete Reservations
      });
    Route::get('/calendar-view/{year?}/{month?}', ['uses' => 'Reservations\ReservationsController@calendarView']); //Shows all reservations in a month
    Route::group(['prefix' => 'transactions', 'namespace' => 'Transactions'],
    function ()
      {
        Route::get('/', 'TransactionsController@index'); // show list of Transactions
        Route::get('/create', 'TransactionsController@create'); // show new Transactions form
        Route::post('/create', 'TransactionsController@store'); // save new Transactions
        Route::get('/edit/{slug}', 'TransactionsController@edit'); // edit Transactions form
        Route::post('/update', 'TransactionsController@update'); // update Transactions
        Route::get('/delete/{id}', 'TransactionsController@destroy'); // delete Transactions
      });

    Route::group(['prefix' => 'reports', 'namespace' => 'Reports'],
    function ()
      {
        Route::get('/', 'ReportsController@index'); // run Reports
        Route::get('/owners/{date_start?}/{date_end?}/{owner_id?}', 'ReportsController@owners'); // run Reports
        Route::get('/housekeepers/{date_start?}/{date_end?}/{housekeeper_id?}', 'ReportsController@housekeepers'); // run Reports
        Route::get('/vendors/{date_start?}/{date_end?}/{vendor_id?}', 'ReportsController@vendors'); // run Reports
      });
    Route::group(['prefix' => 'properties', 'namespace' => 'Properties'],
    function ()
      {
        Route::get('/create', 'PropertiesController@create'); // show new Properties form
        Route::get('/inquiries', 'PropertiesController@inquiries'); // show new Properties form
        Route::post('/create', 'PropertiesController@store'); // save new Properties
        Route::get('/edit/{slug}', 'PropertiesController@edit'); // edit Properties form
        Route::post('/update', 'PropertiesController@update'); // update Properties
        Route::get('/delete/{id}', 'PropertiesController@destroy'); // delete Properties
        Route::get('/sold/{id}', 'PropertiesController@sold');
        Route::get('/{scope?}', 'PropertiesController@index'); // show list of Properties
      });
    Route::group(['prefix' => 'inquiries', 'namespace' => 'Properties'],
    function ()
      {
        Route::get('/', 'PropertiesController@inquiries'); // show new Properties form
      });
    Route::group(['prefix' => 'deleteproperties', 'namespace' => 'Deleteproperties'],
    function ()
      {
        Route::get('/', 'PropertiesDeleteController@index'); // show list of deletepropery Properties
        Route::get('/delete/{id}', 'PropertiesDeleteController@destroy'); // delete Properties
      });
    Route::group(['prefix' => 'marksoldproperties', 'namespace' => 'Marksoldproperties'],
    function ()
      {
        Route::get('/', 'PropertiesMarksoldController@index'); // show list of deletepropery Properties
        Route::get('/sold/{id}', 'PropertiesMarksoldController@sold'); // Sold Properties
      });
    Route::group(['prefix' => 'users', 'namespace' => 'Users'],
    function ()
      {
        Route::get('/', 'UserController@edit'); // show list of Users
        Route::post('/update', 'UserController@update'); // update Users
        Route::get('/amazon-referral-program', 'UserController@shareSignUpLink'); // show form for share signup link edit by azeem
        Route::post('/signuplink', 'UserController@sendSignUpLink'); // show form for send email signup link edit by azeem
      });
    Route::group(['prefix' => 'settings', 'namespace' => 'Settings'],
    function ()
      {
        Route::get('/', 'SettingsController@edit'); // show form for Settings
        Route::post('/update', 'SettingsController@update'); // update Settings
      });
    Route::group(['prefix' => 'navigation', 'namespace' => 'Navigation'],
    function ()
      {
        Route::get('/{group_name?}', 'NavigationController@index'); // show list of Navigation
        Route::get('/create/{group_name?}', 'NavigationController@create'); // show new Navigation form
        Route::post('/create', 'NavigationController@store'); // save new Navigation
        Route::get('/edit/{slug}', 'NavigationController@edit'); // edit Navigation form
        Route::post('/update', 'NavigationController@update'); // update Navigation
        Route::post('/updatenavigationstatus', 'NavigationController@updatenavigationstatus'); // update Navigation
        Route::post('/updatenavigationnesting', 'NavigationController@updatenavigationnesting'); // update Navigation
        Route::get('/delete/{id}', 'NavigationController@destroy'); // delete Navigation
      });
    
  });

// End of owner area

//FRONTEND
Route::get('/', ['uses' => 'PagesController@homeVersion']); // Website's home page.
Route::get('/home/{version?}', ['uses' => 'PagesController@homeVersion']); // Website's home version ##.
Route::get('/welcome', ['uses' => 'PagesController@home']); // Website's home page.


Route::post('/property-by-location', ['uses' => 'PropertiesController@getPropertyByLocation']);

// AJAX

Route::get('/select-dates/{property}/{year?}/{month?}/{pre_select_date_start?}/{pre_select_date_end?}/{reservation_id?}', ['uses' => 'SelectDatesController@selectDates']);
Route::get('/booking-availability-message/{property}/{date1}/{date2}/{reservation_id?}', ['uses' => 'SelectDatesController@bookingAvailabilityMessage']);
Route::get('/calculate-lodging-price/{property}/{date1}/{date2}/{reservation_id?}', ['uses' => 'SelectDatesController@calculateLodgingPrice']);
Route::get('/save-dates-searched-to-session/{date1}/{date2}', ['uses' => 'SelectDatesController@saveDatesSearchedToSession']);

Route::post('/cropper/{width?}/{height?}', ['uses' => '_NobleSoft\CommonFunctionsController@cropper']);
Route::get('/load-cropper-object/{db_id}/{deletable}/{number?}/{width}/{height}/{preview_image?}/{tmp_img_path?}',
function ($number = '1', $deletable = 'Y', $db_id = 'NA', $width = '800', $height = '600', $preview_image = 'NA', $tmp_img_path = 'NA')
  {
    $preview_image = str_replace('/', '|', $preview_image);
    $tmp_img_path = str_replace('/', '|', $tmp_img_path);
    return view('admin.layouts.objects.cropper')->with('number', $number)
    ->with('deletable', $deletable)->with('db_id', $db_id)
    ->with('width', $width)->with('height', $height)
    ->with('preview_image', $preview_image)->with('tmp_img_path', $tmp_img_path);
  });

// End of AJAX

Route::get('sale/search/redirect', ['uses' => 'PropertiesController@saleSearchRedirect']);
Route::get('sale/search/{type}/{location}/{sleeps}', ['uses' => 'PropertiesController@saleSearch']);

Route::post('/Filtration', ['uses' => 'PropertiesController@Filtration']);
Route::post('/customnotify', ['uses' => 'PropertiesController@customnotify']);
//Search properties for booking by dates.
Route::get('rental/search/redirect', ['uses' => 'PropertiesController@rentalSearchRedirect']);
Route::get('rental/search/{type}/{date_start}/{date_end}/{sleeps}', ['uses' => 'PropertiesController@rentalSearch']);
//Categories of properties
Route::get('/types', ['uses' => 'PropertiesController@types']);
//List of properties under a specific category
Route::get('type/{slug}', ['uses' => 'PropertiesController@indexByType'])->where('slug', '[A-Za-z0-9-_]+');
//Shows detail of a single property
Route::get('show/{slug}', ['uses' => 'PropertiesController@show'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('sale/{slug}', ['uses' => 'PropertiesController@showSale'])->where('slug', '[A-Za-z0-9-_]+');
Route::get('reserve/{slug}', ['uses' => 'PropertiesController@showReserve'])->where('slug', '[A-Za-z0-9-_]+');

//Send a Buying offer
Route::get('send-buying-offer/{slug}/redirect', ['uses' => 'ReservationsController@saveBuyingOffer']);
//Reserve a property Step-1
Route::get('reserve/{slug}/redirect', ['uses' => 'ReservationsController@createRedirect']);
Route::get('reserve/{slug}/{date_start}/{date_end}', ['uses' => 'ReservationsController@create']);
//Reserve a property Step-2
Route::post('reserve/{slug}/{date_start}/{date_end}/store', ['uses' => 'ReservationsController@store']);
//Shows booking total and checkout.
Route::get('reservation/{uniqid}/payment', ['uses' => 'ReservationsController@payment'])->where('uniqid', '[A-Za-z0-9-_]+');
//Submits the checkout and creates record of payment transaction
Route::post('reservation/{uniqid}/payment', ['uses' => 'TransactionsController@update'])->where('uniqid', '[A-Za-z0-9-_]+');
//Success message of reservation and payment.
Route::get('reservation/{uniqid}/payment/success', ['uses' => 'ReservationsController@success'])->where('uniqid', '[A-Za-z0-9-_]+');
//Website's contact page
Route::get('/contact', ['uses' => 'PagesController@contact']);
// login and register
Route::get('/login', ['uses' => 'PagesController@login']);
Route::post('/sendlogin', ['uses' => 'PagesController@sendlogin']);
Route::post('changecurrency', ['uses' => 'PagesController@changecurrency']);
Route::get('/register', ['uses' => 'PagesController@register']);
Route::post('/sendregister', ['uses' => 'PagesController@sendregister']);
Route::post('/sendforgotpass', ['uses' => 'PagesController@sendforgotpass']);
Route::post('/sendcontactemail', ['uses' => 'PagesController@sendcontactemail']);
Route::get('/forgot', ['uses' => 'PagesController@forgot']);
Route::get('/unsubscribe/{id}', ['uses' => 'PagesController@unsubscribe']); 
Route::get('/user-register/{user_id}', ['uses' => 'PagesController@userregister']);  //user registe form edit by azeem
Route::post('/senduserregister', ['uses' => 'PagesController@senduserregister']);   //user register in db edit by azeem
Route::get('/terms', ['uses' => 'PagesController@terms']);
Route::get('/privacy', ['uses' => 'PagesController@privacy']);
Route::get('/pmcontent', ['uses' => 'PagesController@pmcontent']);
Route::get('/contentguidelines', ['uses' => 'PagesController@contentguidelines']);
Route::get('/pricing', ['uses' => 'PagesController@pricing']);
Route::get('/howitworks', ['uses' => 'PagesController@howitworks']);
Route::get('/showproperties', ['uses' => 'PagesController@showproperties']);
Route::get('/thanks', ['uses' => 'PagesController@thanks']);
Route::get('/searchnotification', ['uses' => 'PagesController@searchnotification']);
Route::get('/disclaimer', ['uses' => 'PagesController@disclaimer']);
Route::get('/faq', ['uses' => 'PagesController@faq']);
Route::get('/verifyEmail/{token}', ['uses' => 'PagesController@verifyEmail']);
Route::get('/chat/{id}/{agent_id}', ['uses' => 'PropertiesController@chatredirect']);
Route::get('/registerredirect', ['uses' => 'PropertiesController@registerredirect']);
//Shows single page of Website contents
Route::get('/{category}/{page}', ['uses' => 'PagesController@show'])->where('page', '[A-Za-z0-9-_]+');
//Shows list of pages of a specific category of website contents
Route::get('/{category}', ['uses' => 'PagesController@category'])->where('page', '[A-Za-z0-9-_]+');

//End of routes
