<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--metadonnees pour améliorer le referencement   -->
    <meta charset="UTF-8">
    <title>Vapeur douce</title>
    <meta name="description" content="Stephane Gabrielly présente avec son nouveau livre la méthode de cuisson à la vapeur">
    <!--twitter card et open graph   -->
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@Laurent94145212">
    <meta name="twitter:title" content="Vapeur Douce">
    <meta name="twitter:description" content="Stephane Gabrielly présente son nouveau livre au sujet de la Vapeur Douce">
    <meta name="twitter:image" content="https://glaciological-miner.000webhostapp.com/vapeur/livre.jpeg">
    
    <link rel="stylesheet" href="style.css">
    <!-- pour enlever l'erreur GET http://localhost/favicon.ico 404 (Not Found) dans la console-->
    <link rel="shortcut icon" href="#"> 
</head>

<body>
    <?php include('apitest.php') ?>

    <div class="photo">
        <img src='livre.jpeg' alt='couverture du livre plats gourmands recettes faciles'>
        <p class="auteur">Stephane Gabrielly</p>
    </div>
    <div class="titre">
        <p>Plats Gourmands,</p>
        <h1>VAPEUR DOUCE</h1>
    </div>
    <form class="form" method="POST" action="index.php">
        <input name="aliment" type="text" value=''>
        <input class="valider" type="submit" value="Voir les infos de cet aliment">
    </form>
    <div class="resultat">
        <div class="listing">
            <?php include('listing.php') ?>
        </div>
        <div class="nom">
            <?php echo $nom_aliment ?>
        </div>
        <div class="infos">
            <p> <?php echo $duree_cuisson ?> </p>
        </div>
    </div>
</body>
</html>