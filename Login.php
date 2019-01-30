<?php
   include("config.php");
   session_start();

   if($_SERVER["REQUEST_METHOD"] == "POST")
   {
    //echo("Works <br>");

    $username = $_POST['username'];
    $password = $_POST['password'];
	//echo("username $username and password $password <br>");

	//$db = mysqli_connect("localhost:3306","webaccess","Generic123!","cop4331");
	$conn = getDataBase();
	if(mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	} else
	{
		//echo("successfully connected to mysql <br>");
		$sql = "SELECT username FROM Users WHERE username = '$username' and password = '$password'";
		//echo("sql string is [$sql] <br>");
		$results = mysqli_query($conn, $sql);
		$numrows = mysqli_num_rows($results);

		//echo("<br> made it past query <br>");
		//echo("numrows is $numrows <br>");
		if($numrows < 1)
		{
			echo("<br> invalid login credenitaltajskdlawd <br>");
			flush(); ob_flush();
			//sleep(3);
			header("location: login.html");

		} else
		{
			$_SESSION['login_user'] = $username;
			header("location: contact_manager.php");
			//while($row = mysqli_fetch_assoc($results))
			//{
				//echo("<br> found user <br>");
				//echo("username : " . $row['username'] . "<br>");
				//echo("firstname: " . $row['firstname'] . "<br>");
				//echo("lastname: " . $row['lastname'] . "<br>");
			//}
		}
	}
   }
?>
