<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Légumes');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', ['action' => 'dietetique', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les groupes alimentaires', ['action' => 'groupesalimentaires', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les légumes', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les légumes </div> 
        </div>
    </div> 
    <div class="row" data-equalizer>
        <div class="small-4 columns" data-equalizer-watch> 
            <h2> Quantité quotidienne conseillée </h2>
            <p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. 
            </p> 
            <br/>
        </div>
        <div class="small-4 columns" data-equalizer-watch>
            <!-- class = "images"-->
            <h2>  Equivalence pour une coupe de légumes </h2>
            <p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. 
            </p>
        </div>
        <div class="small-4 columns" data-equalizer-watch>
            <h2>  Conseils de consommation </h2> 
            <p> En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers. 
            </p>
        </div>           
    </div>

    <div class="row" data-equalizer>
        <div class="small-4 columns" data-equalizer-watch> 
            <fieldset class='listeFruitsLegumes'>
                <legend class='legendCenter'>Légumes verts</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Légumes']['Légumes verts'] as $groupeLegume) {
                            foreach ($groupeLegume['Aliment'] as $legume) {
                                $fichier = strtok($legume['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($legume['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $legume['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </fieldset>
        </div>
        <div class="small-4 columns" data-equalizer-watch>
            <fieldset class='listeFruitsLegumes'>
                <legend class='legendCenter'>Légumes féculents</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Légumes']['Légumes féculents'] as $groupeLegume) {
                            foreach ($groupeLegume['Aliment'] as $legume) {
                                $fichier = strtok($legume['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($legume['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $legume['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </fieldset>
        </div>
        <div class="small-4 columns" data-equalizer-watch>
            <fieldset class='listeFruitsLegumes'>
                <legend class='legendCenter'>Autres légumes</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Légumes']['Autres légumes'] as $groupeLegume) {
                            foreach ($groupeLegume['Aliment'] as $legume) {
                                $fichier = strtok($legume['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($legume['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $legume['nomFR'], 'escape' => true));
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

