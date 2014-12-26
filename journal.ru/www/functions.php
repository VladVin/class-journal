<?php

	// Some functions for working scripts

	function prepareDB()
	{
		global $connection;
		$connection = mysql_connect("localhost", "root", "");
		if (!$connection) 
		{
			die("Error: cannot connect to database: " . mysql_error() . "<br>");
		}
		$db_select = mysql_select_db("journal");
		if (!$db_select) 
		{
			die("Error: cannot connect to database: " . mysql_error() . "<br>");
		}
	}


?>