<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon diététicien');
?>﻿

<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['controller' => 'pages', 'action' => 'home', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Mon diététicien', 'Javascript:void(0);'); ?></li>
</nav>

<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Mon diététicien </div> 
        </div>
        <div class="textarea">
            <p class="text-justify">
                Votre accompagnateur est un professionnel de santé (médecin ou diététicien) qui vous accompagnera dans vos choix 
                d'alimentation et vous proposera de nouvelles solutions pour avoir une meilleure hygiène de vie.
            </p>			
        </div>
    </div>


    <div class="row">
        <div class="small-12 columns">
            <div id="texte4">
                <?php if (AuthComponent::user('id') == null) : $suivi = 'non connecté'; ?>
                    <!-- afficher si un visiteur souhaite utiliser une foncitonnalité qui demande une inscription -->
                    <div id="besoinCompte" class="reveal-modal" data-reveal>
                        <h2 id="modalTitle">Connexion nécessaire</h2>
                        <p class="lead">Vous devez être connecté pour accéder à cette fonctionnalité.</p>
                        <?php
                        echo $this->Html->link(
                                'S\'inscrire', array(
                            'controller' => 'users',
                            'action' => 'add'
                                ), array('class' => 'button')
                        );
                        ?>
                        <?php
                        echo $this->Html->link(
                                'Se connecter', array(
                            'controller' => 'users',
                            'action' => 'login'
                                ), array('class' => 'button')
                        );
                        ?>
                        <a class="close-reveal-modal" aria-label="Close">&#215;</a>
                    </div>
                <?php elseif ($suivi == 'dieteticien') : ?>	
                    <!-- Le consultant est un diététicien -->
                    <h2 class="text-center"> Bienvenue diététicien </h2>
                    <div class="p1">Vous êtes nommé comme diététicien du site, vous avez donc accès à des actions qui sont disponnibles en haut du site pour intéragir avec vos clients.</div>
                <?php elseif (empty($dieteticiens)) : ?>
                    <!-- Aucun diététicien -->
                   <h2 class="text-center"> Faire une demande </h2>
                    <div class="p1">Aucun professionnel n'est actuellement enregistré sur le site, veuillez réessayer de faire une demande plus tard.</div>
                <?php else : ?>
                    <!-- Diététiciens présents sur le site -->
                    <?php if ($suivi == 'oui') : ?>
                        <!-- Le consultant à déjà un diététicien le suivant -->
                        <h1> Votre espace </h1>
                        <div class="p1">Le diététicien <?php echo $nomdiet; ?> est votre tuteur et suivra votre activitée, voici les actions disponnibles pour intéragir avec lui : </div>
                        <br>
                    <?php elseif ($suivi == 'non') : ?>
                        <!--  Le consultant n'est pas suivi -->
                        <h2 class="text-center"> Faire une demande </h2>
                        
                    <?php elseif ($suivi == 'pas encore') : ?>				
                        <!-- Le diététicien n'a pas encore accepté la demande du client -->
                        <h2 class="text-center"> Demande en cours </h2>
                        <div class="p1">Vous avez déjà effectué une demande qui n'a pas encore été approuvée par le professionnel en question. Veuillez réessayer plus tard ou annulez votre demande.</div>
                    <?php elseif ($suivi == 'refuse') : ?>				
                        <!-- Le client a été refusé par tous les diététiciens -->
                        <h2 class="text-center"> Faire une demande </h2>
                        <div class="p1">Nous sommes désolé, les diététiciens du site n'ont pas accepté vos demandes et aucun autre profesionnel n'est présent sur le site pour le moment. Veuillez réessayer plus tard.</div>
                    <?php endif; ?>
                <?php endif; ?>

                <?php if (AuthComponent::user('id') == null) : $suivi = 'non connecté'; ?>
                    <div class="small-12 columns text-center">
                        <?php echo $this->Html->link('<input class="button" type="submit" type="button" value="Connexion">', '/users/login', array('escape' => false)); ?>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Contenu concernant le choix d'un diététicien -->
            <?php if ($suivi == 'non') : ?>
                <div class="small-6 small-centered columns text-center">

                    <?php
                    echo $this->Form->create(null, array(
                        'url' => array('controller' => 'tuteurs', 'action' => 'add')
                    ));
                    ?>
                    <label for="choix"> Veuillez choisir un diététicien dans la liste</label>
                    <select name="choix">
                        <option  selected="selected">- Choisissez un diététicien -</option>
                        <?php
                        foreach ($dieteticiens as $dieteticien) {
                            echo '<option value="' . $dieteticien['User']['id'] . '">' . $dieteticien['User']['username'] . '</option>';
                        }
                        ?>
                    </select>
                    <input class="button" type="submit" value="Faire la demande" />
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Contenu concernant une demande en cours -->
        <?php if ($suivi == 'pas encore') : ?>
            <br>
            <div id="titre-accueil" class="text-center">
                <?php echo $this->Html->link('Annuler la demande', '/tuteurs/annuler', array('escape' => false, 'class' => 'button')); ?>
            </div>

        <?php endif; ?>

        <!-- Contenu concernant les utilisateur étant suivi par un diététicien -->
        <?php if ($suivi == 'oui') : ?>
            <div id="titre-accueil">
                <p> Consultez vos messages : </p>
                <br>
                <div id="texte4">
                    <?php echo $this->Html->link('<input class="button" type="button" value="Consulter">', '/tuteurs/messages', array('escape' => false)); ?>
                </div>

                <p> Ne plus être suivi par votre tuteur : </p>
                <br>
                <div id="texte4">
                    <?php echo $this->Html->link('<input class="button" type="submit" value="Annuler suivi">', '/tuteurs/annulersuivi', array('escape' => false)); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

</div> 
<script type="text/javascript">
    function nonConnecte() {
        jQuery('#besoinCompte').foundation('reveal', 'open');
    }

</script>
