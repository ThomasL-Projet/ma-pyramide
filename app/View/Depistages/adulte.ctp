<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Dépistage adulte');
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
    <li role="menuitem" class="current"><?php echo $this->Html->link('Dépistage adulte', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 columns">
            

            <center><h1> Dépistage du microbiote - Adulte</h1></center>
            <h4 style="text-align:justify;">Grâce à notre module de dépistage, vous allez pouvoir comprendre le microbiote ainsi qu'apprendre de nouvelles notions, le tout en seulement quelques questions.</h4>
            <br/><br/>
            <?php if (!isset($resultat) || $resultat != 1) : ?>
            <p> Prenez le temps de répondre à ces quelques questions en cochant la case correspondante à votre réponse : </p>
            
            <?php echo $this->Form->create('Depistage'); ?>
            <label >Votre maman a pris des antibiotiques pendant sa grossesse </label><br/>

            <input name="q1" class="element radio" type="radio" value="1" checked/>
            <label>Jamais</label><br/>
            <input name="q1" class="element radio" type="radio" value="2" />
            <label>Une fois</label><br/>
            <input  name="q1" class="element radio" type="radio" value="3" />
            <label>Plus d'une fois</label><br/>

            <br/>
            <hr/><br/>

            <label >Pendant la grossesse ; votre maman était en contact avec des animaux domestiques </label>

            <input name="q2" class="element radio" type="radio" value="1" checked/>
            <label>Oui</label><br/>
            <input name="q2" class="element radio" type="radio" value="2" />
            <label>Non</label><br/>

            <br/><hr/><br/>
            <label >Vous êtes né</label><br/>

            <input name="q3" class="element radio" type="radio" value="1" checked/>
            <label>A terme </label><br/>
            <input name="q3" class="element radio" type="radio" value="2" />
            <label>Prématuré</label><br/>
            <input  name="q3" class="element radio" type="radio" value="3" />
            <label>En dépasse de terme</label><br/>

            <br/><hr/><br/>
            <label >Vous êtes né </label><br/>

            <input name="q4" class="element radio" type="radio" value="1" checked/>
            <label>Par voie basse</label><br/>
            <input name="q4" class="element radio" type="radio" value="2" />
            <label>Par césarienne</label><br/>

            <br/><hr/><br/>
            <label>Vous avez été allaité</label><br/>

            <input name="q5" class="element radio" type="radio" value="1" checked/>
            <label>Avec le lait maternel</label><br/>
            <input name="q5" class="element radio" type="radio" value="2" />
            <label>Avec du lait maternisé</label><br/>
            <input name="q5" class="element radio" type="radio" value="3" />
            <label>Avec les deux</label><br/>

            <br/><hr/><br/>
            <label>Vous avez été allaité</label><br/>

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
            <label>Jusqu'à l'age de trois ans, vous avez pris des antibiotiques </label><br/>

            <input name="q8" class="element radio" type="radio" value="1" checked/>
            <label>Jamais</label><br/>
            <input name="q8" class="element radio" type="radio" value="2" />
            <label>Quelques fois</label><br/>
            <input  name="q8" class="element radio" type="radio" value="3" />
            <label>Souvent</label><br/>

            <br/><hr/><br/>
            <label>Mon poids a varié ces derniers 6 mois</label><br/>
            <!-- EDITED À PARTIR DE MAINTENANT -->
            <input name="q9" class="element radio" type="radio" value="1" checked/>
            <label>Oui, j’ai pris plus de 5 kg</label><br/>
            <input name="q9" class="element radio" type="radio" value="2" />
            <label>Oui, j’ai pris entre 3 et 5 kg</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Oui, j’ai pris 2 kg</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Non, mon poids n’a pas varié</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Oui, j’ai perdu au-delà de 5 kg</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Oui, j’ai perdu entre 3 et 5 kg</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Oui, j’ai perdu 2 kg</label><br/>
            <input  name="q9" class="element radio" type="radio" value="3" />
            <label>Je ne sais pas si mon poids a changé</label><br/>
            <br/><hr/><br/>
            
            <label>Votre poids s’est-il modifié ces derniers 6 mois</label><br/>

            <input name="q10" class="element radio" type="radio" value="1" checked/>
            <label>Oui</label><br/>
            <input name="q10" class="element radio" type="radio" value="2" />
            <label>Non</label><br/>

            <br/><hr/><br/>
            <label>Pensez-vous que votre poids est </label><br/>

            <input name="q11" class="element radio" type="radio" value="1" checked/>
            <label>Supérieur à celui qu’il devrait être</label><br/>
            <input name="q11" class="element radio" type="radio" value="2" />
            <label>Correct</label><br/>
            <input  name="q11" class="element radio" type="radio" value="3" />
            <label>Insuffisant</label><br/>
            
            <br/><hr/><br/>
            <!-- DÉBUT DE LA QUESTION 10 D'APRÈS LE FORMULAIRE -->
            <label>Sautez-vous des repas </label><br/>

            <input name="q12" class="element radio" type="radio" value="1" checked/>
            <label>Jamais ou rarement</label><br/>
            <input name="q12" class="element radio" type="radio" value="2" />
            <label>Quelquefois</label><br/>
            <input  name="q12" class="element radio" type="radio" value="3" />
            <label>Souvent</label><br/>
            <input  name="q12" class="element radio" type="radio" value="4" />
            <label>Presque chaque jour</label><br/>

            <br/><hr/><br/>
            <label>Quelles sont vos habitudes alimentaires </label><br/>

            <input name="q13" class="element radio" type="radio" value="1" checked/>
            <label>Je mange la plus part des aliments</label><br/>
            <input name="q13" class="element radio" type="radio" value="2" />
            <label>Je limite quelques aliments mais j’arrive à gérer</label><br/>
            <input  name="q13" class="element radio" type="radio" value="3" />
            <label>Je me limite toujours et j’ai des difficultés à gérer</label><br/>
            <br/><hr/><br/>
            
            <label>Combien de temps dure vos repas</label><br/>

            <input name="q14" class="element radio" type="radio" value="1" checked/>
            <label>Moins de 20 minutes</label><br/>
            <input name="q14" class="element radio" type="radio" value="2" />
            <label>Plus de 20 minutes</label><br/>

            <br/><hr/><br/>
            <label>Ressentez-vous la sensation de faim ou d’appétit</label><br/>

            <input name="q15" class="element radio" type="radio" value="1" checked/>
            <label>Oui</label><br/>
            <input name="q15" class="element radio" type="radio" value="2" />
            <label>Non</label><br/>

            <br/><hr/><br/>
            <label>Comment décririez-vous votre appétit</label><br/>

            <input name="q16" class="element radio" type="radio" value="1" checked/>
            <label>Très bon</label><br/>
            <input name="q16" class="element radio" type="radio" value="2" />
            <label>Bon</label><br/>
            <input  name="q16" class="element radio" type="radio" value="3" />
            <label>Moyen</label><br/>
            <input  name="q16" class="element radio" type="radio" value="4" />
            <label>Faible</label><br/>

            <br/><hr/><br/>
            <label>Ressentez-vous la sensation de satiété</label><br/>

            <input name="q17" class="element radio" type="radio" value="1" checked/>
            <label>Oui</label><br/>
            <input name="q17" class="element radio" type="radio" value="2" />
            <label>Non</label><br/>

            <br/><hr/><br/>
            <label>Lorsque vous ressentez la sensation de satiété au cours du repas ?</label><br/>

            <input name="q18" class="element radio" type="radio" value="1" checked/>
            <label>Vous arrêtez de manger</label><br/>
            <input name="q18" class="element radio" type="radio" value="2" />
            <label>Vous continuez de manger car le repas n’est pas fini</label><br/>
            
            <br/><hr/><br/>
            <label>Combien de portions standard de fruits et légumes mangez-vous par jour, Les fruits ou légumes peuvent être en boite, frais, congelés ou sous forme de jus.</label><br/>

            <input name="q19" class="element radio" type="radio" value="1" checked/>
            <label>5 ou plus</label><br/>
            <input name="q19" class="element radio" type="radio" value="2" />
            <label>4</label><br/>
            <input  name="q19" class="element radio" type="radio" value="3" />
            <label>3</label><br/>
            <input  name="q19" class="element radio" type="radio" value="4" />
            <label>2</label><br/>
            <input  name="q19" class="element radio" type="radio" value="5" />
            <label>Moins de 2</label><br/>

            <br/><hr/><br/>
            <label>Dans une journée, combien de fois vous mangez de viande, œufs, poisson, poulet ou substituts protéiques</label><br/>

            <input name="q20" class="element radio" type="radio" value="1" checked/>
            <label>2 fois ou plus</label><br/>
            <input name="q20" class="element radio" type="radio" value="2" />
            <label>1 à 2 fois</label><br/>
            <input  name="q20" class="element radio" type="radio" value="3" />
            <label>Une fois</label><br/>
            <input  name="q20" class="element radio" type="radio" value="4" />
            <label>Moins d'une fois </label><br/>

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

