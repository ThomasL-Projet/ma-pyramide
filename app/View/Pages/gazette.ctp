<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - La gazette');

// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Menu representant la gazette, pour les articles et actualités');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('La gazette', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> La gazette </div>      

            <div class="textarea">
                <p class="text-justify">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, 
                    sed do eiusmod tempor incididunt ut labore et dolore magna 
                    aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
                    ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis 
                    aute irure dolor in reprehenderit in voluptate velit esse 
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat 
                    cupidatat non proident, sunt in culpa qui officia deserunt
                    mollit anim id est laborum.
                </p>			
            </div>
        </div>
    </div>

    <div class="row">
        <div class="small-12 colomns">
            <h3>Que voulez vous consulter ?</h3>
            <ul class="button-group even-2">
                <li><?php echo $this->Html->link('Les articles',['controller' => 'articles', 'action' => 'index','full_base' => true], ['escape' => false, 'class' => 'button']); ?></li>
                <li><?php echo $this->Html->link('Les actualités', ['controller' => 'actualites', 'action' => 'index','full_base' => true], ['escape' => false, 'class' => 'button']); ?></li>
            </ul>
        </div>
    </div>    
</div>