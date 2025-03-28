<?php

session_start();

include("connection.php");
include("functions.php");

if($_SERVER['REQUEST_METHOD']=="POST")
{
	//somthing was posted
	$Uname = $_POST['Uname'];
	$Upass = $_POST['Upass'];
	$Upass2 = $_POST['Upass2'];
	$vehicleNo = $_POST['vehicleNo'];
	$phone = $_POST['phone'];
	$vehicle = $_POST['vehicle'];
	
	if(!empty($Uname) && !empty($Upass) && !empty($Upass2) && !empty($vehicleNo)&& !empty($phone)&& !empty($vehicle) )
	{
		//save to database
		$user_id=random_num(20);
		$query="insert into register(user_id,Uname,Upass,Upass2,vehicleNo,phone,vehicle) values ('$user_id','$Uname','$Upass','$Upass2','$vehicleNo','$phone','$vehicle' )";
		mysqli_query($con,$query);
		
		header("Location:login.html");
		//die;
	}
	else
	{
		echo"Please enter some valid information !";
	}
	
}
?>