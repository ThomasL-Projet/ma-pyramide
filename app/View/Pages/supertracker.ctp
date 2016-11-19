<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Supertracker');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier', ['full_base' => true]) ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes statistiques', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 large-centered columns">
            <div class="title-area"> Mes statistiques (Supertraqueur) </div> 
            <div class="textarea">
                <p class="text-justify">
                    <strong>Supertraqueur</strong> va vous aider à planifier, 
                    analyser et traquer votre alimentation et votre activité 
                    physique. Vous trouverez dans <strong>Supertraqueur</strong> 
                    non seulement ce que vous devez manger mais aussi dans quelle 
                    quantité et vous suivrez dans le temps votre alimentation, 
                    votre activité physique, votre poids.<br>
                    <?php
                    if (AuthComponent::user('id') == null) {
                        echo 'En créant ' . $this->Html->link('<strong>mon profil</strong>', '/users/add/', array('escape' => false)) . ' ou en me ' . $this->Html->link('<strong>connectant</strong>', '/users/login/', array('escape' => false)) . ' vous personnaliserez l’aide de <strong>Supertraqueur</strong> : fixation d’objectifs, coaching virtuel et journal individuel. Il s’adresse à tous de 2 à 120 ans.';
                    }
                    ?>
                </p>			
            </div>
        </div>
    </div>
    

<!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Encyclopédie". Cette dernière vous permet de comparer en termes de valeurs 
         nutritionnelles deux aliments -->
<div class="row" data-equalizer data-options="equalize_on_stack: true" id="imgGrAliments">
    <div class="large-4 small-12 columns" data-equalizer-watch>
        <article class="callout" data-equalizer-watch>
            <a href="../aliments/"/>
            <div class="image-wrapper overlay-fade-in">
                <?php echo $this->Html->image('img_encyclopedie.jpg', array('alt' => 'Fruits')); ?>
                <div class="image-overlay-content">
                    <h2>Encyclopédie</h2>
                    <p class="description">L’information nutritionnelle sur plus de 1500 aliments et la possibilité de les comparer deux à deux.</p>
                </div>

            </div>
            </a>
        </article>

    </div>
    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
        détaillée de votre activité physique -->

    <div class="large-4 small-12 columns"  data-equalizer-watch>
        <div class="callout" data-equalizer-watch>
            <?php if (AuthComponent::user('username')) { ?>
                <a href="../activitephysiques/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_suiviphysique.jpg', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mon suivi physique</h2>
                            <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" onClick="nonConnecte();"/>
                <div class="image-wrapper overlay-fade-in">
                    <?php echo $this->Html->image('img_suiviphysique.jpg', array('alt' => 'Fruits')); ?>
                    <div class="image-overlay-content">
                        <h2>Mon suivi physique</h2>
                        <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                    </div>
                </div>
                </a>
            <?php } ?>
        </div>
    </div>     

    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                  détaillée de votre activité physique -->
    <div class="large-4 small-12 columns"  data-equalizer-watch>
        <div class="callout" data-equalizer-watch>
            <?php if (AuthComponent::user('username')) { ?>
                <a href="../suivialimentaires/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_suivialimentaire.png', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mon suivi alimentaire</h2>
                            <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" onClick="nonConnecte();"/>
                <div class="image-wrapper overlay-fade-in">
                    <?php echo $this->Html->image('img_suivialimentaire.png', array('alt' => 'Fruits')); ?>
                    <div class="image-overlay-content">
                        <h2>Mon suivi alimentaire</h2>
                        <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                    </div>
                </div>
                </a>

            <?php } ?>
        </div>
    </div>     

    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                           détaillée de votre activité physique -->
    <div class="large-4 small-12 columns"  data-equalizer-watch>
        <div class="callout" data-equalizer-watch>
            <?php if (AuthComponent::user('username')) { ?>
                <a href="../gestionpoids/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_gestionpoids.jpg', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mon gestionnaire de poids</h2>
                            <p class="description">Vous guide dans la gestion de votre poids, rentrez votre poids et suivez vos progrès dans le temps.</p>
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" onClick="nonConnecte();"/>
                <div class="image-wrapper overlay-fade-in">
                    <?php echo $this->Html->image('img_gestionpoids.jpg', array('alt' => 'Fruits')); ?>
                    <div class="image-overlay-content">
                        <h2>Mon gestionnaire de poids</h2>
                        <p class="description">Vous guide dans la gestion de votre poids, rentrez votre poids et suivez vos progrès dans le temps.</p>
                    </div>
                </div>
                </a>
            <?php } ?>
        </div>
    </div>  
    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                                     détaillée de votre activité physique -->
    <div class="large-4 small-12 columns"  data-equalizer-watch>
        <div class="callout" data-equalizer-watch>
            <?php if (AuthComponent::user('username')) { ?>
                <a href="../mesCinqObjectifs/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_cinqobjectifs.jpg', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes 5 objectifs</h2>
                            <p class="description">Vous choisissez 5 objectifs puis votre coach virtuel vous prodigue un soutien grâce à ces conseils pour les atteindre.</p>
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" onClick="nonConnecte();"/>
                <div class="image-wrapper overlay-fade-in">
                    <?php echo $this->Html->image('img_cinqobjectifs.jpg', array('alt' => 'Fruits')); ?>
                    <div class="image-overlay-content">
                        <h2>Mes 5 objectifs</h2>
                        <p class="description">Vous choisissez 5 objectifs puis votre coach virtuel vous prodigue un soutien grâce à ces conseils pour les atteindre.</p>
                    </div>
                </div>
                </a>
            <?php } ?>
        </div>
    </div>  

    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                                    détaillée de votre activité physique -->
    <div class="large-4 small-12 columns"  data-equalizer-watch>
        <div class="callout" data-equalizer-watch>
            <?php if (AuthComponent::user('username')) { ?>
                <a href="../rapportEvolution/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_mesrapportsdevolution.png', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes rapports d'évolution</h2>
                            <p class="description">Ces rapports vous permettent de faire le point : atteinte des objectifs et détermination de vos points forts et faibles.</p>
                        </div>
                    </div>
                </a>
            <?php } else { ?>
                <a href="javascript:void(0);" onClick="nonConnecte();"/>
                <div class="image-wrapper overlay-fade-in">
                    <?php echo $this->Html->image('img_mesrapportsdevolution.png', array('alt' => 'Fruits')); ?>
                    <div class="image-overlay-content">
                        <h2>Mes rapports d'évolution</h2>
                        <p class="description">Ces rapports vous permettent de faire le point : atteinte des objectifs et détermination de vos points forts et faibles.</p>
                    </div>
                </div>
                </a>
            <?php } ?>
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
