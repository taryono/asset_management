<div class="col-lg-3">
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Daftar Artikel Dakwah
            </div>
        </div>
        <div class="card-body">
            <?php $dakwahs = \Models\Post::where('post_status_id', 2)->where('category_id', 1)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($dakwahs->count() > 0)  
                            @foreach ($dakwahs as $group_dakwah) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $group_dakwah->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Post::where('year', $group_dakwah->year)->where('category_id', $group_dakwah->category_id)->groupBy(['month','year'])->get() as $dakwah)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="{{$dakwah->category_id }}" data-month="{{$dakwah->month }}" data-model="{{ get_class($dakwah) }}" data-id="" data-target="{{ get_class($dakwah) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($dakwah->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Artikel Dakwah masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Daftar Kegiatan Masjid
            </div>
        </div>
        <div class="card-body">
            <?php $events = \Models\Post::where('post_status_id', 2)->where('category_id', 9)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($events->count() > 0)  
                            @foreach ($events as $event) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $event->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Post::where('year', $event->year)->where('category_id', $event->category_id)->groupBy(['month','year'])->get() as $e)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="{{$e->category_id }}" data-month="{{$e->month }}" data-model="{{ get_class($e) }}" data-id="" data-target="{{ get_class($e) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($e->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Kegiatan masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Jadwal Imam Dan Khatib Jum'at
            </div>
        </div>
        <div class="card-body">
            <?php $lectures = \Models\Post::where('post_status_id', 2)->where('category_id', 3)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($lectures->count() > 0)  
                            @foreach ($lectures as $lecture) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $lecture->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Post::where('year', $lecture->year)->where('category_id', $lecture->category_id)->groupBy(['month','year'])->get() as $l)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="{{$l->category_id }}" data-month="{{$l->month }}" data-model="{{ get_class($l) }}" data-id="" data-target="{{ get_class($l) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($l->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Jadwal Imam Dan Khatib Jum'at masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Jadwal TPQ
            </div>
        </div>
        <div class="card-body">
            <?php $schedules = \Models\Schedule::groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($schedules->count() > 0)  
                            @foreach ($schedules as $schedule) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $schedule->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Schedule::where('year', $schedule->year)->groupBy(['month','year'])->get() as $sched)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="{{$sched->class_level_id }}" data-month="{{$sched->month }}" data-model="{{ get_class($sched) }}" data-id="" data-target="{{ get_class($sched) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($sched->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Jadwal Imam Dan Khatib Jum'at masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Galleri
            </div>
        </div>
        <div class="card-body">
            <?php $albums = \Models\Album::where('post_status_id', 2)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($albums->count() > 0)  
                            @foreach ($albums as $album) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $album->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Album::where('year', $album->year)->where('category_id', $album->category_id)->groupBy(['month','year'])->get() as $g)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="{{$g->category_id }}" data-month="{{$g->month }}" data-model="{{ get_class($g) }}" data-id="" data-target="{{ get_class($g) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($g->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Galleri masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Laporan Pendapatan
            </div>
        </div>
        <div class="card-body">
            <?php $incomes = \Models\Income::where('post_status_id', 2)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($incomes->count() > 0)  
                            @foreach ($incomes as $income) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $income->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Income::where('year', $income->year)->groupBy(['month','year'])->get() as $in)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="" data-month="{{$in->month }}" data-model="{{ get_class($in) }}" data-id="" data-target="{{ get_class($in) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($in->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Laporan Pendapatan masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div>

        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
    <div class="card" style="margin-top: 10px;">
        <div class="card-header">
            <div class="card-title">
                Laporan Pengeluaran
            </div>
        </div>
        <div class="card-body">
            <?php $expenditures = \Models\Expenditure::where('post_status_id', 2)->groupBy('year')->get();?>
            
            <div class="tree">
                <ul>
                    <li class="parent_li"> 
                        @if($expenditures->count() > 0)  
                            @foreach ($expenditures as $expenditure) 
                            <span title="Expand this branch"><i class="fa fa-plus"></i> {{ $expenditure->year }}</span> <i class="fa fa-book"></i>
                            <ul>
                                @foreach (\Models\Expenditure::where('year', $expenditure->year)->groupBy(['month','year'])->get() as $ex)
                                    <li class="parent_li" style="display: none;">
                                        <span data-category="" data-month="{{$ex->month }}" data-model="{{ get_class($ex) }}" data-id="" data-target="{{ get_class($ex) }}" title="Expand this branch"><i class="fa fa-plus"></i> {{ numberToMonth($ex->month) }}</span>
                                    </li>
                                @endforeach 
                            </ul>
                            @endforeach 
                        @else 
                            <p>Laporan Pengeluaran masih kosong</p>
                        @endif
                    </li>
                </ul>
            </div> 
        </div>
        <div class="card-footer">&nbsp;</div>
    </div>
</div>