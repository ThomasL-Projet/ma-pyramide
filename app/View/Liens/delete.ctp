<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer un lien ');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<div class="row presentation">
    <div class="small-12 columns">
        <?php echo $this->Form->create('Lien'); ?>
        <div class="small-12 columns text-left">
            <?php echo $this->Html->link('<< Retour', '/liens/index'); ?>
        </div>
        <div class="small-12 columns">
            <h1 class="title text-center"> Confirmer vous la suppression du lien "<?php echo $lien['Lien']['title']; ?>" ?</h1> 
        </div>
        <div class="small-12 columns text-center">
                <input type="submit" class="button" value="Je confirme" onClick="return confirmation();"/>
        </div>
        </form>
    </div>
</div>
