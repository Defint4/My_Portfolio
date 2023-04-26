<?php
$servername = "SERVER";
$username = "dUSER";
$password = "PASS";
$dbname = "NAME";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nom, description, image FROM Projects";
$result = $conn->query($sql);

$projects = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        array_push($projects, $row);
    }
}

header('Content-Type: application/json');
echo json_encode($projects);
?>