<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion des utilisateurs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Gérer, supprimer ou modifier le rôle des utilisateurs');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages','action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des utilisateurs', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Gestion des utilisateurs </div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 column">

            <?php
            if (isset($users) && count($users) > 1):
                foreach ($users as $user) :
                    ?>

                    <div class="row text-center" data-equalizer>
                        <div class="small-12 columns panel" data-equalizer-watch>

                            <p id="user">Pseudo : <strong><?php echo $user['User']['username']; ?></strong> | Rôle : <strong><?php echo $user['User']['role']; ?></strong> </p>

                            <!-- Bouton modifications -->
                            <?php echo $this->html->link('Modifier', '/users/edit/' . $user['User']['id'], ['escape' => false, 'class' => 'button']); ?>
                            <!-- Bouton suppression -->
                            <?php echo $this->html->link('Supprimer', '/users/delete/' . $user['User']['id'], ['escape' => false, 'class' => 'button']); ?>
                        </div>
                    </div>

                <?php endforeach; ?>

                <?php
            elseif (isset($users)) :
                foreach ($users as $user) :
                    ?>
                    <div class="span2"> Votre compte : </div> 
                    <div class="row" data-equalizer>
                        <div class="small-12 columns panel" data-equalizer-watch>
                            <p id="user">Compte : <?php echo $user['User']['username']; ?> &nbsp&nbsp&nbsp&nbsp (statut : <?php echo $user['User']['role']; ?>)</p>

                            <div class="btns-index">
                                <!-- Bouton modifications -->
                                <?php echo $this->Html->link('<div class="button" style="float:right"><i class="fi-page-edit"></i></div>', '/users/edit/' . $user['User']['id'], array('escape' => false)); ?>

                                <!-- Bouton suppression -->
                                <?php echo $this->Html->link('<div class="alert button" style="float:right"><i class="fi-page-delete"></i></div>', '/users/delete/' . $user['User']['id'], array('escape' => false)); ?>
                            </div>
                        </div>
                    </div>

                <?php endforeach; ?>
                <?php if (isset($fils)) : ?>
                    <br><br><br>
                    <div class="span2"> Vos enfants : </div> 
                    <?php foreach ($fils as $f) : ?>
                        <div class="bloc-index">
                            <p id="user">Compte enfant : <?php echo $f['username']; ?> </p>

                            <div class="btns-index">

                                <!-- Bouton information -->
                                <?php echo $this->Html->link('<div class="button">Informations</div>', '/users/information/' . $f['id'], array('escape' => false)); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
</div>
