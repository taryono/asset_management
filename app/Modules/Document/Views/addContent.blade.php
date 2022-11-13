@extends('layouts.layout')

@section('content')
 
{{ Form::model($data, ['method' => 'PATCH','route'=>['document.storeContent',$data->id]]) }}
<div class="row page-content-detail"> 
    <div class="col-md-12"> 
        <div class="title-table">
            <h3>{{ say($title) }}</h3>
        </div>
        <div class="row">

            <div class="action-container-full">
                @include('component.actions')
            </div>
        
            <div class="col-md-12">
              <div class="panel panel-maroon">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ say('Dokument') }}</h3>
                </div>
                <table class="table-form">
                    <tr>
                        <td>{{ Form::label('Nama', say('Nama'), array('class'=>'control-label')) }}</td>
                        <td>:</td>
                        <td>
                            {{ Form::text('name', null, array('class'=>'form-control')) }}
                            <span class="help-block" style="float: left">{{ say('Silahkan pilih Nama yang ingin diterapkan') }}</span>
                        </td>
                    </tr> 
                    <tr>
                        <td>{{ Form::label('Kode', say('Kode'), array('class'=>'control-label')) }}</td>
                        <td>:</td>
                        <td>
                            {{ Form::text('code', null, array('class'=>'form-control')) }}
                            <span class="help-block" style="float: left">{{ say('Silahkan pilih Kode yang ingin diterapkan') }}</span>
                        </td>
                    </tr>  
                    <tr>
                        <td>{{ Form::label('Tipe', say('Tipe'), array('class'=>'control-label')) }}</td>
                        <td>:</td>
                        <td>
                            {{ Form::select('type', ['pdf'=> 'PDF', 'xls'=> 'XLS'], null, array('class'=>'form-control')) }}
                            <span class="help-block" style="float: left">{{ say('Silahkan pilih Tipe yang ingin diterapkan') }}</span>
                        </td>
                    </tr> 
                    
                </table>
              </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-md-12">
              <div class="panel panel-maroon">
                <div class="panel-heading">
                    <h3 class="panel-title">{{ say('Content') }}</h3>
                </div>
                <div class="panel-body">
                    <table class="table-form"> 
                    <?php    $document_attributes = \Models\DocumentAttribute::where('document_id', $data->id)
                         
                        ->where('status', 1)
                        ->whereIn('position', ["start","end"])
                        ->where('group', "content")
                        ->orderBy('sequence')
                        ->orderBy('position')
                        ->get();
                    ?>
                        @if ($document_attributes->count() > 0) 
                            @foreach ($document_attributes as $document_attribute)  
                                <tr> 
                                    <td> 
                                        {{ Form::select('attributes['.$document_attribute->id.'][position]',["start"=> "Start/Sebelum Template Content", "end"=> "End/Setelah Template Content"], $document_attribute->position, array('class'=>'form-control', 'cols'=> "130")) }}
                                        <span class="help-block" style="float: left">{{ say('Pilih posisi script yang ingin diterapkan') }}</span>
                                    </td>
                                </tr> 
                                <tr> 
                                    <td>
                                        {{ Form::sequences('attributes['.$document_attribute->id.'][sequence]',null, $document_attribute->sequence, array('class'=>'form-control', 'cols'=> "130")) }}
                                        <span class="help-block" style="float: left">{{ say('Pilih urutan yang ingin diterapkan') }}</span>
                                    </td>
                                </tr> 
                                <tr> 
                                    <td>
                                        {{ Form::textarea('attributes['.$document_attribute->id.'][content]', $document_attribute->content, array('class'=>'form-control', 'cols'=> "130")) }}
                                        <span class="help-block" style="float: left">{{ say('Silahkan setup Content yang ingin diterapkan') }}</span>
                                    </td>
                                </tr>  

                            @endforeach
                        @endif
                        <tr> 
                            <td>
                                {{ Form::select('attributes[0][position]', ["start"=> "Start/Sebelum Template Content", "end"=> "End/Setelah Template Content"],null, array('class'=>'form-control', 'cols'=> "130")) }}
                                <span class="help-block" style="float: left">{{ say('Pilih posisi script yang ingin diterapkan') }}</span>
                            </td>
                        </tr>  
                        <tr> 
                            <td>
                                {{ Form::sequences('attributes[0][sequence]',null, null, array('class'=>'form-control', 'cols'=> "130")) }}
                                <span class="help-block" style="float: left">{{ say('Pilih urutan yang ingin diterapkan') }}</span>
                            </td>
                        </tr> 
                        <tr> 
                            <td>
                                {{ Form::textarea('attributes[0][content]', null, array('class'=>'form-control', 'cols'=> "130")) }}
                                <span class="help-block" style="float: left">{{ say('Silahkan setup Content yang ingin diterapkan') }}</span>
                            </td>
                        </tr>  
                        
                    </table>
                    @if ($errors->any())
                    <ul>
                        {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                    </ul>
                    @endif
                </div>
              </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}

<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css')}}">
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css')}}"> 
<script src="{{ asset('assets/plugins/summernote/summernote.min.js')}}"></script>
<script src="{{ asset('assets/js/summernote-cleaner.js')}}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js')}}"></script>
<script>
    $(function(){
        $(".selectpicker").selectpicker('refresh');
        $('.text-editor').summernote({
            height: 100,
            fontSizes: ['8', '9', '10', '11', '12', '14', '16', '18', '20', '22', '24'],
            toolbar: [ 
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['insert', ['table']],
                ['Misc', ['codeview', 'fullscreen']]
            ], 
            cleaner:{
                action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
                newline: '<br>', // Summernote's default is to use '<p><br></p>'
                notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
                icon: '<i class="note-icon">[Your Button]</i>',
                keepHtml: false, // Remove all Html formats
                keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>','<i>', '<a>'], // If keepHtml is true, remove all tags except these
                keepClasses: false, // Remove Classes
                badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript', 'html'], // Remove full tags with contents
                badAttributes: ['style', 'start'], // Remove attributes from remaining tags
                limitChars: false, // 0/false|# 0/false disables option
                limitDisplay: 'both', // text|html|both
                limitStop: false // true/false
            },
            onImageUpload: function (files, editor, welEditable) {
                sendFile(files[0], editor, welEditable);
            },
            callbacks: {
                onKeyup: function(e) {
                    var text = $(this).next( '.note-editor' ).find( '.note-editable' ).text(); 
                    //console.log(text.length);   
                    $(this).next( '.note-editor' ).parent('td').find('.count').html(text.length);
                    if(text.length > 1200){
                        $(this).next( '.note-editor' ).parent('td').find('.count_alert').html('( Melebihi Batas, Menjadi 1 Halaman. )');
                    }else{
                        $(this).next( '.note-editor' ).parent('td').find('.count_alert').html('')
                    }
                },
                onInit: function(e){
                    var text = $(this).next( '.note-editor' ).find( '.note-editable' ).text(); 
                    //console.log(text.length);   
                    $(this).next( '.note-editor' ).parent('td').find('.count').html(text.length);
                    if(text.length > 1200){
                        $(this).next( '.note-editor' ).parent('td').find('.count_alert').html('( Melebihi Batas, Menjadi 1 Halaman. )');
                    }else{
                        $(this).next( '.note-editor' ).parent('td').find('.count_alert').html('');
                    }
                },
                onPaste: function (e) {
                    e.preventDefault();
                    $(this).summernote('removeFormat');
                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                    //document.execCommand('insertText', false, bufferText);
                }
            }
        }, '');
 
    });
</script>
@endsection