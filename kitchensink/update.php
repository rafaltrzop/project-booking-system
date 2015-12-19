<?php include('connection.php'); ?>

<!-- OCENIANIE ODDANYCH PROJEKTÓW -->
<?php

$mark = trim($_POST['mark']);
$id_proffesor = trim($_POST['id_proffesor']);
$id_student = trim($_POST['id_student']);

if (!empty($mark) && !empty($id_student) && !empty($id_proffesor)) {
  mysql_query("UPDATE Wykonany_projekt SET ocena = $mark, id_osoby_profesor = $id_proffesor WHERE id_osoby_student = $id_student") or die(mysql_error());
}

?>

<h1>Oceń wykonane projekty</h1>
<table border="1">
  <tr>
    <th>Autor</th>
    <th>Temat projektu</th>
    <th>Data oddania</th>
    <th>Oceniający</th>
    <th>Ocena</th>
    <th>Zmień ocenę</th>
  </tr>
  <?php

  $result1 = mysql_query("SELECT os.imie, os.nazwisko, p.temat, wp.data_oddania, op.imie, op.nazwisko, wp.ocena, wp.id_osoby_student
                          FROM Wykonany_projekt wp LEFT JOIN Student s ON wp.id_osoby_student = s.id_osoby
                          LEFT JOIN Osoba os ON s.id_osoby = os.id_osoby
                          LEFT JOIN Projekt p ON s.nr_projektu = p.nr_projektu
                          LEFT JOIN Osoba op ON wp.id_osoby_profesor = op.id_osoby
                          ORDER BY data_oddania DESC") or die(mysql_error());
  $result2 = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Profesor") or die(mysql_error());
  while ($row1 = mysql_fetch_array($result1)) {
    echo '<tr>
            <td>'.$row1[0].' '.$row1[1].'</td>
            <td>'.$row1[2].'</td>
            <td>'.$row1[3].'</td>
            <td>'.$row1[4].' '.$row1[5].'</td>
            <td>'.$row1[6].'</td>
            <td>
              <form action="" method="post" id="rate_project">
                <select name="id_proffesor" required>
                  <option';
                  if (empty($id_proffesor)) echo ' selected';
                  echo ' disabled hidden>&mdash;</option>

                  <optgroup label="Oceniający">';
                  while ($row2 = mysql_fetch_array($result2)) {
                    echo '<option value="'.$row2[0].'"';
                    if ($id_proffesor == $row2[0]) echo ' selected';
                    echo '>'.$row2[1].' '.$row2[2].'</option>';
                  }

            echo '</optgroup>
                </select>

                <select name="mark" required>
                  <option selected disabled hidden>&mdash;</option>
                  <optgroup label="Ocena">
                    <option value="2.0">2.0</option>
                    <option value="2.5">2.5</option>
                    <option value="3.0">3.0</option>
                    <option value="3.5">3.5</option>
                    <option value="4.0">4.0</option>
                    <option value="4.5">4.5</option>
                    <option value="5.0">5.0</option>
                  </optgroup>
                </select>
                <input type="hidden" name="id_student" value="'.$row1[7].'">
                <input type="submit" value="Aktualizuj">
            </form>
            </td>
          </tr>';
    mysql_data_seek($result2, 0);
  }

  ?>
</table>