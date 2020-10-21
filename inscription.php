<!DOCTYPE html>
<script type="text/javascript" src="verif_mdp.js"></script>
<?php
session_start();
if (isset($_SESSION['pseudo'])) {
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = "page_acceuil";
    header("Location: http://$host$uri/$extra");
}
?>
<html>

<head>
    <title>Inscription sur le site</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="./connection_redacteur.php">
                        <div>Connexion</div>
                    </a></li>
                <li><a href="./page_accueil.php">
                        <div>Retour à l'accueil</div>
                    </a></li>
            </ul>
        </nav>
    </header>
    <article>
        <h1>Connexion</h1>
        <form method="POST" action=""> <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
            <div>

                Nom:
                <input type="text" size="60" placeholder="nom" name="nom" required autocomplete="off" />



                Email:
                <input type="text" size="320" placeholder="mèl" name="email" required /> <br> <br>

                Mot de passe :
                <input type="password" size="20" placeholder="password" name="motdepasse" required />


                Pseudo :
                <input type="text" size="20" placeholder="pseudonyme" name="pseudo" required autocomplete="off" <?php
                                                                                                                if (isset($_SESSION['pseudo²'])) echo 'value="' . $_SESSION['pseudo²'] . '"';
                                                                                                                unset($_SESSION['pseudo²']);
                                                                                                                ?> required autocomplete="off" /> </br> </br>

                <?php
                if (isset($_SESSION['pb'])) echo "cet identifiant n'existe pas ou le mot de passe est erroné";
                unset($_SESSION["pb"]);
                ?>
            </div>
            <input type="submit" name="connexion" value="connction" />
        </form>
    </article>
</body>

</html>