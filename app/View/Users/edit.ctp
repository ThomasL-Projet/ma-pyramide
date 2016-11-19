<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion des utilisateurs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Gérer, supprimer ou modifier le rôle des utilisateurs');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Gestion des utilisateurs', ['controller' => 'users', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Modification d\'un utilisateur', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Modification d'un utilisateur </div>      
        </div>
    </div>
    <div class="row">
        <div class="small-12 column">
            <?php echo $this->Form->create('User'); ?>

            <?php if (!(AuthComponent::user('role') == 'administrateur' && AuthComponent::user('id') != $this->request->data['User']['id'])) : ?>
                <noscript>
                Vous avez désactivé javascript. Si vous voulez modifier votre compte correctement, réactivez JavaScript.<br>
                Les conséquences sont :<br>
                - Si vous êtes une femme enceinte ou allaitante vous serez reconnue comme non enceinte ou non allaitante<br>
                - Vous ne pouvez pas gérer votre activité
                </noscript>

                <!--TODO AJOUTER UNE IMAGE -->
                <!-- Cette page permet à un administrateur de modifier le profil d'un utilisateur ou d'un administrateur. Elle est accessible depuis l'administration.
                     Cliquez sur "gérer les utilisateur" puis sur le bouton représenté par un engrenage pour modifier le profil concerné -->

                <div class="small-12 columns"><h2  class="text-center title">Modifiez votre profil</h2></div>

                <div class="row">
                    <!-- Les informations saisies lors de l'inscription sont déjà préremplies -->
                    <label for="UserDatenaissance"> Date de naissance (aaaa-mm-jj) <em> *</em></label>
                    <input type="text" name="data[User][datenaissance]" id="UserDatenaissance" onchange ="verifage()" value="<?php echo $datenaissance; ?>" <?php if ($age >= 0 AND $age < 18) echo 'disabled="disabled"'; ?> required="required"/><br>

                    <label for="UserSexe"> Vous êtes <em> *</em></label>
                    <div class = "small-6 columns">
                        <?php
                        if ($age >= 0 AND $age < 18) {
                            echo '<input type="radio" name="data[User][sexe]" id="homme" value="homme" checked="checked" onClick="masquer(this)" /><a class="labelInscription" id="hommetxt"> Garçon </a>';
                            echo '<input type="radio" name="data[User][sexe]" id="femme" value="femme" onClick="afficher();" /><a class="labelInscription" id="femmetxt"> Fille </a><br><br>';
                        } else {
                            echo '<input type="radio" name="data[User][sexe]" id="homme" value="homme" checked="checked" onClick="masquer(this)" /><a class="labelInscription" id="hommetxt"> Homme </a>';
                            echo '<input type="radio" name="data[User][sexe]" id="femme" value="femme" onClick="afficher();" /><a class="labelInscription" id="femmetxt"> Femme </a><br><br>';
                        }
                        ?>


                        <?php if ($parent != null): ?>
                            <label for="UserEnceinte"> Votre parent</label>
                            <input type="text" maxlength="50" id="Userparent" value="<?php echo $parent; ?>" disabled="disabled" />
                            <label for="sssa">&nbsp</label> 
                            <div class="p5" id="textemineur">Votre parent peut modifier votre compte jusqu'à ce que vous aillez 18 ans. Il est donc votre responsable. <br>Lorsque vous aurez 18 ans, il ne pourra plus modifier votre compte.<br>Même si maintenant vous avez plus de 18 ans le nom de compte de votre parent reste inscrit ici</div>
                        <?php endif; ?>
                    </div>
                    <!-- Si l'internaute est une femme et a entre 18 et 48ans, nous lui demandons si elle est actuellement enceinte ou allaitante -->
                    <div class = "small-6 columns">
                        <div id="cache1">
                            <label for="UserEnceinte"> Enceinte  <em> *</em> </label>
                            <input type="radio" name="data[User][enceinte]" id="enceinte" value="O" onClick="traitenceinte();"><a class='labelInscription' > Oui 
                            </a>
                            <input type="radio" name="data[User][enceinte]" id="pas_enceinte" value="N" onClick="traitenceinte();" ><a class='labelInscription'> Non </a><br><br>
                        </div>
                        <!-- Affiche si clic sur oui -->
                        <div id="cache2">
                            <label for="UserMoisEnceinte"> Depuis combien de mois ? <em> *</em> </label>
                            <input type="text" name="data[User][nbmoisenceinte]" maxlength="50" type="text" id="UserMoisEnceinte" title="Indiquez le nombre de mois depuis que vous êtes enceinte"/> <br><br>
                        </div>
                        <!-- Si clic sur non, demande Allaitante -->
                        <div id="cache3">
                            <label for="UserAllaitante"> Allaitante <em> *</em> </label>
                            <input type="radio" name="data[User][allaitante]" id="allaitante" value="O" onClick="traitallaitante();"><a class='labelInscription'> Oui 
                            </a>
                            <input type="radio" name="data[User][allaitante]" id="pas_allaitante" value="N" onClick="traitallaitante();"><a class='labelInscription'> Non</a><br><br>
                        </div>
                        <!-- Si reponse allaitante est oui demande depuis combien de mois -->
                        <div id="cache4">
                            <label for="UserMoisAllaitante"> Depuis combien de mois ? <em> *</em> </label>
                            <input type="text" name="data[User][nbmoisallaitante]" maxlength="50" type="text" id="UserMoisAllaitante" title="Indiquez le nombre de mois depuis que vous êtes allaitante"/> <br><br>
                        </div>
                    </div>
                </div>

                <!-- L'utilisateur peut égalment préciser de manière optionnelle sa taille et son poids -->
                <label for="UserTaille"> Votre taille <em> *</em></label> 
                <input type="text" name="data[User][taille]" id="UserTaille" value="<?php echo intval($taille); ?>" required="required"/> <br><br>

                <label for="UserPoids">  Votre poids <em> *</em></label> 
                <input type="text" name="data[User][poids]" id="UserPoids" value="<?php echo intval($poids); ?>" required="required"/> </br></br>

                <div id="cache6">
                    <label for="UserPoids">  Votre activité : <em> *</em></label> 
                    <select name="data[User][activite]" id="UserActivite" onchange="changeNotice()">
                        <?php
                        if ($activite == "sédentaire") {
                            echo '<option value="sédentaire" selected="selected">Sédentaire</option>';
                            echo '<option value="peu actif">Peu actif</option>';
                            echo '<option value="actif">Actif</option>';
                            echo '<option value="très actif">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                        } else if ($activite == "peu actif") {
                            echo '<option value="sédentaire">Sédentaire</option>';
                            echo '<option value="peu actif" selected="selected">Peu actif</option>';
                            echo '<option value="actif">Actif</option>';
                            echo '<option value="très actif">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS de 30 à 60 minutes d’activités physiques modérées par jour <br>(p. ex. marcher à une vitesse de 5 à 7 km/h).<br>&nbsp</div>';
                        } else if ($activite == "actif") {
                            echo '<option value="sédentaire">Sédentaire</option>';
                            echo '<option value="peu actif">Peu actif</option>';
                            echo '<option value="actif" selected="selected">Actif</option>';
                            echo '<option value="très actif">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées <br>par jour.<br>&nbsp</div>';
                        } else if ($activite == "très actif") {
                            echo '<option value="sédentaire">Sédentaire</option>';
                            echo '<option value="peu actif">Peu actif</option>';
                            echo '<option value="actif">Actif</option>';
                            echo '<option value="très actif" selected="selected">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées par jour <br>PLUS 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.<br>&nbsp</div>';
                        } else if ($age >= 0 AND $age <= 2) {
                            echo '</select></br></br>';
                        } else {
                            echo '<option value="sédentaire" selected="selected">Sédentaire</option>';
                            echo '<option value="peu actif">Peu actif</option>';
                            echo '<option value="actif">Actif</option>';
                            echo '<option value="très actif">Très actif</option>';
                            echo '</select></br></br>';
                            echo '<div class="p4" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                        }
                        ?>
                        <label for="sssa">&nbsp</label> 
                        <label for="sssa">&nbsp</label>

                </div>
                <span>* Informations obligatoires </span>
            </div>

            <div class="span2"> Enregistrez votre profil </div> 
            <div class="bloc1">	
                <label for="UserPassword"> Mot de passe <em> *</em></label>
                <input type="password" name="data[User][password]" id="UserPassword" required="required"/> <br><br>

                <label for="UserPasswordConfirmation"> Confirmation <em> *</em></label>
                <input type="password" name="data[User][passwordconfirmation]" id="UserPasswordConfirmation" required="required" title="Votre mot de passe doit faire plus de 7 caractètres"/> <br><br>

                <label for="UserEmail"> Email </label>
                <input type="email" name="data[User][email]" id="UserEmail" value="<?php echo $email; ?>" /> 

                <span>* Informations obligatoires </span>
            </div>
            <div id="bloc11" style="margin-left:450px;">
                <input type="submit" style="margin-top:10px" value="Valider" onClick="return validerForm()"/>
                <?php echo $this->Html->link('<input style="margin-left:10px; margin-top:10px" type="button" value="Annuler">', '/users/', array('escape' => false)); ?>
            </div>

        <?php else : ?>
            <div class="span2"> Type de profil </div> 
            <div class="bloc1">	
                <label for="UserRole"> Type d'utilisateur <em> *</em></label>
                <?php if ($this->request->data['User']['role'] == 'administrateur') : ?>
                    <div class="input select">
                        <select name="data[User][role]" id="UserRole">
                            <option value="administrateur" selected='selected'>Administrateur</option>
                            <option value="utilisateur">Utilisateur</option>
                            <option value="dieteticien">Dieteticien</option>
                        </select>
                    </div>
                <?php else : ?>
                    <div class="input select">
                        <select name="data[User][role]" id="UserRole">
                            <option value="administrateur">Administrateur</option>
                            <option value="utilisateur" selected='selected'>Utilisateur</option>
                            <option value="dieteticien">Dieteticien</option>
                        </select>
                    </div>
                <?php endif; ?>
                <div id="bloc13" class="text-center">
                    <?php echo $this->html->link('Annuler', ['action' => 'index', 'full_base' => true], ['escape' => false, 'class' => 'button']); ?>    
                    
                    <input type="submit" class="button" value="Valider" onClick="return validerForm()"/>
                </div>
            <?php endif; ?>

            <!-- Ce bouton vous permet de valider les modifications effectuées -->

            </form>
        </div>
    </div>
</div>
</div>
<script>
    $(function () {
        $("#UserDatenaissance").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
            minDate: "-100Y",
            maxDate: "-1",
            showOtherMonths: true,
            selectOtherMonths: true,
            defaultDate: "-20Y",
            yearRange: "c-101:c"
        });
    });
</script>

<script type="text/javascript">

    document.getElementById("cache2").style.display = "none";
    document.getElementById("cache3").style.display = "none";
    document.getElementById("cache4").style.display = "none";

<?php if ($age >= 0 AND $age <= 2) : ?>
        document.getElementById("cache6").style.display = "none";
<?php else : ?>
        document.getElementById("cache6").style.display = "block";
<?php endif; ?>

    function verifage() {
        var birthday = new Date(document.getElementById("UserDatenaissance").value);
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();

        // Reset birthday to the current year.
        birthday.setFullYear(today.getFullYear());

        // If the user's birthday has not occurred yet this year, subtract 1.
        if (today < birthday)
        {
            age--;
        }

        if (age >= 0 && age < 18) {
            document.getElementById("hommetxt").innerHTML = "Garçon";
            document.getElementById("femmetxt").innerHTML = "Fille";
            document.getElementById("cache").style.display = "none";
        } else {
            document.getElementById("hommetxt").innerHTML = "Homme";
            document.getElementById("femmetxt").innerHTML = "Femme";
        }

        if (age >= 0 && age <= 2) {
            document.getElementById("cache6").style.display = "none";
        } else {
            document.getElementById("cache6").style.display = "block";
        }

        if (age >= 18) {
            document.getElementById("cache").style.display = "none";
        }

        if (document.getElementById("enceinte").checked) {
            document.getElementById("pas_enceinte").checked = true;
            document.getElementById("UserMoisEnceinte").value = "";
        }
        if (document.getElementById("allaitante").checked) {
            document.getElementById("pas_allaitante").checked = true;
            document.getElementById("UserMoisAllaitante").value = "";
        }
        document.getElementById("homme").checked = true;
    }

    function traitenceinte() {
        document.getElementById("cache2").style.display = "none";
        if (document.getElementById("enceinte").checked) {
            document.getElementById("cache2").style.display = "block";
        } else if (document.getElementById("pas_enceinte").checked) {
            document.getElementById("cache3").style.display = "block";
            document.getElementById("cache1").style.display = "none";
        }
    }

    function traitallaitante() {
        if (document.getElementById("allaitante").checked) {
            document.getElementById("cache4").style.display = "block";
        } else if (document.getElementById("pas_allaitante").checked) {
            document.getElementById("cache4").style.display = "none";
        }
    }
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
    function afficher() {
        var birthday = new Date(document.getElementById("UserDatenaissance").value);
        var today = new Date();
        var age = today.getFullYear() - birthday.getFullYear();

        // Reset birthday to the current year.
        birthday.setFullYear(today.getFullYear());

        // If the user's birthday has not occurred yet this year, subtract 1.
        if (today < birthday)
        {
            age--;
        }

        if (age >= 18 && age <= 48) {
            document.getElementById("cache").style.display = "block";
        }
    }

    function masquer(btn) {
        if (btn.checked) {
            document.getElementById("cache").style.display = "none";
        }
    }

    function raz() {
        var formulaire = document.forms['UserEditForm'];
        document.getElementById("UserUsername").value = "";
        document.getElementById("UserDatenaissance").value = "";
        document.getElementById("UserTaille").value = "";
        document.getElementById("UserPoids").value = "";
        document.getElementById("UserPassword").value = "";
        document.getElementById("UserPasswordConfirmation").value = "";
        document.getElementById("UserEmail").value = "";
    }

    function validerForm() {
        var regex = /^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/;
        if (!(regex.test(document.getElementById("UserEmail").value))) {
            alert("L'adresse email n'est pas une adresse valide");
            return false;
        }
        regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        if (!(regex.test(document.getElementById("UserDatenaissance").value))) {
            alert("la date de naissance est invalide, elle doit être sous format 'YYYY-MM-DD'");
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

        var formulaire = document.forms['UserEditForm'];
        if (formulaire.elements['pas_enceinte'].checked) {
            document.getElementById("UserMoisEnceinte").value = "";
        }
        if (formulaire.elements['pas_allaitante'].checked) {
            document.getElementById("UserMoisAllaitante").value = "";
        }

        if (formulaire.elements['enceinte'].checked) {
            formulaire.elements['pas_allaitante'].checked = true;
        }

        if (formulaire.elements['homme'].checked) {
            formulaire.elements['pas_allaitante'].checked = true;
            formulaire.elements['pas_enceinte'].checked = true;
        } else if (formulaire.elements['femme'].checked) {
            if (!formulaire.elements['enceinte'].checked && !formulaire.elements['pas_enceinte'].checked) {
                alert("Vous devez renseigner si vous êtes enceinte ou non pour valider les modifications")
                return false;
            }

            if (formulaire.elements['enceinte'].checked && formulaire.elements['UserMoisEnceinte'].value.length > 0) {
                var nb = formulaire.elements['UserMoisEnceinte'].value;
                if (!(nb >= 0 && nb <= 9)) {
                    alert("Le nombre de mois que vous êtes enceinte doit être compris entre 0 et 9")
                    return false;
                }
            } else if (formulaire.elements['enceinte'].checked && formulaire.elements['UserMoisEnceinte'].value.length == 0) {
                alert("Vous devez spécifier depuis combien de temps vous êtes enceinte pour valider les modifications")
                return false;
            }

            if (!formulaire.elements['allaitante'].checked && !formulaire.elements['pas_allaitante'].checked) {
                alert("Vous devez renseigner si vous êtes allaitante ou non pour valider les modifications")
                return false;
            }

            if (formulaire.elements['allaitante'].checked && formulaire.elements['UserMoisAllaitante'].value.length == 0) {
                alert("Vous devez spécifier depuis combien de temps vous êtes allaitante pour valider les modifications")
                return false;
            }
        }

        if (formulaire.elements['UserTaille'].value.length == 0) {
            alert("Vous devez renseigner votre taille pour valider les modifications !");
            return false;
        }
        if (formulaire.elements['UserPoids'].value.length == 0) {
            alert("Vous devez renseigner votre poids pour valider les modifications !");
            return false;
        }

        if (formulaire.elements['UserPasswordConfirmation'].value ==
                formulaire.elements['UserPassword'].value) {
            return true;
        } else {
            alert('Le mot de passe ne correspond pas');
        }

        return false;
    }

    function postData() {
        var formulaire = document.forms['UserEditForm'];
        formulaire.elements["UserDatenaissance"].value = '<?php echo $datenaissance ?>';
        formulaire.elements["UserTaille"].value = '<?php echo $taille ?>';
        formulaire.elements["UserPoids"].value = '<?php echo $poids ?>';
        formulaire.elements["UserEmail"].value = '<?php echo $email ?>';

        if ('<?php echo $sexe ?>' == 'femme') {
            formulaire.elements['femme'].checked = true;
            afficher();
        }

        if ('<?php echo $enceinte ?>' == 'O') {
            formulaire.elements['enceinte'].checked = true;
        }

        if ('<?php echo $allaitante ?>' == 'O') {
            formulaire.elements['allaitante'].checked = true;
        }
    }

</script>

