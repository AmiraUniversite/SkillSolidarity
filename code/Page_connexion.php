<?php
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'SkillSolidarity';
$user = 'postgres';
$pass = '********';
$port = '5432';
$dsn = "pgsql:host=$host;port=$port;dbname=$db";


if (isset($_POST['connect'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT Userpassword FROM Utilisateur WHERE Pseudonyme = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $password === $user['userpassword']) {
            // Redirection si le mot de passe est correct
            header("Location: Accueil_Utilisateur.php");
            exit;
        } else {
            // Affichage d'un message d'erreur si le mot de passe ou le nom d'utilisateur est incorrect
            echo '<p class="erreur">Username ou password incorrect</p>';
        }
    } catch (PDOException $e) {
        $error = "Erreur de connexion à la base de données : " . $e->getMessage();
    }
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
                <input type="submit" value="Se connecter">
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

