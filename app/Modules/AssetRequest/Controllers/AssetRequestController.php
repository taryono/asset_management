<?php

namespace App\Modules\AssetRequest\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetRequest;
use Models\AssetRequest as asset_request;

class AssetRequestController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_request(), 'asset_request');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!request()->ajax()) { 
            return redirect()->to('/');
        }
        return view('AssetRequest::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_requests = $this->_model::select(['*']);
            return datatables()->of($asset_requests)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_request.edit', $row->id), 'title' => $row->name], );
                        $btn .= hapus(['url' => route('asset_request.destroy', $row->id), 'preview' => route('asset_request.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetRequest::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetRequest $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_request.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetRequest  $asset_request
     * @return \Illuminate\Http\Response
     */
    public function show($asset_request_id)
    {
        $asset_request = $this->_model::find($asset_request_id);
        return view('AssetRequest::show', ['asset_request' => $asset_request]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetRequest  $asset_request
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_request_id)
    {
        $asset_request = $this->_model::find($asset_request_id);
        return view('AssetRequest::preview', ['asset_request' => $asset_request]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetRequest  $asset_request
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_request_id)
    {
        $asset_request = $this->_model::find($asset_request_id);
        return view('AssetRequest::edit', ['asset_request' => $asset_request]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetRequest  $asset_request
     * @return \Illuminate\Http\Response
     */
    public function update($asset_request_id)
    {
        try {
            $asset_request = $this->_model::find($asset_request_id);
            if ($asset_request) {
                $asset_request->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_request.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetRequest  $asset_request
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_request_id)
    {
        try {
            $asset_request = $this->_model::find($asset_request_id);
            if ($asset_request) {
                $asset_request->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_request.index')], 200);
    }
}
