<?php

namespace App\Modules\Admin\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAsset;
use App\Models\User as user;

class AdminController extends MainController
{

    public $menu = [];

    public function __construct()
    {
        parent::__construct(new user(), 'admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin::index');
    }

    public function pages()
    {
        return view('Admin::index');
    }

    public function profile($id)
    {
        return view('Admin::profile');
    }

    public function date_range()
    {
        return view('Admin::date_range');
    }

    public function change_password()
    {
        return view('Admin::index');
    }

    public function settings()
    {
        return view('Admin::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $assets = $this->_model::select('*');
            return datatables()->of($assets)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('admin.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('admin.destroy', $row->id), 'preview' => route('admin.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->addColumn('asset_type', function ($row) {
                    return $row->asset_type ? $row->asset_type->name : "";
                })
                ->addColumn('asset_status', function ($row) {
                    return $row->asset_status ? $row->asset_status->name : "";
                })
                ->addColumn('asset_category', function ($row) {
                    return $row->asset_category ? $row->asset_category->name : "";
                })
                ->addColumn('subtotal', function ($row) {
                    return 100000;
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
        return view('Admin::create');
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
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('admin.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($asset_id)
    {
        $admin = $this->_model::find($asset_id);
        return view('Admin::show', ['admin' => $admin]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function preview($asset_id)
    {
        $admin = $this->_model::find($asset_id);
        return view('Admin::preview', ['admin' => $admin]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($asset_id)
    {
        $admin = $this->_model::find($asset_id);
        return view('Admin::edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update($asset_id)
    {
        try {
            $admin = $this->_model::find($asset_id);
            if ($admin) {
                $admin->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('admin.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($asset_id)
    {
        try {
            $admin = $this->_model::find($asset_id);
            if ($admin) {
                $admin->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('admin.index')], 200);
    }
}
