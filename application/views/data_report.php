<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php include_once'header.php'?>
<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
//require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('CRDB');
$pdf->SetTitle('CRDB AUDIT REPORT');
$pdf->SetSubject('AUDIT REPORT');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}


$pdf->SetFont('times', '', 8);
$pdf->AddPage();
$heading = <<<EOD
<h3 style"font-weight: normal;">Data report As Per Entry</h3>
EOD;
$pdf->writeHTMLCell(0, 0,'','', $heading, 0, 8, 0, true, 'C', true);
$pdf->Ln(4);
$table ='<table style=" cellpading=1;">';
$table .='<tr style="background-color:#52B552; color:#ffffff; font-size: 14px;">
        <th style="border:1px solid black">REMARKS</th>
        <th style="border:1px solid black">ACTION_NAME</th>
        <th style="border:1px solid black">USERNAME</th>
        <th style="border:1px solid black">TERMINAL</th>
        <th style="border:1px solid black">TIMESTAMP</th>
        <th style="border:1px solid black">SESSIONID</th>
        </tr>';
        foreach($data as $row){
        
        $table .='<tr >'; 

            if ($row->REMARKS=="") {
            $table .='<td style="border:0.5px solid black;border-collapse: collapse; background-color:#FFFF00">NO REMARKS</td>';
                }else{
            $table .='<td style="border:0.5px solid black;border-collapse: collapse;">'.$row->REMARKS.'</td>';
            }
          $table .='<td style="border:0.5px solid black;border-collapse: collapse;">'.$row->ACTION_NAME.'</td>
          <td style="border:0.5px solid black;border-collapse: collapse;">'.$row->USERNAME.'</td>
          <td style="border:0.5px solid black;border-collapse: collapse;">'.$row->TERMINAL.'</td>
          <td style="border:0.5px solid black; border-collapse: collapse;">'.$row->TIMESTAMP.'</td>
          <td style="border:0.5px solid black;border-collapse: collapse;">'.$row->SESSIONID.'</td>
         </tr>';     
        }
$table .= '</table>';
$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);

ob_clean();
$pdf->Output('audit_report.pdf', 'I');
end_ob_clean();
?>

 <?php include_once'footer.php';
?>