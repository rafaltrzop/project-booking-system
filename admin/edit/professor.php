<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="column row">
    <?php

    $id_professor = (int) trim($_GET['id']);

    $result = mysqli_query($link, "SELECT imie, nazwisko, email, wykladany_przedmiot FROM Osoba NATURAL JOIN Profesor WHERE id_osoby = $id_professor") or die(mysqli_error($link));
    $row = mysqli_fetch_array($result);

    ?>
    <h1>Edycja profesora</h1>
    <form action="/admin/edit/index.php#Edytuj_profesora" method="post">
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
        Wykładany przedmiot:
        <input type="text" name="school_subject" value="<?= $row[3] ?>" required>
      </label>

      <input type="hidden" name="id_professor" value="<?= $id_professor ?>" required>

      <button type="submit" class="hollow button">Zapisz zmiany</button>
      <button type="button" class="hollow button" onclick="history.back();">Anuluj</button>
    </form>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>