<div class="bloc1">
	<pre>
    Site principal
        +---Encyclopédie alimentaire
        |   <?php echo $this->Html->link('\---Index', '/aliments/index'); ?>
    
        +---Articles du site
        |   <?php echo $this->Html->link('+---Ajout', '/articles/index'); ?>
    
        |   <?php echo $this->Html->link('+---Édition', '/articles/index'); ?>
    
        |   <?php echo $this->Html->link('+---Suppression', '/articles/index'); ?>
    
        |   <?php echo $this->Html->link('+---Consultation', '/articles/recherche?s='); ?>
    
        |   <?php echo $this->Html->link('\---Recherche', '/articles/recherche?s='); ?>
    
        +---Calculateur d'IMC
        |   <?php echo $this->Html->link('+---Index', '/imcenfants/index'); ?>
    
        |   <?php echo $this->Html->link('\---Calcul', '/imcenfants/index'); ?>
    
        +---Pages statiques
        |   <?php echo $this->Html->link('+---activitephysique', '/pages/activitephysique'); ?>

        |   <?php echo $this->Html->link('+---alimentsnecessaires', '/pages/alimentsnecessaires'); ?>

        |   <?php echo $this->Html->link('+---augmentersport', '/pages/augmentersport'); ?>

        |   <?php echo $this->Html->link('+---bienfaits', '/pages/bienfaits'); ?>

        |   <?php echo $this->Html->link('+---bienfaitscereales', '/pages/bienfaitscereales'); ?>

        |   <?php echo $this->Html->link('+---bienfaitslegumes', '/pages/bienfaitslegumes'); ?>

        |   <?php echo $this->Html->link('+---bienfaitspl', '/pages/bienfaitspl'); ?>

        |   <?php echo $this->Html->link('+---bienfaitsproteines', '/pages/bienfaitsproteines'); ?>

        |   <?php echo $this->Html->link('+---cakehome', '/pages/cakehome'); ?>

        |   <?php echo $this->Html->link('+---calories', '/pages/calories'); ?>

        |   <?php echo $this->Html->link('+---caloriesbrulees', '/pages/caloriesbrulees'); ?>

        |   <?php echo $this->Html->link('+---caloriesmg', '/pages/caloriesmg'); ?>

        |   <?php echo $this->Html->link('+---caloriesvides', '/pages/caloriesvides'); ?>

        |   <?php echo $this->Html->link('+---cereales', '/pages/cereales'); ?>

        |   <?php echo $this->Html->link('+---choixvegetariens', '/pages/choixvegetariens'); ?>

        |   <?php echo $this->Html->link('+---comptercalories', '/pages/comptercalories'); ?>

        |   <?php echo $this->Html->link('+---conseilscereales', '/pages/conseilscereales'); ?>

        |   <?php echo $this->Html->link('+---conseilsfruits', '/pages/conseilsfruits'); ?>

        |   <?php echo $this->Html->link('+---conseilslegumes', '/pages/conseilslegumes'); ?>

        |   <?php echo $this->Html->link('+---conseilspl', '/pages/conseilspl'); ?>

        |   <?php echo $this->Html->link('+---conseilsproteines', '/pages/conseilsproteines'); ?>

        |   <?php echo $this->Html->link('+---conseilssportifs', '/pages/conseilssportifs'); ?>

        |   <?php echo $this->Html->link('+---contacts', '/pages/contacts'); ?>

        |   <?php echo $this->Html->link('+---cuisinemaison', '/pages/cuisinemaison'); ?>

        |   <?php echo $this->Html->link('+---diminuerportions', '/pages/diminuerportions'); ?>

        |   <?php echo $this->Html->link('+---fruits', '/pages/fruits'); ?>

        |   <?php echo $this->Html->link('+---gestionpoids', '/pages/gestionpoids'); ?>

        |   <?php echo $this->Html->link('+---groupesalimentaires', '/pages/groupesalimentaires'); ?>

        |   <?php echo $this->Html->link('+---home', '/pages/home'); ?>

        |   <?php echo $this->Html->link('+---importancemg', '/pages/importancemg'); ?>

        |   <?php echo $this->Html->link('+---importancesport', '/pages/importancesport'); ?>

        |   <?php echo $this->Html->link('+---legumes', '/pages/legumes'); ?>

        |   <?php echo $this->Html->link('+---legumesbeansandpeas', '/pages/legumesbeansandpeas'); ?>

        |   <?php echo $this->Html->link('+---mangerdehors', '/pages/mangerdehors'); ?>

        |   <?php echo $this->Html->link('+---matieresgrasses', '/pages/matieresgrasses'); ?>

        |   <?php echo $this->Html->link('+---meilleurschoix', '/pages/meilleurschoix'); ?>

        |   <?php echo $this->Html->link('+---mentionslegales', '/pages/mentionslegales'); ?>

        |   <?php echo $this->Html->link('+---moinsdecrans', '/pages/moinsdecrans'); ?>

        |   <?php echo $this->Html->link('+---nourritureactuelle', '/pages/nourritureactuelle'); ?>

        |   <?php echo $this->Html->link('+---produitslaitiers', '/pages/produitslaitiers'); ?>

        |   <?php echo $this->Html->link('+---proteines', '/pages/proteines'); ?>

        |   <?php echo $this->Html->link('+---quantitequiconvient', '/pages/quantitequiconvient'); ?>

        |   <?php echo $this->Html->link('+---quantiterecommandeemg', '/pages/quantiterecommandeemg'); ?>

        |   <?php echo $this->Html->link('+---quemanger', '/pages/quemanger'); ?>

        |   <?php echo $this->Html->link('+---sitemap', '/pages/sitemap'); ?>

        |   <?php echo $this->Html->link('+---sucresajoutes', '/pages/sucresajoutes'); ?>

        |   <?php echo $this->Html->link('+---supertracker', '/pages/supertracker'); ?>

        |   <?php echo $this->Html->link('+---tempspratique', '/pages/tempspratique'); ?>

        |   <?php echo $this->Html->link('\---test', '/pages/test'); ?>

        +---Statistiques de visite
        |   <?php echo $this->Html->link('\---Visites', '/stats/visite'); ?>
    
        \---Gestion des utilisateurs
            <?php echo $this->Html->link('+---Index', '/users/index'); ?>
        
            <?php echo $this->Html->link('+---Connexion', '/users/index'); ?>
        
            <?php echo $this->Html->link('+---Ajout', '/users/add'); ?>
        
            <?php echo $this->Html->link('+---Édition', '/users/index'); ?>
        
            <?php echo $this->Html->link('\---Suppression', '/users/index'); ?>
        
	</pre>
</div>