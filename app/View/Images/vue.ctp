	<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<div id="presentation">
	<?php echo $this->Html->link('<< Retour', '/pages/home/');?>
    <div class="texte">

		<div class="span1"> Gallerie d'images </div> <br />
<?php if (empty($images)) :
echo '<center><div style="color:red;font-size:1.4em;margin-top:100px; position:absolute;margin-left:180px">Aucune image n\'est actuellement disponible sur le site.</div></center>';
else :
?>
		<br /><center><table class="tabl">
		<?php $i = 0; ?>
		<tr>
		<?php foreach ($images as $image) : ?>

		<?php
		if ($image['Image']['url'] == null) {
			 $url = "../app/webroot/img/urls/noimage.jpg";
			} else {
			 $url = "../app/webroot/img/urls/".$image['Image']['url'];
			}
		 
		 ?>
		<?php if ($i % 4 == 0) {
			echo "</tr><tr>";
		}?>
		
			<td><center>
				<h2><?php echo $this->Text->truncate($image['Image']['titre'], 
						30,	
						array('ellipsis' => '...', 'html' => true)); ?></h2>
				<br/><br/><br/>
				<?php echo $this->Html->link(

						$this->Html->image($url, array('class' => 'image', 'escape' => false, 'width' => '200', 'height' => '200','alt' => $image['Image']['titre'])), $url, array('class' => 'zoombox', 'escape' => false)

						);?>
						<br/>
				<?php echo $image['Image']['description']; ?>


			</center></td>
			<?php $i++; ?>




		<?php endforeach; ?>
		</tr>
		</table></center>

	<div class="divrossi">
	<center>
	<?php echo $this->Paginator->prev('<<'.__('Précédent',true), array(), null, array('class'=>'disable'));?>
	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next('Suivant'.__('>>',true), array(), null, array('class'=>'disable'));?>		
	</center>	
</div>
<?php endif; ?>
	</div>



</div>	

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