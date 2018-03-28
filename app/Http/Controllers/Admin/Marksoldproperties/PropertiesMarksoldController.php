<?php
namespace App\Http\Controllers\Admin\Marksoldproperties;
use Redirect;
use DB;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertiesFormRequest;
use App\Http\Controllers\Admin\AdminController as Panel;
use Illuminate\Http\Request;
class PropertiesMarksoldController extends Controller
{
    //List of classes of properties with actions to edit/delete
    public function index(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $properties    = \App\Properties::orderBy('display_order', 'asc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('admin.property-sold.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('properties', $properties)->with('js', $js);
    }

    public function sold(Request $request, $id)
    {
        DB::table('emt_properties')->where('id',$id)->update(['is_sold'=>'1']);
        $success = 'Property has been marked as Sold<br/>';
        return redirect('/admin/marksoldproperties')->withMessage($success);
    }
}
