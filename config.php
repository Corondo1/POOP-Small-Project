<?php
	function getDataBase()
	{
		define('DB_SERVER', 'localhost:3306');
		define('DB_USERNAME', 'poop_default');
		define('DB_PASSWORD', 'default');
		define('DB_DATABASE', 'poop_Yeet1');
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		return $db;
	}

?>
