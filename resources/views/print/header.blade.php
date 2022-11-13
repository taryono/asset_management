<?php $is_document_configured = false; ?>

@if(isset($document_type) && $ng_department)
    @if($document_type)
        <?php 
        $document = \Models\document::where('type', $type)
                    ->where('client_id', 0)
                    ->where('code', $document_type)
                    ->first();
        if(!$document){ 
            $document = \Models\document::where('type', $type)
                        ->where('ng_department_id', 0)
                        ->where('client_id', $ng_department->client_id)
                        ->where('code', $document_type)
                        ->first();
                 
            if(!$document){    
                $document = \Models\document::where('type', $type)
                            ->where('ng_department_id', $ng_department->id)
                            ->where('code', $document_type)
                            ->first();
            }
        }
        ?>
        @if($document)  
            @if($document->document_attribute->count() > 0 )
                <?php $is_document_configured = true; ?> 
                {!! (new \Lib\core\DocumentLib($document, $objects))->getHeader() !!} 
            @endif 
        @endif 
    @endif 
@endif 
 
{{-- If not found document setup --}}
@if(!$is_document_configured)
    @if($header)
        @if(view()->exists($header))
            @include($header)
        @endif 
    @else 
        @if($type == "pdf")
            @if(view()->exists('component.header_pdf'))
                @include('component.header_pdf') 
            @endif
        @else
            @if(view()->exists('component.header_xls'))
                @include('component.header_xls') 
            @endif 
        @endif
    @endif
@endif