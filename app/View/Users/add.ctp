<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Inscription');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Inscrire, créer un compte en 5 étapes');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Inscription', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div id="first" class="row">
        <div class="small-12 columns">

            <!-- si le javascript n'est pas activé -->
            <?php echo $this->Form->create('User'); ?>
            <noscript>
            Vous avez désactivé javascript. Si vous voulez vous inscrire correctement, réactivez JavaScript.<br>
            Les conséquences sont :<br>
            - Si vous êtes mineur, vous ne pourrez pas vous enregistrer<br>
            - Si vous êtes une femme enceinte ou allaitante vous serez reconnue comme non enceinte ou non allaitante, pour ce cas il est possible d'y remédier ensuite en modifiant votre compte et en activant le javascript
            </noscript>
            <!-- Cette page est accessible depuis le bouton "Créer mon profil" situé en haut à droite de chaque page -->

            <div class="title-area"> Créer votre profil  </div> 
            <br>
            <!-- Pour crcéer son profil, l'utilisateur doit fournir obligatoirement un identifiant, son adresse mail, sa date de naissance au fomat aaaa/mm/jj (un calendrier est là pour
                    l'aider) et doit préciser son sexe, ainsi que son nom et son prénom --> 
            <div class="small-12 small-centered columns">	
                <div class="row" data-equalizer>
                    <div class="small-10 small-centered columns panel" >
                        <h2 class="text-center">Mon compte</h2><br>
                        <div class="small-4 columns" data-equalizer-watch>
                            <?php echo $this->Html->image('inscription.png', array('alt' => 'Fruits')); ?>
                            </br>
                            <p class="text-center">* Informations obligatoires </p>

                        </div>

                        <div class="small-4 columns" data-equalizer-watch>
                            <!-- entrer des données --> 
                            <label for="UserUsername">Pseudo *</label>
                            <input type="text" placeholder="Pseudo *" name="data[User][username]" maxlength="50" type="text"  id="UserUsername" required="required" value="<?php if (isset($username) != null) echo $username; ?>" title="Votre nom d'utilisateur doit faire entre 5 et 20 caractètres"/>
                            <!--L'utilisateur doit préciser son mot de passe -->
                            <label for="UserPassword">Mot de passe *</label>
                            <input type="password" placeholder="Mot de passe *" name="data[User][password]" id="UserPassword" required="required" title="Votre mot de passe doit faire plus de 7 caractètres"/>

                            <label for="UserPasswordConfirmation">Confirmation mot de passe *</label>
                            <input type="password" placeholder="Confirmation mot de passe *" name="data[User][passwordconfirmation]" id="UserPasswordConfirmation" required="required"/> 

                            <label for="UserSexe">Sexe *</label>
                            <div class="small-12 columns text-center">
                                <input type="radio" name="data[User][sexe]" id="homme" value="homme"  onClick="masquer()" /><label id ="hommetxt" class='labelInscription'> Homme</label>

                                <input type="radio" name="data[User][sexe]" id="femme" value="femme" onClick="afficher();" /><label class='labelInscription' id ="femmetxt"> Femme</label>
                            </div>
                        </div>
                        <div class="small-4 columns" data-equalizer-watch>

                            <label for="UserNom">Nom </label>
                            <input type="text" placeholder="Nom " name="data[User][nom]" maxlength="50" type="text"  id="UserNom" value="<?php if (isset($nom) != null) echo $nom; ?>"  />
                            <!--L'utilisateur doit préciser son mot de passe -->
                            <label for="UserPrenom">Prénom </label>
                            <input type="text" placeholder="Prénom " name="data[User][prenom]" maxlength="50" type="text" id="UserPrenom" value="<?php if (isset($prenom) != null) echo $prenom; ?>" />

                            <!-- S'il le souhaite, il peut préciser son adresse email -->
                            <label for="UserEmail">Adresse mail *</label>
                            <input type="email" placeholder="E-mail *" name="data[User][email]" id="UserEmail" required="required" /> 

                            <label for="UserDatenaissance">Date de naissance * (AAAA-MM-JJ) </label>
                            <input type="text" placeholder="Ex : 1995-07-14" name="data[User][datenaissance]" id="UserDatenaissance" value="<?php if (isset($datenaissance) != null) echo $datenaissance; ?>" onchange ="verifage()" required="required"/>


                        </div>
                        <!-- condition d'utilisation -->
                        <div class="small-12 columns text-center" >
                            <p >J'ai lu et approuvé les <a href="#" data-reveal-id="myModal">conditions d'utilisation</a>  de MaPyramide.fr </p>

                            <div id="myModal" class="reveal-modal" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
                                <div class="small-12 columns panel" style=" height: 400px; overflow-y: scroll">
                                    <h2 id="modalTitle">Modalité d'utilisation</h2>
                                    <p>TOUTE UTILISATION DES PAGES DU SITE WEB «  MA PYRAMIDE SYMBIO-SANTÉ »
                                        « MPSS » EST ASSUJETTIE AUX MODALITES D’UTILISATION ENONCEES CI-APRES
                                        (« modalités d’utilisation » ou « entente » » ou « convention).</br></br>

                                        VEUILLEZ LIRE ATTENTIVEMENT LES PRESENTES MODALITES D’UTILISATION : ELLES
                                        RENFERMENT DES RENSEIGNEMENTS IMPORTANTS SUR VOS DROITS, VOS RECOURS
                                        ET VOS OBLIGATIONS, TELS QUE PREVUS PAR LA LOI, AINSI QUE SUR LES
                                        EXCLUSIONS ET LES LIMITATIONS DE NOTRE RESPONSABILITE.</br></br>

                                        AG Diététéique (AGD) (Sans but lucratif) est la propriétaire et l’exploitante du site « Ma
                                        Pyramide Symbio-Santé  (MPSS) ». </br></br>

                                        En cliquant sur le bouton «  J’accepte – Créez mon compte » des modalités d’utilisation, en 
                                        complétant le processus d’inscription  et en utilisant le site MPSS, vous déclarez que vous avez au 
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
                                        qu’un diététicien ou un médecin, vous accompagne dans l’utilisation de MPSS, vous pourrez vous rendre,
                                        sur le bouton « Trouver un Coach », qui sera actif.
                                        Pour être accepté comme coach, le diététicien aura dû compléter une formation auprès de MPSS et sera accrédité par MPSS. </br></br> 

                                        Une fois que vous aurez choisi un coach accrédité par MPSS, (dans la liste des diététiciens accrédités par MPSS,
                                        le plus proche de chez vous), il faudra que vous l’autorisiez expressément à accéder aux renseignements de
                                        votre profil. Votre coach ne pourra pas accéder à vos renseignements personnels sans votre autorisation et
                                        sera tenu de se conformer à la politique sur la protection de la confidentialité qui fait partie intégrante du présent site. </br></br>

                                        Lorsque vous aurez autorisé votre coach à accéder à vos renseignements personnels en cliquant sur le bouton
                                        « Je consens » sur le site MPSS, votre coach passera en revue vos différents renseignements et pourra vous faire
                                        des suggestions ainsi que vous donner des conseils et des stratégies pour vous aider à atteindre vos objectifs.
                                        Cependant, vous serez seul responsable de l’utilisation de votre coach et pourrez mettre fin en tout temps à son
                                        utilisation. Pour ce faire il vous suffira de cliquer sur le bouton « Retirer » à côté du nom du coach dans le
                                        module mon Coach du site MPSS. </br></br>

                                        <strong>Suppression de contenu</strong></br></br>

                                        AG Diététique, aura le droit, mais non pas l’obligation, selon ses propres critères (non discutables) de surveiller
                                        le contenu fourni par les utilisateurs afin d’établir si les présentes modalités d’utilisation et les règles de
                                        fonctionnement établies par AG Diététique sont respectées, et ce, en vue de se conformer à la loi, à un règlement
                                        ou une demande émanant d’un organisme gouvernemental ou à toute autre fin commerciales raisonnable. </br></br>

                                        <strong>Interdiction d’utiliser le site MPSS à des fins commerciales</strong></br></br>

                                        Il vous est interdit d’utiliser le service MPSS ou toute partie des documents se trouvant dans le site à des fins
                                        commerciales ou aux fins de démarchage, ou pour lancer des appels en faveur d’œuvres de bienfaisance ou pour
                                        des pétitions pour obtenir des signatures, à moins que MPA n’ait au préalable, approuvé de tels usages.
                                        Autrement dit, il ne doit y avoir ni publicité, ni promotion à des fins commerciales. </br></br>

                                        <strong>Modifications ou suppression de renseignements de votre compte ou de préférences.</strong> </br></br>

                                        Vous pouvez modifier vos renseignements personnels en tout temps en visitant la plage « Mon profil »,
                                        en cliquant sur le lien « Mon Compte ». </br></br>

                                        Votre mot de passe MAP est personnel et vous ne devez le partager avec quiconque. </br></br>

                                        Vous décidez la façon dont AG Diététique communique avec vous en visitant la page « Mon Profil » et cliquant
                                        sur le lien « Mon Compte » et en choisissant le type de communication que vous souhaitez recevoir de MPSS. </br></br>

                                        Pour supprimer votre compte, vous devez communiquer avec AG Diététique (<strong>adresse communiquée lorsqu’elle sera active</strong>)
                                        et en indiquant  « Suppression de MPSS » dans l’objet du courriel. La suppression prendra cinq à dix jours ouvrables. </br></br>

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
                                        ou à l’adaptation à un usage particulier, des garanties, quant à l’exactitude ou à l’exhaustivité du site MPSS ou
                                        de tout autre document qui peut être consulté (au moyen d’un hyperlien direct ou indirect ou de toute autre façon)
                                        par l’intermédiaire du site MPSS ou quant-aux résultats devant être obtenus par l’accès à ceux-ci ou par l’utilisation de ceux-ci. </br></br>

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
                                        Si vous continuez à utiliser le site MPSS après l’affichage des changements apportés aux présentes modalités d’utilisation,
                                        vous serez irréfutablement réputé avoir accepté ces changements.</p>
                                    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                                </div>
                            </div>


                            <input type="radio" name="accepte" id="accepte" value="accepte" checked="checked" /><label class='labelInscription'> J'accepte</label>
                            <input type="radio" name="accepte" id="acceptepas" value="acceptepas" /><label class='labelInscription'> Je n'accepte pas</label><br><br>

                            <!-- Si l'internaute est un enfant, ou ado de moins de 18 ans, nous lui informons que l'accès au site n'est pas autorisé aux mineurs et qu'il doit préciser ses parents -->
                            <div id="cache0">
                                <div class="small-12 columns">
                                    <p class="text-center" id="textemineur">Ce site est réservé aux adultes, vous pouvez tout de même vous inscrire mais le nom de compte d'un de vos parents vous est demandé pour être sous sa responsabilité.</p>
                                    <div class="small-12 columns text-left">
                                        <label for="UserParent"> Nom de compte d'un de vos parents *</label>
                                        <input type="text" name="data[User][parent]" placeholder="Nom de compte d'un de vos parents *" maxlength="50" type="text" id="UserParent" />
                                    </div>
                                </div>
                            </div>
                            <!-- Si l'internaute est une femme et a entre 18 et 48ans, nous lui demandons si elle est actuellement enceinte ou allaitante -->
                            <div id="cache">
                                <div class="small-12 columns">                                        
                                    <p class="text-center">Êtes-vous : </p>
                                    <div class="small-6 columns">
                                        <div id="cache1">

                                            <div class="small-12 columns text-center">
                                                <label for="UserEnceinte"> Enceinte  <em> *</em> </label>
                                                <input type="radio" name="data[User][enceinte]" id="enceinte" value="O" onClick="traitenceinteallaitante();"><label class='labelInscription' > Oui </label>
                                                <input type="radio" name="data[User][enceinte]" id="pas_enceinte" value="N" onClick="traitenceinteallaitante();" ><label class='labelInscription'> Non </label>
                                            </div>
                                        </div>
                                        <!-- Affiche si clic sur oui -->
                                        <div id="cache2">
                                            <label for="UserMoisEnceinte"> Depuis combien de mois ? <em> *</em> </label>
                                            <input type="text" name="data[User][nbmoisenceinte]" maxlength="50" type="text" id="UserMoisEnceinte" title="Indiquez le nombre de mois de grossesse"/> 
                                        </div>
                                    </div>
                                    <div class="small-6 columns">
                                        <div id="cache3">
                                            <!-- demande Allaitante -->

                                            <div class="small-12 columns text-center">
                                                <label for="UserAllaitante"> Allaitante <em> *</em> </label>
                                                <input type="radio" name="data[User][allaitante]" id="allaitante" value="O" onClick="traitenceinteallaitante();"><label class='labelInscription'> Oui</label>
                                                <input type="radio" name="data[User][allaitante]" id="pas_allaitante" value="N" onClick="traitenceinteallaitante();"><label class='labelInscription'> Non</label>
                                            </div>
                                        </div>
                                        <!-- affiche si clic sur oui -->
                                        <div id="cache4">
                                            <label for="UserMoisAllaitante"> Depuis combien de mois ? <em> *</em> </label>
                                            <input type="text" name="data[User][nbmoisallaitante]" maxlength="50" type="text" id="UserMoisAllaitante" title="Indiquez le nombre de mois d'allaitement"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="small-12 columns text-center"> 
                            <h2>Mes données physiques</h2><br>
                        </div>   
                        <div class="small-12 columns">                                        
                            <!-- L'utilisateur peut également préciser sa taille et son poids -->
<div class="row">
                            <div class="small-6 columns">
                                <label for="UserTaille">Votre taille *</label> 
                                <input type="text" placeholder="Votre taille (cm)*" name="data[User][taille]" value="<?php if (isset($taille) != null) echo $taille; ?>" id="UserTaille" required="required"/> 
                            </div>
                            <div class="small-6 columns">
                                <label for="UserPoids">Votre poids *</label> 
                                <input type="text" placeholder="Votre poids (kg)*" name="data[User][poids]" value="<?php if (isset($poids) != null) echo $poids; ?>" id="UserPoids" required="required"/> 
                            </div>
</div>
                            <div class="small-10 columns small-centered">
                                <!-- affiche des détails sur les efforts  -->
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
                                            echo '<div class="p4 text-center" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                                        } else if ($activite == "peu actif") {
                                            echo '<option value="sédentaire">Sédentaire</option>';
                                            echo '<option value="peu actif" selected="selected">Peu actif</option>';
                                            echo '<option value="actif">Actif</option>';
                                            echo '<option value="très actif">Très actif</option>';
                                            echo '</select></br></br>';
                                            echo '<div class="p4 text-center" id="notice">Activités quotidiennes de base PLUS de 30 à 60 minutes d’activités physiques modérées par jour <br>(p. ex. marcher à une vitesse de 5 à 7 km/h).<br>&nbsp</div>';
                                        } else if ($activite == "actif") {
                                            echo '<option value="sédentaire">Sédentaire</option>';
                                            echo '<option value="peu actif">Peu actif</option>';
                                            echo '<option value="actif" selected="selected">Actif</option>';
                                            echo '<option value="très actif">Très actif</option>';
                                            echo '</select></br></br>';
                                            echo '<div class="p4 text-center" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées <br>par jour.<br>&nbsp</div>';
                                        } else if ($activite == "très actif") {
                                            echo '<option value="sédentaire">Sédentaire</option>';
                                            echo '<option value="peu actif">Peu actif</option>';
                                            echo '<option value="actif">Actif</option>';
                                            echo '<option value="très actif" selected="selected">Très actif</option>';
                                            echo '</select></br></br>';
                                            echo '<div class="p4 text-center" id="notice">Activités quotidiennes de base PLUS un minimum de 60 minutes d’activités physiques modérées par jour <br>PLUS 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.<br>&nbsp</div>';
                                        } else {
                                            
                                        }
                                    else :
                                        echo '<option value="sédentaire">Sédentaire</option>';
                                        echo '<option value="peu actif">Peu actif</option>';
                                        echo '<option value="actif">Actif</option>';
                                        echo '<option value="très actif">Très actif</option>';
                                        echo '</select></br></br>';
                                        echo '<div class="p4 text-center" id="notice">Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).<br>&nbsp</div>';
                                    endif;
                                    ?>

                                </select>
 </div>
                            </div>
                            <br><br><br><br>
                            <br><br><br><br>
                            <br><br><br><br>
                            <br>

                        </div>
                    </div>
                </div>

                <!-- L'utilisateur peut valider son profil ou remettre le formulaire à 0 -->
                <div class="small-4 columns">
                    <br/>
                </div>
                <div class="small-12 columns text-center">

                    <input class="button" type="submit" value="Effacer" onClick="raz()"/>
                    <input class="button" type="submit"  value="Valider" onClick="return validerForm()"/>


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

        document.getElementById("cache").style.display = "none";
        document.getElementById("cache0").style.display = "none";
        document.getElementById("cache1").style.display = "none";
        document.getElementById("cache2").style.display = "none";
        document.getElementById("cache3").style.display = "none";
        document.getElementById("cache4").style.display = "none";
        document.getElementById("second").style.display = "none";

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
             if (age >= 0 && age <= 3) {
                alert("Attention, vous ne pouvez vous inscrire si vous avez moins de 3 ans.");
                document.getElementById("UserDatenaissance").value = "";
                return false;
            } else {
                document.getElementById("cache5").style.display = "block";
            }
            if (age > 3 && age < 18) {
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

                if (age >= 18 && age < 48) {
                    document.getElementById("cache").style.display = "none";
                    document.getElementById("Userparent").value = "";
                    afficherParent();
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

           

        }

        function traitenceinteallaitante() {
            document.getElementById("cache2").style.display = "none"
            if (document.getElementById("enceinte").checked) {
                document.getElementById("cache2").style.display = "block";
            } else if (document.getElementById("pas_enceinte").checked) {
                document.getElementById("cache3").style.display = "block";
                // document.getElementById("cache1").style.display = "none";  
            }
            if (document.getElementById("allaitante").checked) {
                document.getElementById("cache4").style.display = "block";
            } else if (document.getElementById("pas_allaitante").checked) {
                document.getElementById("cache4").style.display = "none";
            }
        }

        function traitallaitante() {

        }

        function changeNotice() {
            var i = document.getElementById("UserActivite").selectedIndex;
            if (i == 0) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base (p. ex. tâches ménagères, marcher pour se rendre à l’autobus).&nbsp";
            } else if (i == 1) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base, de 30 à 60 minutes d’activités physiques modérées par jour (p. ex. marcher à une vitesse de 5 à 7 km/h).";
            } else if (i == 2) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base, un minimum de 60 minutes d’activités physiques modérées par jour.";
            } else if (i == 3) {
                document.getElementById("notice").innerHTML = "Activités quotidiennes de base, un minimum de 60 minutes d’activités physiques modérées par jour : plus de 60 minutes d’activités physiques vigoureuses ou 120 minutes d’activités physiques modérées.";
            }
        }

        function afficher() {
            document.getElementById("cache").style.display = "block";
            document.getElementById("cache1").style.display = "block";
            document.getElementById("cache3").style.display = "block";
        }

        function afficherParent() {

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

            if (age >= 14 && age <= 48) {
                document.getElementById("cache").style.display = "block";
                document.getElementById("cache1").style.display = "block";
                document.getElementById("cache3").style.display = "block";
            }
        }

        function masquer() {

            document.getElementById("cache").style.display = "none";

        }

        function afficher2() {

        }

        function raz() {
            var formulaire = document.forms['UserAddForm'];
            document.getElementById("UserUsername").value = "";
            document.getElementById("UserDatenaissance").value = "";
            document.getElementById("UserNom").value = "";
            document.getElementById("UserPrenom").value = "";
            document.getElementById("UserTaille").value = "";
            document.getElementById("UserPoids").value = "";
            document.getElementById("UserPassword").value = "";
            document.getElementById("UserPasswordConfirmation").value = "";
            document.getElementById("UserEmail").value = "";
        }

        function validerForm() {

            if (!document.getElementById("femme").checked && !document.getElementById("homme").checked) {
                alert("Vous devez selectionner le sexe pour vous inscrire");
                return false;
            }

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

            if (!(document.getElementById("UserTaille").value > 0 && document.getElementById("UserTaille").value <= 300)) {
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
                        alert("Le nombre de mois de grossesse, doit être compris entre 0 et 9")
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

                if (formulaire.elements['allaitante'].checked && formulaire.elements['UserMoisAllaitante'].value.length > 0) {
                    var nb = formulaire.elements['UserMoisEnceinte'].value;
                    if (!(nb >= 0 && nb <= 100)) {
                        alert("Le nombre de mois d'allaitement doit être compris entre 0 et 100")
                        return false;
                    }
                } else if (formulaire.elements['allaitante'].checked && formulaire.elements['UserMoisAllaitante'].value.length == 0) {
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
