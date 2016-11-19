<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon diététicien');
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon diététicien', ['action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes messages', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Annuler le suivi du diététicien </div> 
        </div>
    </div> 
    <?php echo $this->Form->create('Demande'); ?>

    <div class="small-12 columns text-center">
        <div class = "span2"> Confirmer l'annulation du suivi de votre diététicien : </div>
        <div class = "bloc-index">
            <p id = "user"><?php echo $diet['User']['username']; ?>  </p>
            <div id="bloc2">
                <input class="button" type="submit" value="Je confirme" />
            </div>
        </div>
    </div>
</form>
</div>

