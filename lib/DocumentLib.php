<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DocumentLib
{
    public $document;
    public $objects;
    public function __construct($document, $objects = [])
    {
        $this->document = $document;
        $this->objects = $objects;
    }

    public function getHeader()
    {

        $content = "";
        if ($this->document) {
            $document_attributes = \Models\DocumentAttribute::where('document_id', $this->document->id)
                ->where('parent_id', 0)
                ->where('status', 1)
                ->where('group', "header")
                ->whereNotIn('element', ['css', 'script'])
                ->get();
        }
        if ($document_attributes->count() > 0) {
            foreach ($document_attributes as $document_attribute) {
                $document_attribute_childrens = \Models\DocumentAttribute::where('parent_id', $document_attribute->id)->where('status', 1)->get();
                $array_data = [];

                if ($document_attribute_childrens->count() > 0) {

                    foreach ($document_attribute_childrens as $document_attribute_children) {
                        /**
                         * Set default value if not found
                         */
                        $array_data['@' . $document_attribute_children->code] = $document_attribute_children->default ? $document_attribute_children->default : "-";

                        if ($document_attribute_children->object) {

                            if (count($this->objects)) {
                                if (array_key_exists($document_attribute_children->object, $this->objects)) {

                                    $array_data['@' . $document_attribute_children->code] = ($this->objects[$document_attribute_children->object]->{$document_attribute_children->property}) ? $this->objects[$document_attribute_children->object]->{$document_attribute_children->property} : " - ";

                                } else {

                                    if (strpos($document_attribute_children->object, ".")) {

                                        $explod_codes = explode(".", $document_attribute_children->object);
                                        if (array_key_exists($explod_codes[0], $this->objects)) {
                                            $parent_object = $this->objects[$explod_codes[0]];
                                            if (!$parent_object->getRelations()) {

                                                $object = new $parent_object();
                                                $parent_object = $object::with($explod_codes[1])->find($parent_object->id);

                                            }
                                            if ($parent_object->getRelations()) {

                                                foreach ($parent_object->getRelations() as $key => $relation) {

                                                    if ($key == $explod_codes[1]) {

                                                        if (array_key_exists(3, $explod_codes)) {
                                                            foreach ($relation->getRelations() as $index => $value) {

                                                                if ($index == $explod_codes[3]) {

                                                                    $array_data['@' . $document_attribute_children->code] = ($value->{$document_attribute_children->property}) ? $value->{$document_attribute_children->property} : " - ";

                                                                }
                                                            }
                                                        } else {
                                                            $array_data['@' . $document_attribute_children->code] = ($relation->{$document_attribute_children->property}) ? $relation->{$document_attribute_children->property} : " - ";
                                                        }

                                                    }
                                                }
                                            }

                                        }
                                    }
                                }
                            }
                        } else {
                            if ($document_attribute_children->element == "script") {
                                $array_data['@' . $document_attribute_children->code] =  eval('?>'.$document_attribute_children->content.'<?php;');
                            } else {
                                $array_data['@' . $document_attribute_children->code] = $document_attribute_children->content;
                            }
                        }
                    }

                }

                if (array_key_exists("@barcode", $array_data)) {
                    //$array_data["@barcode"] = \DNS2D::getBarcodeHTML($array_data["@barcode"], "QRCODE", 5, 5);
                    $array_data["@barcode"] = '<img src="data:image/png;base64,' . base64_encode(QrCode::format('png')->merge($this->document->client->logo_asset, 0.4, true)->size(150)->errorCorrection('H')->generate($array_data["@barcode"]), ) . '">';
                }
                $content .= replaceString($array_data, $document_attribute->content);

            }
        }

        return $content;

    }

    public function getStartScript()
    {
        $content = "";
        if ($this->document) {
            $document_attributes = \Models\DocumentAttribute::where('document_id', $this->document->id)
                ->where('parent_id', 0)
                ->where('status', 1)
                ->where('position', "start")
                ->where('group', "content")
                ->orderBy('sequence')
                ->get();
        }
        if ($document_attributes->count() > 0) {
            foreach ($document_attributes as $document_attribute) {
                $content .= $document_attribute->content;
            }
        }

        if($content){
            $content = eval("?>".$content."<?php;");
        }
        return $content;
    }

    public function getEndScript()
    {
        $content = "";
        if ($this->document) {
            $document_attributes = \Models\DocumentAttribute::where('document_id', $this->document->id)
                ->where('parent_id', 0)
                ->where('status', 1)
                ->where('position', "end")
                ->where('group', "content")
                ->orderBy('sequence')
                ->get();
                if ($document_attributes->count() > 0) {
                    foreach ($document_attributes as $document_attribute) {
                        $content .= $document_attribute->content;
                    }
                }
        }

        if($content){
            $content = eval("?>".$content."<?php;");
        }
        return $content;

    }

    public function getFooter()
    {
        $content = "";
        if ($this->document) {
            $document_attributes = \Models\DocumentAttribute::where('document_id', $this->document->id)
                ->where('status', 1)
                ->where('group', "footer")
                ->orderBy('sequence')
                ->get();
            if ($document_attributes->count() > 0) {
                foreach ($document_attributes as $document_attribute) { 
                    $content .= $document_attribute->content;
                }
            }
        }

        if($content){
            $content = eval("?>".$content."<?php;");
        }
        return $content;

    }  
}
