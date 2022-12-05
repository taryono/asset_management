<?php

namespace App\Modules\Company\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreCompany;
use Models\Company as company;

class CompanyController extends MainController
{
    public function __construct()
    {
        parent::__construct(new company(), 'company'); 
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
        return view('Company::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $companys = $this->_model::select('*')->with(['company_type']);
            return datatables()->of($companys)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('company.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('company.destroy', $row->id), 'preview' => route('company.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })->addColumn('company_type', function ($row) {
                    if ($row) {
                        return is_exists("name", $row->company_type);
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
        return view('Company::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('company.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show($company_id)
    {
        $company = $this->_model::find($company_id);
        return view('Company::show', ['company' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function preview($company_id)
    {
        $company = $this->_model::find($company_id);
        return view('Company::preview', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($company_id)
    {
        $company = $this->_model::find($company_id);
        return view('Company::edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update($company_id)
    {
        try {
            $company = $this->_model::find($company_id);
            if ($company) {
                $company->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('company.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($company_id)
    {
        try {
            $company = $this->_model::find($company_id);
            if ($company) {
                $company->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('company.index')], 200);
    }
}
