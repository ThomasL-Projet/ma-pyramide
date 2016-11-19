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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo h($this->fetch('title')); ?></title>
        <?php echo $this->fetch('meta'); ?>


        <?php
        echo $this->Html->meta('favicon.ico', '/img/logo/LOGOICONEnoir.ico', array(
            'type' => 'icon'
        ));
        // ----------- Intégration du header et du footer avec foundation ------------
        // 
        // JQuery js et foundation js
        echo $this->Html->script('jquery.min');
        // Utile pour le datepicker par exemple, potentiellement utilisable pour d'autre composant
        echo $this->Html->script('http://code.jquery.com/ui/1.11.4/jquery-ui.js');
        echo $this->Html->script('foundation.min');
        echo $this->Html->script('vendor/fastclick.js');
        echo $this->Html->script('vendor/modernizr.js');



        // css et script de pizza Amore
        echo $this->Html->css('/js/pizza-master/dist/css/pizza');

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
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-75615248-1', 'auto');
            ga('send', 'pageview');

        </script>
        <!-- Google Analytics -->
        <script>
            window.ga = window.ga || function () {
                (ga.q = ga.q || []).push(arguments)
            };
            ga.l = +new Date;
            ga('create', 'UA-75615248-1', 'auto');
            ga('send', 'pageview');
        </script>
        <script async src='//www.google-analytics.com/analytics.js'></script>
        <!-- End Google Analytics -->
    </head>
    <body>
        <?php // code de suivi google analytics temporaire (DEV) ?> 

        <header>

            <div id='nomEtLogo' class="show-for-large-up" style="background: #eeeeee; /* Old browsers */
                 background: -moz-linear-gradient(top, #eeeeee 0%, #cccccc 100%); /* FF3.6-15 */
                 background: -webkit-linear-gradient(top, #eeeeee 0%,#cccccc 100%); /* Chrome10-25,Safari5.1-6 */
                 background: linear-gradient(to bottom, #eeeeee 0%,#cccccc 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
                 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#eeeeee', endColorstr='#cccccc',GradientType=0 ); /* IE6-9 */">

                <?php
                echo $this->Html->image('logo/LOGOFINAL.png', ['alt' => 'Logo',
                    'id' => 'logo',
                    'url' => ['controller' => 'pages',
                        'action' => 'home',
                        'full_base' => true]]
                );
                ?>

                <?php
                echo $this->Html->image('logo/headernew.png', ['alt' => 'Titre accrocheur',
                    'id' => 'logotexte',
                    'url' => ['controller' => 'pages',
                        'action' => 'home',
                        'full_base' => true]]
                );
                ?>

            </div>
            <div class="sticky">
                <!-- menu pour les ordinateurs et écrans relativement grand -->
                <nav class="top-bar show-for-large-up" data-topbar role="navigation">

                    <section class="top-bar-section">  
                        <ul class="left">
                            <li class="name">
                                <?php
                                echo $this->Html->link('Accueil', ['controller' => 'pages',
                                    'action' => 'home',
                                    'full_base' => true], ['style' => 'color: #fff;display: block;font-family: "Helvetica Neue",Helvetica,Roboto,Arial,sans-serif;font-size: 0.8125rem;font-weight: normal; line-height: 2.8125rem;padding-left:10px;padding-right:10px;']
                                );
                                ?>
                            </li> 
                            <li class="divider"></li>      
                            <li class="has-dropdown not-click">
                                <?php
                                echo $this->Html->link('Mon dossier', ['controller' => 'monDossier',
                                    'action' => 'index',
                                    'full_base' => true]
                                );
                                ?>
                                <ul class="dropdown">


                                    <li class="dropdown-middle">
                                        <?php
                                        echo $this->Html->link('Mes données santé', ['controller' => 'monDossier',
                                            'action' => 'mesdonneessante',
                                            'full_base' => true]
                                        );
                                        ?>
                                    </li>
                                    <li class="dropdown-middle">
                                        <?php
                                        echo $this->Html->link('Mes simulations', ['controller' => 'pages',
                                            'action' => 'jackpotsante',
                                            'full_base' => true]
                                        );
                                        ?>
                                    </li>
                                    <li class="dropdown-last">
                                        <?php
                                        echo $this->Html->link('Mes réglages', ['controller' => 'monDossier',
                                            'action' => 'reglages',
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
                            <li class="not-click">
                                <?php
                                echo $this->Html->link('Mon diététicien', ['controller' => 'tuteurs',
                                    'action' => 'index',
                                    'full_base' => true]
                                );
                                ?>
                            </li>
                            <li class="has-dropdown not-click">
                                <?php
                                echo $this->Html->link('La diététique', array(
                                    'controller' => 'pages',
                                    'action' => 'dietetique',
                                    'full_base' => true
                                        )
                                );
                                ?>
                                <ul class="dropdown">
                                    <li><label>Les 3 points principaux</label></li>
                                    <li class="has-dropdown not-click"> 
                                        <?php
                                        echo $this->Html->link('Les aliments', array(
                                            'controller' => 'pages',
                                            'action' => 'groupesalimentaires',
                                            'full_base' => true
                                                )
                                        );
                                        ?> 
                                        <ul class="dropdown">
                                            <li><label>Les 6 groupes alimentaires</label></li>
                                            <li class="dropdown-first">
                                                <?php
                                                echo $this->Html->link('Fruits', array(
                                                    'controller' => 'pages',
                                                    'action' => 'fruits',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li>
                                            <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link('Légumes', array(
                                                    'controller' => 'pages',
                                                    'action' => 'legumes',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li>
                                            <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link('Céréales', array(
                                                    'controller' => 'pages',
                                                    'action' => 'cereales',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?>
                                            </li>
                                            <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link('Protéines', array(
                                                    'controller' => 'pages',
                                                    'action' => 'proteines',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li>
                                            <li class="dropdown-middle">
                                                <?php
                                                echo $this->Html->link('Produits Laitiers', array(
                                                    'controller' => 'pages',
                                                    'action' => 'produitslaitiers',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?>  
                                            </li>
                                            <li class="dropdown-last">
                                                <?php
                                                echo $this->Html->link('Matières grasses', array(
                                                    'controller' => 'pages',
                                                    'action' => 'matieresgrasses',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li> 

                                        </ul>
                                    </li>

                                    <li class="has-dropdown not-click"> 
                                        <?php
                                        echo $this->Html->link('La gestion pondérale', array(
                                            'controller' => 'pages',
                                            'action' => 'gestionponderale',
                                            'full_base' => true
                                                )
                                        );
                                        ?> 
                                        <ul class="dropdown">
                                            <li class="dropdown-first">
                                                <?php
                                                echo $this->Html->link('En général', array(
                                                    'controller' => 'pages',
                                                    'action' => 'gpgeneral',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li>
                                            <li class="dropdown-last">
                                                <?php
                                                echo $this->Html->link('Les calories', array(
                                                    'controller' => 'pages',
                                                    'action' => 'calories',
                                                    'full_base' => true
                                                        )
                                                );
                                                ?> 
                                            </li>
                                        </ul>                                  
                                    </li>
                                    <li class="dropdown-middle"> 
                                        <?php
                                        echo $this->Html->link('Les activités physiques', array(
                                            'controller' => 'pages',
                                            'action' => 'activitesphysiques',
                                            'full_base' => true
                                                )
                                        );
                                        ?>                                                     
                                    </li>
                                    <li><label>Autres ressources</label></li>
                                    <li class="dropdown-last"> 
                                        <?php
                                        echo $this->Html->link('Dépistage microbiote', ['controller' => 'depistages',
                                            'action' => 'index',
                                            'full_base' => true]
                                        );
                                        ?>                                              
                                    </li>
                                    <li class="dropdown-last">
                                        <?php
                                        echo $this->Html->link('Encyclopédie alimentaire', array(
                                            'controller' => 'aliments',
                                            'action' => 'index',
                                            'full_base' => true
                                                )
                                        );
                                        ?> 
                                    </li>
                                    <li class="dropdown-last"> 
                                        <?php
                                        echo $this->Html->link('Calculateur IMC', ['controller' => 'imcenfants',
                                            'action' => 'index',
                                            'full_base' => true]
                                        );
                                        ?>                                              
                                    </li>

                                </ul>
                            </li>
                            <li class="has-dropdown not-click">
                                <?php echo $this->Html->link('Sujets d\'intérêt général', 'Javascript:void(0);'); ?>
                                <ul class="dropdown">
                                    <li class="dropdown-first">
<?php
echo $this->Html->link('Les articles', ['controller' => 'articles',
    'action' => 'index',
    'full_base' => true]
);
?>
                                    </li>

                                    <li class="dropdown-last">
<?php
echo $this->Html->link('Les actualités', ['controller' => 'actualites',
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
                                <ul class="inline-list collapse">

<?php
echo $this->Form->create("Recherche", ['type' => 'get',
    'url' => array('controller' => 'recherches', 'action' => 'recherche'),
    'id' => 'searchForm',
    'class' => 'searchform']);
?>      

                                    <li>

<?php
echo $this->Form->input("slbl", array('label' => false,
    'name' => 's',
    'placeholder' => '...',
    'type' => 'text'
));
?>

                                    </li>
                                    <li>
<?php
if (isset($page_cours)) {
    switch ($page_cours) {
        case 'violet':
            ?>
                                                    <button type="submit" class="button expand" id="rechercheViolet" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                    <?php
                                                    break;
                                                case 'bleu':
                                                    ?>
                                                    <button type="submit" class="button expand" id="rechercheBleu" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                    <?php
                                                    break;
                                                case 'vert':
                                                    ?>
                                                    <button type="submit" class="button expand" id="rechercheVert" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                    <?php
                                                    break;
                                                case 'jaune':
                                                    ?>
                                                    <button type="submit" class="button expand" id="rechercheJaune" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                    <?php
                                                    break;
                                                case 'rouge':
                                                    ?>
                                                    <button type="submit" class="button expand" id="rechercheRouge" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                    <?php
                                                    break;
                                                default:
                                                    break;
                                            }
                                        } else {
                                            echo $this->Form->button('Rechercher', ['value' => 'Recherche',
                                                'class' => 'button expand',
                                                'id' => 'recherche',
                                                'type' => 'submit'
                                            ]);
                                        }
                                        ?>                                 
                                    </li>

<?php echo $this->Form->end(); ?>
                                </ul>

                            </li>

<?php if (AuthComponent::user('role') == 'administrateur'): ?>
                                <li class="divider"></li>
                                <li class="has-dropdown not-click">
    <?php echo $this->Html->link('Administration', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?>
                                    <ul class="dropdown">
                                        <li class="dropdown-first"><?php echo $this->Html->link('Gérer les photos', '/pages/choixphoto'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Gérer les articles', '/articles'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Gérer les actualités', '/actualites'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Gérer les utilisateurs', '/users'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Statistiques du site', '/stats/visite'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Gérer les liens', '/liens'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Édition des pages', '/statiques'); ?></li>
                                        <li class="dropdown-last"><?php echo $this->Html->link('Gérer les constantes', '/constantes'); ?></li>
                                    </ul>
                                </li>
<?php elseif (AuthComponent::user('role') == 'dieteticien'): ?>
                                <li class="divider"></li>
                                <li class="has-dropdown not-click">
    <?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?>
                                    <ul class="dropdown">
                                        <li class="dropdown-first"><?php echo $this->Html->link('Voir les demandes clients', '/demandes'); ?></li>
                                        <li class="dropdown-middle"><?php echo $this->Html->link('Voir mes messages', '/demandes/messages'); ?></li>
                                        <li class="dropdown-last"><?php echo $this->Html->link('Suivis de mes clients', '/demandes/suivis'); ?></li>
                                    </ul>
<?php endif; ?>

                            <li class="divider"></li>

                            <li class="has-dropdown not-click">
<?php
if (AuthComponent::user('id') == NULL):
    echo $this->Html->link("<i class='fi-torso large'></i>"
            . ' Mon profil', 'Javascript:void(0);', ['escape' => false]);
else:
    echo $this->Html->link('Bonjour ' . AuthComponent::user('username')
            , 'Javascript:void(0);'
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
                            </li>
                        </ul>

                    </section>

                </nav>
            </div>

            <div  class="off-canvas-wrap" data-offcanvas>
                <div class="inner-wrap">
                    <!-- menu pour les téléphones et appareil avec un écran relativement petit -->
                    <div class="sticky">
                        <nav class="tab-bar show-for-medium-down"  >
                            <section class="left-small">
                                <a class="left-off-canvas-toggle menu-icon"><span></span></a>
                            </section>
                            <section class="middle tab-bar-section">
                                <span class="title"><h1> <a href="/mapyramide/" id="titreTabBar">Ma pyramide santé</a></h1></span>
                            </section>
                            <section class="right-small">
                                <a class="right-off-canvas-toggle"><span><i class="fi-torso large"></i></span></a>
                            </section>
                        </nav>
                    </div>


                    <aside class="left-off-canvas-menu show-for-medium-down" >
                        <ul class="off-canvas-list">  
                            <li><label>Navigation</label></li>
                            <li>
<?php
echo $this->Html->link('Accueil', ['controller' => 'pages',
    'action' => 'home',
    'full_base' => true]
);
?>
                            </li>         

                            <li class="has-submenu">
<?php
echo $this->Html->link('Mon dossier patient', ['controller' => 'monDossier',
    'action' => 'index',
    'full_base' => true]
);
?>
                                <ul class="left-submenu">
                                    <li class="back"><a href="#">Retour</a></li>

                                    <li>
<?php
echo $this->Html->link('Mon tableau de bord', ['controller' => 'monDossier',
    'action' => 'montableaudebord',
    'full_base' => true]
);
?>
                                    </li>
                                    <li>
<?php
echo $this->Html->link('Mes simulations', ['controller' => 'pages',
    'action' => 'jackpotsante',
    'full_base' => true]
);
?>
                                    </li>
                                    <li>
<?php
echo $this->Html->link('Mes réglages', ['controller' => 'monDossier',
    'action' => 'reglages',
    'full_base' => true]
);
?>
                                    </li>
                                    <li>
<?php
echo $this->Html->link('Mon journal', ['controller' => 'carnets',
    'action' => 'index',
    'full_base' => true]
);
?>
                                    </li>

                                </ul>
                            </li>
                            <li>
<?php
echo $this->Html->link('Mon diététicien', ['controller' => 'tuteurs',
    'action' => 'index',
    'full_base' => true]
);
?>

                            </li>

                            <li class="has-submenu">
<?php
echo $this->Html->link('La diététique', ['controller' => 'pages',
    'action' => 'dietetique',
    'full_base' => true]
);
?>
                                <ul class="left-submenu">
                                    <li class="back"><a href="#">Retour</a></li>
                                    <li class="has-submenu">
<?php
echo $this->Html->link('Les aliments', array(
    'controller' => 'pages',
    'action' => 'groupesalimentaires',
    'full_base' => true
        )
);
?> 

                                        <ul class="left-submenu">
                                            <li class="back"><a href="#">Retour</a></li>
                                            <li>
<?php
echo $this->Html->link('Fruits', array(
    'controller' => 'pages',
    'action' => 'fruits',
    'full_base' => true
        )
);
?> 
                                            </li>
                                            <li>
<?php
echo $this->Html->link('Légumes', array(
    'controller' => 'pages',
    'action' => 'legumes',
    'full_base' => true
        )
);
?> 
                                            </li>
                                            <li>
<?php
echo $this->Html->link('Céréales', array(
    'controller' => 'pages',
    'action' => 'cereales',
    'full_base' => true
        )
);
?>
                                            </li>
                                            <li>
<?php
echo $this->Html->link('Protéines', array(
    'controller' => 'pages',
    'action' => 'proteines',
    'full_base' => true
        )
);
?> 
                                            </li>
                                            <li>
<?php
echo $this->Html->link('Produits Laitiers', array(
    'controller' => 'pages',
    'action' => 'produitslaitiers',
    'full_base' => true
        )
);
?>  
                                            </li>
                                            <li>
<?php
echo $this->Html->link('Matières grasses', array(
    'controller' => 'pages',
    'action' => 'matieresgrasses',
    'full_base' => true
        )
);
?> 
                                            </li> 
                                        </ul>
                                    </li>
                                    <li class="has-submenu">
<?php
echo $this->Html->link('La gestion pondérale', array(
    'controller' => 'pages',
    'action' => 'groupesalimentaires',
    'full_base' => true
        )
);
?> 
                                        <ul class="left-submenu">
                                            <li class="back"><a href="#">Retour</a></li>
                                            <li>
<?php
echo $this->Html->link('En général', array(
    'controller' => 'pages',
    'action' => 'gpgeneral',
    'full_base' => true
        )
);
?>  

                                            </li>
                                            <li>
<?php
echo $this->Html->link('Les calories', array(
    'controller' => 'pages',
    'action' => 'calories',
    'full_base' => true
        )
);
?> 
                                            </li>
                                        </ul>
                                    </li>
                                    <li>

<?php
echo $this->Html->link('Calculateur IMC', ['controller' => 'imcenfants',
    'action' => 'index',
    'full_base' => true]
);
?>

                                    </li>
                                    <li>
<?php
echo $this->Html->link('Les activités physiques', ['controller' => 'pages',
    'action' => 'activitesphysiques',
    'full_base' => true]
);
?>                                                 
                                    </li>
                                </ul>
                            </li>
                            <li class="has-submenu">
<?php echo $this->Html->link('La gazette', 'Javascript:void(0);'); ?>
                                <ul class="left-submenu">
                                    <li class="back"><a href="#">Retour</a></li>
                                    <li>
<?php
echo $this->Html->link('Les articles', ['controller' => 'articles',
    'action' => 'index',
    'full_base' => true]
);
?>
                                    </li>

                                    <li>
<?php
echo $this->Html->link('Les actualités', ['controller' => 'actualites',
    'action' => 'index',
    'full_base' => true]
);
?>
                                    </li>
                                </ul>
                            </li>
                            <li><label>Effectuer une recherche</label></li>
                            <li class="has-form">
                                <div class="row collapse">
                                    <div class="small-12 large-centered columns">
<?php
echo $this->Form->create(null, ['type' => 'get',
    'action' => '../recherches/recherche',
    'id' => 'searchForm',
    'class' => 'searchform']);
?>      


                                        <div class="large-9 columns">                            
<?php
echo $this->Form->input("slbl", array('label' => false,
    'name' => 's',
    'placeholder' => '...',
    'type' => 'text'
));
?>
                                        </div>
                                        <div class="large-3 columns"> 
                                            <?php
                                            if (isset($page_cours)) {
                                                switch ($page_cours) {
                                                    case 'violet':
                                                        ?>
                                                        <button type="submit" class="button expand" id="rechercheViolet" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                        <?php
                                                        break;
                                                    case 'bleu':
                                                        ?>
                                                        <button type="submit" class="button expand" id="rechercheBleu" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                        <?php
                                                        break;
                                                    case 'vert':
                                                        ?>
                                                        <button type="submit" class="button expand" id="rechercheVert" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                        <?php
                                                        break;
                                                    case 'jaune':
                                                        ?>
                                                        <button type="submit" class="button expand" id="rechercheJaune" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                        <?php
                                                        break;
                                                    case 'rouge':
                                                        ?>
                                                        <button type="submit" class="button expand" id="rechercheRouge" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                        <?php
                                                        break;
                                                    default:
                                                        break;
                                                }
                                            } else {
                                                ?>
                                                <button type="submit" class="button expand" id="rechercheErreur" value="Recherche"><i class="fi-magnifying-glass"></i></button>
                                                <?php
                                            }
                                            ?>

                                        </div>
                                            <?php echo $this->Form->end(); ?>
                                    </div>
                                </div>
                            </li>  
                        </ul>
                    </aside>

                    <aside class="right-off-canvas-menu show-for-medium-down" >
                        <ul class="off-canvas-list">
                            <li>
                                <label>
<?php
if (AuthComponent::user('id') == NULL):
    ?>    
                                        Mon profil
                                        <?php
                                    else:
                                        ?>                   
                                        Bonjour <?php echo AuthComponent::user('username') ?>                         
                                    <?php
                                    endif;
                                    ?>
                                </label>
                            </li>
                                    <?php if (AuthComponent::user('role') == 'administrateur'): ?>
                                <li class="has-submenu"><?php echo $this->Html->link('Administration', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?> 
                                    <ul class="right-submenu">
                                        <li class="back"><a href="#">Retour</a></li>
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
                                <li class="has-submenu"> <?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?>
                                    <ul class="right-submenu">
                                        <li class="back"><a href="#">Retour</a></li>
                                        <li><?php echo $this->Html->link('Voir les demandes clients', '/demandes'); ?></li>
                                        <li><?php echo $this->Html->link('Voir mes messages', '/demandes/messages'); ?></li>
                                        <li><?php echo $this->Html->link('Suivis de mes clients', '/demandes/suivis'); ?></li>
                                    </ul>
                                </li>
<?php endif; ?>

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

                    </aside>
                    <div class="sticky">
<?php
if (isset($page_cours)) {
    switch ($page_cours) {
        case 'violet':
            echo "<hr id='barreViolet'>";
            break;
        case 'bleu':
            echo "<hr id='barreBleu'>";
            break;
        case 'vert':
            echo "<hr id='barreVert'>";
            break;
        case 'jaune':
            echo "<hr id='barreJaune'>";
            break;
        case 'rouge':
            echo "<hr id='barreRouge'>";
            break;
        default:
            break;
    }
} else {
    echo "Erreur couleur barre à modifier";
}
?>
                    </div>
                    <section class="main-section">

                        <noscript>
                        <div class="row">
                            <div class="small-10 medium-10 large-10 small-centered medium-centered large-centered columns">
                                <div data-alert class="alert-box warning radius">
                                    Pour accéder à toutes les fonctionnalités de ce site, vous devez activer JavaScript.
                                    Voici les <a style="color:blue;" href="http://www.enable-javascript.com/fr/" target="_blank">
                                        instructions pour activer JavaScript dans votre navigateur Web</a>.
                                </div>
                            </div>
                        </div>
                        </noscript>
                        <!-- Contenu de chaque page -->

<?php
echo $this->Session->flash();
echo $this->fetch('content');
?>

                    </section>

                    <a class="exit-off-canvas"></a>
                </div>
            </div>


        </header>    

        <footer class="footer">


            <div class="row">

                <div class="small-12 medium-6 large-5 columns">

                    <p class="logo"><i class="fi-target"></i> Ma pyramide santé</p> 

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
                        echo $this->Html->link('FAQ', ['controller' => 'pages',
                            'action' => 'faq',
                            'full_base' => true]);
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
        , 'https://www.facebook.com/profile.php?id=100011570981630'
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
