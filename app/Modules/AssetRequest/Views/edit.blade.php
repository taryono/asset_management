  {{ Form::model($asset_request, ['method' => 'PUT', 'route' => ['asset_request.update', $asset_request->id], 'class' => 'form-horizontal']) }}
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
                  {{ Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'keterangan', 'rows' => 3, 'required']) }}
              </div>
          </div>
      </div>
  </div>
  {{ Form::close() }}
