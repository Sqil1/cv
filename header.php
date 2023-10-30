<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>mbadoian.fr</title>

    <link rel="stylesheet" href="style.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/jgthms/minireset.css@master/minireset.min.css">
</head>

<body>
<header id=main>
    <nav class=menu-top>
        <div class=adress-top>
            <p>mbadoian.fr</p>
        </div>
        <ul id="nav-main" class="right hide-on-med-and-down">

            <li><a href="index.php#home">Accueil</i></a></li>
            <li><a href="index.php#profil">Profil</a></li>
            <li><a href="index.php#experience">Expériences</a></li>
            <li><a href="index.php#cursus">Cursus</a></li>
            <li><a href="index.php#contact">Me Contacter</a></li>
            <?php
            session_start();
            // Vérifiez si l'utilisateur est connecté
            if (isset($_SESSION["user"])) {
                // L'utilisateur est connecté, affichez "Tableau de bord" et un lien de déconnexion
                echo '<li><a href="dashboard.php">Tableau de bord</a></li>';
                echo '<li><a href="deconnexion.php">Me deconnecter</a></li>';
            } else {
                // L'utilisateur n'est pas connecté, affichez "Me Connecter"
                echo '<li><a href="meConnecter.php">Me Connecter</a></li>';
            }
            ?>
        </ul>
    </nav>
</header>
<main>
    <section id="home">
        <div class="contain-home">
            <div class="name-home">
                <h1>Maxime BADOIAN</h1>
            </div>
            <div class="social-link">
                <a href="https://www.facebook.com/mbadoian"><img src="img/facebook.png" alt="Facebook"/></a>
                <a href="https://twitter.com/mbadoian"><img src="img/twitter.png" alt="Twitter"/></a>
                <a href="https://www.linkedin.com/in/mbadoian/"><img src="img/linkedin.png" alt="linkedin"/></a>
                <a href=""><img src="img/pdf.png" alt="pdf"/></a>
            </div>
            <div id="img-profil">
                <!-- <img class="img-260px" src="img/img-profil.jpg" alt="" > ancienne img-->
            </div>
        </div>
    </section>
