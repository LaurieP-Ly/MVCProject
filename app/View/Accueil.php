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

    <!-- Verification d'une eventuelle connexion-->
	<?php if(isset($_SESSION["id"]) && !empty($_SESSION["id"])):?>
		<li>Bonjour <?=$_SESSION["pseudo"]?> !</li>
		<li><a href="index.php?action=deconnecter">Se deconnecter </a></li>
	<?php endif?>
    

    <section id="section">

        <div class="contenant">
            <section>
                <div class="texte_centrer1">Votre premier cours</div>
                <div class="texte_centrer2">GRATUIT</div>
                <button><a href="index.php?page=information">En savoir plus</a></button>
            </section>

        </div>

    </section>

    <section id="description">

        <p>Améliorez vos compétences en cuisine et amusez-vous, salés, sucrés, c'est comme vous voulez !</p>
        <p>Salty&amp;Sweet : 52 rue du soleil, 00000 Villexemple</p>
        <img id="whisk" src="../../img/whisk-295329_640.png" alt="whisk" >


    </section>

    <section id="section2">

        <p>Quelques recettes ...</p>

        <div id="images">
            <?php foreach($resRequete as $recettes):?>
            
            <a href="index.php?page=vuerecette&id=<?=$recettes["idRecette"]?>">
            <img src="../../<?=$recettes["imgRecette"]?>" id=<?=$recettes["idRecette"]?> class="imgIndex" alt="dough" onmouseover="agrandir(<?=$recettes['idRecette']?>)" onmouseout="reduire(<?=$recettes['idRecette']?>)">
            </a>
            <?php endforeach?>
        </div>

    </section>



    <div id="footer">
<?php include_once("footer.php")?>
</div>


</body></html>