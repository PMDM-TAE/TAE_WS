<?php
$host_name = 'localhost';
$database = 'id5035961_tae';
$user_name = 'id5035961_david';
$password = 'Urza0502';

$dbh = null;
try {
  $dbh = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
  echo "aaaa";
} catch (PDOException $e) {
  echo "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>