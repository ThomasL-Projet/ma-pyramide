<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Consulter les message d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien de consulter ses messages');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Vos messages patient', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Vos messages patient </div> 
        </div>
    </div>
    ﻿<div class="row">
        <div class="small-12 columns">
            <div class="text-center">
            <!-- Bouton nouveau message -->
            <?php echo $this->Html->link('Nouveau message', ['controller' => 'demandes', 'action' => 'newmessage', 'full_base' => true], ['escape' => false, 'class' => 'button']); ?>
            </div>
            <?php if (empty($messagesnouv) AND empty($messagesanc)) : ?>
                <p class=text-center">Vous n'avez pas de messages</p>
            <?php else : ?>
                <?php if (!empty($messagesnouv)) : ?>               
                    <!-- Le diététicien a des nouveaux messages -->
                    <h3>Vos nouveaux messages</h3>
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
                            <p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
                            <div class="btns-index">
                                <!-- Bouton voir message -->
                                <?php echo $this->Html->link('<div class="btn-rep-solo button">Message</div>', '/demandes/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p class=text-center">Vous n'avez pas de nouveaux messages</p> 
                <?php endif; ?>
                <?php if (!empty($messagesanc)) : ?>
                    <!-- Le diététicien a des messages auquels il a répondu -->
                    <div class="span2">Anciens messages :</div>
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
                            <p id="user"><strong>Message de :</strong> <?php echo $mess['User']['username']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Objet :</strong> <?php echo $mess['Message']['objet']; ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>envoyé le :</strong> <?php echo $date . ' à ' . $heure; ?></p>
                            <div class="btns-index">
                                <!-- Bouton voir message -->
                                <?php echo $this->Html->link('<div class="btn-rep-solo button">Message</div>', '/demandes/affichmessage/' . $mess['Message']['idmess'], array('escape' => false)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>