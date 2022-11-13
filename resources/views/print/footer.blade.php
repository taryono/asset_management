<?php $is_document_configured = false; ?>
@if (isset($document_type))
    @if($document_type && $ng_department)
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
        
        @if ($document) 
            @if($document->document_attribute->count() > 0 )
                <?php $is_document_configured = true; ?>
                {!! (new \Lib\core\DocumentLib($document, $objects))->getFooter() !!}
            @endif 
        @endif 
    @endif 
@endif
{{-- If not found document setup --}}
@if(!$is_document_configured)
    @if ($footer)
        @if(view()->exists($footer))
            @include($footer)
        @endif 
    @else
        <div class="footer" style="text-align: center; width: 100%; bottom:0px;position: absolute; border:none">
            {!! $client->keterangan_footer_pdf !!}
        </div>
    @endif
@endif
