<?php

namespace App\Modules\Region\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreRegion;
use Models\Region as region;

class RegionController extends MainController
{
    public function __construct()
    {
        parent::__construct(new region(), 'region');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Region::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $regions = $this->_model::with(['country'])->select('*');
            if (request()->has('country_id')) {
                $regions->where('country_id', request()->input('country_id'));
            }
            return datatables()->of($regions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('region.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('region.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('region.destroy', $row->id), 'preview' => route('region.preview', $row->id), 'title' => $row->name]);
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
        $country = request()->has('country_id') ? \Models\Country::find(request()->input('country_id')) : null;
        return view('Region::create', ['country' => $country]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegion $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('region.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($region_id)
    {
        $region = $this->_model::find($region_id);
        return view('Region::show', ['region' => $region]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function preview($region_id)
    {
        $region = $this->_model::find($region_id);
        return view('Region::preview', ['region' => $region]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit($region_id)
    {
        $region = $this->_model::find($region_id);
        return view('Region::edit', ['region' => $region]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update($region_id)
    {
        try {
            $region = $this->_model::find($region_id);
            if ($region) {
                $region->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('region.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy($region_id)
    {
        try {
            $region = $this->_model::find($region_id);
            if ($region) {
                $region->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('region.index')], 200);
    }
}
