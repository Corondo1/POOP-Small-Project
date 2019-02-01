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
		echo "<script>window.location.reload();"
		echo "alert("Passwords do not match");"
		echo "</script>"
		  header("location: sign_up.html");
	  }
	  
      $sql = "INSERT INTO Users (Username,Password) VALUES ('" . $username . "','" . $password . "')";
	  $conn = getDataBase();
      if(mysqli_query($conn,$sql))
	  {
		echo "<script>window.location.reload();"
		echo "alert("Successful Sign Up!");"
		echo "</script>"
		header("location: login.html");
	  }
	  else
	  {
		echo "<script>window.location.reload();"
		echo "alert("Username taken, please choose another");"
		echo "</script>"
		  
	  }
   }
?>
