<?php if (AuthComponent::user('role') == 'administrateur') : ?>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer les liens -->
	<br />
	
	<!-- Bouton ajout : pour ajouter un nouveau lien cliquez sur la croix verte-->
	<?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/liens/add/', array('escape' => false)); ?>

	<?php foreach ($liens as $lien) : ?>
		<div class="bloc-index">
			<p id="lien">
				<?php 
					echo $this->Html->link('<div class="titreLien">' . $lien['Lien']['title'] . '</div>', '/liens/lien/' . $lien['Lien']['id'] , array('escape' => false));
                                       
			  	?>
			</p>

			<div class="btns-index">
				<!-- Bouton modifications : pour effectuer des modifications concernant un lien, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
					 au lien qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-modifier">Modifier</div>', '/liens/edit/' . $lien['Lien']['id'], array('escape' => false)); ?>

				<!-- Bouton suppression : pour supprimer un lien, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
					 au lien qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-supprimer">Supprimer</div>', '/liens/delete/' . $lien['Lien']['id'], array('escape' => false)); ?>
				
			</div>
		</div>
	<?php endforeach; ?>
<?php endif; ?>
