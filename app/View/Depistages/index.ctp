<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Dépistages');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Effectuer un dépistage de votre microbiote en quelques instants.');
$this->end()
?>
<div id="presentation">
    <div class="row">
        <div class="small-12 columns">
            <center><h1> Dépistage du microbiote</h1></center>
            <h4 style="text-align:justify;">Grâce à notre module de dépistage, vous allez pouvoir comprendre le microbiote<sup style="cursor: help;color:blue;font-size:0.8em;" title="Le microbiote est l'ensemble des micro-organismes (bactéries, levures, champignons, virus) vivant dans un environnement spécifique (appelé microbiome). Source : wikipédia">1</sup> ainsi qu'apprendre de nouvelles notions, le tout en seulement quelques questions.</h4>
             
            
            
            <br/><br/>
            <center>
            <?php 
            echo $this->Html->link('Dépistage petit (1 à 4 ans)', ['controller' => 'depistages',
                'action' => 'petit',
                'full_base' => true],
                ['class' => 'button', 'style' => 'width:400px;']
            );
            ?><br/><br/>
            <?php 
            echo $this->Html->link('Dépistage enfant (5 à 9 ans)', ['controller' => 'depistages',
                'action' => 'enfant',
                'full_base' => true],
                ['class' => 'button', 'style' => 'width:400px;']
            );
            ?>
                <br/><br/>
            <?php 
            echo $this->Html->link('Dépistage adolescent (10 à 18 ans)', ['controller' => 'depistages',
                'action' => 'adolescent',
                'full_base' => true],
                ['class' => 'button', 'style' => 'width:400px;']
            );
            ?>
                <br/> <br/>
            <?php 
            echo $this->Html->link('Dépistage adulte (19 ans et plus)', ['controller' => 'depistages',
                'action' => 'adulte',
                'full_base' => true],
                ['class' => 'button', 'style' => 'width:400px;']
            );
            ?><br/> <br/>
            
            </center>
              <br/><br/>
              <h4>Quelques explications :</h4>
              <p>Depuis une dizaine d’années, nous savons que l’Homme n’est pas une céature unique mais

une créature symbiotique.

Tout le monde a entendu parler de la « flore intestinale ». Cette flore intestinale était la

face émergée d’une vaste entité* microbienne que nous venons de découvrir ces dix

dernières années et que nous appelons « le Microbiote Intestinal ».

C’est la plus grande découverte médicale de tous les temps. Elle commence et va

révolutionner notre vision actuelle de la médecine et de la santé.

Cet organisme est constitué de deux entités, entretenant entre elles une relation

symbiotique : le microbiote (majoritairement intestinal) et l’hôte et ce depuis l’origine de

l’Homme.<br/>

Une relation de symbiose est une relation « d’amitié, de mutuels intérêts et de mutuelle

assistance », dans laquelle chaque entité œuvre pour sa propre survie, son propre bien et

la propre survie et le propre bien de l’autre. Si l’une est bien, l’autre est bien, si l’une est

mal l’autre est mal.<br/>

Les développements scientifiques et médicaux actuels nous donnent les connaissances et

les moyens d’explorer cette relation symbiotique pour notre plus grand bien.

Prendre soin de nous-mêmes comme nous l’avons fait jusqu’à maintenant, car nous

ignorions l’existence du microbiote, n’est plus possible.<br/>

Votre Microbiote et Vous ne faites qu’un. Le jour où vous aurez non seulement compris

mais assimilé cette idée, sera un jour nouveau et croyez en votre fidèle serviteur ce n’est

pas facile tellement c’est à peine imaginable, incroyable, énorme : probablement la plus

grande révolution scientifique et médicale de tous les temps avec des répercutions sur

notre style de vie et santé incalculables pour notre plus grand bien.<br/>

Pour apprendre à connaître ce microbiote et ses innombrables effets cliquez « Et c’est ainsi

que le microbe est grand » ?<br/>

Vouloir votre bien c’est aussi vouloir le bien de votre microbiote. Sachez bien que Vous et

Votre Microbiote êtes indissociables et uniques.

Le dépistage symbio-santé est l’exploration, en fonction des connaissances scientifiques et

médicales actuelles, de cette relation unique avec pour objectif de prévoir tout effritement

et ses conséquences sur la santé de deux partenaires inséparables.</p>
        
        </div>
    </div>
</div>
