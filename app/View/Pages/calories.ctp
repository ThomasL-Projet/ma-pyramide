<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion pondérale');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mes aliments" -->
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', ['action' => 'dietetique', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La gestion pondérale', ['action' => 'gestionponderale', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les calories', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les calories </div> 

            <div class="textarea">
                <p class="text-justify">
                    En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                    poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                    Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                    maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                    certains types de cancers. 
                </p>			
            </div>
        </div>
    </div>
</div>
