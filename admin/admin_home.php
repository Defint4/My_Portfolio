<?php
require_once 'config.php';
require_once 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
    <link rel="stylesheet" href="admin_home.css">
</head>
<body>
    <h1>Gestion des projets</h1>
    <button onclick="window.location.href='AMP_Projects/add_project.php'">Ajouter un projet</button>
    <button onclick="window.location.href='Contact.php'">Voir Messages</button>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM Projects";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['nom']}</td>";
                echo "<td>{$row['description']}</td>";
                echo "<td><img src='https://guiotmatthieu.fr/{$row['image']}' alt='{$row['nom']}' width='100px' height='100px'></td>";
                echo "<td>";
                echo "<button onclick=\"window.location.href='AMP_Projects/modif_project.php?id={$row['id']}'\">Modifier</button>";
                echo "<button onclick=\"window.location.href='AMP_Projects/supp_project.php?id={$row['id']}'\">Supprimer</button>";
                echo "</td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
</body>
</html>