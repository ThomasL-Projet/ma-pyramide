<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/suivialimentaires/edit/'); ?>
<?php if (!$affichage) : ?>
	<!-- Url incorrecte -->
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php else : ?>
<?php echo $this->Form->create('Suivialimentaire');
  ?>
<div class="span2"> Ajouter au suivi alimentaire </div> 
	<div class="bloc1" style="width:700px;">
	<?php 
		echo '<div style="margin-left:8px;"><h3>'.$alimhorsclass['Alimhorsclassification']['nom'].'</div></h2>';
	?>
	<div class="suivali">Quantitee : </div>
	<select name="quantite">
		<?php 
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 0.5) echo "<option value='0.5' selected='selected'>&frac12;</option>"; else echo "<option value='0.5'>&frac12;</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 1) echo "<option value='1' selected='selected'>1</option>"; else echo "<option value='1'>1</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 1.5) echo "<option value='1.5' selected='selected'>1 &frac12;</option>"; else echo "<option value='1.5'>1 &frac12;</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 2) echo "<option value='2' selected='selected'>2</option>"; else echo "<option value='2'>2</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 2.5) echo "<option value='2.5' selected='selected'>2 &frac12;</option>"; else echo "<option value='2.5'>2 &frac12;</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 3) echo "<option value='3' selected='selected'>3</option>"; else echo "<option value='3'>3</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 3.5) echo "<option value='3.5' selected='selected'>3 &frac12;</option>"; else echo "<option value='3.5'>3 &frac12;</option>";
		if(isset($save['Suivialimentaire']['quantite']) AND $save['Suivialimentaire']['quantite'] == 4) echo "<option value='4' selected='selected'>4</option>"; else echo "<option value='4'>4</option>";
		?>
	</select>
	<br><br><br>
	<div class="suivali">Portion (en g): </div>
	<input type="text" value="<?php echo $alimhorsclass['Alimhorsclassification']['portion']; ?>" maxlength="5" id="saisie3" name="portion2" disabled="disabled"/><br />
	<div class="info" style="margin:0px; margin-left:130px;right:100px">
				Pour modifier la portion vous devez modifier directement l'aliment, <br />
				puis modifier sa portion<br>
				
	</div><br /><br /><br />
	
	<div class="suivali">Moment : </div>
	<br><br>
	<div class="suivalicheck">
	<?php 
		echo '<input type="checkbox" name="moment1" id="moment1" value="Petit d&eacute;jeuner"> Petit d&eacute;jeuner<br>';
		echo '<input type="checkbox" name="moment2" id="moment2" value="D&eacute;jeuner"> D&eacute;jeuner<br>';
		echo '<input type="checkbox" name="moment3" id="moment3" value="Go&ucirc;ter"> Go&ucirc;ter<br>';
		echo '<input type="checkbox" name="moment4" id="moment4" value="D&icirc;ner"> D&icirc;ner<br>';
	?>
	</div><br />
	<input type="submit" style="width:220px; margin-left: 75px;" value="Ajouter au suivi alimentaire" onClick="return confirm();">
	
	</div>
		
<?php endif;?>
</div></div>
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
function confirm() {
	if (!document.getElementById('moment1').checked && !document.getElementById('moment2').checked && !document.getElementById('moment3').checked && !document.getElementById('moment4').checked) {
		alert("Vous n'avez pas sélectionné de repas");
		return false;
	}
	return true;
}


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
