<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Ajouter un article');
?>

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des articles', ['controller' => 'articles', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Ajout d\'un article', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area">Ajout d'un article</div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php
            echo $this->html->script('ckeditor/ckeditor.js');
            echo $this->Form->create('Article', array('action' => 'add'));
            echo $this->Form->input('id', array('type' => 'hidden'));
            ?>
            <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
            <h3>Informations sur l'article</h3>
            <div class="bloc1" >
                <!-- Permet à l'utilisateur de saisir le titre de l'article -->
                <label for="ArticleTitle">Titre de l'article</label>
                <div class="input text">
                    <input name="data[Article][title]" maxlength="150" type="text" id="ArticleTitle" required="required"/>
                </div>
                <!-- Permet à l'utilisateur de choisir dans quelle catégorie il souhaite ajouter l'article -->
                <div class="input select">
                    <label for="ArticleCategoryId">Catégorie</label>
                    <select name="data[Article][category_id]" id="ArticleCategoryId">
                        <?php
                        foreach ($categories as $categorie) {
                            echo "<option value=" . $categorie['Category']['id'] . ">" . $categorie['Category']['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- L'utilisateur saisi ici le contenu de l'article -->
            <div class="span2">Contenu de l'article</div>
            <div id="bloc-editeur">
                <div class="input textarea">
                    <label for="ArticleContent"></label>
                    <textarea name="data[Article][content]" cols="160" rows="5" id="ArticleContent"></textarea>
                    <?php echo $this->Ck->load('Article.content'); ?>
                </div>
            </div>
            <br>
            <div id="bloc11" >
                <div class="text-center">
                    <input Enregistrer="Enregistrer" type="submit" value="Enregistrer" class="button" />
                    <?php echo $this->Html->link('Annuler',['action' => 'index', 'full_base' => true],["class" => "button", 'escape' => false]); ?>
                </div>
            </div>
        </div>
    </div>
</div>