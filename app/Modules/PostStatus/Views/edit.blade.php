{{ Form::model($post_status, ['method' => 'PUT', 'route' => ['post_status.update', $post_status->id], 'class' => 'form-horizontal inline', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="card-body">
        <div class="row">
            {!! text_div('code', ['class' => 'form-control', 'placeholder' => 'Kode', 'required']) !!}
            {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Status', 'required']) !!}
            {!! color_div('bg_color', [
                'class' => 'form-control',
                'id' => 'bg_color',
                'placeholder' => 'Background Color',
                'required',
            ]) !!}
        </div>
    </div>
</div>
{{ Form::close() }}
