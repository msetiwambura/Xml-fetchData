<?php 
class Pdf_model extends CI_Model{
    
 	function __construct()
 	{
 		parent::__construct();
 	}
 	public function getDataXml(){
 		$xml = simplexml_load_file("http://localhost/xml/audit_xml.xml");
 		return $xml; 
 	}
}