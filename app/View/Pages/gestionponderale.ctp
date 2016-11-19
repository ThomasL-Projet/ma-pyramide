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
    <li role="menuitem" class="current"><?php echo $this->Html->link('La gestion pondérale', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
      <div class="small-12 small-centered columns">
      <div class="title-area"> La gestion pondérale </div> 

            <div class="textarea">
                    <p class="text-justify">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                        sed do eiusmod tempor incididunt ut labore et dolore magna 
                        aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                        ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
                        aute irure dolor in reprehenderit in voluptate velit esse 
                        cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                        cupidatat non proident, sunt in culpa qui officia deserunt
                        mollit anim id est laborum.
                    </p>			
            </div>
      </div>
    </div>

    <div class="row" data-equalizer id="imgGrAliments">
            <!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des fruits ainsi qu'une liste non exhaustive de ces derniers -->
        <div class="large-6 small-12 columns">
            <div class="callout" data-equalizer-watch>
            <a href="../pages/gpgeneral">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('gestionponderalebalance.jpg', array('alt' => 'Homme qui se pèse sur une balance')); ?>
                <div class="image-overlay-content">
                    <h2>En général</h2>
                    <p class="description">En savoir plus</p>
                </div>
            </div>
            </a>
            </div>
        </div>
        <div class="large-6 small-12 columns">
            <div class="callout" data-equalizer-watch>
             <a href="../pages/calories">
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('gestionponderalemesure.jpg', array('alt' => 'Mesure un sandwish')); ?>
                <div class="image-overlay-content">
                    <h2>Les calories</h2>
                    <p class="description">En savoir plus</p>
                </div>
            </div>
             </a>
            </div>
        </div>
    </div>
        <br/>
 </div>