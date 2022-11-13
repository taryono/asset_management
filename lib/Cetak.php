<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Lib;

use App;
use Dompdf\Canvas;
use Dompdf\FontMetrics;
use PDF;
use View;
use App\Http\Controllers\MainController;
/**
 * How to use this library using in controller you can see in example module ng_post_purcahse_order
 */

class Cetak extends MainController
{
    protected $controller;
    protected $template;
    protected $data;
    protected $filename;
    protected $paper_size = 'A4'; //https://github.com/dompdf/dompdf/blob/v0.6.1/include/cpdf_adapter.cls.php#L37
    protected $paper_orientation = 'portrait';
    protected $options = ['isPhpEnabled' => true, 'enable_remote' => true];
    protected $title_col_sum;
    protected $title_head_export;
    protected $enable_header = false;
    protected $enable_footer = false;
    protected $header_html;
    protected $footer_html;
    protected $start_number;
    protected $start_page = 1;
    protected $number_position = "right";
    protected $number_format = "{PAGE_NUM}/{PAGE_COUNT}";
    protected $footer_text = "";
    protected $font;
    protected $title;
    protected $enable_text_watermark = false;
    protected $text_watermark = "";
    protected $enable_image_watermark = false;
    protected $image; //path image
    protected $canvas_width;
    protected $canvas_height;
    protected $x;
    protected $y;
    protected $document_type;
    protected $type;
    protected $ng_department;
    protected $css;
    protected $objects;

    public function __construct($controller = null, $data = null, $filename = null, $template = null)
    {
        $this->controller = $controller;
        $this->template = $template;
        $this->data = $data;
        $this->filename = $filename ? $filename : (isset($this->controller) ? $this->controller->title : "");
        $this->title = $this->filename;
    }

    public function setObjects($objects)
    {
        $array_objects = [];
        if (is_array($objects)) {
            foreach ($objects as $object) {
                if($object){
                    $array_objects[$object->getTable()] = $object;
                }
            }
        } else {
            $array_objects[$objects->getTable()] = $objects;
        }

        $this->objects = $array_objects; 
        return $this;
    }

    public function getObjects()
    {
        return $this->objects;
    }

    public function setPaper($paper_size, $paper_orientation = "portrait")
    {
        $this->paper_size = $paper_size;
        $this->paper_orientation = $paper_orientation;
        return $this;
    }

    public function setPaperOrientation($paper_orientation)
    {
        $this->paper_orientation = $paper_orientation;
        return $this;
    }

    public function addData($data)
    {
        $this->data = array_merge($this->data, $data);
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    // set font
    public function setFont($font)
    {
        $this->font = $font;
        return $this;
    }

    // get font 
    public function getFont()
    {
        return $this->font;
    }

    // setTitle
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    // getTitle
    public function getTitle()
    {
        return $this->title;
    }

    // set header_html
    public function setHeaderHtml($header_html)
    {
        $this->header_html = $header_html;
        return $this;
    }

    // set footer_html
    public function setFooterHtml($footer_html)
    {
        $this->footer_html = $footer_html;
        return $this;
    }

    // set footer_text
    public function setFooterText($footer_text)
    {
        $this->footer_text = $footer_text;
        return $this;
    }
    //get footer_text
    public function getFooterText()
    {
        return strip_tags($this->footer_text);
    }

    // get header_html
    public function getHeaderHtml()
    {
        return $this->header_html;
    }

    // get footer_html
    public function getFooterHtml()
    {
        return $this->footer_html;
    }

    // set enable_header
    public function enableHeader($enable_header = true)
    {
        $this->enable_header = $enable_header;
        return $this;
    }

    // set enable_footer
    public function enableFooter($enable_footer = true)
    {
        $this->enable_footer = $enable_footer;
        return $this;
    }

    public function enableTextWatermark($enable_text_watermark = true)
    {
        $this->enable_text_watermark = $enable_text_watermark;
        return $this;
    }

    public function isEnableTextWatermak()
    {
        return $this->enable_text_watermark;
    }

    public function setTextWatermark($text_watermark)
    {
        $this->text_watermark = $text_watermark;
        return $this;
    }

    public function getTextWatermark()
    {
        return $this->text_watermark;
    }

    public function enableImageWatermark($enable_image_watermark = true)
    {
        $this->enable_image_watermark = $enable_image_watermark;
        return $this;
    }

    public function isEnableImageWatermark()
    {
        return $this->enable_image_watermark;
    }

    // set start_number
    public function startNumber($start_number = 1)
    {
        $this->start_number = $start_number;
        return $this;
    }

    // set start_page
    public function startPage($start_page)
    {
        $this->start_page = $start_page;
        return $this;
    }

    public function getStartNumber()
    {
        return $this->start_number;
    }

    public function getStartPage()
    {
        return $this->start_page;
    }

    public function setFilename($filename)
    {
        $this->filename = $filename;
        return $this;
    }

    public function setOptions($options)
    {
        $this->options = array_merge($this->options, $options);
        return $this;
    }

    public function getOptions()
    {
        return $this->options;
    }

    public function setTitleColSum($title_col_sum)
    {
        $this->title_col_sum = $title_col_sum;
        return $this;
    }

    public function setTitleHeadExport($title_head_export)
    {
        $this->title_head_export = $title_head_export;
        return $this;
    }

    public function getTitleColSum()
    {
        return $this->title_col_sum;
    }

    public function getTitleHeadExport()
    {
        return $this->title_head_export;
    }

    // set image
    public function setWatermark($image, $canvas_width = null, $canvas_height = null, $x = null, $y = null)
    {
        $this->image = $image;
        $this->canvas_width = $canvas_width;
        $this->canvas_height = $canvas_height;
        $this->x = $x;
        $this->y = $y;

        return $this;
    }

    public function getCanvasWidth()
    {
        return $this->canvas_width;
    }

    public function getCanvasHeight()
    {
        return $this->canvas_height;
    }

    public function getX()
    {
        return $this->canvas_height;
    }


    public function getY()
    {
        return $this->canvas_height;
    }


    // get image
    public function getWatermark()
    {
        return $this->image;
    }

    public function setDocumentType($document_type){
        $this->document_type = $document_type;
        return $this;
    }

    public function getDocumentType()
    {
        return $this->document_type;
    }

    public function setType($type){
        $this->type = $type;
        return $this;
    }

    public function getType()
    {
        return $this->type;
    }

    public function setDepartment($ng_department){
        $this->objects['ng_department'] = $ng_department;
        $this->ng_department = $ng_department;
        return $this;
    }

    public function getDepartment()
    {
        return $this->ng_department;
    }

    public function setCss($css){
        $this->css = $css;
        return $this;
    }

    public function getCss()
    {
        return $this->css;
    }

    public function getData()
    {
        if ($this->getCss()) { // jika ada title head export
            view::share('css', $this->getCss());
        }

        if ($this->getTitle()) { // jika ada title head export
            view::share('title', $this->getTitle());
        }

        if ($this->getTitleHeadExport()) { // jika ada title head export
            view::share('title_head_export', $this->getTitleHeadExport());
        }

        if ($this->getDocumentType()) { // jika ada tipe document
            view::share('document_type', $this->getDocumentType());
        } 
         
        if ($this->getDepartment()) { // jika ada tipe document
            view::share('ng_department', $this->getDepartment());
        }

        if ($this->getType()) { // jika ada tipe document
            view::share('type', $this->getType());
        } 

        if ($this->getObjects()) { 
            view::share('objects', $this->getObjects());
        } 

        if (is_array($this->data)) {
            $this->data['document_type'] = $this->getDocumentType()??null;
            $this->data['type'] = $this->getType()??null;
            $this->data['department'] = $this->getDepartment()??null;

            if (is_exists('datas', $this->data)) {
                if (empty($this->data['datas'])) {
                    $this->data['datas'] = $this->controller->getList(request());
                }
            }

            if (is_exists('actions', $this->data)) {
                unset($this->data['actions']);
            }

            if (is_exists('title_col_sum', $this->data)) {
                if (empty($this->data['title_col_sum'])) {
                    $this->data['title_col_sum'] = $this->getTitleColSum();
                }
            } else {
                $this->data['title_col_sum'] = $this->getTitleColSum();
            }

            if (is_exists('title_head_export', $this->data)) {
                if (empty($this->data['title_head_export'])) {
                    $this->data['title_head_export'] = $this->getTitleHeadExport() ? $this->getTitleHeadExport() : $this->controller->title;
                }
            } else {
                $this->data['title_head_export'] = $this->getTitleHeadExport() ? $this->getTitleHeadExport() : $this->controller->title;
            }
        }

        $this->data['client'] = auth()->user()->client;
        $this->data['enable_header'] = $this->enable_header;
        $this->data['enable_footer'] = $this->enable_footer;
        $default = "print.template";
        if(isset($this->controller->controller_name)){
            if(view()->exists( $this->controller->controller_name . "::getListAsPdf")){
                $default = $this->controller->controller_name . "::getListAsPdf";
            } 
        }
        $this->data['template'] = $this->template ? $this->template : $default;
        $this->data['header'] = $this->getHeaderHtml();
        $this->data['footer'] = $this->getFooterHtml();
        $this->data['objects'] = $this->getObjects();
   
        return $this->data;
    }

    public function setNumberPosition($position = "right")
    {
        $this->number_position = $position;
        return $this;
    }

    public function getNumberPosition()
    {
        return $this->number_position;
    }

    public function setNumberFormat($format)
    {
        $this->number_format = $format;
        return $this;
    }

    public function getNumberFormat()
    {
        return $this->number_format;
    }

    public function numberSetup($canvas)
    {
        //center the text horizontally on the page
        if ($this->getNumberPosition() == "right") {
            //right align the text on the page
            $x = $canvas->get_width() - 50;
        } elseif ($this->getNumberPosition() == "left") {
            //left align the text on the page
            $x = $canvas->get_width() - ((95 / 100) * $canvas->get_width());
        } else {
            //center the text horizontally on the page
            $x = $canvas->get_width() / 2 - 20;
        }
        return $x;
    }

    public function pdf()
    {
        $this->setType("pdf");
        if (App::environment('local')) {
            return view("print.pdf", $this->getData());
        }
        
        $pdf = PDF::loadView("print.pdf", $this->getData())
            ->setPaper($this->paper_size, $this->paper_orientation)
            ->setOptions($this->getOptions());
        $pdf->output();
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true,
            ],
        ]);

        $pdf->getDomPDF()->setHttpContext($contxt);
        $canvas = $pdf->getDomPDF()->getCanvas();
        $page_number = $canvas->get_page_number();
        $page_count = $canvas->get_page_count();

        $y = $canvas->get_height() - 40;
        $number_position = $this->numberSetup($canvas);

        $number_text = $this->getNumberFormat();
        $font = $pdf->getDomPDF()->getFontMetrics()->get_font('Arial', 'normal');
        $size = 10;
        $color = array(0, 0, 0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle = 0.0;

        if($this->enable_footer){

            if ($this->getFooterText()) {
                $canvas->page_text(
                    30,
                    $y,
                    $this->getFooterText(),
                    $font,
                    $size,
                    $color,
                    $word_space,
                    $char_space,
                    $angle
                );
            }
    
            if ($this->getStartPage() && $this->getStartPage() > 1) {
                $canvas->page_script(
                    '(new \Lib\core\Cetak())->startNumber(' . $this->getStartNumber() . ')->startPage(' . $this->getStartPage() . ')->outputPageNumbers($pdf, $fontMetrics, $PAGE_NUM, $PAGE_COUNT);'
                );
            } else {
                $canvas->page_text(
                    $number_position,
                    $y,
                    $number_text,
                    $font,
                    $size,
                    $color,
                    $word_space,
                    $char_space,
                    $angle
                );
            }
        }

        // Watermaks
        if ($this->isEnableImageWatermark() && $this->getWatermark()) {
            // Image watermark
            $canvas->set_opacity(0.1);
            $canvas_width = $this->getCanvasWidth() ? $this->getCanvasWidth() : ($canvas->get_width() / 2);
            $canvas_height = $this->getCanvasHeight() ? $this->getCanvasHeight() : ($canvas->get_height() / 2);
            $x = $this->getX() ? $this->getX() : 50;
            $y = $this->getY() ? $this->getY() : 50;
            $canvas->image($this->getWatermark(), $canvas_width, $canvas_height, $x, $y);
        }

        if ($this->isEnableTextWatermak()) {
            // Text watermark
            $newcanvas = $pdf->getDomPDF()->getCanvas();
            $newcanvas->set_opacity(0.2);
            $newcanvas->page_text($newcanvas->get_width() / 5, $newcanvas->get_height() / 2, $this->getTextWatermark(), $font = null, $size = 70, $color = array(0, 0, 0), 2, 2, $angle = -30);
        }

        return $pdf->stream($this->filename);
    }

    public function xls()
    {
        $this->setType("xls");
        if (\App::environment('local')) {
            return view("print.xls", $this->getData());
        }
        return response(view("print.xls", $this->getData()))
            ->header('Content-Type', 'application/vnd-ms-excel')
            ->header('Content-Disposition', 'attachment; filename="' . $this->filename . '.xls"');
    }

    public function outputPageNumbers(Canvas $pdf, FontMetrics $fontMetrics, $PAGE_NUM, $PAGE_COUNT)
    {

        if ($PAGE_NUM >= $this->getStartPage()) {
            $font = $fontMetrics->getFont("Arial", "bold");
            $current_page = $PAGE_NUM - $this->getStartNumber();
            $total_pages = $PAGE_COUNT - $this->getStartNumber();
            $pdf->text(522, 770, " $current_page / $total_pages", $font, 10, array(0, 0, 0));
        }
    }
}
