<?php
	include_once "connexion.php";
	session_start();
	if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($con,$_POST['user']);
      $mypassword = mysqli_real_escape_string($con,$_POST['password']);      
      $sql = "SELECT id_admin FROM admin WHERE user_admin = '$myusername' and password_admin = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);      
      $count = mysqli_num_rows($result);
      $login_session = $row['username'];
	  
      // If result matched $myusername and $mypassword, table row must be 1 row
      if( $myusername=="admin") {
         $_SESSION['login_user'] =;
         header("location: ../index.php");
      }else {
		echo "nom d'utilisateur ou mot de passe incorrect";
			header("location: ../admin.php");
		}
	}
?>