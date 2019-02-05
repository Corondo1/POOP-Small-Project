<?php
    include("config.php");
    session_start();

    $user_check = $_SESSION['login_user'];

    if(!isset($_SESSION['login_user']))
    {
        header("location: login.html");
        die();
    }
    
    if(!isset($_SESSION['searchFlag']))
    {
        $_SESSION['searchFlag'] = false;
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    	<!-- <script src="contacts.php"></script> -->
    </head>
    
    <body>
        <nav class="navbar navbar-inverse">
          <div class="container-fluid">
              <div class="navbar-header">
                  <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
              </div>
              <div class="collapse navbar-collapse" id="myNavbar">
                  <ul class="nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout </a></li>
                  </ul>
              </div>
          </div>
        </nav>
        <div class="jumbotron text-center">
            <h1>Project 1</h1>
            <p>*burrppppp* Yeah Morty, and this is the Contact list page.</p>
        </div>
        <div class="container">
            <div>
                <form action="contact_search.php" method="POST">
                    <div class="form-group">
                        <label>Search Contacts:</label>
                        <input id="search_name" name="newSearchContacts" type="text" class="form-control" placeholder="">
                    </div>
                    <button type="submit" class="btn btn-default" onclick="javascript:newSearchContacts();">Search</button>
                    <button type="reset" class="btn btn-default" onclick="javascript:hideSearch()">Clear</button>
                </form>
                <table class="table" id="searchTable" style="display:none">
                    <thead>
                        <tr>
                            <th>Contact Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
                <table class="table">
                    <thead>
                      <tr>
                        <th>Contact Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Address</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
    					
                        $conn = getDataBase();
    					
                    	if(mysqli_connect_errno($conn))
                    	{
                    		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
                    	}
					
                    	else
                    	{
                    		$stmt1 = $conn->prepare("SELECT user_id FROM Users WHERE username = ?");
    						
    						$stmt1->bind_param("s", $user_check);
    						
    						$stmt1->execute();
    						
    						$stmt1->bind_result($userId);
    						$stmt1->store_result();
    						
    						if ($stmt1->num_rows() < 1)
    						{
    							echo("Error");
    					    }
						
    						else
    						{
    							while ($stmt1->fetch())
    							{
    								$stmt2 = $conn->prepare("SELECT contact_id, name, email, phone, address FROM Contacts WHERE owner_id = ?");
    								
    								$stmt2->bind_param("i", $userId);
    								
    								$stmt2->execute();
    								
    								$stmt2->bind_result($contactId, $name, $email, $phone, $address);
    								$stmt2->store_result();
    								
    								while ($stmt2->fetch())
    								{
    									echo "<tr>";
    									echo "<td>" . $name . "</td>";
    									echo "<td>" . $email . "</td>";
    									echo "<td>" . $phone . "</td>";
    									echo "<td>" . $address . "</td>";
    									echo "<td><button id='addContact' type='button' class='btn btn-danger' onclick='deleteContact(".$contactId.")'>Delete</button></td>";
    									echo "</tr>";
    								}
    							}
    							
    							$stmt1->close();
    							$stmt2->close();
    							$conn->close();
    						}
                	    }
                    ?>
                </tbody>
            </table>
        </div>



        <!-- Trigger the modal with a button -->
        <button id="addContactModal" name="addContactModal" type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary">Add Contact</button>


        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Add Contact</h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:addContact();" method="POST">
                            <div class="form-group">
                                <label>Name:</label>
                                <input id="contact_name" name="contact_name" type="text" class="form-control" placeholder="Enter contact name" required>
                            </div>
                            <div class="form-group">
                                <label>Email:</label>
                                <input id="contact_email" name="contact_email" type="text" class="form-control" placeholder="Enter contact email">
                            </div>
                            <div class="form-group"> <!-- There is probably a better way to do this -->
                                <label>Phone:</label>
                                <input id="contact_phone" name="contact_phone" type="number" class="form-control" placeholder="Enter contact phone number">
                            </div>
                            <div class="form-group"> <!-- There is probably a better way to do this -->
                                <label>Address:</label>
                                <input id="contact_address" name="contact_address" type="text" class="form-control" placeholder="Enter contact address">
                            </div>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="javascript:window.location.reload()" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>

function showSearch()
{
    $_SESSION['searchFlag'] = true;
    alert("works")
}
function hideSearch()
{
    document.getElementById("searchTable").style.display = "none";
}

function searchContacts()
{
    document.getElementById("searchTable").style.display = "initial";
	
	var ownerId = <?php echo json_encode($userId); ?>;
	var contact_search = document.getElementById("search_name").value;
	var jsonPayload = '{"owner_id" : "' + ownerId + '", "contact_name" : "' + contact_search + '"}';

	var url = 'http://yeetdog.com/ContactProject/contact_search.php';
	
	alert(jsonPayload);
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				alert("Contact is being searched");
				var values = '';
				var jsonObject = JSON.parse( xhr.responseText );
				var i;
				for(i = 0; i < jsonObject.results.length; i++)
				{
					values += jsonObject.results[i];
					values += "\r";
				}
				alert(values);
			}
		};
		xhr.send(jsonPayload);
	}
	
	catch(err)
	{
		alert(err.message);
	}
}

function deleteContact(contact_id) 
{
	var contactId = contact_id;
	
	var jsonPayload = '{"contact_id" : "' + contactId + '"}';
	
	var url = 'http://yeetdog.com/ContactProject/delete_contact.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				window.location.reload();
			}
		};
		xhr.send(jsonPayload);
	}
	
	catch(err)
	{
		alert(err.message);
	}
}

function addContact()
{
	var ownerId = <?php echo json_encode($userId); ?>;
	var contact_name = document.getElementById("contact_name").value;
	var contact_email = document.getElementById("contact_email").value;
	var contact_phone = +document.getElementById("contact_phone").value;
	var contact_address = document.getElementById("contact_address").value;
	
	var jsonPayload = '{"owner_id" : "' + ownerId + '", "contact_name" : "' + contact_name + '", "contact_email" : "' + contact_email + '", "contact_phone" : "' + contact_phone + '", "contact_address" : "' + contact_address + '"}';
	
	var url = 'http://yeetdog.com/ContactProject/add_contact.php';
	
	var xhr = new XMLHttpRequest();
	xhr.open("POST", url, true);
	xhr.setRequestHeader("Content-type", "application/json; charset=UTF-8");
	
	try
	{
		xhr.onreadystatechange = function() 
		{
			if (this.readyState == 4 && this.status == 200) 
			{
				window.location.reload();
				alert("Contact has been added");
			}
		};
		xhr.send(jsonPayload);
	}
	
	catch(err)
	{
		alert(err.message);
	}
}
    function newSearchContacts()
    {
      // Declare variables
      var input, filter, ul, li, a, i, txtValue;
      input = document.getElementById('myInput');
      filter = input.value.toUpperCase();
      ul = document.getElementById("myUL");
      li = ul.getElementsByTagName('li');
    
      // Loop through all list items, and hide those who don't match the search query
      for (i = 0; i < li.length; i++)
      {
        a = li[i].getElementsByTagName("a")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1)
        {
          li[i].style.display = "";
        }
        else
        {
          li[i].style.display = "none";
        }
      }
    }
</script>
