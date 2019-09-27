<?php

namespace App\Http\Controllers;

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
        return view('frontend.products');
    }
}
