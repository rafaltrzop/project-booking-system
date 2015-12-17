<?php

include('connection.php');

# Tabela Osoba
echo '<h1>Osoba</h1>
      <table border="1">
        <tr>
          <th>id_osoby</th>
          <th>email</th>
          <th>imie</th>
          <th>nazwisko</th>
        </tr>';

$result = mysql_query('SELECT * FROM Osoba') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo "<tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
        </tr>";
}
echo '</table>';

# Tabela Student
echo '<h1>Student</h1>
      <table border="1">
        <tr>
          <th>id_osoby</th>
          <th>grupa</th>
          <th>nr_projektu</th>
        </tr>';

$result = mysql_query('SELECT * FROM Student') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo "<tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
        </tr>";
}
echo '</table>';

# Tabela Profesor
echo '<h1>Profesor</h1>
      <table border="1">
        <tr>
          <th>id_osoby</th>
          <th>wykladany_przedmiot</th>
        </tr>';

$result = mysql_query('SELECT * FROM Profesor') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo "<tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
        </tr>";
}
echo '</table>';

# Tabela Projekt
echo '<h1>Projekt</h1>
      <table border="1">
        <tr>
          <th>nr_projektu</th>
          <th>temat</th>
        </tr>';

$result = mysql_query('SELECT * FROM Projekt') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo "<tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
        </tr>";
}
echo '</table>';

# Tabela Wykonany_projekt
echo '<h1>Wykonany_projekt</h1>
      <table border="1">
        <tr>
          <th>id_osoby_student</th>
          <th>id_osoby_profesor</th>
          <th>data_oddania</th>
          <th>ocena</th>
        </tr>';

$result = mysql_query('SELECT * FROM Wykonany_projekt') or die(mysql_error());
while ($row = mysql_fetch_array($result)) {
  echo "<tr>
          <td>$row[0]</td>
          <td>$row[1]</td>
          <td>$row[2]</td>
          <td>$row[3]</td>
        </tr>";
}
echo '</table>';

?>