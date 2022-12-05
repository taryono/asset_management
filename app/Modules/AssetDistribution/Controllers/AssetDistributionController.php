<?php

namespace App\Modules\AssetDistribution\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetDistribution;
use Models\AssetDistribution as asset_distribution;

class AssetDistributionController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_distribution(), 'asset_distribution');
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
        return view('AssetDistribution::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_distributions = $this->_model::with(['asset','user','location'])->select('*');
            return datatables()->of($asset_distributions)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_distribution.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('asset_distribution.destroy', $row->id), 'preview' => route('asset_distribution.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetDistribution::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetDistribution $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_distribution.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetDistribution  $asset_distribution
     * @return \Illuminate\Http\Response
     */
    public function show($asset_distribution_id)
    {
        $asset_distribution = $this->_model::find($asset_distribution_id);
        return view('AssetDistribution::show', ['asset_distribution' => $asset_distribution]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetDistribution  $asset_distribution
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_distribution_id)
    {
        $asset_distribution = $this->_model::find($asset_distribution_id);
        return view('AssetDistribution::preview', ['asset_distribution' => $asset_distribution]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetDistribution  $asset_distribution
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_distribution_id)
    {
        $asset_distribution = $this->_model::find($asset_distribution_id);
        return view('AssetDistribution::edit', ['asset_distribution' => $asset_distribution]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetDistribution  $asset_distribution
     * @return \Illuminate\Http\Response
     */
    public function update($asset_distribution_id)
    {
        try {
            $asset_distribution = $this->_model::find($asset_distribution_id);
            if ($asset_distribution) {
                $asset_distribution->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_distribution.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetDistribution  $asset_distribution
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_distribution_id)
    {
        try {
            $asset_distribution = $this->_model::find($asset_distribution_id);
            if ($asset_distribution) {
                $asset_distribution->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_distribution.index')], 200);
    }
}
