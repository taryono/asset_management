<?php

namespace App\Modules\MenuRole\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreMenuRole;
use Models\MenuRole as menu_role;
use Models\Role;

class MenuRoleController extends MainController
{
    public function __construct()
    {
        parent::__construct(new menu_role(), 'menu_role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('MenuRole::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $query_roles = $this->_model::with(['role', 'menu'])->select('menu_role.*')
            ->leftJoin('roles', function ($q) {
                $q->on('roles.id', '=', 'menu_role.role_id');
            })->leftJoin('menus', function ($q) {
                $q->on('menus.id', '=', 'menu_role.menu_id');
            })->where('menus.is_publish', 1);

            if (request()->has('role_id')) {
                $query_roles->where('roles.id', request()->input('role_id'));
                $query_roles->where('roles.id', '<>', 1);
            }

            $menu_roles = $query_roles->where('roles.is_active', 1)
            //->where('menu_role.menu.is_private', 0)
                ->orderBy('roles.name')
                ->orderBy('menu_role.menu_id');
            return datatables()->of($menu_roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('menu_role.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('menu_role.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('menu_role.destroy', $row->id), 'preview' => route('menu_role.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('name', function ($row) {
                if ($row) {
                    return str_replace("/", "", $row->menu->url);
                }
            })->addColumn('index', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'index" ' . (($row->index) ? "checked" : null) . ' data-value="' . $row->index . '" data-field="index" data-id="' . $row->id . '"><label for="' . $row->id . 'index"></label></div>';
                }
            })->addColumn('create', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'create" ' . (($row->create) ? "checked" : null) . ' data-value="' . $row->create . '" data-field="create" data-id="' . $row->id . '"><label for="' . $row->id . 'create"></label></div>';
                }
            })->addColumn('edit', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'edit" ' . (($row->edit) ? "checked" : null) . ' data-value="' . $row->edit . '" data-field="edit" data-id="' . $row->id . '"><label for="' . $row->id . 'edit"></label></div>';
                }
            })->addColumn('show', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'show" ' . (($row->show) ? "checked" : null) . ' data-value="' . $row->show . '" data-field="show" data-id="' . $row->id . '"><label for="' . $row->id . 'show"></label></div>';
                }
            })->addColumn('print', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'print" ' . (($row->print) ? "checked" : null) . ' data-value="' . $row->print . '" data-field="print" data-id="' . $row->id . '"><label for="' . $row->id . 'print"></label></div>';
                }
            })->addColumn('destroy', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input data-url="' . url('menu_role/updateField') . '" type="checkbox" id="' . $row->id . 'destroy" ' . (($row->destroy) ? "checked" : null) . ' data-value="' . $row->destroy . '" data-field="destroy" data-id="' . $row->id . '"><label for="' . $row->id . 'destroy"></label></div>';
                }
            })
                ->rawColumns(['action', 'index', 'edit', 'create', 'print', 'destroy', 'show'])
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
        $role = null;
        $menus = \Models\Menu::where('is_publish', 1)->where('is_active', 1)->pluck('name', 'id')->all();
        if (request()->has('role_id')) {
            $role = Role::where(['is_active' => 1, 'id' => request()->input('role_id')])->first();
            return view('MenuRole::create', compact('role', 'menus'));
        } else {
            return view('MenuRole::create', compact('role', 'menus'));
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuRole $request)
    {
        try {
            $menus = \Models\Menu::find(request()->input('menu_id'));
            if (request()->has('role_id')) {
                foreach($menus as $menu){
                    $menu->role()->detach();
                    $roles = Role::find(request()->input('role_id'));
                    $menu->role()->attach($roles); 
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('menu_role.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function show($menu_role_id)
    {
        $menu_role = $this->_model::find($menu_role_id);
        return view('MenuRole::show', ['menu_role' => $menu_role]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function preview($menu_role_id)
    {
        $menu_role = $this->_model::find($menu_role_id);
        return view('MenuRole::preview', ['menu_role' => $menu_role]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function updateField()
    {
        $menu_role = $this->_model::find(request()->id);
        $menu_role->update([request()->field => (int) !request()->value]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function edit($menu_role_id)
    {
        $menu_role = $this->_model::find($menu_role_id);
        return view('MenuRole::edit', ['menu_role' => $menu_role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function update($menu_role_id)
    {
        try {
            $menu_role = $this->_model::find($menu_role_id);
            if ($menu_role) {
                $menu_role->index = (request()->input('index') == "on") ? 1 : 0;
                $menu_role->create = (request()->input('create') == "on") ? 1 : 0;
                $menu_role->edit = (request()->input('edit') == "on") ? 1 : 0;
                $menu_role->print = (request()->input('print') == "on") ? 1 : 0;
                $menu_role->show = (request()->input('show') == "on") ? 1 : 0;
                $menu_role->destroy = (request()->input('destroy') == "on") ? 1 : 0;
                $menu_role->save();
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('menu_role.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\MenuRole  $menu_role
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_role_id)
    {
        try {
            $menu_role = $this->_model::find($menu_role_id);
            if ($menu_role) {
                $menu_role->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('menu_role.index')], 200);
    }
}
