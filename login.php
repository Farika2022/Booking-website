<?php 

session_start();

	include("connection.php");
	include("functions.php");
	$message = "wrong username or password!";



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Uname = $_POST['Uname'];
		$Upass  = $_POST['Upass'];
		
		if (!empty($Uname) && !empty($Upass ) && !is_numeric($Uname))

		{
		

			//read from database
			

			$query = "select * from register where Uname = '$Uname' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Upass'] == $Upass)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
					
						header("Location:bwash.php");
						die;
					}
				}
			}
			
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='login.html';
			</script>";		
		}else
		{
			
		echo "<script type='text/javascript'>alert('$message');
			window.location.href='login.html';
			</script>";
		}
	}

?>


