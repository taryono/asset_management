 
@if ($data)
{{ Form::model($data, ['method' => 'PATCH', 'route' => ['document.updateAttribute', $data->id]]) }}
<?php 
$document_id = $data->document_id;
$content_text =  $data->element != "script"?"hide":"";
$content_editor =  $data->element != "html"?"hide":"";
?>
@else
{{ Form::open(['route' => $controller_name . '.storeAttribute']) }}
{{ Form::hidden('document_id', $document_id) }}
<?php  
$content_text =  null;
$content_editor =  "hide";
?>
@endif

<div class="row page-content-detail">
<div class="col-md-12">
    <div class="panel panel-maroon">
        <div class="panel-heading">
            <h3 class="panel-title">{{ say('Document Attribut') }}</h3>
        </div>
        <div class="panel-body">
            <table class="table-form">
            </table>
            @if ($errors->any())
                <ul>
                    {{ implode('', $errors->all('<li class="error">:message</li>')) }}
                </ul>
            @endif
            <div class="panel-body">
                <table class="table-form">
                    <tr class="parent">
                        <td>
                            {{ Form::select('parent_id',[""=> say("-- Pilih Parent -- ")] +\Models\DocumentAttribute::where('document_id', $document_id)->where('parent_id', 0)->where('element', '<>', 'css')->pluck('name','id')->all(), null, ['class' => 'form-control', 'id' => 'parent_id']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Parent') }}</span>
                        </td>
                     </tr>
                     <tr class="code">
                        <td>
                            {{ Form::text('code', null, ['class' => 'form-control', 'id' => 'code']) }}
                            <span class="help-block" style="float: left">{{ say('Isikan Kode target') }}</span>
                        </td>
                    </tr> 
                     <tr class="element">
                        <td>
                            {{ Form::select('element', [""=> say('-- Pilih Element --'), 'image' => say('Image'), 'html' => say('HTML/ Template'), 'script' => say('Script'), 'property' => say('Propert Objek')], null, ['class' => 'form-control', 'id' => 'element']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Element yang ingin diterapkan') }}</span>
                        </td>
                    </tr> 
                    <tr class="status">
                        <td>
                            {{ Form::select('status', [""=> say('-- Pilih Status --'),  1 => say('Aktif'), 0 => say('Tidak Aktif')], null, ['class' => 'form-control', 'id' => 'status']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Status') }}</span>
                        </td>
                    </tr>  
                    <tr class="sequence">
                        <td>
                            {{ Form::sequences('sequence', [], null, ['class' => 'form-control', 'id' => 'sequence']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Urutan') }}</span>
                        </td>
                    </tr> 
                    <tr class="object">
                        <td>
                            {{ Form::text('object', null, ['class' => 'form-control', 'id' => 'object']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Object yang ingin diterapkan') }}</span>
                        </td>
                    </tr> 
                    <tr class="property">
                        <td>
                            {{ Form::text('property', null, ['class' => 'form-control', 'id' => 'property']) }}
                            <span class="help-block" style="float: left">{{ say('Pilih Property yang ingin diterapkan') }}</span>
                        </td>
                    </tr>  
                    <tr class="content-editor {{$content_editor}}">
                        <td class="content">
                            {{ Form::textarea('content', null, ['class' => 'form-control text-editor', 'id'=> 'content']) }}

                            <span class="help-block" style="float: left">{{ say('Silahkan setup Conten yang ingin diterapkan') }}</span>
                            <div class="counter">
                                Jumlah Karakter : <span class="count"></span>
                                <span class="count_alert"></span>
                                <hr>
                            </div>
                        </td>
                    </tr>
                    <tr class="content-text {{$content_text}}">
                        <td>
                            {{ Form::textarea('content', null, ['class' => 'form-control', 'id'=> 'content','cols'=> '100']) }}
                            <span class="help-block" style="float: left">{{ say('Silahkan setup Conten yang ingin diterapkan') }}</span>                                 
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

<link rel="stylesheet" href="{{ asset('assets/plugins/summernote/summernote.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.css') }}">
<script src="{{ asset('assets/plugins/summernote/summernote.min.js') }}"></script>
<script src="{{ asset('assets/js/summernote-cleaner.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script>
$(function() {
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
        cleaner: {
            action: 'both', // both|button|paste 'button' only cleans via toolbar button, 'paste' only clean when pasting content, both does both options.
            newline: '<br>', // Summernote's default is to use '<p><br></p>'
            notStyle: 'position:absolute;top:0;left:0;right:0', // Position of Notification
            icon: '<i class="note-icon">[Your Button]</i>',
            keepHtml: false, // Remove all Html formats
            keepOnlyTags: ['<p>', '<br>', '<ul>', '<li>', '<b>', '<strong>', '<i>',
            '<a>'], // If keepHtml is true, remove all tags except these
            keepClasses: false, // Remove Classes
            badTags: ['style', 'script', 'applet', 'embed', 'noframes', 'noscript',
            'html'], // Remove full tags with contents
            badAttributes: ['style', 'start'], // Remove attributes from remaining tags
            limitChars: false, // 0/false|# 0/false disables option
            limitDisplay: 'both', // text|html|both
            limitStop: false // true/false
        },
        onImageUpload: function(files, editor, welEditable) {
            sendFile(files[0], editor, welEditable);
        },
        callbacks: {
            onKeyup: function(e) {
                var text = $(this).next('.note-editor').find('.note-editable').text();
                //console.log(text.length);   
                $(this).next('.note-editor').parent('td').find('.count').html(text.length);
                if (text.length > 1200) {
                    $(this).next('.note-editor').parent('td').find('.count_alert').html(
                        '( Melebihi Batas, Menjadi 1 Halaman. )');
                } else {
                    $(this).next('.note-editor').parent('td').find('.count_alert').html('')
                }
            },
            onInit: function(e) {
                var text = $(this).next('.note-editor').find('.note-editable').text();
                //console.log(text.length);   
                $(this).next('.note-editor').parent('td').find('.count').html(text.length);
                if (text.length > 1200) {
                    $(this).next('.note-editor').parent('td').find('.count_alert').html(
                        '( Melebihi Batas, Menjadi 1 Halaman. )');
                } else {
                    $(this).next('.note-editor').parent('td').find('.count_alert').html('');
                }
            },
            onPaste: function(e) {
                e.preventDefault();
                $(this).summernote('removeFormat');
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                    .getData('Text');
                //document.execCommand('insertText', false, bufferText);
            }
        }
    }, '');

});
</script>
{{ Form::close() }}
