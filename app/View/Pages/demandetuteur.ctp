<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Demande de tuteur');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La diététique', array('action' => 'dietetique', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem">
        <?php
        echo $this->Html->link('La gestion pondérale', array('action' => 'gestionponderale', 'full_base' => true)
        );
        ?>
    </li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les calories', 'Javascript:void(0);'); ?></li>
</nav>﻿﻿
<div class="row">
    <div class="small-12 columns">
	<div id="image">
	</div>
    <div class="row">
		<!-- Un utilisateur arrive sur cette page s'il n'a pas encore de tuteur. Il est redirigé depuis la page "Mon tuteur" -->
                <h1> Les tuteurs disponibles </h1> 
	</div>
	<div class="row">
            <div class="small-6 columns">
                <p>Choissisez votre tuteur parmis la liste de professionels disponibles :</p>
                <h3> Pas encore implémenté </h3>
            </div> 			
	</div>
	
	<!-- combobox des professionels dans la bd -->
	
	<!-- bouton valider qui envoie la demande et dit "votre demande a bien était envoyée"-->
	
</div>
</div>

