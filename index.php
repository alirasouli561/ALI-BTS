<?php
session_start(); 
include 'base.php';
?>
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Flexiburo</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./style.css">
  <style>
    .welcome-banner {
  text-align: center;
  color: white;
  padding: 3rem 1rem;
  background: rgba(0, 0, 0, 0.6);
  margin-top: 100px; 
}

.introduction {
    background: #100b0bb8;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 80px;
    margin: 152px auto;
    width: 1400px;
    color: #333333;
}

.introduction h2 {
  color: white; 
  font-size: 2.5rem; 
  margin-bottom: 20px; 
  text-transform: uppercase; 
  font-weight: 700; 
}

.introduction p {
  font-size: 1rem; 
  line-height: 1.6; 
  margin-bottom: 20px; 
  color: white; 
  text-align: justify; 
}


@media (min-width: 1500px) {
.introduction {
    padding: 60px;
    margin: 199px auto;
}
  .introduction h2 {
    font-size: 3rem; 
  }

  .introduction p {
    font-size: 1.125rem; 
  }
}


@media (min-width: 640px) {
  .welcome-banner h1 {
    font-size: 5rem; 
  }

  .welcome-banner p,
  .introduction h2,
  .introduction p {
    font-size: 2.4rem; 
  }
}
.welcome-image {
  height: 22px; 
  width: auto;
}

</style>
</head>
<body>
<nav class="mask">
  <a href="index.php" class="brand"><h2>FlexiBuro</h2></a>
  
  <ul class="list">
    <li><a href="index.php">Accueil</a></li>
    <li><a href="bureaux.php">Bureaux</a></li>
    <li><a href="salle.php">Salles</a></li>
    <li><a href="Entrepot.php">Entrepôt</a></li>
  </ul>

  <div class="navbar-right">
    <?php if (isset($_SESSION['login'])): ?>
      <br><img src="login.png" class="welcome-image">&nbsp;<?php echo htmlspecialchars($_SESSION['login']); ?></span>
        <a href="list.php">Réservation</a>
        <a href="logout.php">Déconnexion</a>
    <?php else: ?>
        <a href="connecter.php">Se connecter</a>
    <?php endif; ?>
  </div>
</nav>
<br><br>
<h1> Bienvenue chez FlexiBuro</h1>

<section class="introduction">
  <h2>Découvrez nos offres</h2>
  <p>Que vous recherchiez un bureau commercial pour démarrer votre activité, une salle de réunion pour vos conférences, ou un entrepôt spacieux pour votre stock, FlexiBuro vous offre des solutions sur mesure adaptées à vos besoins.
  Parcourez notre site pour en savoir plus sur nos espaces disponibles et trouvez l'environnement de travail idéal pour faire prospérer votre entreprise.
  </p>
</section>
</body>
</html>