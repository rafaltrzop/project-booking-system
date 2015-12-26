<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="column row">
    <?php

    $id_student = (int) trim($_GET['id']);

    $result = mysql_query("SELECT imie, nazwisko, email, grupa FROM Osoba NATURAL JOIN Student WHERE id_osoby = $id_student") or die(mysql_error());
    $row = mysql_fetch_array($result);

    ?>
    <h1>Edycja studenta</h1>
    <form action="/admin/edit/index.php#Edytuj_studenta" method="post">
      <label>
        Imię:
        <input type="text" name="first_name" value="<?= $row[0] ?>" required>
      </label>

      <label>
        Nazwisko:
        <input type="text" name="last_name" value="<?= $row[1] ?>"required>
      </label>

      <label>
        E-mail:
        <input type="email" name="email" value="<?= $row[2] ?>" required>
      </label>

      <label>
        Grupa:
        <select name="group" required>
          <option value></option>
          <option value="1"<?php if ($row[3] == 1) echo ' selected' ?>>1</option>
          <option value="2"<?php if ($row[3] == 2) echo ' selected' ?>>2</option>
          <option value="3"<?php if ($row[3] == 3) echo ' selected' ?>>3</option>
        </select>
      </label>

      <input type="hidden" name="id_student" value="<?= $id_student ?>" required>

      <button type="submit" class="hollow button">Zapisz zmiany</button>
      <button type="button" class="hollow button" onclick="history.back();">Anuluj</button>
    </form>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>