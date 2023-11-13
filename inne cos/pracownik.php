<!DOCTYPE html>
<html lang="pl">
  <head>
    <meta charset="utf-8" />
    <title>Formularz</title>
  </head>
  <body>
    <h3>Pracownicy</h3>
    <table>
      <tbody>
        <form action="ins_prac.php" method="post">
          <tr>
            <td>Nazwisko:</td>
            <td><input type="text" name="nazwisko" required /></td>
          </tr>
          <tr>
            <td>Imię:</td>
            <td><input type="text" name="imie" required /></td>
          </tr>
          <tr>
            <td>Użytkownik:</td>
            <td><input type="text" name="userid" /></td>
          </tr>
          <tr>
            <td>Stanowisko:</td>
            <td><select name="stanowisko" id="title">
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

                $sql_tit = "SELECT name FROM title;";
                $wyn_tit = mysqli_query($id_conn, $sql_tit);
                while($w_dept=mysqli_fetch_array($wyn_dept)) {
                  
                }
              ?>
            </select></td>
          </tr>
          <tr>
            <td>Departament:</td>
            <td><input type="text" name="dept_id" /></td>
          </tr>
          <tr>
            <td>Zarobki:</td>
            <td><input type="text" name="salary" /></td>
          </tr>
          <tr>
            <td>Data:</td>
            <td><input type="text" name="start_dt" /></td>
          </tr>
          <tr>
            <td>ID managera:</td>
            <td><input type="text" name="man_id" /></td>
          </tr>
          <tr>
            <td>Uwagi:</td>
            <td><input type="text" name="uwagi" /></td>
          </tr>
          <tr>
            <td>
              <p><input type="submit" value="Wyślij" /></p>
            </td>
          </tr>
        </form>
      </tbody>
    </table>
  </body>
</html>
