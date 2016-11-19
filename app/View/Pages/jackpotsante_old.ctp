<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/home');?>
	<div id="image">
	</div>
	
    <div class="texte">
		<!-- Cette page est accessible à partir du menu situé en haut de page : Cliquez sur "Ressources" -> "Mon Jackpot Santé" -->
		<div class="span2"> Mon Jackpot Santé </div> 
		
		<div class="p1">Ce <strong>jackpot-santé</strong> vous fixe les objectifs quotidiens en termes de votre budget : calories,  aliments (par groupes alimentaires individuels) et activité physique et de leur répartition. Il vous permet en plus de planifier vos repas quotidiens en répartissant votre alimentation entre le petit déjeuner, le déjeuner, le diner et les en cas.<br><br>
		
		</div>
	</div>

</div>
<div id="menus">
	
    <div class="b1">
		<article class="bloc-menu">
			
			<h3><?php echo $this->Html->link('Mes recettes', '/mesrecettes/', array('escape' => false,'title' => 'Mes recettes'));?></h3>
			
			<p>Personnalisez vos recettes en combinant des aliments.</p>
		</article>
    </div>
	
	
	<div class="b1">
		<article class="bloc-menu">
		
			<h3><?php echo $this->Html->link('Mes activités', '/activitephysiques/jackpot', array('escape' => false,'title' => 'Mes activités'));?></h3>
		
			<p>Utilisez cet outil pour chercher une activité et voir combien de calories vous pouvez brûler en la pratiquant</p>
		</article>
    </div>
	<div class="b1">
		<article class="bloc-menu">
		
			<h3><?php echo $this->Html->link('Aliments hors classification', '/alimenthorsclassification/', array('escape' => false,'title' => 'Aliments hors classification'));?></h3>
		
			<p>Personnalisez vos aliments achetés dans le commerce et non répertoriés dans notre classification.
</p>
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