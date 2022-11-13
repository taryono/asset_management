<?php

namespace App\Modules\PostStatus\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StorePostStatus;
use Models\PostStatus as post_status;

class PostStatusController extends MainController
{
    public function __construct()
    {
        parent::__construct(new post_status(), 'post_status');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('PostStatus::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $posts = $this->_model::select(['*']);
            return datatables()->of($posts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('post_status.edit', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('post_status.destroy', $row->id), 'preview' => route('post_status.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('status', function ($row) {
                    if ($row) {
                        return ($row ? $row->name : "Draft");
                    }
                })->addColumn('bg_color', function ($row) {
                    if ($row) {
                        return '<span class="btn" style="background-color:' . $row->bg_color . '; padding:5px; color:white;">' . ($row ? $row->name : "Draft") . '</span>';
                    }
                })
                ->rawColumns(['action', 'content', 'status','bg_color'])
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
        return view('PostStatus::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostStatus $request)
    {
        try {
            $post_status = $this->_model::create($this->_serialize($request));

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('post_status.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\PostStatus  $post_status
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post_status = $this->_model::find($post_id);
        return view('PostStatus::show', ['post_status' => $post_status]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\PostStatus  $post_status
     * @return \Illuminate\Http\Response
     */
    public function preview($post_id)
    {
        $post_status = $this->_model::find($post_id);
        return view('PostStatus::preview', ['post_status' => $post_status]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\PostStatus  $post_status
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        $post_status = $this->_model::find($post_id);
        return view('PostStatus::edit', ['post_status' => $post_status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\PostStatus  $post_status
     * @return \Illuminate\Http\Response
     */
    public function update($post_id)
    {
        try {
            $post_status = $this->_model::find($post_id);
            if ($post_status) {
                $post_status->update($this->_serialize(request()));

            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('post_status.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\PostStatus  $post_status
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        try {
            $post_status = $this->_model::find($post_id);
            if ($post_status) {
                $post_status->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('post_status.index')], 200);
    }
}
