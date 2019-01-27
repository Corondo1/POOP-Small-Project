<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      //Most of this is depracated junk, needs to be redone -soon TM(C)R
      
      $username = $_POST['username'];
      $password = $_POST['password']; 
      $authpassword = $_POST['password_confirm'];
	  
	  if($password != $authpassword)
	  {
		  echo "Passwords do not match";
		  header("location: SignUp.html");
		  exit();
		  
	  }
	  
      $sql = "INSERT INTO Users (Username,Password) VALUES ('" . $username . "','" . $password . "')";
	  $conn = getDataBase();
      if($result = mysqli_query($conn,$sql) == TRUE)
	  {
		  echo "New user registered";
	  }
   }
?>
