<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data             = [];
        $data['products'] = Product::with('category')
            ->select(['id', 'category_id', 'name', 'price', 'quantity', 'type', 'slug', 'active', 'photo'])
            ->get();
//        dd($data['products']);
        return view('backend.products.products', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'price'    => 'required',
            'quantity' => 'required',
            'type'     => 'required',
            'photo'    => 'required|max:10240',
        ]);

        $image      = $request->file('photo');
        $image_file = uniqid('image_', true) . Str::random(10) . '.' . $image->getClientOriginalExtension();
        if ($image->isValid()) {
            $image->storeAs('images', $image_file);
        }
        $inputs_products = [
            'name'        => trim($request->input('name')),
            'category_id' => trim($request->input('category_id')),
            'slug'        => trim(Str::slug($request->input('name'))),
            'price'       => trim($request->input('price')),
            'quantity'    => trim($request->input('quantity')),
            'type'        => trim($request->input('type')),
            'photo'       => $image_file,
        ];
//dd($inputs_products);
        try {
            Product::create($inputs_products);
            session()->flash('type', 'success');
            session()->flash('message', 'successfully created a new product');
            return redirect()->route('products.index');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
