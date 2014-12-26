<html>
<head>
	<title>Send</title>
	<?php 
		include("action.php");
		$table_name = htmlentities($_GET['table']);
	?>
	<style>
		h1 { font-size: 20px;}
	</style>
	<?php 
		echo "<META HTTP-EQUIV=\"Refresh\" Content=\"3, URL=show.php?table=".$table_name."\">";
	?>
</head>
<body>
<?php
	if ($_GET['type'] == "add" && $table_name != "schedule")
	{
		$stripe[0] = "NULL";
		$count = count($_POST) + 1;
	}
	else
	{
		$stripe[0] = htmlentities($_POST[0]);
		$count = count($_POST);
	}

	for ($i = 1; $i < $count; $i++)
	{
		$stripe[$i] = htmlentities($_POST["".$i.""]);
	}

	if (htmlentities($_GET['type']) == "delete")
	{
		$query = "DELETE FROM ".$table_name." WHERE ";
		$length = count($stripe);
		$head = headsForQuery($table_name);
		for ($i = 0; $i < $length; $i++)
		{
			$query = $query.$head[$i]." = '".$stripe[$i]."'";
		}
	}
	elseif (htmlentities($_GET['type']) == "add")
	{
		$query = "INSERT INTO ".$table_name." VALUES (";
		$length = count($stripe) - 1;
		for ($i = 0; $i < $length; $i++) 
		{
			$query = $query."'".$stripe[$i]."', ";
		}
		$query = $query."'".$stripe[$length]."')";
	}
	elseif (htmlentities($_GET['type']) == "edit" && $table_name != "schedule")
	{
		$query = "UPDATE ".$table_name." SET ";
		$head = heads($table_name);

		$length = count($head) - 1;
		for ($i = 1; $i < $length; $i++) 
		{
			$query = $query.$head[$i]."='".$stripe[$i]."', ";
		}
		$query = $query.$head[$length]."='".$stripe[$length]."'";
		$query = $query." WHERE ".$head[0]." = ".$_POST[0];
	}
	elseif ($table_name == "schedule")
	{
		$head = headsForQuery($table_name);
		$query = "UPDATE schedule 
					SET Mark = '".$stripe[2]."'
					WHERE ".$head[0]." = '".$stripe[0]."'
					 AND ".$head[1]." = '".$stripe[1]."';";
	}
	
	prepareDB();
	$result = mysql_query($query);
	if (!$result)
	{
		die("error " . mysql_error() . "<br>");
	}
	echo "<h1 align=center><i>SUCCESS!</h1>";
	closeConnectDB();

	printTable($table_name);
?>
</body>
</html>