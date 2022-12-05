<?php

namespace App\Modules\Management\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Http\Controllers\MainController;

class ManagementController extends MainController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Management::index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function area()
    {
        return view('Management::area.area');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function children()
    {$id = request()->input('id');
        $m = request()->input('model');
        $model = new $m;
        $t = request()->input('target');
        $target = new $t;
        $field = Str::singular($model->getTable());
        $data = $target::where($field . '_id', $id)->select('name', 'id')->get();

        $tabel = $target->getTable();
        return view('Management::area.children', ['model' => $model, 'target' => $target, 'data' => $data, 'tabel' => $tabel]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addChildren()
    {$id = request()->input('id');
        $m = request()->input('model');
        $model = new $m;
        $t = request()->input('target');
        $target = new $t;
        $field = Str::singular($model->getTable());
        $data = $target::where($field . '_id', $id)->select('name', 'id')->get();
        $parent = $model::find($id);
        $tabel = $target->getTable();
        return view('Management::area.addChildren', ['model' => $model, 'target' => $target, 'data' => $data, 'parent' => $parent, 'tabel' => $tabel]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function structure()
    {
        return view('Management::structure.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_in()
    {
        return view('Management::report_in.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function report_out()
    {
        return view('Management::report_out.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function acl()
    { 
        if (!request()->ajax()) { 
            return redirect()->to('/');
        }
        return view('Management::admin.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function mosque()
    {
        return view('Management::mosque.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function education()
    {
        return view('Management::education.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function asset()
    {
        if (!request()->ajax()) { 
            return redirect()->to('/');
        }
        return view('Management::asset.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        return view('Management::post.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function page()
    {

        return view('Management::page.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function slider()
    {
        return view('Management::slider.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function gallery()
    {
        return view('Management::gallery.index');
    }
}
