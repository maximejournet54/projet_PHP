<?php
session_start();
if (!isset($_SESSION['BDD_ERROR'])) { // regarde si la personne qui accède à la page est déjà connecté, si elle l'est, elle se fait rediriger à la page d'accueil
  $host  = $_SERVER['HTTP_HOST'];
  $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  $extra = 'accueil.php'; //nom de la page d'accueil à ajouter pour la redirection
  header("Location: http://$host$uri/$extra");
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Erreur dans la base de données</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
  <header>
    <nav>
      <ul>
        <li><a href="./accueil.php">
            <div>retour à l'acceuil</div>
          </a></li>
      </ul>
    </nav>
  </header>
  <article>
    <h1> Erreur au niveau de la base de données</h1>
    <p>
      <?php
      echo $_SESSION['BDD_ERROR'];
      unset($_SESSION['BDD_ERROR']);
      ?>
      </br>
      </br>
      Veillez contacter un administrateur
    </p>
  </article>

</body>

</html>