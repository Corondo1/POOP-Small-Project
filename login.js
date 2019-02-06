function checkForUpdate()
{
    if (window.applicationCache !== undefined && window.applicationCache !== null)
    {
        window.applicationCache.addEventListener('updateready', updateApplication);
    }
}

function updateApplication(event)
{
    if (window.applicationCache.status != 4) return;
    window.applicationCache.removeEventListener('updateready', updateApplication);
    window.applicationCache.swapCache();
    window.location.reload();
}

// Called when submit button on login page is hit
function doLogin()
{
	var username = document.getElementById("username").value;
	var password = document.getElementById("password").value;
	
	var jsonPayload = '{"username" : "' + username + '", "password" : "' + password + '"}';
	
	var url = 'https://yeetdog.com/ContactProject/login.php';
	//alert("Javascript");
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", 'application/json; charset=UTF-8');
	try
	{
		xhr.send(jsonPayload);
		xhr.onreadystatechange = function() 
		{
		    // Complete
			if (xhr.readyState == 4 && xhr.status == 200) 
			{
                var json = JSON.parse(xhr.response);
				
				// Passwords matched
				if(json.state == 1) {
				    window.location.href = 'https://yeetdog.com/ContactProject/contact_manager.php';
				}
				else{
				    alert("Incorrect Username or Password");
				}
			}
		};
		//alert(test);
        //alert("after payload");
        //var test = JSON.parse(xhr.response);
        //alert("we parsed");
		
	}
	
	catch(err)
	{
		alert(err.message);
	}
}
