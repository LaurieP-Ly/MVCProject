<!DOCTYPE html>
<html>
 <head>
	<meta charset="utf-8" />
  	<link href="../../../css/styleAdmin.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="../../../js/mainAdmin.js"></script>
	<title>Administration</title>

</head>
<body>
<p id="deco"><a href="indexAdmin.php?action=deconnecter"> Se deconnecter et revenir à l'accueil </a></p>
<p><a href="index.php?page=Api"> Accéder à l'API </a></p>
<h2>Administration du site Salty&amp;Sweet </h2>


    
    <h3>Ajouts</h3>
  <div id="adminAjout">
    
    <form method="post" action="indexAdmin.php?ajout=cours" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajout d'un cours</legend>
            <p><label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            </p>
            <p><label for="niveau">Niveau</label>
            <select name="niveau" id="niv">
                <option value="Facile">Facile</option>
                <option value="Moyen">Moyen</option>
                <option value="Difficile">Difficile</option>
            
            </select>
            </p>
            <p><label for="prix"> Prix </label>
            <input type="number" name="prix" id="prix"  placeholder="ex: 60" required>

            </p>
            <p><label for="temps">Durée</label>
                <input type="text" name="temps" id="temps" placeholder="ex: 2h15 ou 2h" required>
            </p>
            <p><label for="categorie">Categorie</label>
            <select name="categorie" id="categorie">
                <option value="1">Salé</option>
                <option value="2">Sucré</option>
            
            </select>

            <p><label for="description">Description</label>
                <input type="text" name="description" id="description" required>
            </p>

            <p><label for="img">Image</label>
                <input type="file" name="img" id="img" accept=".png, .jpg" required>
            </p>

            <p> <input type="submit" value="Envoyer" name="send"> </p>

            
        </fieldset>
    </form>

    <form method="post" action="indexAdmin.php?ajout=recette" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajout d'une recette</legend>
            <p><label for="nom">Nom</label>
            <input type="text" name="nom" id="nom" required>
            </p>
            <p><label for="niveau">Description</label>
            <select name="niveau" id="niv">
                <option value="Facile">Facile</option>
                <option value="Moyen">Moyen</option>
                <option value="Difficile">Difficile</option>
            
            </select>
            </p>
            
            <p><label for="temps">Durée</label>
                <input type="text" name="temps" id="temps" placeholder ="ex: 2h15 ou 2h" required>
            </p>

            <p><label for="nb"> Nombres de personnes </label>
            <input type="number" name="nbPer" id="nbPer" required>

            </p>


            <p><label for="ingredients"> Ingrédients </label>
            <input type="text" name="ingredients" id="ingredients" placeholder ="ex :200g de farine, 20g du beurre, ...", required>

            </p>

            <p><label for="description">Description</label>
                <input type="text" name="description" id="description" placeholder ="Décrire en quelques mots la recette" required>
            </p>

            <p><label for="categorie">Categorie</label>
            <select name="categorie" id="categorie">
                <option value="1">Salé</option>
                <option value="2">Sucré</option>
            
            </select>

            

            <p><label for="imgRecette">Image</label>
                <input type="file" name="imgRecette" id="imgRecette" accept=".png, .jpg" required>
            </p>

            <p><label for="ImgDerouleRecette">Déroulé de la recette</label>
                <input type="file" id="imgDerouleRecette" name="ImgDerouleRecette" accept=".png, .jpg" required>
            </p>


            

            <p> <input type="submit" value="Envoyer" name="sendRecette"> </p>

            

        </fieldset>
    </form>


    <form method="post" action="indexAdmin.php?ajout=horaire" enctype="multipart/form-data">
        <fieldset>
            <legend>Ajout d'un horaire</legend>
            <p><label for="idCours">Cours </label>
            
            <select name="idCours" id="idCours" required>
            
              <?php foreach($arrayCoursObjet as $c):?>
                <option value="<?=$c->getIdCours()?>"><?=$c->getNom()?></option>
              <?php endforeach ?>
            
            </select>
            </p>
            
            <p><label for="jour">Jour </label>
            <select name="jour" id="jour">
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
                <option value="Dimanche">Dimanche</option>
            
            </select>
            </p>

            <p><label for="heure"> Heure </label>
            <input type="time" id="heure" name="heure" min="09:00" max="18:00" required>


            </p>

            <p> <input type="submit" value="Envoyer" name="sendHoraires"> </p>


        </fieldset>
    </form>


    
  </div>

  <h3>Supprimer</h3>

  <div id="adminSupp">
    <section>
  <h4>Cours</h4>

  <ul>
      <?php for($compteur=0; $compteur<sizeof($allCours); $compteur++):?>
        <li>
        <strong>Id du cours :</strong> <?=$allCours[$compteur]->getIdCours()?>----<strong>Nom du cours :</strong> <?=$allCours[$compteur]->getNom()?> ---- <strong>Niveau : </strong><?=$allCours[$compteur]->getNiveau()?>---- <strong>Prix : </strong><?=$allCours[$compteur]->getPrix()?> €----<strong> Durée : </strong><?=$allCours[$compteur]->getTemps()?> ---- <strong>Categorie : </strong><?=$arrayCategorie[$compteur]?> (<?=$allCours[$compteur]->getCategorie()?>) ---- <strong>Description : </strong><?=$allCours[$compteur]->getDescription()?> ---- <strong>Image : </strong><?=$allCours[$compteur]->getImgCours()?>
          <a href="indexAdmin.php?action=suppression&ele=cours&id=<?=$allCours[$compteur]->getIdCours()?>" id="lienSuppression">  =>  Suppression de ce cours</a>
        </li>
        <?php endfor?>
      </ul>
      </section>

      <section>
      <h4>Recettes</h4>

<ul>
    <?php for($compteur2=0; $compteur2<sizeof($allRecettes); $compteur2++):?>
      <li>
      <strong>Id de la recette :</strong> <?=$allRecettes[$compteur2]->getIdRecette()?>----<strong>Nom de la recette :</strong> <?=$allRecettes[$compteur2]->getNom()?>----<strong> Niveau : </strong><?=$allRecettes[$compteur2]->getNiveau()?>---- <strong>Durée : </strong><?=$allRecettes[$compteur2]->getTemps()?>---- <strong>Nombre de personnes : </strong><?=$allRecettes[$compteur2]->getNombreDePersonne()?>---- <strong>Ingredients : </strong><?=$allRecettes[$compteur2]->getIngredients()?>---- <strong>Description :</strong> <?=$allRecettes[$compteur2]->getDescription()?>---- <strong>Categorie : </strong><?=$arrayCategorieRecette[$compteur2]?>  (<?=$allRecettes[$compteur2]->getCategorie()?>)---- <strong>Image de la recette : </strong><?=$allRecettes[$compteur2]->getImgRecette()?>---- <strong>Image du déroulé de la recette : </strong><?=$allRecettes[$compteur2]->getImgDerouleRecette()?>
        <a href="indexAdmin.php?action=suppression&ele=recette&id=<?=$allRecettes[$compteur2]->getIdRecette()?>" id="lienSuppression">  => Suppression de cette recette</a>
      </li>
      <?php endfor?>
    </ul>
    
    </section>


    <section>
      <h4>Horaires</h4>
      

<ul>
    <?php for($compteur3=0; $compteur3<sizeof($allHoraires); $compteur3++):?>
      <li>
        <strong>Id de l'horaire :</strong> <?=$allHoraires[$compteur3]->getIdHoraire()?>----<strong> Id du cours en question : </strong><?=$allHoraires[$compteur3]->getIdCours()?> (<?=$arrayCoursHoraire[$compteur3]?>)---- <strong>Jour : </strong><?=$allHoraires[$compteur3]->getJour()?>---- <strong>Heure : </strong><?=$allHoraires[$compteur3]->getHeure()?>
        <a href="indexAdmin.php?action=suppression&ele=horaire&id=<?=$allHoraires[$compteur3]->getIdHoraire()?>" id="lienSuppression">  => Suppression de cet horaire</a>
      </li>
      <?php endfor?>
    </ul>
    
    </section>


    
  </div>


  <div id="infoClient">
    <h3>Listes clients</h3>

    <section>
      <h4>All</h4>
      <?php if($allClients!=NULL):?>
    <ul>
  
    <?php foreach($allClients as $client):?>
      <li>
        <strong>Id du client :</strong> <?=$client->getIdClient()?>----<strong> Nom : </strong><?=$client->getNom()?>---- <strong>Prenom : </strong><?=$client->getPrenom()?>---- <strong>Code postale : </strong><?=$client->getCodePostale()?>---- <strong>Email : </strong><?=$client->getEmail()?>---- <strong>Pseudo : </strong><?=$client->getPseudo()?>
        <a href="indexAdmin.php?action=suppression&ele=client&id=<?=$client->getIdClient()?>" id="lienSuppression">  => Suppression de ce client</a>
      </li>
      <?php endforeach?>
    </ul>
    <?php endif?>
    <?php if($allClients==NULL):?>
    <p>Aucun clients à référencer</p>
    <?php endif?>
    
    </section>


    <section>
      <h4>Clients ayant commandés</h4>
      <?php if($ArrayCommandeClient !=NULL):?>

      <table>
			<?php for ($compteur4=0; $compteur4<sizeof($ArrayCommandeClient); $compteur4++):?>
      
      <tr><td><strong>Id du client :<?=$ArrayCommandeClient[$compteur4]->getIdClient()?></strong> </td></tr>
      <tr><td> Nom : <?=$ArrayCommandeClient[$compteur4]->getNom()?></td></tr>
      <tr><td> Prenom : <?=$ArrayCommandeClient[$compteur4]->getPrenom()?></td></tr>
      <tr><td> Email : <?=$ArrayCommandeClient[$compteur4]->getEmail()?></td></tr>
      <tr><td> Code Postal : <?=$ArrayCommandeClient[$compteur4]->getCodePostale()?></td></tr>
      <tr><td> Pseudo : <?=$ArrayCommandeClient[$compteur4]->getPseudo()?></td></tr>
      <tr><td>Id des/de la commande(s) :<?php foreach($arrayidCommande[$compteur4] as $commande):?> n° <?=$commande->getIdCommande()?><?php endforeach?></td></tr>
   
     
			
			<?php endfor?>

	
		</table>
    <?php endif ?>

    <?php if(empty($ArrayCommandeClient)):?>
    <p>Aucun clients à afficher</p>
    <?php endif ?>
    
    </section>

    <h3>Toutes les commandes passées</h3>

    <section>

    <h4>Commandes de cours</h4>

    
    <?php if($ToutesLesCommandes !=NULL):?>
    

    <table>
    <?php for($compteur5=0; $compteur5<sizeof($ToutesLesCommandes); $compteur5++):?>
      
      <tr><td><strong>Id de la commande :<?=$ToutesLesCommandes[$compteur5]->getIdCommande()?></strong> </td></tr>
      <tr><td><strong> Id du client : <?=$ToutesLesCommandes[$compteur5]->getIdClient()?></strong></td></tr>
      <tr><td><strong> Date : <?=$ToutesLesCommandes[$compteur5]->getDate()?></strong></td></tr>
      <tr><td><strong> Total : <?=$ToutesLesCommandes[$compteur5]->getPrixTotal()?> crédits </strong></td></tr>

      <tr><td><p><a href="indexAdmin.php?action=suppression&ele=commande&id=<?=$ToutesLesCommandes[$compteur5]->getIdCommande()?>" id="lienSuppression"> Supprimer la commande </a></p></td></tr>

      <?php foreach($resultReservationClient[$compteur5] as $reservation):?>
        <tr><td>Id de la reservation : <?=$reservation->getIdReservation()?></td></tr>
        <tr><td>Id de l'horaire : <?=$reservation->getIdHoraire()?></td></tr>


        <tr><td><p><a href="indexAdmin.php?action=suppression&ele=reservation&id=<?=$reservation->getIdReservation()?>" id="lienSuppression">Supprimer la Reservation</a></p></td></tr>

      <?php endforeach?>
		
      <?php endfor?>

	
		</table>

<?php else:?>
<p>Aucune commandes à afficher</p>
    <?php endif;?>   
    </section> 

    <section>
        <h4>Commandes de crédits</h4>

        <?php if($CommandeCredits !=NULL):?>

        <table>
    <?php foreach($CommandeCredits as $commCredit):?>
      
      <tr><td><strong>Id de la commande :<?=$commCredit->getIdCommande()?></strong> </td></tr>
      <tr><td><strong> Id du client : <?=$commCredit->getIdClient()?></strong></td></tr>
      <tr><td><strong> Date : <?=$commCredit->getDate()?></strong></td></tr>
      <tr><td><strong> Total : <?=$commCredit->getPrixTotal()?> € </strong></td></tr>

      <tr><td> <p><a href="indexAdmin.php?action=suppression&ele=commandeCredit&id=<?=$commCredit->getIdCommande()?>" id="lienSuppression">Supprimer la Commande</a></p></td></tr>

      <?php endforeach?>

	
		</table>


        <?php else:?>
            <p>Aucune commandes à afficher</p>
        <?php endif;?>   
    
    
    </section> 
  </div>

</body>
</html>