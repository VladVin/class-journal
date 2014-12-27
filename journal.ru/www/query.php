<?php 
    // Script for processing queries from index.php
    include("functions.php");
    prepareDB();

    switch ($_POST['action'])
    {
        case "add":
            if (($_POST['student'] == "") || ($_POST['subject'] == "") || ($_POST['mark'] == "") || ($_POST['date'] == ""))
            {
                die("Для добавления необходимо заполнить все поля!");
            }
            else echo "Оценка успешно добавлена";
        break;

        case "show":
            showTable($_POST);
        break;
        
        default:
            die("SOMETHING WRONG");
        break;
    }
?>