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
<div class="show-for-medium-up" style="height: 27.25vw;">
    <!-- SLIDER -->				
    <div style="width: 100% !important;float:left;">

        <div class="main-slider-content">

            <div>
                <?php echo $this->Html->image('photos/7.jpg', array('title' => '', 'alt' => 'alt' )); ?>
            </div> 

            <div>
                <?php echo $this->Html->image('photos/8.jpeg', array('title' => '', 'alt' => 'alt')); ?>
            </div>

            <div>
                <?php echo $this->Html->image('photos/9.jpeg', array('title' => '', 'alt' => 'alt')); ?>
            </div>

            <div>
                <?php echo $this->Html->image('photos/10.jpg', array('title' => '', 'alt' => 'alt')); ?>
            </div>

        </div>


        <!-- ENDS SLIDER -->
        <!-- Description image du slider -->

    </div>
    <div class="texte-description-slider" style="width: 20vw !important; float:right; right:15vw; background-color: rgba(0, 0, 0, 0.5); position:absolute;   color:white; ">

        <div style="display:block;padding:15px;" class="desc_1"><?php echo $allPhotos[0]['Photo']['description']; ?>
        </div>
        <div style="display:none;padding:15px;" class="desc_2"><?php echo $allPhotos[1]['Photo']['description']; ?>
        </div>
        <div style="display:none;padding:15px;" class="desc_3"><?php echo $allPhotos[2]['Photo']['description']; ?>
        </div>
        <div style="display:none;padding:15px;" class="desc_4"><?php echo $allPhotos[3]['Photo']['description']; ?>
        </div>

    </div>
</div>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Découvrez plus de contenu </div> 
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div id="menuArticle" class="text-center row" >
                <?php
                $i = 0;
                foreach ($articles as $article) {
                    $i++;
                    echo "<div class='small-4 columns' style='background-color:lightgray;padding:3px;background-clip:content-box;'>";
                    echo "<div style='display:inline-block;'>";
                    $dateactualite = strtotime($article['Article']['created']);
                    $dateactuBien = date('j/m/Y', $dateactualite);
                    echo "<h5>" . $article['Article']['title'] . "</h5>";
                    echo $dateactuBien;
                    echo "<p style='font-size:12px;text-align:justify;padding-left:4px;padding-right:4px;'>" . $this->Text->truncate(strip_tags(str_replace("&nbsp;", "", $article['Article']['content'])), 500, array('ellipsis' => '...', 'html' => true)) . "</p>";
                    echo $this->Html->link('<div class="button tiny">' . "Lire l'intégralité"
                            . '</div>', '/articles/article/' . $article['Article']['id'], array('escape' => false));
                    echo "</div>";
                    echo "</div>";
                    if ($i == 3) {
                        break;
                    }
                }
                ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les points phares de MaPyramide </div> 
        </div>
    </div>
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
                        <p class="description">L’information nutritionnelle sur plus de 1500 aliments et la possibilité de les comparer.</p>
                    </div>

                </div>
                </a>
            </article>

        </div>
        <!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
            détaillée de votre activité physique -->

        <div class="large-4 small-12 columns"  data-equalizer-watch>
            <div class="callout" data-equalizer-watch>
                <a href="activitesphysiques/">
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

<?php
//////////////////////////// initialisation slider ///////////////////////////////////////
echo $this->Html->script('slick.min.js');
echo $this->Html->script('slick.conf.js');
echo $this->Html->css('slick-theme');
echo $this->Html->css('slick');
