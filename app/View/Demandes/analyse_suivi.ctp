<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suivre l\'état d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien d\'analyse les suivis des patients');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos suivis patients', ['controller' => 'demandes', 'action' => 'suivis', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Analyse suivi', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Analyse du suivi </div> 
        </div>
    </div>
    <br>
    ﻿<div class="row">
        <div class="small-12 columns text-center">

            <?php if (isset($_POST['suivi1'])) : ?>

                <?php if (empty($client['Cinqobjectif'])) : ?>
                    <?php echo '<h3 class="text-center">Votre client ne s\'est pas encore fixé des objectifs</h3>'; ?>
                <?php else : ?>
                    <h1>Objectifs de <i><?php echo $client['User']['username']; ?></i> :</h1>
                    <div class="span2" >Objectifs</div>
                    <div class="span3">Conseils</div>
                    <div id="contenu_obj">
                        <table class="fixed">
                            <col width="500px" />
                            <col width="500px" />
                            <?php
                            $i = count($client['Cinqobjectif']);
                            foreach ($client['Cinqobjectif'] as $obj) :
                                $i--;
                                ?>
                                <tr>
                                    <td style="border-right:1px dotted #4D2B08;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;'; ?>">
                                        <?php
                                        echo '<strong>' . dateenlettre($obj['created']) . '</strong><br><br>';
                                        echo $obj['description'] . '<br><br>';
                                        ?>
                                    </td>
                                    <td style="font-style: italic;<?php if ($i != 0) echo 'border-bottom:1px dotted #4D2B08;'; ?>">
                                        <?php
                                        if (!empty($obj['conseil'])) {
                                            echo $obj['conseil'] . '<br><br>';
                                            echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/demandes/editConseil/' . $obj['id'] . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier le conseil'));
                                            echo $this->Html->link('<input class="button" type="button" value="Supprimer">', '/demandes/deleteConseil/' . $obj['id'] . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Supprimer le conseil'));
                                        } else {
                                            echo $this->Html->link('<input class="button" type="button" value="Ajouter un conseil">', '/demandes/addConseil/' . $obj['id'] . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Ajouter un conseil'));
                                        }
                                        ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>

                <?php endif; ?>
                <!-- FIN CINQ OBJECTIFS -->
            <?php elseif (isset($_POST['suivi2'])) : ?>
                <!-- SUIVI ALIMENTAIRE -->
                <h3>Suivi alimentaire de <i><?php echo $client['User']['username']; ?></i> :</h3>
                <br>
                <div class="small-12 columns">
                    <div class="small-6 columns">
                        <p>Objectif protéines : <?php echo $obPro; ?> g</p>
                        <?php if (!empty($fix_proteines)) : ?>
                            <p style="color:red;">Vous lui avez fixé  <?php echo $fix_proteines; ?> g (avec <?php echo $fix_p_valeur; ?> g/kg/j)</p>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/' . $id_proteines . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier l\'objectif')); ?>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/' . $id_proteines . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Supprimer l\'objectif')); ?>
                        <?php else : ?>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Modifier son objectif">', '/demandes/addObjectif/1/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier son objectif')); ?>
                        <?php endif; ?>

                    </div>
                    <p>Objectif lipides : <?php echo $obLip; ?> g</p>
                    <?php if (!empty($fix_lipides)) : ?>
                        <p style="color:red;">Vous lui avez fixé  <?php echo $fix_lipides; ?> g (avec <?php echo $fix_l_valeur * 100; ?>% comme pourcentage d’énergie apportée)</p>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/' . $id_lipides . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier l\'objectif')); ?>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/' . $id_lipides . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Supprimer l\'objectif')); ?>
                    <?php else : ?>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Modifier son objectif">', '/demandes/addObjectif/2/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier son objectif')); ?>
                    <?php endif; ?>
                </div>
                <hr />

                <div class="small-12 columns">
                    <div class="small-6 columns">
                        <p>Objectif fibres : <?php echo $obFib; ?> g</p>
                        <?php if (!empty($fix_fibres)) : ?>
                            <p style="color:red;">Vous lui avez fixé  <?php echo $fix_fibres; ?> g </p>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/' . $id_fibres . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier l\'objectif')); ?>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/' . $id_fibres . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Supprimer l\'objectif')); ?>
                        <?php else : ?>
                            <?php echo $this->Html->link('<input class="button" type="button" value="Modifier son objectif">', '/demandes/addObjectif/3/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier son objectif')); ?>
                        <?php endif; ?>

                    </div>
                    <p>Objectif sel : <?php echo $obSel; ?> mg</p>
                    <?php if (!empty($fix_sel)) : ?>
                        <p style="color:red;">Vous lui avez fixé  <?php echo $fix_sel; ?> mg </p>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Modifier l\'objectif">', '/demandes/editObjectif/' . $id_sel . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier l\'objectif')); ?>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Supprimer l\'objectif">', '/demandes/deleteObjectif/' . $id_sel . '/' . $client['User']['id'], array('escape' => false, 'title' => 'Supprimer l\'objectif')); ?>
                    <?php else : ?>
                        <?php echo $this->Html->link('<input class="button" type="button" value="Modifier son objectif">', '/demandes/addObjectif/4/' . $client['User']['id'], array('escape' => false, 'title' => 'Modifier son objectif')); ?>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>