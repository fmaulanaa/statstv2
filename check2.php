<?php
session_start();
include('conn.php');

/* if(isset($_POST['form-nik']) && ($_POST['form-password'])){
	 $nik = $connection->quote($_POST['form-nik']);
	 $password = md5($connection->quote($_POST['form-password']));
	 $sql = "select * from user where nik = '$nik' AND password = '$password'";
	 $sql = $connection->prepare("SELECT * FROM users where username = '$nik' and password = '$password'" );
	 $sql -> execute();
	 //$result = $sql -> fetch(PDO::FETCH_ASSOC);
	// $result = $db->query($sql) or die('Terjadi Kesalahan : '.$db->error);
 
	if ($sql->rowCount() ==1){
		  $result = $sql -> fetch(PDO::FETCH_ASSOC);
		  $_SESSION['nik'] = $result['nik'];
		  $_SESSION['password'] = $result['password'];
		 // $_SESSION['pesan'] = '<p><div class="alert alert-success">Welcome <b>'.$_SESSION['nik'].'</b></div></p>';
		  header("location:../login_multiuser/index_2.php");
		  return true;
	}else{
		echo "gagal";
		$_SESSION['error']="Wrong NIK or Password";
		//header("location:index.php?=login");
	}
}else{
	//jika tidak menggunakan html5 ( 'required' pada form login )
	//pesan ini akan muncul
	$_SESSION['error']="NIK or password can not be empty"; 
	//$_SESSION['success']="Telah berhasil update profil"; 
	header("location:index.php?login=login");
} */

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
	
if(isset($_POST['submit'])){
    
    //Retrieve the field values from our login form.
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;
    $passwordAttempt = !empty($_POST['password']) ? trim($_POST['password']) : null;
    
    //Retrieve the user account information for the given username.
    $sql = "SELECT username, password FROM users WHERE username = :username";
    $stmt = $connection->prepare($sql);
    
    //Bind value.
    $stmt->bindValue(':username', $username);
    
    //Execute.
    $stmt->execute();
    
    //Fetch row.
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
    if($user === false){
        //Could not find a user with that username!
        //PS: You might want to handle this error in a more user-friendly manner!
        die('Incorrect username / password combination!');
    } else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        
        //Compare the passwords.
        $validPassword = password_verify($passwordAttempt, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
            
            //Provide the user with a login session.
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = time();
            
            //Redirect to our protected page, which we called home.php
            header('Location: home.html');
            exit;
            
        } else{
            //$validPassword was FALSE. Passwords do not match.
            die('Incorrect username / password combination!');
        }
    }
    
}
	
?>
