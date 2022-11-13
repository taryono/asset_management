@extends('adminlte::page')

@section('title', 'User Dashboard')
@section('content')
    <div id="container">
        <div class="card">
            <div class="card-header">
                {!! kembali(['url' => '/management/acl']) !!}
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card card-widget widget-user">
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class="widget-user-header bg-info">
                                <h3 class="widget-user-username">{{ $user->name }}</h3>
                                <h5 class="widget-user-desc">Founder &amp; CEO</h5>
                            </div>
                            <div class="widget-user-image">
                                <img src="{{ asset('photos/'.$user->photo ? $user->photo : asset('assets/images/user.png')) }}"
                                    class="profile-user-img img-fluid img-circle img-responsive image-logo"
                                    data-title="{{ $user->name }}" onerror="this.src='../../dist/img/user2-160x160.jpg'">
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
                    <div class="col-lg-2">
                        <label>Role :
                            {{ $user->roles->count() > 0 ? $user->roles->implode('name', ', ') : '' }}</label><br>

                        <label>Name : {{ $user->name }}</label>
                        
                    </div>
                    <div class="col-lg-4">
                        <div class="alert alert-success">
                            Anda dapat menambahkan Permissions khusus untuk user, selain roles user juga dapat mengakses
                            menu dengan penambahan permission
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">List Permissions</h3>
                        {!! create(['url'=> route('menu_user.create', ['user_id' => $user->id]), 'style'=> 'float:right'])!!}                         
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="menu_user" class="table table-bordered table-hover display standard" style="width: 100%"
                            data-route="{{ route('menu_user.getListAjax', ['user_id' => $user->id]) }}">
                            <thead>
                                <tr>
                                    <th data-name="id">No</th>
                                    <th data-name="menu.url">Menu</th>
                                    <th data-name="index">List</th>
                                    <th data-name="create">Create</th>
                                    <th data-name="edit">Edit</th>
                                    <th data-name="show">Detail</th>
                                    <th data-name="print">Cetak</th>
                                    <th data-name="destroy">Hapus</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div> 
@stop
