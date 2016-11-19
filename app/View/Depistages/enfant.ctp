<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Dépistage enfant');
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
    <li role="menuitem" class="current"><?php echo $this->Html->link('Dépistage enfant', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 columns">
            

            <center><h1> Dépistage du microbiote - Enfant</h1></center>
            <h4 style="text-align:justify;">Grâce à notre module de dépistage, vous allez pouvoir comprendre le microbiote ainsi qu'apprendre de nouvelles notions, le tout en seulement quelques questions.</h4>
            <br/><br/>
            <?php if (!isset($resultat) || $resultat != 1) : ?>
            <p> Prenez le temps de répondre à ces quelques questions en cochant la case correspondante à votre réponse : </p>
            
            <?php echo $this->Form->create('Depistage'); ?>
            <label >La maman a pris des antibiotiques pendant sa grossesse </label><br/>

            <input name="q1" class="element radio" type="radio" value="1" checked/>
            <label>Jamais</label><br/>
            <input name="q1" class="element radio" type="radio" value="2" />
            <label>Une fois</label><br/>
            <input  name="q1" class="element radio" type="radio" value="3" />
            <label>Plus d'une fois</label><br/>

            <br/>
<hr/><br/>
            <label >Pendant la grossesse ; la maman était en contact avec des animaux domestiques </label>

            <input name="q2" class="element radio" type="radio" value="1" checked/>
            <label>Oui</label><br/>
            <input name="q2" class="element radio" type="radio" value="2" />
            <label>Non</label><br/>

            <br/><hr/><br/>
            <label >Le bébé est né</label><br/>

            <input name="q3" class="element radio" type="radio" value="1" checked/>
            <label>A terme </label><br/>
            <input name="q3" class="element radio" type="radio" value="2" />
            <label>Prématuré</label><br/>
            <input  name="q3" class="element radio" type="radio" value="3" />
            <label>En dépasse de terme</label><br/>

            <br/><hr/><br/>
            <label >Le bébé est né </label><br/>

            <input name="q4" class="element radio" type="radio" value="1" checked/>
            <label>Par voie basse</label><br/>
            <input name="q4" class="element radio" type="radio" value="2" />
            <label>Par césarienne</label><br/>

            <br/><hr/><br/>
            <label>Le bébé a été allaité</label><br/>

            <input name="q5" class="element radio" type="radio" value="1" checked/>
            <label>Avec le lait maternel</label><br/>
            <input name="q5" class="element radio" type="radio" value="2" />
            <label>Avec du lait maternisé</label><br/>
            <input name="q5" class="element radio" type="radio" value="3" />
            <label>Avec les deux</label><br/>

            <br/><hr/><br/>
            <label>Le bébé a été allaité</label><br/>

            <input name="q6" class="element radio" type="radio" value="1" checked/>
            <label>Pendant 1 mois</label><br/>
            <input name="q6" class="element radio" type="radio" value="2" />
            <label>Pendant 2 mois</label><br/>
            <input  name="q6" class="element radio" type="radio" value="3" />
            <label>Pendant 3 mois</label><br/>
            <input  name="q6" class="element radio" type="radio" value="4" />
            <label>Pendant 6 mois</label><br/>
            <input  name="q6" class="element radio" type="radio" value="5" />
            <label>Pendant 1 ans</label><br/>

            <br/><hr/><br/>
            <label>Pendant le sevrage</label><br/>

            <input name="q7" class="element radio" type="radio" value="1" checked/>
            <label>Le bébé a consommé de la nourriture préparée à la maison</label><br/>
            <input name="q7" class="element radio" type="radio" value="2" />
            <label>Le bébé a consommé plus tôt des petits pots du commerce</label><br/>
            <input  name="q7" class="element radio" type="radio" value="3" />
            <label>Le bébé a consommé  les deux</label><br/>

            <br/><hr/><br/>
            <label>Jusqu'à l'age de trois ans, le bébé a pris des antibiotiques </label><br/>

            <input name="q8" class="element radio" type="radio" value="1" checked/>
            <label>Jamais</label><br/>
            <input name="q8" class="element radio" type="radio" value="2" />
            <label>Quelques fois</label><br/>
            <input  name="q8" class="element radio" type="radio" value="3" />
            <label>Souvent</label><br/>

            <br/><hr/><br/>
            <label>Mon ado mange régulièrement des produits céréaliers </label><br/>

            <input name="q9" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 5 fois par jour</label><br/>
            <input name="q9" class="element radio" type="radio" value="2" />
            <label>4 à 5 fois par jour</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>3  à 4 fois par jour</label><br/>
            <input  name="q9" class="element radio" type="radio" value="4" />
            <label>Moins de deux fois par jour</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange régulièrement des produits laitiers</label><br/>

            <input name="q10" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 3 fois par jour</label><br/>
            <input name="q10" class="element radio" type="radio" value="2" />
            <label>3 fois par jour</label><br/>
            <input  name="q10" class="element radio" type="radio" value="3" />
            <label>2 fois par jour</label><br/>
            <input  name="q10" class="element radio" type="radio" value="4" />
            <label>Moins de une fois par jour</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange régulièrement des fruits </label><br/>

            <input name="q11" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 4 fois par jour</label><br/>
            <input name="q11" class="element radio" type="radio" value="2" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q11" class="element radio" type="radio" value="3" />
            <label>2 fois par jour</label><br/>
            <input  name="q11" class="element radio" type="radio" value="4" />
            <label>1 fois par jour</label><br/>
            <input  name="q11" class="element radio" type="radio" value="5" />
            <label>Jamais</label><br/>
            
            <br/><hr/><br/>
            <label>Mon enfant mange régulièrement des légumes </label><br/>

            <input name="q12" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 4 fois par jour</label><br/>
            <input name="q12" class="element radio" type="radio" value="2" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="3" />
            <label>2 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="4" />
            <label>1 fois par jour</label><br/>
            <input  name="q12" class="element radio" type="radio" value="5" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange régulièrement de la viande, poisson, volaille, oeufs ...</label><br/>

            <input name="q13" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 2 fois par jour</label><br/>
            <input name="q13" class="element radio" type="radio" value="2" />
            <label>2 fois par jour</label><br/>
            <input  name="q13" class="element radio" type="radio" value="3" />
            <label>Une fois par jour</label><br/>
            <input  name="q13" class="element radio" type="radio" value="4" />
            <label>Quelque fois par semaine</label><br/>
            <input  name="q13" class="element radio" type="radio" value="5" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mange au fast food </label><br/>

            <input name="q14" class="element radio" type="radio" value="1" checked/>
            <label>3 ou plus par semaine</label><br/>
            <input name="q14" class="element radio" type="radio" value="2" />
            <label>2 fois par semaine</label><br/>
            <input  name="q14" class="element radio" type="radio" value="3" />
            <label>1 fois par semaine ou moins</label><br/>
            <input  name="q14" class="element radio" type="radio" value="4" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant boit régulièrement des jus ou des boissons aromatisés</label><br/>

            <input name="q15" class="element radio" type="radio" value="1" checked/>
            <label>Plus de 4 fois par jour</label><br/>
            <input name="q15" class="element radio" type="radio" value="2" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q15" class="element radio" type="radio" value="3" />
            <label>2 fois par jour</label><br/>
            <input  name="q15" class="element radio" type="radio" value="4" />
            <label>1 fois par jour ou moins</label><br/>

            <br/><hr/><br/>
            <label>J'ai de la difficulté à acheter la nourriture qui lui conviendrait</label><br/>

            <input name="q16" class="element radio" type="radio" value="1" checked/>
            <label>La plus part du temps</label><br/>
            <input name="q16" class="element radio" type="radio" value="2" />
            <label>Quelques fois</label><br/>
            <input  name="q16" class="element radio" type="radio" value="3" />
            <label>Rarement</label><br/>
            <input  name="q16" class="element radio" type="radio" value="4" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant mâche ses aliments avec difficulté, avale de travers ou s'étouffe </label><br/>

            <input name="q17" class="element radio" type="radio" value="1" checked/>
            <label>Souvent</label><br/>
            <input name="q17" class="element radio" type="radio" value="2" />
            <label>Quelques fois</label><br/>
            <input  name="q17" class="element radio" type="radio" value="3" />
            <label>Rarement</label><br/>
            <input  name="q17" class="element radio" type="radio" value="4" />
            <label>Jamais</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant a faim au moment des repas</label><br/>

            <input name="q18" class="element radio" type="radio" value="1" checked/>
            <label>Toujours</label><br/>
            <input name="q18" class="element radio" type="radio" value="2" />
            <label>La plus part du temps</label><br/>
            <input  name="q18" class="element radio" type="radio" value="3" />
            <label>Quelques fois</label><br/>
            <input  name="q18" class="element radio" type="radio" value="4" />
            <label>Rarement</label><br/>
            <input  name="q18" class="element radio" type="radio" value="5" />
            <label>Jamais</label><br/>
            
            <br/><hr/><br/>
            <label>Mon enfant mange régulièrement</label><br/>

            <input name="q19" class="element radio" type="radio" value="1" checked/>
            <label>Moins de 2 fois par jour</label><br/>
            <input name="q19" class="element radio" type="radio" value="2" />
            <label>2 fois par jour</label><br/>
            <input  name="q19" class="element radio" type="radio" value="3" />
            <label>3 à 4 fois par jour</label><br/>
            <input  name="q19" class="element radio" type="radio" value="4" />
            <label>4 à 5 fois par jour</label><br/>
            <input  name="q19" class="element radio" type="radio" value="5" />
            <label>Plus de 6 fois par jour</label><br/>

            <br/><hr/><br/>
            <label>Mon enfant décide lui-même de la quantité qu'il mange</label><br/>

            <input name="q20" class="element radio" type="radio" value="1" checked/>
            <label>Toujours</label><br/>
            <input name="q20" class="element radio" type="radio" value="2" />
            <label>La plus part du temps</label><br/>
            <input  name="q20" class="element radio" type="radio" value="3" />
            <label>Quelques fois</label><br/>
            <input  name="q20" class="element radio" type="radio" value="4" />
            <label>Rarement</label><br/>
            <input  name="q20" class="element radio" type="radio" value="5" />
            <label>Jamais</label><br/>

            <br/>

            <input type="submit" class="button" value="Envoyer le formulaire" /></form>
            <?php endif; 
            if (isset($resultat) && $resultat == 1) {
                echo "<h4>D'après les résultats de votre formulaire voici votre statu : <b>" . $resultatScore."</b>";
                echo "<br/>Pour mieux comprendre ces résultats, lisez les informations ci-dessous : </h4><br/><br/>";
                for($i = 0 ; $i < 20 ;$i++) {
                    $varName = "r".$i;
                    echo ${$varName} ; echo "<br/><hr/><br/>";
                }
                
                
            }
            ?>
            
            
        </div>
    </div>
</div>

