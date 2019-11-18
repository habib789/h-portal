<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class departmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.dept.departments');
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
            'name' => 'required|string|unique:departments,name,',
        ],
            [
                'name.required' => 'Department name cannot be empty!',
            ]

        );
        $inputs = [
            'name' => trim($request->input('name')),
            'slug' => Str::slug(trim($request->input('name'))),
        ];
        try {
            Department::create($inputs);
//            session()->flash('type', 'success');
//            session()->flash('message', 'successfully created a new department');
            return redirect()->route('departments.index')->with('success','successfully created new department');
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
        $data         = [];
        $data['dept'] = Department::find($id);
        return view('backend.dept.deptEdit', $data);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|unique:departments,name,' . $id,
        ]);

        $inputs = Department::find($id);
        try {
            $inputs->update([
                'name'   => trim($request->input('name')),
                'slug'   => Str::slug(trim($request->input('name'))),
                'active' => $request->input('status'),
            ]);
            return redirect()->route('departments.index')->with('success','Successfully Updated');
        } catch (\Exception $e) {
            session()->flash('type', 'danger');
            session()->flash('message', $e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dept = Department::find($id);
        $dept->delete();
        alert('success', 'successfully Deleted');
        return redirect()->route('departments.index');
    }
}
