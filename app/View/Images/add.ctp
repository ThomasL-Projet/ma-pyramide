<div id="presentation">
    <?php if (AuthComponent::user('role') == 'administrateur') : ?>
        <?php echo $this->Html->link('<< Retour', '/images/index'); ?>
        <div class="bloc1">	
            <h1>Ajout d'une image</h1>
            <?php echo $this->Form->create('Image', array('type' => 'file')); ?>
            <?php echo '<br/><br/>' ?>
            <?php echo $this->Form->input('titre', array('label' => "Titre ", 'id' => 'titre')); ?>
            <?php echo '<br/><br/><br/><br/>' ?>
            <?php echo $this->Form->input('description', array('label' => "Description", 'type' => 'textarea', 'id' => 'description')); ?>
            <?php echo '<br/><br/>' ?>
            <?php echo $this->Form->input('url_file', array('label' => 'Votre image au format JPEG, JPG ou PNG', 'type' => 'file')); ?>
            <?php echo '<br/><br/>' ?>
            <?php echo $this->Form->end('Ajouter'); ?>
            <div id="retour1" style="margin-left:780px; position:absolute; margin-top: -30px ">
                <?php echo $this->Html->link('<input type="button" name="retour" value="Retour" >', '/images', array('escape' => false)); ?>
            </div>

        </div>
    <?php else : ?>
        <?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
        <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
    <?php endif; ?>
</div>