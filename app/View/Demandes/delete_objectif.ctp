<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer l\'objectif d\'une demande');
?>
<div class="row">
    <div class="small-12 columns">

        ﻿<?php echo $this->Form->create('Constsuivialimentaire');
?>
        <div id="presentation">
            <?php if (AuthComponent::user('role') != 'dieteticien' OR ! $affichage) : ?>
                <!-- Accès seulement aux diététiciens et interdit aux modifications de l'url -->
                <?php echo $this->Html->link('<< Retour', '/pages/home/'); ?>
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            <?php else : ?>
                <?php echo $this->Html->link('<< Retour', '/demandes/suivis/'); ?>
                <div class="span2"> Confirmer la suppression de l'objectif : </div> 
                <div id="bloc-editeur">
                    <p><?php
                        if (!empty($objectif['proteines'])) {
                            echo 'Protéines : ' . $objectif['proteines'] . ' g ';
                        } elseif (!empty($objectif['lipides'])) {
                            echo 'Lipides : ' . $objectif['lipides'] . ' g ';
                        } elseif (!empty($objectif['fibres'])) {
                            echo 'Fibres : ' . $objectif['fibres'] . ' g ';
                        } elseif (!empty($objectif['sel'])) {
                            echo 'Sel : ' . $objectif['sel'] . ' g ';
                        } else
                            
                            ?>  </p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Je confirme" />
                    </div>
                </div>
<?php endif; ?>
            </form>
        </div>
    </div>
</div>