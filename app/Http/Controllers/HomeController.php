<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('frontend.home');
    }

    public function showDepartments()
    {
        return view('frontend.departments');
    }

    public function showShop()
    {
        $data = [];
        $data['products'] = Product::with('category')->paginate(12);
        $data['cart']  = session()->has('cart') ? session('cart') : [];
        $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
        $data['count'] = count($data['cart']);
//        dd($data['count']);
        return view('frontend.products', $data);
    }

    public function catList($slug)
    {
        $data = [];
        $data['categoryList'] = Category::with('products')
            ->select(['id', 'name', 'slug'])
            ->where('slug', $slug)
            ->first();
        $data['products']     = $data['categoryList']->products;
        $data['cart']  = session()->has('cart') ? session('cart') : [];
        $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
        $data['count'] = count($data['cart']);
        return view('frontend.categoryList', $data);
    }
}
