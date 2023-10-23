<?php
/**
 * Charts 4 PHP
 *
 * @author Shani <support@chartphp.com> - http://www.chartphp.com
 * @version 1.2.3
 * @license: see license.txt included in package
 */
include_once "scripts/connexion.php";
$rev1 = "mytek";

// 0 - 500
$req1 = "SELECT COUNT(*) AS nbre1 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '0' AND '500')";
$res1=$con->query($req1);
while ($donnees1 = $res1->fetch_array())
	{
	$nbr1 = $donnees1['nbre1'];
	}
// 500 - 1000
$req2 = "SELECT COUNT(*) AS nbre2 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '500' AND '1000')";
$res2=$con->query($req2);
while ($donnees2 = $res2->fetch_array())
	{
	$nbr2 = $donnees2['nbre2'];
	}
// 1000 - 1500
$req3 = "SELECT COUNT(*) AS nbre3 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '1000' AND '1500')";
$res3=$con->query($req3);
while ($donnees3 = $res3->fetch_array())
	{
	$nbr3 = $donnees3['nbre3'];
	}
// 1500 - 2000
$req4 = "SELECT COUNT(*) AS nbre1 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '1500' AND '2000')";
$res4=$con->query($req4);
while ($donnees4 = $res4->fetch_array())
	{
	$nbr4 = $donnees1['nbre4'];
	}
// 2000 - 2500
$req5 = "SELECT COUNT(*) AS nbre5 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '2000' AND '2500')";
$res5=$con->query($req5);
while ($donnees5 = $res5->fetch_array())
	{
	$nbr5 = $donnees5['nbre5'];
	}
// 2500 - 5000
$req6 = "SELECT COUNT(*) AS nbre6 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '2500' AND '5000')";
$res6=$con->query($req6);
while ($donnees6 = $res6->fetch_array())
	{
	$nbr6 = $donnees6['nbre6'];
	}

include("lib/chartphp_dist.php");

$p = new chartphp();

$p->data = array(array(array("0 - 500",$nbr1),array("500 - 1000",$nbr2),array("1000 - 1500",$nbr3),array("1500 - 2000",$nbr4),array("2000 - 2500",$nbr5),array("2500 - 5000",1876)));

$p->chart_type = "line";

// Common Options
$p->title = "Tunisianet";
$p->ylabel = "Nombre produits";

$p->options["axes"]["yaxis"]["tickOptions"]["prefix"] = '';

$out = $p->render('c1');
?>
<!DOCTYPE html>
<html>
	<head>
		<script src="lib/jquery.min.js"></script>
		<script src="lib/chartphp.js"></script>
		<link rel="stylesheet" href="lib/chartphp.css">
	</head>
	<body>
		<div style="width:40%; min-width:450px;">
			<?php echo $out;
			?>
		</div>
	</body>
</html>