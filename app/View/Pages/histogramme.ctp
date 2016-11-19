<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - histogramme');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<div id="presentation">
	<div id="titre-accueil">
		<span> Mes Rapports d'évolution </span>
		<div id="physique">
	

	
	



<div id="chart2" style="margin-left: 10px; margin-top: 50px; width: 400px; height: 300px; "></div>

<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;
		
		// Coordonnées x du repère
        var points = [2, 6, 7, 10, 12];
		
		// Coordonnées y du repère
        var date = ['01-oct-2013','08-oct-2013','15-oct-2013','27-oct-2013','04-nov-2013'];
         
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
					label : "date",
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
					label : "kcal consommees"
				}
            },
            highlighter: { show: false }
        });
     
    });

	</script>
		<a href="rapportEvolution" title="rapportEvolution" id="rapportEvolution"> <input type="button" name="retour" value="Retour" >
		</div>
	</div>
</div>
	