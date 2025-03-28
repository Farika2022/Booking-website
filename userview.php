<?php
	session_start();
	
	include("connection.php");
	include("functions.php");
	$user_data=check_login($con);
	if(!isset($_SESSION["user_id"])){
		header("Location: login.html");
	exit(); }
?>

<!DOCTYPE html>
<html>
	<head>
		<title> User Status </title>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		
		
		<style> 
			
			
			
			body{
			margin: 0;
			background-image: url(/img/book.jpg);
			
			background-position: center;
			
			background-size: auto;
			}
			h1{
			text-align:center;
			color:white;
			font-size:35px;
			background-color:red;
			}
			.wrapper
			{
			width:100px;
			margin:0 auto;
			}
			table{
			border:1px solid white;
			width:100%;
			color:white;
			font-family:monospace;
			font-size:18px;
			text-align:center;
			}
			th,tr{
			color:white;
			border:1px solid white;
			text-align:center;
			}
			tr:nth-child(even).border:1px solid white;
		</style>  
		<center>
			<div class="table-scrol">  
				<div style ="color:black">
					<h1 align="center"> Users Status</h1>  
					<?php
						
						include("connection.php"); 
						$sql="SELECT * FROM booking WHERE user_id = '" . $_SESSION['user_id'] . "'";
						$result= $con->query($sql);
						$row = $result-> fetch_assoc();
						$user_id=$row['user_id'];  
						$Uname=$row['Uname'];
						$phone=$row['phone'];
						$vehicleNo=$row['vehicleNo'];
						
					?>
					<div style ="color:white">
						<center>
						<h2><?php echo $Uname; ?> 's Profile</h2><br></center></div>
						<table id="example1" class="table table-bordered table-striped">
							<thead>
								<tr>
									<b>
										<center>
											<th>User Id </th>
											<th>User Name</th>
											<th>Phone No</th>
											<th>Vehicle No</th>
										</b>
									</center>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									
									<?php
										
										$sql="SELECT * FROM register WHERE user_id = '" . $_SESSION['user_id'] . "'";
										$result= $con->query($sql);
										if($result-> num_rows> 0) {
											while ($row = $result-> fetch_assoc()){ 
												echo"<b><tr><td>" .  $row["user_id"]."</td><td>". $row["Uname"]."</td><td>". $row["phone"]."</td><td>".$row["vehicleNo"]."</td></b>";
											}
											echo"</table>";
										}
									?>
								</tbody>
							</div>
						</div>
						
							<?php
								
								include("connection.php"); 
								$sql="SELECT * FROM booking WHERE user_id = '" . $_SESSION['user_id'] . "'";
								$result= $con->query($sql);
								$row = $result-> fetch_assoc();
								$vehicle=$row['vehicle'];  
								$type=$row['type'];
								$date=$row['date'];
								$timeslot=$row['timeslot'];
								$booking_time=$row['booking_time'];
								
							?>
							<form method='POST' action='userview.php'>
							<div style ="color:white">
								<table border="1">
									<tr>
										
										<th>Vehicle</th>
										<th>Type of Wash</th>
										<th>Date</th>
										<th>Time</th>
										<th>Booking At</th>
										
									</tr>
									
									<?php
										
										$sql="SELECT * FROM booking WHERE user_id = '" . $_SESSION['user_id'] . "'";
										$result= $con->query($sql);
										if($result-> num_rows> 0) {
											while ($row = $result-> fetch_assoc()){
											?>
											<tr>
												
												<td><?php echo $row["vehicle"]?></td>
												<td><?php echo $row["type"]?></td>
												<td><?php echo $row["date"]?></td>
												<td><?php echo $row["timeslot"]?></td>
												<td><?php echo $row["booking_time"]?></td>
												
											</tr>
											<?php
											}
											echo" </table>";
										}
									?>
								</table>
							</div>
						</div>
				</center>
			</form>
			<br>
			<br>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<td>
				<a href="logout.php?id=<?php echo $user_id; ?>" class="btn btn-warning" role="button">Logout</a>
			</td>
			<script type="text/javascript">
			function confirm()
			
		</body>
	</html>
