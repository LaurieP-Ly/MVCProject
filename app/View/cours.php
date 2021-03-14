<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nos cours</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/main.js"></script>
</head>



<body class="bodyCours">
<?php include_once("header.php")?>

<h1 id="h1ChoixCours">Nos cours</h1>

<div class="list">


<section id="menuNiv">

<p>Choississez le niveau : </p>
<a href="index.php?page=cours&niv=1">Facile</a>
<a href="index.php?page=cours&niv=2">Moyen</a>
<a href="index.php?page=cours&niv=3">Difficile</a>
<a href="index.php?page=cours">Voir tout</a>

</section>

<ul id="list">
    <?php foreach($result as $cours):?>
        <li><a href="index.php?page=planning&id=<?=$cours["idCours"]?>">
            <article id="recette">
            <h2><?=$cours["nom"]?></h2>
            <img src="<?=$cours["imgCours"]?>" alt="Cours">
            <p>Niveau : <?=$cours["niveau"]?> </p>
            <p>Prix : <?=$cours["prix"]?> crédit(s)</p>

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



