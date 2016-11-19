<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Conseils sportifs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La diététique', array('action' => 'dietetique', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La gestion pondérale', array('action' => 'gestionponderale', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les calories', 'Javascript:void(0);'); ?></li>
</nav>﻿

<div class="row">
    <div class="small-12 columns">
        <div id="image">
        </div>
        <div class="row">
            <!-- Titre de la page accessible depuis le menu situé en haut de la page en cliquant sur "Activité physique" -> Conseils sportifs -->
            <h1><strong> Conseils sportifs </Strong></h1> 
        </div>

            
         <div class="row" >
                    <div class="medium-12 columns" >
                <p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                    poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                    Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                    maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                    certains types de cancers. </p>
            </div> 
        </div>

         <div class="row"  data-equalizer>
                    <div class="medium-4 columns panel" data-equalizer-watch >
                <h2> Paragraphe 1 </h2>
                <p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                    poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                    Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                    maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                    certains types de cancers.<p>
            </div>
   
                    <div class="medium-4 columns panel" data-equalizer-watch >
                <h2> Paragraphe 2 </h2>
                <p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                    poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                    Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                    maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                    certains types de cancers.</p>
            </div>
           
                    <div class="medium-4 columns panel" data-equalizer-watch >
                <h2> Paragraphe 3 </h2>
                <p>En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                    poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                    Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                    maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                    certains types de cancers.</p>
            </div>
           
        </div>
    </div>
</div>