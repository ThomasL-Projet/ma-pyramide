<?php echo $this->Html->link('<< Retour', '/imcenfants/'); ?>
<?php if ($affichage) : ?>
<div class="p1">
	<div id="bloc5">
		<table>
			<tr>
				<td>
					<h1>Résultat</h1>
					<br/> <br />
					<div class="p2">Mon IMC est de <?php echo round($imc,2);?> et&nbsp;</div>
					<div class="p2">mes besoins énergétiques estimés sont</div><div class="p2" id="besoinsEnergetiques">de <?php echo $BEE ?> calories par jour.</div>
					<br/><br/>
					<!--Si la personne a plus de 18 ans, on calcule son IMC avec l'équation suivante poids/ taille² -->






					<?php if ($_POST['zt_age'] > 18): ?>
						<?php if ($imc<$imcMin): ?>
						<!-- IMC<16.5 -> Insuffisance pondérale -->
						<div class="p3">Vous êtes en insuffisance pondérale. Ce site ne peut pas vous prendre en charge, consultez un médecin ou un diététicien.</div>
						<?php elseif ($imc>=$imcMin && $imc<=$imcMax) : ?>
						<!--IMC>=18.5 && IMC <=25 -> Corpulence normale -->
						<?php $categorie="Corpulence normale";
						echo('<div class="p3">"."Je suis dans la catégorie : '.$categorie."</div>"); ?>
						<?php elseif ($imc>$imcMax && $imc < 40): ?>
						<!-- IMC >25 -> Surpoids 
						   On demande alors à l'utilisateur s'il souhaite perdre du poids : deux possibilités s'offrent à lui "Oui" et "Non". 
						   S'il clique sur "Oui", on ouvre une popup, lui demandant s'il souhaite effectuer une perte pondérale modérée sur 6 mois
						   ou une perte pondérale plus contraignante
						   Dans tous les cas (même si le calcul n'est pas identique dans tous les cas, nous calculons le nombre de calories qu'il doit consommer
						   en fonction de sa taille, de son poids & de la décision qu'il en prise concernant la perte de poids-->
						
						<!-- #TODO : mettre dans une balise <form> sinon le input ne sert à rien -->
					  	<div id='choixPertePoids'>
						<div class="p3">Vous êtes en surcharge pondérale. Souhaitez-vous perdre du poids ?<br /></div>
					  	<br/>
					  		<a id='oui'><input type="submit" value="Oui"/></a>
							<a id='non'><input type="submit" value="Non"/></a>
						</div>
						<!-- Si l'utilisateur est un enfant (age<=18 ans), nous lui indiquons seulement, si sa corpulence est "normale" ou non -->
						<?php else : ?>
						<!-- IMC>40 -> Surcharge pondérale -->
						<div class="p3">Vous êtes en surcharge pondérale trop élevée. Ce site ne peut pas vous prendre en charge, consultez un médecin ou un diététicien.</div>
						<?php endif; ?>

					<?php else : 
						if($imc >= $imcMin && $imc <= $imcMax) {
							echo('<div class="p3">Corpulence normale</div>');
						} else {
							echo('<div class="p3">Vos paramètres corporels font que ce site ne peut pas vous prendre en charge et vous demande de consulter un médecin ou un diététicien</div>');
						}

						if (!empty($fille)) {
							
							//echo $this->Html->image('courbef2.gif', array('width' => '500', 'height' => '600', 'title' => '', 'alt' => 'alt', 'id' => 'testimg'));
							echo '<div id="testimg" style="background-image: url(../img/courbef2.gif); height: 650px; width: 560px; border: 1px solid black;">
							</div>';
						} 
						if(!empty($garcon)) {
							//echo $this->Html->image('courbeg2.gif', array('width' => '500', 'height' => '600','title' => '', 'alt' => 'alt', 'id' => 'testimg'));
							echo '<div id="testimg" style="background-image: url(../img/courbeg2.gif); height: 650px; width: 560px; border: 1px solid black;">
							</div>';
						}

					endif;?>

<script type="text/javascript">

        $("#testimg").ready(function (ev) {
        var age = <?php echo $_POST['zt_age'] ?>;
      	var imc =  <?php echo $imc ?>;
        var color = '#ef1919';
        var size = '5px';
        if (imc > 11 && imc < 32) {
        	$("#testimg").append(
            	$('<div></div>')
	                .css('position', 'relative')
	                .css('top', (32-imc)*4.305+2.3 + '%')
	                .css('left', age*5+7.5 + '%')
	                .css('width', size)
	                .css('height', size)
	                .css('background-color', color)
      	  );
        }
    })

</script>

</script>
					<br/><br/>
				</td>
				<td><span></span></td>
				<td>
					<?php 
					 	// On récupère l'age de la personne. Si c'est un adulte, on affiche l'interprétation suivante
						if($_POST['zt_age']>=18): ?>
						<h1>Interprétation</h1>
						<br/><br/>
						<table>
							<tr>
								<td><h2>IMC kg.m-2</h2></td>
								<td><div id=\"span1\"></div></td>
								<td><h2>Interprétation</h2></td>
							</tr>
							
							<tr>
								<td><div class="p1"> &lt; 16.5</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Dénutrition</div></td>
							</tr>
							
							<tr>
								<td><div class="p1"> Entre 16.5 et 18.5</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Maigreur</div></td>
							</tr>
							
							<tr>
								<td><div class="p1">Entre 18.5 et 25</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Corpulence normale</div></td>
							</tr>
							
							<tr>
								<td><div class="p1">Entre 25 et 30</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Surpoids</div></td>
							</tr>
							
							<tr>
								<td><div class="p1">Entre 30 et 35</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Obésité modérée</div></td>
							</tr>
							
							<tr>
								<td><div class="p1">Entre 35 et 40</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Obésité élevée</div></td>

							</tr>
							
							<tr>
								<td><div class="p1"> &gt; 40</div></td>
								<td><div id=\"span1\"></div></td>
								<td><div class="p1">Obésité morbide</div></td>
							</tr>
						</table>
					<?php endif; ?>
				</td>
			</tr>
		</table>
	</div>




</div>

<div id="blocIMC">
	<!-- Fader -->
</div>







<!-- Sil'utilisateur est en surpoids, on lui demande s'il souhaite effectué une pere pondérale modérée sur six mois ou une perte pondérale plus contraignante -->
<div id="blocQuestion">
	<br/>
	<div class="p1">
		Perdre du poids et après maintenir ce poids stable ne peut réussir que si deux impératifs sont remplis :<br/>
		<ul>
			<li> une réduction des apports alimentaires (nous allons vous aider)</li>
			<li> et la pratique d'une activité physique continue (nous allons vous aider aussi).</li>
		</ul> 
	</div>
	<br/>

	<div class="p1">Souhaitez-vous, effectuer une : </div>

	<p><input type="radio" name="radio" value="250" id='m' /> Perte pondérale modérée dans six mois (Conseillée)</p>
	<p><input type="radio" name="radio" value="500" id='c' /> Perte pondérale plus contraignante </p>
	<br/><br/>
	<?php echo $this->Form->create(null); ?>
	<input type="submit" name="valider" value="Valider" id='v'>
</form>
</div>
<?php endif; ?>
<script type="text/javascript">
	jQuery(document).ready(function($){
	    // SHOW/HIDE
	    $('#blocIMC').hide();
	    $('#blocQuestion').hide();
	    $('#bloc5 #oui').click(function(e){
	    	$('#bloc5 #choixPertePoids').fadeOut();
	        $('#blocQuestion').fadeIn();
	        $('#blocIMC').fadeIn();
	    });
	    $('#bloc5 #non').click(function(e){
	        $('#bloc5 #choixPertePoids').fadeOut();
	    });
	    $('#blocQuestion #m').click(function(e){
	        var newBEE = <?php echo $BEE ?> - 250;
	        document.getElementById('besoinsEnergetiques').innerHTML = "de " + newBEE + " calories par jour.";
	    });
		$('#blocQuestion #c').click(function(e){
	        var newBEE = <?php echo $BEE ?> - 500;
	        document.getElementById('besoinsEnergetiques').innerHTML = "de " + newBEE + " calories par jour.";
	    });
	    $('#blocQuestion #v').click(function(e){
	        $('#blocQuestion').fadeOut();
	        $('#blocIMC').fadeOut();
	    });
	    

	});
	
</script>