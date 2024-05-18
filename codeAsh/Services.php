<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <link rel="stylesheet" href="css/Services.css">
</head>

<body>
    <?php include 'Header_profile.php';?>
    <div class="container">
        <h1>Résultat de recherche</h1>
        <p class="filter">Veuillez choisir parmi les catégories suivantes:</p>
        <ul class="options">
            <li><button class="button" onclick="afficherAnnonces('JARDINAGE')">Jardinage</button></li>
            <li><button class="button" onclick="afficherAnnonces('PLOMBERIE')">Plomberie</button></li>
            <li><button class="button" onclick="afficherAnnonces('MENAGE')">Ménage</button></li>
            <li><button class="button" onclick="afficherAnnonces('PEINTURE')">Peinture</button></li>
            <li><button class="button" onclick="afficherAnnonces('MECANIQUE')">Mécanique</button></li>
            <li><button class="button" onclick="afficherAnnonces('DEMENAGEMENT')">Déménagement</button></li>
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
    $pass = 'mfp98x';
    $port = '5432';
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
            foreach ($annonces as $annonce) {
                echo "Titre : " . htmlspecialchars($annonce['NomService']) . "<br>";
                echo "La Date : " . htmlspecialchars($annonce['DateService']) . "<br>";
                echo "Compétence requise : " . htmlspecialchars($annonce['CompetenceRequise']) . "<br><br>";
            }
        } else {
            echo "Aucune annonce trouvée pour la catégorie que vous venez de sélectionner.";
        }
    }
    pg_close($pdo);
    session_destroy();
?>
