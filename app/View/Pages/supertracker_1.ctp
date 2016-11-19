<div id="presentation">
	<div id="image">
	</div>
	
    <div class="texte">
		<!-- Cette page est accessible à partir du menu situé en haut de page : Cliquez sur "Ressources" -> "Super Traqueur" -->
		<div class="span2"> Supertraqueur </div> 
		
		<div class="p1"><strong>Supertraqueur</strong> va vous aider à planifier, analyser et traquer votre alimentation et votre activité physique. Vous trouverez dans <strong>Supertraqueur</strong> non seulement ce que vous devez manger mais aussi dans quelle quantité et vous suivrez dans le temps votre alimentation, votre activité physique, votre poids.<br><br>
		<?php
		if (AuthComponent::user('id') == null) {
			echo 'En créant ' . $this->Html->link('<strong>mon profil</strong>', '/users/add/', array('escape' => false)) . ' ou en me '.$this->Html->link('<strong>connectant</strong>', '/users/login/', array('escape' => false)).' vous personnaliserez l’aide de <strong>Supertraqueur</strong> : fixation d’objectifs, coaching virtuel et journal individuel. Il s’adresse à tous de 2 à 120 ans.';
		} 
		?>
		</div>
	</div>

</div>
<div id="menus">
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Encyclopédie". Cette dernière vous permet de comparer en termes de valeurs 
		 nutritionnelles deux aliments -->
    <div class="b1">
		<article class="bloc-menu">
			<h3><?php echo $this->Html->link('Encyclopédie', '/aliments/', array('escape' => false,'title' => 'Encyclopédie'));?></h3>
			<p>L’information nutritionnelle sur plus de 1500 aliments et la possibilité de les comparer deux à deux</p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigée vers la page nommée "Mon suivi alimentaire". Cette dernière vous permet d'établir une plannification
	     détaillée de votre alimentation -->
	<div class="b1">
		<article class="bloc-menu">
			<h3><?php echo $this->Html->link('Mon suivi alimentaire', '/suivialimentaires/', array('escape' => false,'title' => 'Mon suivi alimentaire','id' => 'suivialimentaires'));?></h3>
			<p>Comparez les aliments que vous mangez avec ceux que vous devriez manger</p>
		</article>
    </div>
	
	<!--En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mon suivi physique". Cette dernière vous permet d'étbir une plannification 
	    détaillée de votre activité physique -->
    <div class="b1">
		<article class="bloc-menu">
		<?php if (AuthComponent::user('username')) { ?>
			<h3><?php echo $this->Html->link('Mon suivi physique', '/activitephysiques/', array('escape' => false,'title' => 'Mon suivi physique','id' => 'activitephysiques'));?></h3>
		<?php  } else { ?>
			<h3> <a href="#" onClick="nonConnecte();"> Mon suivi physique </a></h3>
		<?php  } ?>
			<p>Rentrez votre activité physique et suivez vos progrès</p>
		</article>
    </div>

	<!-- En cliquant sur ce lien, vous êtes redigéré vers la page nommée "Mon gestionnaire de poids idéal". Cette dernière vous permet de définir le poids
	     idéal que vous devriez peser en fonction de votre taille & vous aide à gérer ce dernier -->
	<div class="b1">
		<article class="bloc-menu">
	<?php if (AuthComponent::user('username')) { ?>
			<h3><?php echo $this->Html->link('Mon gestionnaire de poids', '/gestionpoids/', array('escape' => false,'title' => 'Mon gestionnaire de poids','id' => 'gestionPoids'));?></h3>
	<?php  } else { ?>
			<h3> <a href="#" onClick="nonConnecte();"> Mon gestionnaire de poids </a></h3>
	<?php  } ?>
			<p>Vous guide dans la gestion de votre poids, rentrez votre poids et suivez vos progrès dans le temps</p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "Mes 5 objectifs". Cette dernière vous permet de définir clairement les 5 objectifs
	     que vous souhaitez atteindre. Les objectifs peuvent concerner tant l'activité physique que l'alimentation  -->
	<div class="b1">
		<article class="bloc-menu">
	<?php if (AuthComponent::user('username')) { ?>
			<h3><?php echo $this->Html->link('Mes 5 objectifs', '/mesCinqObjectifs/', array('escape' => false,'title' => 'Mes 5 objectifs','id' => 'objectifs'));?></h3>
	<?php  } else { ?>
			<h3> <a href="#" onClick="nonConnecte();"> Mes 5 objectifs </a></h3>
	<?php  } ?>
			<p>Vous choisissez 5 objectifs ; votre coach virtuel vous prodigue conseils et soutien</p>
		</article>
    </div>
	
	<!-- En cliquant sur ce lien, vous êtes redirigé vers la page nommée "mes rapports d'évolution". Cette dernière vous permet de suivre au jour le jour,
	     l'évolution de votre alimentation & de votre activité physique  -->
	<div class="b1">
		<article class="bloc-menu">
	<?php if (AuthComponent::user('username')) { ?>
			<h3><?php echo $this->Html->link('Mes rapports d\'évolution', '/rapportEvolution/', array('escape' => false,'title' => 'Mes rapports d\'évolution','id' => 'rapportEvolution'));?></h3>
	<?php  } else { ?>
			<h3> <a href="#" onClick="nonConnecte();"> Mes rapports d'évolution </a></h3>
	<?php  } ?>
			<p>Ces rapports vous permettent de faire le point : atteinte des objectifs et détermination de vos points forts et faibles</p>
		</article>
    </div>
</div>

<script type="text/javascript">
		function nonConnecte() {
			alert("Il faut etre connecte pour utiliser cette fontionnalité.");
		}
</script>

<script type="text/javascript">
		function nonImplemente() {
			alert("Fonctionnalité non disponible");
		}
</script>