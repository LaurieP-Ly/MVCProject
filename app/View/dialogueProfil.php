<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="../../css/styleAdmin.css" rel="stylesheet" type="text/css" />
	<title>Dialogue</title>

</head>
<body id="loginAdmin">

<dialog open>

    <p><?=$message?></p>
    <a href="index.php?page=profil"> Non, annuler </a>
	<a href="index.php?action=suppReservation&idreserv=<?=$id?>"> Oui, je suis sûr(e) </a>


</dialog>

</body>
</html>