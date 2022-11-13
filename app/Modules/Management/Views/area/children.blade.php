<ul> 
@foreach ($data as $m)
    <li class="parent_li">  
        <span data-model="{{get_class($m)}}" data-id="{{$m->id}}" data-target="{{$m->child()?$m->child():null}}" data-table="{{$tabel}}" title="Expand this branch"><i class="fa @if($tabel != "rt") fa-plus @else fa-min lastchild @endif"></i> {{$m->name}}</span> 
        {{-- <a href=""><span><i class="icon-time"></i>{{ $m->name }}</span></a> --}}
    </li>
@endforeach
</ul>