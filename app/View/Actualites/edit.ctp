<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Éditer un conseil');
?>
<?php
if (AuthComponent::user('role') == 'administrateur') :
    if ($id != null) :
        ?>
        <?php
        echo $this->html->script('ckeditor/ckeditor.js');
        echo $this->Form->create('Actualite');
        ?>
        <div class="row">
            <div class="small-12 small-centered columns">
                <?php echo $this->Html->link('<< Retour', '/actualites/'); ?>
                

                <!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
                <h2>Informations sur l'actualité</h2>
                <div class="bloc1">
                    <!-- Permet à l'administrateur de préciser le titre de l'actualite ainsi que la catégorie à laquelle il appartient -->
                    <h3>Titre de l'actualité</h3>
                    <div class="input text">
                        <input name="data[Actualite][title]" maxlength="150" value="<?php echo $titre; ?>" type="text" id="ActualiteTitle" required="required"/>
                    </div>

                </div>
                <!-- Ceci correspond à l'éditeur de texte. L'administrateur peut ici saisir le contenu de son actualite -->
                <h3>Contenu de l'actualité</h3>
                <div id="bloc-editeur">
                    <div class="input textarea">
                        <label for="ActualiteContent"></label>
                        <textarea name="data[Actualite][content]" cols="160" rows="5" id="ActualiteContent"><?php echo $contenu ?></textarea>
                        <?php echo $this->Ck->load('Actualite.content'); ?>
                    </div>
                </div>
                <div id="bloc11">
                    <input Enregistrer="Enregistrer" type="submit" value="Enregistrer" class="button" />
                    <?php echo $this->Html->link('<input class="button" type="button" value="Annuler">', '/actualites/', array('escape' => false)); ?>
                </div>
            </div></div>
        <script type="text/javascript">
            function postData() {
                var formulaire = document.forms['ActualiteEditForm'];

                formulaire.elements["ActualiteTitle"].value = "<?php echo $titre ?>";
            }
        </script>

    <?php endif; ?>
<?php endif; ?>