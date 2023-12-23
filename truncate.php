<?php
session_start();
include('conn.php');
include('conn_sqli.php');
$sql=mysqli_query($db,"truncate table tbl_tv");

if($sql===TRUE){
	$_SESSION['berhasil'] = ' <div align="center" class="alert alert-danger" role="alert">
							<strong>Success </strong>To truncate table.
						   </div>';
						   header("location: home.php?pages=cnnindonesia");
	/* if(isset($_SESSION['berhasil'])){
			echo $_SESSION['berhasil'];
			unset ($_SESSION['berhasil']);
			
	} */
}
else{
	$_SESSION['gagal'] = ' <div align="center" class="alert alert-danger" role="alert">
							<strong>Warning...! </strong>Something wrong.
						   </div>';
	
	/* if(isset($_SESSION['gagal'])){
		echo $_SESSION['gagal'];
		unset ($_SESSION['gagal']);
	} */
}

?>