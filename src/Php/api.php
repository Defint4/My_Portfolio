<?php
$servername = "db5012575511.hosting-data.io";
$username = "dbu3493964";
$password = "8Sq2Mv2m4Q65Z@hi";
$dbname = "dbs10571360";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, nom as name, description as desc, image FROM Projects";
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