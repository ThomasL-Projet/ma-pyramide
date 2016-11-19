<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Calculateur IMC', ['action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Calcul de votre IMC', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Calcul de votre IMC </div> 
        </div>
    </div>
    <?php if ($affichage) : ?>
        <div class="row">
            <div class="small-12 small-centered columns">
                <table class="small-centered">
                    <thead>
                        <tr>  
                            <th width="65%">Résultat</th>
                            <th width="5%"></th>
                            <th width="30%">Interprétation</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> Votre IMC est de <?php echo round($imc, 2); ?> et vos besoins énergétiques estimés sont de <?php echo $BEE ?> calories par jour.</td>
                            <td></td>
                            <td>  <?php
                                // On récupère l'age de la personne. Si c'est un adulte, on affiche l'interprétation suivante
                                if ($_POST['zt_age'] >= 18):
                                    ?>
                                    <div class="row">
                                        <div class="small-12 small-centered columns">
                                            <table class="small-centered">
                                                <thead>
                                                    <tr> 
                                                        <th width="50%"><h4>IMC kg.m-2</h4></td> 

                                                <th width="50%"><h4>Signification</h4></td>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Inférieur à 16.5</td> 
                                                        <td>Dénutrition</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Entre 16.5 et 18.5</td>
                                                        <td>Maigreur</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Entre 18.5 et 25</td>
                                                        <td>Corpulence normale</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Entre 25 et 30</td>
                                                        <td>Surpoids</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Entre 30 et 35</td>
                                                        <td>Obésité modérée</td>
                                                    </tr>

                                                    <tr>
                                                        <td>Entre 35 et 40</td>
                                                        <td>Obésité élevée</td>

                                                    </tr>

                                                    <tr>
                                                        <td>Supérieur à 40</td>
                                                        <td>Obésité morbide</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        <?php endif; ?>
                                        </td>

                                        </tr>


                                        <tr>
                                            <td>
                                                <?php if ($_POST['zt_age'] > 18): ?>
                                                    <?php if ($imc < $imcMin): ?>
                                                        <!-- IMC<16.5 -> Insuffisance pondérale -->
                                                        Vous êtes en insuffisance pondérale. Ce site ne peut pas vous prendre en charge, consultez un médecin ou un diététicien.
                                                        <?php
                                                    elseif ($imc >= $imcMin && $imc <= $imcMax) :
                                                        //IMC>=18.5 && IMC <=25 -> Corpulence normale
                                                        $categorie = "Corpulence normale";
                                                        echo('Vous êtes dans la catégorie : ' . $categorie);
                                                        ?>
                                                    <?php elseif ($imc > $imcMax && $imc < 40): ?>
                                                        <!-- IMC >25 -> Surpoids 
                                                           On demande alors à l'utilisateur s'il souhaite perdre du poids : deux possibilités s'offrent à lui "Oui" et "Non". 
                                                           S'il clique sur "Oui", on ouvre une popup, lui demandant s'il souhaite effectuer une perte pondérale modérée sur 6 mois
                                                           ou une perte pondérale plus contraignante
                                                           Dans tous les cas (même si le calcul n'est pas identique dans tous les cas, nous calculons le nombre de calories qu'il doit consommer
                                                           en fonction de sa taille, de son poids & de la décision qu'il en prise concernant la perte de poids-->

                                                        <!-- #TODO : mettre dans une balise <form> sinon le input ne sert à rien -->
                                                        <div id='choixPertePoids'>
                                                            <div class="p3">Vous êtes en surcharge pondérale. Souhaitez-vous perdre du poids ?<br /></div>
                                                            <br/>

                                                            <a id='non'><input type="submit" class="button" value="Non"/></a>
                                                            <a id='oui'><input type="submit" class="button" value="Oui"/></a>
                                                        </div>
                                                        <!-- Si l'utilisateur est un enfant (age<=18 ans), nous lui indiquons seulement, si sa corpulence est "normale" ou non -->
                                                    <?php else : ?>
                                                        <!-- IMC>40 -> Surcharge pondérale -->
                                                        <div class="p3">Vous êtes en surcharge pondérale trop élevée. Ce site ne peut pas vous prendre en charge, consultez un médecin ou un diététicien.</div>
                                                    <?php endif; ?>

                                                    <?php
                                                else :
                                                    if ($imc >= $imcMin && $imc <= $imcMax) :
                                                        ?>
                                                        Vous êtes dans la catégorie : Corpulence normale
                                                    <?php else : ?>
                                                        Vos paramètres corporels font que ce site ne peut pas vous prendre en charge et vous demande de consulter un médecin ou un diététicien
                                                    <?php endif; ?>
                                                </td>
                                                <td></td>
                                                <td>

                                                    <?php if (!empty($fille)) : ?>
                                                        <a href="../img/courbef2.gif">
                                                            <div class="image-wrapper overlay-fade-in">
                                                                <div id="testimg" style="background-image: url(../img/courbef2.gif); height: 650px; width: 560px;">
                                                                </div>


                                                                <div class="image-overlay-content">
                                                                    <h2>Courbe IMC fille</h2>
                                                                    <p class="description">Cliquez pour aficher en grand</p>
                                                                </div>
                                                            </div>
                                                        </a>

                                                        <?php
                                                    endif;
                                                    if (!empty($garcon)) :
                                                        ?>
                                                        <a href="../img/courbef2.gif">
                                                            <div class="image-wrapper overlay-fade-in">

                                                                <?php echo $this->Html->image('courbeg2.gif', array('alt' => 'Courbe IMC garçon', 'id' => 'testimg')) ?>

                                                                <div class="image-overlay-content">
                                                                    <h2>Courbe IMC garçon</h2>
                                                                    <p class="description">Cliquez pour aficher en grand</p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    <?php endif; ?>
                                                </td>
                                            <?php endif; ?>


                                        </tr>
                                        </tbody>
                                        </table>         
                                    </div>
                                </div>
                                <!--Si la personne a plus de 18 ans, on calcule son IMC avec l'équation suivante poids/ taille² -->







                                <script type="text/javascript">

                                    $("#testimg").ready(function (ev) {
                                        var age = <?php echo $_POST['zt_age'] ?>;
                                        var imc = <?php echo $imc ?>;
                                        var color = '#ef1919';
                                        var size = '8px';
                                        if (imc > 11 && imc < 32) {
                                            $("#testimg").append(
                                                    $('<div></div>')
                                                    .css('position', 'relative')
                                                    .css('top', (32 - imc) * 4.305 + 2.3 + '%')
                                                    .css('left', age * 5 + 7.5 + '%')
                                                    .css('width', size)
                                                    .css('height', size)
                                                    .css('background-color', color)
                                                    );
                                        }
                                    })

                                </script>
                                </div>

                                <div id="blocIMC">
                                    <!-- Fader -->
                                </div>

                                <!-- Sil'utilisateur est en surpoids, on lui demande s'il souhaite effectué une pere pondérale modérée sur six mois ou une perte pondérale plus contraignante -->
                                <div id="blocQuestion">
                                    <div id="presentation">

                                        <div class="row">
                                            <div class="small-12 small-centered columns">
                                                <div class="title-area"> Calcul de votre IMC </div> 
                                                <div class="textarea">
                                                    <p class="text-justify">
                                                        Perdre du poids et après maintenir ce poids stable ne peut réussir que si deux impératifs sont remplis :<br/>
                                                    <ul>
                                                        <li> une réduction des apports alimentaires (nous allons vous aider)</li>
                                                        <li> et la pratique d'une activité physique continue (nous allons vous aider aussi).</li>
                                                    </ul> 
                                                    </p>			
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="small-12 small-centered columns">
                                                <h3>Souhaitez-vous, effectuer une : </h3>
                                                <p><input type="radio" class="radio" name="radio" value="250" id='m' /> Perte pondérale modérée dans six mois (Conseillée)</p>
                                                <p><input type="radio"  class="radio" name="radio" value="500" id='c' /> Perte pondérale plus contraignante </p>

                                                <?php echo $this->Form->create(null); ?>

                                                <input type="submit" class="button" name="retour" value="Retour" id='r'>
                                                <input type="submit" class="button" name="valider" value="Valider" id='v'>
                                                </form>
                                            </div>
                                        </div>
                                    </div>  
                                </div> 
                            <?php endif; ?>
                            <script type="text/javascript">
                                jQuery(document).ready(function ($) {
                                    // SHOW/HIDE
                                    $('#blocIMC').hide();
                                    $('#blocQuestion').hide();
                                    $('#presentation #oui').click(function (e) {
                                        $('#presentation').fadeOut();
                                        $('#blocQuestion').fadeIn();
                                        $('#blocIMC').fadeIn();
                                    });
                                    $('#presentation #non').click(function (e) {
                                        $('#presentation #choixPertePoids').fadeOut();
                                    });
                                    $('#blocQuestion #m').click(function (e) {
                                        var newBEE = <?php echo $BEE ?> - 250;
                                        document.getElementById('besoinsEnergetiques').innerHTML = "de " + newBEE + " calories par jour.";
                                    });
                                    $('#blocQuestion #c').click(function (e) {
                                        var newBEE = <?php echo $BEE ?> - 500;
                                        document.getElementById('besoinsEnergetiques').innerHTML = "de " + newBEE + " calories par jour.";
                                    });
                                    $('#blocQuestion #v').click(function (e) {
                                        $('#blocQuestion').fadeOut();
                                        $('#blocIMC').fadeOut();
                                    });
                                    $('#blocQuestion #r').click(function (e) {
                                        $('#blocIMC').hide();
                                        $('#blocQuestion').hide();
                                        $('#presentation').fadeIn();
                                    });


                                });

                            </script>