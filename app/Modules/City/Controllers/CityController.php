<?php

namespace App\Modules\City\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreCity;
use Models\City as city;

class CityController extends MainController
{
    public function __construct()
    {
        parent::__construct(new city(), 'city');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('City::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $cities = $this->_model::with(['region'])->select('*');
            if (request()->has('region_id')) {
                $cities->where('region_id', request()->input('region_id'));
            }
            return datatables()->of($cities)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('city.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('city.destroy', $row->id), 'preview' => route('city.preview', $row->id), 'title' => $row->name]);
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
        $region = request()->has('region_id') ? \Models\Region::find(request()->input('region_id')) : null;
        return view('City::create', ['region' => $region]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCity $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('city.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $city = $this->_model::find($event_id);
        return view('City::show', ['city' => $city]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function preview($event_id)
    {
        $city = $this->_model::find($event_id);
        return view('City::preview', ['city' => $city]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function edit($event_id)
    {
        $city = $this->_model::find($event_id);
        return view('City::edit', ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function update($event_id)
    {
        try {
            $city = $this->_model::find($event_id);
            if ($city) {
                $city->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('city.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\City  $city
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {
        try {
            $city = $this->_model::find($event_id);
            if ($city) {
                $city->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('city.index')], 200);
    }
}
