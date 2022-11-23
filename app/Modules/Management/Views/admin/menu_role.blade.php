<?php $roles = \Models\role::where('id', '<>', 1)->get();?>
<div class="row">
    <div class="col-12 col-sm-12">
        <div class="card card-secondary card-tabs">
            <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                    @foreach($roles as $i => $role)
                    <li class="nav-item">
                        <a class="nav-link {{$i==0?'active':''}}" id="custom-tabs-one-{{$role->name}}-tab" data-toggle="pill"
                            href="#{{$role->name}}" role="tab" aria-controls="{{$role->name}}" aria-selected="true">{{ucwords($role->name)}}</a>
                    </li>
                     @endforeach
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                    @foreach($roles as $i=> $role)
                    <div class="tab-pane fade show  {{$i==0?'active':''}}" id="{{$role->name}}" role="tabpanel"
                        aria-labelledby="custom-tabs-one-{{$role->name}}-tab">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">List Akses {{ucwords($role->name)}}</h3> 
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body"> 
                                <table id="menu_role{{$role->id}}" class="table table-bordered table-hover display standard" style="width: 100%"
                                    data-route="{{ route('menu_role.getListAjax',['role_id'=> $role->id]) }}">
                                    <thead>
                                        <tr>
                                            <th data-name="id">No</th>
                                            <th data-name="name">Modul</th> 
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
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>