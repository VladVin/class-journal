<html>
<head>
	<?php
		$table_name = htmlentities($_GET['table']);
		echo "<title> Add ".$table_name."</title>";
		include("action.php");
	?>
	<style>
		a {	font-size: 20px;}
	</style>
</head>

<body link="#808080" vlink="#808080" alink="#000000">
	<?php
		echo "<h1 align = center><i>Добавить в таблицу ".$table_name."</i></h1>";
		echo "<hr>";
		echo "<center>";
		echo "<a href=\"show.php?table=".$table_name."\"> Назад </a>";
		echo "<p>";
		printAdd($table_name);
		echo "</p></center>";
	?>
</body>
</html>