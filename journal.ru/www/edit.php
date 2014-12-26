<html>
<head>
	<?php
		$table_name = htmlentities($_GET['table']);
		echo "<title> Edit ".$table_name."</title>";
		include("action.php");
	?>
	<style>
		a {	font-size: 20px;}
	</style>
</head>

<body link="#808080" vlink="#808080" alink="#000000">
	<?php
		echo "<h1 align = center><i>Изменить в таблице ".$table_name."</i></h1>";
		echo "<hr>";
		echo "<center>";
		echo "<p><a href=\"show.php?table=".$table_name."\"> Назад </a></p>";
		echo "</center>";
	?>
	<?php
		printEdit($table_name);
		printTable($table_name);
	?>
</body>
</html>