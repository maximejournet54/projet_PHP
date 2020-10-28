<?php
include ('connection.php');
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
try{

  $securemdp = md5("Levis".$_POST['motdepasse']."Hallowen");//criptage du mot de passe md5 = fonction de cryptage
  $requete = connection()->prepare('select nom, count(*) AS pb from redacteur where (nom=:identifiant OR adressemail=:identifiant) AND motdepasse="' . $securemdp. '"'); //select nom -> pseudo
  $requete->bindParam(':identifiant',$_POST['identifiant'],PDO::PARAM_STR);
  $test = $requete->bindParam(':motdepasse',$securemdp,PDO::PARAM_STR);
  $requete->execute();
  $result = $requete->fetch();

  session_start();
  if ($result['pb']!=1){
    $extra = 'connection_redacteur.php';
    $_SESSION['pb']=$result['pb'];
  }
  else{
    if(isset($_SESSION['extra'])) $extra = $_SESSION['extra'];
    else $extra ='page_acceuil.php';
    $_SESSION['nom']=$result['nom'];
    unset($_SESSION['extra']);
  }
}

catch(Exception $e){
  $extra = 'error_dbb.php';
}

header("Location: http://$host$uri/$extra");
exit();

 ?>
