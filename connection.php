<?php

# Credentials
$dbhost = 'localhost';
$dbuser = '14_trzop';
$dbpass = 'password';
$dbname = '14_trzop';

# Set up a connection
$conn = mysql_connect($dbhost, $dbuser, $dbpass);

if (!$conn) {
  die('Błąd połączenia z serwerem: '.mysql_error());
}

# Set charset
mysql_set_charset('utf8');

# Select database
mysql_select_db($dbname);

?>
