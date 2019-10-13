<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function showDashboard()
    {
        return view('backend.dashboard');
    }

    public function createPdf($id)
    {
        $data             = [];
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        $pdf = PDF::loadView('frontend.dashboard.pdf.orderdetails', $data);
        return $pdf->download('invoice.pdf');
//        return view('backend.orders.orDetails', $data);
    }
}
