<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <!-- DODAWANIE PROJEKTU -->
      <h1>Dodaj nowy temat projektu</h1>
      <form action="" method="post">
        <label>
          Temat projektu:
          <input type="text" name="project_name" required>
        </label>
        <?php

        $project_name = trim($_POST['project_name']);

        if (!empty($project_name)) {
          mysql_query("INSERT INTO Projekt(temat) VALUES('$project_name')") or die(mysql_error());
          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano temat: '.$project_name.'.</p>';
        }

        ?>
        <button type="submit" class="hollow button">Dodaj temat</button>
      </form>

      <!-- DODAWANIE STUDENTA -->
      <?php

      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $group = trim($_POST['group']);

      ?>

      <h1>Dodaj nowego studenta</h1>
      <form action="" method="post">
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
            <option value selected></option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
          </select>
        </label>

        <?php

        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($group)) {
          mysql_query("INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysql_error());

          $id_osoby = mysql_insert_id();
          mysql_query("INSERT INTO Student(id_osoby, grupa) VALUES($id_osoby, $group)") or die(mysql_error());

          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano studenta: '.$first_name.' '.$last_name.'.</p>';
        }

        ?>
        <button type="submit" class="hollow button">Dodaj studenta</button>
      </form>

      <!-- DODAWANIE PROFESORA -->
      <?php

      $first_name = trim($_POST['first_name']);
      $last_name = trim($_POST['last_name']);
      $email = trim($_POST['email']);
      $school_subject = trim($_POST['school_subject']);

      ?>

      <h1>Dodaj nowego profesora</h1>
      <form action="" method="post">
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

        <?php

        if (!empty($first_name) && !empty($last_name) && !empty($email) && !empty($school_subject)) {
          mysql_query("INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysql_error());

          $id_osoby = mysql_insert_id();
          mysql_query("INSERT INTO Profesor VALUES($id_osoby, '$school_subject')") or die(mysql_error());

          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Dodano profesora: '.$first_name.' '.$last_name.'.</p>';
        }

        ?>
        <button type="submit" class="hollow button">Dodaj profesora</button>
      </form>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>