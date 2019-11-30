<?php

namespace App\Http\Controllers;

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
//        $data['months'] = Order::select('created_at')
//            ->whereBetween('created_at', [$d_first,date('Y-m-d', strtotime(today()))])
////            ->groupby('created_at')
//            ->groupby(date('F', strtotime('created_at')))
//            ->get();
//        dd($data['months']);
        $data['sales'] = Order::with('user')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->get();
        return view('backend.reports.sales',$data);
    }
}
