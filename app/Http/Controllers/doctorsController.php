<?php

namespace App\Http\Controllers;

use App\Models\Doclicense;
use App\Models\Doctor;
use Illuminate\Http\Request;

class doctorsController extends Controller
{
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
                        session()->flash('type', 'success');
                        session()->flash('message', 'You have just added a license key. ./n. You will be notified withing 24 hours about successful verification');
                        return redirect()->back();
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
            session()->flash('type', 'info');
            session()->flash('message', 'You have already added a license key');
            return redirect()->back();
        } else {
            session()->flash('type', 'danger');
            session()->flash('message', 'you have entered wrong license key');
            return redirect()->back();
        }
    }

    public function accountInformation()
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
            session()->flash('type', 'success');
            session()->flash('message', 'Account Info updated');
            return redirect()->route('account.information');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }
}
