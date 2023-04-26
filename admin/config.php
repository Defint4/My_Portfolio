<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();

define('DB_SERVER', 'SERVER');
define('DB_USERNAME', 'user');
define('DB_PASSWORD', 'Pass');
define('DB_NAME', 'Name');

$conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if ($conn === false) {
    die("ERREUR : Impossible de se connecter à la base de données. " . mysqli_connect_error());
}
?>