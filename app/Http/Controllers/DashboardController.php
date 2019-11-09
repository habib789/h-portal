<?php

namespace App\Http\Controllers;

use App\Events\notifyUnverifiedDoctors;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Order;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    public function showDashboard()
    {
        $data           = [];
        $data['total_appointments'] = Appointment::select('id')->count();
        $data['total_orders'] = Order::select('id')->count();
        $data['totals'] = User::select('id')->count();
        $data['orders'] = Order::get();
        return view('backend.dashboard', $data);
    }


    public function createPdf($id)
    {
        $data             = [];
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        $pdf              = PDF::loadView('backend.orders.orDetails', $data);
        return $pdf->download('invoice.pdf');
//        return view('backend.orders.orDetails', $data);
    }

    public function docNotify()
    {
        $data            = [];
        $data['doctors'] = Doctor::where('verify','not-verified')
            ->orWhere('verify','invalid-license')
            ->get();
        return view('backend.unverifiedDoc', $data);
    }

    public function NotifyDoctors($id)
    {
        $doctor = Doctor::with('user')
            ->where('id',$id)
            ->where('verify', 'not-verified')
            ->orWhere('verify','invalid-license')
            ->findOrFail($id);
            event(new notifyUnverifiedDoctors($doctor));
        return redirect()->back()->with('toast_success','License verification email sent successfully');
    }

}
