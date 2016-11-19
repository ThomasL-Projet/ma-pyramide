<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Suivre l\'état d\'une demande');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien de consulter les suivis des patients');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Vos suivis patients', 'Javascript:void(0);'); ?></li>
</nav>

<?php
echo $this->Form->create(null, array(
    'url' => array('controller' => 'demandes', 'action' => 'analyseSuivi')
));
?>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Vos patients </div> 
        </div>
    </div>
    ﻿<div class="row">
        <div class="small-12 columns text-center">
            <?php if (empty($clients)) : ?>
                <h3 class=text-center">Vous n'avez pas de patient</h3>
            <?php else : ?>
                <h3>Sélectionnez un de vos patients</h3>
                <select class="small-4 centered" name="choix">
                    <option selected="selected">- Choisissez un patient -</option>
                    <?php
                    foreach ($clients as $client) {
                        echo '<option value="' . $client['User']['id'] . '">' . $client['User']['username'] . '</option>';
                    }
                    ?>
                </select>
                <hr />
                <h3>Sélectionnez un suivis</h3>
                <br>
                <div class="small-12 columns">
                    <div class="small-6 columns">
                        <div id="rechercheAli">
                            <?php
                            echo '<div class="rech1">';
                            echo '<strong>Mes 5 objectifs</strong><br>';
                            echo 'Donnez des conseils à votre client';
                            echo '<br><br>';
                            echo $this->Form->end(array('label' => 'Analyser le suivi', 'style' => 'width: 180px', 'name' => 'suivi1', 'class' => 'button'));
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                    <div class="small-6 columns">
                        <div id="rechercheAli">
                            <?php
                            echo '<div class="rech1">';
                            echo '<strong>Suivi alimentaire</strong><br>';
                            echo 'Analysez et modifiez les valeurs du suivi alimentaire de vos clients';
                            echo '<br><br>';
                            echo $this->Form->end(array('label' => 'Analyser le suivi', 'style' => 'width: 180px', 'name' => 'suivi2', 'class' => 'button'));
                            echo '</div>';
                            ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
</form>