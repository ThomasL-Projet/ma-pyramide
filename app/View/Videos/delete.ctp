<div id="presentation">
    <?php
    if (AuthComponent::user('role') == 'administrateur' AND $affichage) :
        echo $this->Form->create('Video');
        ?>
        <div id="retour"> <?php echo $this->Html->link('<< Retour', '/videos/index'); ?> </div>
        <div class="bloc-index">
            <p id="article"><?php echo $video['Video']['titre']; ?></p>
            <div id="bloc2">
                <input type="submit" value="Je confirme" />
            </div>
        </div>
    </form>

<?php else : ?>
    <?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
    <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
<?php endif; ?>
</div>