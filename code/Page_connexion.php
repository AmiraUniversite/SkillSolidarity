<?php
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'SkillSolidarity';
$user = 'postgres';
$pass = 'mfp98x'; // Remplacez par votre mot de passe
$port = '5432';
$conn_str = "host=$host port=$port dbname=$db user=$user password=$pass";



if (isset($_POST['connect'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de données PostgreSQL
    $conn = pg_connect($conn_str);

    if (!$conn) {
        // Afficher un message si la connexion échoue
        echo '<p class="erreur">Erreur de connexion à la base de données.</p>';
    } else {
        // Afficher un message si la connexion réussit
        echo '<p>Connexion à la base de données réussie.</p>';

        // Préparation et exécution de la requête pour vérifier l'email et le mot de passe
        $result = pg_prepare($conn, "my_query", "SELECT MotDePasseU FROM Utilisateur WHERE EmailU = $1");
        if (!$result) {
            echo '<p class="erreur">Erreur lors de la préparation de la requête.</p>';
        } else {
            $result = pg_execute($conn, "my_query", array($email));
            if (!$result) {
                echo '<p class="erreur">Erreur lors de l\'exécution de la requête.</p>';
            } else {
                $user = pg_fetch_assoc($result);
                if ($user && $password === $user['motdepasseu']) {
                    // Afficher un message si le mot de passe est correct
                    echo '<p>Connexion réussie. Redirection en cours...</p>';
                    // Redirection si le mot de passe est correct
                    header("Location: mon_profil_1.php");
                    exit;
                } else {
                    // Affichage d'un message d'erreur si le mot de passe ou l'email est incorrect
                    echo '<p class="erreur">Email ou mot de passe incorrect.</p>';
                }
            }
        }
    }

    // Fermeture de la connexion
    pg_close($conn);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap">
    <link rel="stylesheet" href="css/Page_connexion.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="images/logo.svg" alt="Logo">
        </div>
        <div class="nav-links">
            <a href="#">Accueil</a>
            <a href="#">Rechercher</a>
            <a href="#">Demander</a>
        </div>
        <div class="right-links">
            <a href="Page_connexion.php">Connexion</a>
            <a href="Inscription.php"><button>Inscrivez-vous</button></a>
        </div>
    </header>

    <div class="login-wrapper">
        <div class="login-image">
            <img src="images/client.png" alt="Login Image">
        </div>
        <div class="container">
            <h2>Connexion</h2>
            <form action="#" method="post">
                <label for="email">Adresse e-mail</label>
                <input type="email" id="email" name="email" placeholder="Adresse e-mail" required>
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Mot de passe" required>
                <input type="submit" value="Se connecter" name="connect">
            </form>
            <div class="separator" style="border-top: 1px solid #ccc; margin: 10px 0;"></div>
            <button class="btn-create-account">Créer un compte</button>
        </div>
    </div>

    <footer>
        <div class="footer-container">
            <div class="footer-left">
                <img src="images/logo.svg" alt="Logo">
            </div>

            <div class="footer-middle">
                <h4><a href="#">Publier un service</a></h4>
            </div>

            <div class="footer-right">
                <h4><a href="#">Qui sommes nous</a></h4>
            </div>
        </div>
        <hr>
        <div class="footer-container">
            <div class="footer-left">
                <a href="#">Contacter nous</a>
            </div>
        </div>
        <hr>
        <div class="copyright">
            &copy; SkillSolidarity 2024. We love our users!
        </div>
    </footer>
</body>
</html>