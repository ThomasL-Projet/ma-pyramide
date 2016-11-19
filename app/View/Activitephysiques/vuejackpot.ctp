<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Activité Physique');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Un suivi de votre activité physique dans le temps.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes activités physiques', ['controller' => 'activitephysiques', 'action' => 'jackpot', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Jackpot Santé Physique', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 columns">

            <div class="title-area">Jackpot Santé Physique</div> 

        </div>

        <div class="small-12 columns">

            <?php
            if (!empty($resultats)) :
                $r = $objectif - $caldep
                ?>

                <table>
                    <thead>
                        <tr>
                            <th class="text-center" style="width:40%;">Nom de l'activité</th>
                            <th class="text-center" style="width:30%;">Durée (min)</th>
                            <th class="text-center" style="width:30%;">Durée nécessaire</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php foreach ($resultats as $res) : ?>
                            <?php $adet = ((($objectif - $caldep) * 64) / ($res['Activitephysique']['MET'] * $poids)) + ($res['Jackpotacti']['tempsAP']); ?>


                            <tr>
                                <td><?php echo $res['Activitephysique']['ACTIVITE_SPECIFIQUE']; ?></td>
                                <td><center><input type="text" value="<?php echo $res['Jackpotacti']['tempsAP']; ?>" onkeyup="mafonction()"/></center>
                        <input type="hidden" class="met" value="<?php echo $res['Activitephysique']['MET']; ?>"/>

                        </td>
                        <td>
                        <center><input type="text" readonly="readonly" value="<?php echo round($adet); ?>" /></center>
                        </td>
                        </tr>



                    <?php endforeach ?>
                </table>

            </div>
            <div class="small-12 columns">
                <?php if (round($r) <= 0) : ?>

                    <p id="desc">Vous atteindrez votre objectif de calories dépensé ("<?php echo ($objectif) ?>"Kcal) </p>

                <?php else : ?>
                    <br />
                    <div style="font-style:italic;color:green;font-size:1.1em;"><p id="desc">Il vous restera <?php echo ($r) ?> Kcal à dépenser </p></div>

                <?php endif; ?>
                <div id="retour1" style="margin-left:550px; position:absolute; margin-top: -30px">
                    <?php echo $this->Html->link('<input style="width:169px" type="button" name="retour" value="Retour" >', 'jackpot/', array('escape' => false)); ?>
                </div>




            </div>

        <?php else : ?>

            <h2>Vous n'avez pas choisis d'activités.</h2>
            <div id="retour1" style="margin-left:550px; position:absolute; margin-top: -30px">
                <?php echo $this->Html->link('<input style="width:169px" type="button" name="retour" value="Retour" >', 'jackpot/', array('escape' => false)); ?>
            </div>

        <?php endif; ?>
    </div>
</div>

<script type="text/javascript">
    function mafonction() {
        //document.getElementById('duree').value=document.getElementById('duree').value.replace(/\D/g,'');

        var dur, index, res, met, poids, objectif, adet;
        res = 0;
        poids = <?php echo $poids; ?>;
        objectif = <?php echo $objectif ?>;

        adet = document.getElementsByClassName('duradet');
        dur = document.getElementsByClassName('dur');
        met = document.getElementsByClassName('met');
        for (index = 0; index < dur.length; index++) {

            dur[index].value = dur[index].value.replace(/\D/g, '');

            if (isNaN(parseInt(dur[index].value))) {

                res = res;

            } else {

                res = (res + parseInt(met[index].value) * (parseInt(dur[index].value) / 64) * poids);


            }


        }

        if (objectif - res > 0) {


            document.getElementById('desc').innerHTML = "Il vous restera " + (objectif - res) + " Kcal à dépenser";

        } else {

            document.getElementById('desc').innerHTML = "Vous atteindrez votre objectif de calories dépensé (" + objectif + ")Kcal ";


        }

    }

</script>