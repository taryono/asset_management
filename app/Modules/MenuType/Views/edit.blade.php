 {{ Form::model($menu_type, ['method' => 'PUT', 'route' => ['menu_type.update', $menu_type->id], 'class' => 'form-horizontal']) }}
 <div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Nama', 'required']) !!}
        {!! color_div(
            'bg_color',
            [
                'class' => 'form-control',
                'id' => 'bg_color',
                'placeholder' => 'Warna Backgroud',
                'required',
            ],
        ) !!} 
    </div>
 </div>
 <!-- /.card-body -->
 {{ Form::close() }}
