<?php

namespace App\Modules\Location\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreLocation;
use Models\Location as location;

class LocationController extends MainController
{
    public function __construct()
    {
        parent::__construct(new location(), 'location');
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
        return view('Location::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $locations = $this->_model::select('*')->with(['parent']);
            return datatables()->of($locations)
                ->addIndexColumn()
                ->addColumn('parent', function ($row) {
                    if ($row) {
                          
                        if($row->parent){
                            return $row->parent->name;
                        } 

                        return "-";
                    }
                }) 
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('location.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('location.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('location.destroy', $row->id), 'preview' => route('location.preview', $row->id), 'title' => $row->name]);
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
        return view('Location::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLocation $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('location.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show($location_id)
    {
        $location = $this->_model::find($location_id);
        return view('Location::show', ['location' => $location]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function preview($location_id)
    {
        $location = $this->_model::find($location_id);
        return view('Location::preview', ['location' => $location]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($location_id)
    {
        $location = $this->_model::find($location_id);
        return view('Location::edit', ['location' => $location]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update($location_id)
    {
        try {
            $location = $this->_model::find($location_id);
            if ($location) {
                $location->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('location.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($location_id)
    {
        try {
            $location = $this->_model::find($location_id);
            if ($location) {
                $location->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('location.index')], 200);
    }
}
