<td></td>
<td></td>
<td colspan="12">
    <div class="table-list">
        <a style="cursor: pointer" class="action-button blue-button" id="add-button"
            data-route="{{ route('document.getFormAtribute', $document->id) }}" data-toggle="modal"
            data-target="#studentModal">
            <img src="{{asset('assets/images/templates/add-page.png')}}">
            {{ say('Tambah Attribute') }}
        </a>
        <table class="table table-striped table-check">
            <thead>
                <tr class="ordering">
                    <th width="10px">#</th>
                    <th width="10px">{{ say('No') }}</th>
                    <th>{{ say('Kode') }}</th> 
                    <th>{{ say('Parent') }}</th>
                    <th>{{ say('Status') }}</th>
                    <th>{{ say('Element') }}</th>   
                    <th>{{ say('Urutan') }}</th>  
                    <th>{{ say('Object') }}</th>  
                    <th>{{ say('Property') }}</th>  
                    <th>{{ say('Actions') }}</th>  
                </tr>

            </thead>
            <tbody>
                @if ($datas->count() < 1)
                    <tr>
                        <td colspan="14" style="text-align: center">{{ say('Data Tidak Ditemukan') }}</td>
                    </tr>
                @else
                    @foreach ($datas as $i => $data)
                        <tr>
                            <td></td>
                            <td>{{ ++$i }} </td> 
                            <td>{{ $data->code }} </td>  
                            <td>{{ $data->parent->name }} </td>  
                            <td><span class="bg_label {{bg_status($data->status)}}">{{ $data->status == 1?"Aktif":"Tidak Aktif" }} </span></td> 
                            <td>{{ $data->element }} </td>  
                            <td>{{ $data->sequence }} </td> 
                            <td>{{ $data->object }} </td> 
                            <td>{{ $data->property }} </td> 
                            <td>
                                <a href="" class="edit-attribute" data-route="{{ route('document.editAttribute', $data->id) }}" data-toggle="modal"
                                    data-target="#studentModal"><i class="fa fa-edit"></i></a>
                                <a href="" class="delete-attribute"><i class="fa fa-trash"></i></a>
                            </td> 
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</td>
