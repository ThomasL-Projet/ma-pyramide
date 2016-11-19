<div id="presentation">
    <?php echo $this->Html->link('<< Retour', '/pages/home'); ?>
    <?php if (isset($users) && count($users) > 1):
        foreach ($users as $user) :
            ?>
            <div class="bloc-index">
                <p id="user"><?php echo $user['User']['username']; ?> : <?php echo $user['User']['role']; ?> </p>

                <div class="btns-index">
                    <!-- Bouton modifications -->
        <?php echo $this->Html->link('<div class="btn-modifier">Modifier</div>', '/users/edit/' . $user['User']['id'], array('escape' => false)); ?>

                    <!-- Bouton suppression -->
        <?php echo $this->Html->link('<div class="btn-supprimer">Supprimer</div>', '/users/delete/' . $user['User']['id'], array('escape' => false)); ?>
                </div>
            </div>
        <?php endforeach; ?>

    <?php elseif (isset($users)) :
        foreach ($users as $user) :
            ?>
            <div class="span2"> Votre compte : </div> 
            <div class="bloc-index">
                <p id="user">Compte : <?php echo $user['User']['username']; ?> &nbsp&nbsp&nbsp&nbsp (statut : <?php echo $user['User']['role']; ?>)</p>

                <div class="btns-index">
                    <!-- Bouton modifications -->
                    <?php echo $this->Html->link('<div class="btn-modifier">Modifier</div>', '/users/edit/' . $user['User']['id'], array('escape' => false)); ?>

                    <!-- Bouton suppression -->
            <?php echo $this->Html->link('<div class="btn-supprimer">Supprimer</div>', '/users/delete/' . $user['User']['id'], array('escape' => false)); ?>
                </div>
            </div>
    <?php endforeach; ?>
        <?php if (isset($fils)) : ?>
            <br><br><br>
            <div class="span2"> Vos enfants : </div> 
        <?php foreach ($fils as $f) : ?>
                <div class="bloc-index">
                    <p id="user">Compte enfant : <?php echo $f['username']; ?> </p>

                    <div class="btns-index">

                        <!-- Bouton information -->
                <?php echo $this->Html->link('<div class="btn-infos-solo">Informations</div>', '/users/information/' . $f['id'], array('escape' => false)); ?>
                    </div>
                </div>
            <?php endforeach; ?>
    <?php endif; ?>
<?php endif; ?>
</div>
