<?php
class Pdf_controller extends CI_Controller{
    public function __construct(){
        parent::__construct();
        $this->load->library('pdf_library');
    }
    public function generate_pdf_report(){
        
        $this->load->model('pdf_model');
		$qdata['data'] = $this->pdf_model->getDataXml();
		$this->load->view('data_report',$qdata);
    }
}