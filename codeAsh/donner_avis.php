<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

// Récupérer les données du formulaire
$idservice = $_POST['idservice'];
$idutilisateur = $_POST['idutilisateur'];
$note = $_POST['note'];
$commentaire = $_POST['commentaire'];

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'Skillsolidarity';
$user = 'postgres';
$password = 'mfp98x';
$port = '5432'; // port par défaut pour PostgreSQL, à changer si différent

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

// Se connecter à la base de données
$conn = connectDb();

// Vérifier si la connexion a réussi
if ($conn) {
    // Définir la requête pour insérer un nouvel avis avec des paramètres
    $insert_query = "
    INSERT INTO public.\"Avis\" (note, commentaire, dateavis, idutilisateur, idservice)
    VALUES ($1, $2, NOW(), $3, $4);
    ";

    // Préparer la requête
    $result = pg_prepare($conn, "insert_review", $insert_query);

    // Exécuter la requête préparée avec les paramètres
    $insert_result = pg_execute($conn, "insert_review", array($note, $commentaire, $idutilisateur, $idservice));

    // Vérifier si la requête d'insertion a réussi
    if ($insert_result) {
        // Redirection après un ajout réussi
        header("Location: mon_profil_1.php");
        exit(); // Assurez-vous que le script s'arrête après la redirection
    } else {
        echo "Une erreur est survenue lors de l'insertion de l'avis : " . pg_last_error($conn);
    }

    // Fermer la connexion à la base de données
    pg_close($conn);
} else {
    echo "Échec de la connexion à la base de données.";
}
?>
