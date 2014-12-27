<?php
    // Script for deleting marks from DB by id
	include("functions.php");
    prepareDB();
    deleteRecord($_POST['markID']);
?>