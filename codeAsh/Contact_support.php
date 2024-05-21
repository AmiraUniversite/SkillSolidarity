<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nous contacter</title>
    <link rel="stylesheet" href="css/Contact_support.css">
</head>

<body>
<?php include 'Header_profile.php'; ?>
    <div class="container">
        <h1>Nous contacter</h1>
        <form action="#" method="post">
            <div class="input-container">
                <input type="text" id="name" name="name" placeholder="Votre nom" required>
            </div>
            <div class="input-container">
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>
            <div class="input-container">
                <textarea id="message" name="message" placeholder="Votre message" rows="6" required></textarea>
            </div>
            <button type="submit">Envoyer</button>
        </form>
    </div>
</body>
</html>


<?php
// Configuration de la base de données
$host = "localhost";
$port = "5433";
$dbname = "skis";
$user = "postgres";
$password = "016979B558@y";

// Connexion à la base de données
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué");
}

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    
    // Préparer et exécuter la requête SQL d'insertion
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    $result = pg_query($conn, $sql);
    if ($result) {
        echo "Votre message a été envoyé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de l'envoi de votre message : " . pg_last_error($conn);
    }
}

// Fermer la connexion à la base de données
pg_close($conn);
?>
