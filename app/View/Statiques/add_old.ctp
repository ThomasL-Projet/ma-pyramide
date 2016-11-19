<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/statiques/');?>
<?php 
if (AuthComponent::user('role') == 'administrateur') :
	echo $this->html->script('ckeditor/ckeditor.js');
	echo $this->Form->create('Statique', array('action' => 'add')); 
	echo $this->Form->input('id', array('type'=>'hidden')); 
?>
<?php echo $this->Html->css('/js/image-picker-master/image-picker/image-picker.css'); ?>
<?php echo $this->Html->script('image-picker-master/image-picker/image-picker.js'); ?>
<?php echo $this->Html->script('image-picker-master/image-picker/image-picker.min.js'); ?>

	<div class="span2">Informations sur la page</div>
	<div class="bloc1" style="width:780px">
		<label for="StatiqueTitle">Titre de la page</label>
		<div class="input text">
			<input style="margin-right:200px" name="data[Statique][title]" maxlength="150" type="text" id="StatiqueTitle" required="required"/>
		</div></br></br>
		<div class="input select" style="margin-right:200px">
			<label for="StatiqueCategoryId">Catégorie</label>
			<select name="data[Statique][category_id]" id="StatiqueCategoryId">
				<?php 
				$sous_type ="";
				foreach ($categories as $categorie) {
						if ($sous_type != $categorie['Categoriesimage']['sous_partie']) {
							echo '<option disabled>'.$categorie['Categoriesimage']['sous_partie'].'</option>';
							$sous_type = $categorie['Categoriesimage']['sous_partie'];
						}
						
						echo "<option value=" . $categorie['Categoriesimage']['id'] . ">" . $categorie['Categoriesimage']['name'] . "</option>";
					  } ?>
			</select>
			</div><br></br>
			<label for="StatiqueTitreonglet">Nom du nouvel onglet</label>
			<div class="input text">
				<input style="margin-right:200px" name="data[Statique][titreonglet]" maxlength="20" type="text" id="StatiqueTitreonglet" required="required"/>
			</div></br>
			<div class="info" style="right:80px">
				Attention : Une page est présentée comme ci-dessous.<br>
				Vous devrez donc choisir le titre, et les differents<br>
				textes qui iront dans les differents paragraphes.<br>
				Cependant un paragraphe peut etre vide.
				
			</div>
			<div class="row">
			<?php
				echo $this->Html->image('page.png', array('alt' => 'mise en forme d\'une page du site', 'width' => 434, 'height' => 342, 'style' => 'margin-left:120px'));
			?>
				<div id="clickicipage">
					<?php echo $this->Html->link('Cliquez ici pour agrandir l\'image', '../app/webroot/img/page.png', array('class' => 'zoombox', 'alt' => 'agrandir l\'image', 'escape' => true)); ?>
				</div>
			</div>
			<div style="margin-left:40px; display:none; text-align:center;" id="imgActPhy">
				<br />
				<p>Choisissez une à deux images : (cliquez dessus) <br /><br />La première cliquée sera celle en haut de la page.<br /> La deuxième sera celle associée au "Paragraphe 2".</p><br />
				
				<select id="row" multiple="multiple" class="image-picker show-labels show-html" name="images[]">
					<option data-img-src="../../img/ActiPhy/vignetes/472601-lavette-moppe-traditionnelle-absorbe-laisse.jpg" value="1">lavette moppe traditionnelle absorbe laisse</option>
					<option data-img-src="../../img/ActiPhy/vignetes/beche-outil-de-jardinage.jpg" value="2">beche outil de jardinage</option>
					<option data-img-src="../../img/ActiPhy/vignetes/bicyclette.jpg" value="3">bicyclette</option>
					<option data-img-src="../../img/ActiPhy/vignetes/bucheron.jpg" value="4">bucheron</option>
					<option data-img-src="../../img/ActiPhy/vignetes/courseapiedcopains.jpg" value="5">course a pied copains</option>
					<option data-img-src="../../img/ActiPhy/vignetes/Escalad.jpg" value="6">Escalade</option>
					<option data-img-src="../../img/ActiPhy/vignetes/foot.jpg" value="7">foot</option>
					<option data-img-src="../../img/ActiPhy/vignetes/gif_football.jpg" value="8">football</option>
					<option data-img-src="../../img/ActiPhy/vignetes/images.jpg" value="9">images</option>
					<option data-img-src="../../img/ActiPhy/vignetes/jogging.jpg" value="10">jogging</option>
					<option data-img-src="../../img/ActiPhy/vignetes/macons_et_murs_k.jpg" value="11">macons et murs</option>
					<option data-img-src="../../img/ActiPhy/vignetes/natation.jpg" value="12">natation</option>
					<option data-img-src="../../img/ActiPhy/vignetes/pa_runner_with_dog.jpg" value="13">runner with dog</option>
					<option data-img-src="../../img/ActiPhy/vignetes/promener_son_chien.jpg" value="14">promener son chien</option>
					<option data-img-src="../../img/ActiPhy/vignetes/promener_son_chien1.jpg" value="15">promener son chien1</option>
					<option data-img-src="../../img/ActiPhy/vignetes/ramer.jpg" value="16">ramer</option>
					<option data-img-src="../../img/ActiPhy/vignetes/skidefond.jpg" value="17">ski de fond</option>
					<option data-img-src="../../img/ActiPhy/vignetes/tennisdetable.jpg" value="18">tennis de table</option>
				</select>
				
			</div>
			<div style="margin-left:40px; display:none; text-align:center;" id="imgGP">
				<br />
				<p>Choisissez une à deux images : (cliquez dessus) <br /><br />La première cliquée sera celle en haut de la page.<br /> La deuxième sera celle associée au "Paragraphe 2".</p><br />
				
				<select id="row2" multiple="multiple" class="image-picker show-labels show-html" name="images[]">
					<option data-img-src="../../img/GestionPond/vignetes/7601.jpg" value="1">7601</option>
					<option data-img-src="../../img/GestionPond/vignetes/8601.jpg" value="2">8601</option>
					<option data-img-src="../../img/GestionPond/vignetes/9102.jpg" value="3">9102</option>
					<option data-img-src="../../img/GestionPond/vignetes/14481_une.jpg" value="4">14481_une</option>
					<option data-img-src="../../img/GestionPond/vignetes/alimentssucrés.jpg" value="5">aliments sucrés</option>
					<option data-img-src="../../img/GestionPond/vignetes/boissonsucrée.jpg" value="6">boisson sucrée</option>
					<option data-img-src="../../img/GestionPond/vignetes/etalagedefruits.jpg" value="7">etalage de fruits</option>
					<option data-img-src="../../img/GestionPond/vignetes/etiquettesalimentaires.jpg" value="8">etiquettes alimentaires</option>
					<option data-img-src="../../img/GestionPond/vignetes/femmecuisinemaison.jpg" value="9">femme cuisine maison</option>
					<option data-img-src="../../img/GestionPond/vignetes/fruitsvariés.jpg" value="10">fruits variés</option>
					<option data-img-src="../../img/GestionPond/vignetes/gestion_poids.jpg" value="11">gestion poids</option>
					<option data-img-src="../../img/GestionPond/vignetes/mangerendehorsdelamaison.jpg" value="12">manger en dehors de la maison</option>
					<option data-img-src="../../img/GestionPond/vignetes/mangerlegeraurestaurant.jpg" value="13">manger leger au restaurant</option>
					<option data-img-src="../../img/GestionPond/vignetes/mesurezcequevousmangez.jpg" value="14">mesurez ce que vous mangez</option>
					<option data-img-src="../../img/GestionPond/vignetes/petitdéjeuner.jpg" value="15">petit déjeuner</option>
					<option data-img-src="../../img/GestionPond/vignetes/planificationalimentaire.jpg" value="16">planification alimentaire</option>
					<option data-img-src="../../img/GestionPond/vignetes/salade-de-fruits-frais.jpg" value="17">salade de fruits frais</option>
					<option data-img-src="../../img/GestionPond/vignetes/scale.jpg" value="18">scale</option>
				</select>
				
			</div>
		</div>
	
	<div class="span2">Contenu de la page</div>
		<div id="bloc-editeur">
			<div style="font-style:italic; text-align:center; font-size:1.4em">PARAGRAPHE 1 :</div><br>
			<div class="input textarea">
				<label for="StatiqueContent1"></label>
				<textarea name="data[Statique][content1]" cols="160" rows="5" id="StatiqueContent1"></textarea>
				<?php echo $this->Ck->load('Statique.content1'); ?>
			</div>
		
			<div style="font-style:italic; text-align:center; font-size:1.4em; margin-top:20px">PARAGRAPHE 2 :</div><br>
			<div class="input textarea">
				<label for="StatiqueContent2"></label>
				<textarea name="data[Statique][content2]" cols="160" rows="5" id="StatiqueContent2"></textarea>
				<?php echo $this->Ck->load('Statique.content2'); ?>
			</div>
			
			<div style="font-style:italic; text-align:center; font-size:1.4em; margin-top:20px">PARAGRAPHE 3 :</div><br>
			<div class="input textarea">
				<label for="StatiqueContent3"></label>
				<textarea name="data[Statique][content3]" cols="160" rows="5" id="StatiqueContent3"></textarea>
				<?php echo $this->Ck->load('Statique.content3'); ?>
			</div>
		</div>
		<div id="bloc11" style="margin-left:450px;">
			
		    <?php echo $this->Form->end(array('label'=> 'Enregistrer')); ?> 
			<?php echo $this->Html->link('<input style="margin-left:10px;" type="button" value="Annuler">', '/statiques/', array('escape' => false));?>
		</div>

		<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
$("#row").imagepicker({
	hide_select : true,
    show_label  : false,
	limit : 2,
	limit_reached: function(){alert('Vous ne pouvez sélectionner que deux images. Pour en remplacer ou en supprimer, veuillez re-cliquer dessus pour les déselectionner')}
});
$("#row2").imagepicker({
	hide_select : true,
    show_label  : false,
	limit : 2,
	limit_reached: function(){alert('Vous ne pouvez sélectionner que deux images. Pour en remplacer ou en supprimer, veuillez re-cliquer dessus pour les déselectionner')}
});
var valSelect = $("#StatiqueCategoryId").val();
if (valSelect == 2) {
	$("#imgActPhy").show();
	$("#imgGP").hide();
	$("#row2").attr("disabled",true);
	$("#row").attr("disabled",false);
} else if (valSelect == 1 || valSelect == 3 || valSelect == 10) {
	$("#imgActPhy").hide();
	$("#imgGP").show();
	$("#row2").attr("disabled",false);
	$("#row").attr("disabled",true);
} else {
	$("#imgActPhy").hide();
	$("#imgGP").hide();
	$("#row2").attr("disabled",true);
	$("#row").attr("disabled",true);
}
$("#StatiqueCategoryId").change(function(){
	var valSelect = $(this).val();
	if (valSelect == 2) {
		$("#imgActPhy").show();
		$("#imgGP").hide();
		$("#row2").attr("disabled",true);
		$("#row").attr("disabled",false);
	} else if (valSelect == 1 || valSelect == 3 || valSelect == 10) {
		$("#imgActPhy").hide();
		$("#imgGP").show();
		$("#row2").attr("disabled",false);
		$("#row").attr("disabled",true);
	} else {
		$("#imgActPhy").hide();
		$("#imgGP").hide();
		$("#row2").attr("disabled",true);
		$("#row").attr("disabled",true);
	}
})
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
<?php endif; ?>
</div>