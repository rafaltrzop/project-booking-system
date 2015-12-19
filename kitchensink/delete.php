<?php include('connection.php'); ?>

<!-- USUWANIE STUDENTA -->
<?php

$id_student = trim($_POST['id_student']);

if (!empty($id_student)) {
  mysql_query("DELETE FROM Osoba WHERE id_osoby = $id_student") or die(mysql_error());
}

?>

<h1>Usuń studenta</h1>
<table border="1">
  <tr>
    <th>Imię i nazwisko</th>
    <th>E-mail</th>
    <th>Grupa</th>
    <th>Opcje</th>
  </tr>

<?php

$result = mysql_query('SELECT imie, nazwisko, email, grupa, id_osoby FROM Student NATURAL JOIN Osoba') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo '<tr>
          <td>'.$row[0].' '.$row[1].'</td>
          <td>'.$row[2].'</td>
          <td>'.$row[3].'</td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="id_student" value="'.$row[4].'">
              <input type="submit" value="Usuń studenta">
            </form>
          </td>
        </tr>';
}
?>

</table>

<!-- USUWANIE PROFESORA -->
<?php

$id_proffesor = trim($_POST['id_proffesor']);

if (!empty($id_proffesor)) {
  mysql_query("DELETE FROM Osoba WHERE id_osoby = $id_proffesor") or die(mysql_error());
}

?>

<h1>Usuń profesora</h1>
<table border="1">
  <tr>
    <th>Imię i nazwisko</th>
    <th>E-mail</th>
    <th>Wykładany przedmiot</th>
    <th>Opcje</th>
  </tr>

<?php

$result = mysql_query('SELECT imie, nazwisko, email, wykladany_przedmiot, id_osoby FROM Profesor NATURAL JOIN Osoba') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo '<tr>
          <td>'.$row[0].' '.$row[1].'</td>
          <td>'.$row[2].'</td>
          <td>'.$row[3].'</td>
          <td>
            <form action="" method="post">
              <input type="hidden" name="id_proffesor" value="'.$row[4].'">
              <input type="submit" value="Usuń profesora">
            </form>
          </td>
        </tr>';
}
?>

</table>

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