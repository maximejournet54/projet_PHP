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
    <link rel="stylesheet" type="text/css" href="accueil.css">
  </head>

  <header>
    <nav id="navigation">
      <ul>
        <li><a href="./accueil.php">retour à l'acceuil</a></li>
      </ul>
    </nav>
  </header>

  <body id="hautdepage" class="texte">
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
  </body>

  <footer>
    <a href="#hautdepage" style="margin-left: 20px;"> retourner en haut de la page </a> 
    <a target="_blank" href="https://github.com/maximejournet54/projet_PHP">Lien du code du projet</a>
    <p>Ce site a été développé par Lucas LEVIS et Maxime Journet dans le cadre du projet PHP de 2e année de DUT informatique.</p>           
  </footer>
</html>