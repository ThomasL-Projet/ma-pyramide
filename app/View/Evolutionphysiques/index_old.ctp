<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/rapportEvolution/');?>
<div id="image">
	</div>
	<!-- Cette page est accessible depuis le menu situé en haut de page. Cliquez sur "Ressources" -> "SuperTracker" -> "Encyclopédie" -->
	<div class="texte" style="margin-bottom:120px;">
			<div class="span2"> Mes Rapports d'évolution </div> 
			<div class="p1">Retracez votre activité physique 
			</div>
		</div><br><br />
	<div id="titre-accueil">
		
		
<!-- ---------------------------------------------------------------------------------------------------------->                
                <div id="physique" style="margin-left:300px;">




<div id="chart2" style="margin-left: -50px; margin-top: 50px; width: 400px; height: 300px; "></div>

<script class="code" type="text/javascript" language="javascript">
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;

        		// Coordonnées x du repère
        var points = [<?php echo $caldep1; ?>, <?php echo $caldep2; ?>,<?php echo $caldep3; ?>,<?php echo $caldep4; ?>,<?php echo $caldep5; ?>,<?php echo $caldep6; ?>,<?php echo $caldep7; ?>];
		
		// Coordonnées y du repère
        var date = ['<?php echo $jourfr1; ?>','<?php echo $jourfr2; ?>','<?php echo $jourfr3; ?>','<?php echo $jourfr4; ?>','<?php echo $jourfr5; ?>','<?php echo $jourfr6; ?>','<?php echo $todayfr; ?>' ];
         
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
        
        
        <!-- ---------------------------------------------------------------------------------------------------->
				<br /><?php echo $this->Html->link('<input type="button" style="width: 150px;" name="modif" value="Voir mes activités" />', '/evolutionphysiques/edit/', array('escape' => false));?>
                <?php echo $this->Html->link('<input type="button" style="width: 150px; margin-left:20px;" name="modif" value="Retour" />', '/rapportEvolution/', array('escape' => false));?>
		</div>
	</div>
</div>
	