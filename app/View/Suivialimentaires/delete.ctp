<div class="row">
    <div class="row" data-equalizer>
        <?php
        echo $this->Form->create('Suivialimentaire');
        echo $this->Html->link('<< Retour', '/suivialimentaires/edit/');
        if ($affichage) :
            ?>
            <div class="large-12 columns panel" data-equalizer-watch>

                <h3> Confirmer la suppression de : </h3> 
                <div class="bloc-index">
                    <p id="user"><?php
                        if (isset($aliment['Aliment']))
                            echo $aliment['Aliment']['nomFR'];
                        else
                            echo $aliment['Alimhorsclassification']['nom'];
                        ?>  </p>
                    <div id="bloc2">
                        <input class="button" type="submit" value="Je confirme" />
                    </div>
                </div>
                </form>

            <?php endif; ?>

        </div>
    </div>
</div>