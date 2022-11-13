@extends('layouts.app')

@section('content')
<br>
  <div class="card card-widget widget-district col-md-4" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-district-header bg-info">
          <h3 class="widget-district-districtname">{{ $district->name }}</h3>
          <h5 class="widget-district-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-district-image">
          <img src="{{ $district->photo ? $district->photo : district('districts/images/district.png') }}"
              class="profile-district-img img-fluid img-circle img-responsive image-logo" data-title="{{ $district->name }}"
              onerror="this.src='../../dist/img/district2-160x160.jpg'">
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
