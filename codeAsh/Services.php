<?php
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'SkillSolidarity';
$user = 'postgres';
$pass = 'mfp98x'; // Remplacez par votre mot de passe
$port = '5432';
$conn_str = "host=$host port=$port dbname=$db user=$user password=$pass";
$conn = pg_connect($conn_str);

if (!$conn) {
    // Afficher un message si la connexion échoue
    $error_message = 'Erreur de connexion à la base de données.';
} else {
    // Afficher un message si la connexion réussit
    $success_message = 'Connexion à la base de données réussie.';

    // Vérifier si un formulaire a été soumis et si la catégorie est définie
    if (isset($_POST['categorie'])) {
        $categorie = $_POST['categorie'];

        // Requête SQL pour récupérer les informations en utilisant une requête préparée
        $query = 'SELECT "DateService", "NomService", "CompétenceRequise" FROM public."Service" WHERE upper("Categorie") = upper($1)';

        // Exécution de la requête préparée
        $result = pg_query_params($conn, $query, array($categorie));

        // Vérifier si la requête a réussi
        if ($result) {
            // Initialiser un tableau pour stocker les résultats
            $services = [];
            // Parcourir les résultats de la requête et stocker les détails de chaque service
            while ($row = pg_fetch_assoc($result)) {
                $services[] = $row;
            }
        } else {
            $no_results_message = 'Il n\'existe pas d\'annonces correspondant à votre demande.';
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
    <?php include 'Header_profile.php'; ?>
    <div class="container">
        <h1>Résultat de recherche</h1>
        <p class="filter">Veuillez choisir parmi les catégories suivantes:</p>
        <form method="POST" action="">
            <ul class="options">
                <li><button class="button" type="submit" name="categorie" value="Travaux">Travaux</button></li>
                <li><button class="button" type="submit" name="categorie" value="Entretien">Entretien</button></li>
                <li><button class="button" type="submit" name="categorie" value="Animaux">Animaux</button></li>
                <li><button class="button" type="submit" name="categorie" value="Bricolage">Bricolage</button></li>
                <li><button class="button" type="submit" name="categorie" value="Aide à domicile">Aide à domicile</button></li>
 
  
            </ul>
        </form>

        <?php
        // Afficher les messages de succès ou d'erreur
        if (isset($error_message)) {
            echo '<p class="erreur">' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
        } elseif (isset($success_message)) {
            echo '<p>' . htmlspecialchars($success_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }

        // Afficher les résultats de la recherche si des services sont trouvés
        if (isset($services) && count($services) > 0) {
            foreach ($services as $service) {
                echo '<div class="service-propose">';
                echo '<p>Nom du service : ' . htmlspecialchars($service['NomService'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '<p>Date du service : ' . htmlspecialchars($service['DateService'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '<p>Compétence requise : ' . htmlspecialchars($service['CompétenceRequise'], ENT_QUOTES, 'UTF-8') . '</p>';
                echo '</div>';
            }
        } elseif (isset($no_results_message)) {
            echo '<p>' . htmlspecialchars($no_results_message, ENT_QUOTES, 'UTF-8') . '</p>';
        }
        ?>
    </div>
</body>
</html>