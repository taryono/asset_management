<div class="card-body">
    <div class="row">
        <div class="col-lg-12">
            {!! kembali(['url' => '/management/post', 'style' => 'float:right;margin-right: 5px;margin-left: 5px;']) !!}
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12"></div>
    </div>

    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8">{{ $post->title }}</div>
        <div class="col-lg-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-2"></div>
        <div class="col-lg-8" style="text-align: center">{!! $post->content !!}</div>
        <div class="col-lg-2"></div>
    </div>
</div>