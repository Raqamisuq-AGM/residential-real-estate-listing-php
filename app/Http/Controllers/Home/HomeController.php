<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    //home route controller
    public function index()
    {
        //clean search session data
        Session::forget('location');
        Session::forget('room');
        Session::forget('type');
        Session::forget('classification');
        Session::forget('price');
        //get property data
        $properties = Property::all();
        return view('template.frontend.index', compact('properties'));
    }

    //Property details route controller
    public function propertyDetails($id)
    {
        //clean search session data
        Session::forget('location');
        Session::forget('room');
        Session::forget('type');
        Session::forget('classification');
        Session::forget('price');
        //clean search session data
        $property = Property::findOrFail($id);
        return view('template.frontend.propertyDetails', compact('property'));
    }

    //search route controller
    public function search(Request $request)
    {
        $properties = Property::where('location', $request->input('location'))
            ->where('room', $request->input('room'))
            ->where('type', $request->input('type'))
            ->where('classification', $request->input('classification'))
            ->where('price', $request->input('price'))
            ->get();

        //put search session data
        Session::put('location', $request->input('location'));
        Session::put('room', $request->input('room'));
        Session::put('type', $request->input('type'));
        Session::put('classification', $request->input('classification'));
        Session::put('price', $request->input('price'));
        return view('template.frontend.searchProperty', compact('properties'));
    }

    //Login route controller
    public function login()
    {
        //clean search session data
        Session::forget('location');
        Session::forget('room');
        Session::forget('type');
        Session::forget('classification');
        Session::forget('price');
        return view('template.frontend.login');
    }

    //Login submit route controller
    public function loginSubmit(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the password matches the hashed password
            if (Hash::check($request->password, $user->password)) {
                if ($user->type === 'admin') {
                    toastr()->success('Login successful!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('admin.dashboard');
                } else {
                    toastr()->success('Login successful!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('dashboard.dashboard');
                }
            }

            // Password does not match
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    //Logout route controller
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    //Signup route controller
    public function signup()
    {
        //clean search session data
        Session::forget('location');
        Session::forget('room');
        Session::forget('type');
        Session::forget('classification');
        Session::forget('price');
        return view('template.frontend.signup');
    }

    //Signup submit route controller
    public function signupSubmit(Request $request)
    {
        // Validate the form data
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => 'user',
        ]);

        // Log in the user
        auth()->login($user);

        // Redirect to the user dashboard
        return redirect()->route('dashboard.dashboard');
    }
}
