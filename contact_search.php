<?php
	$inData = getRequestInfo();
	
	$conn = new mysqli("localhost", "poop_default", "EC6p~$[s,!G+", "poop_Yeet1");
	
	if (mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	}
	
	else
	{
		$searchResults = "";
		$searchCount = 0;	
		
		$stmt = $conn->prepare("SELECT contact_id FROM Contacts WHERE name LIKE ? AND owner_id = ?");
		
		$stmt->bind_param("si", $contactName, $userId);
		
		$contactName = $inData["contact_name"];
		$userId = $inData["owner_id"];
		
		echo '<script type="text/javascript">alert("Id = '.$inData["owner_id"].'")</script>';
		
		if(!($stmt->execute()))
		{
			returnWithError( $conn->error );
		}
						
		$stmt->bind_result($contactId);
		$stmt->store_result();
		
		if ($stmt->num_rows() > 0)
		{
			while ($stmt->fetch())
			{
				if( $searchCount > 0 )
				{
					$searchResults .= ",";
				}
				
				$searchCount++;
				$searchResults .= ' . $contactId . ';
			}
		}
		
		else
		{
			returnWithError( "No Records Found" );
		}
		
		$stmt->close();
		$conn->close();
	}

	returnWithInfo( $searchResults );

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
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}	
?>