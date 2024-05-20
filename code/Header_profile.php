<?php
// db.php
$host = 'localhost';
$dbname = 'nom_BD';
$user = 'postgres';
$password = 'MDP';
$port = '5432'; // port par défaut pour PostgreSQL, à changer si nécessaire

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

// Fonction pour se connecter à la base de données
function connectDb() {
    global $connection_string;
    $conn = pg_connect($connection_string);
    if ($conn) {
        return $conn;
    } else {
        echo "Erreur de connexion à la base de données PostgreSQL.\n";
        return false;
    }
}

// Fonction pour se déconnecter de la base de données
function disconnectDb($conn) {
    pg_close($conn);
}
?>

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
include 'db.php';

// Se connecter à la base de données
$conn = connectDb();

if ($conn) {
    // Vos opérations de déconnexion spécifiques à la base de données, si nécessaires
    // ...

    // Fermer la connexion à la base de données
    disconnectDb($conn);
}

// Désactiver toutes les variables de session
session_unset();

// Détruire la session
session_destroy();

// Rediriger l'utilisateur vers la page d'accueil
header("Location: Page_Acceuil/index.php");
exit;
?>


