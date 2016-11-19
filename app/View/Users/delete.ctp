<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion des utilisateurs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Gérer, supprimer ou modifier le rôle des utilisateurs');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des utilisateurs', ['controller' => 'users', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Suppression d\'un utilisateur', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Suppression d'un utilisateur </div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php echo $this->Form->create('User'); ?>
            <div class="bloc-index" style="margin-top:10px">
                <div class="text-center" id="bloc2">
                    <?php echo $this->html->link('Annuler', ['action' => 'index', 'full_base' => true], ['escape' => false, 'class' => 'button']); ?>    
                    <button class="button" type="submit" onClick="return confirmation();">Je confirme</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
    <script type="text/javascript">
        function confirmation() {
            return(confirm("Êtes vous sûrs de vouloir supprimer votre compte ? (Cette action est irréversible)"));
        }
    </script>