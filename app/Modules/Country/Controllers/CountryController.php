<?php

namespace App\Modules\Country\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreCountry;
use Models\Country as country;

class CountryController extends MainController
{
    public function __construct()
    {
        parent::__construct(new country(), 'country');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Country::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $events = $this->_model::select('*');
            return datatables()->of($events)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('country.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('country.destroy', $row->id), 'preview' => route('country.preview', $row->id), 'title' => $row->name]);
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
        return view('Country::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCountry $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('country.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show($event_id)
    {
        $country = $this->_model::find($event_id);
        return view('Country::show', ['country' => $country]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function preview($event_id)
    {
        $country = $this->_model::find($event_id);
        return view('Country::preview', ['country' => $country]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit($event_id)
    {
        $country = $this->_model::find($event_id);
        return view('Country::edit', ['country' => $country]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update($event_id)
    {
        try {
            $country = $this->_model::find($event_id);
            if ($country) {
                $country->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('country.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy($event_id)
    {
        try {
            $country = $this->_model::find($event_id);
            if ($country) {
                $country->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('country.index')], 200);
    }
}
