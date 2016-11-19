<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - FAQ');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Foire aux questions');
$this->end();
?>﻿<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mes aliments" -->
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('FAQ', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> FAQ (Foire aux questions) </div> 

            <div class="textarea">
                <p class="text-center">
                   En cours d'implémentation
                </p>			
            </div>
        </div>
    </div>
</div>