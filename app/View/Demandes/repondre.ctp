<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Retrouver vos demandes');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien de consulter ses demandes');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos demandes client', ['controller' => 'demandes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Réponse demande', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Répondre à la demande de <?php echo $demandeur['User']['username']; ?> </div> 
        </div>
    </div>
    ﻿<div class="row">
        <div class="small-12 columns text-center">
            <?php echo $this->Form->create('Demande'); ?>
                <input class="button" type ="submit" value = "Oui" name="oui" />
                <input class="button" type ="submit" value = "Non" name="non" />
                <input class="button" type ="submit" value = "Retour" name="retour" />
            </div>
        </div>
    </div>
</div>
