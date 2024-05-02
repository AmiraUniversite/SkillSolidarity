<?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];

      // Contrôle de saisiepg
      if (empty($username) || empty($email) || empty($password)) {
          echo "Veuillez remplir tous les champs.";
      } else {
          // Vérification des caractères spéciaux dans le mot de passe
          if (!preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $password)) {
              // Connexion à la base de données
              $connexion = pg_connect("host=localhost dbname=SkillSolidarityAymane user=postgres password=mfp98x");
              if (!$connexion) {
                  echo "Erreur lors de la connexion à la base de données.<br>";
                  exit;
              }

              // Préparation de la requête d'insertion
              $query = "INSERT INTO utilisateurs (username, email, password) VALUES ('$username', '$email', '$password')";

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