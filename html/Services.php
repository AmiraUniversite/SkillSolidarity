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
        <p class="filter">Veuillez choisir parmi les catégorie suivantes:</p>
        <ul class="options">
            <button class="button" onclick="afficherAnnonces('Travaux')">Travaux</button>
            <button class="button" onclick="afficherAnnonces('Entretien')">Entretien</button>
            <button class="button" onclick="afficherAnnonces('Animaux')">Animaux</button>
            <button class="button" onclick="afficherAnnonces('Bricolage')">Bricolage</button>
            <button class="button" onclick="afficherAnnonces('Automobile')">Automobile</button>
            <button class="button" onclick="afficherAnnonces('Services Informatiques')">Services Informatiques</button>
            <button class="button" onclick="afficherAnnonces('Cours Particuliers/ Education')">Cours Particuliers/ Education</button>
            <button class="button" onclick="afficherAnnonces('Aide à domicile')">Aide à domicile</button>
            <button class="button" onclick="afficherAnnonces('Assistance administrative')">Assistance administrative</button>
            <button class="button" onclick="afficherAnnonces('Coaching/Conseils')">Coaching/Conseils</button>
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
</body>
</html>

<?php

// Connexion à la base de données
$host = "localhost";
$dbname = "SkillSolidarity";
$user = "postgres";
$port = "5432";
$password = "******";

// Connexion à la base de données
$connexion = pg_connect("host=$host dbname=$dbname user=$user port=$port password=$password");

// Vérifier la connexion
if (!$connexion) {
    die("Echec de la connexion : " . pg_last_error());
}

// Fonction pour récupérer les annonces en fonction de la catégorie
function getAnnonces($categorie, $connexion)
{
    $query = "SELECT * FROM public.\"Service\" WHERE Categorie = $1";
    $result = pg_query_params($connexion, $query, array($categorie));
    $annonces = pg_fetch_all($result);
    return $annonces;
}

// Vérifier si un bouton a été cliqué
if (isset($_GET['categorie'])) {
    $categorie = $_GET['categorie'];
    $annonces = getAnnonces($categorie, $connexion);
    // Afficher les annonces
    if ($annonces) {
        foreach ($annonces as $annonce) {
            echo "Titre : " . $annonce['NomService'] . "<br>";
            echo "La Date :" . $annonce['DateService'] . "<br>";
            echo "Compétence requise :" . $annonce['CompetenceRequise'] . "<br>";

            
        }
    } else {
        echo "Aucune annonce trouvée pour la catégorie que vous venez de sélectionner.";
    }
}

?>





