@extends('adminlte::page') 
@section('content')
@include('MenuType::list')
    @push('js')  
        <script>
            $(function() { 
                $("body").on('click', '.show_detail', function(e){
                    e.preventDefault();

                    let tr = $(this).parents('tr'); 
                    let id = $(tr).attr('data-id');  
                    let is_tr_exists = $("table#menu_type").find("tr.detail-"+id);
                    if($("table#menu_type").find("tr.detail-"+id).length > 0){
                        $("table#menu_type tr.detail-"+id).remove();
                    }else{
                        $('<tr role="row" class="detail-'+id+'"><th colspan="7"></th></tr>').insertAfter(tr);
                        $.ajax({
                            url:$(this).attr("href data-href"),
                            type:"GET",
                            success:function(e){
                                $("table#menu_type tr.detail-"+id+" th").html(e);
                            },
                            error:function(xhr){

                            }
                        });
                    }
                })
            }); 
        </script> 
        @endpush
  @stop  
