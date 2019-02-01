<?php
	include("config.php");
	$inData = getRequestInfo();

	$ownerId = $inData["owner_id"];
	$name = $inData["contact_name"];
	$email = $inData["contact_email"];
	$phone = $inData["contact_phone"];
	$address = $inData["contact_address"];

	$conn = getDataBase();
	if (mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	}

	else
	{
		$sql = "INSERT INTO Contacts (owner_id, name, email, phone, address)
		VALUES (" . $ownerId . ", '" . $name . "', '" . $email . "', " . $phone . ", '" . $address . "')";

		if( $result = $conn->query($sql) != TRUE )
		{
			returnWithError( $conn->error );
		}

		$conn->close();
	}

	function getRequestInfo()
	{
		return json_decode(file_get_contents('php://input'), true);
	}

	function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}

	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>
