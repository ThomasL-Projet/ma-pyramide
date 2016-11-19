<div class="row">
    <div class="small-12 columns">

        <?php echo $this->Form->create('User'); ?>
        <?php if (AuthComponent::user('id') == NULL): ?>
            <noscript>
            Vous avez désactivé javascript. Si vous voulez vous inscrire correctement, réactivez JavaScript.<br>
            Les conséquences sont :<br>
            - Si vous êtes mineur, vous ne pourrez pas vous enregistrer<br>
            - Si vous êtes une femme enceinte ou allaitante vous serez reconnue comme non enceinte ou non allaitante, pour ce cas il est possible d'y remédier ensuite en modifiant votre compte et en activant le javascript
            </noscript>
            <!-- Cette page est accessible depuis le bouton "Créer mon profil" situé en haut à droite de chaque page -->
            <!--TODO AJOUTER UNE IMAGE -->
            <h1> Créer votre profil </h1> 
            <!-- Pour crcéer son profil, l'utilisateur doit fournir obligatoirement un identifiant, sa date de naissance au fomat aaaa/mm/jj (un calendrier est là pour
                    l'aider) et doit préciser son sexe --> 
            <div class="bloc1">	

                <label for="UserUsername"> Identifiant <em> *</em></label>
                <input type="text" name="data[User][username]" maxlength="50" type="text" value="<?php if ($username != null) echo $username; ?>" id="UserUsername" required="required" title="Votre nom d'utilisateur doit faire entre 5 et 20 caractètres"/> <br><br>

                <label for="UserDatenaissance"> Date de naissance (aaaa-mm-jj) <em> *</em></label>
                <input type="text" name="data[User][datenaissance]" id="UserDatenaissance" value="<?php if ($datenaissance != null) echo $datenaissance; ?>" onchange ="verifage()" required="required"/> <br><br><br>

                <label for="UserSexe"> Vous êtes <em> *</em></label>
                <input type="radio" name="data[User][sexe]" id="homme" value="homme" checked="checked" onClick="masquer(this)" /><a id ="hommetxt" class='labelInscription'> Homme</a>
                <input type="radio" name="data[User][sexe]" id="femme" value="femme" onClick="afficher();" /><a class='labelInscription' id ="femmetxt"> Femme</a><br><br>

                <!-- Si l'internaute est un enfant, ou ado de moins de 18 ans, nous lui informons que l'accès au site n'est pas autorisé aux mineurs et qu'il doit préciser ses parents -->
                <div id="cache0">
                    <div class="p5" id="textemineur">Ce site est réservé aux adultes, vous pouvez tout de même vous inscrire mais le <br>nom de compte d'un de vos parents vous est demandé pour être sous sa responsabilité.</div>
                    <label for="sssa">&nbsp</label> 
                    <label for="sssa">&nbsp</label> <label for="sssa">&nbsp</label> <label for="sssa">&nbsp</label> 
                    <label for="UserEnceinte"> Nom de compte d'un de vos parents <em> *</em> </label>
                    <input type="text" name="data[User][parent]" maxlength="50" type="text" id="Userparent" /> <br><br>
                </div>
                <!-- Si l'internaute est une femme et a entre 18 et 48ans, nous lui demandons si elle est actuellement enceinte ou allaitante -->
                <div id="cache">
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
                <br/>
                <!-- L'utilisateur peut égalment préciser de manière optionnelle sa taille et son poids -->
                <label for="UserTaille"> Votre taille <em> *</em></label> 
                <input type="text" name="data[User][taille]" value="<?php if ($taille != null) echo $taille; ?>" id="UserTaille" required="required"/> <br><br>

                <label for="UserPoids">  Votre poids <em> *</em></label> 
                <input type="text" name="data[User][poids]" value="<?php if ($poids != null) echo $poids; ?>" id="UserPoids" required="required"/> </br></br></br>

                <!-- affichage seulement si l'internaute à plus de 2 ans -->
                <div id="cache5">
                    <label for="UserPoids">  Votre activité : <em> *</em></label> 
                    <select name="data[User][activite]" id="UserActivite" onchange="changeNotice()">
                        <?php
                        if ($activite != null) :
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
                </div>
                <label for="modalites">  Modalités d'utlisation </label> 
                <div style="width: 600px;height: 150px;overflow-y:auto;">
                    <p><strong>Modalités d’utilisation</strong></br></br>

                        TOUTE UTILISATION DES PAGES DU SITE WEB «  MA PYRAMIDE ALIMENTAIRE »
                        « MPA » EST ASSUJETTIE AUX MODALITES D’UTILISATION ENONCEES CI-APRES
                        (« modalités d’utilisation » ou « entente » » ou « convention).</br></br>

                        VEUILLEZ LIRE ATTENTIVEMENT LES PRESENTES MODALITES D’UTILISATION : ELLES
                        RENFERMENT DES RENSEIGNEMENTS IMPORTANTS SUR VOS DROITS, VOS RECOURS
                        ET VOS OBLIGATIONS, TELS QUE PREVUS PAR LA LOI, AINSI QUE SUR LES
                        EXCLUSIONS ET LES LIMITATIONS DE NOTRE RESPONSABILITE.</br></br>

                        AG Diététéique (AGD) (Sans but lucratif) est la propriétaire et l’exploitante du site « Ma
                        Pyramide Alimentaire  (MPA) ». </br></br>

                        En cliquant sur le bouton «  J’accepte – Créez mon compte » des modalités d’utilisation, en 
                        complétant le processus d’inscription  et en utilisant le site MPA, vous déclarez que vous avez au 
                        moins 14 ans et que vous avez lu et compris les présentes modalités d’utilisation et que vous
                        convenez être liées par celles-ci. </br></br>

                        Vous ne pourrez remplir votre page « Mon Profil » que si vous avez cliqué sur le bouton 

                        «  J’accepte – Créez mon compte ».</br></br>

                        Les termes « vous » et « utilisateurs » sont interchangeable dans les présentes et renvoient
                        à la personne qui a cliqué sur le bouton «  J’accepte – Créez mon compte »,  et qui a donc
                        complété le processus d’inscription et est donc autorisée à accéder aux services de MPA</br></br>

                        <strong>Utilisation des documents de AG Diététique</strong></br></br>

                        Vous pouvez télécharger ou faire des copies des documents de notre site Web pour votre utilisation
                        personnelles ou à des fins éducatives, sous réserve que le crédit en soit donné a AG Diététique (MPA).
                        S’il apparaît un avis de droit d’auteur veuillez le laisser sur votre copie. Veuillez ne pas modifier
                        nos logos ou nos dessins ni distribuer, publier à nouveau ou afficher nos documents pour mettre en place
                        un autre site Web ou pour servir vos propres fins commerciales, éducatives ou promotionnelles.
                        Si vous le faites sans avoir obtenu au préalable notre consentement écrit, vous contreviendrez à nos
                        droits de propriété intellectuelle. Vous pourrez écrire (Contact a mettre lors de la mise à jour)
                        pour nous demander notre consentement. </br></br>

                        AG Diététique se réserve le droit de vous interdire en tout temps l’accès au site MPA si vous téléchargez,
                        imprimez, reproduisez, transmettez ou distribuez tout ou partie du contenu qui selon notre jugement
                        est incompatible avec une utilisation personnelle à des fins non commerciales du site. </br></br>

                        <strong>Droits d’auteurs</strong></br></br>

                        <strong>AG Diététique</strong>, publie ses documents sous la rubrique « Edition Gradient » « EG » protégés par un code
                        de la propriété intellectuelle. Notre propriété intellectuelle constitue, à notre avis, un élément
                        d’actif très important de notre association et nous la protégeons contre toute utilisation non autorisée
                        d’autrui. Nous utilisons souvent le symbole « EG » pour indiquer notre droit de propriété intellectuelle. </br></br>

                        <strong>Service « Mon Coach » (Non fonctionnel, actuellement en éléboration)</strong></br></br>

                        Lorsque cette fonctionnalité sera disponible, si vous souhaitez utiliser l’option « Mon Coach » afin 
                        qu’un diététicien ou un médecin, vous accompagne dans l’utilisation de MPA, vous pourrez vous rendre,
                        sur le bouton « Trouver un Coach », qui sera actif.
                        Pour être accepté comme coach, le diététicien aura dû compléter une formation auprès de MPA et sera accrédité par MPA. </br></br> 

                        Une fois que vous aurez choisi un coach accrédité par MPA, (dans la liste des diététiciens accrédités par MPA,
                        le plus proche de chez vous), il faudra que vous l’autorisiez expressément à accéder aux renseignements de
                        votre profil. Votre coach ne pourra pas accéder à vos renseignements personnels sans votre autorisation et
                        sera tenu de se conformer à la politique sur la protection de la confidentialité qui fait partie intégrante du présent site. </br></br>

                        Lorsque vous aurez autorisé votre coach à accéder à vos renseignements personnels en cliquant sur le bouton
                        « Je consens » sur le site MPA, votre coach passera en revue vos différents renseignements et pourra vous faire
                        des suggestions ainsi que vous donner des conseils et des stratégies pour vous aider à atteindre vos objectifs.
                        Cependant, vous serez seul responsable de l’utilisation de votre coach et pourrez mettre fin en tout temps à son
                        utilisation. Pour ce faire il vous suffira de cliquer sur le bouton « Retirer » à côté du nom du coach dans le
                        module mon Coach du site MPA. </br></br>

                        <strong>Suppression de contenu</strong></br></br>

                        AG Diététique, aura le droit, mais non pas l’obligation, selon ses propres critères (non discutables) de surveiller
                        le contenu fourni par les utilisateurs afin d’établir si les présentes modalités d’utilisation et les règles de
                        fonctionnement établies par AG Diététique sont respectées, et ce, en vue de se conformer à la loi, à un règlement
                        ou une demande émanant d’un organisme gouvernemental ou à toute autre fin commerciales raisonnable. </br></br>

                        <strong>Interdiction d’utiliser le site MPA à des fins commerciales</strong></br></br>

                        Il vous est interdit d’utiliser le service MPA ou toute partie des documents se trouvant dans le site à des fins
                        commerciales ou aux fins de démarchage, ou pour lancer des appels en faveur d’œuvres de bienfaisance ou pour
                        des pétitions pour obtenir des signatures, à moins que MPA n’ait au préalable, approuvé de tels usages.
                        Autrement dit, il ne doit y avoir ni publicité, ni promotion à des fins commerciales. </br></br>

                        <strong>Modifications ou suppression de renseignements de votre compte ou de préférences.</strong> </br></br>

                        Vous pouvez modifier vos renseignements personnels en tout temps en visitant la plage « Mon profil »,
                        en cliquant sur le lien « Mon Compte ». </br></br>

                        Votre mot de passe MAP est personnel et vous ne devez le partager avec quiconque. </br></br>

                        Vous décidez la façon dont AG Diététique communique avec vous en visitant la page « Mon Profil » et cliquant
                        sur le lien « Mon Compte » et en choisissant le type de communication que vous souhaitez recevoir de MPA. </br></br>

                        Pour supprimer votre compte, vous devez communiquer avec AG Diététique (<strong>adresse communiquée lorsqu’elle sera active</strong>)
                        et en indiquant  « Suppression de MPA » dans l’objet du courriel. La suppression prendra cinq à dix jours ouvrables. </br></br>

                        <strong>Garantie et limitation de responsabilité</strong></br></br>

                        Les disciplines scientifiques est médicales connaissent une évolution permanente. Toute nouvelle recherche fondamentale
                        ou clinique, toute nouvelle donnée juridique, économique et sociale peuvent amener à modifier les concepts et les
                        stratégies diagnostiques et thérapeutiques. Les auteurs de ce site ont tout mis en œuvre pour fournir à l’utilisateur 
                        une information, tenant compte des données les plus actuelles et les plus généralement admises au moment de la mise
                        en route de ce site. Ils ne peuvent, cependant, garantir que ces informations sont complètes et totalement dénuées
                        d’erreurs. L’utilisateur est invité à confronter l’information de ce site à d’autres sources. </br></br> 

                        Ni les auteurs du site, ni les médecins, ni les diététiciens consultés par l’intermédiaire du site ne font de
                        déclarations, ni n’offrent de garanties ou de conditions de quelque type que ce soit, qu’elles soient expresses,
                        implicites ou prévues par la loi, notamment des garanties ou des conditions implicites quant à la qualité marchande
                        ou à l’adaptation à un usage particulier, des garanties, quant à l’exactitude ou à l’exhaustivité du site MPA ou
                        de tout autre document qui peut être consulté (au moyen d’un hyperlien direct ou indirect ou de toute autre façon)
                        par l’intermédiaire du site MPA ou quant-aux résultats devant être obtenus par l’accès à ceux-ci ou par l’utilisation de ceux-ci. </br></br>

                        AG Diététique a consulté des sources jugées fiables afin de fournir des renseignements complets et généralement
                        conformes aux normes acceptées au moment de la publication. Toutefois, AG Diététique ou les diététiciens accrédités
                        (coach) ne garantissent pas que les renseignements contenus dans le site MPA sont à tous égards exacts et exhaustifs
                        et ils ne sont aucunement responsables des erreurs ou des omissions, ni des résultats obtenus par suite de l’utilisation
                        de ces renseignements. </br></br>

                        NI AG DIETETIQUE, NI AUCUN DES COACH CONSULTES PAR L’INTERMEDIAIRE DU SITE N’ENGAGERONT LEUR RESPONSABILITE ENVERS
                        VOUS OU UNE AUTRE PERSONNE EN RAISON, D’INEXACTITUDES, DE RETARDS, D’INTERRUPTIONS DE SERVICE, D’ERREURS OU D’OMISSIONS,
                        QU’ELLE QU’EN SOIT LA CAUSE, NI A L’EGARD DES DOMMAGES QUI EN DECOULENT OU PAR SUITE DE BIENS OU DE SERVICES OFFERTS
                        PAR UNE TIERCE PARTIE LIEE AU SITE MPA. </br></br>

                        <strong>Généralités</strong></br></br>

                        La présente convention constitue la totalité de l’entente intervenue entre vous et AG Diététique relativement au site MPA.
                        La partie coach est cependant en élaboration. Toute omission de la part de AG Diététique d’insister sur une stricte
                        conformité à une modalité donnée de la présente convention ne saurait être interprétée comme une renonciation à toute
                        omission future de se conformer. </br></br>

                        Cette entente entre vous et AG Diététique est à titre personnel et vous ne pouvez pas céder vos droits ou vos obligations
                        à quiconque. Si une disposition de la présente convention est invalide ou ne peut être appliquée en vertu des lois applicables,
                        les dispositions restantes continueront d’avoir plein effet. </br></br>

                        Les dispositions de la présente entente en ce qui concerne la propriété et votre utilisation du contenu du site MPA
                        demeureront en vigueur après la résiliation des présentes modalités d’utilisation. </br></br>

                        AG Diététique se réserve le droit de modifier les modalités de la présente convention en affichant un avis sur le site
                        MPA ou à son gré, en communiquant directement avec les utilisateurs par courrier électronique ou par voie postale.
                        Si vous continuez à utiliser le site MPA après l’affichage des changements apportés aux présentes modalités d’utilisation,
                        vous serez irréfutablement réputé avoir accepté ces changements.</p>
                </div>
                <label for="accepte"> </label>
                <input type="radio" name="accepte" id="accepte" value="accepte" checked="checked" /><a class='labelInscription'> J'accepte</a>
                <input type="radio" name="accepte" id="acceptepas" value="acceptepas" /><a class='labelInscription'> Je n'accepte pas</a><br><br>

                <span>* Informations obligatoires </span>
            </div>



            <div class="span2"> Enregistrez votre profil </div> 
            <div class="bloc1">	
                <!--L'utilisateur doit préciser son mot de passe -->
                <label for="UserPassword"> Mot de passe <em> *</em></label>
                <input type="password" name="data[User][password]" id="UserPassword" required="required" title="Votre mot de passe doit faire plus de 7 caractètres"/> <br><br>

                <label for="UserPasswordConfirmation"> Confirmation <em> *</em></label>
                <input type="password" name="data[User][passwordconfirmation]" id="UserPasswordConfirmation" required="required"/> <br><br>

                <!-- S'il le souhaite, il peut préciser son adresse email -->
                <label for="UserEmail"> Email </label>
                <input type="email" name="data[User][email]" id="UserEmail" value="<?php if ($email != null) echo $email; ?>" /> 

                <span>* Informations obligatoires </span>
            </div>

            <!-- L'utilisateur peut valider son profil ou remettre le formulaire à 0 -->
            <div id="bloc9">
                <input class="button" type="submit" value="Effacer" onClick="raz()"/>
                <input class="button" type="submit" value="Valider" onClick="return validerForm()"/>
            </div>
            </form>
            <?php else: ?>
            <div id="presentation">
            <?php echo $this->Html->link('<< Retour', 'javascript:history.back()'); ?>
            <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            </div>
<?php endif; ?>
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
    document.getElementById("cache0").style.display = "none";
    document.getElementById("cache2").style.display = "none";
    document.getElementById("cache3").style.display = "none";
    document.getElementById("cache4").style.display = "none";

    postData();

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
        if (age <= 3) {

        }
        if (age > 3 && age < 14) {
            document.getElementById("hommetxt").innerHTML = "Garçon";
            document.getElementById("femmetxt").innerHTML = "Fille";
            document.getElementById("cache0").style.display = "block";
            document.getElementById("cache").style.display = "none";

            if (document.getElementById("enceinte").checked) {
                document.getElementById("pas_enceinte").checked = true;
                document.getElementById("UserMoisEnceinte").value = "";
            }
            if (document.getElementById("allaitante").checked) {
                document.getElementById("pas_allaitante").checked = true;
                document.getElementById("UserMoisAllaitante").value = "";
            }
        } else {
            document.getElementById("hommetxt").innerHTML = "Homme";
            document.getElementById("femmetxt").innerHTML = "Femme";
            document.getElementById("cache0").style.display = "none";

            if (age >= 14 && age < 48) {
                document.getElementById("cache").style.display = "none";
                document.getElementById("Userparent").value = "";
            } else if (age >= 49) {
                document.getElementById("cache").style.display = "none";
                if (document.getElementById("enceinte").checked) {
                    document.getElementById("pas_enceinte").checked = true;
                    document.getElementById("UserMoisEnceinte").value = "";
                }
                if (document.getElementById("allaitante").checked) {
                    document.getElementById("pas_allaitante").checked = true;
                    document.getElementById("UserMoisAllaitante").value = "";
                }
                document.getElementById("Userparent").value = "";
            }
        }

        if (age >= 0 && age <= 2) {
            document.getElementById("cache5").style.display = "none";
        } else {
            document.getElementById("cache5").style.display = "block";
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

    function afficher2() {

    }

    function raz() {
        var formulaire = document.forms['UserAddForm'];
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

        if (age < 0) {
            alert("La date de naissance ne peut être supérieure à la date d'aujourd'hui !");
            return false;
        }

        // debut
        var formulaire = document.forms['UserAddForm'];

        if (age >= 0 && age < 14) {
            if (document.getElementById("Userparent").value.length == 0) {
                alert("Veuillez renseigner le nom de votre parent");
                return false;
            }
        }

        if (age >= 0 && age < 2) {
            document.getElementById("UserActivite").value = "";
        }

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
        } else if (age >= 18 && age <= 48 && formulaire.elements['femme'].checked) {
            if (!formulaire.elements['enceinte'].checked && !formulaire.elements['pas_enceinte'].checked) {
                alert("Vous devez renseigner si vous êtes enceinte ou non pour vous inscrire")
                return false;
            }

            if (formulaire.elements['enceinte'].checked && formulaire.elements['UserMoisEnceinte'].value.length > 0) {
                var nb = formulaire.elements['UserMoisEnceinte'].value;
                if (!(nb >= 0 && nb <= 9)) {
                    alert("Le nombre de mois que vous êtes enceinte doit être compris entre 0 et 9")
                    return false;
                }
            } else if (formulaire.elements['enceinte'].checked && formulaire.elements['UserMoisEnceinte'].value.length == 0) {
                alert("Vous devez spécifier depuis combien de temps vous êtes enceinte pour valider votre inscription")
                return false;
            }

            if (!formulaire.elements['allaitante'].checked && !formulaire.elements['pas_allaitante'].checked) {
                alert("Vous devez renseigner si vous êtes allaitante ou non pour vous inscrire")
                return false;
            }

            if (formulaire.elements['allaitante'].checked && formulaire.elements['UserMoisAllaitante'].value.length == 0) {
                alert("Vous devez spécifier depuis combien de temps vous êtes allaitante pour valider votre inscription")
                return false;
            }
        }



        if (formulaire.elements['acceptepas'].checked) {
            alert("Vous devez accepté les modalités d'utilisation pour vous inscrire");
            return false;
        }

        if (formulaire.elements['UserTaille'].value.length == 0) {
            alert("Vous devez renseigner votre taille pour valider l'inscription !");
            return false;
        }
        if (formulaire.elements['UserPoids'].value.length == 0) {
            alert("Vous devez renseigner votre poids pour valider l'inscription !");
            return false;
        }

        if (formulaire.elements['UserPasswordConfirmation'].value ==
                formulaire.elements['UserPassword'].value) {
            if (formulaire.elements['UserPassword'].value.length >= 7) {
                return true;
            } else {
                alert('Le mot de passe saisi est trop court. Il doit faire au moins 7 caractères.');
            }
        } else {
            alert('Le mot de passe ne correspond pas');
        }

        return false;
    }

    function postData() {
        var formulaire = document.forms['UserAddForm'];
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

        if ('<?php echo $sexe ?>' == 'femme') {
            formulaire.elements['femme'].checked = true;
            afficher();
        }

        if ('<?php echo $enceinte ?>' == 'O') {
            formulaire.elements['enceinte'].checked = true;
            traitenceinte();
            document.getElementById("UserMoisEnceinte").value = '<?php if (isset($nbmoisenceinte)) echo $nbmoisenceinte; ?>';
        }

        if ('<?php echo $allaitante ?>' == 'O') {
            formulaire.elements['pas_enceinte'].checked = true;
            traitenceinte();
            formulaire.elements['allaitante'].checked = true;
            traitallaitante();
            document.getElementById("UserMoisAllaitante").value = '<?php if (isset($nbmoisallaitante)) echo $nbmoisallaitante; ?>';
        }

        verifage();
    }

</script>

