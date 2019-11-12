<?php

namespace App\Http\Controllers;

use App\Models\Days;
use App\Models\Doclicense;
use App\Models\Doctor;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class doctorsController extends Controller
{
    public function index()
    {
        $data=[];
        $data['sidebar']= true;
        return view('frontend.doctor.dashboard', $data);
    }
    public function verify()
    {
        $data            = [];
        $data['sidebar'] = false;
        return view('frontend.doctor.verifyLicense', $data);
    }

    public function verifyKey(Request $request, $id)
    {
        $request->validate([
            'key' => 'required|min:9|max:9',
        ]);
        $licenses = Doclicense::select(['license_code', 'status'])->where('status', 'not-in-use')->get();
        $count    = count($licenses);
        $inputs   = Doctor::find($id);
        if ($inputs->verify == 'not-verified' && $inputs->license == '') {
            for ($i = 0; $i <= $count; $i++) {
                if ($licenses[$i]->status == 'not-in-use' && $licenses[$i]->license_code !== $request->input('key')) {
                    try {
                        $inputs->update([
                            'license' => trim($request->input('key')),
                        ]);
                        return redirect()->back()->with('success', 'You have just added a license key.');
                    } catch (\Exception $e) {
                        session()->flash('type', 'danger');
                        session()->flash('message', $e->getMessage());
                        return redirect()->back();
                    }
                } else {
                    session()->flash('type', 'info');
                    session()->flash('message', 'This license key is used by another doctor!!');
                    return redirect()->back();
                }
            }
        } elseif ($inputs->verify == 'not-verified' && $inputs->license !== '') {
            return redirect()->back()->with('info', 'You have already added a license key');
        } else {
            return redirect()->back()->with('error', 'You have entered wrong license key');
        }
    }

    public function DocAccountInformation()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['doctor']  = Doctor::find(auth()->user()->doctor->id);
        return view('frontend.doctor.info', $data);
    }

    public function licenseUpdateForm()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['doctor']  = Doctor::find(auth()->user()->doctor->id);
        return view('frontend.doctor.licenseEdit', $data);
    }

    public function UpdateInfoShow($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['docInfo'] = Doctor::find($id);
        return view('frontend.doctor.updateInfo', $data);
    }

    public function InfoUpdate(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name'  => 'required',
            'phone'      => 'required|min:11|max:14|unique:doctors,phone,' . $id,
            'graduate'   => 'required',
            'experience' => 'required',
            'department' => 'required',
            'address'    => 'required',
            'degrees'    => 'required',
            'age'        => 'required',
        ]);
        $info_update = Doctor::find($id);
        try {
            $info_update->update([
                'department_id' => trim($request->input('department')),
                'first_name'    => trim($request->input('first_name')),
                'last_name'     => trim($request->input('last_name')),
                'phone'         => trim($request->input('phone')),
                'address'       => trim($request->input('address')),
                'graduate'      => trim($request->input('graduate')),
                'experience'    => trim($request->input('experience')),
                'degrees'       => trim($request->input('degrees')),
                'age'           => trim($request->input('age')),
            ]);
            return redirect()->route('account.information')->with('success','Account Info updated');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    public function licenseUpdate(Request $request, $id)
    {
        $request->validate([
            'key' => 'required|min:9|max:9',
        ]);
        $licenses = Doclicense::select(['license_code', 'status'])->where('status', 'not-in-use')->get();
        $count    = count($licenses);
        $inputs   = Doctor::find($id);
        if ($inputs->verify == 'invalid-license' && $inputs->license == '') {
            for ($i = 0; $i <= $count; $i++) {
                if ($licenses[$i]->status == 'not-in-use' || $licenses[$i]->license_code !== $request->input('key')) {
                    try {
                        $inputs->update([
                            'license' => trim($request->input('key')),
                        ]);
                        return redirect()->route('docAccount.information')->with('success', 'You have just added a new license key');
                    } catch (\Exception $e) {
                        session()->flash('type', 'danger');
                        session()->flash('message', $e->getMessage());
                        return redirect()->back();
                    }
                } else {
                    return redirect()->back()->with('error', 'This license key is used by another user');
                }
            }
        } else {
            session()->flash('type', 'danger');
            session()->flash('message', 'you have entered wrong license key');
            return redirect()->back();
        }
    }

    public function shoeWorkingHours()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['days']    = Days::get();
        $data['slots']   = TimeSlot::with('day')->where('doctor_id', auth()->user()->doctor->id)->get();
        return view('frontend.doctor.workingHours', $data);
    }

    public function SetHours(Request $request)
    {
        $request->validate([
            'days'       => 'required',
            'start_time' => 'required',
            'end_time'   => 'required',
        ]);
        $dayId = $request->input('days');
        $time  = TimeSlot::where('doctor_id', auth()->user()->doctor->id)
            ->where('day_id', $dayId)
            ->select('day_id')
            ->get();
        $count = count($time);

//        $start_time=
        if ($count > 0) {
            TimeSlot::where('day_id', $dayId)
                ->where('doctor_id', auth()->user()->doctor->id)
                ->update([
                'start_time' => strtotime(trim($request->input('start_time'))),
                'end_time'   => strtotime(trim($request->input('end_time'))),
            ]);
            return redirect()->route('hours.show')->with('info', 'Schedule updated');
        } else {
            TimeSlot::create([
                'doctor_id'  => auth()->user()->doctor->id,
                'day_id'     => $request->input('days'),
                'start_time' => strtotime(trim($request->input('start_time'))),
                'end_time'   => strtotime(trim($request->input('end_time'))),
            ]);
            return redirect()->route('hours.show')->with('success', 'Added new schedule');
        }
    }

}
