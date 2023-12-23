<?php
session_start();
include('conn.php');
?>
<!DOCTYPE HTML>
<html>
<title>CNN Indonesia | Summary detail</title>
 <body class="sticky-header left-side-collapsed"  onload="initMap()">
    <section>
 
    <!-- main content start-->
		<div class="main-content main-content4">
			<!-- header-starts -->
			
			<div id="page-wrapper">
				<div class="graphs">
				
				<!-- notif Fail -->		
					<?php
						if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
						unset ($_SESSION['error']);
					}?>
					<div class="panel-body panel-body-inputin">
						<h3 class="blank1">Summary Details</h3>
							<form role="form" method="POST" action="#" class="form-horizontal">
							<div class="form-group">
									<label class="col-md-2 control-label">Start Date</label>
										<div class="col-md-8">
											<div class="input-group in-grp1">							
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control1" placeholder="Begin Date" id="date_timepicker_start" name="date_timepicker_start">
											</div>
										</div>
									<div class="clearfix"> </div>
								</div>
								<div class="form-group">
									<label class="col-md-2 control-label">End Date</label>
										<div class="col-md-8">
											<div class="input-group in-grp1">							
												<span class="input-group-addon">
													<i class="fa fa-calendar"></i>
												</span>
												<input type="text" class="form-control1" placeholder="End Date" id="date_timepicker_end" name="date_timepicker_end">
											</div>
										</div>
									<div class="clearfix"> </div>
								</div>
								
								<div class="col-sm-8 col-sm-offset-2 " align="center">
									<div class="input-group in-grp1">
										<button class="btn-success btn" name="submit_form" value="Generate">Generate</button>
									</div>
								</div>
						</div>
				</div>
					<div class="bs-example4" data-example-id="simple-responsive-table">
					
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
							<span class="glyphicon glyphicon-th-list"></span> Dropdown
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
								<li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false'});"> <img src="images/json.jpg" width="24px"> JSON</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src="images/json.jpg" width="24px">JSON (ignoreColumn)</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'json',escape:'true'});"> <img src="images/json.jpg" width="24px"> JSON (with Escape)</a></li>
								<li class="divider"></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'xml',escape:'false'});"> <img src="images/xml.png" width="24px"> XML</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'sql'});"> <img src="images/sql.png" width="24px"> SQL</a></li>
								<li class="divider"></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'csv',escape:'false'});"> <img src="images/csv.png" width="24px"> CSV</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'txt',escape:'false'});"> <img src="images/txt.png" width="24px"> TXT</a></li>
								<li class="divider"></li>				
								
								<li><a href="#" onclick="$('#employees').tableExport({type:'excel',escape:'false'});"> <img src="images/xls.png" width="24px"> XLS</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'doc',escape:'false'});"> <img src="images/word.png" width="24px"> Word</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'powerpoint',escape:'false'});"> <img src="images/ppt.png" width="24px"> PowerPoint</a></li>
								<li class="divider"></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'png',escape:'false'});"> <img src="images/png.png" width="24px"> PNG</a></li>
								<li><a href="#" onclick="$('#employees').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> <img src="images/pdf.png" width="24px"> PDF</a></li>
							</ul>
						
					
						<div class="table-responsive">
						<table class="table" id="employees">
						  <thead>
							<tr class="danger">
							  <th>Content Type</th>
							  <th>Unique Viewers</th>
							  <th>Total View</th>
							  <th>Total Duration (Hrs)</th>
							  <th>Avg (Duration(Hrs)/View)</th>
							  <th>Avg (Duration(Hrs)/Unique Viewers/Day)</th>
							</tr>
						  </thead>
						  <tbody>
						  
						<?php
						if(isset($_POST['submit_form']) == "Generate"){
							$date_start = $_POST['date_timepicker_start'];
							$date_end = $_POST['date_timepicker_end'];$begin_date = date("Y-m-d", time());
							$end_date = date("Y-m-d", time());
							$end_date = strtotime($date_end) + (24 * 60 * 60);
							$days = (int) (($end_date - (strtotime($date_start))) / 60 / 60 / 24);
						?>
						
							<div class="but_list">
							<h4>
							 <span class="label label-success">Date Start  :<?php echo $date_start?></span></br></br>
							 <span class="label label-success">Date End  : <?php echo $date_end?></span></br></br>
							 <span class="label label-success">Number of Days  : <?php echo $days?></span>
							</h4>
							</div>
							<?php
								$nRows = $connection->prepare("SELECT COUNT(login_name) AS total_views, COUNT(DISTINCT(login_name)) AS unique_viewers,
															SUM(duration) AS total_secs, content_type
															FROM tbl_tv
															WHERE LENGTH(login_name) = 12
															AND Date(begin_time) between '$date_start' and '$date_end' 
															GROUP BY content_type
															ORDER BY total_secs DESC");
								$nRows -> execute();
								$result = $nRows -> fetch(PDO::FETCH_ASSOC);	
								if($result['total_secs']==false && $result['unique_viewers']==false){
									$avg1 = 0;
									$avg2 = 0;
									echo'<tr class="info">
										<td>'.number_format((float)$result['content_type']). '</td>
										<td>'.number_format((float)$result['unique_viewers']).'</td>
										<td>'.number_format((float)$result['total_views']).'</td>
										<td>'.number_format((float)$result['total_secs']).'</td>
										<td>'.number_format((float)$avg1, 2, '.', '').'</td>
										<td>'.number_format((float)$avg2, 2, '.', '').'</td>
										</tr>' ;
								}
								elseif($result['total_secs']==true){
									$hour = 60;
									$minute = 60;
									$total_minute = $result['total_secs']/$minute;
									$total_hour = $total_minute/$hour;
									$avg1 = $total_hour / $result['total_views'];
									$avg2 = $total_hour / $result['unique_viewers'] / $days;
									echo'<tr class="info">
										<td>'.$result['content_type']. '</td>
										<td>'.$result['unique_viewers'].'</td>
										<td>'.$result['total_views'].'</td>
										<td>'.number_format((float)$total_hour, 2, '.', '').'</td>
										<td>'.number_format((float)$avg1, 2, '.', '').'</td>
										<td>'.number_format((float)$avg2, 2, '.', '').'</td>
										</tr>' ;
										
								}
								$_SESSION['error'] = 
								'<div class="alert alert-success" role="alert" align ="center">
								<strong>Well done!</strong> You successfully 
								data.
								</div>';
						}
						?>
						</tbody>
						</table>
						 <input type="text" hidden disabled value= "<?php echo $date_start;?>" name="test"></input>
					   </div>
					</div>
				</div>	   
			</div>
		</div>
		<!-- notif Fail -->		
					<?php
						if(isset($_SESSION['error'])){
						echo $_SESSION['error'];
						unset ($_SESSION['error']);
					}?>
		
	</section>
	
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.min.js"></script>
</body>
</html>
<script type="text/javascript">
//$('#employees').tableExport();
$(function(){
	$('#example').DataTable();
      }); 
</script>