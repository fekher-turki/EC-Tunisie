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
        <title>EC-Tunisie :: Accueil ::</title>
    </head>
    
    <body>
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
                    <h1><img src="images/ico_epingle.png" class="ico_categorie" />Accueil</h1>
					<center>
						<div id="recherche">
							<table bgcolor="#F2F2F2" border="0" name="table-produit" id="table-produit">
								<form action='#table-produit' method="post">
								<tr>
									<td width="200">
										<label for="rev">Révendeur:</label><br>
										<select name="rev" id="rev">
											<option value="">Choisir un revendeur</option>
											<option value="tunisianet">tunisianet</option>
											<option value="mytek">mytek</option>
										</select>
									</td>
									<td width="200">
										<label for="tri">Catégorie:</label><br>
										<select name="cat" id="cat">
											<option value="">Choisir une catégorie</option>
											<option value="' INFORMATIQUE' OR `categorie` LIKE 'Ordinateurs & Tablettes' OR `categorie` LIKE ' COMPOSANTS' OR `categorie` LIKE 'Composants'">Informatique et Composants</option>
											<option value="' TELEPHONIE' OR `categorie` LIKE 'Téléphonie' OR `categorie` LIKE ' APPLE' OR `categorie` LIKE '%Mode - Bagage - Bijouterie%'">Téléphonie</option>
											<option value="' IMPRESSION' OR `categorie` LIKE 'Impression & Copieurs'">Impression</option>
											<option value="' IMAGE & SON' OR `categorie` LIKE 'TV-Sons-Photos' OR `categorie` LIKE ' JEUX' OR `categorie` LIKE 'Maison et loisirs'">Image,Son, Jeux et Autres..</option>
											<option value="' ACCESSOIRES' OR `categorie` LIKE 'Accessoires'">Accessoires</option>
											<option value="' RESEAUX & SECURITE' OR `categorie` LIKE 'Réseau & Sécurité'">Reseaux&securite</option>
											<option value="' BUREAUTIQUE' OR `categorie` LIKE 'Bureautique'">Bureatique</option>
											<option value="' ÉLECTROMENAGER' OR `categorie` LIKE 'Electroménager'">Electromanager</option>
										</select>
										</td>
										<td>
										<label for="tri">Tri par:</label><br>
										<select name="tri" id="tri">
											<option value="prix ASC">Le moins cher</option>
											<option value="prix DESC">Le plus cher</option>
											<option value="titre ASC">De A à Z</option>
											<option value="titre DESC">De Z à A</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>
										<label>Prix en DT:</label><br>
									</td>
								</tr>
								<tr>
									<td>
										<label for="prix-min">min</label>
										<input type="number" name="prix-min" id="prix-min" value="" min="0" max="15000"><br>
									</td>
									<td>
										<input type="search" placeholder="Entrez un mot-clef" id="recherche" name="recherche" size="40" required>
									</td>
									<td>
										<button name="btnseek" id="btnseek">Rechercher</button>
									</td>
								</tr>
								<tr>
									<td>
										<label for="prix-max">max</label>
										<input type="number" name="prix-max" id="prix-max" value="" min="0" max="15000">
									</td>
								</tr>
								</form>
							</table>
						</div>
						<div>
							<?php
								if (empty ($_POST['recherche']))
								{
									echo '<br><h2><center>Chercher le produit qui vous voulez !</center>';
								}
								else if ((preg_match("#[^0-9a-z ]#i",$_POST['recherche'])) || (strlen($_POST['recherche'])<= 2))
								{
									echo '<br><h2><font color ="red"><center>" '.$_POST['recherche'].' " Recherche invalid !</font></center>';
								}
								else
								{
									$rev = $_POST['rev'];
									$cat = $_POST['cat'];
									$tri = $_POST['tri'];
									$min = $_POST['prix-min'];
									$max = $_POST['prix-max'];
									$recherche = htmlspecialchars ($_POST['recherche']);
									include_once "scripts/connexion.php";
									if ($min > $max)
									{
									echo '<br><center class="titre">gamme de prix incorrect !</center>';
									}
									else
									{
									// revendeur
									if (!empty($_POST['rev']))
									{
										$req_rev = "AND `revendeur` LIKE '$rev'";
									}
									else $req_rev="";
									// catégorie
									if (!empty($_POST['cat']))
									{
										$req_cat = "AND (`categorie` LIKE ".$cat.")";
									}
									else $req_cat="";
									// tri
									if (!empty($_POST['tri']))
									{
										$req_tri = "ORDER BY ".$tri."";
									}
									//prix
									if ((!empty($_POST['prix-min']))||(!empty($_POST['prix-max'])))
									{
										$req_prix = "AND (`prix` between '$min' AND '$max')";
									}
									else $req_prix="";
									$req = "SELECT * FROM `produit` WHERE `titre` LIKE '%$recherche%' ".$req_cat." ".$req_prix." ".$req_rev." ".$req_tri."";
									mysqli_set_charset($con,'utf8');
									$res=$con->query($req);
							?>
							<table border="0" id="table_liste">
								<tr class="titre2">
									<td width="120" >Image :</td>
    								<td width="100">Revendeur :</td>
									<td width="">Produit :</td>
									<td width="105">Prix :</td>
									<td width="105">Dernière mise à jour :</td>
									<td width="130">Lien externe de produit :</td>
								</tr>
									<?php
									while ($donnees = $res->fetch_array())
									{
									?>
									<tr>
										<td><img src="<?php echo $donnees['image']; ?>" width="100" height="100"/></td>
										<td><?php echo $donnees ['revendeur']; ?></td>
										<td><a href="produit.php?id_produit=<?php echo $donnees['id_produit'];?>"> <?php echo $donnees['titre']; ?></a></td>
										<td><?php echo $donnees['prix']; ?> DT</td>
										<td><?php echo $donnees['date']; ?></td>
										<td><a href="<?php echo $donnees['url']; ?>" target="_blank">Lien externe</a></td>	
									</tr> 
									<?php
									}
									?>
							</table>
							<?php
							}
							}
							?>	
						</div>
					</center>
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