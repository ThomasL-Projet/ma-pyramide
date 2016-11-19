<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Légumes uniques');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<!-- NE PAS MIGRER CETTE PAGE INUTILE -->

<div id="presentation">
	<div id="image">
	</div>
    <div class="texte">
		<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mon assiette" -> "Légumes" -> "Légumes uniques : haricots et petits pois" -->
		<div class="span3"> Des légumes uniques : </div> <br />
		<div class="span3"> haricots et petits pois </div> <br />
	</div>
	
	<div id="texte4">
		<table>
			<tr>
				<td >
					<h1> Paragraphe 1 </h1>
					<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers.
					</div>
				</td>
				
				<td>
					<!-- Image illustrant le paragrpahe n°1 -->
					<div class="p1"><?php echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits')); ?></div>
				</td>
			</tr>
		</table>
	</div>
	
	<div id="texte4">
		<table>
			<tr>
				<td >
					<h1> Paragraphe 2</h1>
					<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers.
					</div>
				</td>
				
				<td>
					<!-- Image illustration du paragraphe n°2 -->
					<div class="p1"><?php echo $this->Html->image('Fruits.png', array('height' => '200', 'width' => '260', 'alt' => 'Fruits')); ?></div>
				</td>
			</tr>
		</table>
	</div>
</div>