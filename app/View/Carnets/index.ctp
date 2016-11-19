<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Journal');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Mon journal est un espace dédié aux utilisateurs où ceux-ci peuvent écrire des évènements marquant ou des informations utiles dans leur suivi.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon journal', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mon journal </div> 

            <div class="textarea">
                <p class="text-justify">
                    Ceci est votre espace. Rapportez-y vos aliments et votre 
                    activité physique. Conservez une trace des évènements 
                    quotidiens qui vous aideront à identifier les éléments qui 
                    pourraient être associés à vos comportements alimentaires 
                    ou à votre poids.
                </p>			
            </div>
        </div>
    </div> 

    <div class="row">
        <div class="small-12 columns">


            <?php
            if (empty($resultat)) {
                echo '<h3>Vous n\'avez rien encore dans votre journal. Ajoutez un évènement :</h3>';
                echo '<br /><div>';
                echo $this->Html->link('<input class="button" type="button" value="Ajouter">', '/carnets/add/', array('escape' => false));
                echo '</div>';
            } else {
                ?>
                <div >
                    <?php echo $this->Html->link('<input class="button" type="button" value="Ajouter">', '/carnets/add/', array('escape' => false)); ?>
                </div>
            <?php } ?>



            <br /><br />
            <?php foreach ($carnets as $carnet) : ?>
                <div id="bloc-editeur">
                    <?php //$dateCrea=$res['Carnet']['created'];  ?>

                    <?php
                    $temp = explode("-", $carnet['Carnet']['created']);
                    $split = explode(" ", $temp[2]);
                    $date = $split[0] . '-' . $temp[1] . '-' . $temp[0];
                    ?>

                    <p><strong>Jour :</strong> <?php echo $date . '<br/>'; ?></p>

                    <h2><?php echo $carnet['Carnet']['titre'] . '<br/>'; ?></h2>

                    <table id="keywords" cellspacing="0" cellpadding="0">
                        <thead>
                            <tr>
                                <th>Aliment consommés</th>
                                <th>Lieu des repas</th>
                                <th>Activité physique</th>
                                <th>Humeur</th>
                            </tr>
                        </thead>
                        <tr>
                            <td><?php echo $carnet['Carnet']['aliment']; ?></td>
                            <td><?php echo $carnet['Carnet']['lieu']; ?></td>
                            <td><?php echo $carnet['Carnet']['activite']; ?></td>
                            <td><?php echo $carnet['Carnet']['humeur']; ?></td>

                        </tr>	

                    </table>	    
                    <div id='no-format'>
                        <h2>Notes :</h2>
                        <?php
                        if (strlen($carnet['Carnet']['note']) > 0) {
                            echo $carnet['Carnet']['note'];
                        } else {
                            echo "Aucune note associée.";
                        }
                        ?>
                    </div>
                    <br>


                    <!-- echo $this->Html->link('<div class="titreActualite">' . $res['Carnet']['titre'] . '</div>', '/carnets/carnet/' . $res['Carnet']['id'] , array('escape' => false)); -->


                    <!-- Bouton modifications : pour effectuer des modifications concernant un actualite, l'administrateur doit cliquez sur le bouton symbolisé par un engrenage correspondant
                             à l'actualite qu'il souhaite modifier -->
                    <?php echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/carnets/edit/' . $carnet['Carnet']['id'], array('escape' => false)); ?>



                    <!-- Bouton suppression : pour supprimer un actualite, l'administrateur doit cliquez sur le bouton symbolisé par une croix rouge correspondant
                             à l'actualite qu'il souhaite modifier -->
                    <?php echo $this->Html->link('<input class="button" type="button" value="Supprimer">', '/carnets/delete/' . $carnet['Carnet']['id'], array('escape' => false)); ?>


                </div>
                <hr/>

            <?php endforeach; ?>
            <?php if (!empty($resultat)) : ?>
                <?php unset($carnet); ?>
                <center>
                    <span class="button">
                        <?php echo $this->Paginator->prev('<<' . __('Précédent', true), array(), null, array('class' => 'disable')); ?>
                    </span>
                    <?php echo $this->Paginator->numbers(); ?>
                    <span class="button">
                        <?php echo $this->Paginator->next('Suivant' . __('>>', true), array(), null, array('class' => 'disable')); ?>	
                    </span>
                </center>
            <?php endif; ?>
        </div>
    </div>
</div>