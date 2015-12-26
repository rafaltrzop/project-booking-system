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
        mysql_query("DELETE FROM Projekt WHERE nr_projektu = $project_number") or die(mysql_error());
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany temat projektu został usunięty (ID'.$project_number.').</p>';
      }

      ?>
      <form action="/admin/delete/index.php#Usun_temat_projektu" method="post">
        <label>
          <ol>
            <?php

            $result = mysql_query('SELECT * FROM Projekt ORDER BY temat') or die(mysql_error());
            while ($row = mysql_fetch_array($result)) {
              echo '<li>
                      <label>
                        <input type="radio" name="project_number" value="'.$row[0].'" required>&ensp;'.$row[1].'
                      </label>
                    </li>';
            }

            ?>
          </ol>
        </label>

        <button type="submit" class="hollow button">Usuń wybrany temat</button>
      </form>

      <!-- USUWANIE STUDENTA -->
      <h1 id="Usun_studenta">Usuń studenta</h1>
      <?php

      $id_student = trim($_POST['id_student']);

      if (!empty($id_student)) {
        mysql_query("DELETE FROM Osoba WHERE id_osoby = $id_student") or die(mysql_error());
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany student został usunięty (ID'.$id_student.').</p>';
      }

      ?>
      <table border="1">
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

          $result = mysql_query('SELECT imie, nazwisko, email, grupa, id_osoby FROM Student NATURAL JOIN Osoba ORDER BY imie, nazwisko') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
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

      <!-- USUWANIE PROFESORA -->
      <h1 id="Usun_profesora">Usuń profesora</h1>
      <?php

      $id_professor = trim($_POST['id_professor']);

      if (!empty($id_professor)) {
        mysql_query("DELETE FROM Osoba WHERE id_osoby = $id_professor") or die(mysql_error());
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany profesor został usunięty (ID'.$id_professor.').</p>';
      }

      ?>
      <table border="1">
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

          $result = mysql_query('SELECT imie, nazwisko, email, wykladany_przedmiot, id_osoby FROM Profesor NATURAL JOIN Osoba ORDER BY imie, nazwisko') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
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
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>