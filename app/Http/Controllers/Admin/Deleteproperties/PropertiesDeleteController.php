<?php
namespace App\Http\Controllers\Admin\Deleteproperties;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertiesFormRequest;
use App\Http\Controllers\Admin\AdminController as Panel;
use Illuminate\Http\Request;
class PropertiesDeleteController extends Controller
{
    //List of classes of properties with actions to edit/delete
    public function index(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $properties    = \App\Properties::orderBy('display_order', 'asc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('admin.property-delete.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('properties', $properties)->with('js', $js);
    }

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
        $success = '<h4><i class="fa fa-trash-o" aria-hidden="true"></i> Property Deleted</h4><br/>';
        return redirect('/admin/deleteproperties')->withMessage($success);
    }
}
