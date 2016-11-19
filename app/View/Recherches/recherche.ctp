<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Recherche');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Votre recherche', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Votre recherche </div> 

        </div>
    </div> 
    <?php if (empty($articles) AND empty($aliments)) : ?>
        <div class="row">
            <div id="accordeon">
                <h2>Désolé mais aucun résultat n'a été renvoyé avec ces mots clés...<br><br></h2>
            </div>
        </div>
    <?php else : ?>
        <?php if (!empty($articles)) : ?>
            <div class="row">
                <div class="small-12 columns"> 
                    <h1>Résultat de la recherche dans les articles : </h1>
                    <?php
                    if (count($articles) > 50) {
                        echo '(plus de 50 resultats)';
                    } else {
                        if (count($articles) == 1)
                            echo '(' . count($articles) . ' resultat)';
                        else {
                            echo '(' . count($articles) . ' resultats)';
                        }
                    }
                    ?></div>

                <!-- accordeon article -->
                <ul class="accordion" data-accordion>
                    <li class="accordion-navigation">
                        <a href="#panel1a">Accordion 1</a>
                        <div id="panel1a" class="content active">
                            <?php
                            foreach ($articles as $article):
                                echo $this->Text->truncate('<h1>' . $article['Article']['title'] . '</h1>', 25, array('ellipsis' => '...', 'html' => true));
                                $text = "<p>" . $this->Text->truncate($article['Article']['content'], 300, array('html' => true)) .
                                        "</p><p class='suite'>" . $this->Html->link('Lire la suite ...', '/articles/article/' . $article['Article']['id'], array('escape' => false)) . "</p>";
                                echo $this->Html->div($class = null, $text, $options = array());
                            endforeach;
                            ?>
                        </div>
                    </li>
                    <li class="accordion-navigation">
                        <a href="#panel2a">Accordion 2</a>
                        <div id="panel2a" class="content">
                            Panel 2. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </li>
                    <li class="accordion-navigation">
                        <a href="#panel3a">Accordion 3</a>
                        <div id="panel3a" class="content">
                            Panel 3. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                        </div>
                    </li>
                </ul>

            <?php endif; ?>
            <?php if (!empty($aliments)) : ?>
                <div class="row">
                    <div class="small-12 columns">
                        <p>Resultat de la recherche dans les aliments : </p> <?php
                        if (count($aliments) > 50) {
                            echo '(plus de 50 resultats)';
                        } else {
                            if (count($aliments) == 1)
                                echo '(' . count($aliments) . ' resultat)';
                            else
                                echo '(' . count($aliments) . ' resultats)';
                        }
                        ?></div>
                </div>
                <div class="row">
                    <div class="small-12 columns">
                        <?php
                        $i = 0;
                        foreach ($aliments as $aliment) {
                            if ($i == 51)
                                break;

                            $img = $aliment['Aliment']['chemin'];
                            if ($img == "") {
                                $img = 'noimage.jpg';
                            }
                            echo $this->Html->link($this->Html->image("imagesAliment/" . $img, array("alt" => $aliment['Alimentsdetaille']['nom'], "height" => "100px", "width" => "100px", "class" => "image")), '../app/webroot/img/imagesAliment/' . $img, array('class' => 'zoombox', 'alt' => $aliment['Alimentsdetaille']['nom'], 'escape' => false, 'title' => $aliment['Alimentsdetaille']['nom']));
                            echo '<div class="rech1">';
                            if (strlen($aliment['Alimentsdetaille']['nom']) > 80) {
                                echo "<p>Nom : <strong>" . substr($aliment['Alimentsdetaille']['nom'], 0, 77) . "...</strong></p>";
                            } else {
                                echo '<p>Nom : <strong>' . $aliment['Alimentsdetaille']['nom'] . '</strong></p>';
                            }
                            if (empty($aliment['Famillealiments']['subname'])) {
                                echo '<p>Famille : ' . $aliment['Famillealiments']['name'] . '</p>';
                            } else {
                                echo '<p>Famille : ' . $aliment['Famillealiments']['name'] . ' / ' . $aliment['Famillealiments']['subname'] . '</p>';
                            }
                            echo $this->Html->link('<button class="button" type="button" name="bouton">Voir dans l\'encyclopédie</button >', '/aliments/index/' . $aliment['Aliment']['id'], array('escape' => false, 'title' => 'Voir dans l\'encyclopédie'));
                            echo '</div>';
                            echo '<hr />';
                            $i++;
                        }
                        ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

        <script>
            $(function () {
                $("#accordeon").accordion();
            });
        </script>
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