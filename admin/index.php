<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <h1>Tabela Osoba</h1>
      <table border="1">
        <thead>
          <tr>
            <th>id_osoby</th>
            <th>email</th>
            <th>imie</th>
            <th>nazwisko</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Osoba') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                  </tr>";
          }

          ?>
        </tbody>
      </table>

      <h1>Tabela Student</h1>
      <table border="1">
        <thead>
          <tr>
            <th>id_osoby</th>
            <th>grupa</th>
            <th>nr_projektu</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Student') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                  </tr>";
          }

          ?>
        </tbody>
      </table>

      <h1>Tabela Profesor</h1>
      <table border="1">
        <thead>
          <tr>
            <th>id_osoby</th>
            <th>wykladany_przedmiot</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Profesor') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                  </tr>";
          }

          ?>
        </tbody>
      </table>

      <h1>Tabela Projekt</h1>
      <table border="1">
        <thead>
          <tr>
            <th>nr_projektu</th>
            <th>temat</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Projekt') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                  </tr>";
          }

          ?>
        </tbody>
      </table>

      <h1>Tabela Wykonany_projekt</h1>
      <table border="1">
        <thead>
          <tr>
            <th>id_osoby_student</th>
            <th>id_osoby_profesor</th>
            <th>data_oddania</th>
            <th>ocena</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Wykonany_projekt') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
            echo "<tr>
                    <td>$row[0]</td>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                  </tr>";
          }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>