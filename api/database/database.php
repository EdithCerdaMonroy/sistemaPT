<?php

$server = 'localhost';
$username = 'id20616600_uedith';//'root'; 
$password = 'EuDeC08V%>\P>A$9'; // '';
$database = 'id20616600_bdpunto'; //'id20616600_bdpunto';'bdpunto'

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}
