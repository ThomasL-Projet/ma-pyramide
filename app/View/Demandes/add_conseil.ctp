<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Ajouter un conseil à une demande');
?>
﻿<?php echo $this->Form->create('Cinqobjectif');
?>
<div class="row">
    <div class="small-12 columns">
            <?php echo $this->Html->link('<< Retour', '/demandes/suivis/'); ?>
            <div class="span2"> Saisissez votre conseil : </div> 
            <div id="bloc-editeur">
                <textarea rows="6" cols="100" name="com" required="required" title="Le conseil doit faire entre 1 et 300 caractètres" maxlength="300"></textarea>
                <div id="bloc2">
                    <input type="submit" value="Ajouter" />
                </div>
            </div>
        </form>
    </div>
</div>