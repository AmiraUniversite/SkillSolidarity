<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription</title>
<link rel="stylesheet" href="inscription.css">
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
  <img class="image-right" src="inscription.jpg" alt="Image à droite">
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
