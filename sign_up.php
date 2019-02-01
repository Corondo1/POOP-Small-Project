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
		echo "<script>";
		echo 'alert("Passwords do not match");';
		echo 'location = "sign_up.html"';
		echo "</script>";
		exit();
	  }
	  
      $sql = "INSERT INTO Users (Username,Password) VALUES ('" . $username . "','" . $password . "')";
	  $conn = getDataBase();
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
?>

