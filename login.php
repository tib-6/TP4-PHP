<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des PFE - Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        main {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        fieldset {
            border: none;
        }

        legend {
            font-size: 1.5em;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input {
            width: 90%;
            padding: 8px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 1em;
        }

        button:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<?php require("header.php"); ?>

<main>
    <form action="login_verif.php" method="post">
        <fieldset>
            <legend>Authentification</legend>
            <input type="email" name="username" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </fieldset>
        <?php
        if (isset($_GET["msg"])) {
            echo "<p class='error-message'>", htmlspecialchars($_GET['msg']), "</p>";
        }
        ?>
    </form>
</main>

<?php require("footer.php"); ?>

</body>
</html>
