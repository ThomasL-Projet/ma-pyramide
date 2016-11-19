<div id="presentation">
<?php echo $this->Html->link('<< Retour', '/evolutionphysiques/edit/');
//if ($affichage) :
echo $this->Form->create('Evolutionphysiques');
  ?>
<div class="span2"> Modifiez vos activitées physique </div> 
	<div class="bloc1">
			   	<div class="titre">
					<?php
						echo "<h2>".$activite['Activitephysique']['ACTIVITE_SPECIFIQUE']."</h2></br></br>";
					?>				
                               </div>
				
				<div id="caract" class="choix-portion"> 
				<!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
				<form name="form">
				    <p> Entrez la durée (en min): </p>
                                    <input type="text" name="duree" id="duree"/><br />
                                                               

                                
				   
				   <!-- L'utilisateur choisi ici la taille de la portion : "petites portions", "moyennes portions" ou "grandes portions" -->	
                                   			  	<!-- L'utilisateur peut afficher des informations concernant l'aliment mais aussi les caractéristiques nutritionelles de ce dernier -->
						
				<!--<div class="info-aliment" id='info-aliment'>-->
				      	

					<?php $split = explode(" ",$suivi['Suiviphysique']['jourAP']);?>
					
						

					<div class="choix-portion"></br>
					<!--Ajout de la date-->
					<p> Entrez la date de l'activité: </p>
                                        <input name="date" type="date" id="myDate" value="<?php echo $split[0] ;?>">
                                        <input style="right:-90px; margin-top: 50px;" type="submit" name="activite" value="Modifier" onclick="return (confirm())" />
				</form>

				</div>	   
				</div> 
                           
                                </div>                                        

			
					
				  
        </div>
	
	</div>
		

</div></div>
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
function confirm() {
	var duree = document.getElementById("duree").value

	if(duree < 0){
		alert('Entrez une durée valide');
		return false 
	}			
	return true
}


</script>	
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
