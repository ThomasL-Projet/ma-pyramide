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
            <div class="title-area"> Mes messages </div> 
        </div>
    </div> 

    <div class="row">
        <div class="small-12 columns text-center">
            <!-- Bouton nouveau message -->
            <?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/tuteurs/newmessage/', array('escape' => false)); ?>
            <?php if (empty($messagesnouv) AND empty($messagesanc)) : ?>
                <h1 align="center">Vous n'avez pas de messages de votre diététicien</h1>
            <?php else : ?>
                <?php if (!empty($messagesnouv)) : ?>
                   
                    <!-- L'utilisateur a des nouveaux messages -->
                    <div class="span2">Nouveaux messages de votre diététicien <?php echo $diet['User']['username']; ?> :</div>
                    <?php foreach ($messagesnouv as $mess) : ?>
                        <div class="bloc-index">
                            <?php
                            /* Mise sous forme francaise de la date */
                            $temp = explode("-", $mess['Message']['created']);
                            $temp2 = explode(" ", $temp[2]);
                            $heure = $temp2[1];
                            $heure2 = explode(" ", $temp[2]);
                            $date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
                            ?>
                            <p id="user"><strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
                            <div class="btns-index">
                                <!-- Bouton voir message -->
                                <?php echo $this->Html->link('<div class="button">Afficher</div>', '/tuteurs/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="span2">Vous n'avez pas de nouveaux messages</div>
                <?php endif; ?>
                    
                <?php if (!empty($messagesanc)) : ?>
                    <hr/>
                    <!-- Le client a des messages auquels il a répondu -->
                    <div class="span2">Anciens messages de votre diététicien <?php echo $diet['User']['username']; ?> :</div>
                    <?php foreach ($messagesanc as $mess) : ?>
                        <div class="bloc-index">
                            <?php
                            /* Mise sous forme francaise de la date */
                            $temp = explode("-", $mess['Message']['created']);
                            $temp2 = explode(" ", $temp[2]);
                            $heure = $temp2[1];
                            $heure2 = explode(" ", $temp[2]);
                            $date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
                            ?>
                            <p id="user"><strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
                            <div class="btns-index">
                                <!-- Bouton voir message -->
                                <?php echo $this->Html->link('<div class="button">Message</div>', '/tuteurs/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </div>
</div>