<?php

namespace App\Http\Controllers;

use App\Models\Doclicense;
use App\Models\Doctor;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class adminDoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data            = [];
        $data['doctors'] = Doctor::get();
        return view('backend.doctors_list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data           = [];
        $data['doctor'] = Doctor::with('department', 'doclicense')->findOrFail($id);
        return view('backend.doctor_details', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'license_key' => 'required',
        ]);
        $doc_license = $request->input('license_key');
        $licenses    = Doclicense::select(['license_code', 'status'])
            ->where('license_code', $doc_license)
            ->where('status', 'not-in-use')
            ->get();
//        dd($licenses);
        $count = count($licenses);


        for ($i = 0; $i < $count; $i++) {
//            echo $i;
            $match = $doc_license == $licenses[$i]->license_code;
            if ($match && $match == true) {
                $verify_doc = Doctor::find($id);
                $verify_doc->update([
                    'verify' => 'verified',
                ]);

                Doclicense::where('license_code', $doc_license)
                    ->where('status', 'not-in-use')
                    ->update([
                        'doctor_id' => $verify_doc->id,
                        'status'    => 'in-use'
                    ]);
                session()->flash('type', 'success');
                session()->flash('message', 'License key matched');
                return redirect()->back();
            } else {
//                echo 'not matched';
                session()->flash('type', 'danger');
                session()->flash('message', 'License key dosent match');
                return redirect()->back();
            }
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
