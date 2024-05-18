<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription</title>
<link rel="stylesheet" href="css/inscription.css">
</head>

<body>
<?php include 'Header_accueil.html'; ?>

<div class="main-content">
  <div id="personal-info-section" class="signup-container">
    <h1 class="signup-title">Inscription</h1>
    <h3 class="information-title"> Veuillez entrer vos informations</h3>
    <form class="signup-form" id="personal-info-form" onsubmit="return moveToNextPage()">
      <input type="hidden" name="step" value="2">
      <input name="nom d'utilisateur" type="text" pattern="[A-Za-z]+" placeholder="Nom d'utilisateur" required>
      <input name="mail" type="text" pattern="[A-Za-z]+" placeholder="Adresse mail" required>
      <input name="mot de passe" type="text" placeholder="Mot de passe" required>
      <button type="submit-registration">Créer un compte</button>
    </form> 
  </div>
</div>
<img class="image-gauche" src="images/inscription.jpg">

<?php include 'Footer_mode_connecte.html'; ?>

<script>
  function moveToNextPage() {
    document.getElementById('personal-info-section').style.display = 'none';
    document.getElementById('email-section').style.display = 'block';
    return false; // Prevents form submission
  }
</script>

</body>
</html>

<?php
session_start(); // Démarrer la session

// Paramètres de connexion à la base de données
$host = 'localhost';
$port = '5433';
$dbname = 'SkillSoly';
$user = 'postgres';
$pass = '016979B558@y';
$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données: " . $e->getMessage());
}

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Récupération et validation des données du formulaire
    $nom = filter_input(INPUT_POST, 'nom', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Validation supplémentaire
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Requête SQL INSERT pour insérer les données dans la table "utilisateur"
    $requete = "INSERT INTO utilisateur (nomu, emailu, motdepasseu)
                VALUES (:nom, :email, :motdepasse)";

    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':motdepasse', $hashed_password);

    // Exécution de la requête SQL
    if ($stmt->execute()) {
        echo "Inscription réussie.";
    } else {
        echo "Erreur lors de l'inscription.";
    }

    // Fermer la connexion à la base de données
    $pdo = null;
}
?>

