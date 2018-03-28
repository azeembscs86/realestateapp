<?php
namespace App\Http\Controllers\Owner;
use DB,Auth;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
class OwnerController extends Controller
{
    //Admin panel dashboard
    public function dashboard()
    {
        session_start();
        unset($_SESSION['chat_ses_id']);
        $settings              = \App\Settings::find(1);
        $user                  = \Auth::user();
        if($user->is_active = 0){
            die('Your account has been disabled by admin');
        }
        $check = DB::table('emt_buying_offers')->where('email',Auth::user()->email)->where('status','0')->get();
        foreach ($check as $single) {
            DB::update("update emt_buying_offers set status='1' where id='".$single->id."'");
            DB::insert("insert into inquires (property_id,user_id,message) values ('".$single->property_id."','".Auth::user()->id."','".$single->message."')");
        }
        $notifications         = OwnerController::notifications();
        $properties            = \App\Properties::select('id')->where('user_id', \Auth::user()->id)->get()->toArray();
        if(Auth::user()->role=='owner')
        {
            $all_properties            = \App\Properties::where('user_id', \Auth::user()->id)->orderBy('created_at', 'desc')->take(5)->get();

            $all_properties_count            = count(\App\Properties::where('user_id', \Auth::user()->id)->get());
            $all_inquiries    = DB::select("SELECT a.*,b.title,b.address,b.city,b.zip,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and b.user_id='".Auth::user()->id."' order by a.id desc limit 0,5");
            $all_inquiries_count    = DB::select("SELECT a.*,b.title,b.address,b.city,b.zip,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and b.user_id='".Auth::user()->id."'");
        }
        else
        {
            $all_properties = [];
            $all_properties_count = 0;
            $all_inquiries    = DB::select("SELECT a.*,b.title,b.address,b.city,b.zip,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and a.user_id='".Auth::user()->id."' order by a.id desc limit 0,5");
            $all_inquiries_count    = DB::select("SELECT a.*,b.title,b.address,b.city,b.zip,b.user_id,c.firstname,c.lastname,c.email FROM inquires a,emt_properties b,users c where a.property_id=b.id and a.user_id=c.id and a.user_id='".Auth::user()->id."'");
        }
        
        $reservations          = \App\Reservations::select('id')->whereIn('property_id', $properties)->get()->toArray();
        


        $bookings              = count(\App\Reservations::whereIn('property_id', $properties)->where('is_seen', '0')->where('date_start', '>=', date('Y-m-d'))->get());
        $arrivals              = count(\App\Reservations::whereIn('property_id', $properties)->where('status', 'booked')->where('date_start', '>=', date('Y-m-d'))->get());
        $departures            = count(\App\Reservations::whereIn('property_id', $properties)->where('status', 'booked')->where('date_end', '<=', date('Y-m-d'))->get());
        $transactions          = count(\App\Transactions::whereIn('reservation_id', $reservations)->where('status', 'paid')->get());
        $dashboard             = (object) array(
            'bookings' => $bookings,
            'transactions' => $transactions,
            'arrivals' => $arrivals,
            'departures' => $departures
        );
        $reservations_new      = \App\Reservations::whereIn('property_id', $properties)->where('is_seen', '0')->where('date_start', '>=', date('Y-m-d'))->orderBy('created_at', 'desc')->take(5)->get();
        $arrivals              = \App\Reservations::whereIn('property_id', $properties)->where('date_start', '>=', date('Y-m-d'))->orderBy('date_start', 'asc')->take(5)->get();
        $departures            = \App\Reservations::whereIn('property_id', $properties)->where('date_end', '<=', date('Y-m-d'))->orderBy('date_end', 'desc')->take(5)->get();
        $transactions_received = \App\Transactions::whereIn('reservation_id', $reservations)->where('status', 'paid')->orderBy('date_paid', 'desc')->take(5)->get();
        $transactions_coming   = \App\Transactions::whereIn('reservation_id', $reservations)->where('status', 'pending')->orderBy('date_due', 'asc')->take(5)->get();
        $js                    = "$('#treeview-business').addClass('active');\n";
        return view('owner.dashboard')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('dashboard', $dashboard)->with('reservations_new', $reservations_new)->with('transactions_received', $transactions_received)->with('transactions_coming', $transactions_coming)->with('arrivals', $arrivals)->with('departures', $departures)->with('all_properties', $all_properties)->with('all_inquiries', $all_inquiries)->with('js', $js)->with('all_properties_count', $all_properties_count)->with('all_inquiries_count', $all_inquiries_count);
    }
    //Prepare the notifcations to show in the admin panel.
    public function notifications()
    {
        $properties    = \App\Properties::select('id')->where('user_id', \Auth::user()->id)->get()->toArray();
        $reservations  = \App\Reservations::select('id')->whereIn('property_id', $properties)->get()->toArray();
        $bookings     = \App\Reservations::whereIn('property_id', $properties)->where('is_seen', '0')->where('date_start', '>=', date('Y-m-d'))->orderBy('created_at', 'desc')->get();
        $arrivals = \App\Reservations::whereIn('property_id', $properties)->whereBetween('date_start', [date('Y-m-d'),date('Y-m-d',strtotime("+1 month"))])->orderBy('date_start', 'asc')->get();
        
        $transactions = \App\Transactions::whereIn('reservation_id', $reservations)->where('date_paid', '<=', date('Y-m-d H:i:s'))->orderBy('date_paid', 'desc')->orderBy('date_due', 'desc')->get();
        return $array = (object) array(
            'bookings' => $bookings,
            'arrivals' => $arrivals,
            'transactions' => $transactions
        );
    }
    
}
