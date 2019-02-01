<?php
	include("config.php");
	session_start();
	
	if($_SERVER["REQUEST_METHOD"] == "POST")
	{
		$usernameInput = $_POST['username'];
		$passwordInput = $_POST['password'];

		$conn = getDataBase();
		
		if(mysqli_connect_errno($conn))
		{
			echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
		} 
		
		else
		{			
			$stmt = $conn->prepare("SELECT username, password FROM Users WHERE username = ?");
			
			$stmt->bind_param("i", $usernameInput);
			
			$stmt->execute();
						
			$stmt->bind_result($usernameDB, $password);
			$stmt->store_result();
			
			if ($stmt->num_rows() < 1)
			{
				echo "<script>";
				echo 'alert("Username/password invalid");';
				echo 'location = "login.html"';
				echo "</script>";
				exit();
			}
			
			else
			{
				while ($stmt->fetch())
				{
					$hashed_password = $password;
					
					if (password_verify($passwordInput, $hashed_password))
					{
						$_SESSION['login_user'] = $usernameDB;
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
			}
			
			$conn->close();
		}
	}
?>
