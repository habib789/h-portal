<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Days;
use App\Models\Department;
use App\Models\Doctor;
use App\models\Patient;
use App\Models\Report;
use App\Models\TimeSlot;
use Barryvdh\DomPDF\Facade as PDF;
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
            ->where('department_id', auth()->user()->doctor->department_id)
            ->where('doctor_id', auth()->user()->doctor->id)
            ->where('appointment_date', $match_today)
            ->get();
        return view('frontend.appointments.todaysApp', $data);
    }

    public function AppointmentsDetails($id)
    {
        $data                    = [];
        $data['sidebar']         = true;
        $data['patient_detail'] = Appointment::with('patient')
            ->where('patient_id', $id)
            ->where('appointment_date', date('Y-m-d', strtotime(today())))
            ->first();
        return view('frontend.appointments.todaysAppDetails', $data);
    }

    public function ShowAllAppointments()
    {
        $data                 = [];
        $data['sidebar']      = true;
        $data['Appointments'] = Appointment::with('patient')
            ->where('doctor_id', auth()->user()->doctor->id)
            ->where('department_id', auth()->user()->doctor->department_id)
            ->orderByDesc('appointment_date')
            ->orderByDesc('appointment_time')
            ->paginate(7);
        return view('frontend.appointments.allAppointments', $data);
    }

    public function ShowAllAppointmentsDetails($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['report']  = Appointment::with('doctor', 'patient')
            ->where('id', $id)
            ->where('doctor_id', auth()->user()->doctor->id)
            ->where('department_id', auth()->user()->doctor->department_id)
            ->first();
        $data['rep'] = Report::with(['appointment' => function ($query) {
            $query->where('department_id', auth()->user()->doctor->department_id);
        }])
            ->where('appointment_id', $id)
            ->where('doctor_id', auth()->user()->doctor->id)
            ->first();
        return view('frontend.appointments.allPatientReports', $data);
    }


    public function showPrescriptionForm($id)
    {
        $data                = [];
        $data['sidebar']     = true;
        $data['appointment'] = Appointment::with('patient', 'doctor')
            ->where('id', $id)
            ->get();
        return view('frontend.appointments.prescription', $data);
    }

    public function PrescriptionStore(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required',
            'patient_id'     => 'required',
            'doctor_id'      => 'required',
            'test'           => 'string|max:255|nullable',
            'medication'     => 'string|max:255|nullable',
            'notes'          => 'required|string|max:255',
        ]);

        try {
            $insertReport = Report::create([
                'appointment_id' => $request->input('appointment_id'),
                'patient_id'     => $request->input('patient_id'),
                'doctor_id'      => $request->input('doctor_id'),
                'test'           => trim($request->input('test')),
                'medication'     => trim($request->input('medication')),
                'notes'          => trim($request->input('notes')),
            ]);
            $insertReport->appointment()->update([
                'appointment_status' => 'prescribed',
            ]);
            return redirect()->back()->with('success', 'Prescription created');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    public function myMediRecords($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['report']  = Appointment::with('doctor', 'patient')
            ->where('id', $id)
            ->where('patient_id', auth()->user()->patient->id)
            ->first();
        $data['rep'] = Report::with('appointment')
            ->where('appointment_id', $id)
            ->where('patient_id', auth()->user()->patient->id)
            ->first();
        return view('frontend.appointments.myRecords', $data);
    }

    public function elcetronicInvoice($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['report']  = Appointment::with('doctor', 'patient')
            ->where('id', $id)
            ->where('patient_id', auth()->user()->patient->id)
            ->first();
        $data['rep'] = Report::with('appointment')
            ->where('appointment_id', $id)
            ->where('patient_id', auth()->user()->patient->id)
            ->first();

        $pdf              = PDF::loadView('frontend.dashboard.pdf.myRec', $data);
        return $pdf->download('e-prescription.pdf');
    }
}
