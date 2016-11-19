<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Les matières grasses');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', ['action' => 'dietetique', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les groupes alimentaires', ['action' => 'groupesalimentaires', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les matières grasses', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les matières grasses </div> 
        </div>
    </div> 
    <div class="row"  data-equalizer>
        <div class="small-4 columns" data-equalizer-watch>
            <h2> Quantité quotidienne conseillée </h2>
            <p class="text-justify">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. </p>
        </div> 
        <div class="small-4 columns" data-equalizer-watch>
            <!-- class = "images"-->
            <h2>  Equivalence pour une coupe de protéines </h2>

            <p class="text-justify">En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. </p>
        </div>
        <div class="small-4 columns" data-equalizer-watch>
            <h2>  Conseils de consommation </h2> 
            <p class="text-justify"> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. 
            </p>
        </div>

    </div>

    <div class="row">
        <div class="medium-6 columns" >
            <fieldset class='listeFruitsLegumes'>
                <legend class='legendCenter'>Huiles</legend>
                <div class="listeForEach" style="width: 500px; height: 400px; overflow-y: scroll">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Matières grasses']['Huiles'] as $groupeMatiereGrasse) {
                            foreach ($groupeMatiereGrasse['Aliment'] as $matiereGrasse) {
                                $fichier = strtok($matiereGrasse['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($matiereGrasse['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $matiereGrasse['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>

            </fieldset>
        </div>
        <div class="medium-6 columns" >
            <fieldset class='listeFruitsLegumes'>
                <legend class='legendCenter'>Graisses solides</legend>
                <div class="listeForEach" style="width: 500px; height: 400px; overflow-y: scroll">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Matières grasses']['Graisses solides'] as $groupeMatiereGrasse) {
                            foreach ($groupeMatiereGrasse['Aliment'] as $matiereGrasse) {
                                $fichier = strtok($matiereGrasse['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($matiereGrasse['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $matiereGrasse['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </fieldset>
        </div>
    </div>
</div>	

