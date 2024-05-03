<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Création de Compte</title>
<style>
  body, html {
    margin: 0;
    padding: 0;
    height: 100vh;
    font-family: 'Arial', sans-serif;
    background: #f7f7f7;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }

  header {
    background-color: #ffa64d; /* Orange clair */
    color: #000; /* Texte en noir */
    padding: 10px;
    text-align: right; /* Alignement du texte à droite */
    font-family: 'Roboto', sans-serif; /* Utilisation de la police Roboto */
    font-size: 14px; /* Taille de police réduite */
    letter-spacing: 2px; /* Espacement entre les lettres */
    font-weight: bold; /* Ajout du gras */
  }

  header a {
    color: #000; /* Texte des liens en noir */
    text-decoration: none; /* Suppression du soulignement des liens */
    margin-left: 15px; /* Marge entre les liens */
  }

  .signup-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    margin-left: 20px; /* Aligning the container to the left */
    width: 300px;
    font-family: 'Roboto', sans-serif; /* Utilisation de la police Roboto */
  }

  .signup-title {
    font-size: 24px;
    color: #ff9500;
    text-align: center;
    margin-bottom: 10px;
  }

  .signup-header {
    color: #333;
    text-align: center;
    margin-bottom: 30px;
  }

  .signup-form label {
    display: block;
    margin-bottom: 10px;
    color: #333;
  }

  .signup-form input {
    width: 100%;
    padding: 12px;
    margin-bottom: 25px;
    border: 1px solid #ccc;
    background-color: #f0f0f0;
    border-radius: 4px;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif; /* Utilisation de la police Roboto */
  }

  .signup-form button {
    width: 100%;
    padding: 12px;
    border-radius: 4px;
    border: none;
    background-color: #ff9500;
    color: white;
    font-weight: bold;
    cursor: pointer;
    margin-top: 25px;
    font-family: 'Roboto', sans-serif; /* Utilisation de la police Roboto */
  }

  /* Footer style */
  footer {
    text-align: center;
    margin-top: 20px;
    color: #888;
    align-self: center; /* Centering the footer */
  }
</style>
</head>
<body>
<header>
  <nav>
    <a href="#">Inscription</a>
    <a href="#">Connexion</a>
    <a href="#">Support</a>
    <a href="#">Recherche</a>
    <a href="#">Offres</a>
  </nav>
</header>
<div class="signup-container">
  <h1 class="signup-title">SkillSolidarity</h1>
  <div class="signup-header">
    <h2>Création d'un compte</h2>
  </div>
  <form class="signup-form" method="post">
    <label for="nom">Nom d'utilisateur</label>
    <input name="nom" type="text" id="nom" required>
    
    <label for="prénom">Nom d'utilisateur</label>
    <input name="prénom" type="text" id="prénom" required>

    <label for="email">Adresse mail</label>
    <input name="email" type="email" id="email" placeholder="nom@example.com" required>
    
    <label for="password">Mot de passe</label>
    <input name="password" type="password" id="password" required>
    
    <button type="submit">Créer un compte</button>
  </form>


  
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $nom = $_POST["nom"];
      $prénom = $_POST["prénom"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      // Contrôle de saisie
      if (empty($nom) || empty($prénom) || empty($email) || empty($password)) {
          echo "Veuillez remplir tous les champs.";
      } else {
          // Vérification des caractères spéciaux dans le mot de passe
          if (!preg_match('/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]+$/', $password)) {
              // Connexion à la base de données
              $connexion = pg_connect("host=localhost dbname=SkillSolidarity_Valerian user=postgres password=mfp98x");
              if (!$connexion) {
                  echo "Erreur lors de la connexion à la base de données.<br>";
                  exit;
              }

              // Préparation de la requête d'insertion
              $id_utilisateur+=1;
              $query = "INSERT INTO utilisateur (idutilisateur, nomu, prénomu, emailu, motdepasseu, adresse , code_postal, ville, dateinscriptionu, noteu, creditu, roleu) VALUES ('$id_utilisateur', '$nom', '$prénom', '$email', '$password')";

              // Exécution de la requête
              $result = pg_query($connexion, $query);

              if ($result) {
                  echo "Compte créé avec succès!";
              } else {
                  echo "Erreur lors de la création du compte.";
              }

              // Fermeture de la connexion
              pg_close($connexion);
          } else {
              echo "Le mot de passe doit être composé uniquement de caractères et de chiffres.";
          }
      }
  }
?>
</div>
<!-- Footer -->
<footer>@SkillSolidarity 2024 Copyright</footer>
</body>
</html>