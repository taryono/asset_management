<?php

namespace App\Modules\User\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
use App\Models\User as user;
use Illuminate\Support\Facades\Hash;

class UserController extends MainController
{
    public function __construct()
    {
        parent::__construct(new user(), 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('User::index');
    }

    public function profile($id)
    {
        $user = $this->_model->find($id);
        return view('User::profile', ['user' => $user]);
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $users = $this->_model::with(['roles', 'menus'])->whereHas('roles', function ($q) {
                $q->where('name', '<>', 'superuser');
            })
                ->doesnthave('employees')
                ->select('*');
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('user.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('user.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('user.destroy', $row->id), 'preview' => route('user.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('roles', function ($row) {
                $roles = [];
                if (isset($row->roles)) {
                    foreach ($row->roles as $role) {
                        $roles[] = $role->name;
                    }
                    return join(",", $roles);
                }
            })->addColumn('permissions', function ($row) {
                $permissions = [];
                if (isset($row->menu)) {
                    foreach ($row->menu as $role) {
                        $permissions[] = $role->name;
                    }
                    return join(",", $permissions);
                }
            })
                ->rawColumns(['action', 'roles'])
                ->make(true);
        }
    }

    public function getListemployeeAjax()
    {
        if (request()->ajax()) {
            $users = $this->_model::with(['roles'])->has('employees')->select('*');
            return datatables()->of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('user.edit_employee', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('user.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('user.destroy', $row->id), 'preview' => route('user.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('roles', function ($row) {
                $roles = [];
                if (isset($row->roles)) {
                    foreach ($row->roles as $role) {
                        $roles[] = $role->name;
                    }
                    return join(",", $roles);
                }
            })->addColumn('permissions', function ($row) {
                $permissions = [];
                if (isset($row->menu)) {
                    foreach ($row->menu as $role) {
                        $permissions[] = $role->name;
                    }
                    return join(",", $permissions);
                }
            })
                ->rawColumns(['action', 'roles'])
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
        return view('User::create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_employee()
    {
        return view('User::create_employee');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUser $request)
    {
        try {
            $input = $this->_serialize($request); 
            
            if (request()->input('password')) {
                $input['password'] = Hash::make(request()->input('password'));
            }
             
            $user = $this->_model::create($input);
            $roles = \Models\Role::find(request()->role_id);
            if ($roles) {
                $user->roles()->sync($roles);
            }

            if (request()->input('employee')) {
                $employee = \Models\Employee::find(request()->input('employee_id'));
                if ($employee) {
                    $employee->user_id = $user->id;
                    $employee->save();
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user_id)
    {
        $user = $this->_model::find($user_id);
        return view('User::show', ['user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function preview($user_id)
    {
        $user = $this->_model::find($user_id);
        return view('User::preview', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user_id)
    {
        $user = $this->_model::find($user_id);
        return view('User::edit', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit_employee($user_id)
    {
        $user = $this->_model::find($user_id);
        return view('User::edit_employee', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUser $request, $user_id)
    {
        try {
            $user = $this->_model::find($user_id);
            if ($user) {
                $input = $this->_serialize($request);
                
                if (request()->input('password')) {
                    $input['password'] = Hash::make(request()->input('password'));
                }

                $user->update($input);
                $roles = \Models\Role::find(request()->role_id);
                if ($roles) {
                    $user->roles()->sync($roles);
                }
                if ($request->input('employee_id')) {
                    $employee = \Models\Employee::find(request()->input('employee_id'));
                    if ($employee) {
                        $employee->user_id = $user->id;
                        $employee->save();
                    }
                    $old_employee = \Models\Employee::where('user_id', $user->id)->first();
                    if ($old_employee->id != $employee->id) {
                        $old_employee->user_id = null;
                        $old_employee->save();
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user_id)
    {
        try {
            $user = $this->_model::find($user_id);
            if ($user) {
                $user->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.'], 200);
    }
}
