<?php
require_once "../config.php";
require_once '../auth_check.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM Projects WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin_home.php");
    } else {
        echo "Erreur: " . $query . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: ../admin_home.php");
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supprimer un projet</title>
    <link rel="stylesheet" href="../admin_home.css">
</head>
<body>
    <h1>Supprimer un projet</h1>
    <p>Le projet a été supprimé.</p>
    <button onclick="window.location.href='../admin_home.php'">Retour à l'admin</button>
</body>
</html>
