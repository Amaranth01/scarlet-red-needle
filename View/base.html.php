<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Scarlet tattoo</title>
    <link rel="stylesheet" href="/asset/css/style.css">
</head>
<body>
<?php
echo "<pre>";
var_dump($_SESSION['user']);
echo "</pre>";
    // Handling error messages.
    if(isset($_SESSION['errors']) && count($_SESSION['errors']) > 0) {
        $errors = $_SESSION['errors'];
        unset($_SESSION['errors']);

        foreach($errors as $error) { ?>
            <div class="alert alert-error"><?= $error ?></div> <?php
        }
    }

    // Handling sucecss messages.
    if(isset($_SESSION['success'])) {
        $message = $_SESSION['success'];
        unset($_SESSION['success']);
        ?>
        <div class="alert alert-success"><?= $message ?></div> <?php
    }
    ?>
<header>
    <img src="/asset/img/243205021_10226925465103496_6921770754731695945_n.jpg" alt="Logo de Scarlet tattoo" id="logo">
    <h1>Scarlet tattoo</h1>
</header>

<div>
    <nav>
        <ul class="list">
            <li><a href="/index.php?c=home">Accueil</a></li>
            <li>Tatouages
                <ul class="little">
                    <li><a href="/index.php?c=page&a=achievements">Réalisés</a></li>
                    <li><a href="/index.php?c=page&a=adopt">À adopter</a></li>
                </ul>
            </li>
            <li><a href="/index.php?c=page&a=piercing">Piercing</a></li>
            <li><a href="/index.php?c=page&a=amt">Art Mania Tattoo</a></li>
        </ul>
    </nav>
</div>

<main class="container">
    <?= $html ?>
</main>

<footer>
    <p id="contact">Contact : Cécile et Julien </p> <br>

    <p id="open">Ouverture le Mardi, Jeudi, Vendredi et Samedi : 10H - 18H <br>
    Possibilité d'ouverture le lundi uniquement sur RDV avec Julien</p> <br>

    <p id="tel">
        Adresse : 20 Rue du marché 35380 Plélan-Le-Grand <br>
        Téléphone : 09 83 81 29 66 <br>
        Julien : 07 60 18 36 84 <br>
        Mail Cécile/Scarlet : thomascecile.86@outlook.fr
    </p>
    <br>
    <p id="social">Réseaux sociaux :
        <a href="https://www.facebook.com/artmaniatattoo">Art Mania Tattoo</a> |
        <a href="https://www.facebook.com/profile.php?id=100073313887014">Scarlet Red Needle</a>
    </p> <br>

    <p id="copy">&COPY; 2022 Scarlet Red Needle et Art Mania Tattoo</p>

</footer>
<script src="/assets/js/app.js"></script>
</body>
</html>