<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\models\Patient;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function showAppointment($id)
    {
        if (auth()->user()->role=='doctor'){
            return redirect()->back()->with('info','For appointment, login as patient');
        }else{
            $data            = [];
            $data['patient'] = Patient::find(auth()->user()->patient->id);
//        $data['doctor'] = Doctor::with('timeSlots')->find($id);
            $data['slot'] = TimeSlot::with('doctor')->find($id);
            return view('frontend.appointments.appointment', $data);
        }

    }

    public function appointmentStore(Request $request)
    {
        $before = today();
        $com =strtotime($before) + 604800;
        $request->validate([
            'patient_name'     => 'required',
            'health_issue'     => 'required',
            'appointment_date' => 'required|date|after_or_equal:today|before_or_equal:'.date('M,d Y',$com),
            'appointment_time' => 'required',
            'appointment_fee'  => 'required',
        ]
            //['appointment_date.before_or_equal'=> 'The appointment date must be a date before or equal to '.date('d-m-Y',$com)]
        );
//        $booked = Appointment::where('patient_id',auth()->user()->patient->id)
//            ->where('appointment_date', )
//            ->get();

        Appointment::create([
            'patient_id'       => $request->input('patient_id'),
            'doctor_id'        => $request->input('doctor_id'),
            'time_slot_id'     => $request->input('time_slot_id'),
            'patient_name'     => trim($request->input('patient_name')),
            'appointment_date' => $request->input('appointment_date'),
            'appointment_time' => strtotime(trim($request->input('appointment_time'))),
            'health_issue'     => trim($request->input('health_issue')),
            'appointment_fee'  => $request->input('appointment_fee'),
        ]);
        return redirect()->route('myAppointments')->with('success', 'Appointment Created');
    }

    public function myAppointments()
    {
        $data                 = [];
        $data['sidebar'] = true;
        $data['appointments'] = Appointment::with('patient','doctor','timeSlot')->where('patient_id', auth()->user()->patient->id)->get();
        return view('frontend.appointments.myAppointments', $data);
    }
}
