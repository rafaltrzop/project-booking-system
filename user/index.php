<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_user.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <!-- REZERWOWANIE PROJEKTU -->
      <h1 id="Zarezerwuj_temat_projektu">Zarezerwuj temat projektu</h1>
      <?php

      $id_student = trim($_POST['id_student']);
      $project_number = trim($_POST['project_number']);

      if (!empty($id_student) && !empty($project_number)) {
        $result = mysqli_query($link, "SELECT * FROM Student WHERE id_osoby = $id_student AND nr_projektu IS NOT NULL") or die(mysqli_error($link));
        $reserved_already = mysqli_num_rows($result);

        if ($reserved_already) {
          echo '<p><span class="fa fa-times fa-error"></span>&ensp;Zarezerwowałeś już swój temat projektu, nie możesz zrobić tego jeszcze raz.</p>';
        } else {
          mysqli_query($link, "UPDATE Student SET nr_projektu = $project_number WHERE id_osoby = $id_student") or die(mysqli_error($link));
          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Wybrany projekt został przez Ciebie zarezerwowany.</p>';
        }
      }

      ?>
      <form action="/user/index.php#Zarezerwuj_temat_projektu" method="post">
        <label>
          Wybierz swoje nazwisko:
          <select name="id_student" required>
            <option value selected>&nbsp;</option>
            <?php

            $result = mysqli_query($link, "SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student ORDER BY imie, nazwisko") or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
            }

            ?>
          </select>
        </label>

        <label>
          Wybierz temat:
          <ol>
            <?php

            $result = mysqli_query($link, 'SELECT * FROM Projekt ORDER BY temat') or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($result)) {
              echo '<li>
                      <label>
                        <input type="radio" name="project_number" value="'.$row[0].'" required>&ensp;'.$row[1].'
                      </label>
                    </li>';
            }

            ?>
          </ol>
        </label>

        <button type="submit" class="hollow button">Zarezerwuj temat</button>
      </form>

      <!-- ZGŁASZANIE WYKONANIA PROJEKTU -->
      <h1 id="Zglos_wykonanie_projektu">Zgłoś wykonanie projektu</h1>
      <?php

      $id_student = trim($_POST['id_student2']);

      if (!empty($id_student)) {
        $result = mysqli_query($link, "SELECT * FROM Wykonany_projekt WHERE id_osoby_student = $id_student") or die(mysqli_error($link));
        $submitted_already = mysqli_num_rows($result);

        if ($submitted_already) {
          echo '<p><span class="fa fa-times fa-error"></span>&ensp;Już zgłosiłeś swój projekt do oceny, nie możesz zrobić tego ponownie.</p>';
        } else {
          mysqli_query($link, "INSERT INTO Wykonany_projekt(id_osoby_student, data_oddania) VALUES($id_student, NOW())") or die(mysqli_error($link));
          echo '<p><span class="fa fa-check fa-success"></span>&ensp;Twój projekt został oznaczony jako wykonany i czeka w kolejce na ocenę.</p>';
        }
      }

      ?>
      <form action="/user/index.php#Zglos_wykonanie_projektu" method="post" onsubmit="return confirm('Czy aby na pewno chcesz zgłosić swój projekt do oceny?');">
        <label>
          Wybierz swoje nazwisko:
          <select name="id_student2" required>
            <option value selected>&nbsp;</option>
            <?php

            $result = mysqli_query($link, "SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student WHERE nr_projektu IS NOT NULL ORDER BY imie, nazwisko") or die(mysqli_error($link));
            while ($row = mysqli_fetch_array($result)) {
              echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
            }

            ?>
          </select>
        </label>

        <button type="submit" class="hollow button">Zgłoś projekt do oceny</button>
      </form>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>