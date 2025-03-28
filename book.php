<?php
	session_start();
	include("connection.php");
	include("functions.php");
	
	$user_data=check_login($con);
	//check authentication of logged in user
	if(!isset($_SESSION["user_id"])){
		header("Location: login.html");
	exit(); }
	$message = "wrong username or password!";
	
	//Retrieve current Bonus Points
	$view_users="SELECT * FROM register WHERE user_id = '" . $_SESSION['user_id'] . "'"; 
									$runs=mysqli_query($con,$view_users);//check if there is a booking already done by the user
									$row=mysqli_fetch_array($runs); 
									 	$points=$row['points'];//get the current value in points column for that user in booking table
	//$points = $_GET['points']??'';
	$mysqli = new mysqli('localhost', 'root', '', 'mfa website');
				$stmt = $mysqli->prepare("select points from register where user_id=?");
				$stmt->bind_param('i',$user_id);
				$stmt->execute();
				$result = $stmt->get_result();
				if($result->num_rows>0){
					$row = $result->fetch_assoc();
					$point=$row[0];
				}
	if(isset($_GET['date'])){
		$date = $_GET['date'];
		$mysqli = new mysqli('localhost', 'root', '', 'mfa website');
		$stmt = $mysqli->prepare("select * from booking where date = ? ");
		$stmt->bind_param('s', $date);
		$booking = array();
		if($stmt->execute()){
			$result = $stmt->get_result();
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					$booking[]=$row['timeslot'];
				}
			}
		}
	}
	
	if(isset($_POST['submit'])){
		$vehicle=$_POST['vehicle'];
		$type=$_POST['type'];
		$timeslot=$_POST['timeslot'];	
		$stmt = $mysqli->prepare("select * from booking where date = ? AND timeslot = ? ");
		$stmt->bind_param('si', $date,$timeslot);
		if($stmt->execute()){
			$result = $stmt->get_result();
			if($result->num_rows>0){
				$msg = "<div class='alert alert-danger'>Already Booked</div>";
			}else{
			$points+=100;// add 100 and then update the value in points column
				$is_free_wash=0;
				if($points>=1000)//if current points value is >= 1000, display msg "Get free wash"
				{
					$is_free_wash=1;
					$msg1="<div class='alert alert-danger'>Your next Wash is Free </div>";
					$point=0;
				}
				$bonus="UPDATE register SET points='$points',is_free_wash='$is_free_wash' WHERE user_id='$_SESSION[user_id]'";
				$res=$con->prepare($bonus);
				$res->execute();
			
			$stmt = $mysqli->prepare ("insert into booking (user_id,Uname,phone,vehicleNo,vehicle,type,date,timeslot) values('$_SESSION[user_id]','$user_data[Uname]','$user_data[phone]','$user_data[vehicleNo]','$vehicle','$type','$date','$timeslot' )");
			
			//$stmt->bind_param('ississsss',$user_id,$fname,$lname,$phone,$location,$vehicle,$type,$date,$timeslot);
			try{
				$stmt->execute();
				} catch (Exception $e){
				echo 'caught exception: ', $e->getMessage(), "\n";
			}
			
			$msg = "<div class='alert alert-success'>Booking Successfull</div>";
			$booking[]=$timeslot;
			
			$stmt->close();
			$mysqli->close();
		}
	}
}	
	
	$duration = 30;
	$cleanup = 0;
	$start = "09:00";
	$end = "18:00";
	function timeslots($duration, $cleanup, $start, $end){
		$start = new DateTime($start);
		$end = new DateTime($end);
		$interval = new DateInterval("PT".$duration."M");
		$cleanupInterval = new DateInterval("PT".$cleanup."M");
		$slots = array();
		
		for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
			$endPeriod = clone $intStart;
			$endPeriod->add($interval);
			if($endPeriod>$end){
				break;
			}
			
			$slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
			
		}
		
		return $slots;
	}
	
?>

<!doctype html>
<html lang="en">
	
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title></title>
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<link rel="stylesheet" href="style2.css">
	</head>
	
	<body>
		<div class="container">
			<font face="Blackadder ITC"size="6"color="black"><b> Hi, <?php echo $user_data['Uname'];?></b></font>
			<br>
			<br>
			
		<a href=""align="float:right" class="btn btn-success" role="button" ></i><th>points: <?php echo $points; ?></th></a>
		<br>
		<br>
		<h1 class="text-center">Book for Date: <?php echo date('m/d/Y', strtotime($date)); ?></h1><hr>
		<div class="row">
			<div class="col-md-12">
				<?php echo(isset($msg))?$msg:"";  ?>
			</div>
			<?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
				foreach($timeslots as $ts){
				?>
				<div class="col-md-2">
					<div class="form-group">
						<?php if(in_array($ts, $booking)){ ?>
							<button class="btn btn-danger"><?php echo $ts; ?></button>
						    <?php }else{ ?>
							<button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
						<?php }  ?>
					</div>
				</div>
				
			<?php } ?>  
			<center>
				<a href="logout.php?id=<?php echo $user_data['user_id']; ?>" class="btn btn-warning" role="button">Logout</a>
				
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
				<a href="bwash.php?id=<?php echo $user_data['user_id']; ?>" class="btn btn-primary" role="button">Back</a>
			</center>				
		</div>
	</div>
	<div id="myModal" class="modal fade" role="dialog">
		<div class="modal-dialog">
			
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">Booking for: <span id="slot"></span></h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<form action="" method="post">
								<div class="form-group">
									<label for="">Time Slot</label>
									<input readonly type="text" class="form-control" id="timeslot" name="timeslot">
								</div>
								
								<?php include("connection.php"); 
									$view_users_query="SELECT * FROM register WHERE user_id = '" . $_SESSION['user_id'] . "'";//select query for viewing users.  
									$run=mysqli_query($con,$view_users_query);//here run the sql query.  
									
									while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
									{  
										
										$Uname=$row['Uname'];
										
										$phone=$row['phone'];
										
										$vehicleNo=$row['vehicleNo'];
										
										
										
										echo"<tr>";
										echo"<td>";
										echo "<b> User Name	: </b>";
										echo"</td>";
										echo"<td>";
										echo $row['Uname'];
										echo"</td>";
										echo"</tr>";
										echo"<br>";
										echo"<br>";
										echo"<tr>";
										echo"<td>";
										echo "<b> Phone No	: </b>";
										echo"</td>";
										echo"<td>";
										echo $row['phone'];
										echo"</td>";
										echo"</tr>";
										echo"<br>";
										echo"<br>";
										
										echo"<tr>";
										echo"<td>";
										echo "<b> Vehicle No	: </b>";
										echo"</td>";
										echo"<td>";
										echo $row['vehicleNo'];
										echo"</td>";
										echo"</tr>";
										
										
										
									}
									
								?>
								<br>
								<br>
								<br>
								
								<div class="form-group">
									<label for="">Vehicle</label>
									
									<select id="input-group" style="background-color: none;"name="vehicle"required="">
										
										<option value="Select Vehicle">Select Vehicle</option>
										<option value="4 Seater Car">4 Seater Car</option>
										<option value="7 Seater Car">7 Seater Car</option>
										<option value="Omni">Omni</option>
										<option value="Bike">Bike</option>
										<option value="Jeep">Jeep</option>
										<option value="Bus">Bus</option>
										<option value="MINI Bus">MINI Bus</option>
										<option value="Lorry">Lorry</option>
										
									</select>
								</div>
								<div class="form-group">
									<label for="">Wash Type</label>
									<select id="input-group" style="background-color:none;"name="type"required="">
										<option value="Wash Type">Wash Type</option>
										<option value="Full Wash">Full Wash</option>
										<option value="Body Wash">Body Wash</option>
										
									</select>
								</div>
								
								<div class="form-group">
									
									<button name="submit" type="submit" class="btn btn-primary">Submit</button>
									
								</div>
							</form>
						</div>
					</div>
				</div>
				
			</div>
			
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script>
		$(".book").click(function(){
			var timeslot = $(this).attr('data-timeslot');
			$("#slot").html(timeslot);
			$("#timeslot").val(timeslot);
			$("#myModal").modal("show");
		});
	</script>
	

</body>

</html>
