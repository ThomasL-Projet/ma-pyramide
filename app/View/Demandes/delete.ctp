<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer une demande');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos demandes patients', ['controller' => 'demandes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression suivi patient', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Suppression du suivi patient </div> 
        </div>
    </div>
    <div class="row">
        <div class="small-12 small-centered columns text-center">
            ﻿<?php
            echo $this->Form->create('Demande');
            ?>
            <div class = "span2"> Annuler le suivi avec le patient : </div>
            <div class = "bloc-index">
                <p id = "user"><?php echo $users['User']['username'];
            ?>  </p>
                <div id="bloc2">
                    <input class="button" type="submit" value="Je confirme" />
                </div>
            </div>
            </form>
        </div>
    </div>
</div>