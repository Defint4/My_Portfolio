<?php

// Inclure le fichier config.php pour la connexion à la base de données
require_once 'config.php';

// Vérifier si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération des données du formulaire
    $user = isset($_POST['username']) ? trim($_POST['username']) : '';
    $pass = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Hashage du mot de passe avec SHA256
    $hashed_pass = hash('sha256', $pass);

    // Requête SQL pour vérifier si l'utilisateur existe dans la base de données
    $sql = "SELECT id FROM admin WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Liaison des paramètres et exécution de la requête préparée
        $stmt->bind_param("ss", $user, $hashed_pass);
        $stmt->execute();

        // Stockage du résultat
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Si l'utilisateur existe, démarrer une session
            while($row = $result->fetch_assoc()) {
                $_SESSION['user_id'] = $row['id'];
            }
            // Rediriger vers la page d'accueil de l'admin
            header("Location: admin_home.php");
            exit;
        } else {
            // Si les identifiants sont incorrects, rediriger vers la page de connexion avec un message d'erreur
            header("Location: index.php?error=1");
            exit;
        }

        $stmt->close();
    } else {
        die("Erreur de préparation de la requête: " . $conn->error);
    }

    $conn->close();
} else {
    header("Location: index.php");
    exit;
}
?>
