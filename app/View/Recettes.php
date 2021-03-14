<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nos recettes</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/main.js"></script>
</head>



<body class="bodyCours">
<?php include_once("header.php")?>

<h1 id="h1Choix">Nos recettes</h1>
<p id="PChoix">Vous en voulez plus? Passez faire un tour dans "nos cours" !</p>

<div class="list">


<section id="menuNiv">

<p>Choississez le niveau : </p>
<a href="index.php?page=recettes&niv=1">Facile</a>
<a href="index.php?page=recettes&niv=2">Moyen</a>
<a href="index.php?page=recettes&niv=3">Difficile</a>
<a href="index.php?page=recettes">Voir tout</a>

</section>

<ul id="list">
    <?php foreach($recettes as $recette):?>
        <li><a href="index.php?page=vuerecette&id=<?=$recette["idRecette"]?>">
            <article id="recette">
            <h2><?=$recette["nom"]?></h2>
            <img src="<?=$recette["imgRecette"]?>" alt="Recette">
            <p>Niveau : <?=$recette["niveau"]?> </p>

        </article>
        </a>
        </li>

    <?php endforeach?>
</ul>




</div>
<div id="footer">
<?php include_once("footer.php")?>
</div>

</body>

</html>



