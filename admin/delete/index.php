<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <!-- USUWANIE PROJEKTU -->
      <h1 id="Usun_temat_projektu">Usuń temat projektu</h1>
      <?php

      $project_number = trim($_POST['project_number']);

      if (!empty($project_number)) {
        // wykonuję zapytanie przed wyświetleniem listy tematów aby była ona aktualna po wysłaniu formularza
        // (nie chcę aby na liście projektów znowu pojawił się temat który dopiero co usunąłem)
        mysqli_query($link, "DELETE FROM Projekt WHERE nr_projektu = $project_number") or die(mysqli_error($link));
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany temat projektu został usunięty (ID'.$project_number.').</p>';
      }

      $result = mysqli_query($link, 'SELECT * FROM Projekt ORDER BY temat') or die(mysqli_error($link));
      $row_count = mysqli_num_rows($result);

      if ($row_count == 0):

      ?>
      <p>W systemie nie ma ani jednego tematu projektu &mdash; dodaj nowy temat.</p>
      <?php else: ?>
      <form action="/admin/delete/index.php#Usun_temat_projektu" method="post">
        <ol>
          <?php

          while ($row = mysqli_fetch_array($result)) {
            echo '<li>
                    <label>
                      <input type="radio" name="project_number" value="'.$row[0].'" required>&ensp;'.$row[1].'
                    </label>
                  </li>';
          }

          ?>
        </ol>

        <button type="submit" class="hollow button">Usuń wybrany temat</button>
      </form>
      <?php endif; ?>

      <!-- USUWANIE STUDENTA -->
      <h1 id="Usun_studenta">Usuń studenta</h1>
      <?php

      $id_student = trim($_POST['id_student']);

      if (!empty($id_student)) {
        mysqli_query($link, "DELETE FROM Osoba WHERE id_osoby = $id_student") or die(mysqli_error($link));
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany student został usunięty (ID'.$id_student.').</p>';
      }

      $result = mysqli_query($link, 'SELECT imie, nazwisko, email, grupa, id_osoby FROM Student NATURAL JOIN Osoba ORDER BY imie, nazwisko') or die(mysqli_error($link));
      $row_count = mysqli_num_rows($result);

      if ($row_count == 0):

      ?>
      <p>W systemie nie ma ani jednego studenta &mdash; dodaj nowego studenta.</p>
      <?php else: ?>
      <table class="scroll">
        <thead>
          <tr>
            <th>Imię i nazwisko</th>
            <th>E-mail</th>
            <th>Grupa</th>
            <th class="text-center">Opcje</th>
          </tr>
        </thead>
        <tbody>
          <?php

          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>
                    <td>'.$row[0].' '.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td class="text-center">'.$row[3].'</td>
                    <td>
                      <form action="/admin/delete/index.php#Usun_studenta" method="post">
                        <input type="hidden" name="id_student" value="'.$row[4].'">
                        <button type="submit" class="hollow button">Usuń studenta</button>
                      </form>
                    </td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>
      <?php endif; ?>

      <!-- USUWANIE PROFESORA -->
      <h1 id="Usun_profesora">Usuń profesora</h1>
      <?php

      $id_professor = trim($_POST['id_professor']);

      if (!empty($id_professor)) {
        mysqli_query($link, "DELETE FROM Osoba WHERE id_osoby = $id_professor") or die(mysqli_error($link));
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany profesor został usunięty (ID'.$id_professor.').</p>';
      }

      $result = mysqli_query($link, 'SELECT imie, nazwisko, email, wykladany_przedmiot, id_osoby FROM Profesor NATURAL JOIN Osoba ORDER BY imie, nazwisko') or die(mysqli_error($link));
      $row_count = mysqli_num_rows($result);

      if ($row_count == 0):

      ?>
      <p>W systemie nie ma ani jednego profesora &mdash; dodaj nowego profesora.</p>
      <?php else: ?>
      <table class="scroll">
        <thead>
          <tr>
            <th>Imię i nazwisko</th>
            <th>E-mail</th>
            <th>Wykładany przedmiot</th>
            <th class="text-center">Opcje</th>
          </tr>
        </thead>
        <tbody>
          <?php

          while ($row = mysqli_fetch_array($result)) {
            echo '<tr>
                    <td>'.$row[0].' '.$row[1].'</td>
                    <td>'.$row[2].'</td>
                    <td>'.$row[3].'</td>
                    <td>
                      <form action="/admin/delete/index.php#Usun_profesora" method="post">
                        <input type="hidden" name="id_professor" value="'.$row[4].'">
                        <button type="submit" class="hollow button">Usuń profesora</button>
                      </form>
                    </td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>
      <?php endif; ?>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>