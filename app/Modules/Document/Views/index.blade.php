@include('Document::list')
<script>
    $(document).ready(function() {

        $(document).on('click', '.plus-collapse', function() {
            var id = $(this).data('rowid');
            var url = $(this).data('url-source');
            if ($(this).hasClass('fa-plus-square')) {
                var targ = $(this).parents("table");
                $(targ).append(
                    '<div class="loader"><img src="/assets/images/preloader_2.gif" /></div>');

                $('.row_collapse_' + id).removeClass('hidden');
                $(this).removeClass('fa-plus-square');
                $(this).addClass('fa-minus-square');
                $.ajax({
                    url: url,
                    data: {
                        id: id
                    },
                    dataType: "html",
                    success: function(data) {
                        $(targ).find(".loader").remove();
                        $('.row_collapse_' + id).html(data);
                    }
                });
            } else {
                $('.row_collapse_' + id).addClass('hidden');
                $(this).addClass('fa-plus-square');
                $(this).removeClass('fa-minus-square');
            }
        }).on("click", "#add-button,.edit-attribute", function() {
            var targ = $("div#studentModal").find(".modal-body"); 
            $(targ).append(
                '<div class="loader"><img src="/assets/images/preloader_2.gif" /></div>');
            $.ajax({
                url: $(this).attr("data-route"), 
                success: function(data) {
                    $(targ).find(".loader").remove();
                    $(targ).html(data);
                }
            });
        }).on("change", "#element", function() {
            if($(this).val() =="script"){ 
                $("tr.content-text").removeClass('hide')
                $("tr.content-editor").addClass('hide')
            }else if($(this).val() =="html"){
                $("tr.content-text").addClass('hide')
                $("tr.content-editor").removeClass('hide')
            }else{
                $("tr.content-text").addClass('hide')
                $("tr.content-editor").addClass('hide')
            }
        });
    });
</script> 
