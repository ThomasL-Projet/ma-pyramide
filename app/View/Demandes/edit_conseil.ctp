<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Éditer le conseil d\'une demande');
?>
<div class="row">
    <div class="small-12 columns">

        <?php echo $this->Form->create('Cinqobjectif'); ?>
        <div id="presentation">
            <?php if (!$affichage) : ?>
                <!-- Accès seulement aux diététiciens et interdit aux modifications de l'url -->
                <?php echo $this->Html->link('<< Retour', '/pages/home/'); ?>
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            <?php else : ?>
                <?php echo $this->Html->link('<< Retour', '/demandes/suivis/'); ?>
                <div class="span2"> Modifiez votre conseil : </div> 
                <div id="bloc-editeur">
                    <textarea rows="6" cols="100" name="com" required="required" title="Le conseil doit faire entre 1 et 300 caractètres" maxlength="300"><?php echo str_replace("<br />", "", $objectif['conseil']); ?></textarea>
                    <div id="bloc2">
                        <input type="submit" value="Modifier" />
                    </div>
                </div>
            <?php endif; ?>
            </form>
        </div>
    </div>
</div>