<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé -Mon gestionnaire de poids');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Une évolution et gestion de votre poids dans le temps.');
$this->end();
?>

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes statistiques', ['controller' => 'pages', 'action' => 'supertracker', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon gestionnaire poids', 'Javascript:void(0);'); ?></li>
</nav>
<?php
echo $this->Form->create('Gestionpoids');
?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mon gestionnaire poids </div> 

            <div class="textarea">
                <p class="text-justify">
                    Vous guide dans la gestion de votre poids, rentrez votre poids et suivez vos progrès dans le temps
                </p>			
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h2 class="text-center">Analysez vos progrès en entrant un nouveau poids</h2>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns text-center">
            <table>
                <thead>
                    <tr>  
                        <th width="50%">Mon objectif :</th>
                        <th width="50%">Saisissez votre poids :</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" disabled="true" maxlength=3 name="objectif" id="objectif" value="<?php echo $obj; ?>"></td>
                        
                        <td><input type="text" maxlength=3 name = "lepoids" placeholder="Entrez votre poids" value="" id="lepoids"></td>
                    </tr>
                    <tr>
                        <td><input type=button value="Modifier mon objectif" class="button" onclick="act_desact()"></td>
                        
                        <td><input type="submit" value="Valider" class="button" onclick="return confirm();"></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</form>


<div class="row">
    <div class="small-12 colomns">
        <h2 class="text-center">Vos progrès dans le temps</h2>
    </div>
</div>
<div class="row">
    <div class="small-12 colomns">
        <?php
        if (count($poids) >= 2) {
            ?>
            <div class="row">
                <div class="large-3 small-3 columns">
                    <ul data-line-id="line">
                        <?php
                        for ($i = 0; $i < count($Ordonne); $i++) {
                            echo "<li data-x='" . $i . "' data-y='" . $Ordonne[$i] . "'>Votre poids le " . $Abscisse[$i] . "</li>";
                        }
                        ?>   
                    </ul>
                </div>
                <div class="large-9 small-10 columns">
                    <div id="line" style="min-height: 200px;" ></div>
                </div>
            </div>

            <?php
        } else {
            if (count($poids) == 0) {
                echo '<p class="text-center">Vous devez saisir deux fois votre poids pour pouvoir analyser vos progrès dans le temps</p>';
            } else {
                echo '<p class="text-center">Vous devez saisir une deuxième fois votre poids pour pouvoir analyser vos progrès dans le temps</p>';
            }
        }
        ?>
    </div>
</div>
</div>
</form>
<?php
echo $this->Html->script('pizza-master/dist/js/vendor/dependencies.js');

echo $this->Html->script('pizza-master/js/pizza.js');
echo $this->Html->script('pizza-master/js/snap.js');
echo $this->Html->script('pizza-master/js/pizza/line.js');
echo $this->Html->script('pizza-master/js/pizza/bar.js');
echo $this->Html->script('pizza-master/js/pizza/pie.js');
?>


<script>
<?php //if (isset($Ordonne) and count($Ordonne) > 1) :       ?>
    jQuery(window).load(function () {

        Pizza.init();
        jQuery(document).foundation();

    });


<?php //endif;       ?>
    function confirm() {
        var poids = document.getElementById("lepoids").value;
        var objectif = document.getElementById("objectif").value;
        var regex = /^[0-9]{0,3}$/;
        if (!(regex.test(document.getElementById("lepoids").value))) {
            alert("Attention, le poids doit être un nombre de 1 à 3 chiffres (ex: 56)");
            return false;
        }
        if (poids.length !== 0 && poids <= 0) {
            alert('Attention, le poids doit être supperieur à zero');
            return false;
        }
        regex = /^[0-9]{1,3}$/;
        if (!(regex.test(document.getElementById("objectif").value))) {
            alert("Attention, l'objectif doit être un nombre de 1 à 3 chiffres (ex: 56)");
            return false;
        }
        if (objectif <= 0) {
            alert('Attention, l\'objectif doit être supperieur à zero');
            return false;
        }
        return true;
    }


    function act_desact() {
        var texte = document.getElementById("objectif");
        if (texte.disabled == true) {
            texte.disabled = false;
        }
    }

</script>

