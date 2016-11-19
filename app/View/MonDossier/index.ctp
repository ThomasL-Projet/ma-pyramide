<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Dossier');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Gérer votre suivi, vos objectifs, ainsi que l\'ensemble de vos données.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon Dossier', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">

    <div class="row">
        <div class="small-12 columns large-centered columns"><br/>
            <div class="title-area"> Mon Dossier  </div>  
        </div>
    </div>
    <br />

    <div class="row" data-equalizer data-options="equalize_on_stack: true" id="imgGrAliments">

        <!-- En cliquant sur ce lien, vous êtes redirigé vers la page "Mon tableau de bord" -->
        <div class="large-6 small-12 columns"  data-equalizer-watch>
            <div class="callout" data-equalizer-watch>
                <?php if (AuthComponent::user('username')) { ?>
                    <a href="monDossier/mesdonneessante">
                        <div class="image-wrapper overlay-fade-in">
                            <?php echo $this->Html->image('https://pixabay.com/static/uploads/photo/2012/04/10/23/35/sinus-27061_960_720.png', array('alt' => 'Fruits')); ?>
                            <div class="image-overlay-content">
                                <h2>Mes données santé</h2>
                                <p class="description" style="padding: 15px;" >Votre suivi, avec une vision physique, alimentaire sur une durée de votre choix.</p>
                            </div>
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();"/>
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('https://pixabay.com/static/uploads/photo/2012/04/10/23/35/sinus-27061_960_720.png', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes données santé</h2>
                            <p class="description">Votre suivi, avec une vision physique, alimentaire sur une durée de votre choix.</p>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div> 


        <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                                         détaillée de votre activité physique -->
        <div class="large-6 small-12 columns"  data-equalizer-watch>
            <div class="callout" data-equalizer-watch>
                <?php if (AuthComponent::user('username')) { ?>
                    <a href="../mapyramide/mesCinqObjectifs">
                        <div class="image-wrapper overlay-fade-in">
                            <?php echo $this->Html->image('img_cinqobjectifs.jpg', array('alt' => 'Fruits')); ?>
                            <div class="image-overlay-content">
                                <h2>Mes 5 objectifs</h2>
                                <p class="description"  style="padding: 15px;" >Vous choisissez 5 objectifs puis votre coach virtuel vous prodigue un soutien grâce à ces conseils pour les atteindre.</p>
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
        <?php 
                $tuteur_lien = new SimpleXMLElement($this->Html->link('Tut', ['controller' => 'tuteurs',
                'action' => 'index',
                'full_base' => true,]
                ));
        ?>
        <!-- Mon suvi professionnel, pour mettre en lien un utilisateur et un diététicien  -->
        <div class="large-6 small-12 columns"  data-equalizer-watch>
            <div class="callout" data-equalizer-watch>
                <?php if (AuthComponent::user('username')) { ?>
                    <a href="<?php echo $tuteur_lien['href']; ?>"> <!-- TODO mettre le bon lien -->
                        <div class="image-wrapper overlay-fade-in">
                            <?php echo $this->Html->image('https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Discussion.png/640px-Discussion.png', array('alt' => 'Fruits')); ?>
                            <div class="image-overlay-content" >
                                <h2>Mon suivi professionnel</h2>
                                <p class="description"  style="padding: 15px;" >Vous permet de vous mettre en lien avec un diététicien.</p>
                            </div>
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();"/>
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('https://upload.wikimedia.org/wikipedia/commons/thumb/8/82/Discussion.png/640px-Discussion.png', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mon suivi professionnel</h2>
                            <p class="description"  style="padding: 15px;" >Vous permet de vous mettre en lien avec un diététicien.</p>
                        </div>
                    </div>
                    </a>
                <?php } ?>
            </div>
        </div>
        <?php 
                $reglage_lien = new SimpleXMLElement($this->Html->link('Tut', ['controller' => 'monDossier',
                'action' => 'reglages',
                'full_base' => true,]
                ));
        ?>
        <!-- Mes réglages, vers la page existante (users/edit/xxx) qui sera modifier pour l’ajout de nouvelle donnée   -->
        <div class="large-6 small-12 columns"  data-equalizer-watch>
            <div class="callout" data-equalizer-watch>
                <?php if (AuthComponent::user('username')) { ?>
                    <a href="<?php echo $reglage_lien['href'] ; ?>"> <!-- TODO mettre le bon lien -->
                        <div class="image-wrapper overlay-fade-in">
                            <?php echo $this->Html->image('https://pixabay.com/static/uploads/photo/2015/06/23/09/08/gears-818456_960_720.jpg', array('alt' => 'Fruits')); ?>
                            <div class="image-overlay-content">
                                <h2>Mes réglages</h2>
                                <p class="description"  style="padding: 15px;">Vous pouvez modifier votre profil.</p>
                            </div>
                        </div>
                    </a>
                <?php } else { ?>
                    <a href="javascript:void(0);" onClick="nonConnecte();"/>
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('https://pixabay.com/static/uploads/photo/2015/06/23/09/08/gears-818456_960_720.jpg', array('alt' => 'Fruits')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes réglages</h2>
                            <p class="description"  style="padding: 15px;" >Vous pouvez modifier votre profil.</p>
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
