<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="../../../css/styleAdmin.css" rel="stylesheet" type="text/css" />
	<title>Administration</title>

</head>
<body id="loginAdmin">

<h2>Connexion administrateur</h2>
  
    <form action="indexAdmin.php?action=connecte" method="post">
        <fieldset>
            <legend> Veuillez vous connecter </legend>    
                <p>
                    <label for="username"> Nom utilisateur </label>
                    <input type="text" name="username" >
                </p>

                <p>
                    <label for="password">Mot de passe </label>
                    <input type="password" name="password" >
                </p>
                <p>
                    <label for="send">Se connecter </label>
                    <input type="submit" name="connexionAdmin" value="Se connecter" >
                </p>

                <p><?=$messageConnexion?></p>


                <a href="index.php">Revenir à l'accueil</a>

            

        </fieldset>
    </form>

</body>
</html>