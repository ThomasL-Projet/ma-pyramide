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
        <title>Ma Pyramide Santé</title>


        <?php
        // ----------- Intégration du header et du footer avec foundation ------------
        // 
        // JQuery js et foundation js
        echo $this->Html->script('jquery.min.js');
        // Utile pour le datepicker par exemple, potentiellement utilisable pour d'autre composant
        echo $this->Html->script('http://code.jquery.com/ui/1.11.4/jquery-ui.js');
        echo $this->Html->script('foundation.min.js');
        echo $this->Html->script('vendor/fastclick.js');
        echo $this->Html->script('vendor/modernizr.js');

        // Ajout du slider slick et de ses dépendances (css)
        echo $this->Html->css('slick');
        echo $this->Html->css('slick-theme');
        // Ajout du css foundation ainsi que du script modernizr
        echo $this->Html->css('foundation.min');
        echo $this->Html->css('defaut');

        // jQuery css
        echo $this->Html->css('http://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css');

        // Ajout des icones foundation
        echo $this->Html->css('http://cdnjs.cloudflare.com/ajax/libs/foundicons/3.0.0/foundation-icons.css');
        ?>
    </head>

    <body>
        <header>
            <div id='nomEtLogo'>
                <?php echo $this->Html->link('<div id="AGD-logo">&nbsp;</div>', '/', array('escape' => false)); ?>
                <?php echo $this->Html->link('<div id="NomSite"> Ma Pyramide Santé </div>', '/', array('escape' => false)); ?>
            </div>   

            <nav class="top-bar" data-topbar role="navigation">
                <ul class="title-area">

                    <li class="name">
                        <h1>
                            <?php
                            echo $this->Html->link('Accueil', ['full_base' => true]);
                            ?>
                        </h1>
                    </li>        
                </ul>
                <section class="top-bar-section">  
                    <ul class="left">
                        <?php if (AuthComponent::user('role') == 'administrateur'): ?>
                            <li class="divider"></li>
                            <li class="has-dropdown not-click">
                                <?php echo $this->Html->link('Administration', 'Javascript:void(0);'); ?>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link('Gérer les photos', '/pages/choixphoto'); ?></li>
                                    <li><?php echo $this->Html->link('Gérer les articles', '/articles'); ?></li>
                                    <li><?php echo $this->Html->link('Gérer les actualités', '/actualites'); ?></li>
                                    <li><?php echo $this->Html->link('Gérer les utilisateurs', '/users'); ?></li>
                                    <li><?php echo $this->Html->link('Statistiques du site', '/stats/visite'); ?></li>
                                    <li><?php echo $this->Html->link('Gérer les liens', '/liens'); ?></li>
                                    <li><?php echo $this->Html->link('Édition des pages', '/statiques'); ?></li>
                                    <li><?php echo $this->Html->link('Gérer les constantes', '/constantes'); ?></li>
                                </ul>
                            </li>
                        <?php elseif (AuthComponent::user('role') == 'dieteticien'): ?>
                            <li class="divider"></li>
                            <li class="has-dropdown not-click">
                                <?php echo $this->Html->link('Diététicien', 'Javascript:void(0);'); ?>
                                <ul class="dropdown">
                                    <li><?php echo $this->Html->link('Demandes et infos clients', '/demandes'); ?></li>
                                    <li><?php echo $this->Html->link('Messages', '/demandes/messages'); ?></li>
                                    <li><?php echo $this->Html->link('Suivis de mes clients', '/demandes/suivis'); ?></li>
                                </ul>
                            <?php endif; ?>

                        <li class="divider"></li>                  
                        <li class="has-dropdown not-click">
                            <?php
                            echo $this->Html->link('Mes aliments', array(
                                'controller' => 'pages',
                                'action' => 'groupesalimentaires',
                                'full_base' => true
                                    )
                            );
                            ?>
                            <ul class="dropdown">
                                <li><label>Les 6 groupes alimentaires</label></li>
                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Fruits', array(
                                        'controller' => 'pages',
                                        'action' => 'fruits',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $f = 0;
                                        foreach ($fruit as $unFruit) {
                                            if ($f == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($unFruit['titreonglet'], '/statiques/pages/'
                                                        . $unFruit['id'], array('escape' => false)) . '</li>';
                                            } elseif ($f + 1 == count($fruit)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($unFruit['titreonglet'], '/statiques/pages/'
                                                        . $unFruit['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                    <?php
                                                    echo $this->Html->link($unFruit['titreonglet'], '/statiques/pages/'
                                                            . $unFruit['id'], array('escape' => false));
                                                    ?>
                                                </li>
                                                <?php
                                            }
                                            $f++;
                                        }
                                        ?>
                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Légumes', array(
                                        'controller' => 'pages',
                                        'action' => 'legumes',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $l = 0;
                                        foreach ($legume as $unLegume) {
                                            if ($l == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($unLegume['titreonglet'], '/statiques/pages/'
                                                        . $unLegume['id'], array('escape' => false)) . '</li>';
                                            } elseif ($l + 1 == count($legume)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($unLegume['titreonglet'], '/statiques/pages/'
                                                        . $unLegume['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                    <?php
                                                    echo $this->Html->link($unLegume['titreonglet'], '/statiques/pages/'
                                                            . $unLegume['id'], array('escape' => false));
                                                    ?>
                                                </li>
                                                <?php
                                            }
                                            $l++;
                                        }
                                        ?>

                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Céréales', array(
                                        'controller' => 'pages',
                                        'action' => 'cereales',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $c = 0;
                                        foreach ($cereale as $uneCereale) {
                                            if ($c == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($uneCereale['titreonglet'], '/statiques/pages/'
                                                        . $uneCereale['id'], array('escape' => false)) . '</li>';
                                            } elseif ($c + 1 == count($cereale)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($uneCereale['titreonglet'], '/statiques/pages/'
                                                        . $uneCereale['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                    <?php
                                                    echo $this->Html->link($uneCereale['titreonglet'], '/statiques/pages/'
                                                            . $uneCereale['id'], array('escape' => false));
                                                    ?>
                                                </li>
                                                <?php
                                            }
                                            $c++;
                                        }
                                        ?>

                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Protéines', array(
                                        'controller' => 'pages',
                                        'action' => 'proteines',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $p = 0;
                                        foreach ($prot as $uneProteine) {
                                            if ($p == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($uneProteine['titreonglet'], '/statiques/pages/'
                                                        . $uneProteine['id'], array('escape' => false)) . '</li>';
                                            } elseif ($p + 1 == count($prot)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($uneProteine['titreonglet'], '/statiques/pages/'
                                                        . $uneProteine['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link($uneProteine['titreonglet'], '/statiques/pages/'
                                                        . $uneProteine['id'], array('escape' => false));
                                                ?>
                                                </li>
                                                <?php
                                            }
                                            $p++;
                                        }
                                        ?>

                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Produits Laitiers', array(
                                        'controller' => 'pages',
                                        'action' => 'produitslaitiers',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $pl = 0;
                                        foreach ($lait as $unProduitLaitier) {
                                            if ($pl == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($unProduitLaitier['titreonglet'], '/statiques/pages/'
                                                        . $unProduitLaitier['id'], array('escape' => false)) . '</li>';
                                            } elseif ($pl + 1 == count($lait)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($unProduitLaitier['titreonglet'], '/statiques/pages/'
                                                        . $unProduitLaitier['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link($unProduitLaitier['titreonglet'], '/statiques/pages/'
                                                        . $unProduitLaitier['id'], array('escape' => false));
                                                ?>
                                                </li>
        <?php
    }
    $pl++;
}
?>

                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Matières Grasses', array(
                                        'controller' => 'pages',
                                        'action' => 'matieresgrasses',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $mg = 0;
                                        foreach ($matG as $uneMatiereGrasse) {
                                            if ($mg == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($uneMatiereGrasse['titreonglet'], '/statiques/pages/'
                                                        . $uneMatiereGrasse['id'], array('escape' => false)) . '</li>';
                                            } elseif ($mg + 1 == count($matG)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($uneMatiereGrasse['titreonglet'], '/statiques/pages/'
                                                        . $uneMatiereGrasse['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link($uneMatiereGrasse['titreonglet'], '/statiques/pages/'
                                                        . $uneMatiereGrasse['id'], array('escape' => false));
                                                ?>
                                                </li>
        <?php
    }
    $mg++;
}
?>

                                    </ul>                                  
                                </li>
                            </ul>
                        </li>

                        <li class="divider"></li>

                        <li class="has-dropdown not-click">
                                    <?php
                                    echo $this->Html->link('Gestion Pondérales', 'Javascript:void(0);');
                                    ?>
                            <ul class="dropdown">
                                <li class="has-dropdown not-click"> 
                                        <?php
                                        echo $this->Html->link('Gestion Pondérale', 'Javascript:void(0);');
                                        ?>
                                    <ul class="dropdown">
                                        <?php
                                        $gp = 0;
                                        foreach ($Pond as $uneGestionPonderale) {
                                            if ($gp == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($uneGestionPonderale['titreonglet'], '/statiques/pages/'
                                                        . $uneGestionPonderale['id'], array('escape' => false)) . '</li>';
                                            } elseif ($gp + 1 == count($Pond)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($uneGestionPonderale['titreonglet'], '/statiques/pages/'
                                                        . $uneGestionPonderale['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link($uneGestionPonderale['titreonglet'], '/statiques/pages/'
                                                        . $uneGestionPonderale['id'], array('escape' => false));
                                                ?>
                                                </li>
        <?php
    }
    $gp++;
}
?>
                                    </ul>      

                                </li>

                                <li class="has-dropdown not-click"> 
                                    <?php
                                    echo $this->Html->link('Calories', array(
                                        'controller' => 'pages',
                                        'action' => 'calories',
                                        'full_base' => true
                                            )
                                    );
                                    ?> 
                                    <ul class="dropdown">
                                        <?php
                                        $ca = 0;
                                        foreach ($calories as $uneCalorie) {
                                            if ($ca == 0) {
                                                echo '<li class="dropdown-first">'
                                                . $this->Html->link($uneCalorie['titreonglet'], '/statiques/pages/'
                                                        . $uneCalorie['id'], array('escape' => false)) . '</li>';
                                            } elseif ($ca + 1 == count($calories)) {
                                                echo '<li class="dropdown-last">'
                                                . $this->Html->link($uneCalorie['titreonglet'], '/statiques/pages/'
                                                        . $uneCalorie['id'], array('escape' => false)) . '</li>';
                                            } else {
                                                ?>
                                                <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link($uneCalorie['titreonglet'], '/statiques/pages/'
                                                        . $uneCalorie['id'], array('escape' => false));
                                                ?>
                                                </li>
        <?php
    }
    $ca++;
}
?>
                                    </ul>      

                                </li>          

                            </ul>

                        </li>

                        <li class="divider"></li>

                        <li class="has-dropdown not-click">
                                <?php
                                echo $this->Html->link('Activité Physique', 'Javascript:void(0);');
                                ?>
                            <ul class="dropdown">
                                <?php
                                $ap = 0;
                                foreach ($ActPh as $uneActivitePhysique) {
                                    if ($ap == 0) {
                                        echo '<li class="dropdown-first">'
                                        . $this->Html->link($uneActivitePhysique['titreonglet'], '/statiques/pages/'
                                                . $uneActivitePhysique['id'], array('escape' => false)) . '</li>';
                                    } elseif ($ap + 1 == count($ActPh)) {
                                        echo '<li class="dropdown-last">'
                                        . $this->Html->link($uneActivitePhysique['titreonglet'], '/statiques/pages/'
                                                . $uneActivitePhysique['id'], array('escape' => false)) . '</li>';
                                    } else {
                                        ?>
                                        <li class="dropdown-middle">
                                        <?php
                                        echo $this->Html->link($uneActivitePhysique['titreonglet'], '/statiques/pages/'
                                                . $uneActivitePhysique['id'], array('escape' => false));
                                        ?>
                                        </li>
        <?php
    }
    $ap++;
}
?>                                                                    
                            </ul>
                        </li>

                        <li class="divider"></li>



                        <li class="divider"></li>

                        <li class="has-dropdown not-click">
                                    <?php
                                    echo $this->Html->link('Ressources', '#');
                                    ?>
                            <ul class="dropdown">
                                <li class="dropdown-first">
                                    <?php
                                    echo $this->Html->link('Articles', ['controller' => 'articles',
                                        'action' => 'index',
                                        'full_base' => true]
                                    );
                                    ?>
                                </li>
                                <li class="dropdown-middle">
                                    <?php
                                    echo $this->Html->link('Calculateur IMC', ['controller' => 'imcenfants',
                                        'action' => 'index',
                                        'full_base' => true]
                                    );
                                    ?>
                                </li>
                                <li class="dropdown-middle">
                                    <?php
                                    echo $this->Html->link('SuperTracker', ['controller' => 'pages',
                                        'action' => 'supertracker',
                                        'full_base' => true]
                                    );
                                    ?>
                                </li>
                                <li class="dropdown-middle">
                                    <?php
                                    echo $this->Html->link('Jackpot Santé', ['controller' => 'pages',
                                        'action' => 'jackpotsante',
                                        'full_base' => true]
                                    );
                                    ?>
                                </li>
                                <li class="dropdown-last">
<?php
echo $this->Html->link('Mon journal', ['controller' => 'carnets',
    'action' => 'index',
    'full_base' => true]
);
?>
                                </li>
                            </ul>                 

                        </li>
                        <li class="divider"></li>
                    </ul>
                    <ul class="right">

                        <li class="divider"></li>

                        <li class="has-form">                 

                            <div class="row collapse"> 


                                <!--<div class="large-8 small-9 columns">    -->
                                <?php
                                echo $this->Form->create(null, ['type' => 'get',
                                    'action' => '../recherches/recherche',
                                    'id' => 'searchForm',
                                    'class' => 'searchform']);
                                ?>                            
                                    <?php
                                    echo $this->Form->input("slbl", array('label' => false,
                                        'name' => 's',
                                        'placeholder' => '...',
                                        'type' => 'text',
                                        'div' => array('class' => 'large-8 small-9 columns')));
                                    ?>

                                <div class="large-4 small-3 columns"> 
<?php
echo $this->Form->button('Rechercher', ['value' => 'Recherche',
    'class' => 'button expand',
    'type' => 'submit'
]);
?>
                                </div>  
<?php echo $this->Form->end(); ?>
                                <!--<div class="large-4 small-3 columns">-->

                                <!--a href="#" class="button expand"> Rechercher </a>-->


                                <!--</div> -->
                            </div>

                        </li>




                        <li class="divider"></li>

                        <li class="has-dropdown not-click">
                                    <?php
                                    if (AuthComponent::user('id') == NULL):
                                        echo $this->Html->link("<i class='fi-torso large'></i>"
                                                . ' Mon profil', 'Javascript:void(0);', ['escape' => false]);
                                    else:
                                        echo $this->Html->link('Bonjour ' . AuthComponent::user('username')
                                                , ['controller' => 'users',
                                            'action' => 'index',
                                            'full_base' => true]
                                        );
                                    endif;
                                    ?>
                            <ul class="dropdown">
                                <li>
                                    <?php
                                    if (AuthComponent::user('id') == NULL):
                                        echo $this->Html->link('Créer mon profil', ['controller' => 'users',
                                            'action' => 'add',
                                            'full_base' => true]
                                        );
                                        ?>
                                    </li>
                                    <li>
                                        <?php
                                        echo $this->Html->link('Me connecter', ['controller' => 'users',
                                            'action' => 'login',
                                            'full_base' => true]
                                                , ['id' => 'connexionLink']
                                        );
                                        ?>
                                    </li>
                                    <li>
    <?php
else:
    echo $this->Html->link('Me déconnecter', ['controller' => 'users',
        'action' => 'logout',
        'full_base' => true]
            , ['id' => 'connexionLink']
    );
endif;
?>
                                </li>
                            </ul>             
                    </ul>
                </section>
            </nav>

        </header>

        <!-- Contenu de chaque page -->
        <div id="content">

<?php
echo $this->Session->flash();
echo $this->fetch('content');
?>

        </div>

        <footer class="footer">

            <div class="row">

                <div class="small-12 medium-6 large-5 columns">

                    <p class="logo"><i class="fi-target"></i> Ma pyramide</p> 

                    <p class="footer-links">

                        <?php
                        echo $this->Html->link('Accueil', ['full_base' => true]);
                        ?>

                        <?php
                        echo $this->Html->link('Plan du Site', ['controller' => 'pages',
                            'action' => 'sitemap',
                            'full_base' => true]);
                        ?>

                        <?php
                        echo $this->Html->link('Mentions Légales', ['controller' => 'pages',
                            'action' => 'mentionslegales',
                            'full_base' => true]);
                        ?>  

<?php
echo $this->Html->link('Contacts', ['controller' => 'pages',
    'action' => 'contacts',
    'full_base' => true]);
?>

                        <?php
                        // A faire page FAQ
                        echo $this->Html->link('FAQ', 'Javascript:void(0);');
                        ?>

                    </p>

                    <p class="copywrite">Copyright Association Gradient Diététique © 2015</p>

                    <p class="footer-links">

<?php
echo $this->Html->link('MangerBouger', 'http://www.mangerbouger.fr/pnns/');
?>  

<?php
echo $this->Html->link('ChooseMyPlate', 'http://www.choosemyplate.gov/');
?>  

                    </p>

                </div>

                <div class="small-12 medium-6 large-4 columns">

                    <ul class="contact">

                        <li><p><i class="fi-marker"></i>La Bessière, 48340 Saint Pierre De Nogaret, FRANCE</p></li>

                        <li><p><i class="fi-telephone"></i>0123456789</p></li>

                        <li><p><i class="fi-mail"></i>postmaster@mapyramide.fr</p></li>

                    </ul>

                </div>

                <div class="small-12 medium-12 large-3 columns">

                    <p class="about">À propos de AG Diététique (Association Gradient Diététique)</p>

                    <p class="about subheader">Nous sommes une association de diététique lozérienne.</p>

                    <ul class="inline-list social">

                        <!-- A revoir -->  
                        <li>
                            <?php
                            echo $this->Html->link("<i class='fi-social-facebook'></i>"
                                    , 'https://www.facebook.com/pages/Projet-MaPyramide/325996227589697'
                                    , ['escape' => false,
                                'target' => '_blank']
                            );
                            ?>
                        </li>
                        <li>
                            <?php
                            echo $this->Html->link("<i class='fi-social-twitter'></i>"
                                    , 'http://www.twitter.com'
                                    , ['escape' => false,
                                'target' => '_blank']
                            );
                            ?>
                        </li>
                        <li>
<?php
echo $this->Html->link("<i class='fi-social-youtube'></i>"
        , 'http://www.youtube.com'
        , ['escape' => false,
    'target' => '_blank']
);
?>
                        </li>

                    </ul>

                </div>

            </div>

        </footer>
        <script> jQuery(function () {
                jQuery(document).foundation();
            });</script>
    </body>
</html>
