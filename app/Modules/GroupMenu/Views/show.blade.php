@extends('layouts.app')

@section('content')
<br>
  <div class="card card-widget widget-group_menu col-md-4" style="margin: auto;padding-top: 7.5px;">
      <!-- Add the bg color to the header using any of the bg-* classes -->
      <div class="widget-group_menu-header bg-info">
          <h3 class="widget-group_menu-group_menuname">{{ $group_menu->name }}</h3>
          <h5 class="widget-group_menu-desc">Founder &amp; CEO</h5>
      </div>
      <div class="widget-group_menu-image">
          <img src="{{ $group_menu->photo ? $group_menu->photo : asset('assets/images/group_menu.png') }}"
              class="profile-group_menu-img img-fluid img-circle img-responsive image-logo" data-title="{{ $group_menu->name }}"
              onerror="this.src='../../dist/img/group_menu2-160x160.jpg'">
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
