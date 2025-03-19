<?php
session_start();
require("config_db.php");

if (!isset($_SESSION['profil']) || $_SESSION['profil'] !== 'Etudiant') {
    header("Location: index.php");
    exit();
}

$etudiant_id = $_SESSION['id'];
$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);

if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$titre = mysqli_real_escape_string($conn, $_POST['titre']);
$resume = mysqli_real_escape_string($conn, $_POST['resume']);

// Si un PFE existe, mettre à jour les données sinon insertion d'un nouveau PFE
if (isset($_POST['pfe_id']) && $_POST['pfe_id']) {
    $pfe_id = $_POST['pfe_id'];
    $sql = "UPDATE PFEs SET titre = '$titre', resume = '$resume' WHERE id = $pfe_id AND etudiant_id = $etudiant_id";
} else {
    $sql = "INSERT INTO PFEs (etudiant_id, titre, resume) VALUES ($etudiant_id, '$titre', '$resume')";
}

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?msg=PFE ajouté avec succès.");
} else {
    echo "Erreur : " . mysqli_error($conn);
}

mysqli_close($conn);
?>
