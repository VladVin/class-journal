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

    function closeConnectDB()
    {
        global $connection;
        mysql_close($connection);
    }

    function showTable($what)
    {
        prepareDB();

        $query = "SELECT FIO, subjectName, mark, date, marks.ID
                    FROM students, subjects, marks
                    WHERE students.ID=marks.studentID AND subjects.ID=marks.subjectID";
        if ($what['student'] != "")
        {
            $query .= " AND students.FIO='".$what['student']."'";
        }
        if ($what['subject'] != "")
        {
            $query .= " AND subjects.subjectName='".$what['subject']."'";
        }
        if ($what['mark'] != "")
        {
            $query .= " AND marks.mark='".$what['mark']."'";
        }
        if ($what['date'] != "")
        {
            $query .= " AND marks.date='".$what['date']."'";
        }

        // die("q = ".$query);

        $result = mysql_query($query);

        $marks = array();
        while($s = mysql_fetch_array($result))
        {
            array_push($marks, $s['mark']);
        }
        $markAvg = calcAvg($marks);
        echo "<p>Средняя оценка: ".$markAvg."</p>";

        echo "<table>";

        if (!$result)
        {
            die("error " . mysql_error() . "<br>");
        }

        mysql_data_seek($result, 0);
        while($s = mysql_fetch_array($result))
        {
            echo "<tr>";
            echo "<td>" . $s[0] . "</td>";
            echo "<td>" . $s[1] . "</td>";
            echo "<td>" . $s[2] . "</td>";
            echo "<td>" . $s[3] . "</td>";
            echo "<td>
                    <form name=\"delete\" action=\"delete.php\" method=\"post\" target=\"result\">
                        <input name=\"markID\" type=\"hidden\" value=\"".$s['marks.ID']."\">
                        <input type=\"submit\" value=\"Удалить запись\">
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
        closeConnectDB();
    }

    function calcAvg($seq)
    {
        if (count($seq) == 0)
        {
            die();
        }

        $sum = 0;
        foreach ($seq as $num)
        {
            $sum += $num;
        }
        return $sum / count($seq);
    }
?>