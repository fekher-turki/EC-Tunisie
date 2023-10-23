<?php
session_start();
if ($_SESSION['login_user'] ==false){
header("Location: ../admin.php");
}
else{
?>
<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="../style.css" />
		<link rel="icon" type="image/x-icon" href="../images/favicon.ico" />
		<script language="JavaScript" type="text/javascript">
			//--------------- LOCALIZEABLE GLOBALS ---------------
				var d=new Date();
				var monthname=new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","juillet","Aout","Septembre","Octobre","Novembre","Decembre");
				var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
				var TIME = d.getHours() + " : " + d.getMinutes() + " : " + d.getSeconds();
			//--------------- END LOCALIZEABLE ---------------
		</script>
        <title>EC-Tunisie :: Importation ::</title>
    </head>
    
    <body>
        <div id="bloc_page">
            <header>
                <div>
                    <div id="logo">
                        <img src="../images/haut.png" alt="Logo de steg avec slogan" />    
                    </div>
                </div>
                
                <nav>
                    <ul>
						<li><a href="../maj.php">Mise À jour</a></li>
						<li><a href="logout.php">Quitter</a></li>
                    </ul>
                </nav>
            </header>
            
            <div id="banniere_image">
            </div>
            
            <section>
                <article>
                    <h1><img src="../images/ico_epingle.png" class="ico_categorie" />Importation</h1>
					<?php
						include_once "connexion.php";
						define('CSV_PATH','../commerce/');
						$fichier=$_FILES["userfile"]["name"];
						$csv_file = CSV_PATH . $fichier;
						if (($handle = fopen($csv_file, "r")) !== FALSE) {   
							while (($data = fgetcsv($handle, 104857600, ",", '"')) !== FALSE) {
        						$num = count($data);
        						for ($c=0; $c < $num; $c++) {
        						  $col[$c] = $data[$c];
								}

								$col1 = utf8_decode($col[0]);
								$col2 = utf8_decode($col[1]);
								$col3 = utf8_decode($col[2]);
								$col4 = utf8_decode($col[3]);
								$col5 = utf8_decode($col[4]);
								$col6 = utf8_decode($col[5]);
								$col7 = utf8_decode($col[6]);
								$col8 = utf8_decode($col[7]);

								$query = "INSERT INTO produit(`revendeur`, `categorie`, `titre`, `image`, `url`, `desc`, `prix`, `date`) VALUES('$col1','$col2','$col3','$col4','$col5','$col6','$col7','$col8')";
								$s= $con->query($query);
							}
  						fclose($handle);
						}
						echo "File data successfully imported to database!!";
						?>
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
						<li><a href="../maj.php">Mise À jour</a></li>
						<li><a href="logout.php">Quitter</a></li>
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