
<?php
$servername = "SERVER";
$username = "USER";
$password = "PASS";
$dbname = "NAME";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données envoyées par le formulaire
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $message = isset($_POST['message']) ? trim($_POST['message']) : '';

    // Valider les données
    if (empty($name) || empty($email) || empty($message)) {
        echo "Error: All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Error: Invalid email format.";
        exit;
    }

    // Préparer la requête SQL pour éviter les injections SQL
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)");

    if ($stmt === false) {
        echo "Error: " . $conn->error;
        exit;
    }

    // Associer les paramètres et exécuter la requête
    $stmt->bind_param("sss", $name, $email, $message);
    $result = $stmt->execute();

    if ($result === true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Fermer la requête et la connexion
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Invalid request method.";
}
?>
