

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
    <h1 class="signup-title">Entrez vos informations</h1>
    <form class="signup-form" id="personal-info-form" onsubmit="return moveToNextPage()">
      <input type="hidden" name="step" value="2">
      <input name="nom" type="text" pattern="[A-Za-z]+" placeholder="Entrez votre nom" required>
      <input name="prénom" type="text" pattern="[A-Za-z]+" placeholder="Entrez votre prénom" required>
      <input name="adresse" type="text" placeholder="Entrez votre adresse postale" required>
      <input name="ville" type="text" placeholder="Entrez votre ville" required>
      <input name="code_postal" type="text" placeholder="Entrez votre code postal" required>
      <button type="submit">Suivant</button>
    </form> 
  </div>

  <div id="email-section" class="signup-container" style="display: none;">
    <h1 class="signup-title">Finalisez votre inscription</h1>
    <form class="signup-form" id="email-form">
      <input type="hidden" name="step" value="3">
      
      <input name="email" type="email" placeholder="Adresse mail" required>
      <input name="password" type="password" placeholder="Mot de passe" required>
      <input name="confirm_password" type="password" placeholder="Confirmation du mot de passe" required>
      
      
      <button id="submit-registration" type="submit">Créer un compte</button>
    </form> 
  </div>
  <img class="image-right" src="images/inscription.jpg" alt="Image à droite">
</div>
<?php include 'Footer_mode_non_connecte.html'; ?>

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
    $prenom = filter_input(INPUT_POST, 'prénom', FILTER_SANITIZE_STRING);
    $adresse = filter_input(INPUT_POST, 'adresse', FILTER_SANITIZE_STRING);
    $ville = filter_input(INPUT_POST, 'ville', FILTER_SANITIZE_STRING);
    $code_postal = filter_input(INPUT_POST, 'code_postal', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $confirm_password = filter_input(INPUT_POST, 'confirm_password', FILTER_SANITIZE_STRING);

    // Validation supplémentaire
    if ($password !== $confirm_password) {
        die("Les mots de passe ne correspondent pas.");
    }

    // Hashage du mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Requête SQL INSERT pour insérer les données dans la table "utilisateur"
    $requete = "INSERT INTO utilisateur (nomu, prenomu, adresse, ville, code_postal, emailu, motdepasseu)
                VALUES (:nom, :prenom, :adresse, :ville, :code_postal, :email, :motdepasse)";

    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':ville', $ville);
    $stmt->bindParam(':code_postal', $code_postal);
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
