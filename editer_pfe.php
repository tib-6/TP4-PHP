<?php
session_start();
require("config_db.php");

// Vérifier que l'utilisateur est un étudiant
if (!isset($_SESSION['profil']) || $_SESSION['profil'] !== 'Etudiant') {
    header("Location: index.php");
    exit();
}

$etudiant_id = $_SESSION['id'];

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

// Récupérer les données du PFE
$sql = "SELECT p.id, p.titre, p.resume, 
               e1.nom AS encadrant_interne, e2.nom AS encadrant_externe 
        FROM PFEs p
        LEFT JOIN enseignants e1 ON p.encadrant_interne_id = e1.id
        LEFT JOIN enseignants e2 ON p.encadrant_externe_id = e2.id
        WHERE p.etudiant_id = $etudiant_id";

$result = mysqli_query($conn, $sql);
$pfe = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mon PFE</title>
</head>
<body>
    <h2>Mon PFE</h2>

    <?php if ($pfe): ?>
        <table>
            <tr><th>Titre</th><td><?= htmlspecialchars($pfe['titre']) ?></td></tr>
            <tr><th>Résumé</th><td><?= nl2br(htmlspecialchars($pfe['resume'])) ?></td></tr>
            <tr><th>Encadrant Interne</th><td><?= htmlspecialchars($pfe['encadrant_interne']) ?></td></tr>
            <tr><th>Encadrant Externe</th><td><?= htmlspecialchars($pfe['encadrant_externe']) ?></td></tr>
        </table>
        <a href="editer_pfe.php?id=<?= $pfe['id'] ?>">Modifier</a>
    <?php else: ?>
        <p>Aucun PFE trouvé.</p>
        <a href="editer_pfe.php">Ajouter un PFE</a> <!-- Lien vers le formulaire d'ajout -->
    <?php endif; ?>

</body>
</html>

<?php mysqli_close($conn); ?>
