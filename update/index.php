<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
</head>
<body>

<?php
    $host  = 'localhost';
    $user  = 'root';
    $haslo = '';
    $baza  = 'bazatestowa';

    $id_conn = mysqli_connect($host, $user, $haslo, $baza);
    if (mysqli_connect_errno())
    {
        echo "Błąd połączenia z MySQL z bazą: " . $baza . ' (' . mysqli_connect_error() . ')';
        exit;
    }
?>

<h1>AKTUALIZACJA DANYCH PRACOWNIKÓW</h1>
<hr>
<label for="employee">WYBIERZ PRACOWNIKA</label>
<!--<select name="employee" id="employee">-->
 <?php
    $emp_query = "SELECT last_name, first_name FROM emp ";
    $emp_result = mysqli_query($id_conn, $emp_query);
    for()
 ?>
<!--</select>-->
</body>
</html>
