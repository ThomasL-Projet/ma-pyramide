<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suivre l\'état d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien de consulter ses messages');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages','action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Connexion', 'Javascript:void(0);'); ?></li>
</nav>
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Connexion </div> 
        </div>
    </div>
    ﻿<div class="row center">
        <div class="small-6 small-centered columns">         
                <!-- Cette page est accessible depuis le bouton "me connecter" situé en haut à droite de chaque page --> 

                <div class="small-12 columns">
                    <label for="UserUsername"> Pseudo </label>
                    <input type="text" name="data[User][username]" id="UserUsername" required="required" class="center"/> 
                </div>
                <div class="small-12 columns">
                    <label for="UserPassword"> Mot de passe</label>
                    <input type="password" name="data[User][password]" id="UserPassword" required="required" class="center"/> <br>
                </div>
                <div class="small-12 columns text-center">
                    <input class="button" type="submit" value="Me connecter" />
                </div>
                
                <div class="small-12 columns center">
                    <p class="text-center"> Si vous ne possédez pas de compte, <?php echo $this->Html->link('inscrivez vous !', ['controller' => 'users', 'action' => 'add', 'full_base' => true]); ?> </p>

                </div>
        </div>
    </div>
</div>
</form>

