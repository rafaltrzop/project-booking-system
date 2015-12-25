<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="column row">
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
      <thead>
        <tr>
          <th>Data oddania</th>
          <th>Autor</th>
          <th>Temat projektu</th>
          <th>Oceniający</th>
          <th>Ocena</th>
          <th class="text-center">Zmień ocenę</th>
        </tr>
      </thead>
      <tbody>
        <?php

        $result1 = mysql_query("SELECT wp.data_oddania, os.imie, os.nazwisko, p.temat, op.imie, op.nazwisko, wp.ocena, wp.id_osoby_student
                                FROM Wykonany_projekt wp LEFT JOIN Student s ON wp.id_osoby_student = s.id_osoby
                                LEFT JOIN Osoba os ON s.id_osoby = os.id_osoby
                                LEFT JOIN Projekt p ON s.nr_projektu = p.nr_projektu
                                LEFT JOIN Osoba op ON wp.id_osoby_profesor = op.id_osoby
                                ORDER BY data_oddania DESC") or die(mysql_error());
        $result2 = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Profesor") or die(mysql_error());
        while ($row1 = mysql_fetch_array($result1)) {
          echo '<tr>
            <td class="text-center">'.$row1[0].'</td>
            <td>'.$row1[1].' '.$row1[2].'</td>
            <td>'.$row1[3].'</td>
            <td>'.$row1[4].' '.$row1[5].'</td>
            <td class="text-center">'.$row1[6].'</td>
            <td>
              <form action="" method="post">
                <select name="id_proffesor" required>
                  <option value';
                  if (empty($id_proffesor)) echo ' selected';
                  echo '></option>

                  <optgroup label="Oceniający">';
                    while ($row2 = mysql_fetch_array($result2)) {
                      echo '<option value="'.$row2[0].'"';
                      if ($id_proffesor == $row2[0]) echo ' selected';
                      echo '>'.$row2[1].' '.$row2[2].'</option>';
                    }
                  echo '</optgroup>
                </select>

                <select name="mark" required>
                  <option value selected></option>
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
                <button type="submit" class="hollow button">Aktualizuj</button>
              </form>
            </td>
          </tr>';
          mysql_data_seek($result2, 0);
        }

        ?>
      </tbody>
    </table>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>