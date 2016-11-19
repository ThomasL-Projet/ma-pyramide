<div id="presentation">
	<div id="image">
	</div>
    <div class="texte">
		<!-- Cette page est accessible depuis le menu situé en haut de page : Cliquez sur "Mon assiette" -->
		<div class="span3"> Groupes alimentaires </div> 
	</div>
	<div class="texte">
		<div class="p1">Les 6 groupes alimentaires sont choisis de manière
						à ce que vous puissiez vous construire une alimentation saine
						et équilibrée. Avant de manger, pensez un instant à quels groupes d’aliments
						vous mettrez dans votre assiette, votre tasse ou votre bol. Pour faire simple, 
						retenez que dans une journée ils sont tous indispensables. 
						Afin que votre assiette corresponde à vos besoins, 
						choisissez un ou plusieurs des groupes alimentaires suivants.
		</div> 			
	</div>
</div>

<div id="menus">
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des fruits ainsi qu'une liste non exhaustive de ces derniers -->
    <div class="b1">
		<article class="bloc-menu">
			<h3 id="fruits"> Fruits </h3>
			<div style="font-style:italic; text-align:center">Ne sous-estimez pas les fruits</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe des fruits', 'fruits'); ?></div>
			<p><?php echo $this->Html->image('Fruits.png', array('height' => '160', 'width' => '250', 'alt' => 'Fruits')); ?></p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des légumes ainsi qu'une liste non exhaustive de ces derniers -->
	<div class="b1">
		<article class="bloc-menu">
			<h3 id="legumes"> Légumes et apparentés </h3>
			<div style="font-style:italic; text-align:center">Insistez sur la variété</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe des Légumes et apparentés', 'legumes', array('style' => 'font-size:0.8em;')); ?></div>
			<p><?php echo $this->Html->image('Légumes.jpg', array('height' => '160', 'width' => '250', 'alt' => 'Légumes')); ?></p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des céréeales ainsi qu'une liste non exhaustive de ces dernières -->
    <div class="b1">
		<article class="bloc-menu">
			<h3 id="cereales"> Produits céréaliers </h3>
			<div style="font-style:italic; text-align:center;font-size:0.8em;">Habitué au pain blanc ? Découvrez les bienfaits du pain complet.</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe des produits céréaliers', 'cereales', array('style' => 'font-size:0.8em;')); ?></div>
			<p><?php echo $this->Html->image('Céréales.jpg', array('height' => '160', 'width' => '250', 'alt' => 'Céréales')); ?></p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des eliments protéinés ainsi qu'une liste non exhaustive
		de ces derniers -->	    
	<div class="b1">
		<article class="bloc-menu">
			<h3 id="proteines" style="font-size:0.8em;"> Groupe des protéines et apparentés </h3>
			<div style="font-style:italic; text-align:center;font-size:0.8em;">Dans nos sociétés on mange plus de viande que nécessaire !</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe des protéines et apparentés', 'proteines', array('style' => 'font-size:0.8em;')); ?></div>
			<p><?php echo $this->Html->image('AlimentsProtéinés.jpg', array('height' => '160', 'width' => '250', 'alt' => 'AlimentsProtéinés')); ?></p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des produits laitiers ainsi qu'une liste non exhaustive
		de ces derniers -->
	<div class="b1">
		<article class="bloc-menu">
			<h3 id="produitsLaitiers"> Lait et produits laitiers </h3>
			<div style="font-style:italic; text-align:center;">Votre apport en calcium se trouve ici.</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe du lait et des produits dérivés', 'produitslaitiers', array('style' => 'font-size:0.7em;')); ?></div>
			<p><?php echo $this->Html->image('ProduitsLaitiers.png', array('height' => '160', 'width' => '250', 'alt' => 'ProduitsLaitiers')); ?></p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des matières grasses ainsi qu'une liste non exhaustive
		de ces derniers -->
	<div class="b1">
		<article class="bloc-menu">
			<h3 id="matieresGrasses"> Huiles et Graisses Solides </h3>
			<div style="font-style:italic; text-align:center;font-size:0.8em;">Pas de haro sur les matières grasses seulement sur leur trop grande quantité.</div>
			<div style="font-style:italic; text-align:center;color:green"><?php echo $this->Html->link('=> Voir le groupe des huiles et graisses solides', 'matieresgrasses', array('style' => 'font-size:0.7em;')); ?></div>
			<p><?php echo $this->Html->image('Huiles.png', array('height' => '160', 'width' => '250', 'alt' => 'MatieresGrasses')); ?></p>
		</article>
    </div>
</div>