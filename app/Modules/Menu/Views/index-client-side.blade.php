@extends('adminlte::page') 
@section('content')
<br>
    @section('plugins.Datatables', true)
    @section('plugins.DatatablesPlugin', true)  
    <div id="container"> 
        @php
        $heads = [
            'ID',
            'Name',
            ['label' => 'Link', 'width' => 40],
            ['label' => 'Status', 'width' => 40],
            ['label' => 'Parent', 'width' => 40],
            ['label' => 'Urutan', 'width' => 40],
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ];
        
        $btnEdit = '<button class="btn btn-xs btn-default text-primary mx-1 shadow" title="Edit">
                        <i class="fa fa-lg fa-fw fa-pen"></i>
                    </button>';
        $btnDelete = '<button class="btn btn-xs btn-default text-danger mx-1 shadow" title="Delete">
                          <i class="fa fa-lg fa-fw fa-trash"></i>
                      </button>';
        $btnDetails = '<button class="btn btn-xs btn-default text-teal mx-1 shadow" title="Details">
                           <i class="fa fa-lg fa-fw fa-eye"></i>
                       </button>';
        $data = [];
        foreach($menus as $menu){
            $data[] = [$menu->id, $menu->name, $menu->type, $menu->sequence,$menu->parent?$menu->parent->name:null,$menu->is_active,'<nobr>'.$btnEdit.$btnDelete.$btnDetails.'</nobr>'];
        }
        $config = [
            'data' => $data,
            'order' => [[1, 'asc']],
            'columns' => [null, null, null, ['orderable' => false]],
        ];
 
        @endphp
        
        {{-- Minimal example / fill data using the component slot --}}
        <x-adminlte-datatable id="table1" :heads="$heads" theme="light" striped hoverable>
            @foreach($config['data'] as $row)
                <tr>
                    @foreach($row as $cell)
                        <td>{!! $cell !!}</td>
                    @endforeach
                </tr>
            @endforeach
        </x-adminlte-datatable>
        
    </div> 
  @stop  
