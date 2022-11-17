<?php

namespace App\Modules\Supplier\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreSupplier;
use Models\Supplier as supplier;

class SupplierController extends MainController
{
    public function __construct()
    {
        parent::__construct(new supplier(), 'supplier');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Supplier::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $suppliers = $this->_model::select('*');
            return datatables()->of($suppliers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between d-flex mr-1">';
                        $btn .= edit(['url' => route('supplier.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('supplier.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('supplier.destroy', $row->id), 'preview' => route('supplier.preview', $row->id), 'title' => $row->name]);
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
        return view('Supplier::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSupplier $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('supplier.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($supplier_id)
    {
        $supplier = $this->_model::find($supplier_id);
        return view('Supplier::show', ['supplier' => $supplier]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function preview($supplier_id)
    {
        $supplier = $this->_model::find($supplier_id);
        return view('Supplier::preview', ['supplier' => $supplier]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($supplier_id)
    {
        $supplier = $this->_model::find($supplier_id);
        return view('Supplier::edit', ['supplier' => $supplier]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update($supplier_id)
    {
        try {
            $supplier = $this->_model::find($supplier_id);
            if ($supplier) {
                $supplier->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('supplier.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy($supplier_id)
    {
        try {
            $supplier = $this->_model::find($supplier_id);
            if ($supplier) {
                $supplier->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('supplier.index')], 200);
    }
}
