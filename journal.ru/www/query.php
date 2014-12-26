<?php 
    // Script for processing queries from index.php
    include("functions.php");
    prepareDB();

    switch ($_POST['action'])
    {
        case "add":
            addRecord($_POST);
        break;
        case "show":
            echo "SHOW OK";
        break;
        default:
            die("SOMETHING WRONG");
        break;
    }
?>