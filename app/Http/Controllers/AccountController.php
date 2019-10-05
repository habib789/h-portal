<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('frontend.dashboard.accounts');
    }
    public function showOrder()
    {
        $data = [];
        $data['orders'] = Order::with('user')->where('user_id',auth()->user()->id)->get();
        return view('frontend.dashboard.customerOrders', $data);
    }

    public function OrderDetails($id)
    {
        $data = [];
        $data['order'] = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        return view('frontend.dashboard.orderDetails', $data);
    }
}
