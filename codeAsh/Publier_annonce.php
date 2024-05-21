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
        <form id="serice_form" action="" method="post">
            <h2>Publier une offre</h2>
            <label for="titre">
                <span>Titre</span>
                <input name="titre" type="text" id="titre" placeholder="&#x1F4DD;">
            </label>
            <label for="categorie">
                <span>Catégorie</span>
                <input name="categorie" type="text" id="categorie" placeholder="Jardinage/Plomberie/Ménage/Peinture/Mécanique/Déménagement">
            </label>
            <label for="expertise">
                <span>Niveau d'expertise</span>
                <input name="expertise" type="text" id="expertise" placeholder="Débutant/Intermédiaire/Expert">
            </label>
            <label for="date">
                <span>Date</span>
                <input name="date" type="date" id="date">
            </label>
            <label for="heure">
                <span>Heure</span>
                <input name="heure" type="time" id="heure">
            </label>
            <label for="duree">
                <span>Durée</span>
                <input name="duree" type="time" id="duree" placeholder="&#x23F3;">
            </label>
            <label for="description">
                <span>Description</span>
                <textarea name="description" id="description" placeholder="&#x1F4DD;"></textarea>
            </label>
            <button type="submit">Publier</button>
        </form>
    </div>
<?php
session_start(); // Démarrer la session
$host = "localhost";
$port = "5432"; // default PostgreSQL port is 5432
$dbname = "nom_BD";
$user = "postgres";
$password = "MDP";

// Connect to PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
if (!$conn) {
    die("Error: Unable to connect to database");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['titre'];
    $categorie = str_replace('é','E',(strtoupper($_POST['categorie'])));
    $expertise = str_replace('é','E',(strtoupper($_POST['expertise'])));
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    $description = $_POST['description'];

    $dateService = $date . ' ' . $heure . ':00';

    $sql = "INSERT INTO public.\"Service\" ( nomservice, niveauservice, description_optionnel_,categorie,dateService,dureeService) VALUES ('$titre', '$expertise', '$description', '$categorie', '$dateService', '$duree')";
    $result = pg_query($conn, $sql);
    if ($result) {
        // Affichage d'un message en cas de succès
        echo "Publication de l'annonce effectuée avec succès !",
        exit;
    } else {
        // En cas d'échec, affichage d'un message d'erreur
        echo "Erreur lors de la publication de l'annonce.";
    }
}
pg_close($conn); // Fermeture de la connexion à la base de données
?>

<!-- faire un lien vers le footer-->
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
