<?php
    session_start(); // Démarrer la session

    // Connexion à la base de données PostgreSQL
    $conn = pg_connect($conn_str);

    if (!$conn) {
        // Afficher un message si la connexion échoue
        echo '<p class="erreur">Erreur de connexion à la base de données.</p>';
    } else {
        // Afficher un message si la connexion réussit
        echo '<p>Connexion à la base de données réussie.</p>';
        
        // Vérifier si un bouton a été cliqué
        if(isset($_POST['categorie'])) {
            
            // Requête SQL pour récupérer les informations
            $query = "SELECT DateService, NomService, CompétenceRequise FROM public.\"Service\" WHERE upper(Categorie) = upper('$categorie')";
            
            // Exécution de la requête
            $result = pg_query($conn, $query);
            
            // Vérifier si la requête a réussi
            if ($result) {
                // Afficher les résultats
                while ($row = pg_fetch_assoc($result)) {
                    echo "<p>Date du service : " . $row['DateService'] . "</p>";
                    echo "<p>Nom du service : " . $row['NomService'] . "</p>";
                    echo "<p>Compétence requise : " . $row['CompétenceRequise'] . "</p>";
                }
            } else {
                echo '<p class="erreur">Erreur lors de l\'exécution de la requête.</p>';
            }
        }
    }
?>


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
</body>
</html>
