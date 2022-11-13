<?php

namespace App\Modules\Role\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreRole;
use Models\Role as role;

class RoleController extends MainController
{
    public function __construct()
    {
        parent::__construct(new role(), 'role');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Role::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $roles = $this->_model::where('name', '<>', 'superuser')->select('*');
            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('role.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('role.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('role.destroy', $row->id), 'preview' => route('role.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })->addColumn('status', function ($row) {
                if ($row) {
                    if ($row->is_active != null) {
                        if ($row->is_active) {
                            return '<span class="alert alert-success btn-xs">On</span>';
                        } else {
                            return '<span class="alert alert-danger btn-xs">Off</span>';
                        }

                    } else {
                        return '<span class="alert alert-danger btn-xs">Off</span>';
                    }

                }
            })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }

    public function getMenuRoleListAjax($role_id)
    {
        if (request()->ajax()) {

            $roles = \Models\MenuRole::with(['menu', 'role'])->where('role_id', $role_id)->select('*');
            return datatables()->of($roles)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('role.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('role.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('role.destroy', $row->id), 'preview' => route('role.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })->filterColumn('is_active', function ($menu, $search) {

                if ($search == "off") {
                    return $menu->where("role.is_active", 0);
                } else if ($search == "on") {
                    return $menu->where("role.is_active", 1);
                } else {

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
        return view('Role::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRole $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('role.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($role_id)
    {
        $role = $this->_model::find($role_id);
        $menu_roles = \Models\MenuRole::where('role_id', $role_id)->get();
        return view('Role::show', ['role' => $role, 'menu_roles' => $menu_roles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function preview($role_id)
    {
        $role = $this->_model::find($role_id);
        $menu_roles = \Models\MenuRole::where('role_id', $role_id)->get();
        return view('Role::preview', ['role' => $role, 'menu_roles' => $menu_roles]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit($role_id)
    {
        $role = $this->_model::find($role_id);
        return view('Role::edit', ['role' => $role]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update($role_id)
    {
        try {
            $role = $this->_model::find($role_id);
            if ($role) {
                $role->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('role.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id)
    {
        try {
            $role = $this->_model::find($role_id);
            if ($role) {
                $role->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('role.index')], 200);
    }
}
