<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Modification des photos du slider');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des photos', ['controller' => 'pages', 'action' => 'choixphoto', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification des photos du slider', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification des photos du slider </div>      
        </div>
    </div>

    <div class="row">
        <div class="small-12 columns">
            <?php
            echo $this->html->script('ckeditor/ckeditor.js');
            ?> 
            <div class="row">
                <div class="small-12 columns">
                    <?php echo $this->Form->create('Photo', array('type' => 'file')); ?>
                    <?php echo '<br/>' ?>
                    <?php echo $this->Form->input('id', array('label' => 'Selectionner le numéro de l\'image à modifier', 'options' => array(1, 2, 3, 4), 'id' => 'choixId', 'onChange' => 'Choix(this.value)', 'selected' => '0')); ?>
                    <?php echo '<br/>' ?>
                    <div class="text-center">
                        <?php echo $this->Html->image('aide_photos.jpg', array('class' => 'center')); ?>
                    </div>

                    <?php echo $this->Form->input('titre', array('label' => "Titre ", 'id' => 'titre', 'value' => $titre1)); ?>
                    <?php echo '<br/>' ?>
                    <div id="bloc-editeur">
                        <div class="input textarea">
                            <label for="PhotoDescription">Description de l'image</label>
                            <textarea name="data[Photo][description]" cols="160" rows="5" id="PhotoDescription"><?php echo $description1 ?></textarea>
                            <?php echo $this->Ck->load('Photo.description'); ?>
                        </div>
                    </div>
                    <?php echo '<br/><br/>' ?>
                    <?php echo $this->Form->input('photo_file', array('label' => 'Votre image au format JPEG ou PNG', 'type' => 'file')); ?>
                    <?php echo '<br/><br/>' ?><br />
                    <div class="text-center">
                        <button class="button" type="submit">Éditer</button>
                    </div>
                </div>
            </div>
            <br/>
            <script type="text/javascript">

                function Choix(formulaire) {

                    var i = document.getElementById('choixId').selectedIndex + 1;


                    switch (i) {
                        case 1 :
                            document.getElementById("titre").value = '<?php echo $titre1; ?>'
                            document.getElementById("description").value = '<?php echo $description1; ?>'
                            break;
                        case 2 :
                            document.getElementById("titre").value = '<?php echo $titre2; ?>'
                            document.getElementById("description").value = '<?php echo $description2; ?>'
                            break;
                        case 3 :
                            document.getElementById("titre").value = '<?php echo $titre3; ?>'
                            document.getElementById("description").value = '<?php echo $description3; ?>'
                            break;
                        case 4 :
                            document.getElementById("titre").value = '<?php echo $titre4; ?>'
                            document.getElementById("description").value = '<?php echo $description4; ?>'
                            break;

                    }


                }

                // Fin -->
            </script>

        </div>
    </div>
</div>