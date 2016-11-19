<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/home/');?>
<?php if (AuthComponent::user('role') == 'administrateur') : ?>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
	<br />
	
	<!-- Bouton ajout : pour ajouter un nouvel artcile cliquez sur la croix verte-->
	<?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/articles/add/', array('escape' => false)); ?>

	<?php foreach ($articles as $article) : ?>
		<div class="bloc-index">
			<p id="article">
				<?php 
					echo $this->Html->link('<div class="titreArticle">' . $article['Article']['title'] . '</div>', '/articles/article/' . $article['Article']['id'] , array('escape' => false));
				  	echo' (Catégorie : ' . $article['Category']['name'] . ') '; 
			  	?>
			</p>

			<div class="btns-index">
				<!-- Bouton modifications : pour effectuer des modifications concernant un article, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
					 à l'article qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-modifier">Modifier</div>', '/articles/edit/' . $article['Article']['id'], array('escape' => false)); ?>

				<!-- Bouton suppression : pour supprimer un article, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
					 à l'article qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-supprimer">Supprimer</div>', '/articles/delete/' . $article['Article']['id'], array('escape' => false)); ?>
				
			</div>
		</div>
		<!-- Catégorie : <?php echo $article['Category']['name']; ?> -->
	<?php endforeach; ?>
<?php endif; ?>
</div>