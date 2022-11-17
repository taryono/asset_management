<?php

namespace App\Modules\Structure\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreStructure;
use Models\Structure as structure;

class StructureController extends MainController
{
    public function __construct()
    {
        parent::__construct(new structure(), 'structure');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Structure::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $structures = $this->_model::with(['staff'])->select('*');
            return datatables()->of($structures)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('structure.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('structure.staff', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('structure.destroy', $row->id), 'preview' => route('structure.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })->addColumn('name', function ($row) {
                return '<a href data-href="' . (route('structure.graph', $row->id)) . '" class="show_popup" data-toggle="modal" data-target="#modalPopupDetail" data-title="' . $row->name . '">' . $row->name . '</a>';
            })
                ->rawColumns(['action', 'name'])
                ->make(true);
        }
    }

    public function getListAjaxStaff($structure_id)
    {
        if (request()->ajax()) {
            $staffs = \Models\Staff::with(['structure', 'employee', 'position'])->select('*')->whereHas('structure', function ($query) use ($structure_id) {
                $query->where('id', $structure_id);
            });
            return datatables()->of($staffs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('staff.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('employee.show', $row->employee_id), 'title' => $row->employee->name]);
                        $btn .= hapus(['url' => route('staff.destroy', $row->id), 'preview' => route('staff.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getListAjaxEmployees($structure_id)
    {
        if (request()->ajax()) {
            $staffs = \Models\Staff::with(['structure', 'employee', 'position'])->select('*')->whereHas('structure', function ($query) use ($structure_id) {
                $query->where('id', $structure_id);
            });
            return datatables()->of($staffs)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Structure::create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function structure($structure_id)
    {
        return view('Structure::staff', ['structure_id' => $structure_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStructure $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('structure.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function show($structure_id)
    {
        $structure = $this->_model::find($structure_id);
        return view('Structure::show', ['structure' => $structure]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function graph($structure_id)
    {
        $structure = $this->_model::find($structure_id);
        return view('Structure::graph', ['structure' => $structure]);
    }

    public function nodes($structure_id)
    {
        $graph = (new \Lib\Structure($structure_id))->getData();
        return response()->json($graph);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function preview($structure_id)
    {
        $structure = $this->_model::find($structure_id);
        return view('Structure::preview', ['structure' => $structure]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function edit($structure_id)
    {
        $structure = $this->_model::find($structure_id);
        return view('Structure::edit', ['structure' => $structure]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function update($structure_id)
    {
        try {
            $structure = $this->_model::find($structure_id);
            if ($structure) {
                $structure->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('structure.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Structure  $structure
     * @return \Illuminate\Http\Response
     */
    public function destroy($structure_id)
    {
        try {
            $structure = $this->_model::find($structure_id);
            if ($structure) {
                if (!isset($structure->staff)) {
                    $structure->delete();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Data tidak bisa dihapus karena tercatat beberapa staff '], 400);
                }
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('structure.index')], 200);
    }
}
