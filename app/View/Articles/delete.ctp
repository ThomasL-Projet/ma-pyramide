<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suppression de l\'article ' . $article['Article']['title']);
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des articles', ['controller' => 'articles', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'un article', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area">Suppression d'un article</div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php echo $this->Form->create('Article'); ?>
            <div class="bloc-index">
                <h3>Êtes-vous certain de vouloir supprimer l'article suivant </h3>
                <h4>
                    <i>
                        <?php
                        echo $this->Html->link($article['Article']['title'], '/articles/article/' . $article['Article']['id'], array('escape' => false));
                        ?>
                    </i>
                </h4>
                <div class="text-center">
                    <input type="submit" class="button" value="Je confirme"/>
                    <?php echo $this->Html->link('Annuler', ['action' => 'index', 'full_base' => true], ["class" => "button", 'escape' => false]); ?>
                </div>
            </div>
            </form>

        </div>
    </div>