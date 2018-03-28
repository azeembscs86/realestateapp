<?php
namespace App\Http\Controllers\Admin\Locations;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\LocationsFormRequest;
use App\Http\Controllers\Admin\AdminController as Panel;
use Illuminate\Http\Request;
class LocationsController extends Controller
{
    public function getLocationID($slug){
        $location    = \App\Locations::where('slug', $slug)->first();
        return $location->id;
    }


    // List of locations, states, cities.
    public function index(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $locations     = \App\Locations::orderBy('display_order', 'asc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('admin.locations.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('locations', $locations)->with('js', $js);
    }
    //Add a new location item
    public function create()
    {
        return view('admin.locations.create');
    }
    //Insert a new location item
    public function store(LocationsFormRequest $request)
    {
        $locations            = new \App\Locations();
        $locations->title     = $request->get('title');
        $locations->is_active = $request->has('is_active') ? 1 : 0;
        $locations->slug  = $slug = str_slug($request->get('slug'));
        $duplicate       = \App\Locations::where('slug', $slug)->first();
        if ($duplicate)
            return redirect('/admin/locations/create')->withErrors('Slug must not be already used!')->withInput();

        $locations->save();
        @$message .= 'Location added.<br/>';
        $fileprefix = 'location-';
        $filepath   = 'pictures/';
        $filename   = str_replace('tmp/', '', $request->input('tmp_img_path_main'));
        if (is_file('tmp/' . $filename)) {
            \File::move('tmp/' . $filename, $filepath . $fileprefix . $filename);
            $locations->image = $filepath . $fileprefix . $filename;
            $locations->save();
            @$message .= 'Picture saved.<br/>';
        } //is_file('tmp/' . $filename)
        return redirect('admin/locations/edit/' . $locations->id)->withMessage($message);
    }
    //Edit a location item
    public function edit($id)
    {
        $location = \App\Locations::where('id', $id)->first();
        return view('admin.locations.edit')->with('location', $location);
    }
    //Update the database table
    public function update(LocationsFormRequest $request)
    {
        $id               = $request->input('id');
        $locations        = \App\Locations::find($id);
        $locations->title = $request->input('title');
         $locations->slug  = $slug = str_slug($request->get('slug'));
        $duplicate       = \App\Locations::where('slug', $slug)->first();
        if ($duplicate){
            return redirect('/admin/locations/edit/' . $id)->withErrors('Slug must not be already used!')->withInput();
        }

        @$message .= 'Location updated.<br/>';
        $locations->is_active = $request->has('is_active') ? 1 : 0;
        $locations->save();
        $fileprefix = 'location-';
        $filepath   = 'pictures/';
        $filename   = str_replace('tmp/', '', $request->input('tmp_img_path_main'));
        if (is_file('tmp/' . $filename)) {
            \File::move('tmp/' . $filename, $filepath . $fileprefix . $filename);
            $locations->image = $filepath . $fileprefix . $filename;
            $locations->save();
            @$message .= 'Picture saved.<br/>';
        } //is_file('tmp/' . $filename)
        return redirect('/admin/locations/edit/' . $id)->withMessage($message);
    }
    //Deletes the item
    public function destroy(Request $request, $id)
    {
        $locations = \App\Locations::find($id);
        $locations->delete();
        $data['message'] = 'Successfully deleted';
        return redirect('/admin/locations')->with($data);
    }
}
