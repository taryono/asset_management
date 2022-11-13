 {{ Form::model($group_menu, ['method' => 'PUT', 'route' => ['group_menu.update', $group_menu->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
 <div class="card-body">
     <div class="row">
         {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}
         <div class="col-md-12">
             <div class="form-group">
                 {{ Form::select('group_menu_id', \Models\GroupMenu::pluck('name', 'id')->all(), null, ['class' => 'form-control selectpicker', 'id' => 'group_menu_id', 'placeholder' => '--Pilih Parent Menu--']) }}
             </div>
         </div>
     </div>
 </div>
 {{ Form::close() }}
