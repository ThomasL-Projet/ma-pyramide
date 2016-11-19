<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mes liens');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<!-- page générique pour l'affichage d'un lien -->
<div class="row presentation">
    <div class="small-12 columns">
        <h1 class="title text-center"><?php echo $lien['Lien']['title'] ?></h1> 
    </div>
    <div class="row">
    <div class="small-12 columns">
	<!-- Permet de préciser les dates de création et de modification du lien ainsi que le contenu de ce dernier-->
	<h5 class="text-left">
		<?php 
			$temp = explode("-", $lien['Lien']['created']); 
			$split = explode(" ", $temp[2]);
			$heure = $split[1];
			$split2 = explode(" ", $temp[2]); 
			$date = $split2[0] . '-' . $temp[1] . '-' . $temp[0];
		?>
                Création : <?php echo $date . ' à ' . $heure ?>	<br/>
		<?php if (!empty ($lien['Lien']['modified'])) : ?>
		Dernière modification : <?php echo $date . ' à ' . $heure ?>
		<?php endif ; ?>
	</h5>
        </div>
       </div>
    <div class="row">
        <div class="small-12 columns">

            <p class="text-justify"><?php echo $lien['Lien']['content'] ?></p>

    </div>
</div>
</div>
