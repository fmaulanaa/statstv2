<?php
session_start();
include('conn_sqli.php');


if(isset($_POST['username']) && isset($_POST['password'])){
	 $username = $db->real_escape_string($_POST['username']);
	 $password = md5($db->real_escape_string($_POST['password']));
	 $sql = "select * from users where username = '$username' AND password = '$password'";
	 $result = $db->query($sql) or die('Terjadi Kesalahan : '.$db->error);
 
	if ($result->num_rows == 1){
		  $row = $result->fetch_assoc();
		  $_SESSION['username'] = $row['username'];
		  $_SESSION['password'] = $row['password'];
		  $_SESSION['pesan'] = '<p><div class="alert alert-success">Welcomee <b>'.$_SESSION['username'].'</b> </div></p>';
		  header("location:home.php?pages=dashboard");
	}else{
		$_SESSION['error']= "Wrong Username or Password";
		header("location:index.php");
		}
}
elseif(isset($_POST['username']) && !isset($_POST['password']))
{
	$_SESSION['error']="Password is empty";
	header("location:index.php");
}
else{
	//jika tidak menggunakan html5 ( 'required' pada form login )
	//pesan ini akan muncul
	//$_SESSION['error']="NIK or password can not be empty"; 
	//$_SESSION['success']="Telah berhasil update profil"; 
	
	header("location:index.php");
}

/* if(isset($_POST['submit'])){
		$errMsg = '';
		//username and password sent from Form
		$username = $_POST['nik'];
		$password = $_POST['password'];
		
		if($username == '')
			$errMsg .= 'You must enter your NIL<br>';
		
		if($password == '')
			$errMsg .= 'You must enter your Password<br>';
		
		
		if($errMsg == ''){
			$records = $connection->prepare('SELECT * FROM  users WHERE username = :username and password = :password');
			$records->bindParam(':username', $username);
			$records->bindParam(':password', md5($password));
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			if(count($results) ==1){
				$_SESSION['username'] = $results['username'];
				header('location:home.html');
				exit;
			}
			else{
				$errMsg .= 'Username and Password are not found<br>';
				echo $errMsg;
			}
		}
	} */
	
?>
