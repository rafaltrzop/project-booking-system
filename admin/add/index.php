<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <!-- DODAWANIE PROJEKTU -->
      <h1 id="Dodaj_nowy_temat_projektu">Dodaj nowy temat projektu</h1>
      <?php

      $project_name = trim($_POST['project_name']);

      if (!empty($project_name)) {
        mysqli_query($link, "INSERT INTO Projekt(temat) VALUES('$project_name')") or die(mysqli_error($link));
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano temat: '.$project_name.'.</p>';
      }

      ?>
      <form action="/admin/add/index.php#Dodaj_nowy_temat_projektu" method="post">
        <label>
          Temat projektu:
          <input type="text" name="project_name" required>
        </label>

        <button type="submit" class="hollow button">Dodaj temat</button>
      </form>

      <!-- DODAWANIE STUDENTA -->
      <h1 id="Dodaj_nowego_studenta">Dodaj nowego studenta</h1>
      <?php

      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $group = trim($_POST['group']);

      if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($group)) {
        mysqli_query($link, 'BEGIN') or die(mysqli_error($link));
        mysqli_query($link, "INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysqli_error($link));
        $id_osoby = mysqli_insert_id($link);
        mysqli_query($link, "INSERT INTO Student(id_osoby, grupa) VALUES($id_osoby, $group)") or die(mysqli_error($link));
        mysqli_query($link, 'COMMIT') or die(mysqli_error($link));

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano studenta: '.$first_name.' '.$last_name.'.</p>';
      }

      ?>
      <form action="/admin/add/index.php#Dodaj_nowego_studenta" method="post">
        <label>
          Imię:
          <input type="text" name="first_name" required>
        </label>

        <label>
          Nazwisko:
          <input type="text" name="last_name" required>
        </label>

        <label>
          E-mail:
          <input type="email" name="email" required>
        </label>

        <label>
          Grupa:
          <select name="group" required>
            <option value selected>&nbsp;</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </label>

        <button type="submit" class="hollow button">Dodaj studenta</button>
      </form>

      <!-- DODAWANIE PROFESORA -->
      <h1 id="Dodaj_nowego_profesora">Dodaj nowego profesora</h1>
      <?php

      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $school_subject = trim($_POST['school_subject']);

      if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($school_subject)) {
        mysqli_query($link, 'BEGIN') or die(mysqli_error($link));
        mysqli_query($link, "INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysqli_error($link));
        $id_osoby = mysqli_insert_id($link);
        mysqli_query($link, "INSERT INTO Profesor VALUES($id_osoby, '$school_subject')") or die(mysqli_error($link));
        mysqli_query($link, 'COMMIT') or die(mysqli_error($link));

        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano profesora: '.$first_name.' '.$last_name.'.</p>';
      }

      ?>
      <form action="/admin/add/index.php#Dodaj_nowego_profesora" method="post">
        <label>
          Imię:
          <input type="text" name="first_name" required>
        </label>

        <label>
          Nazwisko:
          <input type="text" name="last_name" required>
        </label>

        <label>
          E-mail:
          <input type="email" name="email" required>
        </label>

        <label>
          Wykładany przedmiot:
          <input type="text" name="school_subject" required>
        </label>

        <button type="submit" class="hollow button">Dodaj profesora</button>
      </form>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>