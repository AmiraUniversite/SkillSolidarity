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
    <h3 class="information-title">Veuillez entrer vos informations</h3>
    <form class="signup-form" id="personal-info-form" action="traitement_inscription.php" method="POST">
      <input type="hidden" name="step" value="2">
      <input name="nom_utilisateur" type="text" placeholder="Nom d'utilisateur" required>
      <input name="mail" type="email" placeholder="Adresse mail" required>
      <input name="mot_de_passe" type="password" placeholder="Mot de passe" required>
      <button type="submit" name="submit-registration">Créer un compte</button>
    </form> 
  </div>
</div>
<img class="image-gauche" src="images/inscription.jpg">

<?php include 'Footer_mode_connecte.html'; ?>
</body>
</html>



<?php
session_start(); // Démarrer la session

$host = 'localhost';
$db = 'nom_BD';
$user = 'postgres';
$pass = 'MDP';
$port = '5432';
$conn_str = "host=$host port=$port dbname=$db user=$user password=$pass";

// Connexion à la base de données PostgreSQL
$conn = pg_connect($conn_str);
// Vérification de la connexion
if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

// Récupération des données du formulaire
$nom = pg_escape_string($_POST['nom_utilisateur']);
$mail = pg_escape_string($_POST['mail']);
$password = pg_escape_string($_POST['mot_de_passe']);

// Requête SQL pour insérer les données dans la table
$sql = "INSERT INTO Utilisateur (UserU, EmailU, MotDePasseU) VALUES ('$nom', '$mail', '$password')";

// Exécution de la requête
$result = pg_query($conn, $sql);

if ($result) {
    // Redirection vers une autre page en cas de succès
    header("Location: Page_connexion.php");
    exit;
} else {
    // En cas d'échec, affichage d'un message d'erreur
    echo "Erreur lors de l'inscription.";
}

// Fermeture de la connexion à la base de données
pg_close($conn);
?>




