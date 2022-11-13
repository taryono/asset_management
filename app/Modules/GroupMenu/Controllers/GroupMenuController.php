<?php

namespace App\Modules\GroupMenu\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreGroupMenu;
use Models\GroupMenu as group_menu;

class GroupMenuController extends MainController
{
    public function __construct()
    {
        parent::__construct(new group_menu(), 'group_menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('GroupMenu::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $group_menus = $this->_model::select('*');
            return datatables()->of($group_menus)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('group_menu.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('group_menu.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('group_menu.destroy', $row->id), 'preview' => route('group_menu.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->addColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->name : "";
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
        return view('GroupMenu::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreGroupMenu $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('group_menu.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\GroupMenu  $group_menu
     * @return \Illuminate\Http\Response
     */
    public function show($group_menu_id)
    {
        $group_menu = $this->_model::find($group_menu_id);
        return view('GroupMenu::show', ['group_menu' => $group_menu]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\GroupMenu  $group_menu
     * @return \Illuminate\Http\Response
     */
    public function preview($group_menu_id)
    {
        $group_menu = $this->_model::find($group_menu_id);
        return view('GroupMenu::preview', ['group_menu' => $group_menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\GroupMenu  $group_menu
     * @return \Illuminate\Http\Response
     */
    public function edit($group_menu_id)
    {
        $group_menu = $this->_model::find($group_menu_id);
        return view('GroupMenu::edit', ['group_menu' => $group_menu]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\GroupMenu  $group_menu
     * @return \Illuminate\Http\Response
     */
    public function update($group_menu_id)
    {
        try {
            $group_menu = $this->_model::find($group_menu_id);
            if ($group_menu) {
                $group_menu->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('group_menu.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\GroupMenu  $group_menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($group_menu_id)
    {
        try {
            $group_menu = $this->_model::find($group_menu_id);
            if ($group_menu) {
                $group_menu->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('group_menu.index')], 200);
    }
}
