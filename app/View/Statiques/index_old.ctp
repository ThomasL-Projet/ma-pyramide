<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home');?>
<?php if (AuthComponent::user('role') == 'administrateur') : ?>
	<!-- Cette page est accessible dans la partie administration. Cliquez sur : gérer des articles -->
	<br />
	
	<!-- Bouton ajout : pour ajouter une nouvelle page cliquez sur la croix verte-->
	<?php echo $this->Html->link('<div id="btn-ajouter">  </div>', '/statiques/add/', array('escape' => false)); ?>
	<div id="bloc-editeur">
	<?php echo $this->Form->create('Statique',array(
						'url' => array('controller' => 'statiques', 'action' => 'index')
						)); ?>
	<center>
	Choisissez une section de pages à afficher :
	<br />
	<select name="filtre">
	<option value="all" <?php if (!isset($filtrer)) echo 'selected';?>>Tout</option>
	<?php 
				$sous_type ="";
				foreach ($categories as $categorie) {
						if ($sous_type != $categorie['Categoriesimage']['sous_partie']) {
							echo '<option disabled>'.$categorie['Categoriesimage']['sous_partie'].'</option>';
							$sous_type = $categorie['Categoriesimage']['sous_partie'];
						}
						if (isset($filtrer) AND $categorie['Categoriesimage']['id'] == $filtrer) {
							echo "<option value=\"" . $categorie['Categoriesimage']['id'] . "\" selected>" . $categorie['Categoriesimage']['name'] . "</option>";
						} else {
							echo "<option value=" . $categorie['Categoriesimage']['id'] . ">" . $categorie['Categoriesimage']['name'] . "</option>";
						}
					  } ?>
	</select>
	<?php echo $this->Form->end('Filtrer'); ?>
	</center>
	</div>
	<?php $categorie = ""; ?>
	<?php foreach ($pages as $page) : ?>
		<?php 
				if ($page['Categoriesimage']['name'] != $categorie) {
					echo '<div class="span2">' .$page['Categoriesimage']['name'] . '</div>';
					$categorie = $page['Categoriesimage']['name'];
					echo '<div id="bloc-editeur">';
				} else {
					echo '<div id="bloc-editeur" style="margin-top:-30px">';
				}
			?>
		
			
			<p id="article">
				<?php 
					echo $this->Html->link('<div class="titrePage">Nom de l\'onglet : <strong>' . $page['Statique']['titreonglet'] . '</strong></div>', '/statiques/pages/' . $page['Statique']['id'] , array('escape' => false));
					echo $this->Html->link('<div class="titrePage">Titre de la page : <strong>' . $page['Statique']['title'] . '</strong></div>', '/statiques/pages/' . $page['Statique']['id'] , array('escape' => false));
					$comptPages = 0;
					if (!empty($page['Statique']['content1'])) $comptPages++;
					if (!empty($page['Statique']['content2'])) $comptPages++;
					if (!empty($page['Statique']['content3'])) $comptPages++;
					
					if ($comptPages == 0) {
						echo 'Cette page ne contient pas de paragraphes';
					} elseif ($comptPages == 1) {
						echo 'Cette page contient un seul paragraphe (maximum 3)';
					} else {
						echo 'Cette page contient un total de ' . $comptPages . ' paragraphes (maximum 3)';
					}
			  	?>
			</p>

			<div class="btns-index">
				<!-- Bouton modifications : pour effectuer des modifications concernant un article, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
					 à l'article qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-modifier" style="float:right"></div>', '/statiques/edit/' . $page['Statique']['id'], array('escape' => false)); ?>

				<!-- Bouton suppression : pour supprimer un article, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
					 à l'article qu'il souhaite modifier -->
				<?php echo $this->Html->link('<div class="btn-supprimer" style="float:right"></div>', '/statiques/delete/' . $page['Statique']['id'], array('escape' => false)); ?>
				
			</div>
		</div>
		<!-- Catégorie : <?php echo $page['Category']['name']; ?> -->
	<?php endforeach; ?>
	<?php 
	echo '<div id="bloc-editeur"><center>';
	?><div style="font-style:italic">Navigation : </div><?php
	echo $this->Paginator->prev('<<'.__('Précédent',true), array(), null, array('class'=>'disable'));?>
		<?php echo $this->Paginator->numbers();?>
		<?php echo $this->Paginator->next('Suivant'.__('>>',true), array(), null, array('class'=>'disable'));
	echo '</center></div>'	
	?>		
<?php endif; ?>
</div>