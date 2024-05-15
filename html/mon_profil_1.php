<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MonProfil1</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/mon_profil_1.css">

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
