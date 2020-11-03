<?php
if (isset($_POST['deconnexion'])) {
    session_start();
    $_SESSION[] = array();
    session_destroy();
    header("location: accueil.php");
}
if (isset($_POST['retour']))
{
    header("location: accueil_redacteur.php");
}

?>
<p>Etes vous certain de vouloir vous déconnecter?</p>
<br>
<form method="POST" >
    <input type='submit' name='deconnexion' value='deconnexion'></input>
    <input type='submit' name='retour' value='retour'></input>
</form>