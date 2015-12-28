<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="column row">
    <?php

    $project_number = (int) trim($_GET['id']);

    $result = mysqli_query($link, "SELECT temat FROM Projekt WHERE nr_projektu = $project_number") or die(mysqli_error($link));
    $row = mysqli_fetch_array($result);

    ?>
    <h1>Edycja tematu projektu</h1>
    <form action="/admin/edit/index.php#Edytuj_temat_projektu" method="post">
      <label>
        Temat projektu:
        <input type="hidden" name="project_number" value="<?= $project_number ?>" required>
        <input type="text" name="project_name" value="<?= $row[0] ?>" required>
      </label>

      <button type="submit" class="hollow button">Zapisz zmiany</button>
      <button type="button" class="hollow button" onclick="history.back();">Anuluj</button>
    </form>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>