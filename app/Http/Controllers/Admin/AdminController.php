<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\SystemLogo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PropertiesImport;
use App\Models\PropertyImage;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //admin dashboard route controller
    public function dashboard()
    {
        $users = User::where('type', 'user')->count();
        $agents = User::where('type', 'agent')->count();
        $properties = Property::count();
        return view('template.admin.index', compact('users', 'agents', 'properties'));
    }

    //admin users properties route controller
    public function users()
    {
        $users = User::where('type', 'user')->orderBy('id', 'desc')->paginate(10);
        return view('template.admin.user', compact('users'));
    }

    //admin agents properties route controller
    public function agents()
    {
        $agents = User::where('type', 'agent')->orderBy('id', 'desc')->paginate(10);
        return view('template.admin.agent', compact('agents'));
    }

    //admin agent add properties route controller
    public function agentAdd()
    {
        return view('template.admin.add-agent');
    }

    //admin agents add submit properties route controller
    public function agentSubmitAgent(Request $request)
    {

        $agentEmailCount = User::where('email', $request->input('email'))->count();

        if ($agentEmailCount > 0) {
            toastr()->success('email already registered!', 'Success', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->route('admin.add-agent');
        }

        $request->validate([
            'name' => 'required',
            'password' => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        $agent = new User();
        $agent->name = $request->input('name');
        $agent->email = $request->input('email');
        $agent->password = Hash::make($request->input('password'));
        $agent->type = 'agent';
        $agent->status = 'approved';
        $agent->save();

        toastr()->success('Agent created successfully!', 'Success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.agents');
    }

    //admin agents edit properties route controller
    public function agentEdit($id)
    {
        $agent = User::findOrFail($id);
        return view('template.admin.edit-agent', compact('agent'));
    }

    //admin agents update properties route controller
    public function agentUpdate(Request $request, $id)
    {
        $agent = User::findOrFail($id);
        $agent->name = $request->input('name');
        $agent->email = $request->input('email');

        if (!empty($request->input('password'))) {
            $agent->password = Hash::make($request->input('password'));
        }
        $agent->save();
        toastr()->success('Agent updated successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.edit-agent', ['id' => $id]);
    }

    //admin delete agent properties route controller
    public function agentDelete($id)
    {
        $agent = User::find($id);

        if (!$agent) {
            // User not found, handle error
            toastr()->error('Agent not found!', 'Error', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->route('admin.agents');
        }

        $agent->delete();

        toastr()->success('Agent deleted successfully!', 'Success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.agents');
    }

    //admin approve user properties route controller
    public function approveUser($id)
    {
        $user = User::find($id);
        $user->status = 'approved';
        $user->save();

        toastr()->success('User approved successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.users');
    }

    //admin disapprove user properties route controller
    public function disapproveUser($id)
    {
        $user = User::find($id);
        $user->status = 'disapproved';
        $user->save();

        toastr()->success('User disapproved successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.users');
    }

    //admin delete user properties route controller
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            // User not found, handle error
            toastr()->error('User not found!', 'Error', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->route('admin.users');
        }

        $user->delete();

        toastr()->success('User deleted successfully!', 'Success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.users');
    }

    //admin change-logo properties route controller
    public function changeLogo()
    {
        return view('template.admin.change-logo');
    }

    //admin change-logo submit route controller
    public function changeLogoSubmit(Request $request)
    {
        $request->validate([
            'logo' => 'required',
        ]);

        $systemLogo = SystemLogo::find(1);

        if ($request->hasFile('logo')) {
            // Store the uploaded file in the public directory
            $File = $request->file('logo');
            $FileName = time() . '_' . $File->getClientOriginalName();
            $File->move(public_path('frontend/img'), $FileName);

            $systemLogo->update([
                'logo' => $FileName,
            ]);
        }

        toastr()->success('Logo changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-logo');
    }

    //admin change-icon properties route controller
    public function changeIcon()
    {
        return view('template.admin.change-icon');
    }

    //admin change-icon submit route controller
    public function changeIconSubmit(Request $request)
    {
        $request->validate([
            'icon' => 'required',
        ]);

        $systemLogo = SystemLogo::find(1);

        if ($request->hasFile('icon')) {
            // Store the uploaded file in the public directory
            $File = $request->file('icon');
            $FileName = time() . '_' . $File->getClientOriginalName();
            $File->move(public_path('frontend/img'), $FileName);

            $systemLogo->update([
                'fav' => $FileName,
            ]);
        }

        toastr()->success('Icon changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-icon');
    }

    //admin change-icon properties route controller
    public function changeImage()
    {
        return view('template.admin.change-image');
    }

    //admin change-icon submit route controller
    public function changeImageSubmit(Request $request)
    {
        $request->validate([
            'image' => 'required',
        ]);

        $systemLogo = SystemLogo::find(1);

        if ($request->hasFile('image')) {
            // Store the uploaded file in the public directory
            $File = $request->file('image');
            $FileName = time() . '_' . $File->getClientOriginalName();
            $File->move(public_path('frontend/img'), $FileName);

            $systemLogo->update([
                'image' => $FileName,
            ]);
        }

        toastr()->success('Icon changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-image');
    }

    //admin change-email properties route controller
    public function changeEmail()
    {
        return view('template.admin.change-email');
    }

    //admin change-email submit route controller
    public function changeEmailSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = Auth::user();

        $user->email = $request->email;
        $user->save();

        toastr()->success('Email changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-email');
    }

    //admin change-color properties route controller
    public function changeColor()
    {
        $system = SystemLogo::find(1);
        return view('template.admin.change-color', compact('system'));
    }

    //admin change-color submit route controller
    public function changeColorSubmit(Request $request)
    {
        $request->validate([
            'color' => 'required',
        ]);

        $system = SystemLogo::find(1);
        $system->color = $request->color;
        $system->save();

        toastr()->success('System color changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-color');
    }

    //admin change-password properties route controller
    public function changePassword()
    {
        return view('template.admin.change-password');
    }

    //admin change-password submit route controller
    public function changePasswordSubmit(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:8|different:current_password',
            'confirm_password' => 'required|same:new_password',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        toastr()->success('Password changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.change-password');
    }

    //admin upload csv properties route controller
    public function uploadCsv()
    {
        return view('template.admin.properties-csv');
    }

    //admin submit csv properties route controller
    public function submitCsv(Request $request)
    {

        // dd($request->file('csv'));
        Excel::import(new PropertiesImport, $request->file('csv'));

        toastr()->success('Property added successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);

        // Redirect to the property list page or any other page as needed
        return redirect()->route('admin.properties.all');
    }

    //admin add properties route controller
    public function add()
    {
        return view('template.admin.add-properties');
    }

    //admin add properties submit route controller
    public function addSubmit(Request $request)
    {
        // Validate the form data
        // $request->validate([
        //     'title' => 'required',
        //     'contact_number' => 'required',
        //     'price' => 'required',
        //     'space' => 'required',
        //     'rooms' => 'required',
        //     'dev_name' => 'required',
        //     'ready_construction' => 'required',
        //     'property_type' => 'required',
        //     'description' => 'required',
        // ]);

        // Generate a unique ID
        $uniqueId = 'offer#' . mt_rand(100, 999); // Generates a random number between 100 and 999
        while (Property::where('property_id', $uniqueId)->exists()) {
            $uniqueId = 'offer#' . mt_rand(100, 999); // Regenerate if the ID already exists
        }

        // Create a new property
        $property = new Property();
        $property->title = $request->title;
        $property->property_id = $uniqueId;
        $property->contact_number = $request->contact_number;
        $property->price = $request->price;
        $property->space = $request->space;
        $property->rooms = $request->rooms;
        $property->district = $request->district;
        $property->dev_name = $request->dev_name;
        $property->ready_construction = $request->ready_construction;
        $property->property_type = $request->property_type;
        // $property->roof = $request->roof;
        $property->description = $request->description;
        $property->user_id = auth()->id();
        $property->post_by = 'admin';
        $property->save();

        // Check if there are any files uploaded
        if ($request->hasFile('thumb')) {
            // Store each uploaded file in the public directory and save their paths
            foreach ($request->file('thumb') as $thumbFile) {
                $thumbFileName = time() . '_' . $thumbFile->getClientOriginalName();
                $thumbFile->move(public_path('assets/image/property'), $thumbFileName);

                // Create a new PropertyImage instance for each uploaded image
                PropertyImage::create([
                    'property_id' => $property->id,
                    'img' => $thumbFileName,
                ]);
            }
        }

        toastr()->success('Property added successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);

        // Redirect to the property list page or any other page as needed
        return redirect()->route('admin.properties.all');
    }

    //admin edit properties route controller
    public function editProperty($id)
    {
        $property = Property::where('id', $id)->first();
        return view('template.admin.edit-properties', compact('property'));
    }

    //admin edit properties submit route controller
    public function updateProperty(Request $request, $id)
    {
        // Validate the form data
        // $request->validate([
        //     'title' => 'required',
        //     'contact_number' => 'required',
        //     'price' => 'required',
        //     'space' => 'required',
        //     'rooms' => 'required',
        //     'dev_name' => 'required',
        //     'ready_construction' => 'required',
        //     'property_type' => 'required',
        //     'description' => 'required',
        // ]);

        // Create a new property
        $property = Property::findOrFail($id);
        $property->update([
            "title" => $request->title,
            "contact_number" => $request->contact_number,
            "price" => $request->price,
            "space" => $request->space,
            "rooms" => $request->rooms,
            "district" => $request->district,
            "dev_name" => $request->dev_name,
            "ready_construction" => $request->ready_construction,
            "property_type" => $request->property_type,
            // "roof" => $request->roof,
            "description" => $request->description,
        ]);

        // Check if there are any files uploaded
        if ($request->hasFile('thumb')) {
            // Delete all existing images associated with the property
            PropertyImage::where('property_id', $property->id)->delete();
            // Store each uploaded file in the public directory and save their paths
            foreach ($request->file('thumb') as $thumbFile) {
                $thumbFileName = time() . '_' . $thumbFile->getClientOriginalName();
                $thumbFile->move(public_path('assets/image/property'), $thumbFileName);

                // Create a new PropertyImage instance for each uploaded image
                PropertyImage::create([
                    'property_id' => $property->id,
                    'img' => $thumbFileName,
                ]);
            }
        }

        toastr()->success('Property updated successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);

        // Redirect to the property list page or any other page as needed
        return redirect()->route('admin.properties.edit', ['id' => $id]);
    }

    //admin delete properties route controller
    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        toastr()->success('property deleted successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.properties.all');
    }

    //admin all properties route controller
    public function all()
    {
        $properties = Property::with(['user', 'images'])->orderBy('id', 'desc')->paginate(10);
        return view('template.admin.all-properties', compact('properties'));
    }

    //admin pending properties route controller
    public function pending()
    {
        $properties = Property::with('user')->where('status', 'pending')->get();
        return view('template.admin.pending-properties', compact('properties'));
    }

    //admin approved properties route controller
    public function approved()
    {
        $properties = Property::with('user')->where('status', 'approved')->get();
        return view('template.admin.approved-properties', compact('properties'));
    }

    //admin declined properties route controller
    public function declined()
    {
        $properties = Property::with('user')->where('status', 'declined')->get();
        return view('template.admin.declined-properties', compact('properties'));
    }
}
