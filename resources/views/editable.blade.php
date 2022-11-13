<script>
    var source = '{{$data_source}}';
    $(function() {
        //$.fn.editable.defaults.mode = 'inline';
        moment.locale('id');
        
        if(source == "sex"){
            source = [{'F': 'Perempuan'}, {'M': 'Laki - Laki'}];
        }

        if(source == "blood"){
            source = [{1: 'A'}, {2: 'B'}, {3: 'AB'}, {4: 'O'}];
        }

        if(source == "religion"){
            source = [{1: 'Islam'}, {2: 'Kristen'}, {3: 'Katolik'}, {4: 'Hindu'}, {5: 'Budha'}, {6: 'Konghucu'}];
        }

        if(source == "sequence"){
            source = {{json_encode(range(1,30))}}
        } 
    });
</script>
@if(\Auth::check())
    <a href="#" id="{{$id}}" data-name="{{$data_name}}" data-type="{{$data_type}}" data-pk="{{$data_pk}}" data-url="{{$data_url}}" data-title="{{$data_title}}"> {{$display}}</a>
    <script>
        $(function() { 
            $("a#{{$id}}").editable({ 
                source:source,
                params: {
                    model: '{{$model}}',
                }

            });
        });
    </script>   
@endif 