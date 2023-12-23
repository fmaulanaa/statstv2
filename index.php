<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?PHP
session_start();?>
<!DOCTYPE HTML>
<html>
<head>
<title>CNN Indonesia | Rating TV</title>
<!-- Custom Theme files -->
<link href="css/style2.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="IPTV Statistic" />
<!--Google Fonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--Google Fonts-->
<link rel="shortcut icon" href="images/logo.png">
</head>
<body>
<!--header start here-->
<h2>CNN Indonesia</h2>
		
			<div class="login-top">
					
				<form action="check.php" method="POST" name="the_form" >
				<h1>Login</h1>
				<!-- notif Error Login -->
			<?php 
				if(isset($_SESSION['error'])){
			?>
				<?php 
				echo "<h2>".$_SESSION['error']."</h2>"; unset($_SESSION['error']);
				}
				?>
					<input type="text"  name="username" placeholder="Username" />
					<input type="password" name="password" placeholder="Password"/>
				<div class="clear"> </div>
				<div class="log-bwn">
					</br>
					<input type="image" name="Submit" src="images/buttos.png" border="0" alt="Submit" width="125" height="48" value="Login" />

<!-- 					<script type="text/javascript">
     					document.write('<a href="" onclick="javascript:document.the_form.submit();return false;">Sign in</a>');
   					</script> -->
   					<noscript>
     					<input type="submit" value="Sign In" 
						style="border:none;background-color:transparent;color:blue;text-decoration:underline">
   					</noscript>
					<!--<a href="#">Sign in</a> -->
				</div>
				</form>
			</div>
			<footer>
			<div class="copyright">				
			   <p>&copy 2016 CNN Indonesia. All Rights Reserved |<a href="#" target="_blank">Research and Development.</a></p>
			</div>
			</footer>
<!--header start here-->
</body>
</html>