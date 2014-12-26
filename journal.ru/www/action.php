<?php
	function prepareDB()
	{
		global $connection;
		$connection = @mysql_connect("localhost", "root", "");
		if (!$connection) {
			die("error: cannot connect to database: " . mysql_error() . "<br>");
		}

		$db_select = mysql_select_db("facult");
		if (!$db_select) {
			die("error: cannot connect to database: " . mysql_error() . "<br>");
		}

		$query = "SET NAMES cp1251";
		$result = mysql_query($query);
		if (!$result) {
			die("error " . mysql_error() . "<br>");
		}
	}

	function closeConnectDB()
	{
		global $connection;
		mysql_close($connection);
	}

	function heads($table_name)
	{
		prepareDB();

		$text = queryByTable($table_name);
		$result = mysql_query($text);
		if (!$result) 
		{
			die("error " . mysql_error() . "<br>");
		}
		for ($i = 0, $L = mysql_num_fields($result); $i < $L; $i++) 
		{
    		$field = mysql_fetch_field($result, $i);
    		$head[$i] = htmlspecialchars($field ? $field->name : "[$i]");
		}

		closeConnectDB();

		return $head;
	}

	function headsForQuery($table_name)
	{
		prepareDB();

		$text = "SELECT * FROM ".$table_name;
		$result = mysql_query($text);
		if (!$result) 
		{
			die("error " . mysql_error() . "<br>");
		}
		for ($i = 0, $L = mysql_num_fields($result); $i < $L; $i++) 
		{
    		$field = mysql_fetch_field($result, $i);
    		$head[$i] = htmlspecialchars($field ? $field->name : "[$i]");
		}

		closeConnectDB();

		return $head;
	}

	function printTable($table_name)
	{

		echo "<center><table border=1>";
		echo '<tr>';
		$head = heads($table_name);
		foreach($head as $i)
		{
			echo "<th>";
			echo $i;
			echo "</th>";
		}
		echo '</tr>';

		prepareDB();

		$text = queryByTable($table_name);
		$result = mysql_query($text);
		if (!$result) 
		{
			die("error " . mysql_error() . "<br>");
		}
		while ($result_row = mysql_fetch_array($result, MYSQL_NUM)) 
		{
			$s = $result_row;
			echo "<tr>";
			for ($i = 0; $i < count($s); $i++) {
				echo "<td>";
				echo $s[$i];
				echo "</td>";
			}
			echo "</tr>";
		}
		echo "</table></center>";

		closeConnectDB();
	}

	function printAdd($table_name)
	{
		echo "<table align = center>";
		echo "<form action = \"send.php?type=add&table=$table_name\" method = \"POST\">";
		
		$head = heads($table_name);
		if ($table_name == "schedule")
		{
			echo "<th>";
			echo $head[0];
			echo "</th>";
		}
		for ($i = 1; $i < count($head); $i++)
		{
			echo "<th>";
			echo $head[$i];
			echo "</th>";
		}

		if ($table_name == "schedule")
		{
			prepareDB();
				echo "<tr>";
				echo "<td align = center>";
				echo "<select name=\"0\">";
				$result = mysql_query("SELECT ID, Surname 
										FROM students
										ORDER BY Surname");
				if (!$result) 
				{
					die("error " . mysql_error() . "<br>");
				}
				while ($result_row = mysql_fetch_array($result)) 
				{
					$s = $result_row;
					echo "<option value=".$s[0].">".$s[1]."</option>";
				}
				echo "</select>";
				echo "</td>";
				
				echo "<td align = center>";
				echo "<select name=\"1\">";
				$result = mysql_query("SELECT ID, Name 
										FROM subjects");
				if (!$result) 
				{
					die("error " . mysql_error() . "<br>");
				}
				while ($result_row = mysql_fetch_array($result)) 
				{
					$s = $result_row;
					echo "<option value=".$s[0].">".$s[1]."</option>";
				}
				echo "</select>";
				echo "</td>";

				echo "<td align = center>";
				echo "<select name=\"2\">";
				for ($i = 5; $i > 0; $i--)
				{
					echo "<option>".$i."</option>";
				}
				echo "</select>";
				echo "</td>";
				echo "</tr>";

				echo "<tr>";
				for ($i = 0; $i < 2; $i++) 
				{
		    		echo "<td></td>";
				}
				echo "<td align = right><input type = \"submit\"> </td></tr></form></table>";
			closeConnectDB();
		}
		else
		{
			prepareDB();

			$result = mysql_query(queryByTable($table_name));
			if (!$result) 
			{
				die("error " . mysql_error() . "<br>");
			}
			echo "<tr>";
			for ($i = 1, $L = mysql_num_fields($result); $i < $L; $i++) 
			{
	    		echo "<td><input type = \"text\" name = \"".$i."\"></td>";
			}
			echo "</tr>";

			echo "<tr>";
			for ($i = 1, $L = mysql_num_fields($result) - 1; $i < $L; $i++) 
			{
	    		echo "<td></td>";
			}
			echo "<td align = right><input type = \"submit\"> </td></tr></form></table>";

			closeConnectDB();
		}
	}

	function queryByTable($table_name)
	{
		if ($table_name == "schedule")
		{
			$query = "SELECT Surname, Name, Mark 
					FROM students, subjects, schedule 
					WHERE StudentID = students.ID 
					AND SubjectID = subjects.ID
					ORDER BY Surname";
		}
		else
		{
			$query = "SELECT * FROM " . $table_name;
		}
		return $query;
	}

	function printEdit($table_name)
	{
		echo "<table align = center>";
		echo "<p>";
		echo "<form action = \"send.php?type=edit&table=$table_name\" method = \"POST\">";

		$head = heads($table_name);
		foreach($head as $i)
		{
			echo "<th>";
			echo $i;
			echo "</th>";
		}
		$length = count($head);
		
		echo "<tr>";
		if ($table_name == "schedule")
		{
			prepareDB();
				echo "<td align = center>";
				echo "<select name=\"0\">";
				$result = mysql_query("SELECT ID, Surname 
										FROM students
										ORDER BY Surname");
				if (!$result) 
				{
					die("error " . mysql_error() . "<br>");
				}
				while ($result_row = mysql_fetch_array($result)) 
				{
					$s = $result_row;
					echo "<option value=".$s[0].">".$s[1]."</option>";
				}
				echo "</select>";
				echo "</td>";
				
				echo "<td align = center>";
				echo "<select name=\"1\">";
				$result = mysql_query("SELECT ID, Name 
										FROM subjects");
				if (!$result) 
				{
					die("error " . mysql_error() . "<br>");
				}
				while ($result_row = mysql_fetch_array($result)) 
				{
					$s = $result_row;
					echo "<option value=".$s[0].">".$s[1]."</option>";
				}
				echo "</select>";
				echo "</td>";

				echo "<td align = center>";
				echo "<select name=\"2\">";
				for ($i = 5; $i > 0; $i--)
				{
					echo "<option>".$i."</option>";
				}
				echo "</select>";
				echo "</td>";
			closeConnectDB();
		}
		else
		{
			for ($i = 0; $i < $length; $i++)
			{
				echo "<td>";
				echo "<input type=\"text\" name=\"".$i."\">";
				echo "</td>";
			}
		}
		echo "</tr>";

		echo "<tr>";
		for ($i = 0; $i < $length - 1; $i++)
		{
			echo "<td></td>";				
		}
		echo "<td align = right>";
		echo "<input type=\"submit\">";
		echo "</td></tr>";
		echo "</form> </p>";
		echo "</table>";
	}

	function printDelete($table_name)
	{
		echo "<table align = center>";
		echo "<form action = \"send.php?type=delete&table=$table_name\" method = \"POST\">";
		if ($table_name == "schedule")
		{
			prepareDB();
			echo "<th>Surname</th>";
			echo "<th>SubjectName</th>";
			
			echo "<td align = center>";
			echo "<select name=\"0\">";

			$result = mysql_query("SELECT ID, Surname 
									FROM students
									ORDER BY Surname");
			if (!$result) 
			{
				die("error " . mysql_error() . "<br>");
			}
			while ($result_row = mysql_fetch_array($result)) 
			{
				$s = $result_row;
				echo "<option value=".$s[0].">".$s[1]."</option>";
			}
			echo "</select>";
			echo "</td>";
			
			echo "<td align = center>";
			echo "<select name=\"1\">";
			$result = mysql_query("SELECT ID, Name 
									FROM subjects");
			if (!$result) 
			{
				die("error " . mysql_error() . "<br>");
			}
			while ($result_row = mysql_fetch_array($result)) 
			{
				$s = $result_row;
				echo "<option value=".$s[0].">".$s[1]."</option>";
			}
			echo "</select>";
			echo "</td>";
			echo "<tr><td></td><td align=center>";
			echo "<input type =\"submit\"></input></td></tr>";
			closeConnectDB();
		}
		else
		{
			echo "<th>ID</th>";
			echo "<tr><td align=center >";
			echo "<select name=\"0\">";
			
			prepareDB();
			$result = mysql_query("SELECT ID 
									FROM ".$table_name);
			if (!$result) 
			{
				die("error " . mysql_error() . "<br>");
			}
			while ($result_row = mysql_fetch_array($result)) 
			{
				$s = $result_row;
				echo "<option value=".$s[0].">".$s[0]."</option>";
			}
			closeConnectDB();

			echo "</select>";
			echo "</td></tr>";
			echo "<tr><td align=center ><input type =\"submit\"></input></td></tr>";
		}
		echo "</form></table>";
		printTable($table_name);
	}
?>