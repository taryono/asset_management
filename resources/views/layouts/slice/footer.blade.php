<div class="row">
    <?php $footers = \Models\Post::where('post_status_id', 2)
        ->where('category_id', 5)
        ->limit(3)
        ->get(); ?>
    @if ($footers->count() > 0)
        @foreach ($footers as $footer)
            <div class="col-lg-4">
                <div class="card" style="margin-top: 10px;">
                    <div class="card-header">
                        <div class="card-title">
                            {{ is_exists($post, 'title') }}
                        </div>
                    </div>
                    <div class="card-body">
                        {!! is_exists($post, 'content', 'Content tidak ditemukan') !!}
                    </div>
                    <div class="card-footer">&nbsp;</div>
                </div>
            </div>
        @endforeach
    @else
        <div class="col-lg-12">
            <div class="card" style="margin-top: 10px;">
                <div class="card-header">
                    <div class="card-title">

                    </div>
                </div>
                <div class="card-body">
                    <div class="marquee">
                        <div>
                            <span>Assalamu'alaikum wrwb...jamaah Masjid Mujahiddin yang terhormat...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
