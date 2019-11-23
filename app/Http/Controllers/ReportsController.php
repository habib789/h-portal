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
        $d_first = new  Carbon('first day of this month');
        $d_first->format('Y-m-d H:i:s');
        $d_last = new  Carbon('last day of this month');
        $d_last->format('Y-m-d H:i:s');
        $data['sales'] = Order::with('user')
            ->whereBetween('created_at', [$d_first, $d_last])
            ->get();
        return view('backend.reports.sales',$data);
    }
}
