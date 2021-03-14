<header>
           
        <h1 class="titre"><a href="index.php" >Salty&amp;Sweet</a></h1>

        <p id="ouverture_menu" class="burger"></p>
        <nav id="menu">

            <ul>

                <div id="li">
                    <li id="fermeture_menu"></li>
                    <li><a href="index.php">Accueil</a></li>
                    <li><a href="index.php?page=cours">Nos cours</a></li>
                    <li><a href="index.php?page=recettes">Nos recettes</a></li>
                    <?php if(!isset($_SESSION["panier"])):?>

				    <li><a href="index.php?page=panier">Panier(0)</a></li>
			        <?php else: ?>
				        <li><a href="index.php?page=panier">Panier(<?=sizeof($_SESSION["panier"])?>)</a></li>
				
			        <?php endif ?>
                    <?php if(isset($_SESSION["id"]) && !empty($_SESSION["id"])):?>
		                <li><a href="index.php?action=deconnecter">Se deconnecter </a></li>
                        <li><a href="index.php?page=profil">Votre profil </a></li>
                    <?php else:?>
                        <li><a href="index.php?page=Login">Se connecter</a></li>
                        <li><a href="index.php?page=Creez">Creer un compte</a></li>
	                <?php endif?>
                    
                    
                </div>
            </ul>
        </nav>
    </header>