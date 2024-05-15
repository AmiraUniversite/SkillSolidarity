<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <link rel="stylesheet" href="Services.css">
    
</head>

<body>
    <div class="container">
        <h1>Résultat de recherche</h1>
        <p class="filter">Filtrer par thème:</p>
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
        $connexion = pg_connect("host=localhost dbname=SkillSolidarity_Valerian user=postgres password=mfp98x");

        // Vérifier la connexion
        if ($conn->connect_error) {
           die("Connection failed: " . $conn->connect_error);
        }


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
        ?>
        



    </div>
</body>
</html>




