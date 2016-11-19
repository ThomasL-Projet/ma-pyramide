<!-- Cette page est accessible à partir du menu situé en haut de la page : Clquez sur "Ressources" -> "Calculateur IMC" -->
<?php
//echo $this->Form->create('Imcenfant',array('action' => 'calcul')); 
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Calculateur IMC', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Calculateur IMC </div> 
        </div>
    </div>

    <div class="row">
        <div class="small-12 colomns">
            <h3>Définition</h3>

            <p class="text-justify">
                En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers.
            </p>
        </div>
    </div>


    <!-- On récupère le sexe, la taille, le poids, l'âge et le temps moyen de pratique d"une activité physique par l'utilisateur.
    Ces informations nous permettent, par la suite, de calculer l'IMC de la personne -->
    <div class="row">
        <div class="small-5 small-centered columns">
            <?php echo $this->Form->create('Imcenfant', array('action' => 'calcul')); ?>
            <div class="small-12 columns">
                <label for="sexe"> Sexe </label>
                <input type="radio" class="radio" name="sexe" id="homme" value="homme" checked="checked" /> <a class="labelInscription">Masculin</a>
                <input type="radio" class="radio" name="sexe" id="femme" value="femme"/> <a class="labelInscription">Feminin</a>
            </div>
            <div class="small-12 columns">
                <label for="taille"> Taille (en cm)
                    <input type="text" id="taille2" maxlength=3 name="zt_taille" required="required" placeholder="Entrez votre taille (exemple : 180 si vous mesurez 1m80) "/>
                </label>
            </div>
            <div class="small-12 columns">	
                <label for="poids"> Poids (en kg)
                    <input type="text" id="poids2" MAXLENGTH=3 name="zt_poids" required="required" placeholder="Entrez votre poids (exemple : 75 si vous pezez 75 kilos) "/>
                </label>
            </div>
            <div class="small-12 columns">	
                <label for="age"> Age 
                    <input type="text" id="age2" MAXLENGTH=3 name="zt_age" required="required" placeholder="Entrez votre age (exemple : 27 si vous avez 27 ans) "/>
                </label>
            </div>
            <div class="small-12 columns">		
                <label for="actPhys"> Activité physique  </label> 
                <select class='select' id="actPhys" name='AP'>
                    <option value="1" title="Je fais moins de 15 minutes d'activité physique par jour"> Sédentaire </option>
                    <option value="2" title="Tous les jours, ou presque, je fais au moins 15 minutes d'activité physique modérée"> Faiblement actif </option>
                    <option value="3" title="Tous les jours, ou presque, je fais au moins 30 minutes d'activité physique modérée (environ 200 min par semaine)"> Actif </option> 
                    <option value="4" title="Tous les jours, ou presque, je fais de 45 à 60 minutes d’activité physique modérée (environ 300 à 400 min par semaine)&#13;OU&#13;au moins 3 fois par semaine, à raison de 45 à 60 minutes par séance, je pratique une activité physique d’intensité élevée"> Très actif </option> 
                </select> 
            </div>	

            <div class="small-12 columns ">
                <div> <em>Tous les champs sont obligatoires </em></div>
            </div>

            <?php
            $options = array('label' => 'Calculer',
                'id' => 'submit',
                'class' => 'button large-12 columns',
                'onclick' => 'return verifSaisi()');

            echo $this->Form->end($options);
            ?>
        </div>

    </div>
</div>




<script type="text/javascript">

    function verifSaisi() {
        var taille = document.getElementById("taille2").value;
        var poids = document.getElementById("poids2").value;
        var age = document.getElementById("age2").value;
        var regex = /^[0-9]{1,3}$/;

        if (!(regex.test(taille))) {
            alert('Veuillez saisir une taille valide');
            return false;
        }

        if (!(regex.test(poids))) {
            alert('Veuillez saisir un poids valide');
            return false;
        }

        if (!(regex.test(age))) {
            alert('Veuillez saisir un âge valide');
            return false;
        }

    }



    function postData() {
<?php if (!isset($noPost)) : ?>
            var formulaire = document.forms['ImcenfantCalculForm'];

            // Calcul de l'age de l'utilisateur
            var birthday = new Date(<?php echo $datenaissance ?>);
            var today = new Date();
            var age = today.getFullYear() - birthday.getFullYear();

            // Reset birthday to the current year.
            birthday.setFullYear(today.getFullYear());

            // If the user's birthday has not occurred yet this year, subtract 1.
            if (today < birthday)
            {
                age--;
            }

            formulaire.elements["zt_age"].value = age;
            formulaire.elements["zt_taille"].value = '<?php echo $taille ?>';
            formulaire.elements["zt_poids"].value = '<?php echo $poids ?>';

            if ('<?php echo $sexe ?>' == 'femme') {
                formulaire.elements['femme'].checked = true;
                afficher();
            }
<?php endif; ?>
    }
</script>