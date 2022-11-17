<?php

namespace App\Modules\Post\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StorePost;
use Models\Post as post;

class PostController extends MainController
{
    public function __construct()
    {
        parent::__construct(new post(), 'post');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Post::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $posts = $this->_model::with(['category'])->select(['*']);
            return datatables()->of($posts)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="d-flex mr-1">';
                        $btn .= edit(['url' => route('post.edit', $row->id), 'title' => $row->name, 'type' => 'inline']);
                        $btn .= show(['url' => route('post.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('post.destroy', $row->id), 'preview' => route('post.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('status', function ($row) {
                if ($row) {
                    return '<span class="btn ' . ($row->post_status ? $row->post_status->bg_color : "btn-primary") . '">' . ($row->post_status ? $row->post_status->name : "Draft") . '</span>';
                }
            })
                ->rawColumns(['action', 'content', 'status'])
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
        return view('Post::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        try {
            $post = $this->_model::create($this->_serialize($request));
            $post->slug = str_replace(" ", "-", strtolower($post->title));
            $post->save();
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('post.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($post_id)
    {
        $post = $this->_model::find($post_id);
        return view('Post::show', ['post' => $post]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function preview($post_id)
    {
        $post = $this->_model::find($post_id);
        return view('Post::preview', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($post_id)
    {
        $post = $this->_model::find($post_id);
        return view('Post::edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update($post_id)
    {
        try {
            $post = $this->_model::find($post_id);
            if ($post) {
                $post->update($this->_serialize(request()));
                $post->slug = str_replace(" ", "-", strtolower($post->title));
                $post->save();
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('post.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($post_id)
    {
        try {
            $post = $this->_model::find($post_id);
            if ($post) {
                $post->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('post.index')], 200);
    }
}
