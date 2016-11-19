<div class="row">
    <div class="small-12 columns">

        <?php echo $this->Form->create('User'); ?>

        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->create('User'); ?>
        <?php if (AuthComponent::user('id') == NULL): ?>
            <!-- Cette page est accessible depuis le bouton "me connecter" situé en haut à droite de chaque page -->
            <h1> Connexion </h1> 
            <div class="bloc1">
                <label for="UserUsername"> Identifiant</label>
                <div class="small-4">
                    <input type="text" name="data[User][username]" id="UserUsername" required="required"/> <br><br>
                </div>
                <div class="small-4">
                    <label for="UserPassword"> Mot de passe</label>
                    <input type="password" name="data[User][password]" id="UserPassword" required="required"/> <br><br>
                </div>
                <input class="button" type="submit" value="Me connecter" />
            </div>
            </form>
        <?php else: ?>
            <div id="presentation">
                <?php echo $this->Html->link('<< Retour', 'javascript:history.back()'); ?>
                <?php echo '<h1 align="center">Vous n\'avez pas la permission d\'acceder &agrave; cette page</h1>'; ?>
            </div>
        <?php endif; ?>

        <!-- Div de connexion par défaut -->
        <!-- <div class="users form">
                <fieldset>
                        <legend><?php echo __('Please enter your username and password'); ?></legend>
        <?php
        echo $this->Form->input('username');
        echo $this->Form->input('password');
        ?>
                </fieldset>
        <?php echo $this->Form->end(__('Login')); ?>
        </div> -->
    </div>
</div>