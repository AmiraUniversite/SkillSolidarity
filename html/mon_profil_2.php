<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MonProfil1</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<style>
  body, html {
    margin: 0;
    padding: 0;
    min-height: 100vh; 
    display: flex;
    flex-direction: column;
    font-family: 'Roboto', sans-serif;
    background: #f1f3f6;
  }

  .main-content {
    flex: 1;
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .profile-container {
    width: 60%; /* Reduced width */
    padding: 0;
    margin-bottom: 40px; /* Increased margin for more space */
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .info-box {
    width: 90%; /* Appropriate width */
    padding: 10px; /* Comfortable padding */
    border-radius: 15px;
    border: 2px solid #000; /* Black border */
    background: #ffffff; /* White background for the info box */
    display: grid;
    grid-template-columns: auto 1fr;
    align-items: center;
    gap: 10px;
  }

  .info-title {
    font-weight: bold;
    color: #555;
    text-align: right;
    padding-right: 10px;
  }

  .info-content {
    font-weight: normal;
    color: #666;
  }

  .rating {
    font-size: 16px;
    color: #f0c040; /* Color for stars */
  }

  .button {
    padding: 10px 20px;
    margin-top: 20px;
    background: #f2994a;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-size: 16px;
  }

  h1, .reservations-title {
    font-size: 24px;
    color: #f2994a; /* Orange color */
    margin: 10px 0;
    font-weight: bold;
  }

</style>
</head>
<body>
<?php include 'Header_accueil.html'; ?>
<div class="main-content">
  <div class="profile-container">
    <h1>Nom Prénom</h1>
    <div class="info-box">
      <div class="info-title">Adresse mail :</div>
      <div class="info-content">email@example.com</div>
      <div class="info-title">Numéro de téléphone :</div>
      <div class="info-content">+33000000000</div>
      <div class="info-title">Ville :</div>
      <div class="info-content">Toulouse</div>
      <div class="info-title">Compétences :</div>
      <div class="info-content">Jardinage - Intermédiaire</div>
      <div class="info-title">Note :</div>
      <div class="rating">★★★★☆</div>
    </div>
    <button class="button">Modifier mon profil</button>
  </div>
  <div class="reservations-title">Mes réservations</div>
  <!-- Insert dynamic content or additional layout for reservations here -->
</div>
<?php include 'Footer_mode_connecte.html'; ?>
</body>
</html>
