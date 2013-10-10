<?php
	$hostadress = "localhost";
	$username = "root";
	$password = "";
	$my_sql_db = "bloggers_db";
	
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
