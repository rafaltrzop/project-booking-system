<?php include('connection.php'); ?>

<!-- USUWANIE PROJEKTU -->
<?php

$project_removed = FALSE;
$project_number = trim($_POST['project_number']);

if (!empty($project_number)) {
  // wykonuję zapytanie przed wyświetleniem listy tematów aby była ona aktualna po wysłaniu formularza
  // (nie chcę aby na liście projektów znowu pojawił się temat który dopiero co usunąłem)
  mysql_query("DELETE FROM Projekt WHERE nr_projektu = $project_number") or die(mysql_error());
  $project_removed = TRUE;
}

?>

<h1>Usuń temat projektu</h1>
<form action="" method="post">
  <label>
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
  <input type="submit" value="Usuń wybrany temat">
</form>

<?php

if ($project_removed) {
  echo "<p>Wybrany temat projektu został usunięty.</p>";
}

?>