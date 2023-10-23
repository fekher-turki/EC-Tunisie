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
        <title>EC-Tunisie :: Contact ::</title>
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
                    <h1><img src="images/ico_epingle.png" class="ico_categorie" id="form-contact"/>Contact</h1>
						<ul>
						Pour tout renseignement, contactez nous par mail : 
						<li><a href="mailto:turki.fekher@gmail.com">turki.fekher@gmail.com</a></li>
						<li><a href="mailto:hatem.mediouni@gmail.com">hatem.mediouni@gmail.com</a></li>
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