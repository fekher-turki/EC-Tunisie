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
        <title>EC-Tunisie :: Analyses ::</title>
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
                    <h1><img src="images/ico_epingle.png" class="ico_categorie" />Analyses</h1>
					<p id="nbre">
					<form action='#nbre' method="post">
					Le nombre total des produits de
						<select name="rev" id="rev">
							<option value="">Choisir un revendeur</option>
							<option value="tunisianet">tunisianet</option>
							<option value="mytek">mytek</option>
						</select>
					<button name="go" id="go">est : </button>
					<?php
						@$rev = $_POST['rev'];
						include_once "scripts/connexion.php";
						if (empty($_POST['rev']))
							{
								$nbr="0";
							}
						else
							{
								$req = "SELECT COUNT(*) AS nbre FROM produit WHERE revendeur = '$rev'";
								$res=$con->query($req);
								while ($donnees = $res->fetch_array())
								{
									$nbr = $donnees['nbre'];
								}
							}
					?>
					<?php echo $nbr; ?>
					</form>
				</p>
				<br>
				<p id="gamme">
					<form action='#gamme' method="post">
					La gamme des prix en DT :
					<br><br>
					<table border="1">
						<tr align="center">
							<td>
								Revendeur
							</td>
							<td>
								Prix entre
							</td>
							<td>
								Nombre des produits
							</td>
							<td>
								Action
							</td>
						</tr>
						<tr align="center">
							<td>
								<select name="rev0" id="rev0">
									<option value="tunisianet">tunisianet</option>
									<option value="mytek">mytek</option>
								</select>
							</td>
							<td>
								<input type="number" name="prix-min" id="prix-min" value="" placeholder="prix inf" min="0" max="15000">DT -
								<input type="number" name="prix-max" id="prix-max" value="" placeholder="prix ext" min="0" max="15000">DT
							</td>
							<td>
								<?php
								include_once "scripts/connexion.php";
								@$max = $_POST['prix-max'];
								@$min = $_POST['prix-min'];
								@$rev0 = $_POST['rev0'];
								$req1 = "SELECT COUNT(*) AS nbre1 FROM produit WHERE revendeur = '$rev0' AND(`prix` between '$min' AND '$max')";
								$res1=$con->query($req1);
								while ($donnees1 = $res1->fetch_array())
								{
									$nbr1 = $donnees1['nbre1'];
								}
								echo $nbr1; ?>
							</td>
							<td>
								<input type="submit" name="btn" id="btn" value="Calculer">
							</td>
						</tr>
					</table>
					</form>
				</p>
				<br><hr><br>
				<font class="titre">Les Courbes :</font>
				<ul>
					<li>Pourcentage des produits par revendeur</li>
					<img src="total.php">
					
					<li>Nombre des produits par prix</li>
				<p id="stat">
					<form action='#stat' method="post">
						<select name="rev1" id="rev1">
							<option value="tunisianet">tunisianet</option>
							<option value="mytek">mytek</option>
						</select>
						<button>Generer courbe</button>
					</form>
					<?php 
						@$rev1 = $_POST['rev1'];
						if ($rev1=="mytek")
						{
						?><img src="stat-mytek.php"><?php
						}
						else
						{
						?><img src="stat-tunisianet.php"><?php
						}
					?>
					
				</p>
				</ul>
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