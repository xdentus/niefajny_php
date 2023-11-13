<!doctype html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Formularz</title>
</head>
<body>
<h3>Pracownicy</h3>

<table cellspacing="0" cellpadding="0" border="0" style="width: 26%;" align="Left">
    <tbody align="Left">
    <form action='ins_prac.php' method='post'>
        <tr><td width="160">Nazwisko:</td><td><input type='text' name='nazwisko' ></td></tr>
        <tr><td>Imię:       </td><td><input type='text' name='imie'     ></td></tr>
        <tr><td>Użytkownik: </td><td><input type='text' name='userid'   ></td></tr>
        <tr><td>Stanowisko: </td><td>
			<?php

                ini_set('display_errors', '0');

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
                if (mysqli_errno($id_conn))
                {
                    echo "Błąd w zapytania o stanowiska: " . $baza . ' (' . mysqli_error($id_conn) . ')';
                    mysqli_close($id_conn);
                    exit;
                }
                $sql_dept = "SELECT dept.id, region.name FROM dept JOIN region ON region.id = dept.region_id;";
                $wyn_dept = mysqli_query($id_conn, $sql_dept);
                if (mysqli_errno($id_conn))
                {
                    echo "Błąd w zapytania o stanowiska: " . $baza . ' (' . mysqli_error($id_conn) . ')';
                    mysqli_close($id_conn);
                    exit;
                }
                ?>
                <select id="Stanowiska" name="title">
                    <?php $tit = '';
                    $w_tit = mysqli_fetch_array($wyn_tit);
                    $title = $w_tit['name'];
                    ?>
                    <option value=<?php printf("%s", "'" . $title . "'"); ?> selected><?php printf("%s", $title); ?></option>
                    <?php
                    while ($w_tit = mysqli_fetch_array($wyn_tit))
                    {
                        $title = $w_tit['name'];
                        ?>
                        <option value=<?php printf("%s", "'" . $title . "'"); ?>><?php printf("%s", $title); ?></option>
                        <?php
                    }
                    ?>
                </select>
            </td></tr>
        <tr><td>Departament:</td><td>    		<select id="Stanowiska" name="dept">
                    <?php $dept = '';
                    $w_dept = mysqli_fetch_array($wyn_dept);
                    $deptle = $w_dept['id'];
                    ?>
                    <option value=<?php printf("%s", "'" . $dept . "'"); ?> selected><?php printf("%s", $deptle); ?></option>
                    <?php
                    while ($w_dept = mysqli_fetch_array($wyn_dept))
                    {
                        $deptle = $w_dept['id'];
                        ?>
                        <option value=<?php printf("%s", "'" . $deptle . "'"); ?>><?php printf("%s", $deptle); ?></option>
                        <?php
                    }
                    ?>
                </select> </td></tr>
        <tr><td>Zarobki:    </td><td><input type='text' name='salary'   ></td></tr>
        <tr><td>Data:       </td><td><input type='text' name='start_dt' ></td></tr>
        <tr><td>ID managera:</td><td><input type='text' name='man_id'   ></td></tr>
        <tr><td>Uwagi:      </td><td><input type='text' name='uwagi'    ></td></tr>
        <tr><td><p><input type='submit' value='Wyślij'></td></tr>
    </form>
    </tbody>
</table>
</body>
</html>