   @push('css')
       <link rel="stylesheet" href="{{ assets('plugins/fontawesome-free/css/all.min.css') }}">
       <link rel="stylesheet" href="{{ assets('plugins/ekko-lightbox/ekko-lightbox.css') }}">
   @endpush
   <?php $galleries = $data->gallery; ?>
   <div class="card" style="margin-top: 10px; min-height: 1000px;">
       <div class="card-header">
           <div class="card-title">
               {{ is_exists($data, 'title') }}
           </div>
       </div>
       <div class="card-body">
           <div class="row">
               <div class="col-md-2">
                   <div class="filtr-item " data-category="1" data-sort="white sample">
                       <a href="{{ assets('albums/' . $data->cover) }}" data-toggle="lightbox"
                           data-title="{{ $data->title }}">
                           <img src="{{ assets('albums/' . $data->cover) }}" class="img-fluid mb-4"
                               alt="{{ $data->title }}" />
                       </a>
                   </div>
               </div>
               <div class="col-md-8">
                   {{ $data->title }}<br>
                   {{ DateToTimeIndo($data->created_at) }}<br>
                   {!! $data->description !!}<br>
               </div>
           </div>
           <div class="row">
               @if ($galleries->count() > 0)
                   @foreach ($galleries as $gallery)
                       <div class="filtr-item col-sm-3" data-category="{{ $gallery->id }}" data-sort="white sample">
                           <a href="{{ assets('galleries/' . $gallery->image) }}" data-toggle="lightbox"
                               data-title="{{ $gallery->name }}">
                               <img src="{{ assets('galleries/' . $gallery->image) }}" class="img-fluid"
                                   alt="{{ $gallery->name }}" />
                           </a>
                       </div>
                   @endforeach
               @endif
           </div>
       </div>
       <div class="card-footer">
           <blockquote>Selamat Datang Dimasjid Mujahiddin</blockquote>
       </div>
   </div>
   @push('js')
       <script src="{{ assets('plugins/ekko-lightbox/ekko-lightbox.min.js') }}"></script>
       <script src="{{ assets('plugins/filterizr/jquery.filterizr.min.js') }}"></script>
       <script src="{{ assets('js/demo.js') }}"></script>
       <script>
           $(function() {
               $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                   event.preventDefault();
                   $(this).ekkoLightbox({
                       alwaysShowClose: true
                   });
               });

               $(document).on('click', 'button.submit-button', function() {
                   setTimeout(() => {
                       //getData('{{ url('album/list_galleries', $data->id) }}', $("div.list-galleries"));                                            
                       window.location.reload();
                   }, 3000);
               });

               $('.filter-container').filterizr({
                   gutterPixels: 3
               });
               $('.btn[data-filter]').on('click', function() {
                   $('.btn[data-filter]').removeClass('active');
                   $(this).addClass('active');
               });
           })
       </script>
   @endpush
