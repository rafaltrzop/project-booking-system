<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="column row">
    <!-- OCEŃ WYKONANE PROJEKTY -->
    <h1 id="Ocen_wykonane_projekty">Oceń wykonane projekty</h1>
    <?php

    $mark_without_id_proffesor = FALSE;
    $project_data_updated = FALSE;
    $mark = trim($_POST['mark']);
    $id_proffesor = trim($_POST['id_proffesor']);
    $id_student = trim($_POST['id_student']);

    if (!empty($mark) && !empty($id_student) && !empty($id_proffesor)) {
      if ($mark != 'NULL' && $id_proffesor == 'NULL') {
        $mark_without_id_proffesor = TRUE;
      } else {
        mysqli_query($link, "UPDATE Wykonany_projekt SET ocena = $mark, id_osoby_profesor = $id_proffesor WHERE id_osoby_student = $id_student") or die(mysqli_error($link));
        $project_data_updated = TRUE;
      }
    }

    $result1 = mysqli_query($link, "SELECT wp.data_oddania, os.imie, os.nazwisko, p.temat, op.imie, op.nazwisko, wp.ocena, wp.id_osoby_student
                                    FROM Wykonany_projekt wp LEFT JOIN Student s ON wp.id_osoby_student = s.id_osoby
                                    LEFT JOIN Osoba os ON s.id_osoby = os.id_osoby
                                    LEFT JOIN Projekt p ON s.nr_projektu = p.nr_projektu
                                    LEFT JOIN Osoba op ON wp.id_osoby_profesor = op.id_osoby
                                    ORDER BY data_oddania DESC") or die(mysqli_error($link));
    $result2 = mysqli_query($link, "SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Profesor") or die(mysqli_error($link));
    $row_count = mysqli_num_rows($result1);

    if ($row_count == 0):

    ?>
    <p>Żaden ze studentów nie zgłosił swojego projektu do oceny &mdash; sprawdź ponownie później.</p>
    <?php else: ?>
    <p>Aby podzielić pracę oceniania między kilku profesorów wystarczy przypisać danemu projektowi oceniającego bez wybierania oceny.</p>
    <table class="scroll">
      <thead>
        <tr>
          <th>Data</th>
          <th>Autor</th>
          <th>Temat projektu</th>
          <th>Oceniający</th>
          <th>Ocena</th>
          <th class="text-center">Zmień ocenę</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($row1 = mysqli_fetch_array($result1)) {
          echo '<tr>
                  <td>'.$row1[0].'</td>
                  <td>'.$row1[1].' '.$row1[2].'</td>
                  <td>'.$row1[3].'</td>
                  <td>'.$row1[4].' '.$row1[5].'</td>
                  <td class="text-center">'.$row1[6].'</td>
                  <td>
                    <form action="/admin/index.php#Ocen_wykonane_projekty" method="post">
                      <select name="id_proffesor" required>
                        <option value';
                        if (empty($id_proffesor)) echo ' selected';
                        echo '>&nbsp;</option>
                        <option value="NULL">Usuń</option>

                        <optgroup label="Oceniający">';
                          while ($row2 = mysqli_fetch_array($result2)) {
                            echo '<option value="'.$row2[0].'"';
                            if ($id_proffesor == $row2[0]) echo ' selected';
                            echo '>'.$row2[1].' '.$row2[2].'</option>';
                          }
                        echo '</optgroup>
                      </select>

                      <select name="mark" required>
                        <option value selected>&nbsp;</option>
                        <option value="NULL">Usuń</option>
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
                      <button type="submit" class="hollow button">OK</button>';
                      if ($id_student == $row1[7]) {
                        if ($project_data_updated) {
                          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zaktualizowano dane.</p>';
                        }
                        if ($mark_without_id_proffesor) {
                          echo '<p><span class="fa fa-times fa-error"></span>&ensp;Musisz wybrać oceniającego.</p>';
                        }
                      }
                    echo '</form>
                  </td>
                </tr>';
          mysqli_data_seek($result2, 0);
        }

        ?>
      </tbody>
    </table>
    <?php endif; ?>

    <!-- STAN REZERWACJI PROJEKTÓW -->
    <h1>Stan rezerwacji projektów</h1>
    <?php

    $result = mysqli_query($link, 'SELECT imie, nazwisko, email, grupa, temat FROM Student s LEFT JOIN Osoba o ON s.id_osoby = o.id_osoby LEFT JOIN Projekt p ON s.nr_projektu = p.nr_projektu ORDER BY imie, nazwisko') or die(mysqli_error($link));
    $row_count = mysqli_num_rows($result);

    if ($row_count == 0):

    ?>
    <p>W systemie nie ma ani jednego studenta &mdash; dodaj nowego studenta i tematy projektów.</p>
    <?php else: ?>
    <table class="scroll">
      <thead>
        <tr>
          <th>Student</th>
          <th>E-mail</th>
          <th class="text-center">Grupa</th>
          <th>Temat projektu</th>
        </tr>
      </thead>
      <tbody>
        <?php

        while ($row = mysqli_fetch_array($result)) {
          echo '<tr>
                  <td>'.$row[0].' '.$row[1].'</td>
                  <td>'.$row[2].'</td>
                  <td class="text-center">'.$row[3].'</td>
                  <td>'.$row[4].'</td>
                </tr>';
        }

        ?>
      </tbody>
    </table>
    <?php endif; ?>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>