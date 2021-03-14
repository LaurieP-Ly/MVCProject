<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Planning</title>
    <link rel="stylesheet" href="../../css/style.css">
    <script type="text/javascript" src="../../js/main.js"></script>
</head>

<body class="PlanningCours">
<?php include_once("header.php")?>

<p id="arrow"><a href="index.php?page=cours">Retour</a></p>

<h2>Le cours : <?=$coursInfo["nom"]?></h2>
<div id="divPlanning">
<article id="infoCours">
<p>Niveau  : <?=$coursInfo["niveau"]?></p>
<p>Durée  : <?=$coursInfo["temps"]?></p>
<p>Catégorie  : <?=$nomCategorie["categorie"]?> </p>
</article>

<p id="descriptionCours"> <?=$coursInfo["description"]?></p>

</div>
<img src="<?=$coursInfo["imgCours"]?>" alt="Cours">
<div id="listeHoraires">
<h2>Les differents horaires disponibles : </h2>

<ul id="horaires">
    <?php foreach($result as $horaire):?>
        <li>
            <article id="horaire">
            <h2><?=$horaire["jour"]?></h2>
            <p><?=$horaire["heure"]?></p>
            <?php if(isset($_SESSION["id"]) && !empty($_SESSION["id"])):?>
            <form method="post" action="index.php?page=panier&action=reserver&idHoraire=<?=$horaire["idHoraire"]?>">
            <!---Envoyer en plus du POST du formulaire, l'id de l'article ajouté dans le panier en GET--->
            <input type="submit" value="Reserver" name="ajouter">
            <?php else:?>
            <p><a href="index.php?page=Login">Connectez-vous</a> pour reserver </p>
            <?php endif?>
            
            </form>

            </article>
        </li>

    <?php endforeach?>
</ul>
</div>
<div id="footer">
<?php include_once("footer.php")?>
</div>
</body>

</html>
