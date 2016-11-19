<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Retrouver vos demandes');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Permet aux diététicien de consulter ses demandes');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Diététicien', ['controller' => 'gestionDieteticien', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Vos demandes patients', ['controller' => 'demandes', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Information patient', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Informations du patient </div> 
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns text-center">
            <br>
            <label for="pseudo">Pseudo : </label> 	
            <p name="pseudo"><?php echo $users['User']['username']; ?></p>

            <label for="email">Adresse email : </label> 	
            <p name="email"><?php echo $users['User']['email']; ?></p>

            <label for="nom">Nom : </label> 	
            <p name="nom"><?php echo $users['User']['nom']; ?></p>

            <label for="pseudo">Prénom : </label> 	
            <p name="pseudo"><?php echo $users['User']['prenom']; ?></p>

            <label for="sexe">Sexe : </label> 	
            <p name="sexe"><?php echo $users['User']['sexe']; ?></p>

            <label for="taille">Taille : </label> 	
            <p name="taille"><?php echo $users['User']['taille']; ?></p>

            <label for="poids">Poids : </label> 	
            <p name="poids"><?php echo $users['User']['poids']; ?></p>

            <label for="activite">Activité : </label> 	
            <p name="activite"><?php echo $users['User']['activite']; ?></p>

            <label for="datenaiss">Date de naissance : </label> 	
            <p name="datenaiss">
                <?php 
                    list($year,$month,$day) = explode("-", $users['User']['datenaissance']);
                    $dateBonFormat = $day."/".$month."/".$year; 
                    echo $dateBonFormat;
                ?>
            </p>
            <?php echo $this->Html->link('Retour aux demandes',  ['controller' => 'demandes', 'action' => 'index', 'full_base' => true], ['class'=>'button']); ?>
        </div>
    </div>
</div>

