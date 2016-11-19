<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon alimentation');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿﻿<div id="presentation">
	<div id="image">
	</div>
	
    <div class="texte">
		<span> <span></span><span></span><span></span>Identifier ce que je <br/> <span></span><span></span><span></span>mange actuellement </span> 
		<br/><br/><br/><br/><br/><br/><br/><br/><br/>
		<h1>Introduction </h1>
		<p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		</p> 
	</div>
	
	<div class="texte">
		<table  width=145%; >
			<br/><br/><br/><br/><br/><br/>
			<tr>
				<td >
					<h1>Paragraphe 1 </h1>
					<p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers.
					</p>
				</td>
				
				<td> 
					<!-- Image illustrant le paragraphe n°1 -->
					<p><?php echo $this->Html->image('Fruits.png', array('height' => '200px', 'width' => '260px', 'alt' => 'Fruits')); ?></p>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="texte">
		<table  width=145%; border=1px; >
			<br/><br/><br/><br/><br/><br/>
			<h1>Paragraphe 2 </h1>
			<tr>
				<td style="padding: 15px">
					<h1>Paragraphe</h1>
					<p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
					</p>
				</td>
				
				<td style="padding-right: 15px">
					<h1>Paragraphe</h1>
					<p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être. </p>
				</td>
			</tr>
			
			<tr>
				<td style="padding: 15px">
					<h1>Paragraphe</h1>
					<p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. </p>
				</td>
				
				<td style="padding-right: 15px">
					<h1>Paragraphe</h1>
					<p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être. </p>
				</td>
			</tr>
		</table>
	</div>
</div>
