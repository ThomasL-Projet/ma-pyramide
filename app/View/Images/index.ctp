<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Modification des photos de la galerie');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des photos', ['controller' => 'pages', 'action' => 'choixphoto', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification des photos de la galerie', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification des photos de la galerie </div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php if (AuthComponent::user('role') == 'administrateur') : ?>

                <?php echo $this->Html->script('zoombox/zoombox.js'); ?>
                <?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
                <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
                <br />

                <!-- Bouton ajout : pour ajouter un nouvel artcile cliquez sur la croix verte-->
                <?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/images/add/', array('escape' => false)); ?>

                <?php foreach ($images as $image) : ?>
                    <div class="bloc-index">
                        <p id="actualite">
                            <?php
                            if ($image['Image']['url'] == '') {
                                echo '<div class="titreActualite">' . $image['Image']['titre'] . '</div>';
                            } else {
                                echo $this->Html->link('<div class="titreActualite">' . $image['Image']['titre'] . '</div>', '../app/webroot/img/urls/' . $image['Image']['url'], array('class' => 'zoombox', 'escape' => false, 'alt' => $image['Image']['titre']));
                            }
                            ?>
                        </p>

                        <div class="btns-index">
                            <!-- Bouton modifications : pour effectuer des modifications concernant un actualite, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
                                     à l'actualite qu'il souhaite modifier -->
                            <?php echo $this->Html->link('<div class="btn-modifier">Modifier</div>', '/images/edit/' . $image['Image']['id'], array('escape' => false)); ?>

                            <!-- Bouton suppression : pour supprimer un actualite, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
                                     à l'actualite qu'il souhaite modifier -->
                            <?php echo $this->Html->link('<div class="btn-supprimer">Supprimer</div>', '/images/delete/' . $image['Image']['id'], array('escape' => false)); ?>

                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            <?php endif; ?>

            <script type="text/javascript">
                jQuery(function ($) {
                    $('a.zoombox').zoombox();

                    /**
                     * Or You can also use specific options
                     $('a.zoombox').zoombox({
                     theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
                     opacity     : 0.8,              // Black overlay opacity
                     duration    : 800,              // Animation duration
                     animation   : true,             // Do we have to animate the box ?
                     width       : 500,              // Default width
                     height      : 500,              // Default height
                     gallery     : true,             // Allow gallery thumb view
                     autoplay : false                // Autoplay for video
                     });
                     */
                });
            </script>
        </div>
    </div>
</div>