<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\models\Patient;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{

    public function RegisterForm()
    {
        return view('frontend.register');
    }

    public function RegisterProcess(Request $request)
    {
        $before = today();
        $com    = strtotime($before) - 3153600000;
//        dd(date('M,d Y', $com));
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone'                 => 'required|string|min:6|max:11|unique:patients,phone',
            'gender'                => 'required',
            'blood_group'           => 'required',
            'date_of_birth'         => 'required|date|before_or_equal:today|after_or_equal:' . date('Y-m-d', $com),
        ]);

        try {
            $user           = new User();
            $user->email    = $request->email;
            $user->password = bcrypt($request->password);
            $user->role     = $request->role;
            $user->save();

            $patient        = new Patient();
            $request->phone = '+88' . $request->phone;
//            dd($request->phone );
            $patient->user_id       = $user->id;
            $patient->first_name    = $request->first_name;
            $patient->last_name     = $request->last_name;
            $patient->gender        = $request->gender;
            $patient->phone         = $request->phone;
            $patient->blood_group   = $request->blood_group;
            $patient->date_of_birth = $request->date_of_birth;
            $patient->save();
            event(new Registered($user));

            return redirect()->route('auth.login')->with('success', 'Registered successfully');
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
        $before = today();
        $com    = strtotime($before) - 788400000;
        $after    = strtotime($before) - 3153600000;
        $age = date('Y',$com) - date('Y',strtotime($before));
        $request->validate([
            'first_name'            => 'required',
            'last_name'             => 'required',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'phone'                 => 'required|string|min:6|max:11|unique:doctors,phone',
            'gender'                => 'required',
            'graduate'              => 'required',
            'department'            => 'required',
            'experience'            => 'required',
            'degrees'               => 'required',
            'date_of_birth'         => 'required|date|before_or_equal:'.date('Y-m-d', $com).'|after_or_equal:' . date('Y-m-d', $after),
            'paper'                 => 'required|mimes:doc,docx,pdf|max:5129',
        ]);

        try {
            $user           = new User();
            $user->email    = $request->email;
            $user->password = bcrypt($request->password);
            $user->role     = $request->role;
            $user->save();

            $doctor     = new Doctor();
            $paper      = $request->file('paper');
            $paper_file = uniqid('doc_', true) . Str::random(10) . '.' . $paper->getClientOriginalExtension();
//           dd($image_file);
            if ($paper->isValid()) {
                $paper->storeAs('docx', $paper_file);
            }
            $request->phone = '+88' . $request->phone;
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
            $doctor->date_of_birth = $request->date_of_birth;
            $doctor->document      = $paper_file;
            $doctor->save();
            event(new Registered($user));
            return redirect()->route('auth.login')->with('success', 'Registered successfully');
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
        return redirect()->back()->with('error', 'Invalid Credentials');
    }

    public function logout()
    {
        Auth::logout();
        session()->flash('type', 'info');
        session()->flash('message', 'You have been logged out');
        return redirect()->route('auth.login');
    }
}
