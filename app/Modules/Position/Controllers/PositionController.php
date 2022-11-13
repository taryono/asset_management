<?php

namespace App\Modules\Position\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StorePosition;
use Models\Position as position;

class PositionController extends MainController
{
    public function __construct()
    {
        parent::__construct(new position(), 'position');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Position::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $positions = $this->_model::where('type', 2)->select('*');
            return datatables()->of($positions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('position.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('position.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('position.destroy', $row->id), 'preview' => route('position.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getListAjaxPeoples()
    {
        if (request()->ajax()) {
            $peoples = \Models\People::with('address')->select('*');
            if (request()->has('position_id')) {
                $position_id = request()->input('position_id');
                $peoples->whereHas('staff', function ($q) use ($position_id) {
                    $q->where('position_id', $position_id);
                });
            }
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
    {
        return view('Position::create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function structure()
    {
        return view('Position::structure');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePosition $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('position.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show($position_id)
    {
        $position = $this->_model::find($position_id);
        return view('Position::show', ['position' => $position]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function preview($position_id)
    {
        $position = $this->_model::find($position_id);
        return view('Position::preview', ['position' => $position]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($position_id)
    {
        $position = $this->_model::find($position_id);
        return view('Position::edit', ['position' => $position]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update($position_id)
    {
        try {
            $position = $this->_model::find($position_id);
            if ($position) {
                $position->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('position.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($position_id)
    {
        try {
            $position = $this->_model::find($position_id);
            if ($position) {
                $position->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('position.index')], 200);
    }
}
