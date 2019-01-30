<?php
    include("config.php");
    session_start();

    $user_check = $_SESSION['login_user'];

    if(!isset($_SESSION['login_user']))
    {
        header("location: login.html");
        die();
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
                		$usersql = "SELECT user_id FROM Users where username = '$user_check' ";
                		$response = mysqli_query($conn, $usersql);
                		$numrows = mysqli_num_rows($response);

                		if($numrows < 1)
                		{
                			//cry
                			echo("oops");
                		} else
                		{
                			$row = mysqli_fetch_assoc($response);
                			$userid = $row['user_id'];
                		}

                		$sql = "SELECT contact_id,name,email,phone,address FROM Contacts where owner_id = '$userid'";
                		$response = mysqli_query($conn, $sql);
                		$numrows = mysqli_num_rows($response);

                		if($numrows < 1)
                		{
                            echo "no rows retreived.";
                		}
                        else
                		{

                			while($row = mysqli_fetch_assoc($response))
                			{
                                echo "<tr>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['email'] . "</td>";
                                echo "<td>" . $row['phone'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td><button id='addContact' type='button' class='btn btn-danger' onclick='deleteContact(".$row['contact_id'].")'>Delete</button></td>";
                                echo "</tr>";
                			}
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
                        <form action="add_contact.php" method="POST">
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
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>

function deleteContact(contact_id) {
    alert("Delete contact with id "+contact_id+" from the database using ajax.");
}

function addContact(){
    alert("Add contact for the signed on user id");
}
</script>
