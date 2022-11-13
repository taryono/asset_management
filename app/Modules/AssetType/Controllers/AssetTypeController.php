<?php

namespace App\Modules\AssetType\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetType;
use Models\AssetType as asset_type;

class AssetTypeController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_type(), 'asset_type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AssetType::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_types = $this->_model::select('*');
            return datatables()->of($asset_types)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_type.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('asset_type.destroy', $row->id), 'preview' => route('asset_type.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetType::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetType $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_type.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetType  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function show($asset_type_id)
    {
        $asset_type = $this->_model::find($asset_type_id);
        return view('AssetType::show', ['asset_type' => $asset_type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetType  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_type_id)
    {
        $asset_type = $this->_model::find($asset_type_id);
        return view('AssetType::preview', ['asset_type' => $asset_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetType  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_type_id)
    {
        $asset_type = $this->_model::find($asset_type_id);
        return view('AssetType::edit', ['asset_type' => $asset_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetType  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function update($asset_type_id)
    {
        try {
            $asset_type = $this->_model::find($asset_type_id);
            if ($asset_type) {
                $asset_type->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_type.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetType  $asset_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_type_id)
    {
        try {
            $asset_type = $this->_model::find($asset_type_id);
            if ($asset_type) {
                $asset_type->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_type.index')], 200);
    }
}
