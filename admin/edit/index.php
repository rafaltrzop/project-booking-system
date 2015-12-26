<?php

include($_SERVER['DOCUMENT_ROOT'].'/connection.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/head.php');
include($_SERVER['DOCUMENT_ROOT'].'/partials/header_admin.html');

?>

<main class="body-content-container">
  <div class="row">
    <div class="small-12 columns">
      <h1>Edytuj temat projektu</h1>
      <?php

      $project_number = trim($_POST['project_number']);
      $project_name = trim($_POST['project_name']);

      if (!empty($project_number) && !empty($project_name)) {
        mysql_query("UPDATE Projekt SET temat = '$project_name' WHERE nr_projektu = $project_number") or die(mysql_error());
        echo '<p><span class="fa fa-check fa-success"></span>&ensp;Zmieniono nazwę tematu projektu na: '.$project_name.'.</p>';
      }

      ?>
      <table border="1">
        <thead>
          <tr>
            <th>Temat projektu</th>
            <th class="text-center">Opcje</th>
          </tr>
        </thead>
        <tbody>
          <?php

          $result = mysql_query('SELECT * FROM Projekt ORDER BY temat') or die(mysql_error());
          while ($row = mysql_fetch_array($result)) {
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
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/partials/scripts.html'); ?>