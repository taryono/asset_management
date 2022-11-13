<?php

namespace App\Modules\Page\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StorePage;
use Models\Page as page;

class PageController extends MainController
{
    public function __construct()
    {
        parent::__construct(new page(), 'page');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Page::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $pages = $this->_model::with(['post'])->select('*')->orderBy('sequence', 'asc');
            return datatables()->of($pages)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('page.edit', $row->id), 'title' => $row->name]);
                        $btn .= show(['url' => route('page.show', $row->id), 'title' => $row->name]);
                        $btn .= hapus(['url' => route('page.destroy', $row->id), 'preview' => route('page.preview', $row->id), 'title' => $row->name]);
                        $btn .= '</div>';
                        return $btn;

                    }
                })
                ->addColumn('parent', function ($row) {
                    return $row->parent ? $row->parent->name : "--";
                })
                ->addColumn('content', function ($row) {
                    return $row->post ? $row->post->title : "--";
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
        return view('Page::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePage $request)
    {
        try {
            $this->_model::create($this->_serialize($request));
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('page.index')], 200);
    }

    public function fileUpload()
    {

        $this->validate(request(), [
            'name' => 'required',
            'content' => 'required',
        ]);

        $content = request()->content;
        $dom = new \DomDocument();
        $dom->loadHtml($content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('imageFile');

        foreach ($imageFile as $item => $image) {
            $data = $image->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data) = explode(',', $data);

            $imgeData = base64_decode($data);
            $image_name = "/upload/" . time() . $item . '.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);

            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();

        $fileUpload = new page;
        $fileUpload->name = request()->name;
        $fileUpload->content = $content;

        $fileUpload->save();

        dd($content);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page = $this->_model::find($id);
        return view('Page::show', ['page' => $page]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function preview($id)
    {
        $page = $this->_model::find($id);
        return view('Page::preview', ['page' => $page]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $page = $this->_model::find($id);
        return view('Page::edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        try {
            $page = $this->_model::find($id);
            if ($page) {
                $page->update($this->_serialize(request()));
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('page.index')], 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $page = $this->_model::find($id);
            if ($page) {
                $page->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('page.index')], 200);
    }
}
