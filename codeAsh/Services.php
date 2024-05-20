<?php
session_start(); // Démarrer la session

// Connexion à la base de données PostgreSQL
$host = 'localhost';
$dbname = 'Sitee';
$user = 'postgres';
$password = 'amira';
$port = '5432'; // default port for PostgreSQL, change if different
$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

$conn = pg_connect($connection_string);

if (!$conn) {
    // Afficher un message si la connexion échoue
    echo '<p class="erreur">Erreur de connexion à la base de données.</p>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de recherche</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            width: 80%;
            margin: auto;
            overflow: hidden;
            flex: 1;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .filter {
            text-align: center;
            margin-bottom: 20px;
        }
        .options {
            list-style: none;
            padding: 0;
            display: flex;
            justify-content: center;
            gap: 10px;
            flex-wrap: wrap;
        }
        .button {
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #e68900;
        }
        .services-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        .service-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 100%; /* Ajuster la largeur au besoin */
            max-width: 800px; /* Largeur maximale */
            margin-bottom: 20px;
            display: flex; /* Pour afficher l'image et le contenu côte à côte */
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .service-image {
            flex: 0 0 100px; /* Taille fixe pour l'image */
            height: 100px; /* Hauteur fixe pour l'image */
            object-fit: cover;
            margin-right: 20px; /* Espace entre l'image et le texte */
        }
        .service-info {
            flex: 1;
        }
        .service-info h2 {
            margin-top: 0;
        }
        .buttons-container {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .reserve-button {
            display: inline-block;
            background-color: #ff9800;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-align: center;
            text-decoration: none;
        }
        .reserve-button:hover {
            background-color: #e68900;
        }
        .no-service {
            text-align: center;
        }
    </style>
</head>
<body>
    <?php include 'Header_profile.php';?>
    <div class="container">
        <h1>Résultats de recherche</h1>
        <p class="filter">Veuillez choisir parmi les catégories suivantes:</p>
        <form method="POST" action="">
            <ul class="options">
                <li><button type="submit" name="categorie" value="JARDINAGE" class="button">Jardinage</button></li>
                <li><button type="submit" name="categorie" value="PLOMBERIE" class="button">Plomberie</button></li>
                <li><button type="submit" name="categorie" value="MENAGE" class="button">Ménage</button></li>
                <li><button type="submit" name="categorie" value="PEINTURE" class="button">Peinture</button></li>
                <li><button type="submit" name="categorie" value="MECANIQUE" class="button">Mécanique</button></li>
                <li><button type="submit" name="categorie" value="DEMENAGEMENT" class="button">Déménagement</button></li>
            </ul>
        </form>
        <div class="services-container">
            <?php
            if (!isset($_POST['categorie'])) {
                $categorie = 'JARDINAGE';
            } else {
                $categorie = $_POST['categorie'];
            }
            $query = 'SELECT "dateservice", "nomservice", "description_optionnel_", "dureeservice" FROM public."Service" WHERE upper("categorie") = upper($1)';
            $result = pg_query_params($conn, $query, array($categorie));
            if ($result && pg_num_rows($result) > 0) {
                while ($row = pg_fetch_assoc($result)) {
                    $date_service = new DateTime($row['dateservice']);
                    $image_url = '';
                    switch (strtoupper($categorie)) {
                        case 'PLOMBERIE':
                            $image_url = 'images/plomberie.jpg';
                            break;
                        case 'JARDINAGE':
                            $image_url = 'images/jardinage.jpg';
                            break;
                        case 'MENAGE':
                            $image_url = 'images/menage.jpg';
                            break;
                        case 'PEINTURE':
                            $image_url = 'images/peinture.jpg';
                            break;
                        case 'MECANIQUE':
                            $image_url = 'images/mecanique.jpg';
                            break;
                        case 'DEMENAGEMENT':
                            $image_url = 'images/demenagement.jpg';
                            break;
                        default:
                            $image_url = 'images/no_reservation.jpg';
                            break;
                    }
            ?>
            <div class="service-card">
                <img src="<?php echo $image_url; ?>" alt="<?php echo htmlspecialchars($row['nomservice']); ?>" class="service-image">
                <div class="service-info">
                    <h2><?php echo htmlspecialchars($row['nomservice']); ?></h2>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($date_service->format('Y-m-d')); ?></p>
                    <p><strong>Heure:</strong> <?php echo htmlspecialchars($date_service->format('H:i')); ?></p>
                    <p><strong>Durée:</strong> <?php echo htmlspecialchars($row['dureeservice']); ?></p>
                    <p><strong>Description:</strong> <?php echo htmlspecialchars($row['description_optionnel_']); ?></p>
                </div>
                <div class="buttons-container">
                    <a href="test.php?categorie=<?php echo urlencode($categorie); ?>&nomservice=<?php echo urlencode($row['nomservice']); ?>&dateservice=<?php echo urlencode($date_service->format('Y-m-d H:i:s')); ?>&dureeservice=<?php echo urlencode($row['dureeservice']); ?>&description=<?php echo urlencode($row['description_optionnel_']); ?>" class="reserve-button">Réserver</a>
                </div>
            </div>
            <?php
                }
            } else {
                echo '<div class="no-service">';
                echo '<img src="images/no_reservation.jpg" alt="No Service">';
                echo '<p>Il n\'existe pas d\'annonce correspondant à votre demande.</p>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
    <?php include 'Footer_mode_connecte.html'; ?>
</body>
</html>
