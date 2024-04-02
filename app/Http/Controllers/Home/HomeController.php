<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use App\Models\Property;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Mail;
use DB;

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

    //Guest offer route controller
    public function guestOffer($property_id)
    {
        $offerId = $property_id;
        return view('template.frontend.guest-offer', compact('offerId'));
    }

    //Get Guest offer route controller
    public function getGuestOffer($property_id)
    {
        $data = DB::table('properties')
            ->select('*')
            ->where('property_id', $property_id)
            ->get();
        return datatables()->of($data)->make(true);
    }

    //offer route controller
    public function offers(Request $request)
    {
        //get property data
        if (request()->ajax()) {
            if (!empty($request->room || $request->price || $request->type || $request->classification)) {
                $data = DB::table('properties')
                    ->select('*')
                    ->where('rooms', $request->room)
                    ->orWhere('price', $request->price)
                    ->orWhere('ready_construction', $request->type)
                    ->orWhere('property_type', $request->classification)
                    ->get();
            } else {
                $data = DB::table('properties')
                    ->select('*')
                    ->get();
            }
            return datatables()->of($data)->make(true);
        }
        return view('template.frontend.offers');
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
            ->orWhere('room', $request->input('room'))
            ->orWhere('type', $request->input('type'))
            ->orWhere('classification', $request->input('classification'))
            ->orWhere('price', $request->input('price'))
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
                } else if ($user->type === 'agent') {
                    toastr()->success('Login successful!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('agent.dashboard');
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
            'phone' => 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        // Create a new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'type' => 'user',
            'status' => 'pending',
        ]);

        // Log in the user
        auth()->login($user);

        // Redirect to the user dashboard
        return redirect()->route('dashboard.dashboard');
    }

    //Forget password route controller
    public function forgetPassword()
    {
        //clean search session data
        Session::forget('location');
        Session::forget('room');
        Session::forget('type');
        Session::forget('classification');
        Session::forget('price');
        return view('template.frontend.forget-password');
    }

    // Get OTP method
    public function getOTP(Request $request)
    {
        $request->validate([
            'email' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user == null) {
            toastr()->warning('Email not found', 'warning', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->back();
        } else {
            $otp = rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            session(['fp_has_email' => $request->input('email')]);

            Mail::to($request->input('email'))->send(new OtpMail($user->name, $otp));

            toastr()->success('OTP sent successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->route('signup.otp');
        }
    }

    // Otp method
    public function otp()
    {
        return view('template.frontend.otp');
    }

    // Otp check method
    public function otpCheck(Request $request)
    {
        $email = session()->get('fp_has_email');
        $user = User::where('email', $email)->where('otp', $request->otp)->first();

        if ($user == null) {
            toastr()->warning('Wrong OTP', 'warning', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->back();
        } else {
            return redirect()->route('signup.change-password');
        }
    }

    // Change password check method
    public function changePassword()
    {
        return view('template.frontend.change-password');
    }

    //Forget password submit route controller
    public function forgetPasswordSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::where('email', $request->input('email'))
            ->first();

        if ($user == null) {
            toastr()->success('Email not found', 'success', ['timeOut' => 5000, 'closeButton' => true]);
            return redirect()->back();
        }


        $user->password = Hash::make($request->input('password'));
        $user->save();

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the password matches the hashed password
            if (Hash::check($request->password, $user->password)) {
                if ($user->type === 'admin') {
                    toastr()->success('Password changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('admin.dashboard');
                } else if ($user->type === 'agent') {
                    toastr()->success('Password changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('agent.dashboard');
                } else {
                    toastr()->success('Password changed successfully!', 'success', ['timeOut' => 5000, 'closeButton' => true]);
                    return redirect()->route('dashboard.dashboard');
                }
            }

            // Password does not match
            Auth::logout();
        }
        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    //Offer details route controller
    public function offerDetails($offer_id)
    {
        $offerId = $offer_id;
        $property = Property::with('images')->where('property_id', $offer_id)->first();
        return view('template.frontend.propertyDetails', compact('offerId', 'property'));
    }
}
