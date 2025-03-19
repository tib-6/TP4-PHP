<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des PFE</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
        }

        header {
            background-color: #007BFF;
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-title {
            font-size: 1.8em;
        }

        .user-info {
            font-size: 1.2em;
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .auth-button {
            background-color: white;
            color: #007BFF;
            padding: 8px 12px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .auth-button:hover {
            background-color: #e6e6e6;
        }
    </style>
</head>
<body>

<header>
    <div class="header-title">Gestion des PFE</div>
    
    <div class="user-info">
        <?php if (isset($_SESSION['nom']) && isset($_SESSION['prenom'])): ?>
            <span>Bienvenue, <?php echo htmlspecialchars($_SESSION['prenom'] . ' ' . $_SESSION['nom']); ?> </span>
            <a href="logout.php" class="auth-button">Déconnexion</a>
        <?php else: ?>
            <a href="login.php" class="auth-button">Connexion</a>
        <?php endif; ?>
    </div>
</header>

<?php require("nav.php"); ?>

</body>
</html>
