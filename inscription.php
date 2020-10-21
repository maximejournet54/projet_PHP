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
        <h1>Inscription</h1>
        <form method="POST" action=""> <br> <!-- ajouter le lien vers la page gérant la connexion du rédacteur -->
            <div>

                Nom :
                <input type="text" size="60" placeholder="nom" name="nom" <?php
                                                                            if (isset($_SESSION['nom'])) echo 'value=" ' . $_SESSION['nom'] . '"';
                                                                            unset($_SESSION['nom']);
                                                                            ?> required autocomplete="off" /> <br> <br>

                Prenom :
                <input type="text" size="50" placeholder="prenom" name="prenom" required <?php
                                                                                            if (isset($_SESSION['prenom'])) echo 'value="' . $_SESSION['prenom'] . '"'
                                                                                            ?> autocomplete="off" /> <br> <br>

                Email:
                <input type="text" size="50" placeholder="mèl" name="email" <?php
                                                                            if (isset($_SESSION['mail'])) echo 'value="' . $_SESSION['mail'] . '"';
                                                                            unset($_SESSION['mail']);
                                                                            ?> required autocomplete="off" /> </br> </br>
                <?php if (isset($_SESSION['pb']) && ($_SESSION['pb'] == 1 || $_SESSION['pb'] == 3)) echo "ce mail existe déjà</br>"; ?>

                Mot de passe :
                <input type="password" size="30" placeholder="password" name="motdepasse" <?php
                                                                                            if (isset($_SESSION['mdp'])) echo 'value="' . $_SESSION['mdp'] . '"';
                                                                                            unset($_SESSION['mdp']);
                                                                                            ?> required /> </br> </br>

                Vérification du mot de passe :
                <input id="mdp2" type="password" oninput="check_mdp()" size="30" placeholder="ressaisissez le mot de passe" name="mdp" <?php
                                                                                                                                        if (isset($_SESSION['mdp'])) echo 'value="' . $_SESSION['mdp'] . '"';
                                                                                                                                        unset($_SESSION['mdp']);
                                                                                                                                        ?> required /> </br> </br>
                <p id="label_mdp">

                </p>


                Pseudo :
                <input type="text" size="20" placeholder="pseudonyme" name="pseudo" required autocomplete="off" <?php
                                                                                                                if (isset($_SESSION['pseudo²'])) echo 'value="' . $_SESSION['pseudo²'] . '"';
                                                                                                                unset($_SESSION['pseudo²']);
                                                                                                                ?> required autocomplete="off" /> </br> </br>

                <?php if (isset($_SESSION['pb']) && ($_SESSION['pb'] == 1 || $_SESSION['pb'] == 2)) echo "ce pseudo existe déjà</br>"; ?>

                <?php unset($_SESSION['pb']); ?>
                </br>
            </div>
            <input type="submit" onclick="javascript: return check_mdp_valider();" name="s'inscrire" value="inscription" />
        </form>
    </article>
</body>

</html>