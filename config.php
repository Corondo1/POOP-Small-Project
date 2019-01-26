<?php
	function getDataBase()
	{
		define('DB_SERVER', 'localhost:3306');
		define('DB_USERNAME', 'webaccess');
		define('DB_PASSWORD', 'Generic123!');
		define('DB_DATABASE', 'cop4331');
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		return $db;
	}

?>
