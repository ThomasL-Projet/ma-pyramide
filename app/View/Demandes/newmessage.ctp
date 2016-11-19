<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Consulter les message d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien d\'envoyer un message à un de ses patients');
$this->end();
?>
﻿<?php
echo $this->Html->script('ckeditor/ckeditor.js');
echo $this->Form->create('Demande', array('action' => 'affichmessage'));
if (AuthComponent::user('role') == 'dieteticien') {
    echo $this->Form->input('Message.iddiet', array('type' => 'hidden', 'value' => $dietid));
    //echo $this->Form->input('Message.idcli', array('type' => 'hidden', 'value' => $idcli));
    echo $this->Form->input('Message.idexpediteur', array('type' => 'hidden', 'value' => $dietid));
    echo $this->Form->input('Message.repondu', array('type' => 'hidden', 'value' => 'non'));
}
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos messages patient', ['controller' => 'demandes', 'action' => 'messages', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Nouveau message', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Nouveau message </div> 
        </div>
    </div>
    ﻿<div class="row">
        <div class="small-12 columns">
            <?php if (empty($clients)) : ?>
                <!-- Pas de clients -->
                <p class="text-center">Vous n\'avez aucun patients pour l\'instant</p>
            <?php else : ?>

                <!-- Permet à l'utilisateur de saisir l'objet de sa réponse -->
                <label for="MessageIdcli">Sélectionner un de vos patients</label> 

                <select name="data[Message][idcli]" required="required">
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['User']['id'] . '">' . $client['User']['username'] . '</option>';
                    }
                    ?>
                </select>

                <label for="MessageObjet">Objet du message</label> 
                <input name="data[Message][objet]" maxlength="150" type="text" id="MessageObjet" required="required"/>

                <!-- L'utilisateur saisi ici le contenu de sa réponse -->
                <label for="editeur">Contenu de votre Message</label>
                <div name="editeur" id="bloc-editeur">
                    <div class="input textarea">
                        <label for="MessageMessage"></label>
                        <textarea name="data[Message][message]" cols="160" rows="5" id="MessageMessage"></textarea>
                        <?php echo $this->Ck->load('Message.message'); ?>
                    </div>
                </div>
                <br>
                <div class="text-center" id="bloc11">
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'button')); ?> 
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>