<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Modifier un objectif');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes 5 objectifs', ['controller' => 'mesCinqObjectifs', 'action' => 'index', 'full_base' => true]); ?></li>    
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification d\'un objectif' , 'Javascript:void(0);'); ?></li>
</nav>

<?php
if ($affichage) :
    echo $this->Form->create('Cinqobjectif');
    ?>
    <div id="presentation">
        <div class="row">
            <div class="small-12 small-centered columns">
                <div class="title-area"> Modification d'un objectif </div> 
            </div> 
            <div class="row">  
                <div class="small-12 columns">
                    <textarea rows="6" cols="100" name="com" required="required" title="La description doit faire entre 1 et 300 caractètres" maxlength="300"><?php echo str_replace("<br />", "", $objectif['description']); ?></textarea>    
                </div>
                <div class="small-12 columns text-center">
                    <input type="submit" class="button " value="Enregistrer les modifications" />
                </div>
            </div>
        </div>
    </div>
    </form>
<?php endif; ?>