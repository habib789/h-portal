<?php

namespace App\Http\Controllers;

use App\Events\OrderCreate;
use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Stripe\Charge;
use Stripe\Stripe;

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

        if ($subtotal >= 100) {
            if (!empty($cart)) {
                $request->validate([
                    'customer_name'    => 'required|string',
                    'phone'            => 'required|min:11|max:11',
                    'customer_address' => 'required|string|max:255',
                ]);

                Stripe::setApiKey('sk_test_9yfUqjk39wVMpolDQ8fpk4GB003GyLgymJ');
                $token  = $_POST['stripeToken'];
                $charge = Charge::create([
                    'amount'      => $total * 100,
                    'currency'    => 'usd',
                    'description' => 'Amount Paid',
                    'source'      => $token,
                ]);

                $order = Order::create([
                    'user_id'          => auth()->user()->id,
                    'customer_name'    => $request->input('customer_name'),
                    'phone'            => '+88' . $request->input('phone'),
                    'customer_address' => $request->input('customer_address'),
                    'payment_status'   => 'Cleared',
                    'total_amount'     => $total,
                    'transaction_code' => $charge->id,
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
                return redirect()->route('shop')->with('success', 'Order created successfully');
            } else {
                return redirect('/shop');
            }
        }else{
            return redirect()->route('cart')->with('toast_error','You have to order minimum purchase rate of BDT 100 TK');
        }

    }

}
