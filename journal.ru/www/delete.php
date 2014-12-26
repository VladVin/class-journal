<html>
<head>
	<title> Delete </title>
	<?php
		$table_name = htmlentities($_GET['table']);
		include("action.php");
	?>
	<style>
		a {	font-size: 20px;}
	</style>
</head>

<body link="#808080" vlink="#808080" alink="#000000">
	<h1 align=center><i>
	<?php
		echo "Удалить из таблицы ".$table_name;
	?>
	</i></h1>
	<hr>
	<center>
	<?php
		echo "<a href=\"show.php?table=".$table_name."\"> Назад </a>";
		echo "<p>";
		printDelete($table_name);
		echo "</p>";
	?>
	</center>
</body>
</html>