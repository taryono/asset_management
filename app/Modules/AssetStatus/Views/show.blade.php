@extends('layouts.app')

@section('content')
<br>
  <div class="card card-widget widget-asset_status col-md-4" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-asset_status-header bg-info">
          <h3 class="widget-asset_status-asset_statusname">{{ $asset_status->name }}</h3>
          <h5 class="widget-asset_status-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-asset_status-image">
          <img src="{{ $asset_status->photo ? $asset_status->photo : asset_status('asset_statuss/images/asset_status.png') }}"
              class="profile-asset_status-img img-fluid img-circle img-responsive image-logo" data-title="{{ $asset_status->name }}"
              onerror="this.src='../../dist/img/asset_status2-160x160.jpg'">
      </div>
      <div class="card-footer">
          <div class="row">
              <div class="col-sm-12 border">
                  <div class="description-block">
                      <h5 class="description-header">3,200</h5>
                      <span class="description-text">SALES</span>
                  </div>
                  <!-- /.description-block -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
      </div>
  </div> 
@endsection
