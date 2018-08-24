<?php
require_once dirname(__FILE__).'/tcpdf/tcpdf.php';
class Pdf_library extends TCPDF{
    public function __construct(){
        parent::__construct();
    }
}