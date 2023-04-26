<?php
require_once "../config.php";
require_once '../auth_check.php';


if (!file_exists('../images')) {
    mkdir('../images', 0755, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);


    $image = $_FILES['image'];
    $imageName = basename($image['name']);
    $imageTempPath = $image['tmp_name'];
    $imageUploadPath = "../../build/static/media/" . $imageName;
    
    // Vérifiez si le fichier est une image et déplacez-le dans le dossier "images"
    $check = getimagesize($imageTempPath);
    if ($check !== false) {
        if (move_uploaded_file($imageTempPath, $imageUploadPath)) {
            $imagePathInDB = "static/media/" . $imageName;
        } else {
            echo "Erreur lors du téléchargement de l'image.";
            exit;
        }
    } else {
        echo "Le fichier n'est pas une image.";
        exit;
    }

    $query = "INSERT INTO Projects (nom, description, image) VALUES ('$nom', '$description', '$imagePathInDB')";
    if (mysqli_query($conn, $query)) {
        header("Location: ../admin_home.php");
    } else {
        echo "Erreur: " . $query . "<br>" . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un projet</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Ajouter un projet</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea><br><br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required><br><br>
            <button type="submit">Ajouter le projet</button>
            <button onclick="window.location.href='../admin_home.php'">Retour à l'admin</button>
        </form>
        
    </div>
</body>
</html>