<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Jackpot santé');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes simulations', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mes simulations (Mon Jackpot Santé) </div> 
            <div class="textarea">
                <p class="text-justify">
                    Ce <strong>jackpot-santé</strong> vous fixe les objectifs 
                    quotidiens en termes de votre budget : calories,  aliments 
                    (par groupes alimentaires individuels) et activité physique 
                    et de leur répartition. Il vous permet en plus de planifier 
                    vos repas quotidiens en répartissant votre alimentation entre 
                    le petit déjeuner, le déjeuner, le diner et les en cas.
                </p>			
            </div>
        </div>
    </div>
    <!-- les images a la suite  -->
    <div class="row" data-equalizer id="imgGrAliments">
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
                <a href="../mesrecettes/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_mesrecettes.jpg', array('alt' => 'Mes recettes')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes recettes</h2>
                            <p class="description">Personnalisez vos recettes en combinant des aliments.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
                <a href="../activitephysiques/jackpot">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_activites.jpg', array('alt' => 'Mes activités')); ?>
                        <div class="image-overlay-content">
                            <h2>Mes activités</h2>
                            <p class="description">Utilisez cet outil pour chercher une activité et voir combien de calories vous pouvez brûler en la pratiquant</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="large-4 small-12 columns">
            <div class="callout" data-equalizer-watch>
                <a href="../alimenthorsclassification/">
                    <div class="image-wrapper overlay-fade-in">
                        <?php echo $this->Html->image('img_alimentshorsclassification.jpg', array('alt' => 'Aliments hors classification')); ?>
                        <div class="image-overlay-content">
                            <h2>Aliments hors classification</h2>
                            <p class="description">Personnalisez vos aliments achetés dans le commerce et non répertoriés dans notre classification.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
    function nonConnecte() {
        alert("Il faut etre connecte pour utiliser cette fontionnalité.");
    }
</script>

<script type="text/javascript">
    function nonImplemente() {
        alert("Fonctionnalité non disponible");
    }
</script>