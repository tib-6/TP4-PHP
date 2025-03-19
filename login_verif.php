<?php
session_start();
require("config_db.php");

// Connexion sécurisée à la base de données
$conn = new mysqli($serveur, $utilisateur, $motDePasse, $baseDD);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Vérifier si les champs sont remplis
if (!isset($_POST["username"], $_POST["password"]) || empty($_POST["username"]) || empty($_POST["password"])) {
    header("location: login.php?msg=Veuillez remplir tous les champs.");
    exit();
}

$a = trim($_POST["username"]);
$b = trim($_POST["password"]);

// Requête sécurisée pour vérifier l'utilisateur
$req1 = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($req1);
$stmt->bind_param("s", $a);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier si l'utilisateur existe
if ($result->num_rows === 0) {
    header("location: login.php?msg=Login ou mot de passe incorrect.");
    exit();
}

$row1 = $result->fetch_assoc();

// Vérifier le mot de passe avec password_verify()
if (!password_verify($b, $row1["password"])) {
    header("location: login.php?msg=Mot de passe incorrect.");
    exit();
}

// Déterminer la table à interroger selon le rôle
$identifiant = $row1["user_id"];
$table = ($row1["role"] == 'Etudiant') ? 'etudiants' : 'enseignants';

// Requête sécurisée pour récupérer les informations de l'utilisateur
$req2 = "SELECT id, nom, prenom FROM $table WHERE id = ?";
$stmt2 = $conn->prepare($req2);
$stmt2->bind_param("i", $identifiant);
$stmt2->execute();
$result2 = $stmt2->get_result();

if ($result2->num_rows === 0) {
    header("location: login.php?msg=Contacter votre administrateur.");
    exit();
}

$row2 = $result2->fetch_assoc();

// Création des variables de session
$_SESSION['username'] = $a;
$_SESSION['profil'] = $row1["role"];
$_SESSION['id'] = $row2["id"];
$_SESSION['nom'] = $row2["nom"];
$_SESSION['prenom'] = $row2["prenom"];

// Redirection vers l'accueil
header("location: index.php");
exit();
?>
