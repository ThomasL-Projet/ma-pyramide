<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Modifier un lien');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer les liens, modifier un lien -->
<?php
echo $this->html->script('ckeditor/ckeditor.js');
echo $this->Form->create('Lien');
?>
<div class="row presentation">
    <div class="large-12 columns text-left">
        <?php echo $this->Html->link('<< Retour', '/liens'); ?>
    </div>
    <div class="large-12 columns">
        <h1 class="title text-center">Modifier un lien</h1>
    </div>

    <div class="row">
        <div class="large-6 columns">
            <!-- Permet à l'utilisateur de saisir le titre du lien -->
            <label for="LienTitle">Titre du lien</label>
            <div class="input text">
                <input name="data[Lien][title]" maxlength="150" type="text" id="LienTitle" class="input-medium" value="<?php echo $titre; ?>" required="required"/>
            </div>
        </div>
        <div class="large-6 columns">
            <!-- Permet à l'utilisateur de saisir à quel endroit il veut voir son lien -->
            <div class="select">
                <label for="LienCategory">Catégorie</label>
                <select name="data[Lien][categorie]" id="LienCategoryId">
                    <option value=0>Grand Public</option>
                    <option value=1>Professionnelle</option>
                    <option value=2>Professionnelle Privée</option>
                </select>
            </div>
        </div>
    </div>

    <!-- L'utilisateur saisi ici le contenu du lien -->

    <div class="large-12 columns">
        <div class="textarea">
            <label for="LienContent">Contenu du lien</label>
            <textarea name="data[Lien][content]" id="LienContent"><?php echo $contenu ?></textarea>
            <?php echo $this->Ck->load('Lien.content'); ?>
        </div>
    </div>
    <br/>
    <div class="row">
        <div class="large-12 columns text-center">
            <input type="submit" class="button" name="enregistrer" value="Enregistrer" id='e'>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    function postData() {
        var formulaire = document.forms['LienEditForm'];

        formulaire.elements["LienTitle"].value = "<?php echo $titre ?>";
        formulaire.elements["LienCategoryId"].value = <?php echo $idCategorie ?>;
    }
</script>
