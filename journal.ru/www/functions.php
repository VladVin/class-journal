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

    function tryQuery($query)
    {
    	prepareDB();
    	$result = mysql_query($query);
            if (!$result) 
            {
                die("error " . mysql_error() . "<br>");
            }
        return $result;
    }

    function addRecord($POST)
    {
    	prepareDB();
    	if (($POST['student'] == "") || ($POST['subject'] == "") || ($POST['mark'] == "") || ($POST['date'] == ""))
            {
                die("Для добавления необходимо заполнить все поля!");
            }
            else 
            {
                // If STUDENT not created, create
                if (!mysql_query("SELECT ID FROM students WHERE FIO='" . $POST['student'] . "'"))
                    tryQuery("INSERT INTO students (FIO) VALUES('" . $POST['student'] . "')");

                // If SUBJECT not created, create
                if (!mysql_query("SELECT ID FROM subjects WHERE subjectName='" . $POST['subject'] . "'"))
                    tryQuery("INSERT INTO subjects (subjectName) VALUES('" . $POST['subject'] . "')");

                // Create MARK
                if (tryQuery("INSERT INTO marks (studentID, subjectID, mark, date)
                                VALUES(
                                    (SELECT ID FROM students WHERE FIO='" . $POST['student'] . "' LIMIT 1),
                                    (SELECT ID FROM subjects WHERE subjectName='" . $POST['subject'] . "' LIMIT 1),
                                    '".$POST['mark']."', '".$POST['date']."')"))
                echo "Оценка успешно добавлена";
            }
    }

    function deleteRecord(id)
    {
    	prepareDB();
    	if (tryQuery("DELETE FROM marks WHERE ID='" . id . "'"))
    		echo "Запись удалена";
    }
?>