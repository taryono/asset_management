<?php

namespace App\Modules\AssetStatus\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetStatus;
use Models\AssetStatus as asset_status;

class AssetStatusController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_status(), 'asset_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AssetStatus::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_statuss = $this->_model::select('*');
            return datatables()->of($asset_statuss)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_status.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('asset_status.destroy', $row->id), 'preview' => route('asset_status.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetStatus::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetStatus $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_status.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetStatus  $asset_status
     * @return \Illuminate\Http\Response
     */
    public function show($asset_status_id)
    {
        $asset_status = $this->_model::find($asset_status_id);
        return view('AssetStatus::show', ['asset_status' => $asset_status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetStatus  $asset_status
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_status_id)
    {
        $asset_status = $this->_model::find($asset_status_id);
        return view('AssetStatus::preview', ['asset_status' => $asset_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetStatus  $asset_status
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_status_id)
    {
        $asset_status = $this->_model::find($asset_status_id);
        return view('AssetStatus::edit', ['asset_status' => $asset_status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetStatus  $asset_status
     * @return \Illuminate\Http\Response
     */
    public function update($asset_status_id)
    {
        try {
            $asset_status = $this->_model::find($asset_status_id);
            if ($asset_status) {
                $asset_status->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_status.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetStatus  $asset_status
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_status_id)
    {
        try {
            $asset_status = $this->_model::find($asset_status_id);
            if ($asset_status) {
                $asset_status->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_status.index')], 200);
    }
}
