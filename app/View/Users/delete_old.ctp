<div id="presentation">
    <?php echo $this->Form->create('User'); ?>
    <div id="retour"> <?php echo $this->Html->link('<< Retour', '/users/index'); ?> </div>
    <div class="bloc-index" style="margin-top:10px">
        <p id="user"><?php echo $user['User']['username']; ?> (<?php echo $user['User']['role']; ?>) </p>
        <div id="bloc2">
            <input type="submit" value="Je confirme" onClick="return confirmation();"/>
        </div>
    </div>
</form>
</div>
<script type="text/javascript">
    function confirmation() {
        return(confirm("Êtes vous sûrs de vouloir supprimer votre compte ? (Cette action est irréversible)"));
    }
</script>