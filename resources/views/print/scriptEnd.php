<?php
header("Content-type: text/php; charset: UTF-8");
 
if (isset($document_type) && $ng_department) {
    if ($document_type) { 
        $document = \Models\document::where('type', $type)
            ->where('ng_department_id', 0)
            ->where('code', $document_type)
            ->first();
        if(!$document){
            $document = \Models\document::where('type', $type)
            ->where('ng_department_id', $ng_department->id)
            ->where('code', $document_type)
            ->first();
        }
        if ($document) {
            if($document->document_attribute->count() > 0 ){
                echo (new \Lib\core\DocumentLib($document, $objects))->getEndScript();
            }
        }

    }
}
