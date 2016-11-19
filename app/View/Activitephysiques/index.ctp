<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Activité Physique');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Un suivi de votre activité physique dans le temps.');
$this->end();
?>
<script>
    // Ajout du datepicker (aide pour choisir une date sur un formulaire)
    jQuery(function () {
        jQuery("#dateActivite").datepicker({
            dateFormat: "yy-mm-dd",
            altFormat: "yy-mm-dd"
        });
    });
</script>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon suivi physique', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 large-12 medium-12 columns">


            <div class="title-area"> Suivi de votre activité physique</div> 
            <div class="textarea">
                <p class="text-justify">
                    Quelle activité avez-vous récemment effectuée ?
                </p>			
            </div>   
        </div>  

        <?php echo $this->Form->create('Activitephysique'); ?>
        <div class="large-6 medium-6 small-6 columns">
            <div class="row" data-equalizer>
                <div class="large-8 medium-8 small-8 columns left inline">

                    <?php if (isset($classes) AND isset($_POST['rech'])): ?>
                        <select name = "rech" id="rech" data-equalizer-watch>
                            <option selected><?php echo ucfirst($_POST['rech']); ?></option>
                        </select>
                    <?php else: ?>
                        <select name = "rech" id="rech" data-equalizer-watch>
                            <option selected>- Choisissez une catégorie -</option>
                            <?php
                            foreach ($rubriques as $rub) {
                                echo '<option value="' . $rub['Activitephysique']['GRANDE_RUBRIQUE'] . '">' . ucfirst($rub['Activitephysique']['GRANDE_RUBRIQUE']) . '</option>';
                            }
                            ?>
                        </select> 
                    <?php endif; ?>
                </div>
                <div class="large-4 medium-4 small-4 columns right">
                    <input type="submit" class="button" value="Rechercher" data-equalizer-watch>
                </div>
            </div>
        </div>


        <?php /* echo $this->Html->link('<input type="button" name="retour" value="Retour" >', '/pages/supertracker/', array('escape' => false)); */ ?>
        <?php if (!empty($user['Activitefavorite'])) : ?>
            <div class="row">
                <div class="large-6 medium-6 small-6 columns">
                    <input type="submit" class="button" name="actifav" value="Mes activités favorites" />	
                </div>
            </div>
        <?php endif; ?>

        <div class="row">
            <div class="large-6 medium-6 small-6 columns">
                <?php
                if (isset($activitefavorite)) { /* Si une activité favorite a été spécifiée */
                    echo '<span> Vos activités favorites : </span>';
                } else if (isset($resultats)) { /* Si une recherche d'activité a été soumie */
                    echo '<span> Résultats de votre recherche, cliquer sur l\'activité effectuée : </span>';
                } else if (isset($activite)) { /* Si une activité spécifique a été spécifiée */
                    ?>
                    <br/><br/>
                    <p style="text-align:justify;"> Vous avez choisi une activité, maintenant afin d'obtenir des détails plus spécifiques et détaillés 
                        vous devez entrer un certain nombre d'information.<br/> Nous pourrons par la suite établir un suivi 
                        détaillé de votre activité physique.</p>
                    <?php
                }
                ?>
                <!-- Affichage des résultats de la recherche effectuée -->
                <?php
                if (isset($resultats)) :
                    if (sizeof($resultats) >= 1) {
                        echo "<ul>";
                        $compteurResultats = 0;
                        foreach ($resultats as $resultat) {
                            $compteurResultats++;
                            // Affichage d'au maximum 100 activités physiques pour la catégorie choisie
                            if ($compteurResultats > 100) {
                                break;
                            }
                            ?>

                            <li>
                                <?php
                                // TODO : corriger le problème d'encodage avec les apostrophes pour  $resultat['Activitephysique']['ACTIVITE_SPECIFIQUE']
                                echo $this->Html->link(utf8_decode(utf8_encode(ucfirst($resultat['Activitephysique']['ACTIVITE_SPECIFIQUE']))), '/activitephysiques/index/' . $resultat['Activitephysique']['id']);
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
            <!-- Remplissage de l'activité spécifique en détail : durée, date ... -->
            <div class="large-6 medium-6 small-6 columns">
                <?php
                if (isset($activite)):
                    echo "<h2> Votre choix : <br/>";
                    echo "<small>" . $activite['Activitephysique']['ACTIVITE_SPECIFIQUE'] . "</small></h2>";
                    ?>
                    <br/>
                    <div class="small-3 medium-4 large-4 columns">
                        <label for="right-label">Durée</label>
                    </div>
                    <div class="small-8 medium-8 large-8 columns">
                        <input type="text" name="duree" id="duree" min="0" max="250" placeholder="en minute"/>
                    </div>
                    <div class="small-12 medium-12 large-12 columns dureeInvalide"></div>
                    <br/>
                    <div class="small-3 medium-4 large-4 columns">
                        <label for="right-label">Date</label>
                    </div>
                    <div class="small-8 medium-8 large-8 columns">
                        <input type="text" name="date" id="dateActivite"/>
                    </div>
                    <div class="small-12 medium-12 large-12 columns dateInvalide"></div>
                    <!-- pop up de confirmation -> foundation -->
                    <a href='javascript:void(0)' id="ajouterActivite" class="button" name="activite">Ajouter à mes activités</a>
                    <?php
                    $estPresent = false;
                    foreach ($user['Activitefavorite'] as $fav) {
                        if ($activite['Activitephysique'] ['id'] == $fav['idacti']) {
                            $estPresent = true;
                        }
                    }
                    // TODO : ajouter la confirmation avec des fenetres modales
                    if ($estPresent) {
                        echo '<input class="button" type="submit" name="retirerfav" value="Retirer des favoris" />';
                    } else {
                        echo '<input class="button" type="submit" name="ajouterfav" value="Ajouter aux favoris"  />';
                    }
                    ?>
                    <div id="ajoutAct" class="reveal-modal" data-reveal>
                        <h2 id="ActiviteTitle">Souhaitez-vous confirmer l'ajout de cette activité ?</h2>
                        <h3> Récapitulatif : </h3>
                        Type d'activité : <?php echo $activite['Activitephysique']['ACTIVITE_SPECIFIQUE']; ?><br/>
                        Durée : <span id="dureeConf"></span><br/>
                        Date : <span id="dateConf"></span><br/>
                        <a class="button" id="confirmerActivite">Confirmer</a>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>

                <?php endif; ?>

            </div>
        </div>
        </form>
    </div>
</div>
<script type="text/javascript">

    jQuery(document).ready(function () {
        /** Création de type */
        jQuery('#ajouterActivite').click(function () {

            var date = jQuery("#dateActivite").val();
            var dur = jQuery("#duree").val();

            jQuery('.dureeInvalide').empty();  // réinitialise potentiel message d'erreur
            jQuery('.dateInvalide').empty();  // réinitialise potentiel message d'erreur


            var correct = 0;

            var regDate = /^\d{4}-\d{1,2}-\d{1,2}$/;

            if (!date) {
                jQuery('.dateInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Le champs date n\'a pas été renseigné <a href="javascript:void(0)" class="close">&times;</a></div>');
                correct = correct + 1;
            } else if (!regDate.test(date)) {
                jQuery('.dateInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Date invalide, le format est AAAA-MM-JJ <a href="javascript:void(0)" class="close">&times;</a></div>');
                correct = correct + 1;
            }
            if (isNaN(dur)) {
                jQuery('.dureeInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Durée invalide, assurer vous de n\'avoir ajouté que des chiffres <a href="javascript:void(0)" class="close">&times;</a></div>');
                correct = correct + 1;
            } else if (!dur) {
                jQuery('.dureeInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Le champs durée n\'a pas été renseigné <a href="javascript:void(0)" class="close">&times;</a></div>');
                correct = correct + 1;
            } else if (dur > 250) {
                jQuery('.dureeInvalide').append('<div data-alert class="alert-box warning radius">'
                        + 'Le temps de la durée est trop important. Entrer une valeur inférieure à 250 minutes.<a href="javascript:void(0)" class="close">&times;</a></div>');
                correct = correct + 1;
            }
            if (correct === 0) {
                ajout_valeur_recap();
                jQuery('#ajoutAct').foundation('reveal', 'open');
            }
        });

        jQuery('#confirmerActivite').click(function () {
<?php /* on ajoute ce champ caché pour le controlleur */ ?>
            jQuery("#ActivitephysiqueIndexForm").append('<input type="hidden" name="activite" value="nimp"/> ');
            jQuery("#ActivitephysiqueIndexForm").submit();
        });
    });

    function ajout_valeur_recap() {
        // On supprime les valeurs éventuelles existantes (qui seront doublés si le formulaire n'est pas valide)
        jQuery('.conf').remove();

        // Ajout des variables pour voir le récapitulatif
        jQuery('span#dateConf').append('<span class="conf">' + document.getElementById("dateActivite").value + '</span>');
        jQuery('span#dureeConf').append('<span class="conf">' + document.getElementById('duree').value + ' minutes</span>');
    }
</script>