<?php
session_start();
if ($_SESSION['login_user'] ==false){
header("Location: admin.php");
}
else{
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
		<script language="JavaScript" type="text/javascript">
			//--------------- LOCALIZEABLE GLOBALS ---------------
				var d=new Date();
				var monthname=new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","juillet","Aout","Septembre","Octobre","Novembre","Decembre");
				var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
				var TIME = d.getHours() + " : " + d.getMinutes() + " : " + d.getSeconds();
			//--------------- END LOCALIZEABLE ---------------
		</script>
        <title>EC-Tunisie :: Produit ::</title>
    </head>
    <body>
		<?php
			include_once "scripts/connexion.php";
			if(empty($_GET['id_produit'])) $pid = '1';
			else if (($_GET['id_produit'])!=true) $pid = '1';
			else
			$pid = preg_replace("[^0-9]", "",$_GET['id_produit']);
			mysqli_set_charset($con,'utf8');
			$req="SELECT * FROM `produit` WHERE `id_produit` = '$pid' LIMIT 1";
			$res=$con->query($req);
			while ($donnees = $res->fetch_array())
			{
			$revendeur= $donnees['revendeur'];
			$titre = $donnees['titre'];
			$titr = preg_replace("/'/", "",$donnees['titre']);
			$image = $donnees['image'];
			$url = $donnees['url'];
			$desc = $donnees['desc'];
			$prix = $donnees['prix'];
			$date = $donnees['date'];
			}
			//****************//
			$req1="SELECT * FROM `produit` WHERE `titre` LIKE '%$titr'";
			$res1=$con->query($req1);
		?>
        <div id="bloc_page">
            <header>
                <div>
                    <div id="logo">
                        <img src="images/haut.png" alt="Logo de steg avec slogan" />    
                    </div>
                </div>
                
                <nav>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
						<li><a href="analyses.php">Analyses</a></li>
						<li><a href="revendeur.php">Revendeur</a></li>
                        <li><a href="a-propos.php">À propos</a></li>
                        <li><a href="contact.php">Contact</a></li>
						<li><a href="scripts/logout.php">Quitter</a></li>
                    </ul>
                </nav>
            </header>
            
            <div id="banniere_image">
            </div>
            
            <section>
                <article>
                    <h1><img src="images/ico_epingle.png" class="ico_categorie" /><?php echo $titre ?></h1>
					<div name="bloc_produit" class="">
					<table>
						<tr>
							<td width="220">
								<div name="colonne_gauche">
									<div name="bloc_image" >
										<img src="<?php  echo $image ?>" />
									</div>
									<div name="revendeur">
										<span><font class="titre2">Revendeur : </font><font class="titre"><?php echo $revendeur ?></font></span>
									</div>
								</div>
							</td>
							<td>
								<div name="colonne_droite">
									<div name="bloque_description">
										<span class="titre">Caractéristiques :</span>
										<div name="caract" class="desc">
											<?php echo $desc ?>
										</div>
										<div name="prix">
											<span><font class="titre2"> Prix : </font><?php echo $prix ?> DT</span>
										</div>
										<div name="date">
											<span><font class="titre2"> Dernière mise à jour : </font><?php echo $date ?></span>
										</div>
										<div name="achete">
											<br><center><a href="<?php echo $url ?>" target="_blank"><img src="images/lienexterne.jpg" width="40" height="30" />Lien externe de produit</a>
										</div>
										<br>
										<div class="titre2">
										Les changement des prix:
										</div>
										<table border="1" id="table_liste">
											<tr class="titre">
												<td>Prix</td>
												<td>Date</td>
											</tr>
											<?php
												while ($donnees1 = $res1->fetch_array())
												{
											?>
											<tr>
												<td><?php echo $donnees1['prix']; ?>DT</td>
												<td><?php echo $donnees1['date']; ?></td>
											</tr>
											<?php
												}
											?>
										</table>
									</div>							
								</div>
							</td>
						</tr>
					</table>	
					</div>
                </article>
                <aside>
					<p id="date">
						Date d'aujourd'hui :<br>
						<script language="javascript">
							document.write(TODAY);
						</script>
					</p>
					<p id="time">
						<script language="javascript">
							document.write(TIME);
						</script>
					</p>
					<br>
					<p id="message"><font size="5">Salut <?php echo $_SESSION['login_user']; ?>!</font></p>
				</aside>
            </section>
            
            <footer>
                <div id="footer-nav">
                    <h1>Navigation</h1>
                    <div id="listes_footer">
                        <ul>
                        <li><a href="index.php">Accueil</a></li>
						<li><a href="analyses.php">Analyses</a></li>
						<li><a href="revendeur.php">Revendeur</a></li>
                        <li><a href="a-propos.php">À propos</a></li>
                        <li><a href="contact.php">Contact</a></li>
						<li><a href="scripts/logout.php">Quitter</a></li>
                        </ul>
                    </div>
                </div>
				<br>
				<p>Tous droits réservés. Copyright © 2016 EC-Tunisie</p>
            </footer>
        </div>
    </body>
</html>
<?php
}
?>