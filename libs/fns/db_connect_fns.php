<?php
    require_once('config.php');
    $config = new Config();

	$hostadress = $config->host;
	$username = $config->user_name;
	$password = $config->password;
	$my_sql_db = $config->database;
	
	$connect = mysql_connect($hostadress, $username, $password);
	
	if (!$connect)
	{
	  die('Could not connect: ' . mysql_error());
	}
	else	
	{
		//echo "Successful connection";
		mysql_select_db($my_sql_db, $connect);
	}
?>
