<?php
	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		$conn = getDataBase();
		
		if(mysqli_connect_errno($conn))
		{
			echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
		} 
		
		else
		{			
			$sql = "SELECT username, password FROM Users WHERE username = '$username'";
			
			$results = mysqli_query($conn, $sql);
			$numrows = mysqli_num_rows($results);

			if($numrows < 1)
			{
				echo "<script>";
				echo 'alert("Username/password invalid");';
				echo 'location = "login.html"';
				echo "</script>";
				exit();
			} 
			
			else
			{
				$row = mysqli_fetch_assoc($results);
				
				$hashed_password = $row['password'];
				
				if (password_verify($password, $hashed_password))
				{
					$_SESSION['login_user'] = $username;
					header("location: contact_manager.php");
				}
				
				else
				{
					echo "<script>";
					echo 'alert("Username/password invalid");';
					echo 'location = "login.html"';
					echo "</script>";
					exit();
				}
			}
			
			$conn->close();
		}
	}
?>
