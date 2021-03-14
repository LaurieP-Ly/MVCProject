
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
<section>

    <header><h2>Créer un compte</h2></header>
    
    <fieldset>
   
   
        <form method="post" action="../../index.php?action=save" id="creer-compte">
            <p>
                <label for="email"> E-mail *</label>
                <input type="email" name="email" size="15" value="<?=$email?>" required>
            </p>
            <p>
                <label for="mdp"> Mot de passe *</label>
                <input type="password" name="mdp" size="15" minlength="8" required>
            </p>
            <p>
                <label for="Nom"> Nom *</label>
                <input type="text" name="Nom" size="10" value="<?=$nom?>" required>
            </p>
            <p>
                <label for="Prenom"> Prenom *</label>
                <input type="text" name="Prenom" size="10" value="<?=$prenom?>" required>
            </p>
            <p>
                <label for="Codepostal"> Code postal *</label>
                <input type="text" name="Codepostal" size ="5" maxlength="5" value="<?=$codePostal?>" required>
            </p>

            <p>
                <label for="pseudo"> Pseudo *</label>
                <input type="text" name="pseudo" size ="15" maxlength="15" value="<?=$pseudo?>" required>
            </p>
            
            <input type="submit" value="Envoyer" name="send">
        </form>

             
            <strong>
                <?=$messageChamps?>
                <?=$messageEmailDansBase?>
            </strong>

            <p>Merci de renseigner tout les champs</p>
            
        </fieldset>
        

    

</section>


<div id="footer">
<?php include_once("footer.php")?>
</div>


</body></html>
