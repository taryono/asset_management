<?php
    header("Content-type: text/css; charset: UTF-8"); 
    if(isset($ng_department)){
        if($ng_department){
            $document = \Models\document::where('type', $type)
                    ->where('ng_department_id', 0)
                    ->where('code', $document_type)
                    ->first();
            if(!$document){
                $document = \Models\document::where('type', $type)->where('code', $document_type)->where('ng_department_id', $ng_department->id)->first();
            }

            if($document ){
                echo "<style>";
                $document_attribute = \Models\document_attribute::where('document_id', $document->id)->where('element', 'css')->first(); 
                if($document_attribute){
                    echo $document_attribute->content;
                }
                echo "</style>";
            }
        }
    } 
?>
         
