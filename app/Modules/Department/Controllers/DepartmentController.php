<?php

namespace App\Modules\Department\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreDepartment;
use Models\Department as department;

class DepartmentController extends MainController
{
    public function __construct()
    {
        parent::__construct(new department(), 'department');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Department::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $departments = $this->_model::select('*');
            return datatables()->of($departments)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('department.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('department.destroy', $row->id), 'preview' => route('department.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Department::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDepartment $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('department.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show($department_id)
    {
        $department = $this->_model::find($department_id);
        return view('Department::show', ['department' => $department]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function preview($department_id)
    {
        $department = $this->_model::find($department_id);
        return view('Department::preview', ['department' => $department]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($department_id)
    {
        $department = $this->_model::find($department_id);
        return view('Department::edit', ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update($department_id)
    {
        try {
            $department = $this->_model::find($department_id);
            if ($department) {
                $department->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('department.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($department_id)
    {
        try {
            $department = $this->_model::find($department_id);
            if ($department) {
                $department->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('department.index')], 200);
    }
}
