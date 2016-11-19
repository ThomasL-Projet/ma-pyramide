<?php
 echo $this->Html->script('jqplot.canvasOverlay.min.js');

echo $this->Form->create('Gestionpoids');
  ?>
  <div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/supertracker');?>
	<!-- Cette page est accessible depuis le menu situé en haut de page. Cliquez sur "Ressources" -> "SuperTracker" -> "Gestion pondérale" -->
		<div id="image">
	</div>
	
    <div class="texte">
		<div class="span2"> Mon gestionnaire poids </div> 
		
		<div class="p1">Vous guide dans la gestion de votre poids, rentrez votre poids et suivez vos progrès dans le temps
		</div>
	</div><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div id="bloc-editeur">
<center><h1>Analysez vos progrès en entrant un nouveau poids</h1></center><br /><hr /><br />
<table width=100%>
	<tr>
	<td width=50%>
		<div style="margin-left:100px;">
		Saisissez votre poids : <br />
		<INPUT TYPE = "text" MAXLENGTH = 3 name = "lepoids" VALUE ="" id="lepoids" style="width: 80px;">
		</div>
	</td>
	<td width=50%>
		<div style="margin-left:150px;">
		Mon objectif : <br />
		<input type="text" disabled="true" MAXLENGTH = 3 name = "objectif" id="objectif" value="<?php echo $obj ;?>" style="width: 80px;"/> <br /><br /><br />
		</div>
		<INPUT TYPE =button VALUE = "Modifier mon objectif" style="margin:0px;width:180px;margin-left:110px" onclick="act_desact()">
		
	</td>
	</tr>

</table>
<br /><hr /><br />
<input type="submit" value="Valider" onclick="return confirm();" style="margin-left:300px">
<?php if (count($poids) >= 2) : ?>

<br /><br /><hr /><br /><center><h1>Vos progrès dans le temps</h1></center><br /><hr /><br />

<div id="chart2" style="margin-left: 100px; margin-top: 50px; width: 500px; height: 350px; "></div>
<?php else :?>
<br /><br /><center><div style="font-style:italic; color:green;">
<?php
	if (count($poids) == 0) {
		echo 'Vous devez saisir deux fois votre poids pour pouvoir analyser vos progrès dans le temps';
	} else {
		echo 'Vous devez saisir une deuxième fois votre poids pour pouvoir analyser vos progrès dans le temps';
	}
?>
</div></center>
<?php endif; ?>
</div>

<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>

<script class="code" type="text/javascript" language="javascript">
<?php if (isset($Ordonne) and count($Ordonne) > 1) : ?>
$(document).ready(function(){
        $.jqplot.config.enablePlugins = true;

        		// Coordonnées x du repère
        var points = <?php echo json_encode($Ordonne); ?>
		
		// Coordonnées y du repère
		 var grid = {
			gridLineWidth: 1.5,
			gridLineColor: 'rgb(235,235,235)',
			drawGridlines: true
		};

        var date = <?php echo json_encode($Abscisse); ?>

        /*date.push(<?php echo $Ordonne[0];?>);
		date.push(<?php echo $Ordonne[1];?>);*/
        plot1 = $.jqplot('chart2', [points], {
            
      
			// Cette fonction permet de faire tourner le label de l'axe des ordonnées 
			axesDefaults: {
				labelRenderer: $.jqplot.CanvasAxisLabelRenderer,
				max : <?php echo $Maxpoids[0]['max_poids']+10 ;?>,
				min : 0
				
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
					label : "poids en kg",
					tickInterval: 10
				}},
				grid: grid,
				canvasOverlay: {
					show: true,
				objects: [
                {dashedHorizontalLine: {
                    name: 'pebbles',
                    y: <?php echo $obj ;?>,
                    lineWidth: 3,
                    xOffset: 0,
                    color: 'rgb(89, 198, 154)',
                    shadow: false
                }}]
				
            },
            highlighter: { show: false }
        });
     
    });
<?php endif; ?>
	jQuery(function($){
        $('a.zoombox').zoombox();

        /**
        * Or You can also use specific options
        $('a.zoombox').zoombox({
            theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
            opacity     : 0.8,              // Black overlay opacity
            duration    : 800,              // Animation duration
            animation   : true,             // Do we have to animate the box ?
            width       : 500,              // Default width
            height      : 500,              // Default height
            gallery     : true,             // Allow gallery thumb view
            autoplay : false                // Autoplay for video
        });
        */
	});

function confirm() {
	var poids = document.getElementById("lepoids").value;
	var objectif = document.getElementById("objectif").value;
	var regex = /^[0-9]{0,3}$/;
	if (!(regex.test(document.getElementById("lepoids").value))) {
		alert("Attention, le poids doit être un nombre de 1 à 3 chiffres (ex: 56)");
		return false;
	}
	if( poids.length != 0 && poids <= 0){
		alert('Attention, le poids doit être supperieur à zero');
		return false;
	}
	regex = /^[0-9]{1,3}$/;
	if (!(regex.test(document.getElementById("objectif").value))) {
		alert("Attention, l'objectif doit être un nombre de 1 à 3 chiffres (ex: 56)");
		return false;
	}
	if (objectif <= 0){
		alert('Attention, l\'objectif doit être supperieur à zero');
		return false;
	}			
	return true;
}


function act_desact() {
	var texte = document.getElementById("objectif");
	if (texte.disabled == true) {
		texte.disabled = false;
	}
} 
		
</script>


</div>
