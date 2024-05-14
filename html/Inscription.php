<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inscription</title>
<style>
  body, html {
    margin: 0;
    padding: 0;
    min-height: 100vh; 
    display: flex;
    flex-direction: column;
    font-family: 'Arial', sans-serif;
    background: #f1f3f6;
  }

  .header-container {
    width: 100%;
    padding: 20px 0;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  .main-content {
    flex: 1;
    display: flex;
    justify-content: flex-start; /* Align left */
    align-items: flex-start; /* Adjust to top */
    padding-left: 20px; /* Add padding to align with form */
    padding-top: 50px; /* Add padding to move the form up */
  }

  .signup-container {
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    padding: 20px;
    width: 400px;
    font-family: 'Roboto', sans-serif;
  }

  .signup-title {
    font-size: 24px;
    color: #f2994a;
    text-align: center;
    margin-bottom: 20px;
  }

  .signup-form input, .signup-form button {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    background-color: #f0f0f0;
    border-radius: 4px;
    box-sizing: border-box;
    font-family: 'Roboto', sans-serif;
  }

  .signup-form button {
    width: 100%;
    padding: 12px;
    margin-top: 20px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    background-color: #e68300;
    border-radius: 4px;
    font-family: 'Roboto', sans-serif;
    color: white;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
    font-size: 18px;
  }

  .signup-form button:hover {
    background-color: #f2994a;
  }
  
  footer {
    margin-top: 50px; /* Ajout de la marge supérieure */
  }
  
  .image-right {
    margin-left: auto; /* Aligner à droite */
  }
</style>
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
