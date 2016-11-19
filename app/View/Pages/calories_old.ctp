<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La diététique', array('action' => 'dietetique', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La gestion pondérale', array('action' => 'gestionponderale', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les calories', 'Javascript:void(0);'); ?></li>
</nav>

﻿<div id="presentation">
	<div id="image">
	</div>
    <div class="texte">
		<!-- Cette page est accessible depuis le menu situé en haut de la page : Cliquez sur "Poids/Calories" -> "Calories" -->
		<div class="span1"> Calories </div> 
		<br/>
	</div>
	
	<div class="texte">
		<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		<br/><br/>
		</div> 


		<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		<br/><br/>
		</div>
		
		<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers. 
		<br/><br/>
		</div>
			
		<div class="p1">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
certains types de cancers.
		<br/>
		<br/>
		<br/>
		<br/>
		</div> 
				
		<!-- Image située en bas de page -->
		<?php echo $this->Html->image('calories.jpg', array('height' => '130px', 'width' => '660px', 'alt' => 'Calories')); ?>
	</div>
</div>