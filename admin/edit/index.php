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
        mysqli_query($link, "UPDATE Projekt SET temat = '$project_name' WHERE nr_projektu = $project_number") or die(mysqli_error($link));
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zmieniono nazwę tematu projektu na: '.$project_name.'.</p>';
      }

      $result = mysqli_query($link, 'SELECT * FROM Projekt ORDER BY temat') or die(mysqli_error($link));
      $row_count = mysqli_num_rows($result);

      if ($row_count == 0):

      ?>
      <p>W systemie nie ma ani jednego tematu projektu &mdash; dodaj nowy temat.</p>
      <?php else: ?>
      <table class="scroll">
        <thead>
          <tr>
            <th>Temat projektu</th>
            <th class="text-center">Opcje</th>
          </tr>
        </thead>
        <tbody>
          <?php

          while ($row = mysqli_fetch_array($result)) {
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
      <?php endif; ?>

      <!-- EDYCJA STUDENTA -->
      <h1 id="Edytuj_studenta">Edytuj studenta</h1>
      <?php

      $id_student = trim($_POST['id_student']);
      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $group = trim($_POST['group']);

      if (!empty($id_student) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($group)) {
        mysqli_query($link, 'BEGIN') or die(mysqli_error($link));
        mysqli_query($link, "UPDATE Osoba SET email = '$email', imie = '$first_name', nazwisko = '$last_name' WHERE id_osoby = $id_student") or die(mysqli_error($link));
        mysqli_query($link, "UPDATE Student SET grupa = $group WHERE id_osoby = $id_student") or die(mysqli_error($link));
        mysqli_query($link, 'COMMIT') or die(mysqli_error($link));

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zaktualizowano dane studenta: '.$first_name.' '.$last_name.'.</p>';
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
            <th>Student</th>
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
                      <a href="/admin/edit/student.php?id='.$row[4].'" class="hollow button">Edytuj studenta</a>
                    </td>
                  </tr>';
          }
          ?>
        </tbody>
      </table>
      <?php endif; ?>

      <!-- EDYCJA PROFESORA -->
      <h1 id="Edytuj_profesora">Edytuj profesora</h1>
      <?php

      $id_professor = trim($_POST['id_professor']);
      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $school_subject = trim($_POST['school_subject']);

      if (!empty($id_professor) && !empty($first_name) && !empty($last_name) && !empty($email) && !empty($school_subject)) {
        mysqli_query($link, 'BEGIN') or die(mysqli_error($link));
        mysqli_query($link, "UPDATE Osoba SET email = '$email', imie = '$first_name', nazwisko = '$last_name' WHERE id_osoby = $id_professor") or die(mysqli_error($link));
        mysqli_query($link, "UPDATE Profesor SET wykladany_przedmiot = '$school_subject' WHERE id_osoby = $id_professor") or die(mysqli_error($link));
        mysqli_query($link, 'COMMIT') or die(mysqli_error($link));

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zaktualizowano dane profesora: '.$first_name.' '.$last_name.'.</p>';
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
            <th>Profesor</th>
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
                      <a href="/admin/edit/professor.php?id='.$row[4].'" class="hollow button">Edytuj profesora</a>
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