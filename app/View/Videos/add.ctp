<div id="presentation">
    <?php if (AuthComponent::user('role') == 'administrateur') : ?>
        <?php echo $this->Html->link('<< Retour', '/videos/index'); ?>
        <div class="bloc1">	
            <h1>Ajout une vidéo</h1>
            <?php echo $this->Form->create('Video'); ?>
            <?php echo '<br/><br/>' ?>
            <?php echo $this->Form->input('titre', array('label' => "Titre ", 'id' => 'titre')); ?>
            <?php echo '<br/><br/><br/><br/>' ?>
            <?php echo $this->Form->input('description', array('label' => "Description", 'type' => 'textarea', 'id' => 'description')); ?>
            <?php echo '<br/><br/>' ?>
            <?php echo $this->Form->input('url', array('label' => "Lien de la vidéo youtube : ", 'style' => 'width:200px', 'id' => 'description')); ?>
            <?php echo '<br/><br/>' ?>

            <br /><input type="submit" value="Ajouter" style="margin:0px;margin-left:300px" /><br />
            <?php echo $this->Html->link('<input type="button" name="retour" value="Annuler" style="margin:0px;margin-left:430px; margin-top:-30px" >', '/videos/', array('escape' => false)); ?>

        </div>
    <?php else : ?>
        <?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
        <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
    <?php endif; ?>
</div>