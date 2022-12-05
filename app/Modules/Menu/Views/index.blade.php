 @push('css')
     <style>
         .toggle-vis {
             background-color: #6c757d;
             padding: 5px;
             border-radius: 20px;
             color: white;
             cursor: pointer;
         }
     </style>
 @endpush
 @include('Menu::list')
 @push('js')
     <script>
         $(function() {
             $("body").on('click', 'a.show_detail', function(e) {
                 e.preventDefault();
                 let tr = $(this).parents('tr');
                 let id = $(tr).attr('data-id');
                 let is_tr_exists = $("table#menu").find("tr.detail-" + id);
                 if ($("table#menu").find("tr.detail-" + id).length > 0) {
                     $("table#menu tr.detail-" + id).remove();
                 } else {
                     $('<tr role="row" class="detail-' + id + '"><th colspan="7"></th></tr>').insertAfter(
                         tr);
                     $.ajax({
                         url: $(this).attr("data-href"),
                         type: "GET",
                         success: function(e) {
                             $("table#menu tr.detail-" + id + " th").html(e);
                         },
                         error: function(xhr) {

                         }
                     });
                 }
             }).on('click', 'button.reload', function(e) {
                 $.get('{{ url('/admin/refresh') }}', function() {});
             });
         });
     </script>
 @endpush
