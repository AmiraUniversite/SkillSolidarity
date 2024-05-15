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

        // Vérification de la bonne soumission du formulaire
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

        
        // Exécuter la requête SQL
        $sql = "SELECT ..., ... FROM table WHERE condition";
        $result = $conn->query($sql);

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            // Parcourir les résultats
            while($row = $result->fetch_assoc()) {
                echo "....: " . $row["..."]. " - ...: " . $row["..."]. "<br>";
            }
        } else {
            echo "0 résultats";
        }
    }
        pg_close($connexion);
    
    ?>

    </div>
</body>
</html>




