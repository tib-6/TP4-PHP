<?php
session_start();
?>
<style>
    nav {
        display: flex;
        justify-content: center;
        gap: 20px;
        padding: 10px 0;
        background-color: #0056b3;
    }

    nav a {
        color: white;
        text-decoration: none;
        font-size: 1.2em;
        padding: 10px 15px;
    }

    nav a:hover {
        background-color: #004080;
        border-radius: 5px;
    }

    .logout-btn {
        background-color: red;
        padding: 10px;
        border-radius: 5px;
    }

    .logout-btn:hover {
        background-color: darkred;
    }
</style>

<nav>
    <a href="index.php">Accueil</a>

    <?php if (isset($_SESSION['profil'])): ?>
        <?php if ($_SESSION['profil'] === 'Etudiant'): ?>
            <a href="pfe_etudiant.php">Mon PFE</a> <!-- ✅ Lien ajouté -->
        <?php elseif ($_SESSION['profil'] === 'Prof'): ?>
            <a href="mes_etudiants.php">Mes Étudiants</a>
            <a href="proposer_sujet.php">Proposer un Sujet</a>
        <?php elseif ($_SESSION['profil'] === 'Admin'): ?>
            <a href="list_etudiant.php">Liste des Étudiants</a>
        <?php endif; ?>

        <a href="profil.php">Mon Profil</a>
        <a href="logout.php" class="logout-btn">Déconnexion</a>
    <?php else: ?>
        <a href="login.php">Connexion</a>
    <?php endif; ?>
</nav>
