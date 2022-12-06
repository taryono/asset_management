<?php

namespace App\Modules\CompanyType\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreCompanyType;
use Models\CompanyType as company_type;

class CompanyTypeController extends MainController
{
    public function __construct()
    {
        parent::__construct(new company_type(), 'company_type'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        if (!request()->ajax()) { 
            return redirect()->to('/');
        }
        return view('CompanyType::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $company_types = $this->_model::select('*');
            return datatables()->of($company_types)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('company_type.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('company_type.destroy', $row->id), 'preview' => route('company_type.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                }) 
                ->rawColumns(['action','bg_color'])
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
        return view('CompanyType::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyType $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('company_type.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\CompanyType  $company_type
     * @return \Illuminate\Http\Response
     */
    public function show($company_type_id)
    {
        $company_type = $this->_model::find($company_type_id);
        return view('CompanyType::show', ['company_type' => $company_type]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\CompanyType  $company_type
     * @return \Illuminate\Http\Response
     */
    public function preview($company_type_id)
    {
        $company_type = $this->_model::find($company_type_id);
        return view('CompanyType::preview', ['company_type' => $company_type]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\CompanyType  $company_type
     * @return \Illuminate\Http\Response
     */
    public function edit($company_type_id)
    {
        $company_type = $this->_model::find($company_type_id);
        return view('CompanyType::edit', ['company_type' => $company_type]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\CompanyType  $company_type
     * @return \Illuminate\Http\Response
     */
    public function update($company_type_id)
    {
        try {
            $company_type = $this->_model::find($company_type_id);
            if ($company_type) {
                $company_type->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('company_type.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\CompanyType  $company_type
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_type_id)
    {
        try {
            $company_type = $this->_model::find($company_type_id);
            if ($company_type) {
                $company_type->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('company_type.index')], 200);
    }
}
