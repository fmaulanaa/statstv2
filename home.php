<?php
	session_start();
	include('conn.php');
	include('conn_sqli.php');

	if(isset($_SESSION['username'])){
		$base_url = 'http://'.$_SERVER['HTTP_HOST'].'/statstv/';
		if (!isset($_SESSION['username']))
			{
				header($base_url);
			}
			isset ($_GET['pages']) ? $pages = $_GET['pages'] : $pages = 'dashboard';
	}
	else
	{
		header("location:index.php");
	}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>STATISTIK IPTV</title>
<meta content="febry.zakharia@cnn.id" name="author" />
<meta content="almer.suryadi@cnn.id" name="author" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="IPTV Statistic " />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<!-- Graph CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<!-- lined-icons -->
<link rel="stylesheet" href="css/icon-font.min.css" type='text/css' />
<!-- //lined-icons -->
<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->
<!--animate-->
<link href="css/animate.css" rel="stylesheet" type="text/css" media="all">

<!--//end-animate-->
<!----webfonts--->
<link href='//fonts.googleapis.com/css?family=Cabin:400,400italic,500,500italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>
<!---//webfonts---> 
 <!-- Meters graphs -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Placed js at the end of the document so the pages load faster -->

<!--convert to pdf and others-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
<!-- <script type="text/javascript" src="/pdf/tableExport.js"></script> -->

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<!--//end convert to pdf and ohters -->
<link rel="shortcut icon" href="images/logo.png">
</head> 
   		<!-- main content start-->
		 <?php 	
			
			//cek apakah ada file yang dituju pada direktori app jika tidak ada tampilkan pesan error	
			if(file_exists('pages/'.$pages.'.php')){
				include ('pages/'.$pages.'.php'); 
			}else{
				echo '<div class="well">Error : Application could not find page: <b>'.$pages.'.php </b> in  directory <b>pages/</b> . Please contact IT Research & Development Team.</div>';
			}
		 ?>
		<!-- main content end -->
 <body class="sticky-header left-side-collapsed">
    <section>
    <!-- left side start-->
		<div class="left-side sticky-left-side">

			<!--logo and iconic logo start-->
			<div class="logo">
				<h1><a href="home.php">CNN <span>Indonesia</span></a></h1>
			</div>
			<div class="logo-icon text-center">
				<a href="home.php"><i class="lnr lnr-home"></i> </a>
			</div>

			<!--logo and iconic logo end-->
			<div class="left-side-inner">

				<!--sidebar nav start-->
					<ul class="nav nav-pills nav-stacked custom-nav">
						<li class=><a href="home.php?pages=dashboard"><i class="lnr lnr-paw"></i><span>Dashboard</span></a></li>
						<li class="menu-list"><a href="#"><i class="lnr lnr-menu"></i> 	<span>TV</span></a>
								<ul class="sub-menu-list">
									<li><a href="home.php?pages=tables">Summary Details</a> </li>
									<li><a href="home.php?pages=tables2">Viewers By Minute</a></li>
									<li><a href="home.php?pages=tables2_2">Viewers By Hour</a></li>
									<li><a href="home.php?pages=tables3">Live Channel Breakdown</a></li>
									<li><a href="home.php?pages=tables4">Live Channel Breakdown News Channel Only</a></li>
								</ul>
						</li>                     
						<li class=><a href="truncate.php"><i class="lnr lnr-trash"></i><span>Truncate Table</span></a></li>
						<li class=><a href="logout.php"><i class="lnr lnr-power-switch"></i><span>Logout</span></a></li>
					</ul>
				<!--sidebar nav end-->
			</div>
		</div>
		<!-- left side end-->
    
			<!-- header-starts -->
			<div class="header-section">
			
			<!--notification menu start -->
			<div class="menu-right">
				<div class="user-panel-top">  	
					<div class="profile_details_left">
						<ul class="nofitications-dropdown">
						<a href ="home.php?pages=cnnindonesia" class="btn btn-xs btn-danger">CNN INDONESIA</a>
						<!--<a href ="home.php?pages=tvone" class="btn btn-xs btn-blue">Tv One</a>
						<a href ="home.php?pages=metrotv"  class="btn btn-xs btn-orange">Metro TV</a>
						<a href ="home.php?pages=kompastv"  class="btn btn-xs btn-yellow">Kompas TV</a>
						<a href ="home.php?pages=beritasatu"  class="btn btn-xs btn-blue2">Berita Satu</a></br>-->
						<a href ="home.php?pages=duniaanak"  class="btn btn-xs btn-blue2">DUNIA ANAK</a>
						<a href ="home.php?pages=bioskopindonesia" class="btn btn-xs btn-blue">BIOSKOP INDONESIA</a>
						<a href ="home.php?pages=dunialain"  class="btn btn-xs btn-orange">DUNIA LAIN</a>
						<a href ="home.php?pages=insert"  class="btn btn-xs btn-blue">INSERT</a>
						<a href ="home.php?pages=eatandgo"  class="btn btn-xs btn-yellow">EAT AND GO</a>
						<a href ="home.php?pages=khazanah"  class="btn btn-xs btn-blue2">KHAZANAH</a>
						<a href ="home.php?pages=showcase"  class="btn btn-xs btn-yellow">SHOWCASE</a>
						<a href ="home.php?pages=tmusic"  class="btn btn-xs btn-blue">T MUSIC</a>
						<a href ="home.php?pages=tahantawa"  class="btn btn-xs btn-orange">TAHAN TAWA</a>
						<?php
						if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
						unset ($_SESSION['error']);
						}
						?>							  
						
							<div class="clearfix"></div>	
						</ul>
					</div>
					<div class="profile_details">		
						<ul>
							<li class="dropdown profile_details_drop">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
									<div class="profile_img">	
										<span style="background:url(images/logo.png) no-repeat center"> </span> 
										 <div class="user-name">
											<p><?php echo $_SESSION['username'];?><span>Administrator</span></p>
										 </div>
										 
										<div class="clearfix"></div>	
									</div>	
								</a>
								<ul class="dropdown-menu drp-mnu">
									<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
								</ul>
							</li>
							<div class="clearfix"> </div>
						</ul>
					</div>		

					<div class="clearfix"></div>
				</div>
				
			  </div>
			<!--notification menu end -->
			</div>
		<!-- //header-ends -->
		

		
        <!--footer section start-->
			<footer>
			   <p>&copy 2016 Transvision. All Rights Reserved | Design by <a href="#" target="_blank">Research and Development.</a></p>
			</footer>
        <!--footer section end-->
   </section>
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!-- Bootstrap Core JavaScript -->

</body>
</html>
