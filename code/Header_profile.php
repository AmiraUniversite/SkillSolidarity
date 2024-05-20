<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Header</title>
<link rel="stylesheet" href="css/Header_profile.css">
</head>
<body>
<header>
    <div class="logo">
        <img src="images/logo.svg" alt="Logo">
    </div>
    <div class="nav-links">
        <a href="./Page_Acceuil/index.php">Accueil</a>
        <a href="./Services.php">Rechercher</a>
        <a href="./Publier_annonce.php">Demander</a>
    </div>
    <div class="right-links">
        <button>Profil</button>
        <!-- Ajouter le bouton de déconnexion -->
        <form action="logout.php" method="POST" style="display:inline;">
            <button type="submit">Déconnexion</button>
        </form>
    </div>
</header>
</body>
</html>
<?php
session_start();
session_unset();
session_destroy();
header("Location: Page_Acceuil/index.php");
exit;
?>

