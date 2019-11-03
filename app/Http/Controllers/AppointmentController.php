<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Days;
use App\Models\Doctor;
use App\models\Patient;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function showAppointment($id)
    {
        if (auth()->user()->role == 'doctor') {
            return redirect()->back()->with('info', 'For appointment, login as patient');
        } else {
            $data            = [];
            $data['patient'] = Patient::find(auth()->user()->patient->id);
//            $data['doctor'] = Doctor::with('department:id,name')->get();
            $data['slot'] = TimeSlot::with('doctor.department')->find($id);
//            dd($data['slot']);
            return view('frontend.appointments.appointment', $data);
        }

    }

    public function appointmentStore(Request $request)
    {
        $before = today();
        $com    = strtotime($before) + 604800;
        $request->validate([
                'patient_name'     => 'required',
                'health_issue'     => 'required',
                'appointment_date' => 'required|date|after_or_equal:' . date('d-m-Y', strtotime(today())) . '|before_or_equal:' . date('d-m-Y', $com),
                'appointment_time' => 'required',
                'appointment_fee'  => 'required',
            ]
        );
//
        $findAppointment = Appointment::where('patient_id', auth()->user()->patient->id)
            ->where('department_id', $request->input('department_id'))
            ->whereBetween('appointment_date', [date('Y-m-d', strtotime($before)), date('Y-m-d', $com)])
            ->count();


        if ($findAppointment == 0) {
            Appointment::create([
                'patient_id'       => $request->input('patient_id'),
                'doctor_id'        => $request->input('doctor_id'),
                'department_id'    => $request->input('department_id'),
                'time_slot_id'     => $request->input('time_slot_id'),
                'patient_name'     => trim($request->input('patient_name')),
                'appointment_date' => strtotime($request->input('appointment_date')),
                'appointment_time' => strtotime(trim($request->input('appointment_time'))),
                'health_issue'     => trim($request->input('health_issue')),
                'appointment_fee'  => $request->input('appointment_fee'),
            ]);
            return redirect()->route('myAppointments')->with('success', 'Appointment Created');
        } else {
            return redirect()->back()->with('toast_error', 'Sorry! You have already an appointment in this week. You can book appointment in other departments');
        }
    }

    public function myAppointments()
    {
        $data                 = [];
        $data['sidebar']      = true;
        $data['appointments'] = Appointment::with('patient', 'doctor', 'timeSlot')
            ->where('patient_id', auth()->user()->patient->id)
            ->get();
        return view('frontend.appointments.myAppointments', $data);
    }

    public function DocAppointments()
    {
        $today                     = today();
        $match_today               = date('Y-m-d', strtotime($today));
        $data                      = [];
        $data['sidebar']           = true;
        $data['todayAppointments'] = Appointment::with('patient')
            ->where('appointment_date', $match_today)
            ->get();
        return view('frontend.appointments.todaysApp', $data);
    }

    public function AppointmentsDetails($id)
    {
        $data                    = [];
        $data['sidebar']         = true;
        $data['patient_details'] = Appointment::with('patient')
            ->where('patient_id', $id)
            ->where('appointment_date', date('Y-m-d', strtotime(today())))
            ->get();
        return view('frontend.appointments.todaysAppDetails', $data);
    }

    public function ShowAllAppointments()
    {
        $data                 = [];
        $data['sidebar']      = true;
        $data['Appointments'] = Appointment::with('patient')
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->paginate(7);
        return view('frontend.appointments.allAppointments', $data);
    }

    public function ShowAllAppointmentsDetails($id)
    {
        $data                    = [];
        $data['sidebar']         = true;
        $date = Appointment::where('patient_id',$id)->get();
        dd($date);
        $data['patient_details'] = Appointment::with('patient')
            ->where('patient_id', $id)
            ->where('appointment_date', date('Y-m-d', strtotime(today())))
            ->get();
        return view('frontend.appointments.todaysAppDetails', $data);
    }


    public function showPrescriptionForm()
    {
        $data = [];
        $data['sidebar'] = true;
        return view('frontend.appointments.prescription',$data);
    }



}
