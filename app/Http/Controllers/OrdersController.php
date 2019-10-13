<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class OrdersController extends Controller
{

    public function index()
    {
        $data           = [];
        $data['orders'] = Order::with('user')
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('backend.orders.order', $data);
    }


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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data             = [];
        $data['order']    = Order::findOrFail($id);
        $data['products'] = $data['order']->products;
        return view('backend.orders.details', $data);
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
