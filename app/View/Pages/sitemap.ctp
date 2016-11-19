<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Plan du site');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Le plan du site, avec toutes les fonctionnalités');
$this->end();
?>﻿<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mes aliments" -->
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Plan du site', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Plan du site </div>       
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <pre>
                <?php echo $this->Html->link('Ma Pyramide Alimentaire', 'pages/home'); ?>

  +---Encyclopédie alimentaire
  |    <?php echo $this->Html->link('Index', '/aliments/index'); ?>

  |
  +---Articles du site
  |    <?php echo $this->Html->link('Ajout', '/articles/index'); ?>

  |    <?php echo $this->Html->link('Édition', '/articles/index'); ?>

  |    <?php echo $this->Html->link('Suppression', '/articles/index'); ?>

  |    <?php echo $this->Html->link('Consultation', '/articles/recherche?s='); ?>

  |    <?php echo $this->Html->link('Recherche', '/articles/recherche?s='); ?>

  |
  +---Calculateur d'IMC
  |    <?php echo $this->Html->link('Index', '/imcenfants/index'); ?>

  |    <?php echo $this->Html->link('Calcul', '/imcenfants/index'); ?>

  |
  +---Pages statiques
  |   <?php echo $this->Html->link('+---Mes aliments', '/pages/groupesalimentaires'); ?>

  |   |   <?php echo $this->Html->link('+---Fruits', '/pages/fruits'); ?>

  |   |   <?php echo $this->Html->link('|    Bienfaits des fruits', '/pages/bienfaits'); ?>

  |   |   <?php echo $this->Html->link('|    Conseils pour manger des fruits', '/pages/conseilsfruits'); ?>

  |   |   <?php echo $this->Html->link('+---Légumes', '/pages/legumes'); ?>

  |   |   <?php echo $this->Html->link('|    Bienfaits des légumes', '/pages/bienfaitslegumes'); ?>

  |   |   <?php echo $this->Html->link('|    Conseils pour manger des légumes', '/pages/conseilslegumes'); ?>

  |   |   <?php echo $this->Html->link('|    Des légumes uniques : haricots et petits pois', '/pages/legumesbeansandpeas'); ?>

  |   |   <?php echo $this->Html->link('+---Céréales', '/pages/cereales'); ?>

  |   |   <?php echo $this->Html->link('|    Bienfaits des céréales', '/pages/bienfaitscereales'); ?>

  |   |   <?php echo $this->Html->link('|    Conseils pour manger des céréales', '/pages/conseilscereales'); ?>

  |   |   <?php echo $this->Html->link('+---Protéines', '/pages/proteines'); ?>

  |   |   <?php echo $this->Html->link('|    Bienfaits des protéines', '/pages/bienfaitsproteines'); ?>

  |   |   <?php echo $this->Html->link('|    Conseils pour manger des protéines', '/pages/conseilsproteines'); ?>

  |   |   <?php echo $this->Html->link('|    Les protéines dans les plats végétariens', '/pages/choixvegetariens'); ?>

  |   |   <?php echo $this->Html->link('+---Produits laitiers', '/pages/produitslaitiers'); ?>

  |   |   <?php echo $this->Html->link('|    Bienfaits des produits laitiers', '/pages/bienfaitspl'); ?>

  |   |   <?php echo $this->Html->link('|    Conseils pour manger des produits laitiers', '/pages/conseilspl'); ?>

  |   |   <?php echo $this->Html->link('\---Matières grasses', '/pages/matieresgrasses'); ?>

  |   |   <?php echo $this->Html->link('     Importance des matières grasses', '/pages/importancemg'); ?>

  |   |   <?php echo $this->Html->link('     Quantités recommandées de matières grasses', '/pages/quantiterecommandeemg'); ?>

  |   |
  |   <?php echo $this->Html->link('+---Gestion pondérale', '/pages/gestionpoids'); ?>

  |   |   <?php echo $this->Html->link('+---Gestion pondérale', '/pages/gestionpoids'); ?>

  |   |   <?php echo $this->Html->link('|    Ce que je mange et bois actuellement', '/pages/nourritureactuelle'); ?>

  |   |   <?php echo $this->Html->link('|    Que manger et boire ?', '/pages/quemanger'); ?>

  |   |   <?php echo $this->Html->link('|    Faire de meilleurs choix lorsque je mange', '/pages/meilleurschoix'); ?>

  |   |   <?php echo $this->Html->link('|    Consommer la quantité de calories qui me convient', '/pages/quantitequiconvient'); ?>

  |   |   <?php echo $this->Html->link('|    Diminuer la taille de mes portions', '/pages/diminuerportions'); ?>

  |   |   <?php echo $this->Html->link('|    Aliments nécessaires', '/pages/alimentsnecessaires'); ?>

  |   |   <?php echo $this->Html->link('|    Manger dehors', '/pages/mangerdehors'); ?>

  |   |   <?php echo $this->Html->link('|    Cuisiner plus souvent à la maison', '/pages/cuisinemaison'); ?>

  |   |   <?php echo $this->Html->link('|    Augmenter votre dose de sport', '/pages/augmentersport'); ?>

  |   |   <?php echo $this->Html->link('|    Passer moins de temps devant un écran', '/pages/moinsdecrans'); ?>

  |   |   <?php echo $this->Html->link('\---Les calories', '/pages/calories'); ?>

  |   |   <?php echo $this->Html->link('  Calories vides', '/pages/caloriesvides'); ?>

  |   |   <?php echo $this->Html->link('  Les calories dans les matières grasses', '/pages/caloriesmg'); ?>

  |   |   <?php echo $this->Html->link('  Sucres ajoutés', '/pages/sucresajoutes'); ?>

  |   |   <?php echo $this->Html->link('  Compter les calories', '/pages/comptercalories'); ?>

  |   |
  |   <?php echo $this->Html->link('+---Activité physique', '/pages/activitephysique'); ?>

  |   |   <?php echo $this->Html->link('Définition', '/pages/activitephysique'); ?>

  |   |   <?php echo $this->Html->link('Importance du sport', '/pages/importancesport'); ?>

  |   |   <?php echo $this->Html->link('Temps de pratique de sport recommandés', '/pages/tempspratique'); ?>

  |   |   <?php echo $this->Html->link('Calories brûlées', '/pages/caloriesbrulees'); ?>

  |   |   <?php echo $this->Html->link('Conseils sportifs', '/pages/conseilssportifs'); ?>

  |   |
  |   <?php echo $this->Html->link('+---Mon coach', '/pages/moncoach'); ?>

  |   |   <?php echo $this->Html->link('Test1', '/pages/home'); ?>

  |   |   <?php echo $this->Html->link('Test2', '/pages/home'); ?>

  |   |   <?php echo $this->Html->link('Test3', '/pages/home'); ?>

  |   <?php echo $this->Html->link('\---Ressources', '/imcenfants/index'); ?>

  |   |   <?php echo $this->Html->link('Calculateur IMC', '/imcenfants/index'); ?>

  |   |   <?php echo $this->Html->link('Super Traqueur', '/pages/supertracker'); ?>

  |  
  +---Statistiques de visite
  |    <?php echo $this->Html->link('Statistiques de visite du site (administrateurs seulement)', '/stats/visite'); ?>

  +---Gestion des utilisateurs
  |    <?php echo $this->Html->link('Index', '/users/index'); ?>

  |    <?php echo $this->Html->link('Connexion', '/users/index'); ?>

  |    <?php echo $this->Html->link('Ajout', '/users/add'); ?>

  |    <?php echo $this->Html->link('Édition', '/users/index'); ?>

  |    <?php echo $this->Html->link('Suppression', '/users/index'); ?>

  \---À propos
                <?php echo $this->Html->link('Foire aux questions', '/pages/home'); ?>

                <?php echo $this->Html->link('Mentions légales du site', '/pages/mentionslegales'); ?>

                <?php echo $this->Html->link('Contactez-nous', '/pages/contacts'); ?>

                <?php echo $this->Html->link('Plan détaillé du site', '/pages/sitemap'); ?>

            </pre>
        </div>
    </div>
</div>