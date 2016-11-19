<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/pages/home/');?>
<div class="span2"> Choisissez quelle(s) photo(s) à modifier </div> 
<div class="bloc1" style="width:780px">	
<?php
echo $this->html->link('Gérer les photos du <strong>slider</strong>', '/photos/index/', array('escape' => false));
echo '<br /><br /><hr /><br />';
echo $this->html->link('Gérer les photos des <strong>aliments</strong>', '/aliments/edit/', array('escape' => false));
echo '<br /><br /><hr /><br />';
echo $this->html->link('Gérer les photos de la <strong>galerie</strong>', '/images/', array('escape' => false));
echo '<br /><br /><hr /><br />';
echo $this->html->link('Gérer les <strong>vidéos</strong> de la <strong>galerie</strong>', '/videos/', array('escape' => false));


?>
</div>
<div id="retour1" style="margin-left:980px; position:absolute; margin-top: 130px ">
		<?php echo $this->Html->link('<input type="button" name="retour" value="Retour" >', '/pages/home', array('escape' => false));?>
</div>
</div>