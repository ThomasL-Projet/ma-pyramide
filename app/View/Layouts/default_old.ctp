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
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" /> 
        <title>Ma Pyramide Alimentaire</title>

        <?php
        echo $this->Html->meta('icon');

        echo $this->Html->css('navStyles');
        echo $this->Html->css('lof-slider');

        //echo $this->fetch('meta');
        //echo $this->fetch('css');
        //echo $this->fetch('script');
        ?>
        
        <?php 
        ////////////////////////////////////////////// FRESH AJOUT /////////////
        // Ajout du slider slick et de ses dépendances (css )
        echo $this->Html->css('slick');
        echo $this->Html->css('slick-theme');
        // Ajout du css foundation ainsi que du script modernizr
        // echo $this->Html->css('foundation.min');
        echo $this->Html->script('vendor/modernizr.js');
        //////////////////////// END FRESH AJOUT ///////////////////////////////
        ?>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <!-- Adding "maximum-scale=1" fixes the Mobile Safari auto-zoom bug: http://filamentgroup.com/examples/iosScaleBug/ -->		

        <!-- JQuery & Jquery UI -->
<?php
echo $this->Html->script('jquery.min.js');
echo $this->html->script('jquery-ui-1.10.2.custom/js/jquery-1.9.1.js');
echo $this->html->script('jquery-ui-1.10.2.custom/js/jquery-ui-1.10.2.custom.min.js');
echo $this->Html->css('/js/jquery-ui-1.10.2.custom/css/smoothness/jquery-ui-1.10.2.custom.css');
//echo $this->Html->script('http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'); // Inclut la librairie jquery
echo $this->Html->script('jquery.chained.min.js'); // Inclut la librairie jquery.chained.min.js

echo $this->Html->script('excanvas.min.js');
echo $this->Html->script('jquery.jqplot.min.js');
echo $this->Html->css('jquery.jqplot.min.css');
echo $this->Html->script('plugins/jqplot.canvasTextRenderer.min.js');
echo $this->Html->script('plugins/jqplot.canvasAxisLabelRenderer.min.js');
echo $this->Html->script('plugins/jqplot.dateAxisRenderer.min.js');
echo $this->Html->script('plugins/jqplot.canvasAxisTickRenderer.min.js');
echo $this->Html->script('plugins/jqplot.barRenderer.min.js');
echo $this->Html->script('plugins/jqplot.categoryAxisRenderer.min.js');
echo $this->Html->script('plugins/jqplot.pointLabels.min.js');
?>


        <!-- JCarousel -->
<?php echo $this->html->script('slider/jquery.jcarousel.min.js'); ?>
        <!-- ENDS JCarousel -->

        <!--   superfish   -->
        <!-- (Beaux menus) -->
<?php echo $this->html->css('/js/superfish-1.4.8/css/superfish.css'); ?>
        <?php echo $this->html->script('superfish-1.4.8/js/hoverIntent.js'); ?>
        <?php echo $this->html->script('superfish-1.4.8/js/superfish.js'); ?>
        <?php echo $this->html->script('superfish-1.4.8/js/supersubs.js'); ?>
        <?php echo $this->html->script('superfish-1.4.8/jquery.mb.browser-master/jquery.mb.browser.min.js'); ?>
        <script type="text/javascript">
            // initialise plugins
            jQuery(function () {
                jQuery('ul.sf-menu').superfish();
            });
        </script>
        <!-- ENDS superfish -->

        <!-- Barre de recherche -->
        <script>
            $(function () {
                // run the currently selected effect
                function runEffect() {
                    var options = {};
                    // run the effect
                    $("#searchForm").show("drop", options, 500, callback);
                }
                ;

                //callback function to bring a hidden box back
                function callback() {
                    setTimeout(function () {
                        $("#searchForm:visible").removeAttr("style").fadeOut();
                    }, 10000); // timout de 10 secondes 
                }
                ;
                // set effect from select menu value
                $("#searchIcon").click(function () {
                    runEffect();
                    return false;
                });

                $("#searchForm").hide();
            });
        </script>

    </head>

    <body>

        <header>
<?php if (AuthComponent::user('role') == 'administrateur'): ?>
                <div class="menu3">
                <?php echo $this->Html->link('Gérer les photos', '/pages/choixphoto'); ?>
                    <?php echo $this->Html->link('Gérer les articles', '/articles'); ?>
                    <?php echo $this->Html->link('Gérer les actualités', '/actualites'); ?>
                    <?php echo $this->Html->link('Gérer les utilisateurs', '/users'); ?>
                    <?php echo $this->Html->link('Statistiques du site', '/stats/visite'); ?>
                    <?php echo $this->Html->link('Gérer les liens', '/liens'); ?>
                    <?php echo $this->Html->link('Édition des pages', '/statiques'); ?>
                    <?php echo $this->Html->link('Gérer les constantes', '/constantes'); ?>
                </div>

<?php elseif (AuthComponent::user('role') == 'dieteticien'): ?>
                <div class="menu3">
                <?php echo $this->Html->link('Demandes et infos clients', '/demandes'); ?>
                    <?php echo $this->Html->link('Messages', '/demandes/messages'); ?>
                    <?php echo $this->Html->link('Suivis de mes clients', '/demandes/suivis'); ?>
                </div>
                <?php else : ?>
                <div class="menu3">
                </div>
<?php endif; ?>

            <div id='nomEtLogo'>
<?php echo $this->Html->link('<div id="AGD-logo">AG Diététique </div>', '/', array('escape' => false)); ?>
                <?php echo $this->Html->link('<div id="NomSite"> Ma Pyramide Alimentaire </div>', '/', array('escape' => false)); ?>
            </div>

            <div id='menuEtConnexion'>

                <nav id="filter">
                    <ul id="navigation" class="sf-menu"> 
                        <li><?php echo $this->Html->link('Accueil', '/pages/home'); ?></li>
                        <li><?php echo $this->Html->link('Mes aliments', '/pages/groupesalimentaires'); ?>
                            <ul class="dropdown">
                                <li class="dropdown-first"><?php echo $this->Html->link('Fruits', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
<?php
$i = 0;
foreach ($fruit as $frui) {
    if ($i == 0) {
        echo '<li class="dropdown-first">' . $this->Html->link($frui['titreonglet'], '/statiques/pages/' . $frui['id'], array('escape' => false)) . '</li>';
    } elseif ($i + 1 == count($fruit)) {
        echo '<li class="dropdown-last">' . $this->Html->link($frui['titreonglet'], '/statiques/pages/' . $frui['id'], array('escape' => false)) . '</li>';
    } else {
        ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($frui['titreonglet'], '/statiques/pages/' . $frui['id'], array('escape' => false)); ?></li>
                                            <?php } ?>
                                            <?php $i++;
                                        }
                                        ?>

                                    </ul>
                                </li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Légumes', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($legume as $leg) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($leg['titreonglet'], '/statiques/pages/' . $leg['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($legume)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($leg['titreonglet'], '/statiques/pages/' . $leg['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($leg['titreonglet'], '/statiques/pages/' . $leg['id'], array('escape' => false)); ?></li>
    <?php } ?>
    <?php $i++;
}
?>

                                    </ul>
                                </li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Céréales', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($cereale as $cer) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($cer['titreonglet'], '/statiques/pages/' . $cer['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($cereale)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($cer['titreonglet'], '/statiques/pages/' . $cer['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($cer['titreonglet'], '/statiques/pages/' . $cer['id'], array('escape' => false)); ?></li>
                                            <?php } ?>
                                            <?php $i++;
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Protéines', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($prot as $pro) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($pro['titreonglet'], '/statiques/pages/' . $pro['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($prot)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($pro['titreonglet'], '/statiques/pages/' . $pro['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($pro['titreonglet'], '/statiques/pages/' . $pro['id'], array('escape' => false)); ?></li>
                                            <?php } ?>
                                            <?php $i++;
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Produits Laitiers', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($lait as $lai) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($lai['titreonglet'], '/statiques/pages/' . $lai['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($lait)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($lai['titreonglet'], '/statiques/pages/' . $lai['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($lai['titreonglet'], '/statiques/pages/' . $lai['id'], array('escape' => false)); ?></li>
                                            <?php } ?>
                                            <?php $i++;
                                        }
                                        ?>
                                    </ul>
                                </li>
                                <li class="dropdown-last"><?php echo $this->Html->link('Matières grasses', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
<?php
$i = 0;
foreach ($matG as $mat) {
    if ($i == 0) {
        echo '<li class="dropdown-first">' . $this->Html->link($mat['titreonglet'], '/statiques/pages/' . $mat['id'], array('escape' => false)) . '</li>';
    } elseif ($i + 1 == count($matG)) {
        echo '<li class="dropdown-last">' . $this->Html->link($mat['titreonglet'], '/statiques/pages/' . $mat['id'], array('escape' => false)) . '</li>';
    } else {
        ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($mat['titreonglet'], '/statiques/pages/' . $mat['id'], array('escape' => false)); ?></li>
                                            <?php } ?>
                                            <?php $i++;
                                        }
                                        ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><?php echo $this->Html->link('Gestion pondérale', 'Javascript:void(0);'); ?>
                            <ul class="dropdown">
                                <li class="dropdown-first"><?php echo $this->Html->link('Gestion pondérale', 'Javascript:void(0);'); ?>				
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($Pond as $ponde) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($ponde['titreonglet'], '/statiques/pages/' . $ponde['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($ActPh)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($ponde['titreonglet'], '/statiques/pages/' . $ponde['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($ponde['titreonglet'], '/statiques/pages/' . $ponde['id'], array('escape' => false)); ?></li>
    <?php } ?>
    <?php $i++;
}
?>
                                    </ul>
                                </li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Calories', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                        <?php
                                        $i = 0;
                                        foreach ($calories as $cal) {
                                            if ($i == 0) {
                                                echo '<li class="dropdown-first">' . $this->Html->link($cal['titreonglet'], '/statiques/pages/' . $cal['id'], array('escape' => false)) . '</li>';
                                            } elseif ($i + 1 == count($calories)) {
                                                echo '<li class="dropdown-last">' . $this->Html->link($cal['titreonglet'], '/statiques/pages/' . $cal['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($cal['titreonglet'], '/statiques/pages/' . $cal['id'], array('escape' => false)); ?></li>
    <?php } ?>
    <?php $i++;
}
?>
                                    </ul>
                                </li>
                                <li class="dropdown-last"><?php echo $this->Html->link('Ressources', 'Javascript:void(0);'); ?>
                                    <ul class="dropdown">
                                <?php
                                $i = 0;
                                foreach ($ressources as $ress) {
                                    if ($i == 0) {
                                        echo '<li class="dropdown-first">' . $this->Html->link($ress['titreonglet'], '/statiques/pages/' . $ress['id'], array('escape' => false)) . '</li>';
                                    } elseif ($i + 1 == count($ressources)) {
                                        echo '<li class="dropdown-last">' . $this->Html->link($ress['titreonglet'], '/statiques/pages/' . $ress['id'], array('escape' => false)) . '</li>';
                                    } else {
                                        ?>
                                                <li class="dropdown-middle"><?php echo $this->Html->link($ress['titreonglet'], '/statiques/pages/' . $ress['id'], array('escape' => false)); ?></li>
    <?php } ?>
    <?php $i++;
}
?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li><?php echo $this->Html->link('Activité physique', 'Javascript:void(0);'); ?>
                            <ul class="dropdown">
<?php
$i = 0;
foreach ($ActPh as $phys) {
    if ($i == 0) {
        echo '<li class="dropdown-first">' . $this->Html->link($phys['titreonglet'], '/statiques/pages/' . $phys['id'], array('escape' => false)) . '</li>';
    } elseif ($i + 1 == count($ActPh)) {
        echo '<li class="dropdown-last">' . $this->Html->link($phys['titreonglet'], '/statiques/pages/' . $phys['id'], array('escape' => false)) . '</li>';
    } else {
        ?>
                                        <li class="dropdown-middle"><?php echo $this->Html->link($phys['titreonglet'], '/statiques/pages/' . $phys['id'], array('escape' => false)); ?></li>
                        <?php } ?>
                            <?php $i++;
                        }
                        ?>
                            </ul>
                        </li>

                        <li><?php echo $this->Html->link('Mon tuteur', '/tuteurs'); ?>
                        </li>
                        <li><?php echo $this->Html->link('Ressources', '/imcenfants'); ?>
                            <ul class="dropdown">
                                <li class="dropdown-first"><?php echo $this->Html->link('Articles', '/articles/recherche?s='); ?></li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Calculateur IMC', '/imcenfants'); ?></li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Super Traqueur', '/pages/supertracker'); ?></li>
                                <li class="dropdown-middle"><?php echo $this->Html->link('Jackpot Santé', '/pages/jackpotsante'); ?></li>
                                <li class="dropdown-last"><?php echo $this->Html->link('Mon journal', '/carnets/'); ?></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
                <div id="profil">
            <?php if (AuthComponent::user('id') == NULL): ?>
                        <div id="logo-connexion"> Créer profil</div>
                        <div id='liens'>
                <?php echo $this->Html->link('Créer mon profil', '/users/add'); ?>
                            <br>
    <?php echo $this->Html->link('ou me connecter', '/users/login', array('id' => 'connexionLink')); ?>
                        </div>
<?php else: ?>
                        <div id='liens'>
    <?php echo $this->Html->link('Bonjour ' . AuthComponent::user('username'), '/users'); ?>
                            <br>
    <?php echo $this->Html->link('me déconnecter', '/users/logout', array('id' => 'connexionLink')); ?>
                        </div>
<?php endif; ?>
                    <p class="ui-state-default ui-corner-all" id="searchIcon"><span class="ui-icon ui-icon-search"></span></p>
                </div>

<?php echo $this->Form->create(null, array('type' => 'get', 'action' => '../recherches/recherche', 'id' => 'searchForm', 'class' => 'searchform')); ?>
                <input type="submit" class="icon-search"/>
                <label>
                    <input type="text" name="s" value="" placeholder="Rechercher sur mapyramide.fr">
                </label>
                </form>

            </div>
        </header>

        <div id="content">

<?php echo debug($this->Session->flash()); ?>

<?php echo $this->fetch('content'); ?>


        </div>

        <footer>
            <div class="bloc-gauche">
                <p><?php echo $this->Html->link('Plan du Site', '/pages/sitemap'); ?> | <?php echo $this->Html->link('ChooseMyPlate', 'http://www.choosemyplate.gov/'); ?>  | <?php echo $this->Html->link('MangerBouger', 'http://www.mangerbouger.fr/pnns/'); ?>  </p>
            </div>
            <div class="bloc-droit">
                <pre><a>FAQ</a>   <?php echo $this->Html->link('Mentions Légales', '/pages/mentionslegales'); ?>  <?php echo $this->Html->link('Contacts', '/pages/contacts'); ?></pre>
                <p> - Association Gradient  2013© - </p>
            </div>
        </footer>




    </body>
</html>
