<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="Opis zawartości strony">
    <title>Skrypt</title>
</head>
<body>
<?php
$host  = 'localhost';
$user  = 'root';
$haslo = '';
$baza  = 'baza_testowa';

$id_conn = mysqli_connect($host, $user, $haslo, $baza);


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

if (mysqli_connect_errno())
{
    echo "Błąd połączenia z MySQL z bazą: " . $baza . ' (' . mysqli_connect_error() . ')';
    exit;
}

$sql_ins = "INSERT INTO emp (id, first_name, last_name, userid, title, dept_id, 
                                     salary, start_date, manager_id, comments) 
                    VALUES (Null, '$imi','$naz','$uid','$tit','$did', 
                            '$sal', '$sdt','$mid', '$uwa' );
		   ";
if (!mysqli_query($id_conn, $sql_ins))
{
    echo '<br>Błąd zapisu do bazy:' . mysqli_error($id_conn) . '<br><br>';
    $sql_tit = "SELECT name FROM title;";
    $wyn_tit = mysqli_query($id_conn, $sql_tit);
    if (mysqli_error($id_conn)) {
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

    $sql_dept = "SELECT dept.id AS id, dept.name AS deptName, region.name AS regionName FROM dept JOIN region ON region.id = dept.region_id;";
    $wyn_dept = mysqli_query($id_conn, $sql_dept);
    if (!$wyn_dept || mysqli_error($id_conn)) {
        echo "Błąd w zapytaniu o departamenty: " . $baza . '(' . mysqli_error($id_conn) . ')';
        mysqli_close($id_conn);
        exit;
    }

    $ok_dept = 0;
    $depts = '';
    while ($w_dept = mysqli_fetch_array($wyn_dept)) {
        if ($w_dept['id'] == $did) {
            $ok_dept = 1;
        }
        $depts .= ', <br> -' . $w_dept['id']. ' | ' . $w_dept['deptName']. ' | ' . $w_dept['regionName'];
    }

    if ($ok_dept == 0) {
        echo 'Nie ma departamentu "' . $did . '", wybierz jedno z poniższych: ';
        echo '<br>' . substr($depts, 6);
    }

    $sql_mgr = "SELECT DISTINCT  prac.manager_id, szef.last_name, szef.first_name FROM emp AS prac LEFT OUTER JOIN emp AS szef ON prac.manager_id = szef.id ";
    $wyn_mgr = mysqli_query($id_conn, $sql_mgr);
    if (!$wyn_mgr || mysqli_error($id_conn)) {
        echo "Błąd w zapytaniu o Managera: " . $baza . '(' . mysqli_error($id_conn) . ')';
        mysqli_close($id_conn);
        exit;
    }

    $ok_mgr = 0;
    $mgrs = '';
    while ($w_mgr = mysqli_fetch_array($wyn_mgr)) {
        if ($w_mgr['id'] == $mid) {
            $ok_mgr = 1;
        }
        $mgrs .= ', <br> -' . $w_mgr['manager_id'] . ", " . $w_mgr['last_name'];
    }

    if ($ok_mgr == 0) {
        echo 'Nie ma menadżera "' . $mid . '", wybierz jeden z poniższych: ';
        echo '<br>' . substr($mgrs, 6);
    }




    mysqli_close($id_conn);  # zamyka połączenie z bazą
    exit;
}
mysqli_close($id_conn);
?>
</body>
</html>