<?php
	include(Config.php);
	session_start();
	
	$user_check = $_SESSION['login_user'];
	
	if(!isset($_SESSION['login_user']))
	{
		header("location: Login.php");
		die();
	}
	
	$conn = getDataBase();
	if(mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	} else
	{
		$usersql = "SELECT user_id FROM Users where username = '$user_check' ";
		$response = mysqli_query($conn, $usersql);
		$numrows = mysqli_num_rows($response);
		
		if($numrows < 1)
		{
			//cry
			echo("oops");
		} else
		{
			$row = mysqli_fetch_assoc($results);
			$userid = $row['user_id'];
		}
		
		$sql = "SELECT name,phone,email,address FROM Contacts where owner_id = '$userid' ");
		$response = mysqli_query($conn, $sql);
		$numrows = mysqli_num_rows($response);
		
		if($numrows < 1)
		{
			
		} else
		{
			$retContacts =  " <div class=\"container\"> ";
			while($row = mysqli_fetch_assoc($response))
			{
				$retContacts = $retContacts . 
				" <div class= \"col-sm-6 \">
					<table class=\"table\">
						<thead>
						<tr>
							<th> " . $row['name'] . "</th>
						</tr>
						</thead>
						<tbody>
						<tr>
							<td>Phone Number: " . $row['phone'] . "</td>
						</tr>
						<tr>
							<td>Email: " . $row['email'] . "</td>
						</tr>
						<tr>
							<td>Address: " . $row['address'] . "</td>
						</tr>
						</tbody>
					</table>
				</div> ";
			}
			$retContacts = $retContacts . " </div> ";
		}
	}
?>