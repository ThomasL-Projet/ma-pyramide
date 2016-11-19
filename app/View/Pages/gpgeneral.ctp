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
    <li role="menuitem" class="current"><?php echo $this->Html->link('En général', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> En général </div> 

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

    <div class="row">
        <div class="small-12 colomns">
            <h3>Voir aussi</h3>
            <ul class="button-group even-3">
                <?php
                foreach ($Pond as $uneGestionPonderale) {
                    echo '<li >' . $this->Html->link($uneGestionPonderale['titreonglet'], '/statiques/pages/'
                            . $uneGestionPonderale['id'], array('escape' => false, 'class' => 'button')) . '</li>';
                }
                ?>
            </ul>
        </div>
    </div>    
</div> 

