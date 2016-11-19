<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Groupes alimentaires');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Description des 6 différents groupes alimentaires');
$this->end();
?>﻿<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mes aliments" -->
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', array('action' => 'dietetique', 'full_base' => true));?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les groupes alimentaires', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
      <div class="small-12 large-centered columns">
      <div class="title-area"> Les groupes alimentaires </div> 

            <div class="textarea">
                    <p class="text-justify">
                        Les 6 groupes alimentaires sont choisis de manière
                        à ce que vous puissiez vous construire une alimentation saine
                        et équilibrée. Avant de manger, pensez un instant à quels groupes d’aliments
                        vous mettrez dans votre assiette, votre tasse ou votre bol. Pour faire simple, 
                        retenez que dans une journée ils sont tous indispensables. 
                        Afin que votre assiette corresponde à vos besoins, 
                        choisissez un ou plusieurs des groupes alimentaires suivants.
                    </p>			
            </div>
      </div>
    </div>   

    <div class="row" data-equalizer id="imgGrAliments">
            <!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des fruits ainsi qu'une liste non exhaustive de ces derniers -->
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
            <a href="../pages/fruits">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grfruits.jpg', array('alt' => 'Fruits')); ?>
                <div class="image-overlay-content">
                    <h2>Les fruits</h2>
                    <p class="description">Ne sous-estimez pas les fruits</p>
                </div>
            </div>
            </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
             <a href="../pages/legumes">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grlegumes.jpg', array('alt' => 'Légumes')); ?>
                <div class="image-overlay-content">
                    <h2>Les légumes</h2>
                    <p class="description">Insistez sur la variété</p>
                </div>
            </div>
             </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
            <a href="../pages/cereales">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grcereale.jpg', array('alt' => 'Céréales')); ?>
                <div class="image-overlay-content">
                    <h2>Les céréales</h2>
                    <p class="description">Habitué au pain blanc ? Découvrez les bienfaits du pain complet.</p>
                </div>
            </div>
            </a>
            </div>
        </div>
    </div>
    <br/>
    <div class="row" data-equalizer id="imgGrAliments">
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
            <a href="../pages/proteines">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grproteine.jpg', array('alt' => 'Protéines')); ?>
                <div class="image-overlay-content">
                    <h2>Les protéinés</h2>
                    <p class="description">Dans nos sociétés on mange plus de viande que nécessaire !</p>
                </div>
            </div>
            </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
             <a href="../pages/produitslaitiers">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grprodlaitier2.jpg', array('alt' => 'Produits laitiers')); ?>
                <div class="image-overlay-content">
                    <h2>Les produits laitiers</h2>
                    <p class="description">Sont vos amis pour la vie</p>
                    <p class="description">Votre apport en calcium se trouve ici</p>
                </div>
            </div>
             </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
             <a href="../pages/matieresgrasses">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('grmatieresgrasses.jpg', array('alt' => 'Matières grasses')) ?>
                <div class="image-overlay-content">
                    <h2>Les matières grasses</h2>
                    <p class="description">Pas de haro sur les matières grasses seulement sur leur trop grande quantité</p>
                </div>
            </div>
             </a>
            </div>
        </div>
    </div>
    <br/>
 </div>