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
$pdf->SetAutoPageBreak(TRUE, 10);

//get the current page break margin:
$bMargin = $pdf->getBreakMargin();   

//get current auto-page-break mode:
$auto_page_break = $pdf->getAutoPageBreak();

//enable auto page break:
$pdf->SetAutoPageBreak($auto_page_break, $bMargin);

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
			<th width="80px" align="Left">Date</th>
			<th  width="150px" align="Left">: '.$tDate.'</th>
		  </tr>';

 foreach ($get_cust as $d) 
{
$table .= '<tr>
			<td ></td>
			<td width="200px"  align="Left"></td>
			<td width="80px" align="Left">Quotation No</td>
			<td width="150px" align="Left">: '.$d->no_quotation.'</td>
		  </tr>
		  ';
		}

		
$table .= '<tr>
					<td ></td>
					<td width="200px"  align="Left"></td>
					<td width="80px" align="Left">Created by</td>
					<td width="150px" align="Left">: '.$username.'</td>
				  </tr>
		';
			

$table .= '</table>';
$no = 1;
$text='<b>QUOTATION FOR</b>';

$table2='<table style="border:1px dotted #000; " width="800px">';


foreach ($get_cust as $d) 
{
$table2 .= '<tr >
			<th >'.$d->nama_cust.'</th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Top</th>';
			if($d->top=='Cash In Advance'){
				$table2 .='<th  width="150px" >: Cash In Advance</th>';
			}else{
				$table2 .='<th  width="150px" >: '.$d->top.' Days</th>';
			}
			$table2 .='</tr>';
$table2 .=		  '<tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">FOB Point</th>
			<th  width="150px" >: '.$d->fob.'</th>
		  </tr>
		  <tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left">Lead Time</th>
			<th  width="150px" >: '.$d->lead_time.'</th>
		  </tr>
		  <tr >
			<th ></th>
			<th width="200px" align="Left"></th>
			<th width="90px" align="Left"></th>
			<th  width="150px" ></th>
		  </tr>';
}
$table2 .= '</table>';
$text2='<b>Comments or Special Instructions : </b>';
$text3='Dengan Hormat,';
$text4='Bersama surat ini kami bermaksud mengajukan penawaran harga barang sebagai berikut :';

$tabel3='<table style="; " width="640px"  height="75px" cellpadding="30">';
$tabel3 .= '<tr  height="75px">
			<th ></th>
		
		  </tr>';
$tabel3.='</table><br>';

$tabel4='<table style="border:1px  solid #000;padding:6px;" width="310px"  height="100px" >';
$tabel4.= '<thead>
			<tr   style="background-color:#6495ED;" >
			<th width="30px" style="border:1px solid #000;">No</th>
			<th width="150px" style="border:1px solid #000;">Product Name</th>
			<th width="100px" style="border:1px solid #000;">Parts</th>
			<th width="80px" style="border:1px solid #000;">weight (Gr)</th>
			<th width="80px" style="border:1px solid #000;">Material</th>
			<th width="85px" style="border:1px solid #000;">Price/pc</th>
			<th width="120px" style="border:1px solid #000;">QTY</th>
			
		  </tr> </thead> 
		  <tbody >';
		  $no = 1;
		  
		  foreach ($sales_quotation as $d) 
	{
		$totalbrt=$d->beratfgp1+$d->beratfgp2+$d->beratfgp3+$d->beratfgp4;
	$tabel4.='
				  <tr  >
					<td width="30px" style="border:1px solid #000;">'.$no++.'</td>
					<td  width="150px" style="border:1px solid #000;">'.$d->namabrg.'</td>
					<td  width="100px" style="border:1px solid #000;"></td>
					<td width="80px" style="border:1px solid #000;">'.$totalbrt.' gr</td>
					<td   width="80px"  align="Left" style="border:1px solid #000;"></td>
					<td  width="85px" align="Left" style="border:1px solid #000;">Rp. '.rupiah($d->dua).',-</td>
					<td width="120px" style="border:1px solid #000;" >'.$d->keterangan.'</td>
				  </tr >';
				if($d->beratfgp1>0){
				  $tabel4.='<tr  >
					<td width="30px" style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">1. '.$d->namap1.'</td>
					<td width="80px" style="border:1px solid #000;">'.$d->beratfgp1.' gr</td>
					<td width="80px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="85px" align="Left" style="border:1px solid #000;"></td>
					<td width="120px" style="border:1px solid #000;" ></td>
				  </tr  >';
				
		 		if($d->beratfgp2 >0)
				  {
				  $tabel4.='<tr>
					<td width="30px" style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td width="100px" style="border:1px solid #000;">2. '.$d->namap2.'</td>
					<td width="80px" style="border:1px solid #000;">'.$d->beratfgp2.' gr</td>
					<td width="80px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td width="85px" align="Left" style="border:1px solid #000;"></td>
					<td width="120px" style="border:1px solid #000;" ></td>
				  </tr>';
				  
				  if($d->beratfgp3 >0 ){
				  $tabel4.='<tr>
					<td width="30px" style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td  width="100px" style="border:1px solid #000;">3. '.$d->namap3.'</td>
					<td   width="80px" style="border:1px solid #000;">'.$d->beratfgp3.' gr</td>
					<td  width="80px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td  width="85px" align="Left" style="border:1px solid #000;"></td>
					<td  width="120px" style="border:1px solid #000;" ></td>
				  </tr >';
				  if($d->beratfgp4 >0 ){
				  $tabel4.='<tr >
					<td width="30px" style="border:1px solid #000;"></td>
					<td width="150px" style="border:1px solid #000;"></td>
					<td  width="100px" style="border:1px solid #000;">4. '.$d->namap4.'</td>
					<td  width="80px" style="border:1px solid #000;">'.$d->beratfgp4.' gr</td>
					<td  width="80px"  align="Left" style="border:1px solid #000;">'.$d->jenis.'</td>
					<td  width="85px" align="Left" style="border:1px solid #000;"></td>
					<td  width="120px"style="border:1px solid #000;" ></td>
				  </tr   >  
				  </tbody>' ; } 
				 
			}}}
				  
	}
$tabel4.='</table>';


$tabel5='<br> <br> <table nobr="true" style="border:1px  solid #000;padding:6px;" width="310px"  height="100px" >';

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

$tabel6='<table nobr="true" style="border:1px  solid #000;padding:6px;" width="310px"  height="100px" >
			<tr   style="background-color:#6495ED;" >
			<th width="30" style="border:1px solid #000;">No</th>
			<th width="150" style="border:1px solid #000;">Product Name</th>
			<th width="150"style="border:1px solid #000;">Gambar Produk</th>
		  	</tr>';
$tabel6.='</table>';


$html ='<ul type="circle">';
foreach($get_cust as $d){
	if($d->comment!=null||$d->comment!=''){
	$html.='<li type="circle">'.$d->comment.'</li>';
	}
	 if($d->comment2!=null||$d->comment2!=''){
		$html.='<li type="circle">'.$d->comment2.'</li>';
	}if($d->comment3!=null||$d->comment3!=''){
		$html.='<li type="circle">'.$d->comment3.'</li>';
	}if($d->comment4!=null||$d->comment4!='')
	{
    $html.='<li type="circle">'.$d->comment4.'</li><ul>';
	}
}
$pdf->writeHTMLCell(0, 0, '', '', $title, 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', '', $table, 0, 1, 0, true, 'C', true);
$pdf->writeHTMLCell(0, 0, '', '', $text, 0, 1, 0, true,  'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $table2, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $text3, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $text4, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $tabel4, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $text2, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, 'L', true);
$pdf->writeHTMLCell(0, 0, '', '', $tabel5, 0, 1, 0, true, 'C', true);

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -


$pdf->setPage( 1 );

$pdf->lastPage();

$pdf->AddPage('P', 'A4');
$pdf->writeHTMLCell(0, 0, '', '', $tabel6, 0, 1, 0, true, 'L', true);
// $pdf->writeHTML($tbl, true, false, false, false, '');

// Get the page width/height
$myPageWidth = $pdf->getPageWidth();
$myPageHeight = $pdf->getPageHeight();

// Find the middle of the page and adjust.
$myX = ( $myPageWidth / 2 ) - 75;
$myY = ( $myPageHeight / 2 ) + 25;

// Set the transparency of the text to really light
$pdf->SetAlpha(0.09);

// Rotate 45 degrees and write the watermarking text
$pdf->StartTransform();
$pdf->Rotate(45, $myX, $myY);
$pdf->SetFont("Helvetica", "", 40);
$pdf->Text($myX, $myY,"      ");
$pdf->StopTransform();

// Reset the transparency to default
$pdf->SetAlpha(1);
// set color for background
$pdf->SetFillColor(215, 235, 255);



// move pointer to last page

// ---------------------------------------------------------
// ob_clean();
//Close and output PDF document
$pdf->Output('Sales Quotation.pdf', 'I');



//============================================================+
// END OF FILE
//============================================================+
exit();