<?php

namespace App\Modules\Subdistrict\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreSubdistrict;
use Models\Subdistrict as subdistrict;

class SubdistrictController extends MainController
{
    public function __construct()
    {
        parent::__construct(new subdistrict(), 'subdistrict');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Subdistrict::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $subdistricts = $this->_model::with(['district'])->select('*');
            if (request()->has('district_id')) {
                $subdistricts->where('district_id', request()->input('district_id'));
            }
            return datatables()->of($subdistricts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('subdistrict.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('subdistrict.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('subdistrict.destroy', $row->id), 'preview' => route('subdistrict.preview', $row->id), 'title' => $row->name]);
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
        $district = request()->has('district_id') ? \Models\District::find(request()->input('district_id')) : null;
        return view('Subdistrict::create', ['district' => $district]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubdistrict $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('subdistrict.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function show($subdistrict_id)
    {
        $subdistrict = $this->_model::find($subdistrict_id);
        return view('Subdistrict::show', ['subdistrict' => $subdistrict]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function preview($subdistrict_id)
    {
        $subdistrict = $this->_model::find($subdistrict_id);
        return view('Subdistrict::preview', ['subdistrict' => $subdistrict]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function edit($subdistrict_id)
    {
        $subdistrict = $this->_model::find($subdistrict_id);
        return view('Subdistrict::edit', ['subdistrict' => $subdistrict]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function update($subdistrict_id)
    {
        try {
            $subdistrict = $this->_model::find($subdistrict_id);
            if ($subdistrict) {
                $subdistrict->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('subdistrict.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Subdistrict  $subdistrict
     * @return \Illuminate\Http\Response
     */
    public function destroy($subdistrict_id)
    {
        try {
            $subdistrict = $this->_model::find($subdistrict_id);
            if ($subdistrict) {
                $subdistrict->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('subdistrict.index')], 200);
    }
}
