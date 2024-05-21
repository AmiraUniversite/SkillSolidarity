<?php
session_start(); // Démarrer la session

// Connexion à la base de données
$host = 'localhost';
$db = 'skis';
$user = 'postgres';
$pass = '016979B558@y'; // Remplacez par votre mot de passe
$port = '5433';
$conn_str = "host=$host port=$port dbname=$db user=$user password=$pass";
$conn = pg_connect($conn_str);

if (!$conn) {
    die('Erreur de connexion à la base de données.');
}

$image_url = 'images/no_reservation.jpg'; // Image par défaut

$nomservice = $dateservice = $dureeservice = $description = null;

if (isset($_GET['categorie']) && isset($_GET['nomservice']) && isset($_GET['dateservice']) && isset($_GET['dureeservice']) && isset($_GET['description'])) {
    $categorie = htmlspecialchars($_GET['categorie']);
    $nomservice = htmlspecialchars($_GET['nomservice']);
    $dateservice = htmlspecialchars($_GET['dateservice']);
    $dureeservice = htmlspecialchars($_GET['dureeservice']);
    $description = htmlspecialchars($_GET['description']);

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
            $image_url = 'images/mécanique.jpg';
            break;
        case 'DEMENAGEMENT':
            $image_url = 'images/demenagement.jpg';
            break;
        default:
            $image_url = 'images/no_reservation.jpg';
            break;
    }
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
            <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Mission Image">
        </div>
        <div class="mission-info">
            <h2>Détails de la mission :</h2>
            <?php if ($nomservice && $dateservice && $dureeservice && $description): ?>
                <h3><?php echo htmlspecialchars($nomservice); ?></h3>
                <p><?php echo htmlspecialchars($description); ?></p>
                <ul>
                    <li><i class="fas fa-calendar-alt"></i> Date de la mission : <?php echo htmlspecialchars($dateservice); ?></li>
                    <li><i class="fas fa-clock"></i> Durée de la mission : <?php echo htmlspecialchars($dureeservice); ?></li>
                </ul>
                <form action="mon_profil_1.php" method="POST">
                <input type="hidden" name="categorie" value="<?php echo htmlspecialchars($categorie); ?>">
                <input type="hidden" name="nomservice" value="<?php echo htmlspecialchars($nomservice); ?>">
                <input type="hidden" name="dateservice" value="<?php echo htmlspecialchars($dateservice); ?>">
                <input type="hidden" name="dureeservice" value="<?php echo htmlspecialchars($dureeservice); ?>">
                <input type="hidden" name="description" value="<?php echo htmlspecialchars($description); ?>">
                <button type="submit" class="confirm-button">Confirmer</button>
                </form>

            <?php else: ?>
                <p>Aucune mission trouvée pour cette catégorie.</p>
            <?php endif; ?>
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
