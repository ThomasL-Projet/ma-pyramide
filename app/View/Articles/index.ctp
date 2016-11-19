<?php
// titre de la page
if (AuthComponent::user('role') == 'administrateur') {
    $this->assign('title', 'Ma Pyramide Santé - Gestion des articles');
} else {
    $this->assign('title', 'Ma Pyramide Santé - Les articles');
}
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Vous pouvez consulter et prendre connaissance d\informations diverses via les articles crées par nos diététicien');
$this->end();
?>

<?php if (AuthComponent::user('role') == 'administrateur') : ?>
    <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
        <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
        <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
        <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des articles', 'Javascript:void(0);'); ?></li>
    </nav>
    <div id="presentation">
        <div class="row">
            <div class="small-12 small-centered columns">
                <div class="title-area"> Gestion des articles </div>      
            </div>
        </div>
    <?php else: ?>
        <nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
            <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
            <li role="menuitem"><?php echo $this->Html->link('La gazette', ['controller' => 'pages', 'action' => 'gazette', 'full_base' => true]); ?></li>
            <li role="menuitem" class="current"><?php echo $this->Html->link('Les articles', 'Javascript:void(0);'); ?></li>
        </nav>
        <div id="presentation">
            <div class="row">
                <div class="small-12 small-centered columns">
                    <div class="title-area"> Les articles </div>      
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="small-12 small-centered columns">
                <?php if (AuthComponent::user('role') == 'administrateur') : ?>
                    <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
                    <br />

                    <!-- Bouton ajout : pour ajouter un nouvel artcile cliquez sur la croix verte-->
                    <?php echo $this->Html->link('<div class="button" id="btn-ajouter">Créer un article</div>', '/articles/add/', array('escape' => false)); ?>
                    <hr/>
                <?php endif; ?>


                <?php foreach ($articles as $article) : ?>

                    <?php
                    // indique à php que l'on travaille avec la version française (date)
                    // récupération de la date puis changement du format
                    $datearticle = strtotime($article['Article']['created']);
                    $datearticleBien = date('j/m/Y', $datearticle);
                    ?>

                    <div class="bloc-index">
                        <h3><?php echo $article['Article']['title']; ?> <small><?php echo $datearticleBien; ?></small>


                            </p>
                            <?php if (AuthComponent::user('role') == 'administrateur') : ?>
                                <div class="btns-index">
                                    <!-- Bouton modifications : pour effectuer des modifications concernant un article, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
                                                 à l'article qu'il souhaite modifier -->
                                    <?php echo $this->Html->link('<div class="button" class="btn-modifier">Modifier</div>', '/articles/edit/' . $article['Article']['id'], array('escape' => false)); ?>

                                    <!-- Bouton suppression : pour supprimer un article, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
                                             à l'article qu'il souhaite modifier -->
                                    <?php echo $this->Html->link('<div class="button" class="btn-supprimer">Supprimer</div>', '/articles/delete/' . $article['Article']['id'], array('escape' => false)); ?>

                                </div>
                            <?php endif; ?>

                            <p> <?php echo $this->Text->truncate(strip_tags(str_replace("&nbsp;", "", $article['Article']['content'])), 800, array('ellipsis' => '...', 'html' => true)); ?> </p>
                            <div class="row">
                                <div class="small-12 columns">
                                    <?php
                                    echo $this->Html->link('<div class="button">' . "Lire l'article"
                                            . '</div>', '/articles/article/' . $article['Article']['id'], array('escape' => false));
                                    ?>
                                </div>
                            </div>
                            <hr/>
                    </div>
                    <!-- Catégorie : <?php echo $article['Category']['name']; ?> -->
                <?php endforeach; ?>
            </div>
        </div>
    </div>