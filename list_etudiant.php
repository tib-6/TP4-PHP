<?php
session_start();
require("config_db.php");

// Vérifier si l'utilisateur est un admin
if (!isset($_SESSION['profil']) || $_SESSION['profil'] !== 'Admin') {
    header("Location: index.php");
    exit();
}

// Connexion à la base de données
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Requête pour récupérer tous les étudiants
$sql = "SELECT id, nom, prenom, email FROM etudiants";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
        }

        h2 {
            text-align: center;
            color: #007BFF;
        }

        table {
            width: 80%;
            margin: auto;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #007BFF;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .back-link {
            display: block;
            width: 200px;
            margin: 20px auto;
            text-align: center;
            background: #0056b3;
            color: white;
            padding: 10px;
            text-decoration: none;
            border-radius: 5px;
        }

        .back-link:hover {
            background: #004080;
        }
    </style>
</head>
<body>

<h2>Liste des Étudiants</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
    </tr>
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row["id"]) . "</td>
                    <td>" . htmlspecialchars($row["nom"]) . "</td>
                    <td>" . htmlspecialchars($row["prenom"]) . "</td>
                    <td>" . htmlspecialchars($row["email"]) . "</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4' style='text-align:center;'>Aucun étudiant trouvé</td></tr>";
    }
    mysqli_close($conn);
    ?>
</table>

<a href="index.php" class="back-link">Retour à l'Accueil</a>

</body>
</html>
