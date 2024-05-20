<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    echo "Vous devez être connecté pour accéder à cette page.";
    exit;
}

// Récupérer l'identifiant de l'utilisateur connecté
$user_id = $_SESSION['user_id'];

// Paramètres de connexion à la base de données
$host = 'localhost';
$dbname = 'Skillsolidarity';
$user = 'postgres';
$password = '123';
$port = '5432'; // default port for PostgreSQL, change if different
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

// Initialiser les variables pour les informations utilisateur
$user_info = null;
$error_message = null;
$upcoming_reservations = [];
$past_reservations = [];
$user_average_rating = null;

// Se connecter à la base de données
$conn = connectDb();

// Vérifier si la connexion a réussi
if ($conn) {
    // Définir la requête pour récupérer les informations utilisateur
    $user_query = "
    SELECT * FROM public.\"Utilisateur\"
    WHERE \"idutilisateur\" = '$user_id';
    ";

    // Exécuter la requête pour récupérer les informations utilisateur
    $user_result = pg_query($conn, $user_query);

    // Vérifier si la requête utilisateur a réussi
    if ($user_result) {
        if (pg_num_rows($user_result) > 0) {
            $user_info = pg_fetch_assoc($user_result);
        } else {
            $error_message = "Utilisateur non trouvé.";
        }
    } else {
        $error_message = "Une erreur est survenue lors de la requête utilisateur : " . pg_last_error($conn);
    }

    // Définir la requête pour récupérer les réservations utilisateur et les avis
    $reservations_query = "
    SELECT s.*, o.\"dateservice\" as \"date_service\", a.note, a.commentaire, s.categorie
    FROM public.\"Service\" s
    JOIN public.\"Offrir\" o ON s.\"idservice\" = o.\"idservice\"
    LEFT JOIN public.\"Avis\" a ON s.\"idservice\" = a.\"idservice\" AND a.\"idutilisateur\" = '$user_id'
    WHERE o.\"idutilisateur\" = '$user_id'
    ORDER BY o.\"dateservice\" DESC;
    ";

    // Exécuter la requête pour récupérer les réservations
    $reservations_result = pg_query($conn, $reservations_query);

    // Vérifier si la requête des réservations a réussi
    if ($reservations_result) {
        $now = new DateTime();
        while ($reservation = pg_fetch_assoc($reservations_result)) {
            $service_date = new DateTime($reservation['date_service']);
            if ($service_date > $now) {
                $upcoming_reservations[] = $reservation;
            } else {
                $past_reservations[] = $reservation;
            }
        }
    } else {
        $error_message = "Une erreur est survenue lors de la requête des réservations : " . pg_last_error($conn);
    }

    // Calculer la moyenne des notes
    $average_rating_query = "
    SELECT AVG(a.note) as average_rating
    FROM public.\"Avis\" a
    WHERE a.\"idutilisateur\" = '$user_id';
    ";

    $average_rating_result = pg_query($conn, $average_rating_query);

    if ($average_rating_result) {
        $average_rating_row = pg_fetch_assoc($average_rating_result);
        if ($average_rating_row && $average_rating_row['average_rating'] !== null) {
            $user_average_rating = round($average_rating_row['average_rating'], 2);
        } else {
            $user_average_rating = 'Aucune note';
        }
    } else {
        $error_message = "Une erreur est survenue lors du calcul de la moyenne des notes : " . pg_last_error($conn);
    }

    // Fermer la connexion à la base de données
    pg_close($conn);
} else {
    $error_message = "Échec de la connexion à la base de données.";
}

// Récupérer les données du formulaire de confirmation de réservation
$new_reservation = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['categorie']) && isset($_POST['nomservice']) && isset($_POST['dateservice']) && isset($_POST['dureeservice']) && isset($_POST['description'])) {
        $new_reservation = [
            'categorie' => htmlspecialchars($_POST['categorie']),
            'nomservice' => htmlspecialchars($_POST['nomservice']),
            'dateservice' => htmlspecialchars($_POST['dateservice']),
            'dureeservice' => htmlspecialchars($_POST['dureeservice']),
            'description' => htmlspecialchars($_POST['description'])
        ];
    }
}

// Fonction pour obtenir l'image correspondant à la catégorie
function getCategoryImage($categorie) {
    $images = [
        'JARDINAGE' => 'images/jardinage.jpg',
        'MECANIQUE' => 'images/mecanique.jpg',
        'MENAGE' => 'images/menage.jpg',
        'PEINTURE' => 'images/peinture.jpg',
        'PLOMBERIE' => 'images/plomberie.jpg',
        'DEMENAGEMENT' => 'images/demenagement.jpg'
    ];
    return isset($images[$categorie]) ? $images[$categorie] : 'images/default.jpg';
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Mon Profil</title>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="css/mon_profil_1.css">
<style>
/* Styles pour les étoiles */
.star-rating {
  display: inline-block;
  font-size: 0;
}

.star-rating .star {
  font-size: 20px;
  color: #ffcc00;
  margin: 0 1px;
}

.star-rating .star.empty {
  color: #ccc;
}

/* Styles pour le formulaire d'avis */
.form-review {
  margin-top: 20px;
}

.form-review label {
  display: block;
  font-weight: bold;
  margin-bottom: 5px;
}

.form-review select,
.form-review textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  font-family: 'Roboto', sans-serif;
  margin-bottom: 15px;
  box-sizing: border-box;
}

.form-review textarea {
  resize: vertical;
}

.form-review button {
  background-color: #FF8C00;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 1em;
}

.form-review button:hover {
  background-color: #FF7F00;
}

/* Styles pour centrer le message et l'image */
.no-reservations {
  text-align: center;
  margin-top: 50px;
}

.no-reservations img {
  max-width: 100%;
  height: auto;
  margin-top: 20px;
}

/* Styles pour un footer plus petit */
footer {
  padding: 50 px ;
  background-color: #f1f1f1;
  text-align: center;
  font-size: 0.9em;
  color: #333;
}

footer a {
  color: #333;
  text-decoration: none;
  margin: 5px;
}

footer a:hover {
  text-decoration: underline;
}
</style>
</head>
<body>
<?php include 'Header_profile.php'; ?>
<div class="main-content">
  <h1 class="user-name"><?php echo isset($user_info) ? htmlspecialchars($user_info['useru']) : 'Nom Prénom'; ?></h1>
  <div class="profile-container">
    <div class="info-box">
      <div class="info-title">Adresse mail :</div>
      <div class="info-content"><?php echo isset($user_info) ? htmlspecialchars($user_info['emailu']) : 'email@example.com'; ?></div>
      <div class="info-title">Numéro de téléphone :</div>
      <div class="info-content"><?php echo isset($user_info) ? '+33000000000' : '+33000000000'; ?></div>
      <div class="info-title">Date d'inscription :</div>
      <div class="info-content"><?php echo isset($user_info) ? htmlspecialchars($user_info['dateinscriptionu']) : '2023-01-01'; ?></div>
      <div class="info-title">Rôle :</div>
      <div class="info-content"><?php echo isset($user_info) ? htmlspecialchars($user_info['roleu']) : 'user'; ?></div>
      <div class="info-title">Note moyenne :</div>
      <div class="info-content">
        <?php
        if (isset($user_average_rating) && $user_average_rating !== 'Aucune note') {
            echo '<div class="star-rating">';
            $full_stars = floor($user_average_rating);
            $half_star = $user_average_rating - $full_stars >= 0.5 ? 1 : 0;
            $empty_stars = 5 - $full_stars - $half_star;

            for ($i = 0; $i < $full_stars; $i++) {
                echo '<span class="star">&#9733;</span>';
            }
            if ($half_star) {
                echo '<span class="star">&#9733;</span>';
            }
            for ($i = 0; $empty_stars > $i; $i++) {
                echo '<span class="star empty">&#9733;</span>';
            }
            echo '</div>';
        } else {
            echo 'Aucune note';
        }
        ?>
      </div>
    </div>
    <button class="button">Modifier mon profil</button>
  </div>
  <div class="reservations-title">Mes réservations</div>
  <div class="reservations-container">
    <?php if ($new_reservation): ?>
      <h2>Nouvelle réservation</h2>
      <div class="reservation-card">
        <img src="<?php echo getCategoryImage($new_reservation['categorie']); ?>" alt="Service Image" class="reservation-image">
        <div class="reservation-details">
          <h3><?php echo htmlspecialchars($new_reservation['nomservice']); ?></h3>
          <p><strong><?php echo date('l, d M Y', strtotime($new_reservation['dateservice'])); ?></strong></p>
          <p><?php echo htmlspecialchars($new_reservation['dureeservice']); ?> heures</p>
          <p><?php echo htmlspecialchars($new_reservation['description']); ?></p>
        </div>
        <div class="reservation-status">
          <p class="status-upcoming">Arrive bientôt</p>
        </div>
      </div>
    <?php endif; ?>

    <?php if (count($upcoming_reservations) > 0 || count($past_reservations) > 0): ?>
      <?php if (count($upcoming_reservations) > 0): ?>
        <h2>Services à venir</h2>
        <?php foreach ($upcoming_reservations as $reservation): ?>
          <div class="reservation-card">
            <img src="<?php echo getCategoryImage($reservation['categorie']); ?>" alt="Service Image" class="reservation-image">
            <div class="reservation-details">
              <h3><?php echo htmlspecialchars($reservation['nomservice']); ?></h3>
              <p><strong><?php echo date('l, d M Y', strtotime($reservation['date_service'])); ?></strong></p>
              <p><?php echo date('H:i', strtotime($reservation['date_service'])); ?></p>
              <?php if ($reservation['note']): ?>
                <p>Note: <?php echo str_repeat('★', $reservation['note']) . str_repeat('☆', 5 - $reservation['note']); ?></p>
                <p>Commentaire: <?php echo htmlspecialchars($reservation['commentaire']); ?></p>
              <?php endif; ?>
            </div>
            <div class="reservation-status">
              <p class="status-upcoming">Arrive bientôt</p>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>

      <?php if (count($past_reservations) > 0): ?>
        <h2>Services terminés</h2>
        <?php foreach ($past_reservations as $reservation): ?>
          <div class="reservation-card">
            <img src="<?php echo getCategoryImage($reservation['categorie']); ?>" alt="Service Image" class="reservation-image">
            <div class="reservation-details">
              <h3><?php echo htmlspecialchars($reservation['nomservice']); ?></h3>
              <p><strong><?php echo date('l, d M Y', strtotime($reservation['date_service'])); ?></strong></p>
              <p><?php echo date('H:i', strtotime($reservation['date_service'])); ?></p>
              <?php if ($reservation['note']): ?>
                <p>Note: <?php echo str_repeat('★', $reservation['note']) . str_repeat('☆', 5 - $reservation['note']); ?></p>
                <p>Commentaire: <?php echo htmlspecialchars($reservation['commentaire']); ?></p>
              <?php endif; ?>
            </div>
            <div class="reservation-status">
              <p class="status-completed">Terminé</p>
              <?php if (!$reservation['note']): ?>
                <form class="form-review" action="donner_avis.php" method="POST">
                  <input type="hidden" name="idservice" value="<?php echo htmlspecialchars($reservation['idservice']); ?>">
                  <input type="hidden" name="idutilisateur" value="<?php echo htmlspecialchars($user_id); ?>">
                  <label for="note">Note:</label>
                  <select name="note" id="note">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                  </select>
                  <br>
                  <label for="commentaire">Commentaire:</label>
                  <textarea name="commentaire" id="commentaire" rows="3"></textarea>
                  <br>
                  <button type="submit">Donner un avis</button>
                </form>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php else: ?>
      <div class="no-reservations">
        <p>Vous n'avez aucune réservation pour le moment...</p>
        <img src="images/no_reservation.jpg" alt="No Reservations">
      </div>
    <?php endif; ?>
  </div>
</div>
<?php include 'Footer_mode_connecte.html'; ?>
</body>
</html>
