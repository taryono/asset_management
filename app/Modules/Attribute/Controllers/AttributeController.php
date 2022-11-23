<?php

namespace App\Modules\Attribute\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreAttribute;
use Models\Attribute as Attribute;

class AttributeController extends MainController
{
    public function __construct()
    {
        parent::__construct(new Attribute(), 'Attribute');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Attribute::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $Attributes = $this->_model::with(['Attribute_type'])->select('*');
            return datatables()->of($Attributes)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('attribute.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('attribute.destroy', $row->id), 'preview' => route('attribute.preview', $row->id), 'title' => $row->name]);
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
    public function create($menu_id)
    {
        return view('Attribute::create', ['menu_id' => $menu_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttribute $request)
    {
        try {
            $attribute = $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('attribute.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function show($Attribute_id)
    {
        $Attribute = $this->_model::find($Attribute_id);
        return view('Attribute::show', ['Attribute' => $Attribute]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function preview($Attribute_id)
    {
        $Attribute = $this->_model::find($Attribute_id);
        return view('Attribute::preview', ['Attribute' => $Attribute]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function edit($attribute_id)
    {
        $attribute = $this->_model::find($attribute_id);
        return view('Attribute::edit', ['attribute' => $attribute]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function update($Attribute_id)
    {
        try {
            $Attribute = $this->_model::find($Attribute_id);
            if ($Attribute) {
                $Attribute->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('attribute.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Attribute  $Attribute
     * @return \Illuminate\Http\Response
     */
    public function destroy($Attribute_id)
    {
        try {
            $Attribute = $this->_model::find($Attribute_id);
            if ($Attribute) {
                $Attribute->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('attribute.index')], 200);
    }
}
