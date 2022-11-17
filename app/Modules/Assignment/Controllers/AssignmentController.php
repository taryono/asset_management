<?php

namespace App\Modules\Assignment\Controllers;


use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssignment;
use Models\Assignment as Assignment;

class AssignmentController extends MainController
{
    public function __construct()
    {

        parent::__construct(new Assignment(), 'assignment');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Assignment::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $assignments = $this->_model::with(['structure', 'position', 'employee'])->select('*');
             
            return datatables()->of($assignments) 
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('assignment.edit', $row->id), 'title' => $row->name, 'type' => 'inline']);
                        $btn .= show(['url' => route('assignment.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('assignment.destroy', $row->id), 'preview' => route('assignment.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('date', function ($row) {
                    if ($row) {
                        return dateToInd($row->date);
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
        return view('Assignment::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssignment $request)
    {
        try {
            $assignments = $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Assignment  $assignments
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $assignments = $this->_model::find($id);
        return view('Assignment::show', ['assignment' => $assignments]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Assignment  $assignments
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        $assignments = $this->_model::find($id);
        return view('Assignment::preview', ['assignment' => $assignments]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Assignment  $assignments
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $assignment = $this->_model::find($id);
        return view('Assignment::edit', ['assignment' => $assignment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Assignment  $assignments
     * @return \Illuminate\Http\Response
     */
    public function update($assignments_id)
    {
        try {
            $assignments = $this->_model::find($assignments_id);
            if ($assignments) {
                $assignments->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('assignment.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Assignment  $assignments
     * @return \Illuminate\Http\Response
     */
    public function destroy($assignments_id)
    {
        try {
            $assignments = $this->_model::find($assignments_id);
            if ($assignments) {
                $assignments->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('assignment.index')], 200);
    }
}
