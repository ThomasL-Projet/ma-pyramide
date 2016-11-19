<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Rapport Evolution ');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes rapports d\'évolution', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mes rapports d'évolution </div> 

            <div class="textarea">
                <p class="text-justify">
                    Suivre votre progression au fil du temps peut vous aider à 
                    atteindre vos objectifs d’alimentation et d’activité physique. 
                    Utilisez ces rapports pour déterminer les points ou vous avez 
                    atteint vos objectifs et identifier les points que vous aimeriez améliorer.
                    <?php
            if (AuthComponent::user('id') == null) {
                echo 'En créant ' . $this->Html->link('<strong>mon profil</strong>', '/users/add/', array('escape' => false)) . ' ou en me ' . $this->Html->link('<strong>connectant</strong>', '/users/login/', array('escape' => false)) . ' vous personnaliserez l’aide de <strong>Supertraqueur</strong> : fixation d’objectifs, coaching virtuel et journal individuel. Il s’adresse à tous de 2 à 120 ans.';
            }
            ?>
                </p>			
            </div>
        </div>
    </div>
    <!-- ------------------------------------------------------------ -->
    <!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Encyclopédie". Cette dernière vous permet de comparer en termes de valeurs 
            nutritionnelles deux aliments -->
    <div class="row" data-equalizer data-options="equalize_on_stack: true">
        <div class="small-6 medium-4 large-4 columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">
                    <h3>Activité physique</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Retracez votre activité physique hebdomadaire et comparez la aux objectifs fixés.</p>
                <?php echo $this->Html->link('Accéder', '/evolutionphysiques/', array('escape' => false, 'title' => 'Activité physique', 'class' => 'button')); ?>
            </article>
        </div>

        <!-- En cliquant sur ce lien, vous êtes redirigée vers la page nommée "Mon suivi alimentaire". Cette dernière vous permet d'établir une plannification
             détaillée de votre alimentation -->
        <div class="small-6 medium-4 large-4 columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">
                    <h3>Sommaire repas</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Revoyez les menus que vous avez mangé ou planifié pendant une période déterminée.</p>
                <?php echo $this->Html->link('Accéder', '/rapportEvolution/sommaireRepas', array('escape' => false, 'title' => 'Sommaire repas', 'id' => 'suivialimentaires', 'class' => 'button')); ?>
            </article>
        </div>

        <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
            détaillée de votre activité physique -->
        <div class="small-6 medium-4 large-4 columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">

                    <h3>Détails alimentaires</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Voyez le groupe alimentaire et le contenu nutritionnel de vos aliments chaque jour.</p>
                <?php if (AuthComponent::user('username')) { ?>
                    <?php echo $this->Html->link('Accéder', '/rapportEvolution/detailsAlim', array('escape' => false, 'title' => 'Détails alimentaires', 'id' => 'activitephysiques', 'class' => 'button')); ?>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();" class="button tiny" style='bottom:2px;'> Accéder  </a>
                <?php } ?>
            </article>
        </div>
        <div class="hide-for-small-down medium-12 columns"></div>
        <!-- En cliquant sur ce lien, vous êtes redigéré vers la page nommée "Mon gestionnaire de poids idéal". Cette dernière vous permet de définir le poids
             idéal que vous devriez peser en fonction de votre taille & vous aide à gérer ce dernier -->
        <div class="small-6 medium-4 large-4 columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">

                    <h3>Diagrammes</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Ces graphes résument un historique des tendances : poids, calories, groupes alimentaires et nutriments.</p>
                <?php if (AuthComponent::user('username')) { ?>
                    <?php echo $this->Html->link('Accéder', '/rapportEvolution/diagrammes', array('escape' => false, 'title' => 'Diagrammes', 'id' => 'gestionPoids', 'class' => 'button')); ?>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();" class="button tiny" style='bottom:2px;'> Accéder  </a>
                <?php } ?>
            </article>
        </div>

        <!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mes 5 objectifs". Cette dernière vous permet de définir clairement les 5 objectifs
             que vous souhaitez atteindre. Les objectifs peuvent concerner tant l'activité physique que l'alimentation  -->
        <div class="small-6 medium-4 large-4 columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">
                    <h3>Groupes alimentaires et calories</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Choisissez une période et vous obtiendrez vos apports moyens en termes de calories et groupes alimentaires.</p>
                <?php if (AuthComponent::user('username')) { ?>
                    <?php echo $this->Html->link('Accéder', '/rapportEvolution/groupes_ali_et_cal', array('escape' => false, 'title' => 'Groupes alimentaires et calories', 'id' => 'objectifs', 'class' => 'button')); ?>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();" class="button tiny" style='bottom:2px;'> Accéder  </a>
                <?php } ?>
            </article>
        </div>

        <!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "mes rapports d'évolution". Cette dernière vous permet de suivre au jour le jour,
             l'évolution de votre alimentation & de votre activité physique  -->
        <div class="small-6 medium-4 large-4 end columns panel" data-equalizer-watch>
            <article class="bloc-menu">
                <div style="display: table-cell;vertical-align: middle;">
                    <h3>Nutriments</h3>
                </div>
                <hr style="margin: 0 !important;"/>
                <p style="text-align:justify;">Choisissez une période et vous obtiendrez vos apports moyens en nutriments  (Calcium, fer, sodium, vitamine D, ...)</p>
                <?php if (AuthComponent::user('username')) { ?>
                    <?php echo $this->Html->link('Accéder', '/rapportEvolution/nutriments', array('escape' => false, 'title' => 'nutriments', 'id' => 'rapportEvolution', 'class' => 'button')); ?>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();" class="button tiny" style='bottom:2px;'> Accéder  </a>
                <?php } ?>
            </article>
        </div>
    </div>



    <!-- afficher si un visiteur souhaite utiliser une foncitonnalité qui demande une inscription -->
    <div id="besoinCompte" class="reveal-modal" data-reveal>
        <h2 id="modalTitle">Connexion nécessaire</h2>
        <p class="lead">Vous devez être connecté pour accéder à cette fonctionnalité</p>
        <?php
        echo $this->Html->link(
                'S\'inscrire', array(
            'controller' => 'users',
            'action' => 'add'
                ), array('class' => 'button')
        );
        ?>
        <?php
        echo $this->Html->link(
                'Se connecter', array(
            'controller' => 'users',
            'action' => 'login'
                ), array('class' => 'button')
        );
        ?>
        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
    </div>


</div>

<script type="text/javascript">
    function nonConnecte() {
        jQuery('#besoinCompte').foundation('reveal', 'open');
    }
    jQuery(document).ready(function () {
        jQuery(document).foundation({
            equalizer: {
                // Specify if Equalizer should make elements equal height once they become stacked.
                equalize_on_stack: true
            }
        });
    });
    jQuery(window).resize(function () {
        jQuery(document).foundation();
    });
</script>
