<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('rupiah')){
function rupiah($angka =''){
 $rupiah=number_format($angka,0,',','.');
 return $rupiah;
}
if ( ! function_exists('selisih_tgl'))
{
	function selisih_tgl($tglAwal,$tglAkhir)
	{
	// memecah string tanggal awal untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah1 = explode("-", $tglAwal);
    $date1 = $pecah1[2];
    $month1 = $pecah1[1];
    $year1 = $pecah1[0];

    // memecah string tanggal akhir untuk mendapatkan
    // tanggal, bulan, tahun
    $pecah2 = explode("-", $tglAkhir);
    $date2 = $pecah2[2];
    $month2 = $pecah2[1];
    $year2 =  $pecah2[0];

    // mencari total selisih hari dari tanggal awal dan akhir
    $jd1 = GregorianToJD($month1, $date1, $year1);
    $jd2 = GregorianToJD($month2, $date2, $year2);

    $selisih = $jd2 - $jd1;
    return $selisih;
	}
}
}