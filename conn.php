<?php

ini_set('max_execution_time', 123456789);
//$connection = new PDO('mysql:host=localhost;dbname=useetv_stat_feb2016;charset=utf8', 'root', 'root');

try{
		$connection = new PDO('mysql:host=localhost;dbname=useetv_stat_okt2016;charset=utf8', 'root', '');
		$connection -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $e){
		die ("error");
	}
	
	
	
?>