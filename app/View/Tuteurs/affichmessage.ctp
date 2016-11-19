 <?php
echo $this->Html->script('ckeditor/ckeditor.js');
echo $this->Form->create('Tuteurs', array('action' => 'affichmessage'));
echo $this->Form->input('idmess', array('type' => 'hidden'));
if (isset($diet) AND isset($idmessage)) {
    echo $this->Form->input('Message.iddiet', array('type' => 'hidden', 'value' => $diet['User']['id']));
    echo $this->Form->input('Message.idcli', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
    echo $this->Form->input('Message.idexpediteur', array('type' => 'hidden', 'value' => AuthComponent::user('id')));
    echo $this->Form->input('Message.repondu', array('type' => 'hidden', 'value' => 'non'));
    echo $this->Form->input('idmessage', array('type' => 'hidden', 'value' => $idmessage));
}
?>
<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon diététicien');
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon diététicien', ['action' => 'index', 'full_base' => true]); ?></li>   
    <li role="menuitem"><?php echo $this->Html->link('Mon messages', ['action' => 'messages', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Contenu du message', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Contenu du message </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns text-center">
            <br>
            <p><?php echo 'Message de votre tuteur : <strong>' . $diet['User']['username'] . '</strong>'; ?>

                <?php
                /* Mise sous forme francaise de la date */
                $temp = explode("-", $created);
                $temp2 = explode(" ", $temp[2]);
                $heure = $temp2[1];
                $heure2 = explode(" ", $temp[2]);
                $date = $heure2[0] . '-' . $temp[1] . '-' . $temp[0];
                ?>
                <?php echo ',envoyé le : <strong>' . $date . ' à ' . $heure . '</strong>'; ?></p>
            <hr/>
            <h3><?php echo 'Objet : ' . $objet; ?></h3>
            <br>
            <h4><?php echo $message ?> </h4>
            <hr/>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="small-12 columns">
            <!-- Si le message n'a pas été répondu l'éditeur ckeditor est alors présent pour permettre à l'utilisateur de répondre à son client -->
            <?php if ($repondu == 'non') : ?>
                <div class="row">
                    <div class="small-12 small-centered columns">
                        <div class="title-area">Votre réponse </div>
                    </div>
                </div>
                <!-- Permet à l'utilisateur de saisir l'objet de sa réponse -->
                <div class="small-8 small-centered columns">
                    <label for="messageObjet">Objet :</label>
                    <input name="data[Message][objet]" maxlength="150" type="text" id="MessageObjet" required="required"/>
                </div>
                <!-- L'utilisateur saisi ici le contenu de sa réponse -->
                <label for="ck">Contenu de votre réponse</label>
                <div name="ck">
                    <div class="input textarea">
                        <label for="MessageMessage"></label>
                        <textarea name="data[Message][message]" cols="160" rows="5" id="MessageMessage"></textarea>
                        <?php echo $this->Ck->load('Message.message'); ?>
                    </div>
                </div>
                <div id="bloc11" class="text-center">
                    <input type="hidden" name="idmessage" id="hiddenField" value="<?php echo $idmessage; ?>" />
                    <br>
                    <?php echo $this->Form->end(array('label' => 'Envoyer', 'class' => 'button')); ?>
                </div>
            <?php else : ?>
                <p align="center"><?php echo $this->Html->link('<input class="button text-center" type="button" name="retour" value="Retour" >', '/tuteurs/messages', array('escape' => false)); ?></p>
            <?php endif; ?>


        </div>
    </div>
</div>
