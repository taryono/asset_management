<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

class WelcomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(request()->input('search')){
            //$posts = \Models\Post::search(request()->input('search'))->take(10)->get(); 
            $post = \Models\Post::first(); 
        }else{
            $post = \Models\Post::whereHas('category', function ($q) {
                $q->whereHas('category_group', function ($q2) {
                    $q2->where('id', 8);
                });
            })
            ->where('publish_date', '<=', date('Y-m-d H:i:s'))
            ->where('post_status_id', 2)->first();  
        }
         
        return view('welcome', ['post' => $post]);
    }

    public function page($slug)
    { 
        $post = \Models\Post::where('slug', $slug)->first(); 
        return view('page', ['post'=> $post]);
    }

    public function post($category, $date, $slug)
    {
        $post = \Models\Post::where('slug', $slug)->first();
        return view('post', ['post' => $post]);
    }

    public function album($category, $date, $slug)
    {
        $album = \Models\Album::where('slug', $slug)->first();
        return view('album', ['album' => $album]);
    }

    public function children(Request $request)
    {
        $id = $request->input('id');
        $m = $request->input('model');
        $t = $request->input('target');
        $month = $request->input('month');
        $category = $request->input('category');
        $model = new $m;
        $target = new $t;
        $field = \Str::singular($model->getTable());
         
        if ($id) {
            $data = $target::find($id);  
        } else {
            if ($target instanceof \Models\Post || $target instanceof \Models\Album) {
                $data = $target::where([
                    'month' => $month,
                    'category_id' => $category,
                ])->get();
            } 
            if ($target instanceof \Models\Income || $target instanceof \Models\Expenditure) {
                $data = $target::where([
                    'month' => $month ? $month : date('m'),
                ])->get();
            }
        }
        $tabel = $target->getTable();
        return view("children", ['model' => $model, 'target' => $target, 'data' => $data, 'tabel' => $tabel, 'id' => $id]);
    }

    public function search(){
        if(request()->input('search')){
            $posts = \Models\Post::search(request()->input('search'))->take(10)->get(); 
        }else{
            $posts = \Models\Post::search('hadroh')->take(10)->get(); 
        }
        return response()->json(['data'=> $posts], 200); 

    }
}
