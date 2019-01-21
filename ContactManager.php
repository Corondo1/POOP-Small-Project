<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="NavStyle.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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
        <h5>Only made ContactManager available in nav bar for login for demonstration purposes. Should switched to from php after username has been validated</h5>
        <p>Select a user to display their contacts.</p>
        <p>Populate the table from the database. Whenever a user name is pressed query the database using ajax and then put the results in contacts. edit class="active" attribute to change which of the users is "selected"</p>

        <div class="col-sm-6">
            <table class="table">
                <thead>
                  <tr>
                    <th>Users</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>John</td>
                  </tr>
                  <tr class="active">
                    <td>Mary</td>
                  </tr>
                  <tr>
                    <td>July</td>
                  </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-6">
            <table class="table">
                <thead>
                  <tr>
                    <th>Contacts</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>John</td>
                  </tr>
                  <tr>
                    <td>Mary</td>
                  </tr>
                  <tr>
                    <td>July</td>
                  </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
