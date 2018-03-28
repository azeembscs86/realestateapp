<?php
namespace App\Http\Controllers\Admin\Amenities;
use Redirect,DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmenitiesFormRequest;
use App\Http\Controllers\Admin\AdminController as Panel;
use Illuminate\Http\Request;
class AmenitiesController extends Controller
{
    //List of amenities
    public function index(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $amenities     = \App\Amenities::orderBy('display_order', 'asc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('admin.amenities.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('amenities', $amenities)->with('js', $js);
    }
    //Add form
    public function create()
    {
        return view('admin.amenities.create');
    }
    //Inserts a new amenity
    public function store(AmenitiesFormRequest $request)
    {
        $amenity                = new \App\Amenities();
        $amenity->title         = $request->input('title');
        $amenity->display_order = $request->input('display_order');
        if ($request->has('is_active')) {
            $amenity->is_active = 1;
        } //$request->has('is_active')
        else {
            $amenity->is_active = 0;
        }
        $amenity->save();
        $message = 'Successfully saved';
        return redirect('admin/amenities/edit/' . $amenity->id)->withMessage($message);
    }
    //Edit an amenity
    public function edit($id)
    {
        $amenity = \App\Amenities::where('id', $id)->first();
        return view('admin.amenities.edit')->with('amenity', $amenity);
    }
    //Updates an item in the database table
    public function update(AmenitiesFormRequest $request)
    {
        $id                     = $request->input('id');
        $amenity                = \App\Amenities::find($id);
        $amenity->title         = $request->input('title');
        $amenity->display_order = $request->input('display_order');
        if ($request->has('is_active')) {
            $amenity->is_active = 1;
        } //$request->has('is_active')
        else {
            $amenity->is_active = 0;
        }
        $amenity->save();
        $message = 'Successfully saved';
        return redirect('/admin/amenities/edit/' . $id)->withMessage($message);
    }
    //Deletes
    public function destroy(Request $request, $id)
    {
        $amenity = \App\Amenities::find($id);
        $amenity->delete();
        $data['message'] = '<i class="fa fa-trash-o" aria-hidden="true"></i>  Successfully Deleted';
        return redirect('/admin/amenities')->with($data);
    }

    // lifestyle category
    public function lifestyle(Panel $panel)
    {
        $settings      = \App\Settings::find(1);
        $user          = \Auth::user();
        $notifications = $panel->notifications();
        $lifestyle     = DB::table('emt_lifestyle_category')->orderBy('id', 'desc')->get();
        $js            = "$('#treeview-properties').addClass('active');\n";
        return view('admin.lifestyle.index')->with('settings', $settings)->with('user', $user)->with('notifications', $notifications)->with('lifestyle', $lifestyle)->with('js', $js);
    }
    public function deletelifestyle(Request $request, $id)
    {
        $amenity = DB::table('emt_lifestyle_category')->where('id', $id)->delete();
        $data['message'] = 'Successfully deleted';
        return redirect('/admin/lifestyle')->with($data);
    }
    public function createlifestyle()
    {
        return view('admin.lifestyle.create');
    }
    //Inserts a new amenity
    public function storelifestyle(AmenitiesFormRequest $request)
    {
        $title         = $request->input('title');
        // $amenity->display_order = $request->input('display_order');
        if ($request->has('is_active')) {
            $is_active = 1;
        } //$request->has('is_active')
        else {
            $is_active = 0;
        }
        $id = DB::table('emt_lifestyle_category')->insertGetId(
            ['title' => $title, 'is_active' => $is_active]
        );
        $message = 'Successfully saved';
        return redirect('admin/lifestyle/edit/' . $id)->withMessage($message);
    }
    public function editlifestyle($id)
    {
        $lifestyle = DB::table('emt_lifestyle_category')->where('id', $id)->first();
        return view('admin.lifestyle.edit')->with('lifestyle', $lifestyle);
    }
    //Updates an item in the database table
    public function updatelifestyle(AmenitiesFormRequest $request)
    {
        $id                     = $request->input('id');
        $title         = $request->input('title');
        if ($request->has('is_active')) {
            $is_active = 1;
        } //$request->has('is_active')
        else {
            $is_active = 0;
        }
        DB::table('emt_lifestyle_category')
            ->where('id', $id)
            ->update(['title' => $title,'is_active' => $is_active]);
        $message = 'Successfully saved';
        return redirect('/admin/lifestyle/edit/' . $id)->withMessage($message);
    }
}
