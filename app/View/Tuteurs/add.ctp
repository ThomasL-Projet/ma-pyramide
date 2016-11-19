
<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon diététicien');
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon diététicien', ['action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Ajout d\'un diététicien', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Ajout d'un diététicien</div> 
        </div>
    </div> 

    <?php
    echo $this->Form->create('Demande');
    if (isset($_POST['choix'])) {
        echo $this->Form->input('Demande.dieteticienid', array('type' => 'hidden', 'value' => $_POST['choix']));
        echo $this->Form->input('Demande.clientid', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
        echo $this->Form->input('Demande.accepte', array('type' => 'hidden', 'value' => 'pas encore'));
    }
    ?>

    <div class="text-center">
        <div class="span2"> Confirmer la demande au professionnel : </div> 
        <div class="bloc-index">
            <p id="user"><?php echo $dieteticien['User']['username']; ?>  </p>
            <div id="bloc2">
                <input class="button" type="submit" value="Je confirme" />
            </div>
        </div>
    </div>

</div>