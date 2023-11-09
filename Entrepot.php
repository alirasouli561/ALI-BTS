<?php
session_start(); 
include 'base.php';
  $sql = "SELECT * FROM espace WHERE type_espace='entrepot'";
  $result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Flexiburo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style.css">
</head>
<body>
  <nav class="mask">
  <a href="index.php"><h2>FlexiBuro</h2></a>
    <ul class="list">
      <li><a href="index.php">Accueil</a></li>
      <li><a href="bureaux.php">Bureaux</a></li>
      <li><a href="salle.php">Salles</a></li>
      <li class="active"><a href="Entrepot.php">Entrepôt</a></li>
      <?php if (isset($_SESSION['login'])): ?>
        <li><a href="list.php">Réservation</a></li>
        <li><a href="logout.php">Déconnexion</a></li>
    <?php else: ?>
        <li><a href="connecter.php">Se connecter</a></li>
    <?php endif; ?>
  </ul>
</nav>


<main>
  <?php while ($row = $result->fetch_assoc()): ?>
    <div class="card">
    <div class="image">
        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['img']); ?>" alt="Image de l'entrepôt">
      </div>
      <div class="caption">
        <p class="description"><?php echo $row["description"]; ?></p>
        <p class="tarif"><?php echo $row["tarif_par_jour"]; ?><b>€ par jour</b></p>
        <p class="disponibilite">
          <?php echo $row["disponibilite"] ? '<span class="available">Disponible</span>' : '<span class="unavailable">Indisponible</span>'; ?>
        </p>
      </div>
      <?php if ($row["disponibilite"]): ?>
        <form action="reservation.php" method="post">
          <input type="hidden" name="espace_id" value="<?php echo $row["espace_id"]; ?>">
          <input type="date" name="date_debut" required>
          <input type="date" name="date_fin" required>
          <button type="submit" class="add">Réserver</button>
        </form>
      <?php else: ?>
        <button class="add unavailable" disabled>Indisponible</button>
      <?php endif; ?>
    </div>
  <?php endwhile; ?>
</main>

</body>
</html>
