<?php
// titre de la page
if (AuthComponent::user('role') == 'administrateur') {
    $this->assign('title', 'Ma Pyramide Santé - Gestion des actualités');
} else {
    $this->assign('title', 'Ma Pyramide Santé - Les actualités');
}
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Retrouvez un ensemble de conseils rapides et pratiques proposés par nos diététiciens.');
$this->end();
?>

<?php if (AuthComponent::user('role') == 'administrateur') : ?>
    <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
        <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
        <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
        <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des actualités', 'Javascript:void(0);'); ?></li>
    </nav>
    <div id="presentation">
        <div class="row">
            <div class="small-12 small-centered columns">
                <div class="title-area"> Gestion des actualités </div>      
            </div>
        </div>
    <?php else: ?>
        <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
            <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
            <li role="menuitem"><?php echo $this->Html->link('La gazette', ['controller' => 'pages', 'action' => 'gazette', 'full_base' => true]); ?></li>
            <li role="menuitem" class="current"><?php echo $this->Html->link('Les actualités', 'Javascript:void(0);'); ?></li>
        </nav>
        <div id="presentation">
            <div class="row">
                <div class="small-12 small-centered columns">
                    <div class="title-area"> Les actualités </div>      
                </div>
            </div>
        <?php endif; ?>


<div class="row">
    <div class="small-12 small-centered columns">
        <?php if (AuthComponent::user('role') == 'administrateur') : ?>
            <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
            <!-- Bouton ajout : pour ajouter un nouvel artcile cliquez sur la croix verte-->
            <?php echo $this->Html->link('<div id="btn-ajouter">Créer une actualité</div>', '/actualites/add/', array('escape' => false, 'class' => 'button')); ?>
            <br />
        <?php endif; ?>


        <?php foreach ($actualites as $actualite) : ?>

            <?php
            // indique à php que l'on travaille avec la version française (date)
            // récupération de la date puis changement du format
            $dateactualite = strtotime($actualite['Actualite']['created']);
            $dateactuBien = date('j/m/Y', $dateactualite);
            ?>

            <div class="blog-post">
                <h3><?php echo $actualite['Actualite']['title']; ?> <small><?php echo $dateactuBien; ?></small></h3>


                <?php if (AuthComponent::user('role') == 'administrateur') : ?>
                    <div class="btns-index">
                        <!-- Bouton modifications : pour effectuer des modifications concernant un actualite, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
                                 à l'actualite qu'il souhaite modifier -->
                        <?php echo $this->Html->link('<div class="button">Modifier</div>', '/actualites/edit/' . $actualite['Actualite']['id'], array('escape' => false)); ?>

                        <!-- Bouton suppression : pour supprimer un actualite, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
                                 à l'actualite qu'il souhaite modifier -->
                        <?php echo $this->Html->link('<div class="button">Supprimer</div>', '/actualites/delete/' . $actualite['Actualite']['id'], array('escape' => false)); ?>

                    </div>
                <?php endif; ?>


                <p> <?php echo $this->Text->truncate(strip_tags(str_replace("&nbsp;", "", $actualite['Actualite']['content'])), 300, array('ellipsis' => '...', 'html' => true)); ?> </p>
                <div class="callout">
                    <?php echo $this->Html->link('<div class="button small">' . "Lire l'actualité"
                            . '</div>', '/actualites/actualite/' . $actualite['Actualite']['id'], array('escape' => false));
                    ?>
                </div>
            </div>

<?php endforeach; ?>
    </div>
</div>
