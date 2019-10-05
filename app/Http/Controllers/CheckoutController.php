<?php

namespace App\Http\Controllers;

use App\Events\OrderCreate;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $data             = [];
        $data['cart']     = session()->has('cart') ? session('cart') : [];
        $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
        $data['total']    = 50 + $data['subtotal'];
        return view('frontend.checkout', $data);
    }

    public function CheckoutProcess(Request $request)
    {
        $cart     = session()->has('cart') ? session('cart') : [];
        $subtotal = array_sum(array_column($cart, 'total'));
        $total    = 50 + $subtotal;

        if (empty($cart)) {
            return redirect('/');
        }
        $request->validate([
            'customer_name'    => 'required|string',
            'phone'            => 'required|max:10',
            'customer_address' => 'required|string|max:255',
        ]);


        $order = Order::create([
            'user_id'          => auth()->user()->id,
            'customer_name'    => $request->input('customer_name'),
            'phone'            => '+880' . $request->input('phone'),
            'customer_address' => $request->input('customer_address'),
            'total_amount'     => $total,
        ]);

        foreach ($cart as $productId => $product) {
            $order->products()->create([
                'product_id' => $productId,
                'quantity'   => $product['quantity'],
                'price'      => $product['price'],
            ]);
        }

        $order = Order::with('user')->find($order->id);
        event(new OrderCreate($order));

        session()->forget('cart');
        session()->flash('type', 'success');
        session()->flash('message', 'Order has been placed');
        return redirect()->route('cart');
    }

}
