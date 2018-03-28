<?php

namespace App\Http\Controllers;

use Redirect;

use DB;

use App\Http\Controllers\Controller;

use App\Http\Controllers\SelectDatesController as Calendar;

use App\Http\Controllers\SendEmailsController as SendEmails;

use App\Http\Controllers\NavigationController as Nav;

use App\Http\Requests\FrontendReservations;

use Illuminate\Http\Request;

class ReservationsController extends Controller

{

    //Loads the view with form for creating a reservation with required parameters.

    public function createRedirect(Request $request, $slug)

    {



            if (null === $request->get('dates_searched') or empty($request->get('dates_searched'))) {

                return redirect('show/' . $slug)->withErrors('You must select avaialable dates on the calendar.<br/>')->withInput();

            } //null === $request->get('dates_searched') or empty($request->get('dates_searched'))

            $dates_searched = explode(',', $request->get('dates_searched'));

            $date_start     = min($dates_searched);

            $date_end       = max($dates_searched);

            //var_dump($dates_searched);

            return redirect('reserve/' . $slug . '/' . $date_start . '/' . $date_end)->withInput();





    }

    //Loads the view with form for creating a reservation with required parameters.

    public function create(Calendar $calendar, Request $request, Nav $nav, SendEmails $sendemails, $slug, $date_start = '', $date_end = '')

    {



        $date_start   = date('Y-m-d', strtotime($date_start));

        $date_end     = date('Y-m-d', strtotime($date_end));

        $property     = \App\Properties::where('slug', $slug)->first();

        $property_id  = $property->id;

        $addons    = \App\Services::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $lineitems    = \App\LineItems::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $states       = \App\Locations::where('is_active', 1)->get();

        $availability = $calendar->isPropertyAvailable($property_id, $date_start, $date_end);

        if (true !== $availability) {

            @$warning .= 'Sorry, property is not available.<br/>' . $availability;

        } //true !== $availability





        $nights            = intval((strtotime($date_end) - strtotime($date_start)) / 86400);

        if($property->minimum_stay_nights>=$nights){

            @$warning .= 'Sorry, this property is not available for less than '.$property->minimum_stay_nights.' night(s).<br/>';

        }

        

        $lodging_amount    = $calendar->calculateLodgingPrice($slug, $date_start, $date_end);

        $settings          = \App\Settings::find(1);

        $menu_top          = $nav->getHTMLNavigation();

        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();



        return view('reservations.reserve')->with('settings', $settings)->with('menu_top', $menu_top)

        ->with('categories', $categories)->with('locations', $locations)->with('property', $property)

        ->with('date_start', date('m/d/Y', strtotime($date_start)))->with('date_end', date('m/d/Y', strtotime($date_end)))

        ->with('lodging_amount', $lodging_amount)->with('addons', $addons)->with('lineitems', $lineitems)

        ->with('states', $states)->with('footer_pages', $footer_pages)

        ->with('footer_properties', $footer_properties)->with('warning', @$warning);

    }

    //Inserts the reservation to the database.

    public function store(FrontendReservations $request, Calendar $calendar, Nav $nav, $slug, $date_start = '', $date_end = '')

    {



        $uniqid       = uniqid();

        $property     = \App\Properties::where('slug', $slug)->first();

        $property_id  = $property->id;

        $availability = $calendar->isPropertyAvailable($property_id, $date_start, $date_end);

        if (true !== $availability) {

            return redirect("reserve/$slug/$date_start/$date_end")->withErrors('Sorry, property is not available.<br/>' . $availability)->withInput();

        } //true !== $availability



        $nights            = intval((strtotime($date_end) - strtotime($date_start)) / 86400);

        if($property->minimum_stay_nights>=$nights){

            return redirect("reserve/$slug/$date_start/$date_end")->withErrors('Sorry, this property is not available for less than '.$property->minimum_stay_nights.' night(s).<br/>')->withInput();

        }

        /*upgrade - 12/10/2016 - minimum_nights*/



        $lodging_amount = $calendar->calculateLodgingPrice($slug, $date_start, $date_end);

        if (!is_numeric($lodging_amount)) {

            $error .= $lodging_amount;

            die('Lodging Amount Error'); //abrar redirect the error to frontend

        } //!is_numeric($lodging_amount)

        $reservation                   = new \App\Reservations();

        $reservation->uniqid           = $uniqid;

        $reservation->firstname        = $request->input('firstname');

        $reservation->lastname         = $request->input('lastname');

        $reservation->address_line_1   = $request->input('address_line_1');

        $reservation->address_line_2   = $request->input('address_line_2');

        $reservation->city             = $request->input('city');

        $reservation->state_id         = $request->input('state');

        $reservation->zip              = $request->input('zip');

        $reservation->phone            = $request->input('phone');

        $reservation->email            = $request->input('email');

        $reservation->date_start       = $date_start;

        $reservation->date_end         = date('Y-m-d',strtotime('+1 day',strtotime($date_end)));

        $reservation->property_id      = $property_id;

        $reservation->lodging_amount   = $lodging_amount;

        $reservation->sub_total_detail = $request->get('sub_total_detail');

        $reservation->status           = 'new';

        $reservation->created_by       = 'guest';

        $reservation->housekeeper_id   = $property->housekeeper_id;

        $reservation->save();

        @$success .= 'Successfully saved';

        $reservation_id = $reservation->id;

        if (!empty($reservation_id)) {

            $addons     = \App\Services::where('is_active', '1')->orderBy('display_order', 'asc')->get();

            $addons_total = 0;

            foreach ($addons as $addon) {



                    $service                 = new \App\ReservationsServices();

                    $service->reservation_id = $reservation_id;

                    $service->service_id     = $addon->id;

                    $service->quantity       = $request->get('quantity_'.$addon->id);

                    $service->price          = $addon->price * $service->quantity;

                    $service->save();

                    $addons_total += $service->price;



                }





            $lineitem     = \App\LineItems::where('is_active', '1')->orderBy('display_order', 'asc')->get();

            $total_amount = $lodging_amount = $lodging_amount + $addons_total;

            foreach ($lineitem as $lineitem) {

                $line_item_id   = $lineitem->id;

                $line_item_name = $lineitem->title;

                $slug           = $lineitem->slug;

                if ($lineitem->is_required == '1' or $request->has($slug)) {

                    if ($lineitem->value_type == 'fixed') {

                        $value = $lineitem->value;

                    } //$lineitem->value_type == 'fixed'

                    if ($lineitem->value_type == 'percentage') {
                        $value = $lineitem->value;
                        if($lineitem->apply_on == "base"){
                            $value = ($lodging_amount * $value / 100);
                        }else{
                            $value = ($total_amount * $value / 100);
                        }
                    } //$lineitem->value_type == 'percentage'
                } //$lineitem->is_required == '1'
                if (isset($value)) {

                    $lineitem                 = new \App\ReservationLineItems();

                    $lineitem->reservation_id = $reservation_id;

                    $lineitem->line_item_id   = $line_item_id;

                    $lineitem->value          = $value;

                    $lineitem->save();

                    $total_amount += $value;

                } //isset($value)

                unset($value);

            } //$lineitem as $lineitem

            $reservation->total_amount = $total_amount;

            $reservation->save();

        } //!empty($reservation_id)





        $final_payment_date = $calendar->calculateFinalPaymentDate($property_id, $date_start, $date_end);

        



        if ($final_payment_date > date('Y-m-d')) {

            $deposit_term = 'half';

            $amount       = ($total_amount / 2);

        } //$final_payment_date > date('Y-m-d')

        else {

            $deposit_term = 'full';

            $amount       = $total_amount;

        }

        $status                      = 'pending';

        $transaction                 = new \App\Transactions();

        $transaction->reservation_id = $reservation_id;

        $transaction->amount         = $amount;

        $transaction->deposit_term   = $deposit_term;

        $transaction->date_due       = date('Y-m-d');

        $transaction->status         = $status;

        $transaction->save();

        if ($deposit_term == "half") {

            $transaction                 = new \App\Transactions();

            $transaction->reservation_id = $reservation_id;

            $transaction->amount         = $amount;

            $transaction->deposit_term   = $deposit_term;

            $transaction->date_due       = $final_payment_date;

            $transaction->status         = $status;

            $transaction->save();

        } //$deposit_term == "half"

        $status = 'pending';

        $date_start_loop = $date_start;

            $date_end_loop = $date_end;

            $loop_counter = 0;

        while ($date_start_loop <= $date_end_loop) {

            $calendar                 = new \App\Calendar();

            $calendar->property_id    = $property_id;

            $calendar->reservation_id = $reservation_id;

            $calendar->date           = $date_start_loop;

            $calendar->status         = $status;

            $calendar->save();

            @$success .= "Booked: " . date("m/d/Y", strtotime($date_start_loop)) . "<br/>";

            $date_start_loop = date("Y-m-d", strtotime("+1 day", strtotime($date_start_loop)));

            $loop_counter++;

            if($loop_counter>999) break;

        } //$date_start_loop < $date_end_loop

        //return $success;//testing mode

        if (empty($error)) {

            return redirect('reservation/' . $uniqid . '/payment')->withSuccess($success);

        } //empty($error)

    }

    //Shows a view page with payments due/paid and checkout for a reservation.

    public function payment(Calendar $calendar, Request $request, Nav $nav, $uniqid)

    {

        $reservation       = \App\Reservations::where('uniqid', $uniqid)->first();

        if($reservation==null) die('Your link has been expired. It may happen because of the scheduled refresh job by webmaster!');

        $transactions      = \App\Transactions::where('reservation_id', $reservation->id)->get();

        $property_id       = $reservation->property_id;

        $date_start        = $reservation->date_start;

        $date_end          = $reservation->date_end;

        $property          = \App\Properties::find($property_id);

        $lineitems         = \DB::table('emt_line_items as L')->leftJoin('emt_reservations_line_items as RL', 'L.id', '=', 'RL.line_item_id')->where('L.is_active', 1)->where('RL.reservation_id', $reservation->id)->orderBy('L.display_order', 'asc')->get();

        $states            = \App\Locations::where('is_active', 1)->get();

        $lodging_amount    = $calendar->calculateLodgingPrice($property_id, $date_start, $date_end);

        $settings          = \App\Settings::find(1);

        $menu_top          = $nav->getHTMLNavigation();

        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        return view('reservations.payment')->with('settings', $settings)->with('menu_top', $menu_top)

        ->with('categories', $categories)->with('locations', $locations)

        ->with('reservation', $reservation)->with('transactions', $transactions)

        ->with('property', $property)->with('date_start', date('m/d/Y', strtotime($date_start)))

        ->with('date_end', date('m/d/Y', strtotime($date_end)))

        ->with('lodging_amount', $lodging_amount)->with('lineitems', $lineitems)

        ->with('states', $states)->with('footer_pages', $footer_pages)

        ->with('footer_properties', $footer_properties);

    }

    //When a reservation is created successfully show the message.

    public function success(Calendar $calendar, Request $request, Nav $nav, $uniqid)

    {

        $reservation       = \App\Reservations::where('uniqid', $uniqid)->first();

        $property_id       = $reservation->property_id;

        $property          = \App\Properties::find($property_id);

        $settings          = \App\Settings::find(1);

        $menu_top          = $nav->getHTMLNavigation();

        $categories        = \App\Categories::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $locations         = \App\Locations::where('is_active', 1)->orderBy('display_order', 'asc')->get();

        $footer_pages      = \App\Pages::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        $footer_properties = \App\Properties::where('is_active', 1)->where('is_featured', 1)->orderBy('display_order', 'asc')->get();

        return view('reservations.success')->with('settings', $settings)->with('menu_top', $menu_top)

        ->with('categories', $categories)->with('locations', $locations)

        ->with('property', $property)->with('footer_pages', $footer_pages)

        ->with('footer_properties', $footer_properties);

    }



    //Inserts the buying offer to the database.

    public function saveBuyingOffer(SendEmails $sendemails,  Request $request, Nav $nav, $slug)

    {



        $uniqid       = uniqid();

        $property     = \App\Properties::where('slug', $slug)->first();



        $buyingoffers                   = new \App\BuyingOffers();

        $buyingoffers->property_id      = $property->id;

        $buyingoffers->uniqid           = $uniqid;

        $buyingoffers->firstname        = $request->input('firstname');

        $buyingoffers->lastname         = $request->input('lastname');

        $buyingoffers->email            = $request->input('email');

        $buyingoffers->message          = $request->input('message');

        $user_id = $property->user_id;



        $property_owner = DB::table('users')->where('id',$user_id)->first();

        $property_owner_email = $property_owner->email;

        

        $buyingoffers->save();  

@$success .= 'Your message has been stored! ';

   

        $message = "<p>Hello,</p>

<p>You have received a new message details for your property:- ".$property->title.".</p>

<p>Please find the details below: </p>

<p>First Name: ".$buyingoffers->firstname."</p>

<p>Last Name: ".$buyingoffers->lastname."</p>

<p>Email: ".$buyingoffers->email."</p>

<p>Message: ".$buyingoffers->message."</p>

<p>Thank you,</p>

<p>Manager,</p>

<p>Match Property Direct</p>";

$headers = "MIME-Version: 1.0" . "\r\n";

$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: Match Property Direct<info@matchpropertydirect.com>' . "\r\n";

$to = $property_owner_email;

$subject = "Property Inquiry";

$mail = mail($to,$subject,$message,$headers);

@$success .= 'Email sent to property owner/administrator.please check your email junk box if not received in inbox';

        // $sent = $sendemails->buyingOffer($buyingoffers->id); //$reservation->id

        //     $sent === true ? @$success .= 'Email sent to property owner/administrator.<br/>' : @$error .= 'No email sent to property owner/administrator.<br/>';



        if (empty($error)) {

            return redirect('show/' . $slug)->withMessage($success);

        } //empty($error)

    }

}

