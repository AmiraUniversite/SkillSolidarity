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
    justify-content: center; 
    align-items: center; 
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

  .signup-image {
    
    height: auto;
    margin-left: auto; 
    margin-right: 50px; 
    margin-top: 0px; 
    margin-bottom: 40px; 
  }
</style>
</head>
<body>

<?php include 'Header_accueil.html'; ?>

<div class="main-content">
  <div class="signup-container">
    <?php
      if ($_POST['step'] == '1') {
    ?>
          <h1 class="signup-title">Entrez vos informations</h1>
          <form class="signup-form" method="post">
            <input type="hidden" name="step" value="2">
            <label for="nom" style="display: none;">Nom :</label>
            <input name="nom" type="text" id="nom" placeholder="Entrez votre nom" required>
            
            <label for="prénom" style="display: none;">Prénom :</label>
            <input name="prénom" type="text" id="prénom" placeholder="Entrez votre prénom" required>

            <label for="adresse" style="display: none;">Adresse postale :</label>
            <input name="adresse" type="text" id="adresse" placeholder="Entrez votre adresse postale" required>

            <label for="ville" style="display: none;">Ville :</label>
            <input name="ville" type="text" id="ville" placeholder="Entrez votre ville" required>

            <label for="code_postal" style="display: none;">Code postal :</label>
            <input name="code_postal" type="text" id="code_postal" placeholder="Entrez votre code postal" required>
            
            <button type="submit">Suivant</button>
          </form>
    <?php
        } elseif ($_POST['step'] == '2') {
    ?>
          <h1 class="signup-title">Finalisez votre inscription</h1>
          <form class="signup-form" method="post">
            <input type="hidden" name="step" value="3">
            <label for="email" style="display: none;">Adresse mail :</label>
            <input name="email" type="email" id="email" placeholder="Entrez votre adresse mail" required>
            
            <label for="password" style="display: none;">Mot de passe :</label>
            <input name="password" type="password" id="password" placeholder="Entrez votre mot de passe" required>

            <label for="confirm_password" style="display: none;">Confirmation du mot de passe :</label>
            <input name="confirm_password" type="password" id="confirm_password" placeholder="Confirmez votre mot de passe" required>
            
            <button type="submit">Créer un compte</button>
          </form>
    <?php
        } elseif ($_POST['step'] == '3') {
            echo "<h1 class='signup-title'>Inscription terminée !</h1>";
        } else {
    ?>
        <h1 class="signup-title">Inscription</h1>
        <form class="signup-form" method="post">
          <input type="hidden" name="step" value="1">
          <label for="nom" style="display: none;">Nom :</label>
          <input name="nom" type="text" id="nom" placeholder="Entrez votre nom" required>
          
          <label for="prénom" style="display: none;">Prénom :</label>
          <input name="prénom" type="text" id="prénom" placeholder="Entrez votre prénom" required>

          <label for="adresse" style="display: none;">Adresse postale :</label>
          <input name="adresse" type="text" id="adresse" placeholder="Entrez votre adresse postale" required>

          <label for="ville" style="display: none;">Ville :</label>
          <input name="ville" type="text" id="ville" placeholder="Entrez votre ville" required>

          <label for="code_postal" style="display: none;">Code postal :</label>
          <input name="code_postal" type="text" id="code_postal" placeholder="Entrez votre code postal" required>
          
          <button type="submit">Suivant</button>
        </form>
    <?php
    }
    ?>
  </div>

  <img class="signup-image" src="images/inscription.jpg" alt="Description de l'image">
</div>


<?php include 'footer.html'; ?>

</body>
</html>