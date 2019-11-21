<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Days;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Product;
use App\Models\Rating;
use App\Models\TimeSlot;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data=[];
        $data['doctors'] = Doctor::with('department')->where('verify', 'verified')->paginate(8);
        return view('frontend.home',$data);
    }

    public function showDepartments()
    {
        $data            = [];
        $data['doctors'] = Doctor::with('department')->where('verify', 'verified')->get();
        return view('frontend.department.departments', $data);
    }

    public function showShop()
    {
        $searchItem       = request()->input('search');
        if (request()->input('search') !== null) {
            $data             = [];
            $data['products'] = Product::with('category')
                ->where('name', 'like', '%'.$searchItem.'%')
                ->paginate(12);
            $data['cart']     = session()->has('cart') ? session('cart') : [];
            $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
            $data['count']    = count($data['cart']);
        } else {
            $data             = [];
            $data['products'] = Product::with('category')->paginate(12);
            $data['cart']     = session()->has('cart') ? session('cart') : [];
            $data['subtotal'] = array_sum(array_column($data['cart'], 'total'));
            $data['count']    = count($data['cart']);
        }
        $data['searchItem'] = $searchItem;
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
        $data['cart']         = session()->has('cart') ? session('cart') : [];
        $data['subtotal']     = array_sum(array_column($data['cart'], 'total'));
        $data['count']        = count($data['cart']);
        return view('frontend.categoryList', $data);
    }


    public function DeptDocList($slug)
    {
        $data          = [];
        $data['depts'] = Department::with(['doctors' => function ($query) {
            $query->where('verify', 'verified');
        }])
            ->select(['id', 'name', 'slug', 'active'])
            ->where('slug', $slug)
            ->first();
        $data['doctors'] = $data['depts']->doctors;
        return view('frontend.department.deptDocList', $data);
    }



    public function DocProfile($id)
    {
        $data           = [];
        $data['doctor'] = Doctor::with('department', 'timeSlots')->findOrFail($id);
        $data['days']   = Days::get();
        $data['slots']  = TimeSlot::with('day')->where('doctor_id', $id)->get();
        $data['ratingSum'] = Rating::select('rating_star')
            ->where('doctor_id', $id)
            ->sum('rating_star');
        $data['ratingCount'] = Rating::select('rating_star')
            ->where('doctor_id', $id)
            ->count('rating_star');
        if ($data['ratingCount'] !== 0){
            $data['rate'] = ceil($data['ratingSum'] / $data['ratingCount']);
        }
        return view('frontend.department.docProfile', $data);
    }
}
