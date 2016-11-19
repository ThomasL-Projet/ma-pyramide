
<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/rapportEvolution/index/');?>
	<?php if ($affichage) : ?>
		<div id="image">
		</div>
		<div class="texte">
			<div class="span3"> Détails alimentaires </div>
			<div class="p1"> Voyez le groupe alimentaire et le contenu nutritionnel de vos aliments chaque jour
			</div> 			
		</div>
	<div id="detailali" >
		<?php 
		$i = 0; 
		$passe = array();
		$passePerso = array();
		$portionpasse = array();
		$portionpassePerso = array();
		foreach ($suivis as $suivi) :
			if (!empty($suivi['Suivialimentaire']['id_aliment']) AND in_array($suivi['Suivialimentaire']['id_aliment'],$passe) AND in_array($suivi['Suivialimentaire']['nomPortion'],$portionpasse) OR (empty($suivi['Suivialimentaire']['id_aliment']) AND in_array($suivi['Suivialimentaire']['id_horsclass'],$passePerso) AND in_array($suivi['Suivialimentaire']['nomPortion'],$portionpassePerso))) {
				$i++;
				continue;
			}
			if (!empty($suivi['Suivialimentaire']['id_aliment'])) $passe[] = $suivi['Suivialimentaire']['id_aliment'];
			else $passePerso[] = $suivi['Suivialimentaire']['id_horsclass'];
			if (!empty($suivi['Suivialimentaire']['id_aliment'])) $portionpasse[] = $suivi['Suivialimentaire']['nomPortion'];
			else $portionpassePerso[] = $suivi['Suivialimentaire']['nomPortion'];
			
			echo '<div class="b1" style="margin-left:-100px">';
			echo '<article class="bloc-menu">';
			$fichier = !empty($alim[$i]['Aliment']) ? $alim[$i]['Aliment']['Aliment']['chemin'] : '';
			if ($fichier == '') {
				$fichier = 'noimage.jpg';
			}
			if (!empty($alim[$i]['Aliment'])) echo "<h3>".$this->Html->link($alim[$i]['Aliment']['Aliment']['nomFR'], '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $alim[$i]['Aliment']['Aliment']['nomFR'], 'escape' => true)) ."</h3>";
			else  echo "<h3>". $suivis[$i]['Alimhorsclassification']['nom'].'</h3>';
			
			if (!empty($alim[$i]['Aliment'])) echo '<p><strong>Groupe alimentaire</strong> : '.$alim[$i]['Aliment']['Famillealiments']['name'] . '</p>';
			else echo '<p><strong>Type</strong> : Cet aliment est un aliment hors classification</p>';
			
			echo '<p><strong>Portion ajoutée</strong> : '.$suivi['Suivialimentaire']['nomPortion'] . '</p>';
		?>
		<table>
			<tr>
				<th>Poids (g)/ Dose(ml)</th>
				<th>Energie (kcal)</th>
				<th>Energie (kj)</th>
				<th>Protéines (g)</th>
				<th>Glucides (g)</th>
				<th>Sucres totaux (g)</th>
				<th>Fibres alimentaires totales (g)</th>
				<th>Lipides (g)</th>
				<th>Gras saturés (g)</th>
				<th>Cholestérol (mg)</th>
			</tr>
			<tr><?php if (!empty($alim[$i]['Aliment'])) : ?>
				<td><?php echo $suivi['Suivialimentaire']['portion']; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][1]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][0]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][16]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][18]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][19]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][22]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][23]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][24]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][56]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<?php else : 
					$split = explode("@",$suivi['Alimhorsclassification']['nutri']);
				?>
				<td><?php echo $suivi['Suivialimentaire']['portion']; ?></td>
				<td><?php echo $split[1] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[0] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[16] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[18] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[19] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[22] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[23] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[24] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[56] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<?php endif; ?>
			</tr>
		</table>
		<table>
			<tr>
				<th>Calcium (mg)</th>
				<th>Fer (mg)</th>
				<th>Sodium (mg)</th>
				<th>Potassium (mg)</th>
				<th>Magnesium (mg)</th>
				<th>Phosphore (mg)</th>
				<th>Thiamine (mg)</th>
				<th>Riboflavine (mg)</th>
				<th>Niacine (mg)</th>
				<th>Folates (microg)</th>
			</tr>
			<tr><?php if (!empty($alim[$i]['Aliment'])) : ?>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][9]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][11]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][5]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][8]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][6]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][7]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][47]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][48]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][49]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $alim[$i]['Aliment']['Donneesaliment'][53]['valmoy'] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<?php else : ?>
				<td><?php echo $split[9] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[11] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[5] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[8] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[6] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[7] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[47] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[48] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[49] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<td><?php echo $split[53] * $suivi['Suivialimentaire']['portion']/100; ?></td>
				<?php endif; ?>
			</tr>
		</table>
		<?php echo '</article>';
			  echo '</div>';
			  $i++;
			  endforeach; ?>
		
				
			
	</div>
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
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
jQuery(function($){
        $('a.zoombox').zoombox();

        /**
        * Or You can also use specific options
        $('a.zoombox').zoombox({
            theme       : 'zoombox',        //available themes : zoombox,lightbox, prettyphoto, darkprettyphoto, simple
            opacity     : 0.8,              // Black overlay opacity
            duration    : 800,              // Animation duration
            animation   : true,             // Do we have to animate the box ?
            width       : 500,              // Default width
            height      : 500,              // Default height
            gallery     : true,             // Allow gallery thumb view
            autoplay : false                // Autoplay for video
        });
        */
	});
</script>