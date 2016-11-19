<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Courbe');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<div id="presentation">
	<div id="titre-accueil">
		<span> Mes Rapports d'évolution </span>

	


<!-- 2 -->

<div id="chart1" style="margin-left: 10px; margin-top: 50px; width: 400px; height: 300px; "></div>
 
<!-- 3 -->
<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){
		
		// Coordonnées x et y de chaque points de la courbe de la courbe
		var points = [['2013-10-01',85], ['2013-10-08',82], ['2013-10-15',78], ['2013-10-27',80], ['2013-11-04',80]];
		// Permet de creer une courbe à partir d'un nombre quelconque de points 
		
		var curve1 = $.jqplot ("chart1", [points], {
			// Titre de la courbe
			title: 'Courbe de glucides',
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
					label : "glucides",
					min : 0
				},
				xaxis:{
					label : "date",
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

<div id="physique>
	
</div>
		<a href="rapportEvolution" title="rapportEvolution" id="rapportEvolution"> <input type="button" name="retour" value="Retour" >
	</div>
</div>