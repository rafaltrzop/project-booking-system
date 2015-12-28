<?php

include('database_credentials.php');

$link = mysqli_connect($hostname, $username, $password, $database);

if (!$link) {
  echo 'Error: Unable to connect to MySQL.' . PHP_EOL;
  echo 'Debugging errno: '. mysqli_connect_errno() . PHP_EOL;
  echo 'Debugging error: ' . mysqli_connect_error() . PHP_EOL;
  exit;
}

mysqli_set_charset($link, 'utf8');

?>