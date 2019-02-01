<?php
	$inData = getRequestInfo();
	
	$conn = new mysqli("localhost", "poop_default", "EC6p~$[s,!G+", "poop_Yeet1");
	
	if (mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	}
	
	else
	{
		$stmt = $conn->prepare("INSERT INTO Contacts (owner_id, name, email, phone, address) 
		VALUES (?, ?, ?, ?, ?)");
		
		$stmt->bind_param("issis", $ownerId, $name, $email, $phone, $address);
		
		$ownerId = $inData["owner_id"];
		$name = $inData["contact_name"];
		$email = $inData["contact_email"];
		$phone = $inData["contact_phone"];
		$address = $inData["contact_address"];
		
		if(!($stmt->execute()))
		{
			returnWithError( $conn->error );
		}
		
		$stmt->close();
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