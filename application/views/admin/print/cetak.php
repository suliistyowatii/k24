<?php
//============================================================+
// File name   : example_005.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 005 for TCPDF class
//               Multicell
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
 * @abstract TCPDF - Example: Multicell
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
// require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('PT. Amarylis Kharisma Gemilang');
$pdf->SetTitle('Sales Quotation');
$pdf->SetSubject('BEP');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

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

// ---------------------------------------------------------

// set font

$pdf->SetFont('times', '', 10);

// add a page
$pdf->AddPage();

// set cell padding
$pdf->setCellPaddings(1, 1, 1, 1);

// set cell margins
$pdf->setCellMargins(1, 1, 1, 1);

// set color for background
$pdf->SetFillColor(255, 255, 127);

// MultiCell($w, $h, $txt, $border=0, $align='J', $fill=0, $ln=1, $x='', $y='', $reseth=true, $stretch=0, $ishtml=false, $autopadding=true, $maxh=0)

// set some text for example


// Multicell test
$title = <<<EOD
<h2>Sales Quotation</h2>
EOD;
$pdf->SetFont('times');
// $pdf->WriteHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);
// $pdf->MultiCell(100, 5, $heading, 1, 'C', 0, 0, '', '', true);
$pdf->Ln(0);
$tDate=date('d F Y');
$table = '<table style="padding:3px;" width="850px">';
$table .= '<tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Date</th>
			<th  width="150px" >: '.$tDate.'</th>
		  </tr>';

 foreach ($getbep as $d) 
{
$table .= '<tr>
			<td ></td>
			<td width="200px"  align="Left"></td>
			<td width="75px" align="Left">Quotation No</td>
			<td  width="80px">: '.$d->bep_id.'</td>
		  </tr>
		  ';
		}

		
$table .= '<tr>
					<td ></td>
					<td width="200px"  align="Left"></td>
					<td width="77px" align="Left">Created by</td>
					<td  width="150px">: '.$username.'</td>
				  </tr>
		';
			
$no = 1;
$table .= '</table>';

$text='<b>QUOTATION FOR</b>';

$table2='<table style="border:1px dotted #000; " width="800px">';


foreach ($getbep as $d) 
{
$table2 .= '<tr >
			<th >'.$d->namacust.'</th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Validity</th>
			<th  width="150px" >: </th>
		  </tr>';
$table2 .='<tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Top</th>
			<th  width="150px" >: </th>
		  </tr>
		  <tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">FOB Point</th>
			<th  width="150px" >: </th>
		  </tr>
		  <tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Lead Time</th>
			<th  width="150px" >: </th>
		  </tr>';
}
$table2 .= '</table>';
$text2='<b>Comments or Special Instructions : </b>';

$tabel3='<table style="border:1px dotted #000; " width="640px"  height="100px" cellpadding="25">';
$tabel3 .= '<tr  height="100px">
			<th ></th>
		
		  </tr>';
$tabel3.='</table><br>';

$tabel4='<table style="border:1px  solid #000;padding:6px;" width="310px"  height="100px" >';

$tabel4.= '<tr style="background-color:#6495ED;" >
			<th style="border:1px solid #000;">No</th>
			<th width="150px" style="border:1px solid #000;">Product Name</th>
			<th width="100px" style="border:1px solid #000;">Parts</th>
			<th width="100px" style="border:1px solid #000;">weight (Gr)</th>
			<th width="100px" style="border:1px solid #000;">Material</th>
			<th width="100px" style="border:1px solid #000;">Price/pc</th>
			<th style="border:1px solid #000;">QTY</th>
		  </tr>';
		  $no = 1;
		  foreach ($getbep as $d) 
{

	$totalbrt=$d->beratfgp1+$d->beratfgp2+$d->beratfgp3+$d->beratfgp4;
	$prc=round($d->dua);
	$tabel4.='		  <tr>
					<td style="border:1px solid #000;">'.$no++.'</td>
					<td width="150px" style="border:1px solid #000;">'.$d->namabrg.'</td>
					<td width="100px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">'.$totalbrt.'</td>
					<td width="100px"  align="Left" style="border:1px solid #000;"></td>
					<td width="100px" align="Left" style="border:1px solid #000;">Rp. '.rupiah($d->dua).',-</td>
					<td style="border:1px solid #000;" >'.$d->keterangan.'</td>
				  </tr>
				  <tr>
					<td style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">1. '.$d->namap1.'</td>
					<td width="100px" style="border:1px solid #000;">'.$d->beratfgp1.' Gram</td>
					<td width="100px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="100px" align="Left" style="border:1px solid #000;"></td>
					<td style="border:1px solid #000;" ></td>
				  </tr>
				  <tr>
					<td style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">2. '.$d->namap2.'</td>
					<td width="100px" style="border:1px solid #000;">'.$d->beratfgp2.' Gram</td>
					<td width="100px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="100px" align="Left" style="border:1px solid #000;"></td>
					<td style="border:1px solid #000;" ></td>
				  </tr>
				  <tr>
					<td style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">3. '.$d->namap3.'</td>
					<td width="100px" style="border:1px solid #000;">'.$d->beratfgp3.' Gram</td>
					<td width="100px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="100px" align="Left" style="border:1px solid #000;"></td>
					<td style="border:1px solid #000;" ></td>
				  </tr>
				  <tr>
					<td style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">4. '.$d->namap4.'</td>
					<td width="100px" style="border:1px solid #000;">'.$d->beratfgp4.' Gram</td>
					<td width="100px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="100px" align="Left" style="border:1px solid #000;"></td>
					<td style="border:1px solid #000;" ></td>
				  </tr>';
}


$tabel4.='</table>';
$barcode = '<img src="https://localhost/kalkulasibep/production/assets/images/'.$d->ttd.' width="50" height="50">" />';



$tabel5='  <table style="border:1px  solid #000;padding:6px;" width="310px"  height="100px" >';

foreach ($get_ttd as $d) 
{

$toolcopy = '<img src="assets/production/images/'.$d['ttd'].'"  width="100" height="100">';
$tabel5.='<tr  height="200px" width="150px" cellpadding="40" style="border:1px solid #000;">
			<th width="150px" cellpadding="40" height="120px" style="border:1px solid #000;">'.$toolcopy.'</th>
			<th width="150px" height="120px" style="border:1px solid #000;"></th>
		</tr>
		<tr  height="200px" width="150px" cellpadding="40" style="border:1px solid #000;">
                  <th width="150px" style="border:1px solid #000;"><center><b>    Marketing</b></th>
                  <th width="150px" style="border:1px solid #000;"><center><b>    Customer</b></center></th>
		</tr>
		';
}
$tabel5.='</table>';

$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', '', $text, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $table2, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $text2, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $tabel3, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $tabel4, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $tabel5, 0, 1, 0, true, 'C', true);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// set color for background
$pdf->SetFillColor(215, 235, 255);



// move pointer to last page
$pdf->lastPage();

// ---------------------------------------------------------
// ob_clean();
//Close and output PDF document
$pdf->Output('Sales Quotation.pdf', 'I');



//============================================================+
// END OF FILE
//============================================================+
exit();