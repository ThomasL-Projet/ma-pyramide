<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Modification d\'un article' . $titre);
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des articles', ['controller' => 'articles', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification d\'un article', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area">Modification d'un article</div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php
            echo $this->html->script('ckeditor/ckeditor.js');
            echo $this->Form->create('Article');
            ?>

            <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
            <h3>Informations sur l'article</h3>
            <div class="bloc1">
                <!-- Permet à l'administrateur de préciser le titre de l'article ainsi que la catégorie à laquelle il appartient -->
                <label for="ArticleTitle">Titre de l'article</label>
                <div class="input text">
                    <input name="data[Article][title]" maxlength="150" type="text" id="ArticleTitle" required="required" value="<?php echo $titre; ?>"/>
                </div>
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
            <!-- Ceci correspond à l'éditeur de texte. L'administrateur peut ici saisir le contenu de son article -->
            <h3>Contenu de l'article</h3>
            <div id="bloc-editeur">
                <div class="input textarea">
                    <label for="ArticleContent"></label>
                    <textarea name="data[Article][content]" cols="160" rows="5" id="ArticleContent"><?php echo $contenu ?></textarea>
                    <?php echo $this->Ck->load('Article.content'); ?>
                </div>
            </div>
            <br>
            <div id="bloc11" style="margin-left:480px">
                <!-- Lorsqu'un administrateur clique sur le bouton "Enregistrer", les modifications qu'il vient d'effectuer son automatiquement reportées sur la page du 
                     site concernée -->
                <input Enregistrer="Enregistrer" type="submit" value="Enregistrer" class="button" />

                <?php echo $this->Html->link('<input class="button" type="button" value="Annuler">', '/articles/', array('escape' => false)); ?>
            </div>

            <script type="text/javascript">
                function postData() {
                    var formulaire = document.forms['ArticleEditForm'];

                    formulaire.elements["ArticleTitle"].value = "<?php echo $titre ?>";
                    formulaire.elements["ArticleCategoryId"].value = <?php echo $idCategorie ?>;
                }
            </script>
        </div>
    </div>
</div>
