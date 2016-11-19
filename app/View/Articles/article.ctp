<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Consulter un article : ' . $article['Article']['title']);
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La gazette', ['controller' => 'pages', 'action' => 'gazette', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les articles', ['action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Consultation d\'un article', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"><?php echo $article['Article']['title'] ?></div>    
            <div class="textarea">
                <p class="text-center">
                    (Catégorie : <?php echo $article['Category']['name'] ?>)
                </p>
                <?php
                $temp = explode("-", $article['Article']['created']);
                $heur = explode(" ", $temp[2]);
                $heure = $heur[1];
                $dat = explode(" ", $temp[2]);
                $date = $dat[0] . '-' . $temp[1] . '-' . $temp[0];
                ?>
                <p class="text-center">
                    Création : <?php echo $date . ' à ' . $heure; ?>
                </p>
                <?php
                $temp = explode("-", $article['Article']['modified']);
                $heur = explode(" ", $temp[2]);
                $heure = $heur[1];
                $dat = explode(" ", $temp[2]);
                $date = $dat[0] . '-' . $temp[1] . '-' . $temp[0];
                ?>
                <?php if (!empty($article['Article']['modified'])) { ?>
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
                <?php echo "<div class='p1'>" . $article['Article']['content'] . "</div>" ?>
            </div>
        </div>
    </div>
</div>