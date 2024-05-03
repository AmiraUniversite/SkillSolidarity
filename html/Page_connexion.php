<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .container input[type="email"],
        .container input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .container input[type="submit"] {
            width: 100%;
            background-color: #ffa200;
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-bottom: 5px;
        }

        .container input[type="submit"]:hover {
            background-color: #ff8c00;
        }

        .container .btn-create-account {
            width: calc(100% - 2px);
            background-color: #fff;
            color: #ffa200;
            border: 1px solid #ffa200;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            border-top: 1px solid #ffa200; /* Ajout de la bordure supérieure */
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .container .btn-create-account:hover {
            background-color: #ff8c00;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Connexion</h2>
        <form action="#" method="post">
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <input type="submit" value="Se connecter">
        </form>
        <div class="separator" style="border-top: 1px solid #ccc; margin: 10px 0;"></div>
        <button class="btn-create-account">Créer un compte</button>
    </div>
</body>
</html>


<?php

// Connexion à la base de données
$connexion = pg_connect("host=localhost dbname=SkillSolidarity_Valerian user=postgres password=mfp98x");

// Vérification de la connexion
if (!$connexion) {
    die("Echec de la connexion : " . pg_last_error());
}

// Vérification de la bonne soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Récupération des données trasmises par l'utilisateur
    $email = pg_escape_string($connexion, $_POST["email"]);
    $password = pg_escape_string($connexion, $_POST["password"]);

    // Vérification de la validité des informations grâce aux requêtes SQL
    $requete = "SELECT * FROM Utilisateurs WHERE email = '$email' AND mot_de_passe = '$password'";
    $resultat = pg_query($connexion, $requete);

    // Vérification du résultat de la requête
    if (pg_num_rows($resultat) == 1) {
        // L'utilisateur est authentifié avec succès
        // Redirection vers une autre page
        header("Location: autre_page.php");
        exit(); // Assure que le script ne continue pas à s'exécuter après la redirection
    } else {
        // L'utilisateur n'est pas authentifié
        echo "Les identifiants sont incorrects. Veuillez réessayer.";
    }
}

// Fermeture de la connexion à la base de données
pg_close($connexion);

?>
