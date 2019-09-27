<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function RegisterForm()
    {
        return view('frontend.register');
    }

    public function RegisterProcess(Request $request)
    {
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone'                 => 'required|string|min:6|max:10|unique:patients,phone',
            'gender'                => 'required',
            'blood_group'           => 'required',
            'age'                   => 'required|string|min:1|max:3',
        ]);

        try {
            $user           = new User();
            $user->email    = $request->email;
            $user->password = bcrypt($request->password);
            $user->role     = $request->role;
            $user->save();

            $patient        = new Patient();
            $request->phone = '+880' . $request->phone;
//            dd($request->phone );
            $patient->user_id     = $user->id;
            $patient->first_name  = $request->first_name;
            $patient->last_name   = $request->last_name;
            $patient->gender      = $request->gender;
            $patient->phone       = $request->phone;
            $patient->blood_group = $request->blood_group;
            $patient->age         = $request->age;
            $patient->save();
            event(new Registered($user));

            session()->flash('type', 'success');
            session()->flash('message', 'Successfully Registered');
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->route('patient.register');
        }

    }

    public function DocRegisterForm()
    {
        return view('frontend.DocRegister');
    }

    public function DocRegisterProcess(Request $request)
    {
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone'                 => 'required|string|min:6|max:10|unique:doctors,phone',
            'gender'                => 'required',
            'graduate'              => 'required',
            'experience'            => 'required',
            'degrees'               => 'required',
            'age'                   => 'required|string|min:1|max:3',
        ]);

        try {
            $user           = new User();
            $user->email    = $request->email;
            $user->password = bcrypt($request->password);
            $user->role     = $request->role;
            $user->save();

            $doctor         = new Doctor();
            $request->phone = '+880' . $request->phone;
//            dd($request->phone);
            $doctor->user_id       = $user->id;
            $doctor->department_id = $request->department;
            $doctor->first_name    = $request->first_name;
            $doctor->last_name     = $request->last_name;
            $doctor->gender        = $request->gender;
            $doctor->phone         = $request->phone;
            $doctor->graduate      = $request->graduate;
            $doctor->experience    = $request->experience;
            $doctor->degrees       = $request->degrees;
            $doctor->age           = $request->age;
            $doctor->save();

            session()->flash('type', 'success');
            session()->flash('message', 'Successfully Registered');
            return redirect()->route('auth.login');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    public function loginForm()
    {
        return view('frontend.login');
    }

    public function LoginProcess(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = $request->only(['email', 'password']);
        if (auth()->attempt($credentials)) {
//            dd(Auth::user()->doctor);
            return redirect()->intended('/');

        }
        session()->flash('type', 'danger');
        session()->flash('message', 'Invalid Credentials');
        return redirect()->back();
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('type', 'info');
        session()->flash('message', 'You have been logged out');
        return redirect()->route('auth.login');
    }
}
