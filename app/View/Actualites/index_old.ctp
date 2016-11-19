<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
<?php if (AuthComponent::user('role') == 'administrateur') : ?>
    <div class="btns-index">
				<!-- Bouton modifications : pour effectuer des modifications concernant un actualite, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
					 à l'actualite qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="button">Modifier</div>', '/actualites/edit/' . $actualite['Actualite']['id'], array('escape' => false)); ?>

				<!-- Bouton suppression : pour supprimer un actualite, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
					 à l'actualite qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="button">Supprimer</div>', '/actualites/delete/' . $actualite['Actualite']['id'], array('escape' => false)); ?>
				
			</div>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des actualites -->
        <!-- Bouton ajout : pour ajouter un nouvel artcile cliquez sur la croix verte-->
	<?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/actualites/add/', array('escape' => false)); ?>
	<br />
	<?php endif; ?>
	

	<?php foreach ($actualites as $actualite) : ?>
		<div class="bloc-index">
			<p id="actualite">
				<?php 
					echo $this->Html->link('<div class="titreActualite">' . $actualite['Actualite']['title'] . '</div>', '/actualites/actualite/' . $actualite['Actualite']['id'] , array('escape' => false));
                                       
			  	?>
			</p>

			
		</div>
	<?php endforeach; ?>

</div>
