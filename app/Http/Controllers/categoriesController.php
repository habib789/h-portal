<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class categoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.category.categories');
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ],
            [
                'name.required' => 'Category name cannot be empty!',
            ]

        );
        $inputs = [
            'name' => trim($request->input('name')),
            'slug' => Str::slug(trim($request->input('name'))),
        ];
        try{
            Category::create($inputs);
            session()->flash('type', 'success');
            session()->flash('message', 'successfully created a new category');
            return redirect()->route('categories.index');
        }catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data         = [];
        $data['cat'] = Category::find($id);
        return view('backend.category.catEdit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name,' . $id,
        ]);

        $inputs = Category::find($id);
        try {
            $inputs->update([
                'name'   => trim($request->input('name')),
                'slug'   => Str::slug(trim($request->input('name'))),
                'active' => $request->input('status'),
            ]);
//            session()->flash('type', 'success');
//            session()->flash('message', 'successfully Updated');
            return redirect()->route('categories.index')->with('success', 'Successfully Updated');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::find($id);
        $cat->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'successfully Deleted');
        return redirect()->route('categories.index');
    }
}
