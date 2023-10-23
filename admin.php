<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="style.css" />
		<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
        <title>:: Login EC-Tunisie::</title>
		<script language="JavaScript" type="text/javascript">
			//--------------- LOCALIZEABLE GLOBALS ---------------
				var d=new Date();
				var monthname=new Array("Janvier","Fevrier","Mars","Avril","Mai","Juin","juillet","Aout","Septembre","Octobre","Novembre","Decembre");
				var TODAY = monthname[d.getMonth()] + " " + d.getDate() + ", " + d.getFullYear();
				var TIME = d.getHours() + " : " + d.getMinutes() + " : " + d.getSeconds();
			//--------------- END LOCALIZEABLE ---------------
		</script>
    </head>
    
    <body>
        <div id="bloc_page">
            <header>
                <div>
                    <div id="logo">
                        <img src="images/haut.png" alt="Logo de steg avec slogan" />    
                    </div>
                </div>
            </header>
			<br>
            <section>
                <article>
					<center>
                    <h1>Identifiez-vous à l'application</h1>
					<fieldset style="width:320px">
							<legend>Connexion </legend>
							<form method="post" action="#">
								<table>
									<tr>
										<td><label for="user">Nom d'utilisateur :</label></td>
										<td><input type="text" name="user" id="user" size="20" required/></td>
									</tr>
									<tr>
										<td><label for="password">Mot de passe :</label></td>
										<td><input type="password" name="password" id="password" size="20" required/></td>
									</tr>
								</table>
								<br>
							<input type="submit" id="envoyer" name="envoyer" value="Connecter" /><span id="tab"/><input type="reset" id="cancel" name="cancel" value="Annuler" /></center>
						</form>
					</fieldset>
					<?php
	include_once "scripts/connexion.php";
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		// username and password sent from form 
		$myusername = $_POST['user'];
		$mypassword = $_POST['password'];
		$sql = "SELECT * FROM admin WHERE user_admin = '$myusername' and password_admin = '$mypassword'";
		$result= $con->query($sql);
		$row = $result->fetch_array();
		$_SESSION['login_user'] = $row['user_admin']; 
		$_SESSION['type'] = $row['type_admin'];
	  
		// If result matched $myusername and $mypassword, table row must be 1 row
		if($_SESSION['type'] == "admin")
		{
			header("location: maj.php");
		}
		else if($_SESSION['type'] == "user")
		{
			header("location: index.php");
		}else {
		?><center class="titre"><?php echo "Nom d'utilisateur ou Mot de passe incorrect";?><br><?php echo "Réessayer à nouveau SVP.."?></center><?php
		}
	}
?>
					</center>
                    </article>
            </section>
            
            <footer>
				<p>Tous droits réservés. Copyright © 2016 EC-Tunisie</p>
            </footer>
        </div>
    </body>
</html>