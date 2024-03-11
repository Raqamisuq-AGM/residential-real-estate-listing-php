<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\SystemLogo;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PropertiesImport;
use App\Models\PropertyImage;
use Illuminate\Support\Str;

class AgentController extends Controller
{
    //admin dashboard route controller
    public function dashboard()
    {
        $users = User::where('type', 'user')->count();
        $agents = User::where('type', 'agent')->count();
        $properties = Property::count();
        return view('template.agent.index', compact('users', 'agents', 'properties'));
    }

    //admin users properties route controller
    public function users()
    {
        $users = User::where('type', 'user')->orderBy('id', 'desc')->get();
        return view('template.agent.user', compact('users'));
    }

    //admin approve user properties route controller
    public function approveUser($id)
    {
        $user = User::find($id);
        $user->status = 'approved';
        $user->save();

        toastr()->success('User approved successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('agent.users');
    }

    //admin disapprove user properties route controller
    public function disapproveUser($id)
    {
        $user = User::find($id);
        $user->status = 'disapproved';
        $user->save();

        toastr()->success('User disapproved successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('agent.users');
    }

    //admin delete user properties route controller
    public function deleteUser($id)
    {
        $user = User::find($id);

        if (!$user) {
            // User not found, handle error
            toastr()->error('User not found!', 'Error', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->route('agent.users');
        }

        $user->delete();

        toastr()->success('User deleted successfully!', 'Success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('agent.users');
    }

    //admin change-email properties route controller
    public function changeEmail()
    {
        return view('template.agent.change-email');
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
        return redirect()->route('agent.change-email');
    }

    //admin change-password properties route controller
    public function changePassword()
    {
        return view('template.agent.change-password');
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
        return redirect()->route('agent.change-password');
    }

    //admin upload csv properties route controller
    public function uploadCsv()
    {
        return view('template.agent.properties-csv');
    }

    //admin submit csv properties route controller
    public function submitCsv(Request $request)
    {

        // dd($request->file('csv'));
        Excel::import(new PropertiesImport, $request->file('csv'));

        toastr()->success('Property added successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);

        // Redirect to the property list page or any other page as needed
        return redirect()->route('agent.properties.all');
    }

    //admin add properties route controller
    public function add()
    {
        return view('template.agent.add-properties');
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
        $uniqueId = mt_rand(1000, 9999); // Generates a random number between 100 and 999
        while (Property::where('property_id', $uniqueId)->exists()) {
            $uniqueId = mt_rand(1000, 9999); // Regenerate if the ID already exists
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
        $property->location = $request->location;
        $property->dev_name = $request->dev_name;
        $property->ready_construction = $request->ready_construction;
        $property->property_type = $request->property_type;
        $property->roof = $request->roof;
        $property->description = $request->description;
        $property->user_id = auth()->id();
        $property->post_by = 'agent';
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
        return redirect()->route('agent.properties.all');
    }

    //admin edit properties route controller
    public function editProperty($id)
    {
        $property = Property::where('id', $id)->first();
        return view('template.agent.edit-properties', compact('property'));
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
            "location" => $request->location,
            "dev_name" => $request->dev_name,
            "ready_construction" => $request->ready_construction,
            "property_type" => $request->property_type,
            "roof" => $request->roof,
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
        return redirect()->route('agent.properties.edit', ['id' => $id]);
    }

    //admin delete properties route controller
    public function deleteProperty($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        toastr()->success('property deleted successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
        return redirect()->route('agent.properties.all');
    }

    //admin all properties route controller
    public function all()
    {
        session()->forget('searched');
        $properties = Property::with(['user', 'images'])->orderBy('id', 'desc')->paginate(10);
        return view('template.agent.all-properties', compact('properties'));
    }

    //admin search properties route controller
    public function searchProperty(Request $request)
    {
        session(['searched' => 'yes']);
        $query = $request->input('query');

        $properties = Property::with(['user', 'images'])
            ->where('rooms', $query)
            ->orWhere('price', $query)
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
        return view('template.agent.all-properties', compact('properties'));
    }

    //admin pending properties route controller
    public function pending()
    {
        $properties = Property::with('user')->where('status', 'pending')->get();
        return view('template.agent.pending-properties', compact('properties'));
    }

    //admin approved properties route controller
    public function approved()
    {
        $properties = Property::with('user')->where('status', 'approved')->get();
        return view('template.agent.approved-properties', compact('properties'));
    }

    //admin declined properties route controller
    public function declined()
    {
        $properties = Property::with('user')->where('status', 'declined')->get();
        return view('template.agent.declined-properties', compact('properties'));
    }
}
