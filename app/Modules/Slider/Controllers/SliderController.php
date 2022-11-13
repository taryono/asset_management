<?php

namespace App\Modules\Slider\Controllers;

use App\Http\Controllers\MainController;
use App\Http\Requests\StoreSlider;
use Lib\File;
use Models\Slider as slider;

class SliderController extends MainController
{
    public function __construct()
    {
        parent::__construct(new slider(), 'slider');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Slider::index');
    }

    public function getListAjax()
    {
        if (request()->ajax()) {
            $sliders = $this->_model::select(['*']);
            return datatables()->of($sliders)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row) {
                        $btn = '<div class="justify-content-between">';
                        $btn .= edit(['url' => route('slider.edit', $row->id), 'title' => $row->title]);
                        $btn .= show(['url' => route('slider.show', $row->id), 'title' => $row->title]);
                        $btn .= hapus(['url' => route('slider.destroy', $row->id), 'preview' => route('slider.preview', $row->id), 'title' => $row->title]);
                        $btn .= '</div>';
                        return $btn;
                    }
                })->addColumn('status', function ($row) {
                if ($row) {
                    return '<span class="btn ' . ($row->post_status ? $row->post_status->bg_color : "btn-danger") . '">' . (isset($row->post_status) ? $row->post_status->name : "Draft") . '</span>';
                }
            })->addColumn('image', function ($row) {
                if ($row) {
                    if ($row->image != null && file_exists(storage_path('app/public/sliders/' . $row->image))) {
                        return '<img class="img-responsive image" width="100px" height="100px" style="padding:5px" src="' . asset('sliders/' . $row->image) . '" onerror="this.src=' . asset('assets/images/mushola.png') . '">';
                    } else {
                        return '<img class="img-responsive image" style="padding:5px" src="' . asset('assets/images/mushola.png') . '" width="100px" height="100px">';
                    }
                }
            })
                ->rawColumns(['action', 'content', 'status', 'image'])
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
        return view('Slider::create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSlider $request)
    {
        try {
            $slider = $this->_model::create($this->_serialize($request));
            $slider->slug = str_replace(" ", "-", strtolower($slider->title));
            $slider->save();
            if (request()->file('image')) {
                $this->validate($request, [
                    'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ]);

                if (request()->file('image')->isValid()) {
                    $file = request()->file('image');
                    // image upload in storage/app/public/image
                    $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/sliders')));
                    if ($slider->image && file_exists(storage_path('app/public/sliders/' . $slider->image))) {
                        unlink(storage_path('app/public/sliders/' . $slider->image));
                    }
                    $slider->image = is_object($info) ? $info->getFilename() : $info;
                    $slider->save();
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                }
            }

        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Tambah data error => ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Tambah Data Berhasil.', 'redirectTo' => route('slider.index')], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show($slider_id)
    {
        $slider = $this->_model::find($slider_id);
        return view('Slider::show', ['slider' => $slider]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function preview($slider_id)
    {
        $slider = $this->_model::find($slider_id);
        return view('Slider::preview', ['slider' => $slider]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit($slider_id)
    {
        $slider = $this->_model::find($slider_id);
        return view('Slider::edit', ['slider' => $slider]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update($slider_id)
    {
        try {
            $slider = $this->_model::find($slider_id);
            if ($slider) {
                $old_image = $slider->image;
                $slider->update($this->_serialize(request()));
                $slider->slug = str_replace(" ", "-", strtolower($slider->title));
                $slider->save();
                if (request()->file('image')) {
                    $this->validate(request(), [
                        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                    ]);

                    if (request()->file('image')->isValid()) {
                        $file = request()->file('image');
                        // image upload in storage/app/public/image
                        $info = File::storeLocalFile($file, File::createLocalDirectory(storage_path('app/public/sliders')));
                        if ($slider->image && file_exists(storage_path('app/public/sliders/' . $slider->image))) {
                            unlink(storage_path('app/public/sliders/' . $slider->image));
                        }
                        $slider->image = is_object($info) ? $info->getFilename() : $info;
                        $slider->save();
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Image not allowed to upload.'], 200);
                    }
                }
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => 'Update Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Update Data Berhasil.', 'redirectTo' => route('slider.index')], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy($slider_id)
    {
        try {
            $slider = $this->_model::find($slider_id);
            if ($slider) {
                $slider->delete();
            }
        } catch (\Throwable $e) {
            return response()->json(['status' => 'error', 'message' => 'Data Error ' . $e->getMessage()], 400);
        }
        return response()->json(['status' => 'success', 'message' => 'Hapus Data Berhasil.', 'redirectTo' => route('slider.index')], 200);
    }
}
