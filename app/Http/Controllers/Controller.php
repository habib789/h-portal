<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Department;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\View;


class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        $departments = Department::select(['id', 'name', 'slug', 'active'])->where('active', 1)->get();
        View::share('departments', $departments);

        $categories = Category::select(['id', 'name', 'slug', 'active'])->where('active', 1)->get();
        View::share('categories', $categories);
    }

}


