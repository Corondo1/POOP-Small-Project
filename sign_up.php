<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      //Most of this is depracated junk, needs to be redone -soon TM(C)R
	// no keep it? or just include it into the html directly
      
      $username = $_POST['username'];
      $password = $_POST['password']; 
      $authpassword = $_POST['password_confirm'];
	  
	  if($password != $authpassword)
	  {
		  //alert("Passwords do not match"); //web server threw errors when i had the alerts in, will fix tomorrow
		  header("location: sign_up.html");
	  }
	  
      $sql = "INSERT INTO Users (Username,Password) VALUES ('" . $username . "','" . $password . "')";
	  $conn = getDataBase();
      if($result = mysqli_query($conn,$sql) == TRUE)
	  {
		//alert("SignUp successful!");
		header("location: login.html");
	  }
   }
?>
