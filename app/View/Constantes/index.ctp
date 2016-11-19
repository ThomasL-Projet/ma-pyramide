<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Gestion des constantes alimentaires');
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Administrateur', ['controller' => 'gestionAdmin', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Gestion des constantes alimentaires', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area">Gestion des constantes alimentaires</div>      
        </div>
    </div>     
    <div class="row" >
        <div class="small-12 large-6 columns text-center ">
            <h3>Constantes fibres : </h3>
            <table align='center'>
                <tr>
                    <td></td>
                    <td>Valeur actuelle :</td>
                </tr>
                <?php foreach ($fibres as $fibre) : ?>

                    <tr>
                        <td><?php echo $fibre['Constante']['description'] . '&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;'; ?></td>
                        <td><center><?php echo $fibre['Constante']['valeur'] . ' g/j'; ?></center></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p id="desc2"></p>
            <div id="bloc2">
                <?php echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/constantes/edit/' . $fibres[0]['Constante']['categorie'], array('escape' => false, 'title' => 'Modifier les constantes')); ?>
            </div>



        </div>
        <div class="small-12 large-6 columns text-center">

            <h3>Constantes sel : </h3>
            <table align='center'>
                <tr>
                    <td></td>
                    <td>Valeur actuelle :</td>
                </tr>
                <?php foreach ($sel as $se) : ?>
                    <tr>
                        <td><?php echo $se['Constante']['description'] . '&emsp;&emsp;'; ?></td>
                        <td><center><?php echo $se['Constante']['valeur'] . ' mg'; ?></center></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p id="desc2"></p>
            <div id="bloc2">
                <?php echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/constantes/edit/' . $sel[0]['Constante']['categorie'], array('escape' => false, 'title' => 'Modifier les constantes')); ?>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="small-12 large-6 columns left text-center">
            <h3>Constantes  protéines : </h3>
            <table align='center'>
                <tr>
                    <td></td>
                    <td>Valeur actuelle :</td>
                </tr>
                <?php foreach ($proteines as $proteine) : ?>
                    <tr>
                        <td><?php echo $proteine['Constante']['description'] . '&emsp;&emsp;'; ?></td>
                        <td><center><?php echo $proteine['Constante']['valeur'] . ' g/kg/j'; ?></center></td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <p id="desc2"></p>
            <div id="bloc2">
                <?php echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/constantes/edit/' . $proteines[0]['Constante']['categorie'], array('escape' => false, 'title' => 'Modifier les constantes')); ?>

            </div>
        </div>




        <div class="small-12 large-6 columns text-center">
            <h3>Constantes  lipides : </h3>
            <p>Actuellement, le nombre de calories qu'apportent les lipides est égal à <strong><?php echo $lipides ?>%</strong> du total énergétique</p>
            <p id="desc2"></p>
            <div id="bloc2">
                <?php echo $this->Html->link('<input class="button" type="button" value="Modifier">', '/constantes/edit/' . $lipidesbrut[0]['Constante']['categorie'], array('escape' => false, 'title' => 'Modifier les constantes')); ?>
            </div>
            <p id="desc2"></p><br>
            <br><br>
        </div> 
    </div>
</div>