<?php include('connection.php'); ?>

<!-- DODAWANIE STUDENTA -->
<?php

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$group = trim($_POST['group']);

?>

<h1>Dodaj nowego studenta</h1>
<form action="" method="post">
  <fieldset>
    <legend>Dodaj studenta</legend>
    <label>
      Imię:<br>
      <input type="text" name="first_name" placeholder="Jan" value="<?= $first_name ?>">
    </label>

    <br>
    <br>

    <label>
      Nazwisko:<br>
      <input type="text" name="last_name" placeholder="Kowalski" value="<?= $last_name ?>">
    </label>

    <br>
    <br>

    <label>
      E-mail:<br>
      <input type="email" name="email" placeholder="email@domena.pl" value="<?= $email ?>">
    </label>

    <br>
    <br>

    <label>
      Grupa:<br>
      <select name="group">
        <option <?php if (empty($group)) echo 'selected' ?> disabled>&mdash;</option>
        <option value="1" <?php if ($group == 1) echo 'selected' ?>>1</option>
        <option value="2" <?php if ($group == 2) echo 'selected' ?>>2</option>
        <option value="3" <?php if ($group == 3) echo 'selected' ?>>3</option>
      </select>
    </label>
  </fieldset>

  <input type="submit" value="Dodaj studenta">
</form>

<?php

if (empty($first_name) || empty($last_name) || empty($email) || empty($group)) {
  echo 'Błąd! Zmienna jest pusta.';
} else {
  mysql_query("INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysql_error());
  $id_osoby = mysql_insert_id();

  mysql_query("INSERT INTO Student(id_osoby, grupa) VALUES($id_osoby, $group)") or die(mysql_error());
  echo "Dodano studenta: $first_name $last_name";
}

?>

<!-- DODAWANIE PROFESORA -->
<?php

$first_name = trim($_POST['first_name']);
$last_name = trim($_POST['last_name']);
$email = trim($_POST['email']);
$school_subject = trim($_POST['school_subject']);

?>

<h1>Dodaj nowego profesora</h1>
<form action="" method="post">
  <fieldset>
    <legend>Dodaj profesora</legend>
    <label>
      Imię:<br>
      <input type="text" name="first_name" placeholder="Jan" value="<?= $first_name ?>">
    </label>

    <br>
    <br>

    <label>
      Nazwisko:<br>
      <input type="text" name="last_name" placeholder="Kowalski" value="<?= $last_name ?>">
    </label>

    <br>
    <br>

    <label>
      E-mail:<br>
      <input type="email" name="email" placeholder="email@domena.pl" value="<?= $email ?>">
    </label>

    <br>
    <br>

    <label>
      Wykładany przedmiot:<br>
      <input type="text" name="school_subject" value="<?= $school_subject ?>">
    </label>
  </fieldset>

  <input type="submit" value="Dodaj profesora">
</form>

<?php

if (empty($first_name) || empty($last_name) || empty($email) || empty($school_subject)) {
  echo 'Błąd! Zmienna jest pusta.';
} else {
  mysql_query("INSERT INTO Osoba(email, imie, nazwisko) VALUES('$email', '$first_name', '$last_name')") or die(mysql_error());
  $id_osoby = mysql_insert_id();
  mysql_query("INSERT INTO Profesor VALUES($id_osoby, '$school_subject')") or die(mysql_error());
  echo "Dodano profesora: $first_name $last_name";
}

?>

<!-- DODAWANIE PROJEKTU -->
<h1>Dodaj nowy temat projektu</h1>
<form action="" method="post">
  <label>
    Temat projektu:<br>
    <input type="text" name="project_name" required>
  </label>
  <input type="submit" value="Dodaj projekt">
</form>

<?php

$project_name = trim($_POST['project_name']);

if (empty($project_name)) {
  echo 'Błąd! Zmienna jest pusta.';
} else {
  mysql_query("INSERT INTO Projekt(temat) VALUES('$project_name')") or die(mysql_error());
  echo "Dodano projekt: $project_name";
}

?>

<!-- REZERWOWANIE PROJEKTU -->
<?php

$id_student = trim($_POST['id_student']);
$project_number = trim($_POST['project_number']);

?>

<h1>Zarezerwuj temat projektu</h1>
<form action="" method="post">
  <fieldset>
    <legend>Zarezerwuj temat</legend>
    <label>
      Wybierz swoje nazwisko:<br>
      <select name="id_student">
        <option selected disabled>&mdash;</option>
        <?php

        $result = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student") or die(mysql_error());
        while ($row = mysql_fetch_array($result)) {
          echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
        }

        ?>
      </select>
    </label>

    <br>
    <br>

    <label>
      Wybierz temat z listy:<br>
      <ol>
      <?php

      $result = mysql_query('SELECT * FROM Projekt') or die(mysql_error());
      while ($row = mysql_fetch_array($result)) {
        echo '<li>
                <label>
                  <input type="radio" name="project_number" value="'.$row[0].'">
                  '.$row[1].'
                </label>
              </li>';
      }

      ?>
      </ol>
    </label>
  </fieldset>
  <input type="submit" value="Zarezerwuj wybrany temat">
</form>

<?php

if (empty($id_student) || empty($project_number)) {
  echo 'Błąd! Zmienna jest pusta.';
} else {
  mysql_query("UPDATE Student SET nr_projektu = $project_number WHERE id_osoby = $id_student") or die(mysql_error());
  echo "Wybrany projekt został przez Ciebie zarezerwowany.";
}

?>

<!-- ZGŁASZANIE WYKONANIA PROJEKTU -->
<?php

$id_student = trim($_POST['id_student']);
$submission_date = trim($_POST['submission_date']);

?>

<h1>Zgłoś wykonanie projektu</h1>
<form action="" method="post" onsubmit="return confirm('Czy aby na pewno chcesz zgłosić swój projekt do oceny?');">
  <label>
    Wybierz swoje nazwisko:<br>
    <select name="id_student">
      <option selected disabled>&mdash;</option>
      <?php

      $result = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student") or die(mysql_error());
      while ($row = mysql_fetch_array($result)) {
        echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
      }

      ?>
    </select>
  </label>

  <input type="hidden" name="submission_date" value="<?= date('Y-m-d') ?>">
  <input type="submit" value="Zgłoś projekt do oceny">
</form>

<?php

if (empty($id_student) || empty($submission_date)) {
  echo 'Błąd! Zmienna jest pusta.';
} else {
  mysql_query("INSERT INTO Wykonany_projekt(id_osoby_student, data_oddania) VALUES('$id_student', '$submission_date')") or die(mysql_error());
  echo "Twój projekt został oznaczony jako wykonany i zgłoszony do oceny.";
}

?>