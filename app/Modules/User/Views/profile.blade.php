@extends('adminlte::page') 
@section('content')
<div id="container">
    <div class="card card-widget widget-asset col-md-4" style="margin: auto;padding-top: 7.5px;">
        <!-- Tambah the bg color to the header using any of the bg-* classes -->
        <div class="widget-asset-header bg-info">
            <h3 class="widget-asset-assetname">{{ $user->name }}</h3>
            <h5 class="widget-asset-desc">Founder &amp; CEO</h5>
        </div>
        <div class="widget-asset-image">
            <img src="{{ $user->photo ? $user->photo : asset('assets/images/company.png') }}"
                class="profile-asset-img img-fluid img-circle img-responsive image-logo" data-title="{{ $user->name }}"
                onerror="this.src='{{asset('assets/images/company.png')}}'">
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
</div>
 
@stop 