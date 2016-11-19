<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Produits laitiers');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', ['action' => 'dietetique', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les groupes alimentaires', ['action' => 'groupesalimentaires', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les produits laitiers', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les produits laitiers </div> 
        </div>
    </div> 
    <div class="row">
        <div class="small-12 colomns">
            <h3>Voir aussi</h3>
            <ul class="button-group even-3">
                <?php
                foreach ($lait as $unProduitLaitier) {
                    echo '<li >' . $this->Html->link($unProduitLaitier['titreonglet'], '/statiques/pages/'
                            . $unProduitLaitier['id'], array('escape' => false, 'class' => 'button')) . '</li>';
                }
                ?>      
            </ul>
        </div>
    </div>  
    <div class="row" data-equalizer>
        <div class="small-4 columns "  data-equalizer-watch>
            <h3>Quantité quotidienne conseillée </h3>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna 
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
                aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
            </p>
        </div>

        <div class="small-4 columns "  data-equalizer-watch>
            <h3>Equivalence pour une coupe de produits laitiers</h3>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna 
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
                aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
            </p>
        </div>

        <div class="small-4 columns "  data-equalizer-watch>
            <h3>Conseil de consommation</h3>
            <p class="text-justify">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                sed do eiusmod tempor incididunt ut labore et dolore magna 
                aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
                aute irure dolor in reprehenderit in voluptate velit esse 
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                cupidatat non proident, sunt in culpa qui officia deserunt
                mollit anim id est laborum.
            </p>
        </div>
    </div>
    <hr/>
    <div class="row" data-equalizer>
        <div class="small-4 columns " data-equalizer-watch>

            <fieldset>
                <legend>Yaourts</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <?php
                        foreach ($donnees['Produits laitiers']['Yaourts'] as $groupeProduitLaitier) {
                            foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
                                $fichier = strtok($produitLaitier['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </fieldset>

        </div>

        <div class="small-4 columns " data-equalizer-watch>

            <fieldset>
                <legend>Fromages</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <?php
                        foreach ($donnees['Produits laitiers']['Fromages'] as $groupeProduitLaitier) {
                            foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
                                $fichier = strtok($produitLaitier['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
                                echo "</li>";
                            }
                        }
                        ?>
                    </ul>
                </div>
            </fieldset>


        </div>

        <div class="small-4 columns "  data-equalizer-watch>

            <fieldset>
                <legend>Lait et desserts à base de lait</legend>
                <div class="fieldsetscrollbar">
                    <ul>
                        <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                        <?php
                        foreach ($donnees['Produits laitiers']['Lait et desserts à base de lait'] as $groupeProduitLaitier) {
                            foreach ($groupeProduitLaitier['Aliment'] as $produitLaitier) {
                                $fichier = strtok($produitLaitier['chemin'], ',');
                                if ($fichier == '') {
                                    $fichier = 'noimage.jpg';
                                }
                                echo "<li>";
                                echo $this->Html->link($produitLaitier['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $produitLaitier['nomFR'], 'escape' => true));
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

<!--Script permettant l'affichage des images à l'aide de zoombox -->
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>

<script type="text/javascript">
    jQuery(function ($) {
        $('a.zoombox').zoombox();

        /**
         * Or You can also use specific options
         $('a.zoombox').zoombox({
         theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
         opacity     : 0.8,              // Black overlay opacity
         duration    : 800,              // Animation duration
         animation   : true,             // Do we have to animate the box ?
         width       : 500,              // Default width
         height      : 500,              // Default height
         gallery     : true,             // Allow gallery thumb view
        autoplay : false                // Autoplay for video
        });
          */
    });
</script>
