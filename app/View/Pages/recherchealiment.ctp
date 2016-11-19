<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Recherche aliment');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<?php
	$connect = mysql_connect('localhost','root','') or die(mysql_error());
	mysql_select_db('pyr') or die(mysql_error());
	
	if(isset($_POST['search']) && !empty($_POST['search'])) {
		$search = mysql_real_escape_string(htmlentities($_POST['search']));
/*		$query = mysql_query("SELECT a.nom, a.type, a.sous_type, a.classe, a.sous_classe, a.categorie, a.Fibres, a.Eau, a.Lipides, a.Energie_Reglement_UE_kj as EKj, a.Energie_Reglement_UE_kcal as EKcal, a.Glucides, a.Sodium, a.Proteines
			 	 FROM aliment_2014 a
			  	 WHERE a.nom LIKE '$search%'"); */
		$query = mysql_query("SELECT i.chemin as img, a.nom, a.type, a.sous_type, a.classe, a.sous_classe FROM image_2014 i, aliment_2014 a WHERE i.id_aliment = a.id AND a.nom LIKE '$search%'");
		while($rows=mysql_fetch_array($query)) {
/*			echo "<li><a href=''>".$rows['nom']."</a></li>"; */
			echo "<li style='height:100px; margin-bottom:5px;'>
				  <a href='#' id=".$rows['img']." onclick='openImg(this.id)'>
					  <img src='http://127.0.0.1/dev/mapyramide.fr/app/webroot/img/imagesAliment".$rows['img']."' style='width:100px; height:100px; position:relative; float:left;'/>
				  </a>
				  <table style='text-align:center; margin-left:10px; position:relative; float:left; height:50px;'>
				  <tr>
					  <th>Nom</th>
				      <th>Type</th>
					  <th>Sous-type</th>
					  <th>Classe</th>
					  <th>Sous-classe</th></tr>
				  <tr style='height:50px; '>
					  <td style='width:150px;'>".$rows['nom']."</td>
				      <td style='width:200px;'>".strtolower($rows['type'])."</td>
					  <td style='width:200px;'>".strtolower($rows['sous_type'])."</td>
					  <td style='width:200px;'>".strtolower($rows['classe'])."</td>
					  <td style='width:200px;'>".strtolower($rows['sous_classe'])."</td></tr>
				  </table>
			</li>";
		}
	}
?>