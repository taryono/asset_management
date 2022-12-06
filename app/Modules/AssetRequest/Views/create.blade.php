{{ Form::open(['method' => 'POST', 'route' => ['asset_request.store'], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) }}
<div class="card-body">
    <div class="row">
        {!! text_div('name', ['class' => 'form-control', 'placeholder' => 'Nama', 'required']) !!}
        {!! color_div('bg_color', [
            'class' => 'form-control',
            'id' => 'bg_color',
            'placeholder' => 'Background Color',
            'required',
        ]) !!}
        <div class="col-lg-12">
            <div class="form-group">
                <label for="description">Keterangan</label>
                {{ Form::textarea('description', old('description'), ['class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => 3]) }}
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
