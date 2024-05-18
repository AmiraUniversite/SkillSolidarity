<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publier une offre</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="css/Style_publier_annonces.css">
</head>
<body>
    <?php include 'Header_profile.php'; ?>

    <div class="form-container">
        <form>
            <h2>Publier une offre</h2>
            <label for="titre">
                <span>Titre</span>
                <input type="text" id="titre" placeholder="&#x1F4DD;">
            </label>
            <label for="categorie">
                <span>Catégorie</span>
                <input type="text" id="categorie" placeholder="&#x1F4C4;">
            </label>
            <!-- <label for="expertise">
                <span>Niveau d’expertise</span>
                <input type="text" id="expertise" placeholder="&#x1F465;">
            </label> -->
            <label for="date">
                <span>Date</span>
                <input type="date" id="date">
            </label>
            <label for="heure">
                <span>Heure</span>
                <input type="time" id="heure">
            </label>
            <label for="duree">
                <span>Durée</span>
                <input type="text" id="duree" placeholder="&#x23F3;">
            </label>
            <label for="description">
                <span>Description</span>
                <textarea id="description" placeholder="&#x1F4DD;"></textarea>
            </label>
            <button type="submit">Publier</button>
        </form>
    </div>

    <footer>
        <div class="footer-nav">
            <a href="#" class="footer-nav-item">Contactez-nous</a>
            <a href="#" class="footer-nav-item">Qui sommes nous</a>
            <div class="footer-logo">
                <img src="images/logo.png" alt="Logo">
            </div>
            <a href="#" class="footer-nav-item">Services</a>
            <a href="#" class="footer-nav-item">Publier un service</a>
        </div>
        <div class="footer-separator"></div>
        <div class="copyright">
            &copy; SkillSolidarity. We love our users!
        </div>
    </footer>
</body>
</html>
