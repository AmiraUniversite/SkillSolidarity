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
</body>
</html>

<?php
// Connexion à la base de données
$conn = pg_connect("host=localhost dbname=nom_de_votre_base_de_donnees user=votre_nom_utilisateur password=votre_mot_de_passe");

// Vérification de la connexion
if (!$conn) {
    echo "Erreur de connexion à la base de données.";
    exit;
}

// Récupération des données du formulaire
$username = pg_escape_string($_POST['nom_utilisateur']);
$mail = pg_escape_string($_POST['mail']);
$password = pg_escape_string($_POST['mot_de_passe']);

// Requête SQL pour insérer les données dans la table
$sql = "INSERT INTO votre_table (nom_utilisateur, mail, mot_de_passe) VALUES ('$username', '$mail', '$password')";

// Exécution de la requête
$result = pg_query($conn, $sql);

if ($result) {
    // Redirection vers une autre page en cas de succès
    header("Location: autre_page.php");
    exit;
} else {
    // En cas d'échec, affichage d'un message d'erreur
    echo "Erreur lors de l'inscription.";
}

// Fermeture de la connexion à la base de données
pg_close($conn);
?>



