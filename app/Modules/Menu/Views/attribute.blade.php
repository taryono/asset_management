
  <!-- Main content -->
  <section class="content">
      <div class="container-fluid">
          <div class="row">
              <div class="col-12">
                  <div class="card">
                      <div class="card-header">
                          <h3 class="card-title">Daftar Attribute</h3> 
                          {!!create(['url'=> route('attribute.create', $menu->id), 'title'=> 'Tambah Attribute Menu', 'style'=> "float: right;"]) !!}
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                          <table class="table table-bordered table-hover display details">
                              <thead>
                                  <tr class="heading">
                                      <th>No</th>
                                      <th>Key</th>
                                      <th>Nama</th>
                                      <th data-name="status">Status</th>
                                      <th data-name="action" nowrap="nowrap">Action</th> 
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach ($attributes as $key => $attribute)
                                      <tr>
                                          <td>{{ ++$key }}</td>
                                          <td>{{ $attribute->key }}</td>
                                          <td>{{ $attribute->name }}</td>
                                          <td>{{ $attribute->is_active }}</td>
                                          <td>
                                              <a data-href="{{route('attribute.edit', $attribute->id)}}"
                                                  class="edit btn btn-primary btn-xs shadow" data-toggle="modal"
                                                  data-target="#modalUpdate" data-title="{{$attribute->name}}"><i
                                                      class="fa fa-sm fa-fw fa-pen"></i>
                                              </a>
                                              <a data-href="{{route('attribute.destroy', $attribute->id)}}"
                                                  class="delete btn btn-danger btn-xs shadow"
                                                  data-title="{{$attribute->name}}" data-toggle="modal"
                                                  data-target="#modalDelete"><i
                                                      class="fa fa-sm fa-fw fa-trash"></i>
                                              </a>
                                          </td>
                                      </tr>
                                  @endforeach
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
      <!-- /.container-fluid -->
  </section>
  <!-- /.content -->
