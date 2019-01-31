<?php
	$inData = getRequestInfo();
	
	$contactName = $inData["search"];
	$userId = $inData["owner_id"];
	
	$searchResults = "";
	$searchCount = 0;

	$conn = new mysqli("localhost", "poop_default", "EC6p~$[s,!G+", "poop_Yeet1");
	
	if (mysqli_connect_errno($conn))
	{
		echo("Failed to connect to MySQL: " . mysqli_connect_error($conn));
	}
	
	else
	{
		$sql = "SELECT contact_id FROM Contacts WHERE name LIKE '%" . $contactName . "%' AND owner_id = $userId";
		$result = $conn->query($sql);
		
		if ($result->num_rows > 0)
		{
			while($row = $result->fetch_assoc())
			{
				if( $searchCount > 0 )
				{
					$searchResults .= ",";
				}
				
				$searchCount++;
				$searchResults .= '" . $row["contact_id"] . "';
			}
		}
		
		else
		{
			returnWithError( "No Records Found" );
		}
		
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
		$retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}	
?>