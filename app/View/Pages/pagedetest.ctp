<div id="presentation">
	<div id="image">
	</div>
    <div class="texte">
		<!-- Cette page est accessible depuis le menu situé en haut de la page : Cliquez sur "Mon assiette" -> "Céréales" -->
		<div class="span1"> TITRE </div> <br/>
		<div class="p1"> ----------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------
-----------------------------------------------------------PARAGRAPHE 1-----------------------------------------------------
------------------------------------------------------------------------------------------------
--------------------------------------------------------
		</div> 
		<br/>
		
	</div> 
	<div id="texte4">
		<table>
			<tr>
				<td >
					<!-- class = "images"-->
		<div class="p1"> ----------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------
-----------------------------------------------------------PARAGRAPHE 2-----------------------------------------------------
------------------------------------------------------------------------------------------------
--------------------------------------------------------
		</div> 
				</td>
				<td>
					<br/><br/><br/>
					<!-- Image illustrant le paragraphe n°2 -->
					<div class="p1"><?php echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits')); ?></div>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="texte6">
		<div class="p1"> ----------------------------------------------------------------------------------------------------
------------------------------------------------------------------------------------------------
-----PARAGRAPHE 3-----------------------------------------------------
------------------------------------------------------------------------------------------------
----------------------------
		</div> 
	</div>
	
	<div id="containerLiensImages2cat">
		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Grains entiers</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Céréales']['Grains entiers'] as $groupeCereale) {
					foreach ($groupeCereale['Aliment'] as $cereale) {
						$fichier = strtok($cereale['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($cereale['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $cereale['nomFR'], 'escape' => true));
						echo "</li>";
					}
				} ?>
				</ul>
			</div>
		</fieldset>

		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Grains raffinés</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Céréales']['Grains raffinés'] as $groupeCereale) {
					foreach ($groupeCereale['Aliment'] as $cereale) {
						$fichier = strtok($cereale['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($cereale['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $cereale['nomFR'], 'escape' => true));
						echo "</li>";
					}
				} ?>
				</ul>
			</div>
		</fieldset>
	</div>
</div>

<!--Script permettant l'affichage des images à l'aide de zoombox -->
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>

<script type="text/javascript">
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
</script>