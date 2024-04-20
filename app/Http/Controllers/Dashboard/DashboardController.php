<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Imports\PropertiesImport;
use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    //dashboard dashboard route controller
    public function dashboard()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the properties associated with the authenticated user where status is "pending"
        $allProperties = Property::count();
        return view('template.dashboard.index', compact('allProperties', 'user'));
    }

    //dashboard change-email properties route controller
    public function changeEmail()
    {
        return view('template.dashboard.change-email');
    }

    //dashboard change-email submit route controller
    public function changeEmailSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = Auth::user();

        $user->email = $request->email;
        $user->save();

        toastr()->success('Email changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('dashboard.change-email');
    }

    //dashboard change-password route controller
    public function changePassword()
    {
        return view('template.dashboard.change-password');
    }

    //dashboard change-password submit route controller
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
        return redirect()->route('dashboard.change-password');
    }

    //dashboard upload csv properties route controller
    public function uploadCsv()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('template.dashboard.properties-csv', compact('user'));
    }

    //dashboard submit csv properties route controller
    public function submitCsv(Request $request)
    {

        // dd($request->file('csv'));
        Excel::import(new PropertiesImport, $request->file('csv'));

        toastr()->success('Property added successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);

        // Redirect to the property list page or any other page as needed
        return redirect()->route('dashboard.properties.all');
    }

    //dashboard add properties route controller
    public function add()
    {
        // Get the authenticated user
        $user = Auth::user();
        return view('template.dashboard.add-properties', compact('user'));
    }

    //dashboard add properties submit route controller
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
        // $uniqueId = mt_rand(1000, 9999); // Generates a random number between 100 and 999
        // while (Property::where('property_id', $uniqueId)->exists()) {
        //     $uniqueId = mt_rand(1000, 9999); // Regenerate if the ID already exists
        // }

        $lastId = Property::max('property_id');
        $nextId = $lastId ? (int)$lastId + 1 : 1;

        // Create a new property
        $property = new Property();
        $property->title = $request->title;
        $property->property_id = $nextId;
        $property->contact_number = $request->contact_number;
        $property->price = $request->price;
        $property->space = $request->space;
        $property->rooms = $request->rooms;
        $property->district = $request->district;
        $property->location = $request->location;
        $property->dev_name = $request->dev_name;
        $property->ready_construction = $request->ready_construction;
        $property->property_type = $request->property_type;
        // $property->roof = $request->roof;
        $property->description = $request->description;
        $property->user_id = auth()->id();
        $property->post_by = 'user';
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
        return redirect()->route('dashboard.properties.all');
    }

    //dashboard edit properties route controller
    public function editProperty($id)
    {
        // Get the authenticated user
        $user = Auth::user();
        $property = Property::where('id', $id)->first();
        return view('template.dashboard.edit-properties', compact('property', 'user'));
    }

    //dashboard edit properties submit route controller
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
            "location" => $request->location,
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
        return redirect()->route('dashboard.properties.edit', ['id' => $id]);
    }

    //dashboard delete properties route controller
    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        toastr()->success('property deleted successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('admin.properties.all');
    }

    //dashboard all properties route controller
    public function all()
    {
        session()->forget('searched');
        // Get the authenticated user
        $user = Auth::user();

        // Get the properties associated with the authenticated user
        $properties = Property::with('images')->paginate(50);
        return view('template.dashboard.all-properties', compact('properties', 'user'));
    }

    //dashboard search properties route controller
    public function searchProperty(Request $request)
    {
        session(['searched' => 'yes']);
        $query = $request->input('query');

        $properties = Property::with(['user', 'images'])
            ->where('rooms', $query)
            ->orWhere('property_id', $query)
            ->orWhere('price', $query)
            ->orWhere('title', $query)
            ->orWhere('ready_construction', $query)
            ->orWhere('property_type', $query)
            ->orWhere('property_id', $query)
            ->orWhere('contact_number', $query)
            ->orWhere('space', $query)
            ->orWhere('district', $query)
            ->orWhere('location', $query)
            ->orWhere('dev_name', $query)
            ->orWhere('ready_construction', $query)
            ->orWhere('roof', $query)
            ->paginate(10);
        return view('template.dashboard.all-properties', compact('properties'));
    }

    //dashboard pending properties route controller
    public function pending()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the properties associated with the authenticated user where status is "pending"
        $properties = $user->properties()->where('status', 'pending')->get();
        return view('template.dashboard.pending-properties', compact('properties', 'user'));
    }

    //dashboard approved properties route controller
    public function approved()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the properties associated with the authenticated user where status is "pending"
        $properties = $user->properties()->where('status', 'approved')->get();
        return view('template.dashboard.approved-properties', compact('properties', 'user'));
    }

    //dashboard declined properties route controller
    public function declined()
    {
        // Get the authenticated user
        $user = Auth::user();

        // Get the properties associated with the authenticated user where status is "pending"
        $properties = $user->properties()->where('status', 'declined')->get();
        return view('template.dashboard.declined-properties', compact('properties', 'user'));
    }
}
