<?php

namespace App\Modules\Staff\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreStaff;
use Models\Staff as staff;

class StaffController extends MainController
{
    public function __construct()
    {
        parent::__construct(new staff(), 'staff');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Staff::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $staffs = $this->_model::with(['structure', 'people', 'position'])->select('*');
            return datatables()->of($staffs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('staff.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('staff.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('staff.destroy', $row->id), 'preview' => route('staff.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getListAjaxByStructureId($structure_id)
    {
        //if (request()->ajax()) {
        $staffs = $this->_model::with(['position', 'people'])->select('*')->where('structure_id', $structure_id);
        return datatables()->of($staffs)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if ($row) {
                    $btn = '<div class="justify-content-between d-flex mr-5">';
                    $btn .= edit(['url' => route('staff.edit', $row->id), 'title' => $row->name]);
                    $btn .= show(['url' => route('staff.show', $row->id), 'title' => $row->name]);
                    $btn .= hapus(['url' => route('staff.destroy', $row->id), 'preview' => route('staff.preview', $row->id), 'title' => $row->name]);
                    $btn .= '</div>';
                    return $btn;

                }
            })
            ->rawColumns(['action'])
            ->make(true);
        //}
    }

    public function getListAjaxPeoples()
    {
        if (request()->ajax()) {
            $peoples = \Models\People::with('staff')->has('staff')->select('*');
            return datatables()->of($peoples)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('people.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('people.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('people.destroy', $row->id), 'preview' => route('people.preview', $row->id), 'title' => $row->name]);
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
    {$structure = null;
        if (request()->has('structure_id')) {
            $structure = \Models\Structure::find(request()->input('structure_id'));
        }
        return view('Staff::create', ['structure' => $structure]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStaff $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('staff.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function show($staff_id)
    {
        $staff = $this->_model::find($staff_id);
        return view('Staff::show', ['staff' => $staff]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function preview($staff_id)
    {
        $staff = $this->_model::find($staff_id);
        return view('Staff::preview', ['staff' => $staff]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function edit($staff_id)
    {
        $staff = $this->_model::find($staff_id);
        return view('Staff::edit', ['staff' => $staff]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function update($staff_id)
    {
        try {
            $staff = $this->_model::find($staff_id);
            if ($staff) {
                $staff->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('staff.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Staff  $staff
     * @return \Illuminate\Http\Response
     */
    public function destroy($staff_id)
    {
        try {
            $staff = $this->_model::find($staff_id);
            if ($staff) {
                $staff->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('staff.index')], 200);
    }
}
