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
        <li class="options">
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
        </li>

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
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'SkillSoly';
$user = 'postgres';
$pass = '016979B558@y';
$port = '5433';
$dsn = "pgsql:host=$host;port=$port;dbname=$db";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Echec de la connexion : " . $e->getMessage());
}

// Fonction pour récupérer les annonces en fonction de la catégorie
function getAnnonces($categorie, $pdo)
{
    $query = "SELECT * FROM public.\"Service\" WHERE Categorie = :categorie";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['categorie' => $categorie]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
session_destroy();
?>