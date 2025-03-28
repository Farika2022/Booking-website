<?php
	include("includes/header.php");
	include("includes/topbar.php");
	include("includes/sidebar.php");
	include("connection.php");
?>



<!DOCTYPE html>
<html>
  
  <title>ChartJS</title>
  <!-- <meta charset="utf-8"> -->
  <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge"> -->
<head>
  <!-- <title>AdminLTE 3 | Flot Charts</title> -->
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

  <script src="https://code.jquery.com/jquery-3.4.0.js"></script>
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.0.min.js"></script>
		<style type ="text/css">
		#chart-container{
		width:640px;
		height:auto;
		}
		</style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
     

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ChartJS</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Chart & Data Table</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->



		   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- WEEKLY REPORT-->
            <div class="card card-primary">
   
					 <h3 class="card-title"><b>WEEKLY REPORT</b>
				</h3>
				<br>
				
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					  
				  
                    <th>Number of Bookings</th>
					<th>Weeks</th>
                    
					
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                   <?php
				   $date= date('Y-m-d');
				   $mysqli = new mysqli('localhost', 'root', '', 'mfa website');
					//$stmt = $mysqli->prepare("select count(*) as booking_no ,date as date from booking where date= now() ");
					//$stmt->bind_param('s', $date);
					 $sql="select count(*)as booking_no, EXTRACT(Week FROM date) as Weekly from booking group by Weekly";
				   $result= $con->query($sql);
					
						if($result-> num_rows> 0) {
				   			while ($row = $result-> fetch_assoc()){
							echo"<tr></td><td>"
							. $row["booking_no"]."</td><td>"
							. $row["Weekly"]."</td></tr>";
							}
				   echo"</table>";
				 
					}
				 ?>
                   </tr>		  
			   </tbody>
		   </table>
	   </div> 
	   </div> 
	   </div> 
	   </section>
	   
	  <div class="col-md-6">
	     <div class="card card-info">
					 <h3 class="card-title"><b>MONTHLY REPORT</b>
				</h3>
				<br>
				
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
					  
				  
                    <th>Number of Bookings</th>
					<th>Month</th>
                    
					
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                   <?php
				   $date= date('Y-m-d');
				   $mysqli = new mysqli('localhost', 'root', '', 'mfa website');
					//$stmt = $mysqli->prepare("select count(*) as booking_no ,date as date from booking where date= now() ");
					//$stmt->bind_param('s', $date);
					 $sql="select count(*)as booking_no, EXTRACT(Month FROM date) as Month from booking group by Month";
				   $result= $con->query($sql);
					
						if($result-> num_rows> 0) {
				   			while ($row = $result-> fetch_assoc()){
							echo"<tr></td><td>"
							. $row["booking_no"]."</td><td>"
							. $row["Month"]."</td></tr>";
							}
				   echo"</table>";
				 
					}
				 ?>
                   </tr>		  
			   </tbody>
		   </table>
	   </div>     
	   </div>     
            <!-- Bar chart -->
			 <div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="far fa-chart-bar"></i>
                  <b>Yearly Chart</b>
                </h3>
				<div id="chart-container">
				<canvas id="mycanvas"></canvas>
				</div>
              </div>
              <div class="card-body">
				  <div id="bar-chart" style="height: 300px;"></div>
              </div>
              <!-- /.card-body-->
            </div>
            <!-- /.card -->
            <!-- /.card -->
			</div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
	
	</div>
<!-- ./wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="assets/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI -->
<script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 4 -->
<script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets/dist/js/demo.js"></script>
<!-- FLOT CHARTS -->
<script src="assets/plugins/flot/jquery.flot.js"></script>
<!-- FLOT RESIZE PLUGIN - allows the chart to redraw when the window is resized -->
<script src="assets/plugins/flot-old/jquery.flot.resize.min.js"></script>
<!-- FLOT PIE PLUGIN - also used to draw donut charts -->
<script src="assets/plugins/flot-old/jquery.flot.pie.min.js"></script>
<!-- Page script -->
<script type="type/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript" src="script.js"></script>
			
			
</body>
</html>
