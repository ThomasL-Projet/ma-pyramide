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
    <li role="menuitem" class="current"><?php echo $this->Html->link('Vos demandes clients', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Vos demandes patients </div> 
        </div>
    </div>
    ﻿<div class="row">
        <div class="small-12 columns">

            <br> <br>
            <h3 class="text-center">Vos demandes</h3>
            <?php if (empty($users)) : ?>   
                <hr>
                <p class="text-center">Vous n'avez pas de nouvelles demandes</p>
            <?php else : ?>
                <?php foreach ($users as $user) : ?>
                    <hr>
                    <div class="small-12 columns">
                        <div class="small-5 columns text-center">
                            <br>
                            <p id="user">Demande de :  <?php echo $user['User']['username']; ?></p>
                        </div>
                        <div class="small-7 columns text-center">
                            <!-- Bouton Répondre -->
                            <?php echo $this->Html->link('<div class="btn-rep button">Répondre</div>', '/demandes/repondre/' . $user['User']['id'], array('escape' => false)); ?>

                            <!-- Bouton information -->
                            <?php echo $this->Html->link('<div class="btn-infos button">Informations</div>', '/demandes/information/' . $user['User']['id'], array('escape' => false)); ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <!-- Partie clients -->

            <br> <br>
            <h3 class="text-center">Vos patients</h3>   
            <?php if (empty($clients)) : ?>
                <hr>
                <p class="text-center">Vous n'avez pas de patients</p>
            <?php else : ?>
                <?php foreach ($clients as $client) : ?>
                    <hr>
                    <div class="small-12 columns">
                        <div class="small-5 columns text-center">
                            <br>
                            <p id="user"><?php echo $client['User']['username']; ?></p>
                        </div>
                        <div class="small-7 columns text-center">
                            <!-- Bouton Répondre -->
                            <?php echo $this->Html->link('<div class="btn-supprimer-demande button">Supprimer</div>', '/demandes/delete/' . $client['User']['id'], array('escape' => false)); ?>

                            <!-- Bouton information -->
                            <?php echo $this->Html->link('<div class="btn-infos button">Informations</div>', '/demandes/information/' . $client['User']['id'], array('escape' => false)); ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>