<?php

namespace App\Modules\AssetPurchase\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetPurchase;
use Models\AssetPurchase as asset_purchase;

class AssetPurchaseController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_purchase(), 'asset_purchase');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('AssetPurchase::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_purchases = $this->_model::select('*');
            return datatables()->of($asset_purchases)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_purchase.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('asset_purchase.destroy', $row->id), 'preview' => route('asset_purchase.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetPurchase::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetPurchase $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_purchase.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetPurchase  $asset_purchase
     * @return \Illuminate\Http\Response
     */
    public function show($asset_purchase_id)
    {
        $asset_purchase = $this->_model::find($asset_purchase_id);
        return view('AssetPurchase::show', ['asset_purchase' => $asset_purchase]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetPurchase  $asset_purchase
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_purchase_id)
    {
        $asset_purchase = $this->_model::find($asset_purchase_id);
        return view('AssetPurchase::preview', ['asset_purchase' => $asset_purchase]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetPurchase  $asset_purchase
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_purchase_id)
    {
        $asset_purchase = $this->_model::find($asset_purchase_id);
        return view('AssetPurchase::edit', ['asset_purchase' => $asset_purchase]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetPurchase  $asset_purchase
     * @return \Illuminate\Http\Response
     */
    public function update($asset_purchase_id)
    {
        try {
            $asset_purchase = $this->_model::find($asset_purchase_id);
            if ($asset_purchase) {
                $asset_purchase->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_purchase.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetPurchase  $asset_purchase
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_purchase_id)
    {
        try {
            $asset_purchase = $this->_model::find($asset_purchase_id);
            if ($asset_purchase) {
                $asset_purchase->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_purchase.index')], 200);
    }
}
