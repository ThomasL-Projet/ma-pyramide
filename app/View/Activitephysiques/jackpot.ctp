<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Activité Physique');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Un suivi de votre activité physique dans le temps.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mes activités physiques', 'Javascript:void(0);'); ?></li>
</nav>
<?php
echo $this->Form->create('Activitephysique');

if (isset($activite) AND empty($activite)) :
    echo '<h1 align="center">Activité indisponible</h1>';
else :
    ?>


    <div id="presentation">
        <div class="row">
            <div class="small-12 columns">

                <div class="title-area"> Mes activités physiques</div> 
                <div class="textarea">
                    <p class="text-justify">
                        Utilisez cet outil pour chercher une activité et voir combien de calories
                        vous pouvez brûler en la pratiquant
                    </p>			
                </div>   
            </div>

            <div>

                <label for="rech">Catégories</label>

                <!-- Liste déroulante permettant à l'utilisateur de choisir dans quelle catégorie d'aliments, se trouve l'aliment qu'il recherche.
                     Cette dernière a pour but de faciliter la recherche. -->
                <!-- type -->
                <?php if (isset($classes) AND isset($_POST['rech'])): ?>
                    <select name = "rech" id="rech">
                        <option selected><?php echo $_POST['rech']; ?></option>
                    </select>
                <?php else: ?>
                    <select name = "rech" id="rech" >
                        <option selected>- Choisissez une catégories -</option>
                        <?php
                        foreach ($rubriques as $rub) {
                            echo '<option value="' . $rub['Activitephysique']['GRANDE_RUBRIQUE'] . '">' . $rub['Activitephysique']['GRANDE_RUBRIQUE'] . '</option>';
                        }
                        ?>
                    </select> 
                <?php endif; ?>

                <input type="submit" value="Valider" class="button">



                <input class="button" type="submit" name="reinit" value="Réinitialiser" />	
                <?php echo $this->Html->link('<input class="button" type="button" name="jack" value="JackPot Santé" >', '/activitephysiques/vuejackpot/', array('escape' => false)); ?>              
                <?php if (isset($user) AND ! empty($user['Activitefavorite'])) : ?>
                    <input class="button" type="submit" name="alifav" value="Mes activités favorites" />	
                <?php endif; ?>


            </div>



            <div id="encyclo" style="margin-top:-20px">
                <?php
                if (isset($activitefavorite)) {
                    echo '<span> Vos activités favorites </span>';
                } else {
                    echo '<span> Résultats </span>';
                }
                ?>
                    <!-- <span> Résultats </span>-->
                <!-- On affiche ici les caractéristique du premier aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
                <div class="bloc-acti" >
                    <?php
                    if (isset($resultats)) :
                        if (sizeof($resultats) >= 1) {
                            echo "<ul>";
                            $compteurResultats = 0;
                            // Ici on peut modifier le nombre de résultats affichés
                            foreach ($resultats as $resultat) {
                                $compteurResultats++;
                                if ($compteurResultats > 100) {
                                    break;
                                }
                                ?>

                                <li>
                                    <?php
                                    echo $this->Html->link($resultat['Activitephysique']['ACTIVITE_SPECIFIQUE'], '/activitephysiques/jackpot/' . $resultat['Activitephysique']['id']);
                                    ?>

                                </li>
                                <?php
                            }
                            echo "</ul>";
                        } else {
                            echo "Aucun résultat ne correspond à votre recherche";
                        }
                    endif;
                    ?>	
                </div>



                <?php if (isset($activite)): ?>
                    <!-- On affiche ici les caractéristique du second aliment pour lequel l'utilisateur souhaite effectuer une comparaison avec un autre aliment -->
                    <div class="bloc-droit"> 		

                        <div class="titre">
                            <?php
                            echo "<h2>" . $activite['Activitephysique']['ACTIVITE_SPECIFIQUE'] . "</h2>";
                            echo "<hr/>";
                            ?>				
                        </div>

                        <div id="caract" class="choix-portion"> 
                            <!-- Ici, l'utilisateur peut chosir la quantité pour laquelle il souhaite effectuer la comparaison -->
                            <p>Entrez la durée (en min): </p>
                            <input type="text" name="duree" id="duree"/>


                            <div class="choix-portion">
                                <!--Ajout de la date-->
                                <input class="button" type="submit" name="activite" value="Ajouter à mes activités" onclick="return confirm_ajout1();" />
                                <br/>
                                <?php
                                if (!isset($user)) {
                                    echo '<input class="button" type="submit" name="ajouterfav" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
                                } else {
                                    $estPresent = false;
                                    foreach ($user['Activitefavorite'] as $fav) {
                                        if ($activite['Activitephysique'] ['id'] == $fav['idacti']) {
                                            $estPresent = true;
                                        }
                                    }
                                    if ($estPresent) {
                                        echo '<input class="button" type="submit" name="retirerfav" value="Retirer des favoris" onclick="return confirm_retirer_fav_gauche();" />';
                                    } else {
                                        echo '<input class="button" type="submit" name="ajouterfav" value="Ajouter aux favoris" onclick="return confirm_ajout_fav_gauche();" />';
                                    }
                                }
                                ?>

                            </div>	   
                        </div> 

                    </div>                                        




                <?php endif; ?>
            </div>

            </form>
            <script type="text/javascript">
                function myFunction() {
                    document.getElementById("myDate").value = "2014-02-09";
                }







                function confirm_ajout_fav_gauche() {
                    var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
                    if (isNaN(id_user)) {
                        /* Utilisateur non connecté */
                        alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                        return false;
                    }
                    /* else : utilisateur connecté */
    <?php if (isset($activite1)) : ?>
                        if (confirm("Confirmez-vous l'ajout de l'activité <?php echo str_replace('"', '\'', $activite1['Activitephysique']['ACTIVITE_SPECIFIQUE']); ?> à vos activités favorites ?")) {
                            return true;
                        } else {
                            return false;
                        }
    <?php endif; ?>
                }

                function confirm_retirer_fav_gauche() {
                    var id_user = parseInt('<?php echo AuthComponent::user('id'); ?>');
                    if (isNaN(id_user)) {
                        /* Utilisateur non connecté */
                        alert("Vous devez vous connecter pour utiliser cette fonctionnalitée !");
                        return false;
                    }
                    /* else : utilisateur connecté */
    <?php if (isset($aliment1)) : ?>
                        if (confirm("Confirmez-vous le retrait de l'activité <?php echo str_replace('"', '\'', $activite1['Activitephysique']['ACTIVITE_SPECIFIQUE']); ?>de vos activité favorites ?")) {
                            return true;
                        } else {
                            return false;
                        }
    <?php endif; ?>
                }


                function confirm_ajout1() {
                    var date = document.getElementById("myDate").value;
                    if (!date) {
                        alert("Veuillez saisir une date");
                        return false;
                    }

                    var q = document.getElementById('duree').value;
                    if (isNaN(q))
                    {
                        alert('La durée doit être écrite en chiffre');
                        return false;
                    }
                    if (!q)
                    {
                        alert('Vous devez saisir une durée');
                        return false;
                    }


                    if (confirm("Confirmez-vous l'ajout de cette activité ? ")) {
                        return true;
                    } else {
                        return false;
                    }
                }



            </script>
        <?php endif; ?>
    </div>
</div>
</div>