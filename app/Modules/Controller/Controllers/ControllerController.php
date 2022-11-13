<?php

namespace App\Modules\Controller\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreController;
use Models\Controller as controller;

class ControllerController extends MainController
{
    public function __construct()
    {
        parent::__construct(new controller(), 'controller');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Controller::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $controllers = $this->_model::select('*');
            return datatables()->of($controllers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('controller.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('controller.destroy', $row->id), 'preview' => route('controller.preview', $row->id), 'title' => $row->name]);
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
        return view('Controller::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreController $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('controller.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Controller  $controller
     * @return \Illuminate\Http\Response
     */
    public function show($controller_id)
    {
        $controller = $this->_model::find($controller_id);
        return view('Controller::show', ['controller' => $controller]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Controller  $controller
     * @return \Illuminate\Http\Response
     */
    public function preview($controller_id)
    {
        $controller = $this->_model::find($controller_id);
        return view('Controller::preview', ['controller' => $controller]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Controller  $controller
     * @return \Illuminate\Http\Response
     */
    public function edit($controller_id)
    {
        $controller = $this->_model::find($controller_id);
        return view('Controller::edit', ['controller' => $controller]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Controller  $controller
     * @return \Illuminate\Http\Response
     */
    public function update($controller_id)
    {
        try {
            $controller = $this->_model::find($controller_id);
            if ($controller) {
                $controller->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('controller.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Controller  $controller
     * @return \Illuminate\Http\Response
     */
    public function destroy($controller_id)
    {
        try {
            $controller = $this->_model::find($controller_id);
            if ($controller) {
                $controller->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('controller.index')], 200);
    }
}
