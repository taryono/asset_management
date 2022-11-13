<?php

namespace App\Modules\District\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreDistrict;
use Models\District as district;

class DistrictController extends MainController
{
    public function __construct()
    {
        parent::__construct(new district(), 'district');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('District::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $districts = $this->_model::with(['city'])->select('*');
            if (request()->has('city_id')) {
                $districts->where('city_id', request()->input('city_id'));
            }
            return datatables()->of($districts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('district.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('district.destroy', $row->id), 'preview' => route('district.preview', $row->id), 'title' => $row->name]);
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
        $city = request()->has('city_id') ? \Models\City::find(request()->input('city_id')) : null;
        return view('District::create', ['city' => $city]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDistrict $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('district.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($district_id)
    {
        $district = $this->_model::find($district_id);
        return view('District::show', ['district' => $district]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function preview($district_id)
    {
        $district = $this->_model::find($district_id);
        return view('District::preview', ['district' => $district]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit($district_id)
    {
        $district = $this->_model::find($district_id);
        return view('District::edit', ['district' => $district]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update($district_id)
    {
        try {
            $district = $this->_model::find($district_id);
            if ($district) {
                $district->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('district.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy($district_id)
    {
        try {
            $district = $this->_model::find($district_id);
            if ($district) {
                $district->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('district.index')], 200);
    }
}
