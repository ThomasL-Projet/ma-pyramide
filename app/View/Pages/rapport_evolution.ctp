<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Rapport d\'évolution');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<?php

	App::import('Vendor', 'Fonction_PDO');
	echo $this->Html->link('<< Retour', 'javascript:history.back()'); 
	// nom de l'utilisateur connecté
	if (!($username = AuthComponent::user('username'))) {
?>
		<script type="text/javascript">
			alert("Il faut etre connecte pour utiliser cette fontionnalité.");
		</script>
<?php
	} else {
	
	
	// On prend les 10 derniers poids de l'utilisateur
	$requetePoids = "SELECT date, poids
			  FROM historique_poids_2014
			  WHERE nomUtilisateur = '".$username."'
			  ORDER BY date DESC";
	
	// On prend les 10 derniers temps d'activité physique de l'utilisateur
	$requetePhysiqueTemps = "SELECT temps, DATE_FORMAT(date,'%d/%m/%Y') AS date
							 FROM historique_activite_physique_2014
							 WHERE nomUtilisateur = '".$username."'
							 ORDER BY date DESC";
	
	// On prend les 5 derniers objectifs personnels de l'utilisateur 	
	$requeteObjectif = "SELECT DATE_FORMAT(date_validation,'%d/%m/%Y') AS date_validation, intitule
						FROM historique_objectifs_2014
						WHERE nomUtilisateur = '".$username."'
						ORDER BY date_validation DESC";
	
	// Tableau de la courbe de poids
	$tab = requete_bd($requetePoids);
	// Pour passer d'un tableau en php à une variable en javasript,
	// On créé une variable telle qu'elle sera dans le javascript
	// où on insére les données du tableau en php
	$chaine = "[";
	
	$compte = count($tab);
	if ($compte > 10 ) { $compte =10; }
	for ($i = $compte-1; $i>=0; $i--) {
	
		$chaine = $chaine."['".$tab[$i][0]."',".$tab[$i][1]."] ";
		if ($i>0) {
			$chaine = $chaine.", ";
		}
	}
	$chaine = $chaine."]";
	
	// Tableau de l'histogramme de suivi physique
	$tab1 = requete_bd($requetePhysiqueTemps);
	
	$date = "[";
	$temps = "[";
	// On ne prend que les 10 derniers temps d'activité physique
	$compteur = count($tab1);
	if ($compteur>10) {  $compteur = 10; }
	for ($i = $compteur-1; $i>=0; $i--) {
	
		$date = $date."'".$tab1[$i][1]."'";
		$temps = $temps."".$tab1[$i][0]."";
		if ($i>0) {
			$date = $date.", ";
			$temps = $temps.", ";
		}
	}
	$date = $date."]";
	$temps = $temps."]";	
	
	
	// Tableau de l'historique des objectifs
	$tab2 = requete_bd($requeteObjectif);
	$dateO =  "[";
	$nom = "[";
	
	$compteur2 = count($tab2);
	if ($compteur2>5) {  $compteur2 = 5; }
	
?>

<div id="presentation">
	<div id="titre-accueil">
		<span> Mes Rapports d'évolution </span>

		<script>
		// Fonction permettant de cacher ou rendre visible un div en particulier
		function voirDiv(name) {
			var table =['Poids', 'Physique', 'Objectif'];
			// On cache tous les div et on rend visible seulement celui que l'on veut
			for (i=0; i<table.length; i++) {
				document.getElementById(table[i]).style.visibility="hidden";
			}
				document.getElementById(name).style.visibility="visible";
		}
		</script>
			
		
		<div id="bandeau" style="margin-left: 50px; margin-top: 50px;" >
			<input type="button" name="Poids" value="Gestion Poids" onclick="voirDiv(this.name)" >
			<input type="button" name="Physique" value="Suivi physique" onclick="window.location = '../evolutionphysiques/'">
			<input type="button" name="Objectif" value="Gestion objectifs" onclick="voirDiv(this.name)"> 
		</div>
		<!-- Position:absolute sert à mettre le div directement là où on veut 
		sans qu'il y ai de probléme d'empietement avec un autre div -->
		<div id="Poids" style="visibility:hidden; position:absolute; "> 

			<div id="chart1" style="margin-left: 50px; margin-top: 50px; width: 500px; height: 300px; "></div>
 
			<!-- 3 -->
			<script class="code" type="text/javascript" language="javascript">
			$(document).ready(function(){
		
				// Coordonnées x et y de chaque points de la courbe de la courbe
				var points = <?php echo $chaine ?>;
				// Permet de creer une courbe à partir d'un nombre quelconque de points 
				
				var curve1 = $.jqplot ("chart1", [points], {
					// Titre de la courbe
					title: 'Courbe de poids',
					// Permet de lisser la courbe
					seriesDefaults: {
					  rendererOptions: {
						  smooth: true
					  }
					},
					// Cette fonction permet de faire tourner le label de l'axe des ordonnées 
					axesDefaults: {
						labelRenderer: $.jqplot.CanvasAxisLabelRenderer
					},
					axes:{
						yaxis:{
							label : "poids (en g)",
							min : 0
						},
						xaxis:{
							renderer:$.jqplot.DateAxisRenderer,
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
							tickOptions: {
								angle: -30
							}
						}
					}
				});
			});
			</script>
		</div>


		<div id ="Physique" style="visibility:hidden; position:absolute ">
	
			<div id="chart2" style="margin-left: 50px; margin-top: 50px; width: 500px; height: 300px; "></div>
			<script class="code" type="text/javascript" language="javascript">
			$(document).ready(function(){
				$.jqplot.config.enablePlugins = true;
		
				// Coordonnées x du repère
				var points = <?php  echo $temps ?>
				
				// Coordonnées y du repère
				var date = <?php echo $date ?>
				 
				plot1 = $.jqplot('chart2', [points], {
					
					seriesDefaults:{
					// Plugin permettant de créer un histogramme
						renderer:$.jqplot.BarRenderer,
						pointLabels: { show: true }
					},
					// Cette fonction permet de faire tourner le label de l'axe des ordonnées 
					axesDefaults: {
						labelRenderer: $.jqplot.CanvasAxisLabelRenderer
					},
					axes: {
						xaxis: {
							renderer: $.jqplot.CategoryAxisRenderer, 
							ticks: date,
							// Plugins permettant de tourner chaque label de points 
							// de 30 degrés
							tickRenderer: $.jqplot.CanvasAxisTickRenderer,
							tickOptions: {
								angle: -30
							}
						},
						yaxis: {
							label : "temps (en min)"
						}
					},
					highlighter: { show: false }
				});	 
			});

			</script>	
		</div>
		
		
		<div id ="Objectif" style="visibility:hidden; position:absolute ; margin-left: 50px; margin-top: 0px; width: 500px; height: 300px; ">
			<div class ="objectifs2" >	
<?php			for ($i = 0; $i < $compteur2; $i++) { ?>
				<table cellspacing="15px" cellpadding= "10px">
					<tr class="bordure" id="val">
						<td id="obj"><strong><?php echo $tab2[$i][0]." : " ?> <?php echo $tab2[$i][1] ?></strong></td>
					</tr>
				</table>
				
<?php  } ?>
			</div>
		</div>
	
	
	</div>
</div>

<div id="retour1" style="margin-left:800px; position:absolute; margin-top: 800px ">
		<a href="supertracker" title="supertracker" id="supertracker"> <input type="button" name="retour" value="Retour" ></a>
</div>

<?php  } ?>
