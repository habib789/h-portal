<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function sales()
    {
        $data    = [];
        $d_first = new  Carbon('first day of October 2019');
        $d_first->format('Y-m-d H:i:s');
        $d_last = new  Carbon('last day of this month');
        $d_last->format('Y-m-d H:i:s');
        $data['sales'] = Order::with('user')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->get();
        return view('backend.reports.sales', $data);
    }

    public function aptReports()
    {
        $data    = [];
        $d_first = new  Carbon('first day of October 2019');
        $d_first->format('Y-m-d H:i:s');
        $d_last = new  Carbon('last day of this month');
        $d_last->format('Y-m-d H:i:s');
//        $data['appDepts'] = Appointment::with('department')
//            ->select('appointment_fee')
//            ->where('appointment_status', 'prescribed')
//            ->groupBy('department_id')
//            ->count('department_id');


        $data['profits'] = Appointment::select('appointment_fee')
            ->where('appointment_status', 'prescribed')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->sum('appointment_fee');
        $per  = (10/100);
        $data['profit'] = $data['profits'] * $per ;
        $data['appReports'] = Appointment::with('patient', 'doctor', 'department')
            ->where('appointment_status', 'prescribed')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->get();
//        dd($data['appReports']);
        return view('backend.reports.appointment', $data);
    }

    public function pendingaptReports()
    {
        $data    = [];
        $d_first = new  Carbon('first day of October 2019');
        $d_first->format('Y-m-d H:i:s');
        $d_last = new  Carbon('last day of this month');
        $d_last->format('Y-m-d H:i:s');

        $data['appReports'] = Appointment::with('patient', 'doctor', 'department')
            ->where('appointment_status', 'pending')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->where('appointment_date', '<', date('Y-m-d', strtotime(today())))
            ->get();
        return view('backend.reports.pendingApp', $data);
    }
}
