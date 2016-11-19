<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Dépistage petit');
?>
<style>
    
    
label {
    color:black;
}
label, input {
    font-size:25px;
}
.element {
    margin:15px !important;
}

</style>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Dépistage', ['controller' => 'depistages', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Dépistage petit', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 columns">
            

            <center><h1> Dépistages du microbiote - Petit</h1></center>
            <h4 style="text-align:justify;">Grâce à notre module de dépistage, vous allez pouvoir comprendre le microbiote ainsi qu'apprendre de nouvelles notions, le tout en seulement quelques questions.</h4>
            <br/><br/>
            <?php if (!isset($resultat) || $resultat != 1) : ?>
            <p> Prenez le temps de répondre à ces quelques questions en cochant la case correspondante à votre réponse : </p>
            
            <?php echo $this->Form->create('Depistage'); ?>
            <label >La maman avant et au moment de la grossesse était (Aide) </label><br/>

            <input name="q1" class="element radio" type="radio" value="1-1" checked/>
            <label>En surcharge pondérale</label><br/>
            <input name="q1" class="element radio" type="radio" value="2-0" />
            <label>Normo-pondérée</label><br/>

            <br/><hr/><br/>

            <label >La maman a pris pendant la grossesse (Aide) </label>

            <input name="q2" class="element radio" type="radio" value="1-0" checked/>
            <label>9 à 12 kg</label><br/>
            <input name="q2" class="element radio" type="radio" value="2-0" />
            <label>Moins de 9 kg</label><br/>
            <input name="q2" class="element radio" type="radio" value="3-1" />
            <label>Plus de 12 kg</label><br/>

            <br/><hr/><br/>
            <label >La maman a pris des antibiotiques pendant sa grossesse</label><br/>

            <input name="q3" class="element radio" type="radio" value="1-0" checked/>
            <label>Jamais</label><br/>
            <input name="q3" class="element radio" type="radio" value="2-1" />
            <label>Une fois</label><br/>
            <input  name="q3" class="element radio" type="radio" value="3-2" />
            <label>Plus d’une fois</label><br/>

            <br/><hr/><br/>
            <label >Le bébé est né </label><br/>

            <input name="q4" class="element radio" type="radio" value="1-0" checked/>
            <label>A terme</label><br/>
            <input name="q4" class="element radio" type="radio" value="2-2" />
            <label>Prématuré</label><br/>
             <input  name="q4" class="element radio" type="radio" value="3-1" />
            <label>En dépassement de terme</label><br/>

            <br/><hr/><br/>
            <label>Le bébé a été allaité</label><br/>

            <input name="q6" class="element radio" type="radio" value="1-0" checked/>
            <label>Avec le lait maternel</label><br/>
            <input name="q6" class="element radio" type="radio" value="2-2" />
            <label>Avec du lait maternisé</label><br/>
            <input name="q6" class="element radio" type="radio" value="3-1" />
            <label>Avec les deux</label><br/>

            <br/><hr/><br/>
            <label>Le bébé est né</label><br/>

            <input name="q5" class="element radio" type="radio" value="1-0" checked/>
            <label>Par voie basse</label><br/>
            <input name="q5" class="element radio" type="radio" value="2-2" />
            <label>Par césarienne</label><br/>

            <br/><hr/><br/>
            <label>La maman qui allaitait était</label><br/>

            <input name="q7" class="element radio" type="radio" value="1-0" checked/>
            <label>Normo-pondérée</label><br/>
            <input name="q7" class="element radio" type="radio" value="2-1" />
            <label>En surcharge pondérale</label><br/>

            <br/><hr/><br/>
            <label>Le bébé a été allaité</label><br/>

            <input name="q8" class="element radio" type="radio" value="1-1" checked/>
            <label>Pendant 1 mois</label><br/>
            <input name="q8" class="element radio" type="radio" value="2-1" />
            <label>Pendant 2 mois</label><br/>
            <input  name="q8" class="element radio" type="radio" value="3-0" />
            <label>Pendant 3 mois</label><br/>
            <input  name="q8" class="element radio" type="radio" value="4-0" />
            <label>Pendant 6 mois</label><br/>
            <input  name="q8" class="element radio" type="radio" value="5-0" />
            <label>Pendant 1 ans</label><br/>

            <br/><hr/><br/>
            <label>Pendant le sevrage</label><br/>

            <input name="q9" class="element radio" type="radio" value="1-0" checked/>
            <label>Le bébé a consommé de la nourriture préparée à la maison</label><br/>
            <input name="q9" class="element radio" type="radio" value="2-2" />
            <label>Le bébé a consommé plutôt des petits pots du commerce</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3-1" />
            <label>Le bébé a consommé les deux</label><br/>

            <br/>
            <?php /// bug a partir d'ici ?>
            <label>Mon bébé mange régulièrement des produits céréaliers</label><br/>

            <input name="q10" class="element radio" type="radio" value="1-1" checked/>
            <label>Plus de 5 fois par jour</label><br/>
            <input name="q10" class="element radio" type="radio" value="2-0" />
            <label>4 à 5 fois par jour</label><br/>
            <input  name="q10" class="element radio" type="radio" value="3-0" />
            <label>2 à 3 fois par jour</label><br/>
            <input  name="q10" class="element radio" type="radio" value="4-0" />
            <label>Moins de 2 fois par jour</label><br/>

            <br/><hr/><br/>
            <label>Mon bébé mange régulièrement des produits laitiers</label><br/>

            <input name="q11" class="element radio" type="radio" value="1-0" checked/>
            <label>Plus de 3 fois par jour</label><br/>
            <input name="q11" class="element radio" type="radio" value="2-0" />
            <label>3 fois par jour</label><br/>
            <input  name="q11" class="element radio" type="radio" value="3-1" />
            <label>2 fois par jour</label><br/>
            <input  name="q11" class="element radio" type="radio" value="4-2" />
            <label>Une fois par jour ou moins</label><br/>
            
            <br/><hr/><br/>
            <label>Mon bébé mange régulièrement des fruits et légumes </label><br/>

            <input name="q12" class="element radio" type="radio" value="1-0" checked/>
            <label>Plus de 4 fois par jour</label><br/>
            <input name="q12" class="element radio" type="radio" value="2-0" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="3-1" />
            <label>2 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="4-2" />
            <label>1 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="5-3" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon bébé mange régulièrement de la viande, du poisson, de la volaille des œufs ou des alternatives (légumes secs …)</label><br/>

            <input name="q13" class="element radio" type="radio" value="1-0" checked/>
            <label>Plus de 2 fois par jour</label><br/>
            <input name="q13" class="element radio" type="radio" value="2-0" />
            <label>2 fois par jour</label><br/>
            <input  name="q13" class="element radio" type="radio" value="3-1" />
            <label>Une fois par jour</label><br/>
            <input  name="q13" class="element radio" type="radio" value="4-2" />
            <label>Quelque fois par semaine</label><br/>
            <input  name="q13" class="element radio" type="radio" value="5-3" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange au fast food </label><br/>

            <input name="q14" class="element radio" type="radio" value="1-3" checked/>
            <label>3 ou plus par semaine</label><br/>
            <input name="q14" class="element radio" type="radio" value="2-2" />
            <label>2 fois par semaine</label><br/>
            <input  name="q14" class="element radio" type="radio" value="3-1" />
            <label>1 fois par semaine ou moins</label><br/>
            <input  name="q14" class="element radio" type="radio" value="4-0" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant boit régulièrement des jus ou des boissons aromatisés, sucrés</label><br/>

            <input name="q15" class="element radio" type="radio" value="1-3" checked/>
            <label>Plus de 4 fois par jour</label><br/>
            <input name="q15" class="element radio" type="radio" value="2-3" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q15" class="element radio" type="radio" value="3-2" />
            <label>2 fois par jour</label><br/>
            <input  name="q15" class="element radio" type="radio" value="4-1" />
            <label>1 fois par jour ou moins</label><br/>
            <input  name="q15" class="element radio" type="radio" value="5-0" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>J’ai de la difficulté à acheter la nourriture qui lui conviendrait</label><br/>

            <input name="q16" class="element radio" type="radio" value="1-2" checked/>
            <label>La plus part du temps</label><br/>
            <input name="q16" class="element radio" type="radio" value="2-1" />
            <label>Quelques fois</label><br/>
            <input  name="q16" class="element radio" type="radio" value="3-1" />
            <label>Rarement</label><br/>
            <input  name="q16" class="element radio" type="radio" value="4-0" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mâche ses aliments avec difficulté, avale souvent de travers, s’étouffe</label><br/>

            <input name="q17" class="element radio" type="radio" value="1-2" checked/>
            <label>Souvent</label><br/>
            <input name="q17" class="element radio" type="radio" value="2-1" />
            <label>Quelques fois</label><br/>
            <input  name="q17" class="element radio" type="radio" value="3-0" />
            <label>Rarement</label><br/>
            <input  name="q17" class="element radio" type="radio" value="4-0" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange tout seul aux repas ou aux goûters</label><br/>

            <input name="q18" class="element radio" type="radio" value="1-0" checked/>
            <label>Toujours</label><br/>
            <input name="q18" class="element radio" type="radio" value="2-0" />
            <label>La plus part du temps</label><br/>
            <input  name="q18" class="element radio" type="radio" value="3-1" />
            <label>Quelques fois</label><br/>
            <input  name="q18" class="element radio" type="radio" value="4-2" />
            <label>Rarement</label><br/>
            <input  name="q18" class="element radio" type="radio" value="5-3" />
            <label>Jamais</label><br/>
            
            <br/><hr/><br/>
            <label>Mon enfant boit au biberon</label><br/>

            <input name="q19" class="element radio" type="radio" value="1-2" checked/>
            <label>Toujours</label><br/>
            <input name="q19" class="element radio" type="radio" value="2-2" />
            <label>La plus part du temps</label><br/>
            <input  name="q19" class="element radio" type="radio" value="3-1" />
            <label>Quelques fois</label><br/>
            <input  name="q19" class="element radio" type="radio" value="4-1" />
            <label>Rarement</label><br/>
            <input  name="q19" class="element radio" type="radio" value="5-0" />
            <label>Plus de 6 fois par jour</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant à faim au moment des repas</label><br/>

            <input name="q20" class="element radio" type="radio" value="1-0" checked/>
            <label>Toujours</label><br/>
            <input name="q20" class="element radio" type="radio" value="2-0" />
            <label>La plus part du temps</label><br/>
            <input  name="q20" class="element radio" type="radio" value="3-1" />
            <label>Quelques fois</label><br/>
            <input  name="q20" class="element radio" type="radio" value="4-2" />
            <label>Rarement</label><br/>
            <input  name="q20" class="element radio" type="radio" value="5-3" />
            <label>Jamais</label><br/>

            <br/>

            <input type="submit" class="button" value="Envoyer le formulaire" /></form>
            <?php endif; 
            if (isset($resultat) && $resultat == 1) {
                
                echo "<h4>D'après les résultats de votre formulaire voici votre statu : <b>" . $resultatScore."</b>";
                echo "<br/>Pour mieux comprendre ces résultats, lisez les informations ci-dessous :</h4><br/><br/>";
                for($i = 0 ; $i < 20 ;$i++) {
                    $varName = "r".$i;
                    echo ${$varName} ; echo "<br/><hr/><br/>";
                }
                
                
            }
            ?>
            
        </div>
    </div>
</div>
