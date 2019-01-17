function validateUser()
{
	//call function to ping database?
	//if (databaseOnline) -> do login
	//else -> error page, server offline
	
	//get username and password
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	
  //alert("success")
	//alert(username)
	//alert(password)
	//sanitize inputs?
	
	//create package
	
	//response from stack
	
	//if(user good)
	if(username == "admin" && password == "password")
		var success = true;
	
	if(success)
		alert("logged in!")
	else
		alert("invalid user/password")
	//direct user to contacts.html
	
	//else
	//fail whale
}
