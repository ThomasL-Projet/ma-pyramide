<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supprimer un conseil');
?>
<div class="row" >
    <div class="small-12 small-centered columns">
        <?php
        if (AuthComponent::user('role') == 'administrateur') :
            echo $this->Form->create('Actualite');
            ?>
            <div id="retour"> <?php echo $this->Html->link('<< Retour', '/actualites/index'); ?> </div>
            <div class="bloc-index">
                <h3>Êtes-vous certain de vouloir supprimer l'actualité suivante : </h3>
                <h4><i><?php echo $actualite['Actualite']['title']; ?></i></h4>
                <div id="bloc2">
                    <input type="submit" class="button" value="Je confirme" />
                </div>
            </div>
            </form>

<?php endif; ?>
    </div>
</div>