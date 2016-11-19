<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Consulter une actualité : ' . strip_tags($actualite['Actualite']['title']));
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('description', 'Retrouvez quelques conseils rapides et pratiques en terme de santé.');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La gazette', ['controller' => 'pages', 'action' => 'gazette', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les actualités', ['action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Consultation d\'une actualité', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"><?php echo $actualite['Actualite']['title'] ?></div>    
            <div class="textarea">
                <?php
                $temp = explode("-", $actualite['Actualite']['created']);
                $split = explode(" ", $temp[2]);
                $heure = $split[1];
                $split2 = explode(" ", $temp[2]);
                $date = $split2[0] . '-' . $temp[1] . '-' . $temp[0];
                ?>
                <p class="text-center">
                    Création : <?php echo $date . ' à ' . $heure; ?>
                </p>
                <?php
                $temp = explode("-", $actualite['Actualite']['modified']);
                $split = explode(" ", $temp[2]);
                $heure = $split[1];
                $split2 = explode(" ", $temp[2]);
                $date = $split2[0] . '-' . $temp[1] . '-' . $temp[0];
                ?>              
                <?php if (!empty($actualite['Actualite']['modified'])) { ?>
                    <p class = "text-center">
                        Dernière modification : <?php echo $date . ' à ' . $heure; ?>
                    </p>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns small-centered">
            <div id='no-format'>
                <?php echo "<div class='p1'>" . $actualite['Actualite']['content'] . "</div>" ?>
            </div>

        </div>
    </div>
</div>
