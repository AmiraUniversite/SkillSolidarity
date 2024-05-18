<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <link rel="stylesheet" href="css/Services.css">
</head>

<body>
    <?php include 'Header_profile.html';?>
    <div class="container">
        <h1>Résultat de recherche</h1>
        <p class="filter">Veuillez choisir parmi les catégories suivantes:</p>
        <ul class="options">
            <li><button class="button" onclick="afficherAnnonces('Travaux')">Travaux</button></li>
            <li><button class="button" onclick="afficherAnnonces('Entretien')">Entretien</button></li>
            <li><button class="button" onclick="afficherAnnonces('Animaux')">Animaux</button></li>
            <li><button class="button" onclick="afficherAnnonces('Bricolage')">Bricolage</button></li>
            <li><button class="button" onclick="afficherAnnonces('Automobile')">Automobile</button></li>
            <li><button class="button" onclick="afficherAnnonces('Services Informatiques')">Services Informatiques</button></li>
            <li><button class="button" onclick="afficherAnnonces('Cours Particuliers/ Education')">Cours Particuliers/ Education</button></li>
            <li><button class="button" onclick="afficherAnnonces('Aide à domicile')">Aide à domicile</button></li>
            <li><button class="button" onclick="afficherAnnonces('Assistance administrative')">Assistance administrative</button></li>
            <li><button class="button" onclick="afficherAnnonces('Coaching/Conseils')">Coaching/Conseils</button></li>
        </ul>

        <div id="annonces"></div>
        
        <script>
            function afficherAnnonces(categorie) {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("annonces").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "Services.php?categorie=" + categorie, true);
                xmlhttp.send();
            }
        </script>

    </div>

    <?php
    session_start(); // Démarrer la session

    $host = 'localhost';
    $db = 'SkillSoly';
    $user = 'postgres';
    $pass = '016979B558@y';
    $port = '5433';
    $connection_string = "host=$host port=$port dbname=$db user=$user password=$pass";

    // Connexion à la base de données
    $pdo = pg_connect($connection_string);
    if (!$pdo) {
        die("Echec de la connexion : " . pg_last_error());
    }

    // Fonction pour récupérer les annonces en fonction de la catégorie
    function getAnnonces($categorie, $pdo)
    {
        $query = "SELECT * FROM public.\"Service\" WHERE Categorie = $1";
        $result = pg_query_params($pdo, $query, array($categorie));
        if (!$result) {
            die("Erreur de requête : " . pg_last_error());
        }
        return pg_fetch_all($result);
    }

    // Vérifier si un bouton a été cliqué
    if (isset($_GET['categorie'])) {
        $categorie = $_GET['categorie'];
        $annonces = getAnnonces($categorie, $pdo);

        // Afficher les annonces
        if ($annonces) {
            foreach ($annonces as $annonce) { //Parcourt chaque élément du tableau $annonces, en le stockant dans une variable $annonce à chaque itération. Cette boucle permet de traiter chaque annonce individuellement.
                echo "Titre : " . htmlspecialchars($annonce['NomService']) . "<br>"; //Affiche le titre de l'annonce en utilisant la fonction htmlspecialchars() pour convertir les caractères spéciaux en entités HTML. Le titre de l'annonce est extrait à partir de la clé 'NomService' du tableau $annonce.
                echo "La Date : " . htmlspecialchars($annonce['DateService']) . "<br>"; //Affiche la date de l'annonce, extraite de la clé 'DateService' du tableau $annonce. 
                echo "Compétence requise : " . htmlspecialchars($annonce['CompetenceRequise']) . "<br><br>"; // Affiche les compétences requises pour l'annonce, extraites de la clé 'CompetenceRequise' du tableau $annonce.
            }
        } else {
            echo "Aucune annonce trouvée pour la catégorie que vous venez de sélectionner.";
        }
    }
    pg_close($pdo);
    session_destroy(); // fermeture de la session
?>
