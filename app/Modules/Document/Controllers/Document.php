<?php

namespace App\Modules\Document\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\MainController;
use Models\document as documentModel;

class Document extends MainController
{

    public function __construct()
    {

        $model = new documentModel();
        $controller_name = 'Document'; 
        $this->enable_pdf_button = false;
        $this->enable_xls_button = false; 
    }

    public function documentSearch(Request $request)
    {
        $q = $request->input('query');
        $dept = documentModel::select(['id', 'name'])
            ->where('name', 'LIKE', '%' . $q . '%')
            ->get();

        return $dept;
    }

    public function getFormAtribute($document_id)
    { 
        return view($this->controller_name . '::attribute', ['data' => null, 'document_id' => $document_id]);
    }

    public function editAttribute($id)
    { 
        $data = \Models\DocumentAttribute::find($id);
        return view($this->controller_name . '::attribute', ['data' => $data]);
    }

    public function addContent()
    {
        $id = request()->id;
        $with = [];
        $data = \Models\Document::find($id); 
        $this->actions[] = array('name' => say('Simpan'), 'type' => 'submit', 'url' => '#', 'class' => 'orange-button', 'img' => 'assets/images/templates/save-page.png');
        $this->actions[] = array('name' => say('Hapus'), 'type' => 'button', 'url' => ($this->controller_mutiple != '' ? strtolower($this->controller_mutiple) : strtolower($this->controller_name)) . '/delete_row', 'class' => 'purple-button delete-row', 'img' => 'assets/images/templates/delete-page.png');
        $this->actions[]= array('name' => say('Batal'), 'url' => ($this->controller_mutiple != '' ? strtolower($this->controller_mutiple) : strtolower($this->url_path)), 'class' => 'green-button', 'img' => 'assets/images/templates/cancel-page.png');
        $with['data'] = $data;

        $with['actions'] = $this->actions;

        return view($this->controller_name . '::addContent', $with);
    }

    public function storeContent()
    {
        $document_id = request()->id;
        $data = \Models\Document::find($document_id);
        $attributes = request()->input('attributes');
         
        if(count($attributes) > 0){
            foreach($attributes as $id => $attribute){
           
                if($id){
                    
                    if(empty($attribute['content'])){
                        $document_attribute = \Models\DocumentAttribute::find($id);
                        $document_attribute->delete();
                        continue;
                    }

                    
                    $document_attribute = \Models\DocumentAttribute::find($id);
                    
                    if($document_attribute){
                        $document_attribute->parent_id = 0;
                        $document_attribute->content = $attribute['content'];
                        $document_attribute->sequence = $attribute['sequence'];
                        $document_attribute->position = $attribute['position'];
                        $document_attribute->element = 'script';
                        $document_attribute->name = 'Content';
                        $document_attribute->save();
                    }

                }else{
                    if(!empty($attribute['content'])){ 
                        \Models\DocumentAttribute::create([
                            'document_id'=>  $document_id,
                            'parent_id'=> 0,
                            'content'=> $attribute['content'],
                            'sequence'=> $attribute['sequence'],
                            'position'=> $attribute['position'],
                            'element'=>'script',
                            'name'=>'Content',
                            'group'=>'content',
                        ]);
                    }
                }
            }
        }
        return Redirect::route(strtolower($this->controller_name) . '.index');

    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validation = $this->model->validate($input);
        if ($validation->passes()) {
            $doc = $this->model->create($input);
            if ($doc) {
                $level = "All";

                if ($ng_department_id = $request->input("ng_department_id")) {
                    $ng_department = \Models\ng_department::find($ng_department_id);
                    if ($ng_department) {
                        $level = strtolower($ng_department->ng_department_level->code);
                    }
                }
                $doc->level = $level;
                $doc->save();
                $css = $doc->document_attribute->where('code', 'css')->first();
                if (!$css) {
                    \Models\DocumentAttribute::create([
                        'document_id' => $doc->id,
                        'parent_id' => 0,
                        'element' => "css",
                        'code' => 'css',
                        'content' => $input['css'],
                        'status' => 1,
                        'position' => "before",
                        'parent_id' => 0,
                        'sequence' => 1,
                        'group' => 'header',
                    ]);
                }

                $header = $doc->document_attribute->where('code', 'header')->first();

                if (!$header) {
                    \Models\DocumentAttribute::create([
                        'document_id' => $doc->id,
                        'element' => "header",
                        'code' => 'header',
                        'content' => $input['header'],
                        'status' => 1,
                        'position' => "before",
                        'parent_id' => 0,
                        'sequence' => 2,
                        'group' => 'header',
                    ]);
                }
                if (!empty($input['footer'])) {

                    $footer = $doc->document_attribute->where('code', 'footer')->first();

                    if (!$footer) {
                        \Models\DocumentAttribute::create([
                            'document_id' => $doc->id,
                            'element' => "footer",
                            'code' => 'footer',
                            'content' => $input['footer'],
                            'status' => 1,
                            'position' => "before",
                            'parent_id' => 0,
                            'sequence' => 2,
                            'group' => 'footer',
                        ]);
                    }
                }
            }
            return Redirect::route(strtolower($this->controller_name) . '.index');
        }

        return Redirect::route(strtolower($this->controller_name) . '.create')
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function storeAttribute(Request $request)
    {
        $input = $request->all();
        $doc = $this->model->find($request->document_id);
        $header = $doc->document_attribute->where('code', $request->code)->first();

        if (!$header) {
            \Models\DocumentAttribute::create($input);
        } else {
            $header->update($input);
        }
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $validation = $this->model->validate($input);

        if ($validation->passes()) {
            $data = $this->model->find($id);

            if ($data) {
                $data->update($input);
                $level = "All";

                if ($ng_department_id = $request->input("ng_department_id")) {
                    $ng_department = \Models\ng_department::find($ng_department_id);
                    if ($ng_department) {
                        $level = strtolower($ng_department->ng_department_level->code);
                    }
                }
                $data->level = $level;
                $data->save();

                $css = $data->document_attribute->where('code', 'css')->first();
                if ($css) {
                    $css->update(['content' => $input['css']]);
                } else {
                    \Models\DocumentAttribute::create([
                        'document_id' => $data->id,
                        'code' => 'css',
                        'element' => "css",
                        'content' => $input['css'],
                        'status' => 1,
                        'position' => "before",
                        'parent_id' => 0,
                        'sequence' => 1,
                        'group' => 'header',
                    ]);
                }

                $header = $data->document_attribute->where('code', 'header')->first();

                if ($header) {
                    $header->update(['content' => $input['header']]);
                } else {
                    \Models\DocumentAttribute::create([
                        'document_id' => $data->id,
                        'code' => 'header',
                        'element' => "header",
                        'content' => $input['header'],
                        'status' => 1,
                        'position' => "before",
                        'parent_id' => 0,
                        'sequence' => 2,
                        'group' => 'header',
                    ]);
                }

                if (!empty($input['footer'])) {

                    $footer = $data->document_attribute->where('code', 'footer')->first();

                    if ($footer) {
                        $footer->update(['content' => $input['footer']]);
                    } else {
                        \Models\DocumentAttribute::create([
                            'document_id' => $data->id,
                            'code' => 'footer',
                            'element' => "footer",
                            'content' => $input['footer'],
                            'status' => 1,
                            'position' => "before",
                            'parent_id' => 0,
                            'sequence' => 3,
                            'group' => 'footer',
                        ]);
                    }

                }
            }
            return Redirect::route(strtolower($this->controller_name) . '.index');
        }
        return Redirect::route(strtolower($this->controller_name) . '.edit', $id)
            ->withInput()
            ->withErrors($validation)
            ->with('message', 'There were validation errors.');
    }

    public function updateAttribute(Request $request, $id)
    {
        $input = $request->all();
        $header = \Models\DocumentAttribute::find($id);

        if (!$header) {
            \Models\DocumentAttribute::create($input);
        } else {
            $header->update($input);
        }
    }

    public function getDetail()
    {
        $id = request()->input('id');
        $data = $this->model->find($id);
        $datas = \Models\DocumentAttribute::where('document_id', $data->id)->where('parent_id', '<>', 0)->get();

        return view($this->controller_name . '::getDetail', ['datas' => $datas, 'document' => $data]);
    }
}
