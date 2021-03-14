

<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="../../css/style.css" rel="stylesheet" type="text/css" />
	  <script type="text/javascript" src="../../js/main.js"></script>
	<title>Votre panier</title>

</head>
<body class="vignet">

<?php include_once("header.php")?>

<section>

	<h2>Votre panier</h2>
	<?php if(isset($_SESSION["idClient"])):?>
	<a href="index.php?page=profil">Votre profil</a>
	<?php endif?>
	<?php if(!empty($_SESSION["panier"])):?> <!--Affichage different en fonction de si le panier est vide ou non-->
		<section>
		<p>Votre nombre de crédits : <?=$nbCredits?></p>
		<?php if($nbCredits>=$somme):?>
			<strong>
				<a href="index.php?page=panier&validation=true&somme=<?=$somme?>">Valider vos reservations <img id="check" src="../../img/accept-47587_640.png" alt="valid"> </a></strong>
			</strong>
			<strong>
				<a href="index.php?page=panier&action=viderPanier">Vider le panier <img id="delete" src="../../img/delete-1727486_640.png" alt="bin"></a>
			</strong>

		<?php else:?>

		<strong>
				<a href="index.php?page=recharge">Vous n'avez pas assez de crédits, cliquez ici pour en récupérer <img id="check" src="../../img/attention-303861_640.png" alt="valid"> </a></strong>
		</strong>

		<strong>
				<a href="index.php?page=panier&action=viderPanier">Vider le panier <img id="delete" src="../../img/delete-1727486_640.png" alt="bin"></a>
		</strong>
		<?php endif ?>
		</section>
			
		
	
		<table id="cart-table">

        <?=$messageAjoutPanier?>
        
			<?php for ($i=0; $i<sizeof($tousLesCours); $i++):?>
		<tr>
			<th>
				<?=$tousLesCours[$i]->getNom()?>
				<a href="index.php?page=panier&action=suppressionReserv&idHoraire=<?=$_SESSION["panier"][$i]->getIdHoraire()?>"><img id="delete" src="img/delete-1727486_640.png" alt="bin"></a>
				<a href="index.php?page=planning&id=<?=$tousLesCours[$i]->getIdCours()?>"> Voir les détails<img id="detail" src="img/magnifying-glass-189254_640.png" alt="detail"></a>
			</th>
			<td>Jour/Heure : <?=$_SESSION["panier"][$i]->getJour()?>/<?=$_SESSION["panier"][$i]->getHeure()?></td>
			<td><img src="../../<?=$tousLesCours[$i]->getImgCours()?>" alt=""></td>
			<td> <strong><?=$tousLesCours[$i]->getPrix()?> crédit</strong></td>
		</tr>
			
			<?php endfor?>
		<tr> <p id="total-achat" > Prix total : <?=$somme?> crédits</p> </tr>

	
		</table>
		

	

		
		
	<?php else :?>
		<div id="empty-cart">
		<?=$messageAjoutPanier?>
			<p>Votre panier est vide</p>

		</div>
	<?php endif ?>


	</section>


<div id="footer">
<?php include_once("footer.php")?>
</div>

</body>
</html>