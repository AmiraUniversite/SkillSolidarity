<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <link rel="stylesheet" href="css/Services.css">
    
</head>

<body>
    <div class="container">
        <h1>Résultat de recherche</h1>
        <p class="filter">Veuillez choisir parmi les catégorie suivantes:</p>
        <ul class="options">
            <li><a href="#" class="button">Jardinage</a></li>
            <li><a href="#" class="button">Plomberie</a></li>
            <li><a href="#" class="button">Aide à domicile</a></li>
            <li><a href="#" class="button">Peinture</a></li>
            <li><a href="#" class="button">Mécanique</a></li>
            <li><a href="#" class="button">Déménagement</a></li>
            <li><a href="#" class="button">Autres</a></li>
        </ul>

        <?php

        // Connexion à la base de données
        $host="localhost"; 
        $dbname="SkillSolidarity";
        $user="postgres";
        $port="5432"; 
        $password="******";
        
        // Connexion à la base de données
        $connexion = pg_connect("host=$host dbname=$dbname user=$user port=$port password=$password");

        // Vérifier la connexion
        if (!$connexion) {
            die("Echec de la connexion : " . pg_last_error());
        }


        // Fonction pour récupérer les annonces en fonction de la catégorie
        function getAnnonces($categorie, $connexion) {
            $query = "SELECT * FROM annonces WHERE categorie = $1";
            $result = pg_query_params($connexion, $query, array($categorie));
            $annonces = pg_fetch_all($result);
            return $annonces;
        }

        // Vérifier si un bouton a été cliqué
        if (isset($_GET['categorie'])) {
            $categorie = $_GET['categorie'];
            $annonces = getAnnonces($categorie, $connexion);
            // Afficher les annonces
            foreach ($annonces as $annonce) {
                echo "Titre : " . $annonce['titre'] . "<br>";
                echo "Description : " . $annonce['description'] . "<br>";
                echo "<hr>";
            }
}

    ?>

    </div>
</body>
</html>




