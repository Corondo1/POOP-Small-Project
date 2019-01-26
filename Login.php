<?php
   include("config.php");
   session_start();
   
   if($_SERVER["REQUEST_METHOD"] == "POST") 
   {
      // username and password sent from form 
      
      $username = mysqli_real_escape_string($dataBase,$_POST['username']);
      $password = mysqli_real_escape_string($dataBase,$_POST['password']); 
      
      $sql = "SELECT id FROM user WHERE username = '$username' and passcode = '$password'";
      $result = mysqli_query($dataBase,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) 
	  {
         session_register("username");
         $_SESSION['login_user'] = $username;
         
         header("location: ContactManager.php");
      }else {
         $error = "Your Login Name or Password is invalid";
      }
   }
?>