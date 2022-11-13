@extends('layouts.app')

@section('content')
<br>
  <div class="card card-widget widget-controller col-md-4" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-controller-header bg-info">
          <h3 class="widget-controller-controllername">{{ $controller->name }}</h3>
          <h5 class="widget-controller-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-controller-image">
          <img src="{{ $controller->photo ? $controller->photo : asset('assets/images/controller.png') }}"
              class="profile-controller-img img-fluid img-circle img-responsive image-logo" data-title="{{ $controller->name }}"
              onerror="this.src='../../dist/img/controller2-160x160.jpg'">
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
