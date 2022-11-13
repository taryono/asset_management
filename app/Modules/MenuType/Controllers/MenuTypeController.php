<?php

namespace App\Modules\MenuType\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreMenu;
use Models\MenuType as menu_type;

class MenuTypeController extends MainController
{
    public function __construct()
    {
        parent::__construct(new menu_type(), 'menu_type');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('MenuType::index');
    }

    public function pages()
    {
        return view('MenuType::index');
    }

    public function profile()
    {
        return view('MenuType::index');
    }

    public function change_password()
    {
        return view('MenuType::index');
    }

    public function settings()
    {
        return view('MenuType::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $menu_type = $this->_model::select('*');
            return datatables()->of($menu_type)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('menu_type.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('menu_type.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('menu_type.destroy', $row->id), 'preview' => route('menu_type.preview', $row->id), 'title' => $row->name]);
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
        return view('MenuType::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenu $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('menu_type.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function show($menu_id)
    {
        $menu_type = $this->_model::find($menu_id);
        return view('MenuType::show', ['menu_type' => $menu_type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function preview($menu_id)
    {
        $menu_type = $this->_model::find($menu_id);
        return view('MenuType::preview', ['menu_type' => $menu_type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function detail($menu_id)
    {
        $menu_type = $this->_model::find($menu_id);
        return view('MenuType::attribute', ['attributes' => $menu_type->attributes]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function edit($menu_id)
    {
        $menu_type = $this->_model::find($menu_id);
        return view('MenuType::edit', ['menu_type' => $menu_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function update($menu_id)
    {
        try {
            $menu_type = $this->_model::find($menu_id);
            if ($menu_type) {
                $menu_type->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\MenuType  $menu_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_id)
    {
        try {
            $menu_type = $this->_model::find($menu_id);
            if ($menu_type) {
                $menu_type->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('menu_type.index')], 200);
    }
}
