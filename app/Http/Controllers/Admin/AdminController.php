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

class AdminController extends Controller
{
    //admin dashboard route controller
    public function dashboard()
    {
        $users = User::where('type', 'user')->count();
        $properties = Property::where('status', 'pending')->count();
        return view('template.admin.index', compact('users', 'properties'));
    }

    //admin users properties route controller
    public function users()
    {
        $users = User::where('type', 'user')->get();
        return view('template.admin.user', compact('users'));
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
        $request->validate([
            'title' => 'required',
            'room' => 'required',
            'dev_name' => 'required',
            'classification' => 'required',
            'location' => 'required',
            'price' => 'required',
            'type' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        // Create a new property
        $property = new Property();
        $property->title = $request->title;
        $property->room = $request->room;
        $property->dev_name = $request->dev_name;
        $property->classification = $request->classification;
        $property->location = $request->location;
        $property->price = $request->price;
        $property->type = $request->type;
        $property->status = $request->status;
        $property->description = $request->description;
        $property->user_id = auth()->id();
        $property->post_by = 'admin';

        //update property thumb file
        if ($request->hasFile('thumb')) {
            // Store the uploaded file in the public directory
            $thumbFile = $request->file('thumb');
            $thumbFileName = time() . '_' . $thumbFile->getClientOriginalName();
            $thumbFile->move(public_path('assets/image/property'), $thumbFileName);
            $property->thumb = $thumbFileName;
        }

        //update property slider1 file
        if ($request->hasFile('slider1')) {
            // Store the uploaded file in the public directory
            $slider1File = $request->file('slider1');
            $slider1FileName = time() . '_' . $slider1File->getClientOriginalName();
            $slider1File->move(public_path('assets/image/property'), $slider1FileName);
            $property->slider1 = $slider1FileName;
        }

        //update property slider2 file
        if ($request->hasFile('slider2')) {
            // Store the uploaded file in the public directory
            $slider2File = $request->file('slider2');
            $slider2FileName = time() . '_' . $slider2File->getClientOriginalName();
            $slider2File->move(public_path('assets/image/property'), $slider2FileName);
            $property->slider2 = $slider2FileName;
        }

        //update property slider3 file
        if ($request->hasFile('slider3')) {
            // Store the uploaded file in the public directory
            $slider3File = $request->file('slider3');
            $slider3FileName = time() . '_' . $slider3File->getClientOriginalName();
            $slider3File->move(public_path('assets/image/property'), $slider3FileName);
            $property->slider3 = $slider3FileName;
        }

        //update property slider3 file
        if ($request->hasFile('slider4')) {
            // Store the uploaded file in the public directory
            $slider4File = $request->file('slider4');
            $slider4FileName = time() . '_' . $slider4File->getClientOriginalName();
            $slider4File->move(public_path('assets/image/property'), $slider4FileName);
            $property->slider4 = $slider4FileName;
        }

        $property->save();

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
        $request->validate([
            'title' => 'required',
            'room' => 'required',
            'classification' => 'required',
            'dev_name' => 'required',
            'location' => 'required',
            'price' => 'required',
            'type' => 'required',
            'status' => 'required',
            'description' => 'required',
        ]);

        // Create a new property
        $property = Property::findOrFail($id);
        $property->update([
            'title' => $request->title,
            'room' => $request->room,
            'classification' => $request->classification,
            'dev_name' => $request->dev_name,
            'location' => $request->location,
            'price' => $request->price,
            'type' => $request->type,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        //update property thumb file
        if ($request->hasFile('thumb')) {
            // Store the uploaded file in the public directory
            $thumbFile = $request->file('thumb');
            $thumbFileName = time() . '_' . $thumbFile->getClientOriginalName();
            $thumbFile->move(public_path('assets/image/property'), $thumbFileName);
            $property->update([
                'thumb' => $thumbFileName,
            ]);
        }

        //update property slider1 file
        if ($request->hasFile('slider1')) {
            // Store the uploaded file in the public directory
            $slider1File = $request->file('slider1');
            $slider1FileName = time() . '_' . $slider1File->getClientOriginalName();
            $slider1File->move(public_path('assets/image/property'), $slider1FileName);
            $property->update([
                'slider1' => $slider1FileName,
            ]);
        }

        //update property slider2 file
        if ($request->hasFile('slider2')) {
            // Store the uploaded file in the public directory
            $slider2File = $request->file('slider2');
            $slider2FileName = time() . '_' . $slider2File->getClientOriginalName();
            $slider2File->move(public_path('assets/image/property'), $slider2FileName);
            $property->update([
                'slider2' => $slider2FileName,
            ]);
        }

        //update property slider3 file
        if ($request->hasFile('slider3')) {
            // Store the uploaded file in the public directory
            $slider3File = $request->file('slider3');
            $slider3FileName = time() . '_' . $slider3File->getClientOriginalName();
            $slider3File->move(public_path('assets/image/property'), $slider3FileName);
            $property->update([
                'slider3' => $slider3FileName,
            ]);
        }

        //update property slider3 file
        if ($request->hasFile('slider4')) {
            // Store the uploaded file in the public directory
            $slider4File = $request->file('slider4');
            $slider4FileName = time() . '_' . $slider4File->getClientOriginalName();
            $slider4File->move(public_path('assets/image/property'), $slider4FileName);
            $property->slider4 = $slider4FileName;
            $property->update([
                'slider4' => $slider4FileName,
            ]);
        }

        $property->save();

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
        $properties = Property::with('user')->get();
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
