<?php
require_once 'config.php';
require_once 'auth_check.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Messages</title>
    <link rel="stylesheet" href="Contact.css">
</head>
<body>
    <h1>Messages reçus</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>

            <?php
            $query = "SELECT * FROM contacts";
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['name']}</td>";
                echo "<td>{$row['email']}</td>";
                echo "<td>{$row['message']}</td>";
                echo "</tr>";
            }

            ?>
        </tbody>
    </table>
    <button onclick="window.location.href='../admin_home.php'">Retour à l'admin</button>
</body>
</html>
