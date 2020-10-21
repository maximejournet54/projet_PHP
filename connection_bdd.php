<?php
function connection(){
  try {
    return $objPdo = new PDO('mysql:host=devbdd.iutmetz.univ-lorraine.fr;port=3306;dbname=ProjetPhp','journet9u_appli ','23JAN2001'); //a compléter avec dans l'ordre: nom de la base de données, identifiant utilisateur de la bdd, mot de passe (numéro étudiant)
  }
  catch(Exception $exception){
    session_start();
    $_SESSION['BDD_ERROR']=$exception->getMessage();

    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'erreur_bdd.php';

    header("Location: http://$host$uri/$extra");
    exit();
  }
}
?>