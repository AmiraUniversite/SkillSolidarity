<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

// Récupérer l'identifiant de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Database connection settings
$host = 'localhost';
$dbname = 'SkillSolidarity';
$user = 'postgres';
$password = 'mfp98x';
$port = '5432'; // default port for PostgreSQL, change if different

$connection_string = "host={$host} port={$port} dbname={$dbname} user={$user} password={$password}";

// Function to connect to the database
function connectDb() {
    global $connection_string;
    $conn = pg_connect($connection_string);
    if ($conn) {
        return $conn;
    } else {
        echo "Error in connecting to PostgreSQL database.\n";
        return false;
    }
}

// Initialize variables for user information
$user_info = null;
$error_message = null;
$reservations = [];

// Connect to the database
$conn = connectDb();

// Check if the connection was successful
if ($conn) {
    // Define the query to fetch user data
    $user_query = "
    SELECT * FROM public.\"Utilisateur\"
    WHERE \"idutilisateur\" = '$user_id';
    ";

    // Execute the query to fetch user data
    $user_result = pg_query($conn, $user_query);

    // Check if the user query was successful
    if ($user_result) {
        if (pg_num_rows($user_result) > 0) {
            $user_info = pg_fetch_assoc($user_result);
        } else {
            $error_message = "User not found.";
        }
    } else {
        $error_message = "An error occurred while querying the database: " . pg_last_error($conn);
    }

    // Define the query to fetch user reservations
    $reservations_query = "
    SELECT s.*, o.\"dateservice\" as \"date_service\"
    FROM public.\"Service\" s
    JOIN public.\"Offrir\" o ON s.\"idservice\" = o.\"idservice\"
    WHERE o.\"idutilisateur\" = '$user_id';
    ";

    // Execute the query to fetch reservations
    $reservations_result = pg_query($conn, $reservations_query);

    // Check if the reservations query was successful
    if ($reservations_result) {
        while ($reservation = pg_fetch_assoc($reservations_result)) {
            $reservations[] = $reservation;
        }
    } else {
        $error_message = "An error occurred while querying the reservations: " . pg_last_error($conn);
    }

    // Close the database connection
    pg_close($conn);
} else {
    $error_message = "Failed to connect to the database.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon Profil</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/mon_profil_1.css"> <!-- Adjusted path -->
</head>
<body>
<?php include 'Header_profile.php'; ?>
<div class="main-content">
  <h1 class="user-name"><?php echo isset($user_info) ? htmlspecialchars($user_info['nomu']) . ' ' . htmlspecialchars($user_info['prénomu']) : 'Nom Prénom'; ?></h1>
  <div class="profile-container">
    <div class="info-box">
      <div class="info-title">Adresse mail :</div>
      <div class="info-content"><?php echo isset($user_info) ? htmlspecialchars($user_info['emailu']) : 'email@example.com'; ?></div>
      <div class="info-title">Numéro de téléphone :</div>
      <div class="info-content"><?php echo isset($user_info) ? '+33000000000' : '+33000000000'; ?></div> <!-- Placeholder for phone number -->
      <div class="info-title">Ville :</div>
      <div class="info-content"><?php echo isset($user_info) ? htmlspecialchars($user_info['ville']) : 'Toulouse'; ?></div>
      <div class="info-title">Compétences :</div>
      <div class="info-content"><?php echo isset($user_info) ? 'Jardinage - Intermédiaire' : 'Jardinage - Intermédiaire'; ?></div> <!-- Placeholder for skills -->
      <div class="info-title">Note :</div>
      <div class="rating"><?php echo isset($user_info) ? str_repeat('★', $user_info['noteu']) . str_repeat('☆', 5 - $user_info['noteu']) : '★★★★☆'; ?></div>
    </div>
    <button class="button">Modifier mon profil</button>
  </div>
  <div class="reservations-title">Mes réservations</div>
  <div class="reservations-container">
    <?php if (count($reservations) > 0): ?>
      <?php foreach ($reservations as $reservation): ?>
        <div class="reservation-card">
          <img src="path/to/image.jpg" alt="Service Image" class="reservation-image">
          <div class="reservation-details">
            <h3><?php echo htmlspecialchars($reservation['nomservice']); ?></h3>
            <p><strong><?php echo date('l, d M Y', strtotime($reservation['date_service'])); ?></strong></p>
            <p><?php echo date('H:i', strtotime($reservation['date_service'])); ?></p>
          </div>
          <div class="reservation-status">
            <?php
            $now = new DateTime();
            $service_date = new DateTime($reservation['date_service']);
            $status_class = ($service_date > $now) ? 'status-upcoming' : 'status-completed';
            $status_text = ($service_date > $now) ? 'Arrive bientôt' : 'Terminé';
            ?>
            <p class="<?php echo $status_class; ?>"><?php echo $status_text; ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
  </div>
</div>
<?php include 'Footer_mode_connecte.html'; ?>
</body>
</html>
