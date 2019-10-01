<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use mysql_xdevapi\Session;
use phpDocumentor\Reflection\Types\String_;

class CartController extends Controller
{
    public function index()
    {
        $data          = [];
        $data['cart']  = session()->has('cart') ? session('cart') : [];
        $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
        return view('frontend.cart', $data);
    }

    public function AddToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
        ]);
        $cart    = session()->has('cart') ? session('cart') : [];
        $product = Product::findOrFail($request->input('product_id'));
        $key     = (string)$product->id;
        if (array_key_exists($key, $cart)) {
            $cart[$key]['quantity']++;
            $cart[$key]['total'] = $cart[$key]['quantity'] * $product->price;
        } else {
            $cart[$key] = [
                'photo'    => $product->photo,
                'name'     => $product->name,
                'price'    => $product->price,
                'quantity' => 1,
                'total'    => $product->price,
            ];
        }
        \session(['cart' => $cart]);
        session()->flash('type', 'success');
        session()->flash('message', 'Added to the cart');
        return redirect()->route('shop');
    }

    public function RemoveFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
        ]);
        $product = Product::findOrFail($request->input('product_id'));
        $cart    = session()->has('cart') ? session('cart') : [];
        $key     = (string)$product->id;
        if (array_key_exists($key, $cart)) {
            unset($cart[$key]);
            session(['cart' => $cart]);
            session()->flash('type', 'success');
            session()->flash('message', 'Item Removed from the cart');
            return redirect()->route('cart');
        }
    }
    public function DecreaseFromCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|numeric',
        ]);
        $product = Product::findOrFail($request->input('product_id'));
        $cart    = session()->has('cart') ? session('cart') : [];
        $key     = (string)$product->id;
        if (array_key_exists($key, $cart)) {
            if ($cart[$key]['quantity'] == 1){
                unset($cart[$key]);
            }else{
                $cart[$key]['quantity']--;
                $cart[$key]['total'] = $cart[$key]['quantity'] * $product->price;
            }
            session(['cart' => $cart]);
            session()->flash('type', 'success');
            session()->flash('message', 'Cart item updated');
            return redirect()->route('cart');
        }
    }

    public function ClearFromCart()
    {
        \session()->forget('cart');
        session()->flash('type', 'success');
        session()->flash('message', 'Cart Cleared');
        return redirect()->route('cart');
    }
}
