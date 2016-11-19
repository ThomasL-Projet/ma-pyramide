<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mentions légales');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mentions légales', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mentions légales </div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <div class="row" style="text-align:center;">
                <hr/>
                <p>Implémentation des pages du site</p>
                <div class="small-12 columns">

                    <div class="row" data-equalizer>

                        <br/> 
                        <div class="small-6 columns" data-equalizer-watch>
                            <strong>2014/2015</strong>
                            <h4>Théo GRANIER<br/>Antoine ROSSI</h4>
                        </div>
                        <div class="small-6 columns" data-equalizer-watch>
                            <p><strong>2015/2016 </strong> </p>
                            <h4>Bastien ENJALBER<br/>Maxime BRUGEL<br/>Pauline FUZIER<br/>Pierre FRUGERE</h4>
                        </div>
                    </div>
                    <hr/>
                    <div class="row" style="text-align: center">
                        <div class="small-12 columns">
                            <p>Directeur de production </p>
                            <h2>Docteur André ALAUX</h2> 
                            <br/>
                            <hr/>
                            <p> Adresse du siège social  </p>
                            <h2>La Bessière,<br>48340 Saint Pierre De Nogaret<br>FRANCE</h2> 
                            <br/>
                            <hr/>
                            <p> Numéro de téléphone </p>
                            <h2>01.23.45.67.89</h2> 
                            <br/>
                            <hr/>
                            <p>Directeur de production </p>
                            <h2>Docteur André ALAUX</h2> 
                            <br/>
                            <hr/>
                            <p>Hébergement du site </p>
                            <h3>OVH Siège Social<br/>2 rue Kellermann</br>59100 Roubaix<br/>FRANCE</h3>
                            <hr/>
                        </div>
                    </div>
                </div>

                <br /><br/><br/>
                <h1>Propriété Intellectuelle</h1><br/>
            </div>
            <div class="row" data-equalizer>

                <div class="small-6 columns panel" data-equalizer-watch>
                    <h2>Données personnelles</h2>
                    <ul><li>Les données personnelles que nous pourrions être amenés à recueillir sont exclusivement destinées  à vous permettre de profiter des services offerts par
                            le site.</li><br/>
                        <li>Aucune information personnelle vous concernant n'est cédée à des tiers ou utilisée à des fins non prévues.</li><br/>
                        <li>Conformément à la loi Informatique et Libertés du 6 janvier 1978, vous disposez d'un droit d'accès, de modification, de rectification et de suppression
                            des données personnelles que nous pourrions être amenés à recueillir (Art. 34 de la loi "Informatique et Libertés").</li>
                    </ul>
                </div>
                <div class="small-6 columns panel" data-equalizer-watch>
                    <h2>Liens hypertexte</h2>
                    <ul> <li>Le site décline formellement toute responsabilité quant aux contenus des sites vers lesquels elles offrent des liens. Ces liens sont proposés aux
                            utilisateurs du site web. La décision d'activer les liens appartient exclusivement aux utilisateurs du web.</li></ul>
                </div>

            </div>	
        </div>

    </div>

</div>
