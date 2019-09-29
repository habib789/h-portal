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
        $data             = [];
        $data['products'] = Product::with('category')->paginate(12);
        return view('frontend.products', $data);
    }

    public function catList($slug)
    {
        $data                 = [];
        $data['categoryList'] = Category::with('products')
            ->select(['id', 'name', 'slug'])
            ->where('slug', $slug)
            ->first();
        $data['products']     = $data['categoryList']->products;
        return view('frontend.categoryList', $data);
    }
}
