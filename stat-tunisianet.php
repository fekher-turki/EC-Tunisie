<?php // content="text/plain; charset=utf-8"

include_once "scripts/connexion.php";
$rev1 = "tunisianet";

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
$req4 = "SELECT COUNT(*) AS nbre4 FROM produit WHERE revendeur = '$rev1' AND(`prix` between '1500' AND '2000')";
$res4=$con->query($req4);
while ($donnees4 = $res4->fetch_array())
	{
	$nbr4 = $donnees4['nbre4'];
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

require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');
 
// Some (random) data
$ydata = array(0,$nbr1,$nbr2,$nbr3,$nbr4,$nbr5,$nbr6);
$xdata = array(0,500,1000,1500,2000,2500,5000);
 
// Size of the overall graph
$width=700;
$height=500;
 
// Create the graph and set a scale.
// These two calls are always required
$graph = new Graph($width,$height);
$graph->SetScale('intlin');
 
// Setup margin and titles
$graph->SetMargin(40,20,20,40);
$graph->title->Set($rev1);
$graph->subtitle->Set('(Nombre des produits par prix)');
$graph->xaxis->title->Set('Prix en DT');
 
 
// Create the linear plot
$lineplot=new LinePlot($ydata, $xdata);
 
// Add the plot to the graph
$graph->Add($lineplot);
 
// Display the graph
$graph->Stroke();
?>