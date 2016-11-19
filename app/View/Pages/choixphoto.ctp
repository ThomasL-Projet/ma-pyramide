<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion des photos');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des photos', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Gestion des photos </div>      
        </div>
    </div>
    <?php if (AuthComponent::user('role') == 'administrateur') : ?>

    <div class="row">
        <div class="small-12 columns">
            <h3> Choisissez quelle(s) photo(s) modifier </h3>
            <ul class="button-group even-2">
                <?php
                echo $this->html->link('Gérer les photos du slider', '/photos/index/', ['escape' => false, 'class' => 'button']);
                echo $this->html->link('Gérer les photos des aliments', '/aliments/edit/', ['escape' => false, 'class' => 'button']);
                echo $this->html->link('Gérer les photos de la galerie', '/images/', ['escape' => false, 'class' => 'button']);
                echo $this->html->link('Gérer les vidéos de la galerie', '/videos/', ['escape' => false, 'class' => 'button']);
                ?>
            </ul>
        </div>
    </div>
    <?php else: ?>
    <div class="row">
        <div class="small-12 columns">
            <h3> Vous n'avez pas accès à cette page </h3>
        </div>
    </div>
    <?php endif; ?>
</div>

