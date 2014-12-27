﻿<html>
<head>
    <title>Классный журнал</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href='http://fonts.googleapis.com/css?family=PT+Sans:400,700&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script>
        function CheckQueryType(queryType) {
            switch (queryType)
            {
                case "add":
                    document.getElementsByName("action")[0].value = "add";
                break;
                case "show":
                    document.getElementsByName("action")[0].value = "show";
                break;
            }
        }
    </script>
</head>
<body>
    <div class="wrapper">

        <div class="header">
            <h1>КЛАССНЫЙ ЖУРНАЛ</h1>
        </div>
        <div class="query-form">
            <form name="query" action="query.php" method="post" target="result">
                <b>Введите данные и выберите действие:</b><Br>
                <input type="text" name="student" placeholder="Фамилия Имя Отчество" size="32">
                <input type="text" name="subject" placeholder="Предмет" size="15">
                <input type="text" name="mark" placeholder="Оценка" size="5">
                <input type="date" name="date">
                <input type="hidden" name="action">
                <input type="submit" name="add" value="Добавить" onmousedown="CheckQueryType('add')">
                <input type="submit" name="show" value="Показать" onmousedown="CheckQueryType('show')">
            </form>
        </div>
        <iframe name="result" class="content">
            тут резалт
        </iframe>
    </div>
</body>
</html>
