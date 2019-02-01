<?php
	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$username = $_POST['username'];
		$password = $_POST['password']; 
		$authpassword = $_POST['password_confirm'];
		
		if($password != $authpassword)
		{
			echo "<script>";
			echo 'alert("Passwords do not match");';
			echo 'location = "sign_up.html"';
			echo "</script>";
			exit();
		}
		
		$conn = getDataBase();
		
		if (mysqli_connect_errno($conn))
		{
			echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
		}
		
		else
		{
			$hashed_password = password_hash($password, PASSWORD_DEFAULT);

			$sql = "INSERT INTO Users (Username,Password) VALUES ('" . $username . "','" . $hashed_password . "')";
			
			if(mysqli_query($conn,$sql))
			{
				echo "<script>";
				echo 'alert("Successful Sign Up!");';
				echo 'location = "login.html"';
				echo "</script>";
			}
			
			else
			{
				echo "<script>";
				echo 'alert("Username taken, please choose another");';
				echo 'location = "sign_up.html"';
				echo "</script>";
			}
		}
	}
?>
