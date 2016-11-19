<div class="row">
    <div class="small-12 column">﻿
        <div id="presentation">

            <div class="small-12 small-centered columns">

                <?php
                echo $this->Html->link('<< Retour', '/suivialimentaires/edit/');
                if ($affichage) :
                    echo $this->Form->create('Suivialimentaire');
                    ?>
                    <div class="large-12 columns text-center">
                        <h2> Modifiez votre repas :</h2><br/> 
                    </div>
                    

                    <div class="large-12 columns">
                        <?php
                        $fichier = isset($aliment['Aliment']) ? $aliment['Aliment']['chemin'] : '';
                        if ($fichier == '') {
                            $fichier = 'noimage.jpg';
                        }
                        if (isset($aliment['Aliment']))
                            echo "<h3>" . $this->Html->link($aliment['Aliment']['nomFR'], '../app/webroot/img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $aliment['Aliment']['nomFR'], 'escape' => true)) . "</h2>";
                        else
                            echo "<h3>" . $aliment['Alimhorsclassification']['nom'] . "</h2>";
                        ?>
                        <label>Quantité
                            <select name="quantite">
                                <?php
                                if ($ancienneQuantite == 0.5) {
                                    echo "<option value='0.5' selected='selected'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5'>1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 1) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1' selected='selected'>1</option>";
                                    echo "<option value='1.5'>1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 1.5) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5' selected='selected'>1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 2) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5' >1 &frac12;</option>";
                                    echo "<option value='2' selected='selected'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 2.5) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5' >1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5' selected='selected'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 3) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5' >1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3' selected='selected'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } elseif ($ancienneQuantite == 3.5) {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5'>1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5' selected='selected'>3 &frac12;</option>";
                                    echo "<option value='4'>4</option>";
                                } else {
                                    echo "<option value='0.5'>&frac12;</option>";
                                    echo "<option value='1'>1</option>";
                                    echo "<option value='1.5'>1 &frac12;</option>";
                                    echo "<option value='2'>2</option>";
                                    echo "<option value='2.5'>2 &frac12;</option>";
                                    echo "<option value='3'>3</option>";
                                    echo "<option value='3.5'>3 &frac12;</option>";
                                    echo "<option value='4' selected='selected'>4</option>";
                                }
                                ?>
                            </select></label>

                        <label>Portion :
                            <?php if (isset($aliment['Aliment'])) : ?>
                                <select name="portion">
                                    <?php
                                    foreach ($portions as $portion) {
                                        if ($portion['portion'] == $anciennePortion) {
                                            echo '<option value="' . $portion['portion'] . '" selected="selected">' . $portion['portion'] . '</option>';
                                        } else {
                                            echo '<option value="' . $portion['portion'] . '">' . $portion['portion'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </label><br/>
                        
                        <?php else : ?>
                            <input type="text" value="<?php echo $anciennePortion; ?>" maxlength="5" id="saisie3" name="portion2" /><br><br><br>
                        <?php endif; ?>
                        <h4>Moment : </h4>
                        
                        <div class="suivalicheck">
                            <?php
                            if (in_array("Petit déjeuner", $ancienRepas)) {
                                echo '<input type="checkbox" name="moment1" id="moment1" value="Petit d&eacute;jeuner" checked> Petit d&eacute;jeuner<br>';
                            } else {
                                echo '<input type="checkbox" name="moment1" id="moment1" value="Petit d&eacute;jeuner"> Petit d&eacute;jeuner<br>';
                            }
                            if (in_array("Déjeuner", $ancienRepas)) {
                                echo '<input type="checkbox" name="moment2" id="moment2" value="D&eacute;jeuner" checked> D&eacute;jeuner<br>';
                            } else {
                                echo '<input type="checkbox" name="moment2" id="moment2" value="D&eacute;jeuner"> D&eacute;jeuner<br>';
                            }
                            if (in_array("Goûter", $ancienRepas)) {
                                echo '<input type="checkbox" name="moment3" id="moment3" value="Go&ucirc;ter" checked> Go&ucirc;ter<br>';
                            } else {
                                echo '<input type="checkbox" name="moment3" id="moment3" value="Go&ucirc;ter"> Go&ucirc;ter<br>';
                            }
                            if (in_array("Dîner", $ancienRepas)) {
                                echo '<input type="checkbox" name="moment4" id="moment4" value="D&icirc;ner" checked> D&icirc;ner<br>';
                            } else {
                                echo '<input type="checkbox" name="moment4" id="moment4" value="D&icirc;ner"> D&icirc;ner<br>';
                            }
                            ?>
                        </div><br/>
                        <input class="button" type="submit" value="Valider" onClick="return confirm();">

                    </div>

                </div>
            </div>
        </div>

    <?php endif; ?>
</div></div>
<?php echo $this->Html->script('zoombox/zoombox.js'); ?>
<?php echo $this->Html->css('/js/zoombox/zoombox.css'); ?>
<script type="text/javascript">
    function confirm() {
        if (!document.getElementById('moment1').checked && !document.getElementById('moment2').checked && !document.getElementById('moment3').checked && !document.getElementById('moment4').checked) {
            alert("Vous n'avez pas sélectionné de repas");
            return false;
        }
<?php if (!isset($aliment['Aliment'])) : ?>
            regex = /^[0-9]{1,5}$/;
            if (!(regex.test(document.getElementById("saisie3").value))) {
                alert("Erreur, la portion de l'aliment n'est pas un entier.");
                return false;
            }
<?php endif; ?>
        return true;
    }


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
