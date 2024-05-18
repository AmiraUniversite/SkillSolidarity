<?php
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'nom_BD';
$user = 'postgres';
$pass = 'MDP'; // Remplacez par votre mot de passe
$port = '5432';
$conn_str = "host=$host port=$port dbname=$db user=$user password=$pass";

// Connexion à la base de données PostgreSQL
$conn = pg_connect($conn_str);

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

// ID de la mission à récupérer (vous devrez peut-être obtenir cette valeur d'une autre manière, comme via un paramètre GET)
$missionId = 'S1'; // Remplacez par l'ID réel de la mission

$query = 'SELECT "nomservice", "description_optionnel_", "categorie", "dateservice", "dureeservice" FROM public."Service" WHERE "idservice" = $1';
$result = pg_prepare($conn, "my_query", $query);
$result = pg_execute($conn, "my_query", array($missionId));

$mission = pg_fetch_assoc($result);

if (!$mission) {
    die('Mission non trouvée.');
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmer la réservation</title>
    <link rel="stylesheet" href="css/Header_profile.css">
    <link rel="stylesheet" href="css/Footer_mode_connecte.css">
    <link rel="stylesheet" href="css/confirmation_reservation.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
<?php include 'Header_profile.php'; ?>

<main class="confirmation-container">
    <h1>Confirmer la réservation</h1>
    <div class="mission-details">
        <div class="mission-image">
            <img src="images/plomberie_maison_creation.jpeg" alt="Mission Image">
        </div>
        <div class="mission-info">
            <h2>Détails de la mission :</h2>
            <h3><?php echo htmlspecialchars($mission['nomservice']); ?></h3>
            <p><?php echo htmlspecialchars($mission['description_optionnel_']); ?></p>
            <ul>
                <li><i class="fas fa-calendar-alt"></i> Date de la mission : <?php echo htmlspecialchars($mission['dateservice']); ?></li>
                <li><i class="fas fa-wrench"></i> Catégorie : <?php echo htmlspecialchars($mission['categorie']); ?></li>
               <!-- <li><i class="fas fa-money-bill-wave"></i> Crédit requis : <?php// echo htmlspecialchars($mission['creditrequis']); ?></li>
                <li><i class="fas fa-tools"></i> Compétence requise : <?php// echo htmlspecialchars($mission['competencerequise']); ?></li>-->
            </ul>
            <a href="Services.php" class="confirm-button">Confirmer</a>
        </div>
    </div>
</main>

<footer>
    <div class="footer-nav">
        <a href="Contact_support.html" class="footer-nav-item">Contactez-nous</a>
        <a href="#" class="footer-nav-item">Qui sommes nous</a>
        <div class="footer-logo">
            <img src="images/logo.svg" alt="Logo">
        </div>
        <a href="Services.php" class="footer-nav-item">Services</a>
        <a href="./Publier_annonce.php" class="footer-nav-item">Publier un service</a>
    </div>
    <div class="footer-separator"></div>
    <div class="copyright">
        &copy; SkillSolidarity. We love our users!
    </div>
</footer>

<!-- Inclusion de Font Awesome pour les icônes -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>


