<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/suivialimentaires/index/');
if (!(empty($infosSuivi) AND empty($infosAliment))) :
  ?>
<div class="span2"> Vos repas d'aujourd'hui </div> 
	
		<?php
			for ($i = 0; $i < count($infosSuivi); $i++) {
				echo '<div class="bloc1" style="width:770px"><center>';
				
				$fichier = isset($infosAliment[$i][0]['Aliment']) ? $infosAliment[$i][0]['Aliment']['chemin'] : '';
				if ($fichier == '') {
					$fichier = 'noimage.jpg';
				}
				if (isset($infosAliment[$i][0]['Alimhorsclassification'])) echo "<h3>".$infosAliment[$i][0]['Alimhorsclassification']['nom'] ."</h3>";
				else echo "<h3>".$this->Html->link($infosAliment[$i][0]['Aliment']['nomFR'], '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $infosAliment[$i][0]['Aliment']['nomFR'], 'escape' => true)) ."</h3>";
				
				
				echo 'Quantité : ' . $infosSuivi[$i]['Suivialimentaire']['quantite']. '<br />';
				echo 'Portion : ' . $infosSuivi[$i]['Suivialimentaire']['nomPortion'] . '<br />';
				echo 'Moment : ';
				$split = explode("@",$infosSuivi[$i]['Suivialimentaire']['nomSA']);
				for ($j=0; $j < count($split);$j++) {
					 if ($j == (count($split)-1)) {
						echo $split[$j] . '<br /><br />';
					 } else {
						echo $split[$j] . ' / ';
					 }
				}
				echo $this->Html->link('<input type="button" style="margin:0;margin-left:283px;" value="Modifier"/>', '/suivialimentaires/modif/' . $infosSuivi[$i]['Suivialimentaire']['id'], array('escape' => false));
				echo $this->Html->link('<input type="button" style="margin:0"value="Supprimer"/>', '/suivialimentaires/delete/' . $infosSuivi[$i]['Suivialimentaire']['id'], array('escape' => false));
				echo '</center></div>';
			}

	echo '<div id="bloc-editeur" style="margin-top:40px"><center>';
	echo '<div style="font-style:italic">Navigation : </div>';
	echo $this->Paginator->prev('<<'.__('Précédent',true), array(), null, array('class'=>'disable'));
		echo $this->Paginator->numbers();
		 echo $this->Paginator->next('Suivant'.__('>>',true), array(), null, array('class'=>'disable'));
	echo '</center></div>';

endif;?>
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
