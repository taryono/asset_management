{{ Form::model($param, array('route' => 'document.search', 'ng-controller'=>'formController', 'ng-submit'=>'submit($event)')) }}

@if(isset($actions))
@include('component.actions')
<div class="select-max-row">
    Show
    {{ Form::text('max_row', $datas->perPage(), array('size'=>4, 'maxlength'=>4)) }}
</div>
@endif
<div class="table-list table-responsive">
    <table class="table table-striped table-check">
        <thead>
            <tr class="ordering">
                <th width="10px">#</th>
                <th width="10px">No</th>
                <th>{{ 'code' }}</th>
                <th>{{ 'Jenis Document' }}</th>
                <th>{{ 'Tipe' }}</th>
                <th>{{ 'Unit' }}</th>
            </tr>
            <tr>
                <th>{{ Form::checkbox('group_row', null, null, array('class'=>'group_check', 'data-set'=>'.table-check .checkboxes')) }}
                </th>
                <th><button type="submit"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </th>
                <th>{{ Form::text('filter[name]') }}</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @if (count($datas) <= 0) <tr>
                <td colspan="5" style="text-align: center">{{ 'Data Tidak Ditemukan' }}</td>
                </tr>
                @else
                @php ($i = 0) @endphp
                @foreach ($datas as $data)
                <tr>
                    <td>{{ Form::checkbox('select_row[]', $data->id, null, array('class'=>'checkboxes')) }}</td>
                    <td>{{ ++$i }}</td>
                    <td ng-controller="actionController">
                        <div class="col-md-2">
                            <i class="fa fa-plus-square plus-collapse" data-rowid="{{ $data->id }}"
                                data-url-source="{{ url('document/getDetail') }}"
                                id='plus-collapse'></i>
                        </div>
                        <a href=""
                            ng-click="action = !action">{{ $data->code}}</a>
                        @if($param != '')
                        <div ng-show="action" class="action-list ng-hide">
                            @if ($priv['edit_priv'])
                            {{ link_to_route('document.edit', 'Edit', array($data->id), array('class' => 'green'))}}
                            @endif
                            @if ($priv['edit_priv'])
                            {{ link_to_route('document.addContent', 'Setup Content', array($data->id), array('class' => 'green'))}}
                            @endif

                            @if ($priv['delete_priv'])
                            {{ link_to_route('document.delete', 'Delete', array($data->id), array('class' => 'red', 'ng-click'=>'confirm($event)'))}}
                            @endif

                        </div>
                        @endif
                    </td>
                    <td>{{$data->name}}</td>
                    <td>{{$data->type}}</td>
                    <td>{{ isset($data->ng_department) ? $data->ng_department->name : ''}}</td>
                </tr>
                <tr class="hidden row_collapse_{{ $data->id }}" data-rowid="{{ $data->id }}"
                    id="row_collapse_{{ $data->id }}"></tr>
                @endforeach
                @endif
        </tbody>
    </table>
</div>
<div>
    {{ $datas->appends($param)->links()}}
</div>
{{ Form::close() }}

<div class="modal fade modal-base" id="studentModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">{{ say('Tambah Attribut') }}</h4>
            </div>
            <div class="modal-body"> 
                 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-grey" data-dismiss="modal">{{ say('Close') }}</button>
                <button type="submit" class="btn btn-success" id="submitModal">{{ say('Submit') }}</button>
            </div>
        </div>
    </div>
</div>
