<?php
session_start(); // Démarrer la session

// Connexion à la base de données PostgreSQL
$conn_str = "host=your_host dbname=your_db user=your_user password=your_password"; // Remplacez les valeurs par les vôtres
$conn = pg_connect($conn_str);

if (!$conn) {
    // Afficher un message si la connexion échoue
    echo '<p class="erreur">Erreur de connexion à la base de données.</p>';
} else {
    // Afficher un message si la connexion réussit
    echo '<p>Connexion à la base de données réussie.</p>';

    // Vérifier si un bouton a été cliqué et si la catégorie est définie
    if(isset($_POST['categorie'])) { //Cette condition vérifie si un formulaire a été soumis avec un champ nommé "categorie"
        

        // Requête SQL pour récupérer les informations en utilisant une requête préparée
        // Cette ligne définit la requête SQL à exécuter. Elle récupère les informations des services où la catégorie correspond à la valeur soumise dans le formulaire
        $query = "SELECT \"DateService\", \"NomService\", \"CompétenceRequise\" FROM public.\"Service\" WHERE upper(\"Categorie\") = upper($1)";
        
        // Exécution de la requête préparée
        $result = pg_query_params($conn, $query, array($categorie));
        
        // Vérifier si la requête a réussi
        if ($result) {
            //Cette boucle parcourt les résultats de la requête et affiche les détails de chaque service.
            while ($row = pg_fetch_assoc($result)) {
?>
                <div class="Service proposé">
                    <p>Nom du service : <?php echo $row['NomService']; ?></p>
                    <p>Date du service : <?php echo $row['DateService']; ?></p>
                    <p>Compétence requise : <?php echo $row['CompétenceRequise']; ?></p>
                </div>

<?php // Ces balises PHP sont utilisées pour insérer dynamiquement les valeurs des colonnes de la base de données dans le HTML qui sera renvoyé au navigateur.
            }
        } else {
            echo '<p>Il n existe pas d\'annonces correspondant à votre demande</p>';
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
        <form method="POST" action="">
            <ul class="options">
                <li><button class="button" type="submit" name="categorie" value="Travaux">Travaux</button></li>
                <li><button class="button" type="submit" name="categorie" value="Entretien">Entretien</button></li>
                <li><button class="button" type="submit" name="categorie" value="Animaux">Animaux</button></li>
                <li><button class="button" type="submit" name="categorie" value="Bricolage">Bricolage</button></li>
                <li><button class="button" type="submit" name="categorie" value="Automobile">Automobile</button></li>
                <li><button class="button" type="submit" name="categorie" value="Services Informatiques">Services Informatiques</button></li>
                <li><button class="button" type="submit" name="categorie" value="Cours Particuliers/ Education">Cours Particuliers/ Education</button></li>
                <li><button class="button" type="submit" name="categorie" value="Aide à domicile">Aide à domicile</button></li>
                <li><button class="button" type="submit" name="categorie" value="Assistance administrative">Assistance administrative</button></li>
                <li><button class="button" type="submit" name="categorie" value="Coaching/Conseils">Coaching/Conseils</button></li>
            </ul>
        </form>
    </div>
</body>
</html>

