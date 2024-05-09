<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <style>
        body {
            margin: 50px;
            padding: 30px;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0 ;
        }
        
        .container {
            background-color: white;
            padding: 20px;
            max-width: 1200px; /* ajustez selon vos besoins */
            margin: 0 auto; /* centre horizontalement */
            min-height: calc(100vh - 100px); /* 100vh correspond à 100% de la hauteur de la fenêtre du navigateur, moins les marges du body */
        }

        h1 {
            color: black;
            font-weight: bold;
            font-size: 25px;
            margin: 0px ;
            margin-bottom: 20px;
        }

        .filter {
            color: black;
            font-size: 14px;
            margin-top: 5px;
            margin-bottom: 20px;
        }

        .options {
            margin: 0;
            padding: 0;
            list-style-type: none;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;

        }

        .options li {
            margin-right: 20px;
        }

        .options li:last-child {
            margin-right: 0;
        }

        .button {
            display: inline-block;
            padding: 5px 15px;
            background-color: white;
            border: 1px solid #f2994A;
            border-radius: 20px;
            color: #f2994A;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s, color 0.3s;
        }

        .button:hover {
            background-color: #f2994A;
            color: white;
        }
    </style>


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




