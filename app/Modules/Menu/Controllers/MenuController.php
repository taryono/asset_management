<?php

namespace App\Modules\Menu\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreMenu;
use Models\Menu as menu;

class MenuController extends MainController
{
    public function __construct()
    {
        parent::__construct(new menu(), 'menu');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('Menu::index');
    }

    public function pages()
    {
        return view('Menu::index');
    }

    public function profile()
    {
        return view('Menu::index');
    }

    public function change_password()
    {
        return view('Menu::index');
    }

    public function settings()
    {
        return view('Menu::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {

            $menus = $this->_model::with(['parent'])->where('menus.is_publish', 1)->where('menus.is_active', 1)
            ->leftJoin('menus as parent', function ($q) {$q->on('parent.id', '=', 'menus.parent_id');})
            ->select(['menus.*', 'parent.name as parent_name']);

            return datatables()->of($menus)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('menu.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('menu.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('menu.destroy', $row->id), 'preview' => route('menu.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->setRowAttr([
                    'data-id' => 'row-{{$id}}',
                ])
                ->filterColumn('parent_name', function ($menu, $search) {
                    return $menu->whereHas('parent', function ($q) use ($search) {
                        $q->where("name", 'Like', "%{$search}%");
                    });
                })->filterColumn('is_active', function ($menu, $search) {

                if ($search == "off") {
                    return $menu->where("menus.is_active", 0);
                } else if ($search == "on") {
                    return $menu->where("menus.is_active", 1);
                } else {

                }
            })->addColumn('name', function ($row) {
                if ($row) {
                    return '<a href data-href="' . url('menu/detail') . '/' . $row->id . '" class="show_detail">' . (str_replace("/", "", $row->url)) . '</a>';
                }

            })->addColumn('is_active', function ($row) {
                if ($row->is_active != null) {
                    if ($row->is_active) {
                        return '<span class="alert alert-success btn-xs">On</span>';
                    } else {
                        return '<span class="alert alert-danger btn-xs">Off</span>';
                    }

                } else {
                    return '<span class="alert alert-danger btn-xs">Off</span>';
                }
            })->addColumn('is_private', function ($row) {
                if ($row->is_private != null) {
                    if ($row->is_private) {
                        return '<span class="alert alert-danger btn-xs">Private</span>';
                    } else {
                        return '<span class="alert alert-success btn-xs">Public</span>';
                    }

                } else {
                    return '<span class="alert alert-success btn-xs">Public</span>';
                }
            })
                ->rawColumns(['action', 'name', 'is_active', 'is_private'])
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
        return view('Menu::create');
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
            $menu = $this->_model::create($this->_serialize($request));

            if ($menu) {
                if ($menu->type == "header") {
                    $attribute = \Models\Attribute::create([
                        'menu_id' => $menu->id,
                        'key' => 'text',
                        'name' => $menu->name,
                        'is_active' => 1,
                    ]);
                } else {
                    $attribute = \Models\Attribute::create([
                        'menu_id' => $menu->id,
                        'key' => 'text',
                        'name' => $menu->name,
                        'is_active' => 1,
                    ]);
                }
                if (request()->has('role_id')) {
                    $roles = \Models\Role::find(request()->input('role_id'));
                    $menu->role()->attach($roles);
                }

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('menu.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show($menu_id)
    {
        $menu = $this->_model::find($menu_id);
       

        return view('Menu::show', ['menu' => $menu]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function preview($menu_id)
    {
        $menu = $this->_model::find($menu_id);
        return view('Menu::preview', ['menu' => $menu]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function detail($menu_id)
    {
        $menu = $this->_model::find($menu_id);
        return view('Menu::attribute', ['attributes' => $menu->attributes, 'menu' => $menu]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit($menu_id)
    {
        $menu = $this->_model::find($menu_id);
        $menus = $this->_model::with(['parent'])->where('menus.is_publish', 1)->where('menus.is_active', 1)
        ->leftJoin('menus as parent', function ($q) {$q->on('parent.id', '=', 'menus.parent_id');})
        ->select(['menus.*', 'parent.name as parent_name'])->pluck('name','id')->all();
        return view('Menu::edit', ['menu' => $menu, 'menus' => $menus]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update($menu_id)
    {
        try {
            $menu = $this->_model::find($menu_id);
            if ($menu) {
                $menu->update($this->_serialize(request()));

                if (request()->has('role_id')) {
                    $detach_roles = \Models\Role::pluck('id', 'name')->all();
                    $menu->role()->detach($detach_roles);
                    $roles = \Models\Role::find(request()->input('role_id'));
                    $menu->role()->attach($roles);

                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('menu.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($menu_id)
    {
        try {
            $menu = $this->_model::find($menu_id);
            if ($menu) {
                $menu->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        //return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('menu.index')], 200);
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.'], 200);
    }
}
