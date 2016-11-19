<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/supertracker');?>
	<div id="image">
	</div>
	
    <div class="texte">
		<!-- Cette page est accessible à partir du supertracker : Cliquez sur "Ressources" -> "Super Traqueur" -> "Suivi Alimentaire" -->
		<div class="span2"> Mes rapports d'évolution </div> 
		
		<div class="p1">Suivre votre progression au fil du temps peut vous aider à atteindre vos objectifs d’alimentation et d’activité physique. Utilisez ces rapports pour déterminer les points ou vous avez atteint vos objectifs et identifier les points que vous aimeriez améliorer.
		</div>
	</div><br>
	<div id="menus">
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Activité physique', '/evolutionphysiques/', array('escape' => false,'title' => 'Activité physique'));?></h3>
				<p>Retracez votre activité physique hebdomadaire et comparez la aux objectifs fixés.</p>
			</article>
		</div>
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Sommaire Repas', '/rapportEvolution/sommaireRepas', array('escape' => false,'title' => 'Sommaire Repas'));?></h3>
				<p>Revoyez les menus que vous avez mangé ou planifié pendant une période déterminée.</p>
			</article>
		</div>
		
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Détails alimentaires', '/rapportEvolution/detailsAlim', array('escape' => false,'title' => 'Détails alimentaires'));?></h3>
				<p>Voyez le groupe alimentaire et le contenu nutritionnel de vos aliments chaque jour.</p>
			</article>
		</div>
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Diagrammes', '/rapportEvolution/diagrammes', array('escape' => false,'title' => 'Diagrammes'));?></h3>
				<p>Ces graphes résument un historique des tendances : poids, calories, groupes alimentaires et nutriments.</p>
			</article>
		</div>
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Groupes alimentaires et calories', '/rapportEvolution/groupesAliEtCal', array('escape' => false,'title' => 'Groupes alimentaires et calories'));?></h3>
				<p>Choisissez une période et vous obtiendrez vos apports moyens en termes de calories et groupes alimentaires.</p>
			</article>
		</div>
		<div class="b1">
			<article class="bloc-menu">
				<h3><?php echo $this->Html->link('Nutriments', '/rapportEvolution/nutriments', array('escape' => false,'title' => 'Nutriments'));?></h3>
				<p>Choisissez une période et vous obtiendrez vos apports moyens en nutriments  (Calcium, fer, sodium, vitamine D, ...)</p>
			</article>
		</div>
	</div>
</div>