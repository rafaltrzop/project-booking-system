<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.html');

?>

  <body>
    <div class="top-bar">
      <div class="column row">
        <div class="top-bar-left">
          <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text">
              <span class="fa fa-graduation-cap"></span>
              <a href="/index.php">System rezerwacji tematów projektów</a>
            </li>
<!--             <li class="has-submenu">
              <a href="#">One</a>
              <ul class="submenu menu vertical" data-submenu>
                <li><a href="#">One</a></li>
                <li><a href="#">Two</a></li>
                <li><a href="#">Three</a></li>
              </ul>
            </li> -->
            <li><a href="#">First link</a></li>
            <li><a href="#">Second link</a></li>
          </ul>
        </div>
<!--         <div class="top-bar-right">
          <ul class="menu">
            <li><input type="search" placeholder="Search"></li>
            <li><button type="button" class="button">Search</button></li>
          </ul>
        </div> -->
      </div>
    </div>

    <div id="tutorial" class="expanded row">
      <p>tutorial</p>
    </div>

    <div class="row">
      <div class="small-12 columns">
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
              <select name="id_student" required>
                <option value selected disabled>&mdash;</option>
                <?php

                $result = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student") or die(mysql_error());
                while ($row = mysql_fetch_array($result)) {
                  echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
                }

                ?>
              </select>
            </label>

            <label>
              Wybierz temat z listy:<br>
              <ol>
              <?php

              $result = mysql_query('SELECT * FROM Projekt') or die(mysql_error());
              while ($row = mysql_fetch_array($result)) {
                echo '<li>
                        <label>
                          <input type="radio" name="project_number" value="'.$row[0].'" required>
                          '.$row[1].'
                        </label>
                      </li>';
              }

              ?>
              </ol>
            </label>
          </fieldset>
          <button type="submit" class="button">Zarezerwuj wybrany temat</button>
        </form>

        <?php

        if (!empty($id_student) && !empty($project_number)) {
          mysql_query("UPDATE Student SET nr_projektu = $project_number WHERE id_osoby = $id_student") or die(mysql_error());
          echo "<p>Wybrany projekt został przez Ciebie zarezerwowany.</p>";
        }

        ?>

        <!-- ZGŁASZANIE WYKONANIA PROJEKTU -->
        <?php

        $id_student = trim($_POST['id_student']);

        ?>

        <h1>Zgłoś wykonanie projektu</h1>
        <form action="" method="post" onsubmit="return confirm('Czy aby na pewno chcesz zgłosić swój projekt do oceny?');">
          <label>
            Wybierz swoje nazwisko:<br>
            <select name="id_student" required>
              <option value selected disabled>&mdash;</option>
              <?php

              $result = mysql_query("SELECT id_osoby, imie, nazwisko FROM Osoba NATURAL JOIN Student WHERE nr_projektu IS NOT NULL") or die(mysql_error());
              while ($row = mysql_fetch_array($result)) {
                echo '<option value="'.$row[0].'">'.$row[1].' '.$row[2].'</option>';
              }

              ?>
            </select>
          </label>

          <button type="submit" class="button">Zgłoś projekt do oceny</button>
        </form>

        <?php

        if (!empty($id_student)) {
          $result = mysql_query("SELECT * FROM Wykonany_projekt WHERE id_osoby_student = $id_student") or die(mysql_error());
          $submitted_already = mysql_num_rows($result);


          if ($submitted_already) {
            echo '<p>Zgłosiłeś już swój projekt do oceny, nie możesz zrobić tego jeszcze raz!</p>';
          } else {
            mysql_query("INSERT INTO Wykonany_projekt(id_osoby_student, data_oddania) VALUES($id_student, NOW())") or die(mysql_error());
            echo '<p>Twój projekt został oznaczony jako wykonany i zgłoszony do oceny.</p>';
          }
        }

        ?>
      </div>
    </div>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>