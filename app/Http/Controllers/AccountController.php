<?php

namespace App\Http\Controllers;

use App\Models\Order;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;


class AccountController extends Controller
{
    public function index()
    {
        $data            = [];
        $data['sidebar'] = true;
        return view('frontend.dashboard.accounts', $data);
    }

    public function showOrder()
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['orders'] = Order::with('user')->where('user_id', auth()->user()->id)->paginate(8);
        return view('frontend.dashboard.customerOrders', $data);
    }

    public function OrderDetails($id)
    {
        $data            = [];
        $data['sidebar'] = true;
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        return view('frontend.dashboard.orderDetails', $data);
    }

    public function generatePdf($id)
    {
        $data             = [];
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        $pdf              = PDF::loadView('frontend.dashboard.pdf.orderdetails', $data);
        return $pdf->download('invoice.pdf');
//        return view('frontend.dashboard.pdf.orderdetails',$data);
    }

}
