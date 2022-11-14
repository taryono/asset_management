<?php

namespace App\Modules\AssetMaintenance\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetMaintenance;
use Models\AssetMaintenance as asset_maintenance;

class AssetMaintenanceController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_maintenance(), 'asset_maintenance');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AssetMaintenance::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_maintenances = $this->_model::select('*');
            return datatables()->of($asset_maintenances)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_maintenance.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('asset_maintenance.destroy', $row->id), 'preview' => route('asset_maintenance.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })->addColumn('bg_color', function ($row) {
                    if ($row) {
                        $btn = '<span class="btn" style="background-color:'.$row->bg_color.'">';
                         
                        $btn .= '</span>';
                        return $btn;
                    }
                })
                ->rawColumns(['action','bg_color'])
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
        return view('AssetMaintenance::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetMaintenance $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_maintenance.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetMaintenance  $asset_maintenance
     * @return \Illuminate\Http\Response
     */
    public function show($asset_maintenance_id)
    {
        $asset_maintenance = $this->_model::find($asset_maintenance_id);
        return view('AssetMaintenance::show', ['asset_maintenance' => $asset_maintenance]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetMaintenance  $asset_maintenance
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_maintenance_id)
    {
        $asset_maintenance = $this->_model::find($asset_maintenance_id);
        return view('AssetMaintenance::preview', ['asset_maintenance' => $asset_maintenance]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetMaintenance  $asset_maintenance
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_maintenance_id)
    {
        $asset_maintenance = $this->_model::find($asset_maintenance_id);
        return view('AssetMaintenance::edit', ['asset_maintenance' => $asset_maintenance]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetMaintenance  $asset_maintenance
     * @return \Illuminate\Http\Response
     */
    public function update($asset_maintenance_id)
    {
        try {
            $asset_maintenance = $this->_model::find($asset_maintenance_id);
            if ($asset_maintenance) {
                $asset_maintenance->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_maintenance.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetMaintenance  $asset_maintenance
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_maintenance_id)
    {
        try {
            $asset_maintenance = $this->_model::find($asset_maintenance_id);
            if ($asset_maintenance) {
                $asset_maintenance->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_maintenance.index')], 200);
    }
}
