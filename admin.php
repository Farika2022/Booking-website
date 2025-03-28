<?php 

session_start();

	include("connection.php");
	include("functions.php");
	$message = "wrong username or password!";



	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$Aname = $_POST['Aname'];
		$Apass  = $_POST['Apass'];
		
		if (!empty($Aname) && !empty($Apass ) && !is_numeric($Aname))

		{
		

			//read from database
			

			$query = "select * from admin ";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['Apass'] == $Apass)
					{

						
						header("Location: admin_index.php");
						//die;
					}
				}
			}
			
			echo "<script type='text/javascript'>alert('$message');
			window.location.href='admin.html';
			</script>";		
		}else
		{
			
		echo "<script type='text/javascript'>alert('$message');
			window.location.href='admin.html';
			</script>";
		}
}

?>


