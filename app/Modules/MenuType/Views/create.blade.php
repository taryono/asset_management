 {{ Form::open(['method' => 'POST', 'route' => ['menu_type.store'], 'class' => 'form-horizontal']) }}
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
