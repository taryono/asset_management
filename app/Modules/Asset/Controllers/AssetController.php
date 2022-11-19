<?php

namespace App\Modules\Asset\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAsset;
use Models\Asset as asset;
use Lib\File; 

class AssetController extends MainController
{
    public function __construct()
    {
        parent::__construct(new Asset(), 'asset'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

// add this code in controller

        // this is array of relation_name and its columns/fields

        $relationMapping = [
            'relation_1' => ['column_1', 'column_2', 'column_3'],
            'relation_2' => ['column_1', 'column_2'],
            'relation_2' => ['column_1', 'column_2'],
        ];

        // pass 3 data in this function 1. search_keyword 2.column_array or null array 3. relationMapping array

        //Model::search("search_string", [], $relationMapping)->get();

        return view('Asset::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $assets = $this->_model::select(['*']);

            return datatables()->of($assets)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('asset.edit', $row->id), 'title' => $row->name]);
                        //$btn .= show(['url'=> route('asset.show',$row->id), 'title'=> $row->name, 'popup'=> true]);
                        $btn .= hapus(['url' => route('asset.destroy', $row->id), 'preview' => route('asset.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->filterColumn('subtotal', function ($row, $search) {
                return $row->where("amount", 'Like', "%{$search}%")->orWhere("amount", 'Like', "%{$search}%");
            })->orderColumn('subtotal', function ($row) {
                return $row->orderBy("amount", 'desc');
            })->addColumn('photo', function ($row) {
                $image = ($row->photo && file_exists(asset('storage/assets/'.$row->photo)))?asset('storage/assets/'.$row->photo):asset('assets/images/no_image.jpg');
                return  '<img src="'.($image).'" onerror="this.src='.asset("assets/images/no_image.jpg").'" width="100px" height="100px">';
            })
            ->addColumn('asset_type', function ($row) {
                 return is_exists("name", $row->asset_type, '-', null,null, true);
            })
            ->addColumn('asset_status', function ($row) {
                return is_exists("name", $row->asset_status, '-', null,null, true);
            })->addColumn('asset_category', function ($row) {
                return is_exists("name", $row->asset_category, '-', null,null, true);
            })
                ->rawColumns(['action', 'subtotal','photo','asset_type','asset_status','asset_category'])
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
        return view('Asset::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAsset $request)
    {
        try {
            $asset = $this->_model::create($this->_serialize($request));
            if (request()->file('photo')) {
                $this->validate($request, [
                    'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (request()->file('photo')->isValid()) {
                    $file = request()->file('photo');
                    // image upload in storage/app/public/assets
                  
                    $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/assets')));
                    if ($asset->photo && file_exists(storage_path('app/public/assets/' . $asset->photo))) {
                        unlink(storage_path('app/public/assets/' . $asset->photo));
                    }
                    $asset->photo = $info->getFilename();
                    $asset->save();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('asset.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function show($asset_id)
    {
        $asset = $this->_model::find($asset_id);
        return view('Asset::show', ['asset' => $asset]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_id)
    {
        $asset = $this->_model::find($asset_id);
        return view('Asset::preview', ['asset' => $asset]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_id)
    {
        $asset = $this->_model::find($asset_id);
        return view('Asset::edit', ['asset' => $asset]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function update($asset_id)
    {
        try {
            $asset = $this->_model::find($asset_id);
            if ($asset) {
                $asset->update($this->_serialize(request()));

                if (request()->file('photo')) {
                    $this->validate(request(), [
                        'photo' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if (request()->file('photo')->isValid()) {
                        $file = request()->file('photo');
                        // image upload in storage/app/public/photo
                        $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/assets')));
                        if ($asset->photo && file_exists(storage_path('app/public/assets/' . $asset->photo))) {
                            unlink(storage_path('app/public/photos/' . $asset->photo));
                        }
                        $asset->photo = $info->getFilename();
                        $asset->save();
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                    }
                }

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('asset.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Asset  $asset
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_id)
    {
        try {
            $asset = $this->_model::find($asset_id);
            if ($asset) {
                $asset->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('asset.index')], 200);
    }
}
