<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Afficher une recette');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon dossier patient', ['full_base' => true]) ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes simulations', ['controller' => 'pages', 'action' => 'jackpotsante', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mes recettes', ['controller' => 'mesrecettes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Affichage d\'une recette', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Affichage d'une recette</div> 

        </div>  
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php if (!$afficher) : ?>
                <!-- Url incorrecte -->
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            <?php else : ?>
                <div id="bloc-editeur">
                    <div id ="affichrec">
                        <div style="text-align:center;color : #A6BC2A;"><h1>Votre recette :</h1></div><br><br><br>
                        <table style="width:730px">
                            <thead>
                                <tr>
                                    <td width=50%>Nom de la recette</td>
                                    <td width=50% ><?php echo $recette['Mesrecette']['nom']; ?></td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Description</td>
                                    <td><?php echo $recette['Mesrecette']['description']; ?></td>
                                </tr>
                                <tr>
                                    <td>Temps de cuisson</td>
                                    <td><?php echo $recette['Mesrecette']['temps_cui'] . ' minute(s)'; ?></td>
                                </tr>
                                <tr>
                                    <td>Temps de préparation</td>
                                    <td><?php echo $recette['Mesrecette']['temps_prepa'] . ' minute(s)'; ?></td>
                                </tr>
                                <tr>
                                    <td>Nombre de portions</td>
                                    <td><?php echo $recette['Mesrecette']['quantite']; ?></td>
                                </tr>
                                <tr>
                                    <td>Ingrédients</td>
                                    <td><?php
                                        foreach ($aliments as $alim) {
                                            echo '<strong>Nom : ' . $alim['aliment']['Alimentsdetaille']['nom'] . '</strong><br />';
                                            echo 'portion : ' . rech_portion($alim['aliment']['Aliment'], $alim['portion']) . '<br />';
                                            echo 'quantite : ' . $alim['quantite'] . '<br />';
                                            echo '<br />';
                                        }
                                        ?></td>
                                </tr>
                                <tr>
                                    <td>Modes de préparation</td>
                                    <td><?php
                                        foreach ($recette['Modespreparation'] as $mode) {
                                            echo '<strong>Etape ' . $mode['etape'] . ' :</strong><br />';
                                            echo $mode['descri'] . '<br />';
                                            echo '<br />';
                                        }
                                        ?></td>
                                </tr>
                            </tbody>
                        </table><br />
                        <center><a id="linkcache" style="color:green;font-style:italic;" href="javascript:void(0)">Cliquez ici pour afficher les éléments nutritifs pour chaque aliment et en fonction de la quantité</a></center>
                        <br />
                        <div id="cache" style="height: 400px;overflow: scroll;">
                            <table style="width:730px;" >
                                <tr>
                                    <td width=50%><strong><?php echo $nutriments[0]['nom']; ?></strong></td>
                                    <td width=50%><?php echo $nutriments[0]['valeur']; ?></td>
                                </tr>
                                <?php
                                $i = 0;
                                foreach ($nutriments as $nut) {
                                    $i++;
                                    if ($nut['valeur'] == 0 OR $i == 1)
                                        continue;
                                    echo '<tr>';
                                    echo '<td><strong>' . str_replace("100g", $portiontotale . 'g', $nut['nom']) . '</strong></td>';
                                    echo '<td>' . $nut['valeur'] . '</td>';
                                    echo '</tr>';
                                }
                                ?>
                            </table>
                            <br />
                            <center><a id="linkcache2" style="color:green;font-style:italic;" href="javascript:void(0)">Masquer</a></center>
                        </div>
                        <br />
    <?php echo $this->Html->link('<button class="button" type="button">Retour</button>', '/mesrecettes', array('escape' => false)); ?>
                        <br />
                    </div>
                </div>
<?php endif; ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#bloc-editeur #affichrec #cache').hide();
    $('#bloc-editeur #affichrec #linkcache').click(function (e) {
        $('#bloc-editeur #affichrec #cache').show();
    });
    $('#bloc-editeur #affichrec #linkcache2').click(function (e) {
        $('#bloc-editeur #affichrec #cache').hide();
    });
</script>