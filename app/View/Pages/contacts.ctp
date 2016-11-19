<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Contacts');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Contacts', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Contacts </div>      
        </div>
    </div>
    <!-- Informations décrivant l'association ainsi que les membres de l'association que les internaues peuvent joindre -->
    <div class="row">
        <div class="small-12 small-centered columns text-center">
            <b>AG Diététique</b> (<b>A</b>ssociation <b>G</b>radient <b>D</b>iététique) <br/>
            Nous sommes une association de diététique Lozérienne située à : 
            <br/><br/>
            <div class="center">
                La Bessière <br/>48340 SAINT PIERRE DE NOGARET
            </div>
            <br/>
            Pour contacter l'un de ses membres, vous pouvez vous adresser au docteur André ALAUX en utilisant l'adresse suivante : 
            <div class="center"><a href="mailto:postmaster@mapyramide.fr">postmaster@mapyramide.fr</a></div>
        </div>
    </div>
</div>