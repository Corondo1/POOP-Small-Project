<?php
	function getDataBase()
	{
		define('DB_SERVER', '127.0.0.1');
		define('DB_USERNAME', 'poop_default');
		define('DB_PASSWORD', 'EC6p~$[s,!G+');
		define('DB_DATABASE', 'poop_Yeet1');
		$db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
		return $db;
	}

?>
