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

<form action="../../index.php?action=login" method="post">
        <fieldset>
            <legend> Veuillez vous connecter </legend>    
                <p>
                    <label for="email"> Votre email </label>
                    <input type="email" name="email" >
                </p>

                <p>
                    <label for="password">Mot de passe </label>
                    <input type="password" name="password" >
                </p>
                <p>
                    <input type="submit" name="send" value="Se connecter" >
                </p>

                <p><?=$messageConnexion?></p>

                <p>Votre n'avez pas de compte ? <a href="../../index.php?page=Creez"> Creez-vous un compte ! </a></p>

            

        </fieldset>
</form>



<div id="footer">
<?php include_once("footer.php")?>
</div>


</body></html>