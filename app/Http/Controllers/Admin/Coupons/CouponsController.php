<?php
namespace App\Http\Controllers\Admin\Coupons;
use Redirect,DB;
use Session;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmenitiesFormRequest;
use App\Http\Controllers\Admin\AdminController as Panel;
use Illuminate\Http\Request;
class CouponsController extends Controller
{
    //------------------------list of the all the coupons------------------------//
    public function index(Panel $panel)
    {   
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $js            = "$('#treeview-properties').addClass('active');\n";
        $coupons = \App\coupons::latest('coupon_code_id', 'asc')->where('coupon_status','=','yes')->get();  //-----------list ordered by coupon code id---//
       return view('admin.coupons.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('js', $js)->with("coupons", $coupons);
    }    
    //Add coupon code form
    public function create()
    {
        return view('admin.coupons.create');
    }
    
    //Inserts a new coupon code
    public function store(Request $request)
    {
        if ($request->get('coupon_code')) {               
        $authorModel = \App\coupons::where('coupon_code' , '=', $request->get('coupon_code'))->first();  //--get coupon by coupon code--//
        if($authorModel==NULL  OR $authorModel->coupon_code!=$request->get('coupon_code'))
        {
            $coupons = new \App\coupons();
            $coupons->coupon_code = $request->get('coupon_code');      
            $coupons->coupon_amount = $request->get('coupon_amount');      
            $coupons->createdAt   = date('Y-m-d H:i:s');
            $coupons->updatedAt    = date('Y-m-d H:i:s');        
            $coupons->save();
            $message = 'Saved Successfully!';
        return redirect('admin/coupons/edit/' . $coupons->coupon_code_id)->withMessage($message);
        }else
        {
            $errors = 'Coupon Already Exists!';          
            return view('admin.coupons.create')->withErrors($errors);         
        }
        }else
        {
            $errors = 'Please enter coupon code and amount!';          
            return view('admin.coupons.create')->withErrors($errors);                     
        }
    }
    
    
    //Edit an coupon code form
    public function edit($id)
    {
        $coupon = \App\coupons::where('coupon_code_id', $id)->first();
        return view('admin.coupons.edit')->with('coupon', $coupon);
    }
    //Updates an item in the database table
    public function update(Request $request)
    {
        $coupon_id=$request->get('coupon_code_id');  //--get coupon by coupon code id--//
        $coupon = \App\coupons::find($coupon_id);    
        $coupon->coupon_code = $request->get('coupon_code');      
        $coupon->coupon_amount = $request->get('coupon_amount');      
        $coupon->updatedAt    = date('Y-m-d H:i:s');          
        $coupon->display_order = $request->input('display_order');        
        $coupon->save();
        $message = 'Saved Successfully!';
        return redirect('/admin/coupons/edit/' . $coupon_id)->withMessage($message);
    }
    
    
     //------------------------------delete coupon form----------------------------------------    
     public function deletecoupon($id)
    {
        $coupon = \App\coupons::where('coupon_code_id', $id)->first();        
        return view('admin.coupons.delete')->with('coupon', $coupon);
    }    
    
    //---------------------------delete coupon--------------------------------------------//
    public function destroy(Request $request)
    {
       $coupon_id = $request->get('coupon_code_id');  //--get coupon by coupon code id--//
       $coupon = \App\coupons::find($coupon_id);   //--get coupon by coupon code id--// 
       if($coupon AND $coupon->is_active !=1)
       {
          $coupon->coupon_status    = "no";  
          $coupon->updatedAt        = date('Y-m-d H:i:s');  
          $coupon->save();                    
          $message = 'Deleted Successfully!';
          return redirect('/admin/coupons/deletecoupon/' . $coupon_id)->withMessage($message);                    
       }else
       {
           $errors = 'Coupon is still not used, are you sure you to want delete';    
           $coupons = \App\coupons::where('coupon_code_id', $coupon_id)->first();             
            return view('admin.coupons.premenantdelete')->with('coupons', $coupons,'')->withErrors($errors);
          
       }
       
    }
    
   public function premenantDelete(Request $request)
   {       
       $coupon_id = $request->get('coupon_code_id');  //--get coupon by coupon code id--//
       $coupon = \App\coupons::find($coupon_id);   //--get coupon by coupon code id--//
       $coupon->delete();
       $message = 'Deleted Successfully!';
       return redirect('/admin/coupons/deletecoupon/' . $coupon_id)->withMessage($message); 
   }
   
    public function signUpLink(Request $request)
    {
        $email=$request->get('email'); 
        $user_name = Auth::user()->first_name;
        $user_id= Auth::user()->id;
        return redirect("/register/".$user_id);
        $message =  "Hello ".$user_name.",<br><br>You have successfully registered with MatchPropertyDirect.<br><br>Please click <a href='".url("/register")."/$user_id"."'>here</a> to verify your account.<br><br>Thanks & Regards,<br><br>MatchPropertyDirect™ Team";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: MatchPropertyDirect<info@matchpropertydirect.com>' . "\r\n";
        $to = $email;
        $subject = "MatchPropertyDirect Registration";
        $mail = mail($to,$subject,$message,$headers);
        Session::flash('message', 'Link has been you to entered email'); 
        return redirect('/profile'); 
    }
    
    
    //-------------------------user register with reference---------------------
    public function userRegister(Request $request)
    {
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $password = $request->input('password');
        $user_id = $request->input('user_id');
        $role = $request->input('user_role');
        $is_active = '1';
        $verify = '0';
        $created_at = date("Y-m-d H:i:s");
        $updated_at = date("Y-m-d H:i:s");
        $verify_token = md5(rand());
        $check = DB::select("select * from users where email='".$email."'");
        if(count($check)>0)
        {
            Session::flash('error', 'Email already exits'); 
            return redirect("/register/".$user_id);

        }else
        {
           $last_id = DB::table('users')->insertGetId(
                ['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'password' => bcrypt($password), 'user_role' => $role,'created_at' => $created_at,'updated_at' => $updated_at]
            );
           $reference_user =DB::table('emt_reference_users')->insertGetId(
                   ['user_id'=>$user_id,'referece_name'=>$first_name,'created_at'=>$created_at]);
           Session::flash('error', 'Successfully Added'); 
            return redirect("/profile");
        }
    }
    
    public function getUsers()
    {       
        $users= DB::table('users')  
          ->Join('emt_reference_users','emt_reference_users.user_id','=','users.id')
          ->select('users.*','emt_reference_users.referece_name as reference')         
          ->get();   
        return view('users/index')->with("users", $users);
    }
}
