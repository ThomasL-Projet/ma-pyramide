<div id="presentation">
	<div id="image">
	</div>
	
	<div class="texte">
		<!-- Cette page est accessible à partir du mnu situé en haut de page : Cliquez sur "Mon assiette" -> "Protéines" -->
		<div class="span3"> Produits protéinés </div> 
		<br/>
		<h1> Quantité quotidienne conseillée </h1>
		<div class="p1"> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		</div> 
		<br/>
	</div> 
	
	<div id="texte4">
		<table  width=145%; >
			<tr>
				<td >
					<!-- class = "images"-->
					<h1>  Equivalence pour une coupe de protéines </h1>
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
		  <legend class='legendCenter'>Viandes</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Protéines']['Viandes'] as $groupeProteine) {
					foreach ($groupeProteine['Aliment'] as $proteine) {
						$fichier = strtok($proteine['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($proteine['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $proteine['nomFR'], 'escape' => true));
						echo "</li>";
					}
				} ?>
				</ul>
			</div>
		</fieldset>

		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Poissons</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Protéines']['Poissons'] as $groupeProteine) {
					foreach ($groupeProteine['Aliment'] as $proteine) {
						$fichier = strtok($proteine['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($proteine['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $proteine['nomFR'], 'escape' => true));
						echo "</li>";
					}
				} ?>
				</ul>
			</div>
		</fieldset>

		<fieldset class='listeFruitsLegumes'>
		  <legend class='legendCenter'>Œufs et dérivés</legend>
			<div class="listeForEach">
				<ul>
				<!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
				<?php 
				foreach ($donnees['Protéines']['Œufs et dérivés'] as $groupeProteine) {
					foreach ($groupeProteine['Aliment'] as $proteine) {
						$fichier = strtok($proteine['chemin'], ',');
						if ($fichier == '') {
							$fichier = 'noimage.jpg';
						}
						echo "<li>";
						echo $this->Html->link($proteine['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $proteine['nomFR'], 'escape' => true));
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