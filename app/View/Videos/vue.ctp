<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<div id="presentation">
    <?php echo $this->Html->link('<< Retour', '/pages/home/'); ?>
    <div class="texte">

        <div class="span1"> Gallerie de vidéos </div> <br />
        <?php
        if (empty($videos)) :
            echo '<center><div style="color:red;font-size:1.4em;margin-top:100px; position:absolute;margin-left:180px">Aucune vidéo n\'est actuellement disponible sur le site.</div></center>';
        else :
            ?>


            <?php foreach ($videos as $video) : ?>
                <?php
                $temp = explode('=', $video['Video']['url']);

                $url = $temp[1];
                ?>
                <center>
                    <table class="tablr">
                        <tr coldspan="2"><h2><?php echo $video['Video']['titre']; ?></h2><tr>
                            <td>
                                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $url ?>" frameborder="0" allowfullscreen></iframe>
                            </td>
                            <td>	
                        <center>		
                            <?php echo $video['Video']['description']; ?>
                        </center>
                        </td>

                        </td>

                    </table>
                </center>
                <br/><br/>


            <?php endforeach; ?>


            <div class="divrossi">
                <center>
                    <?php echo $this->Paginator->prev('<<' . __('Précédent', true), array(), null, array('class' => 'disable')); ?>
                    <?php echo $this->Paginator->numbers(); ?>
                    <?php echo $this->Paginator->next('Suivant' . __('>>', true), array(), null, array('class' => 'disable')); ?>		
                </center>	
            </div>
        <?php endif; ?>
    </div>



</div>	

<script type="text/javascript">
    jQuery(function ($) {
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