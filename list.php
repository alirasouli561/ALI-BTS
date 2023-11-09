<?php
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: connecter.php");
    exit();
}

// Include database connection file
include 'base.php';

// Get the user_id from the session
$user_id = $_SESSION['user_id'];

// Prepare a query to select reservations made by the logged-in user
$sql = "SELECT reservation.*, espace.description, espace.tarif_par_jour 
        FROM reservation 
        INNER JOIN espace ON reservation.espace_id = espace.espace_id 
        WHERE reservation.user_id = ? 
        ORDER BY reservation.date_debut DESC";

if ($stmt = $conn->prepare($sql)) {
    // Bind the user_id to the statement
    $stmt->bind_param("i", $user_id);
    
    // Execute the query
    $stmt->execute();
    
    // Get the result
    $result = $stmt->get_result();
    
    // Fetch all reservations
    $reservations = $result->fetch_all(MYSQLI_ASSOC);
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();

// Function to calculate the total price
function calculateTotalPrice($date_debut, $date_fin, $tarif_par_jour) {
    $datetime1 = new DateTime($date_debut);
    $datetime2 = new DateTime($date_fin);
    $interval = $datetime1->diff($datetime2);
    return $interval->days * $tarif_par_jour;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Réservations Confirmées</title>
  <link rel="stylesheet" href="./style.css">
  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Réservations Confirmées</title>
  <link rel="stylesheet" href="./style.css">
  <style>
    /* Inline styles for PHP generated content */
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding-top: 60px; /* Adjust top padding to account for fixed navbar */
    }

    nav {
      /* Styles for the navbar */
    }

    .reservation-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
      gap: 1rem;
      padding: 1rem;
    }

    .reservation-item {
      background-color: #ffffff;
      color: #333;
      border-radius: 5px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
      padding: 1rem;
      transition: transform 0.3s ease-in-out;
    }

    .reservation-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
    }

    h2 {
      color: #000;
    }

    p {
      color: #555;
    }

    .cancel-btn {
      background-color: #ff6347;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .cancel-btn:hover {
      background-color: #e53e30;
    }

    @media (max-width: 600px) {
      .reservation-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
<nav class="mask">
  <a href="index.php"><h2>FlexiBuro</h2></a>
  <ul class="list">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="bureaux.php">Bureaux</a></li>
    <li><a href="salle.php">Salles</a></li>
    <li><a href="Entrepot.php">Entrepôt</a></li>
    <?php if (isset($_SESSION['login'])): ?>
        <li><a href="list.php">Réservation</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    <?php else: ?>
        <li><a href="connecter.php">Se connecter</a></li>
    <?php endif; ?>
  </ul>
</nav>

<main>
  <h1>Vos réservations confirmées</h1>
  <section class="reservation-grid">
    <?php if (!empty($reservations)): ?>
      <?php foreach ($reservations as $reservation): ?>
        <article class="reservation-item">
          <h2>Description: <?php echo htmlspecialchars($reservation['description']); ?></h2>
          <p>Date de début: <?php echo htmlspecialchars($reservation['date_debut']); ?></p>
          <p>Date de fin: <?php echo htmlspecialchars($reservation['date_fin']); ?></p>
          <?php 
            $totalPrice = calculateTotalPrice($reservation['date_debut'], $reservation['date_fin'], $reservation['tarif_par_jour']);
          ?>
          <p>Prix total: <?php echo htmlspecialchars($totalPrice); ?> €</p>
          
          <form action="annuler_reservation.php" method="post">
            <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
            <button type="submit" class="cancel-btn">Annuler la réservation</button>
          </form>
        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <p>Aucune réservation trouvée.</p>
    <?php endif; ?>
  </section>
</main>

</body>
</html>

<style>

    .reservation-list {
      list-style-type: none;
      padding: 0;
    }

    .reservation-item {
    background-color: #242020;
    color: white;
    margin-bottom: 1rem;
    padding: 15px;
    border-radius: 5px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

    h1 {
        color:white;
    }
    h2 {
      font-size: 1.7rem;
      margin-bottom: 0.5rem;
      color:white;
    }

     p {
      font-size: 1.8rem;
      line-height: 2;
      color:white;
    }

    .cancel-btn {
      background-color: #ff6347;
      color: white;
      border: none;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .cancel-btn:hover {
      background-color: #e53e30;
    }
  </style>
