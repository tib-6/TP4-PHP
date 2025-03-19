<?php
session_start();
require("config_db.php");

if (!isset($_SESSION['profil']) || $_SESSION['profil'] !== 'Etudiant') {
    header("Location: index.php");
    exit();
}

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDD);
if (!$conn) {
    die("Échec de la connexion : " . mysqli_connect_error());
}

$pfe_id = $_POST['pfe_id'];
$titre = mysqli_real_escape_string($conn, $_POST['titre']);
$resume = mysqli_real_escape_string($conn, $_POST['resume']);

$sql = "UPDATE PFEs SET titre = '$titre', resume = '$resume' WHERE id = $pfe_id";

if (mysqli_query($conn, $sql)) {
    header("Location: index.php?msg=PFE mis à jour");
} else {
    echo "Erreur : " . mysqli_error($conn);
}

mysqli_close($conn);
?>
