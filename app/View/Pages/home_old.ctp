<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Pages
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Debugger', 'Utility');
?>
<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Accueil');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Ma Pyramide Santé fournit des informations utiles pour les individus afin de contrer les phénomènes de surpoids ou d\'obésité. Il vous donne accès à des modules de suivi dynamiques ainsi que des informations génériques');
$this->end();
?>
<?php
if (Configure::read('debug') > 0):
    Debugger::checkSecurityKeys();
endif;
?>
<br/><br/>
<div class="row">
    <div class="small-12 columns">
        <!-- SLIDER -->				
        <div class="small-12 medium-8 large-8 columns right">
            <!-- TOUCHE DE NAVIGATION POUR LE SLIDER -->
            <div class="large-10 small-8 columns text-center small-centered">
                <span class="precedent">
                    &lsaquo;
                </span>
                <span class="suivant">
                    &rsaquo;
                </span>
                <div class="main-slider-content">

                    <div>

                        <?php echo $this->Html->image('photos/1.png', array('title' => '', 'alt' => 'alt')); ?>

                        <?php /* echo '<h4>'. $allPhotos[0]['Photo']['titre'] .'</h4>'; */ ?>
                        <?php /* echo '<p>'. $allPhotos[0]['Photo']['description'] . '</p>' ; */ ?>
                        <?php //echo $this->Html->link('En savoir plus', '#', array('class' => 'link')); ?>

                    </div> 

                    <div>
                        <?php echo $this->Html->image('photos/2.png', array('title' => '', 'alt' => 'alt')); ?>

                        <?php /* echo '<h4>'. $allPhotos[1]['Photo']['titre'] .'</h4>'; */ ?>
                        <?php /* echo '<p>'. $allPhotos[1]['Photo']['description'] . '</p>' ; */ ?>
                        <?php //echo $this->Html->link('En savoir plus', '#', array('class' => 'link')); ?>


                    </div>

                    <div>
                        <?php echo $this->Html->image('photos/3.png', array('title' => '', 'alt' => 'alt')); ?>

                        <?php /* echo '<h4>'. $allPhotos[2]['Photo']['titre'] .'</h4>'; */ ?>
                        <?php /* /echo '<p>'. $allPhotos[2]['Photo']['description'] . '</p>' ; */ ?>
                        <?php //echo $this->Html->link('En savoir plus', '#', array('class' => 'link')); ?>
                    </div>

                    <div>
                        <?php echo $this->Html->image('photos/4.png', array('title' => '', 'alt' => 'alt')); ?>

                        <?php /* echo '<h4>'. $allPhotos[3]['Photo']['titre'] .'</h4>'; */ ?>
                        <?php /* echo '<p>'. $allPhotos[3]['Photo']['description'] . '</p>' ; */ ?>
                        <?php //echo $this->Html->link('En savoir plus', '#', array('class' => 'link')); ?>

                    </div>

                </div>


                <!-- ENDS SLIDER -->


            </div>
            <div class="medium-12 show-for-medium-up columns right">

                <a href="aliments/" class="button"> Les aliments </a><br/>
                <a href="activitephysiques/" class="button"> Suivez vos activités physiques </a><br/>
                <a href="suivialimentaires/" class="button"> Établissez un suivi alimentaire </a><br/>
                <a href="supertracker/" class="button"> Accéder à supertracker </a>

            </div>
        </div>


        <div class="row">

            <div class="small-12 show-for-small-only columns right">

                <!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Encyclopédie". Cette dernière vous permet de comparer en termes de valeurs 
                    nutritionnelles deux aliments -->
                <div class="row" data-equalizer data-options="equalize_on_stack: true" id="imgGrAliments">
                    <div class="large-4 small-12 columns" data-equalizer-watch>
                        <article class="callout" data-equalizer-watch>
                            <a href="aliments/"/>
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
                            <a href="activitephysiques/">
                                <div class="image-wrapper overlay-fade-in">
                                    <?php echo $this->Html->image('img_suiviphysique.jpg', array('alt' => 'Fruits')); ?>
                                    <div class="image-overlay-content">
                                        <h2>Mon suivi physique</h2>
                                        <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>     

                    <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
                                  détaillée de votre activité physique -->
                    <div class="large-4 small-12 columns"  data-equalizer-watch>
                        <div class="callout" data-equalizer-watch>
                            <a href="suivialimentaires/">
                                <div class="image-wrapper overlay-fade-in">
                                    <?php echo $this->Html->image('img_suivialimentaire.png', array('alt' => 'Fruits')); ?>
                                    <div class="image-overlay-content">
                                        <h2>Mon suivi alimentaire</h2>
                                        <p class="description">Entrez votre activité physique et suivez vos progrès dans le temps grâce à ce module.</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div> 
                </div>
            </div>  

            <div class="small-12 medium-3 large-3 columns left">
                <!-- Case grand public -->
                <div>
                    <h3  class='legendCenter text-center'>
                        Conseil du moment
                    </h3>
                    <div id="menuConseil" class="text-center" style="background-color:lightgray;">
                        <?php
                        $i = 0;
                        foreach ($conseils as $conseil) {
                            $i++;
                            echo "<div>";
                            $dateactualite = strtotime($conseil['Actualite']['created']);
                            $dateactuBien = date('j/m/Y', $dateactualite);
                            echo "<b>" . $dateactuBien . "</b>";
                            echo "<p style='font-size:12px;text-align:justify;padding-left:5px;padding-right:5px;'>" . $this->Text->truncate(strip_tags(str_replace("&nbsp;", "", $conseil['Actualite']['content'])), 200, array('ellipsis' => '...', 'html' => true)) . "</p>";
                            echo $this->Html->link('<div class="button tiny">' . "Lire l'intégralité"
                                    . '</div>', '/actualites/actualite/' . $conseil['Actualite']['id'], array('escape' => false));
                            echo "</div>";
                            if ($i == 5) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>

                <div>
                    <h3  class='legendCenter text-center'>
                        Articles récents
                    </h3>
                    <div id="menuArticle" class="text-center" style="background-color:lightgray;">
                        <?php
                        $i = 0;
                        foreach ($articles as $article) {
                            $i++;
                            echo "<div>";
                            $dateactualite = strtotime($article['Article']['created']);
                            $dateactuBien = date('j/m/Y', $dateactualite);
                            echo "<h5>" . $article['Article']['title'] . "</h5>";
                            echo $dateactuBien;
                            echo "<p style='font-size:12px;text-align:justify;padding-left:4px;padding-right:4px;'>" . $this->Text->truncate(strip_tags(str_replace("&nbsp;", "", $article['Article']['content'])), 200, array('ellipsis' => '...', 'html' => true)) . "</p>";
                            echo $this->Html->link('<div class="button tiny">' . "Lire l'intégralité"
                                    . '</div>', '/articles/article/' . $article['Article']['id'], array('escape' => false));
                            echo "</div><hr style='background-color: black; height: 1px; border: 0;'/>";
                            if ($i == 4) {
                                break;
                            }
                        }
                        ?>
                    </div>
                </div>



                <!-- Bouton Super Traqueur -->
                <?php echo $this->Html->link('<div id="btn-super-traqueur"></div>', '/pages/supertracker', array('escape' => false)); ?>

                <!-- Bouton Jackpot santé -->
                <!-- TODO LE METTRE EN BOUTON -->
                <?php echo $this->Html->link('<div id="btn-jackpot-sante"></div>', '/pages/jackpotsante', array('escape' => false)); ?>
            </div>
        </div>

    </div>

</div>
<?php
//////////////////////////// FRESH AJOUT ///////////////////////////////////////
echo $this->Html->script('slick.min.js');
echo $this->Html->script('slick.conf.js');
echo $this->Html->script('foundation/foundation');
