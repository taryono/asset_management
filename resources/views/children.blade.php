@if (!$id)
    <ul>
        @foreach ($data as $m)
            <li class="parent_li">
                @if ($target instanceof \Models\Income || $target instanceof \Models\Expenditure)
                    <span data-year="{{ $m->year }}" data-month="{{ $m->month }}" data-category=""
                        data-model="{{ get_class($m) }}" data-id="{{ $m->id }}"
                        data-target="{{ $m->child() ? $m->child() : null }}" data-table="{{ $tabel }}"
                        title="Expand this branch" class="text-title"><i class="fa fa-min lastchild"></i>
                        {{ $m->name }}</span>
                @else
                    <span data-year="{{ $m->year }}" data-month="{{ $m->month }}"
                        data-category="{{ $m->category_id }}" data-model="{{ get_class($m) }}"
                        data-id="{{ $m->id }}" data-target="{{ $m->child() ? $m->child() : null }}"
                        data-table="{{ $tabel }}" title="Expand this branch" class="text-title"><i
                            class="fa fa-min lastchild"></i> {{ $m->title }}</span>
                @endif
            </li>
        @endforeach
    </ul>
@else 
    @include('layouts.template.'.$data->template->name, ['data'=> $data])
@endif
