<?php

namespace App\Modules\MenuUser\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreMenuUser;
use App\Models\User;
use Models\MenuUser as menu_user;

class MenuUserController extends MainController
{
    public function __construct()
    {
        parent::__construct(new menu_user(), 'menu_user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('MenuUser::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $query_users = $this->_model::with(['user', 'menu'])->select('menu_user.*')->leftJoin('users', function ($q) {
                $q->on('users.id', '=', 'menu_user.user_id');
            });

            if (request()->has('user_id')) {
                $query_users->where('users.id', request()->input('user_id'));
                $query_users->where('users.id', '<>', 1);
            }

            $menu_users = $query_users->orderBy('users.name')->orderBy('menu_user.menu_id');
            return datatables()->of($menu_users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-5">';
                        $btn .= edit(['url' => route('menu_user.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('menu_user.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('menu_user.destroy', $row->id), 'preview' => route('menu_user.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('index', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'index" ' . (($row->index) ? "checked" : null) . ' data-value="' . $row->index . '" data-field="index" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'index"></label></div>';
                }
            })->addColumn('create', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'create" ' . (($row->create) ? "checked" : null) . ' data-value="' . $row->create . '" data-field="create" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'create"></label></div>';
                }
            })->addColumn('edit', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'edit" ' . (($row->edit) ? "checked" : null) . ' data-value="' . $row->edit . '" data-field="edit" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'edit"></label></div>';
                }
            })->addColumn('show', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'show" ' . (($row->show) ? "checked" : null) . ' data-value="' . $row->show . '" data-field="show" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'show"></label></div>';
                }
            })->addColumn('print', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'print" ' . (($row->print) ? "checked" : null) . ' data-value="' . $row->print . '" data-field="print" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'print"></label></div>';
                }
            })->addColumn('destroy', function ($row) {
                if ($row) {
                    return '<div class="icheck-primary d-inline"><input type="checkbox" id="' . $row->id . 'destroy" ' . (($row->destroy) ? "checked" : null) . ' data-value="' . $row->destroy . '" data-field="destroy" data-id="' . $row->id . '" data-url="' . url('menu_user/updateField') . '"><label for="' . $row->id . 'destroy"></label></div>';
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
    {$user_id = null;
        if (request()->input('user_id')) {
            $user_id = request()->input('user_id');
        }
        return view('MenuUser::create', ['user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMenuUser $request)
    {
        try {
            $menus = \Models\Menu::find(request()->input('menu_id'));
            if (request()->has('user_id')) {
                $user = User::find(request()->input('user_id'));
                $user->menus()->detach();
                $user->menus()->sync($menus);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('menu_user.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function show($menu_user_id)
    {
        $menu_user = $this->_model::find($menu_user_id);
        return view('MenuUser::show', ['menu_user' => $menu_user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function preview($menu_user_id)
    {
        $menu_user = $this->_model::find($menu_user_id);
        return view('MenuUser::preview', ['menu_user' => $menu_user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function updateField()
    {
        $menu_user = $this->_model::find(request()->id);
        $menu_user->update([request()->field => (int) !request()->value]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function edit($menu_user_id)
    {
        $menu_user = $this->_model::find($menu_user_id);
        return view('MenuUser::edit', ['menu_user' => $menu_user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function update($menu_user_id)
    {
        try {
            $menu_user = $this->_model::find($menu_user_id);
            if ($menu_user) {
                $menu_user->index = (request()->input('index') == "on") ? 1 : 0;
                $menu_user->create = (request()->input('create') == "on") ? 1 : 0;
                $menu_user->edit = (request()->input('edit') == "on") ? 1 : 0;
                $menu_user->print = (request()->input('print') == "on") ? 1 : 0;
                $menu_user->show = (request()->input('show') == "on") ? 1 : 0;
                $menu_user->destroy = (request()->input('destroy') == "on") ? 1 : 0;
                $menu_user->save();
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('menu_user.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\MenuUser  $menu_user
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_user_id)
    {
        try {
            $menu_user = $this->_model::find($menu_user_id);
            if ($menu_user) {
                $menu_user->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('menu_user.index')], 200);
    }
}
