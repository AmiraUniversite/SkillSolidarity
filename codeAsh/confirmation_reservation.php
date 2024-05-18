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
                <h3>Dépannage Plomberie</h3>
                <p>Depuis quelques jours, j'ai remarqué que de l'eau s'accumule sous mon évier. Après une inspection rapide, il semble que le problème provienne d'un joint défectueux ou d'un tuyau endommagé. La fuite a déjà causé des dégâts mineurs sur le meuble sous l'évier et pourrait s'aggraver si elle n'est pas traitée rapidement</p>
                <ul>
                    <li><i class="fas fa-users"></i> Number of group: 15-30</li>
                    <li><i class="fas fa-clock"></i> Duration: 15 hours and 45 minutes</li>
                    <li><i class="fas fa-map-marker-alt"></i> Departuring and arriving areas: Lucca</li>
                </ul>
                <button class="confirm-button">Confirmer</button>
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
