<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Opis zawartości strony">
  	<title>Skrypt</title>
</head>
<body>
    <?php

  	$naz=$_POST['nazwisko'];
	$imi=$_POST['imie'];
	$uid=$_POST['userid'];
	$tit=$_POST['title'];
	$did=$_POST['dept_id'];
  	$sal=$_POST['salary'];
	$sdt=$_POST['start_dt'];
	$mid=$_POST['man_id'];
	$uwa=$_POST['uwagi'];

        echo '    Nazwisko: ' . $naz . '<br>';
        echo '        Imię: ' . $imi . '<br>';
        echo '  Użytkownik: ' . $uid . '<br>';
        echo '  Stanowisko: ' . $tit . '<br>';
        echo ' Departament: ' . $did . '<br>';
        echo '     Zarobki: ' . $sal . '<br>';
        echo '        Data: ' . $sdt . '<br>';
        echo '     Manager: ' . $mid . '<br>';
        echo '       Uwagi: ' . $uwa . '<br>';

        ini_set('display_errors', '0');
        mysqli_report(MYSQLI_REPORT_ERROR);

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

        $sql_tit = "SELECT name FROM title;";
        $wyn_tit = mysqli_query($id_conn, $sql_tit);
        if (mysqli_errno($id_conn)) {
            echo "Błąd w zapytaniu o stanowiska: " . $baza . '(' . mysqli_error($id_conn) .')';
            mysqli_close($id_conn);
            exit;
        }

        $ok_tit = 0;
        $titles = '';
        while($w_tit=mysqli_fetch_array($wyn_tit)) {
            if ($w_tit['name'] == $tit) {
                $ok_tit = 1;
            }
            $titles = $titles . ', <br> -' . $w_tit['name'];
        }

        if($ok_tit == 0) {
            echo 'Nie ma stanowiska "' .$tit . '", wybierz jedno z poniższych: ';
            echo '<br>' . substr($titles, 6);
            mysqli_close($id_conn);
            exit;
        }

        $sql_dept = "SELECT name, id FROM dept";
        $wyn_dept = mysqli_query($id_conn, $sql_dept);
        if (mysqli_errno($id_conn)) {
            echo "Błąd w zapytaniu o departament: " . $baza . '(' . mysqli_error($id_conn) . ')';
            mysqli_close($id_conn);
            exit;
        }

        $ok_dept = 0;
        $depts = '';
        while($w_dept=mysqli_fetch_array($wyn_dept)) {
            if($w_dept['id'] == $did) {
                $ok_dept = 1;
            }
            $depts = $depts . ', <br> -' . $w_dept['id'] .' ' . $w_dept['name'] . ' ' . $w_dept['region'];
        }

        if($ok_dept == 0) {
            echo 'Nie ma stanowiska "' .$did . '", wybierz jedno z poniższych: ';
            echo '<br>' . substr($depts, 6);
            mysqli_close($id_conn);
            exit;
        }

    $sql_mid = "SELECT first_name, last_name, manager_id FROM emp;";
    $wyn_mid = mysqli_query($id_conn, $sql_mid);
    if (mysqli_errno($id_conn)) {
        echo "Błąd w zapytaniu o managera: " . $baza . '(' . mysqli_error($id_conn) .')';
        mysqli_close($id_conn);
        exit;
    }

    $ok_mid = 0;
    $managers = '';
    while($w_mid=mysqli_fetch_array($wyn_mid)) {
        if ($w_mid['id'] == $mid) {
            $ok_mid = 1;
        }
        $managers = $managers . ', <br> -' . $w_mid['manager_id'] . " " . $w_mid['first_name'] . " " . $w_mid['last_name'];
    }

    if($ok_mid == 0) {
        echo 'Nie ma managera "' .$w_mid['manager_id'] . " " . $w_mid['first_name'] . " " . $w_mid['last_name'] . '", wybierz jednego z poniższych: ';
        echo '<br>' . substr($managers, 6);
        mysqli_close($id_conn);
        exit;
    }

        $sql_ins = "INSERT INTO emp (id, first_name, last_name, userid, title, dept_id, 
                                     salary, start_date, manager_id, comments) 
                    VALUES (Null, '$imi','$naz','$uid','$tit','$did', 
                            '$sal', '$sdt','$mid', '$uwa' );
		   ";
        if (!mysqli_query($id_conn, $sql_ins))
 	{
             echo 'Błąd zapisu do bazy:' . mysqli_error($id_conn);
             mysqli_close($id_conn);  # zamyka połączenie z bazą
             exit;
        }
        mysqli_close($id_conn);
    ?>
</body>
</html>