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
        $post = \Models\Post::first(); 
         
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
            if ($target instanceof \Models\Post) {
                $data = $target::where([
                    'month' => $month, 
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
