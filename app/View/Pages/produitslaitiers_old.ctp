﻿<div id="presentation">
	<div id="image">
	</div>
	
	<div class="texte">
		<!-- Cette page est accessible à partir du menu situé en haut de page : Cliquez sur "Mon assiette" -> "Produits laitiers" -->
		<div class="span2"> Produits laitiers </div> 
		<br/>
		<h1> Quantité quotidienne conseillée </h1>
		<div class="p1"> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers.  
		</div>
	</div> 
	
	<div id="texte4">
		<table>
			<tr>
				<td >
					<!-- class = "images"-->
					<h1>  Equivalence pour une coupe de produits laitiers </h1>
					<div class="p1"> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
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
		<h1>  Conseils de consommation </h1> <br />
		<div class="p1"> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		</div>
	</div>
	
	<div id="containerLiensImages3cat">
		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Yaourts</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Produits laitiers']['Yaourts'] as $groupeProduitLaitier) {
					foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
						$fichier = strtok($produitLaitier['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
						echo "</li>";
					}
				} ?>
				</ul>
			</div>
		</fieldset>

		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Fromages</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Produits laitiers']['Fromages'] as $groupeProduitLaitier) {
					foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
                                            $fichier = strtok($produitLaitier['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
						echo "</li>";
                                        }
				} ?>
				</ul>
			</div>
		</fieldset>

		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Lait et desserts à base de lait</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Produits laitiers']['Lait et desserts à base de lait'] as $groupeProduitLaitier) {
					foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
						$fichier = strtok($produitLaitier['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
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
