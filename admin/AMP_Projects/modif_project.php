<?php
require_once "../config.php";
require_once '../auth_check.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM Projects WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $projet = mysqli_fetch_assoc($result);
} else {
    header("Location: ../admin_home.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
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

    $query = "UPDATE Projects SET nom = '$nom', description = '$description', image = '$imagePathInDB' WHERE id = $id";
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
    <title>Modifier un projet</title>
    <link rel="stylesheet" href="project.css">
</head>
<body>
    <div class="container">
        <h1 class="title">Modifier un projet</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $projet['id']; ?>">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $projet['nom']; ?>" required><br><br>
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $projet['description']; ?></textarea><br><br>
            <label for="image">Image:</label>
            <input type="file" id="image" name="image" required><br><br>
            <button type="submit">Modifier le projet</button>
            <button onclick="window.location.href='../admin_home.php'">Retour à l'admin</button>
        </form>
    </div>
</body>
</html>
