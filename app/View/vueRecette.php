
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Salty&amp;Sweet</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/main.js"></script>
</head>


<body class="vignet">
    

<?php include "header.php"?>

<p id="arrow"><a href="index.php">Retour</a></p>

<article id="vue_recette">
    <h1><?=$recette["nom"]?></h1>
    <p><?=$recette["description"]?></p>

    <section id="caract">
        <p>Catégorie : <?=$categorie[0]["categorie"]?></p>
        <p> Niveau : <?=$recette["niveau"]?></p>
        <p>Temps de preparation : <?=$recette["temps"]?></p>
        <p>Nombre de personne : <?=$recette["nombreDePersonne"]?></p>
    </section>


    <section id="ingredients">
        <p>Ingredients : <?=$recette["ingredients"]?></p>
    </section>
    
    <img src="<?=$recette["imgRecette"]?>" alt="Recette" id="rec">
    <img src="../../<?=$recette["ImgDerouleRecette"]?>" alt="DerouleRecette" id="derouleRecette">


</article>


<div id="footer">
<?php include_once("footer.php")?>
</div>


</body></html>
