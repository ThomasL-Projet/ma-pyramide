<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mes 5 objectifs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes 5 objectifs', 'Javascript:void(0);'); ?></li>
</nav>

<?php
echo $this->Form->create('Cinqobjectifs', array('id' => 'formObj'));
?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mes 5 objectifs </div> 
            <div class="textarea">
                <p class="text-justify">
                    Fixez-vous un ensemble d’objectifs que vous voulez atteindre.
                    Vous pouvez choisir et suivre 5 objectifs.
                    Votre <strong>Coach virtuel</strong> vous apportera conseils 
                    et soutient alors que vous essayez d’atteindre vos objectifs.
                </p>			
            </div>
        </div>
    </div>
    <div class="row">

        <?php if (empty($user['Cinqobjectifs'])) : ?>
            <!-- Utilisateur n'a pas d'objectifs -->
            <div class="small-12 columns">
                <h3 class="subtitle text-center">Fixez-vous un objectif</h3> 
                <p>Vous ne vous êtes pas encore fixé d'objectifs</p>
            </div>
            <div class="small-12 columns objectifInvalide"></div>
            <div class="small-12 columns">
                <label>Description de votre objectif</label>
                <textarea rows="6" cols="100" id="objectif" name="com" required="required" placeholder="Saisissez un objectif que vous voulez accomplir (exemple : faire du sport 3 fois par semaine, manger 5 fruits et légumes par jour, ...)" title="La description doit faire entre 1 et 300 caractètres" maxlength="300"></textarea>
            </div>
            <div class="small-12 columns text-center" >
                <a class="button" id="confirmationAdd">Valider votre objectif</a>
            </div>
            <div class="reveal-modal" id="confirmationObjectif" data-reveal>
                <h2 class="text-center" id="modalTitle">Confirmation de l'objectif</h2> 
                <p>Voulez vous ajoutez l'objectif suivant ?</p>
                <a class="button" id="confirmerObj">Confirmer</a>
                <a class="close-reveal-modal" aria-label="Close">&#215;</a>
            </div>
        </div>      
    </div>   
    </form>

<?php endif; ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
        /** Création de type */
        jQuery('#confirmationAdd').click(function () {
            var obj = jQuery("#objectif").val();

            jQuery('.objectifInvalide').empty();  // réinitialise potentiel message d'erreur

            if (obj === "") {
                jQuery('.objectifInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Veuillez renseigner la description de l\'objectif <a href="javascript:void(0)" class="close">&times;</a></div>');
            } else {
                jQuery('#confirmationObjectif').foundation('reveal', 'open');
            }
        });
        jQuery('#confirmerObj').click(function () {
            jQuery("#formObj").submit();
        });
    });
</script>