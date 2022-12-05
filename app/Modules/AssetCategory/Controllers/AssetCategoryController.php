<?php

namespace App\Modules\AssetCategory\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAssetCategory;
use Models\AssetCategory as asset_category;

class AssetCategoryController extends MainController
{
    public function __construct()
    {
        parent::__construct(new asset_category(), 'asset_category');
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
        return view('AssetCategory::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $asset_categorys = $this->_model::select(['*']);
            return datatables()->of($asset_categorys)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('asset_category.edit', $row->id), 'title' => $row->name], );
                        $btn .= hapus(['url' => route('asset_category.destroy', $row->id), 'preview' => route('asset_category.preview', $row->id), 'title' => $row->name]);
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
        return view('AssetCategory::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAssetCategory $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset_category.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function show($asset_category_id)
    {
        $asset_category = $this->_model::find($asset_category_id);
        return view('AssetCategory::show', ['asset_category' => $asset_category]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_category_id)
    {
        $asset_category = $this->_model::find($asset_category_id);
        return view('AssetCategory::preview', ['asset_category' => $asset_category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_category_id)
    {
        $asset_category = $this->_model::find($asset_category_id);
        return view('AssetCategory::edit', ['asset_category' => $asset_category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function update($asset_category_id)
    {
        try {
            $asset_category = $this->_model::find($asset_category_id);
            if ($asset_category) {
                $asset_category->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset_category.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\AssetCategory  $asset_category
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_category_id)
    {
        try {
            $asset_category = $this->_model::find($asset_category_id);
            if ($asset_category) {
                $asset_category->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset_category.index')], 200);
    }
}
