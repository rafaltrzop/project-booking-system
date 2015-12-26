<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <!-- EDYCJA TEMATU PROJEKTU -->
      <h1 id="Edytuj_temat_projektu">Edytuj temat projektu</h1>
      <?php

      $project_number = trim($_POST['project_number']);
      $project_name = trim($_POST['project_name']);

      if (!empty($project_number) && !empty($project_name)) {
        mysql_query("UPDATE Projekt SET temat = '$project_name' WHERE nr_projektu = $project_number") or die(mysql_error());
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zmieniono nazwę tematu projektu na: '.$project_name.'.</p>';
      }

      ?>
      <table border="1">
        <thead>
          <tr>
            <th>Temat projektu</th>
            <th class="text-center">Opcje</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Projekt ORDER BY temat') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo '<tr>
                    <td>'.$row[1].'</td>
                    <td>
                      <a href="/admin/edit/project.php?id='.$row[0].'" class="hollow button">Edytuj temat</a>
                    </td>
                  </tr>';
          }

          ?>
        </tbody>
      </table>

      <!-- EDYCJA STUDENTA -->
      <h1 id="Edytuj_studenta">Edytuj studenta</h1>
      <?php

      $id_student = trim($_POST['id_student']);
      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $group = trim($_POST['group']);

      if (!empty($id_student) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($group)) {
        mysql_query("UPDATE Osoba SET email = '$email', imie = '$first_name', nazwisko = '$last_name' WHERE id_osoby = $id_student") or die(mysql_error());
        mysql_query("UPDATE Student SET grupa = $group WHERE id_osoby = $id_student") or die(mysql_error());

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zaktualizowano dane studenta: '.$first_name.' '.$last_name.'.</p>';
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
                      <a href="/admin/edit/student.php?id='.$row[4].'" class="hollow button">Edytuj studenta</a>
                    </td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>

      <!-- EDYCJA PROFESORA -->
      <h1 id="Edytuj_profesora">Edytuj profesora</h1>
      <?php

      $id_professor = trim($_POST['id_professor']);
      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $school_subject = trim($_POST['school_subject']);

      if (!empty($id_professor) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($school_subject)) {
        mysql_query("UPDATE Osoba SET email = '$email', imie = '$first_name', nazwisko = '$last_name' WHERE id_osoby = $id_professor") or die(mysql_error());
        mysql_query("UPDATE Profesor SET wykladany_przedmiot = '$school_subject' WHERE id_osoby = $id_professor") or die(mysql_error());

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zaktualizowano dane profesora: '.$first_name.' '.$last_name.'.</p>';
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
                      <a href="/admin/edit/professor.php?id='.$row[4].'" class="hollow button">Edytuj profesora</a>
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