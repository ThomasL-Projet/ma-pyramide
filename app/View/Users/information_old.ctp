<?php if ($affiche) : ?>
    <?php echo $this->Form->create('User'); ?>
    <div id="presentation">

        <?php echo $this->Html->link('<< Retour', '/users/index'); ?>

        <div class="span2">Nom du compte de votre enfant : </div> 	
        <div class="bloc-index">
            <label><?php echo $enfant['User']['username']; ?></label>

        </div>

        <div class="span2">Sexe : </div> 	
        <div class="bloc-index">
            <?php if ($age < 18) : ?>
                <?php
                echo '<select name="sexe">';
                if ($enfant['User']['sexe'] == "homme") {
                    echo '<option value="homme" selected="selected">Garçon</option>';
                    echo '<option value="femme" >Fille</option>';
                } else {
                    echo '<option value="homme" >Garçon</option>';
                    echo '<option value="femme" selected="selected">Fille</option>';
                }
                echo '</select>';
                ?>
            <?php else : ?>
                <label><?php echo $enfant['User']['sexe']; ?></label>
            <?php endif; ?>
        </div>

        <div class="span2">Taille : </div> 	
        <div class="bloc-index">
            <?php if ($age < 18) : ?>
                <input type="field" name="taille" id="UserTaille" value="<?php echo intval($enfant['User']['taille']); ?>"></input><label> cm</label>
            <?php else : ?>
                <label><?php echo $enfant['User']['taille']; ?> cm</label>
            <?php endif; ?>
        </div>

        <div class="span2">Poids : </div> 	
        <div class="bloc-index">
            <?php if ($age < 18) : ?>
                <input type="field" name="poids" id="UserPoids" value="<?php echo intval($enfant['User']['poids']); ?>"></input><label> kg</label>
            <?php else : ?>
                <label><?php echo $enfant['User']['poids']; ?> kg</label>
            <?php endif; ?>
        </div>

        <div class="span2">Email : </div> 	
        <div class="bloc-index">
            <?php if ($age < 18) : ?>
                <input type="field" name="email" id="UserEmail" value="<?php echo $enfant['User']['email']; ?>"></input><label></label>
            <?php else : ?>
                <label><?php echo $enfant['User']['email']; ?></label>
            <?php endif; ?>
        </div>

        <?php if ($enfant['User']['activite'] != null OR ( $enfant['User']['activite'] == null AND $age >= 3)) : ?>
            <div class="span2">Activité : </div> 	
            <div class="bloc-index">
                <?php if ($age < 18) : ?>
                    <select name="activite" id="UserActivite" onchange="changeNotice()">
                        <?php
                        if ($enfant['User']['activite'] != null) :
                            if ($enfant['User']['activite'] == "sédentaire") {
                                echo '<option value="sédentaire" selected="selected">Sédentaire</option>';
                                echo '<option value="peu actif">Peu actif</option>';
                                echo '<option value="actif">Actif</option>';
                                echo '<option value="très actif">Très actif</option>';
                                echo '</select></br></br>';
                                echo '<div class="p4" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                            } elseif ($enfant['User']['activite'] == "peu actif") {
                                echo '<option value="sédentaire">Sédentaire</option>';
                                echo '<option value="peu actif" selected="selected">Peu actif</option>';
                                echo '<option value="actif">Actif</option>';
                                echo '<option value="très actif">Très actif</option>';
                                echo '</select></br></br>';
                                echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS de 30 à 60 minutes d’activités physiques modérées par jour <br>(p. ex. marcher à une vitesse de 5 à 7 km/h).<br>&nbsp</div>';
                            } elseif ($enfant['User']['activite'] == "actif") {
                                echo '<option value="sédentaire">Sédentaire</option>';
                                echo '<option value="peu actif">Peu actif</option>';
                                echo '<option value="actif" selected="selected">Actif</option>';
                                echo '<option value="très actif">Très actif</option>';
                                echo '</select></br></br>';
                                echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées <br>par jour.<br>&nbsp</div>';
                            } elseif ($enfant['User']['activite'] == "très actif") {
                                echo '<option value="sédentaire">Sédentaire</option>';
                                echo '<option value="peu actif">Peu actif</option>';
                                echo '<option value="actif">Actif</option>';
                                echo '<option value="très actif" selected="selected">Très actif</option>';
                                echo '</select></br></br>';
                                echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées par jour <br>PLUS 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.<br>&nbsp</div>';
                            } else {
                                
                            }
                        else :
                            echo '<option value="sédentaire">Sédentaire</option>';
                            echo '<option value="peu actif">Peu actif</option>';
                            echo '<option value="actif">Actif</option>';
                            echo '<option value="très actif">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                        endif;
                        ?>
                        <label for="sssa">&nbsp</label> 
                        <div  class="bold">&nbsp</div>
        <?php else : ?>
                        <label><?php echo $enfant['User']['activite']; ?></label>
                        <label for="sssa">&nbsp</label> 
                        <div  class="bold">&nbsp</div>
                        <?php
                        if ($enfant['User']['activite'] == "très actif") {
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées par jour <br>PLUS 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.<br>&nbsp</div>';
                        } elseif ($enfant['User']['activite'] == "actif") {
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées <br>par jour.<br>&nbsp</div>';
                        } elseif ($enfant['User']['activite'] == "sédentaire") {
                            echo '<div class="p4" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                        } elseif ($enfant['User']['activite'] == "peu actif") {
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS de 30 à 60 minutes d’activités physiques modérées par jour <br>(p. ex. marcher à une vitesse de 5 à 7 km/h).<br>&nbsp</div>';
                        }
                        ?>
            <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php if ($age < 18) : ?>
            <div id="bloc9">
                <input type="submit" value="Modifier" onClick="return validerForm()"/>
            </div>
    <?php endif; ?>
    </div>
    <script type="text/javascript">
        function changeNotice() {
            var i = document.getElementById("UserActivite").selectedIndex;
            if (i == 0) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp";
            } else if (i == 1) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base PLUS de 30 à 60 minutes d’activités physiques modérées par jour <br>(p. ex. marcher à une vitesse de 5 à 7 km/h).";
            } else if (i == 2) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées <br>par jour.";
            } else if (i == 3) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées par jour <br>PLUS 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.";
            }
        }

        function validerForm() {
            var regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
            if (!(regex.test(document.getElementById("UserEmail").value))) {
                alert("L'adresse email n'est pas une adresse valide");
                return false;
            }
            regex = /^[0-9]{1,3}$/;
            if (!(regex.test(document.getElementById("UserTaille").value))) {
                alert("La taille est invalide");
                return false;
            }
            regex = /^[0-9]{1,3}$/;
            if (!(regex.test(document.getElementById("UserPoids").value))) {
                alert("Le poids est invalide");
                return false;
            }
            if (!(document.getElementById("UserTaille").value > 0 && document.getElementById("UserTaille").value <= 250)) {
                alert("La taille est invalide");
                return false;
            }
            if (!(document.getElementById("UserPoids").value > 0 && document.getElementById("UserPoids").value <= 300)) {
                alert("Le poids est invalide");
                return false;
            }

            return true;
        }
    </script>
<?php endif; ?>
