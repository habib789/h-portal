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
            'key' => 'required|max:9',
        ]);
        $licenses = Doclicense::select(['license_code','status'])->get();
        $count = count($licenses);
        $inputs   = Doctor::find($id);
        if ($inputs->verify == 'not-verified' && $inputs->license == '') {
            for ($i = 0; $i < $count; $i++) {
                if ($licenses[$i]->status == 'not-in-use' || $licenses[$i]->license_code !== $request->input('key')) {
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
}
