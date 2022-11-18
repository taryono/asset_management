<?php

namespace Lib;

//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class Button
{
   public $actions = ['create' => false, 'edit' => false, 'show' => false, 'destroy' => false, 'print' => false, 'reload'=> false];
   public $action;
   public $attributes = ['url' => null, 'title' => null, 'popup' => null];
   public $type = 'popup';
   public $text;

   public function __construct($attributes = [])
   {
      //$request =  new Request(); 
      //$controller = class_basename(Route::getCurrentRoute()->controller);
      if (!Session()->get('role_ids') && !auth()->user()->isSuperUser()) {
         return;
      }


      if ($attributes) {
         $this->attributes = $attributes;

         if (array_key_exists('type', $attributes)) {
            $this->setType($attributes['type']);
         }

         if (array_key_exists('text', $attributes)) {
            $this->setText($attributes['text']);
         }
      }
   }

   public function sanitize()
   {

      if (auth()->user()->isSuperUser()) {
         $this->actions[$this->action] = true;
      } else {

         $route = Route::getCurrentRoute()->getAction()['prefix'];
         $list_actions = ["create", "edit", "show", "print", "destroy"];
         $action = $this->action;
         if (in_array($action, $list_actions)) {
            if (auth()->user()->can($route . '-' . $action)) {
               $this->actions[$action] = true;
            }
         }
      }
   }

   public function setText($text)
   {
      $this->text = $text;
      return $this;
   }

   public function setType($type)
   {
      $this->type = $type;
      return $this;
   }

   public function setAction($action)
   {
      $this->action = $action;
      return $this;
   }

   public function create()
   {
      $this->setAction('create');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         if ($this->actions[$this->action]) {
            if ($this->type == "popup") {
               return '<a data-href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="create btn btn-primary btn-sm shadow mr-1" data-toggle="modal" data-target="#modalMin" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-plus"></i>&nbsp;' . ($this->text ? $this->text : 'Tambah') . '</a>';
            } else {
               return '<a href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="btn btn-primary btn-sm shadow mr-1" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-plus"></i>&nbsp;' . ($this->text ? $this->text : 'Tambah') . '</a>';
            }
         }
      }
   }

   public function edit()
   {
      $this->setAction('edit');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         if ($this->actions[$this->action]) {
            if ($this->type == "popup") {
               return '<a data-href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="edit btn btn-primary btn-xs shadow mr-1 shadow mr-1" data-toggle="modal" data-target="#modalUpdate" data-title="' . ($this->attributes['title']) . '"  style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-edit"></i></a>';
            } else {
               return '<a href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="btn btn-primary btn-xs shadow mr-1" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '"  style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-edit"></i></a>';
            }
         }
      }
   }

   public function show()
   {
      $this->setAction('show');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         if (array_key_exists('popup', $this->attributes)) {
            return '<a data-href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="show_popup btn btn-primary btn-xs shadow mr-1" data-toggle="modal" data-target="#modalPopupDetail" data-title="' . ($this->attributes['title']) . '"  style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-eye"></i></a>';
         } else {
            return $this->actions[$this->action] ? '<a href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="detail btn btn-primary btn-xs shadow mr-1"  data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-eye"></i></a>' : null;
         }
      }
   }

   public function preview()
   {
      $this->setAction('preview');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         return '<a data-href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="preview btn btn-primary btn-xs shadow mr-1" data-toggle="modal" data-target="#modalPopupDetail" data-title="' . ($this->attributes['title']) . '"  style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-eye"></i></a>';
      }
   }

   public function print()
   {
      $this->setAction('print');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         return $this->actions[$this->action] ? '<a href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="print btn btn-primary btn-sm shadow mr-1" target="_blank" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-print"></i></a>' : null;
      }
   }

   public function destroy()
   {
      $this->setAction('destroy');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         return $this->actions[$this->action] ? '<a data-href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="delete btn btn-danger btn-xs shadow mr-1" data-preview="' . (array_key_exists('preview', $this->attributes) ? $this->attributes['preview'] : null) . '" data-toggle="modal" data-target="#modalDelete" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-trash"></i></a>' : null;
      }
   }

   public function back()
   {
      return '<a href="' . (array_key_exists('url', $this->attributes) ? $this->attributes['url'] : null) . '" class="btn btn-danger btn-sm shadow mr-1" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-arrow-left"></i>' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : ($this->text ? $this->text : 'Kembali')) . '</a>';
   }

   public function submit()
   {
      $this->setAction('create');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         if ($this->actions[$this->action]) {
            return '<button class="submit-button btn btn-primary btn-sm shadow" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '"><i class="fa fa-sm fa-fw fa-save"></i>' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : 'Submit') . '</button>';
         }
      }
   }

   public function update()
   {
      $this->setAction('edit');
      $this->sanitize();
      if (array_key_exists($this->action, $this->actions)) {
         if ($this->actions[$this->action]) {
            return '<button class="update-button btn btn-primary btn-sm shadow" data-title="' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : null) . '" style="' . (array_key_exists('style', $this->attributes) ? $this->attributes['style'] : null) . '">' . (array_key_exists('title', $this->attributes) ? $this->attributes['title'] : ($this->text ? $this->text : 'Submit')) . '</button>';
         }
      }
   }
}
