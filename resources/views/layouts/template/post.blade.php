 <div class="card" style="margin-top: 10px; min-height: 1000px;">
     <div class="card-header">
         <div class="card-title">
             {{ is_exists($data, 'title') }}
         </div>
     </div>
     <div class="card-body">
         {!! is_exists($data, 'content', 'Content tidak ditemukan') !!}
     </div>
     <div class="card-footer">
         <blockquote>Semoga Bermanfaat Untuk Umat</blockquote>
     </div>
 </div>
