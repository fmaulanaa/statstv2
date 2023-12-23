<?php
// koneksi database -------------------------------------------->
$db = new mysqli ( "localhost" , "root" , "" , "useetv_stat_okt2016" );
echo $db->connect_errno?'Koneksi gagal : '.$db->connect_error:'';
//<--------------------------------------------------------------
?>