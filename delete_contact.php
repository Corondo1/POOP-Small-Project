<?php
	$inData = getRequestInfo();
	
	$conn = new mysqli("localhost", "poop_default", "EC6p~$[s,!G+", "poop_Yeet1");
	
	if (mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	}
	
	else
	{	
		$stmt = $conn->prepare("DELETE FROM Contacts WHERE contact_id = ?");
		
		$stmt->bind_param("i", $contactId);
		
		$contactId = $inData["contact_id"];
		
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