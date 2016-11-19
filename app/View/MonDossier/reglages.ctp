<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Mon Dossier : Réglages');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Réglage des données utilisateurs');
$this->end();
?>
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Mon Dossier', ['controller' => 'monDossier', 'action' => 'index', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Réglages', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">

    <div class="row">
        <div class="small-12 columns large-centered columns"><br/>
            <div class="title-area"> Mon Dossier : Réglages </div>  
            <br/><br/>
            <p class="text-center">Vous pouvez ajouter des données que vous avez relevé aujourd'hui et également activé ou désactivé le suivi dans vos données santé. 
                <?php echo $this->Html->link('Cliquer ici pour accèder à Mes données santé', ['controller' => 'monDossier',
                'action' => 'mesdonneessante',
                'full_base' => true,]
                ) ?>.
                
                </p>
            <br/>
        </div>
 
        <?php
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        echo $this->Form->create('MonDossier');
        echo "<h3> Données anthropométriques </h3><br/>";

        for ($i = 0; $i < count($typeDonnee); $i++) {
            // ajout de l'activation ou non pour le boutton ON/OFF
            $act = $paramact[$i]["paramactive"]["active"] == 1 ? "value='1' checked" : "";
           // echo "<h1> " . $i . " activé : ? : " . $act . "</h1>";
            if($typeDonnee[$i]["typedonneesmed"]["nom"] == "Tension artérielle") {
                    echo  "<h3> Paramètres vitaux </h3><br/><br/>";
                }
            // le champ pour entré la donnée médicale en fonction de l'ajout ou non à la date d'aujourd'hui
            echo "<div class='row'><div class='small-7 columns'>";
            if (in_array($typeDonnee[$i]["typedonneesmed"]["id"], $donneeDejaFait)) {
                echo $typeDonnee[$i]["typedonneesmed"]["nom"] . ' : <input type="text" name="' . $typeDonnee[$i]["typedonneesmed"]["id"] . '" value="Déjà renseigné aujourd\'hui" readonly>';
                echo "</div><div class='small-5 columns'>Activé dans mes données santé : ";
            } else {
                
                // on affiche si 
                echo $typeDonnee[$i]["typedonneesmed"]["nom"] . ' : <input min="0" max="250"  onkeypress="return event.charCode >= 48 && event.charCode <= 57" type="number" onfocus="this.type=\'number\';" name="' . $typeDonnee[$i]["typedonneesmed"]["id"] . '" placeholder="' . $typeDonnee[$i]["typedonneesmed"]["unite"] . '">';
                echo "</div><div class='small-5 columns'>Activé dans mes données santé : ";
            }
            // le boutton pour activé la donnée dans l'affichage ou non
            echo '<fieldset style="display:inline;vertical-align:middle;" class="switch" tabindex="' . $i . '">
                        <input class="btnonoff" name="' . $typeDonnee[$i]["typedonneesmed"]["id"] . '_act" id="' . $typeDonnee[$i]["typedonneesmed"]["id"] . '_act" type="checkbox"  ' . $act . '>
                        <label for="' . $typeDonnee[$i]["typedonneesmed"]["id"] . '_act"></label>
                        
                   </fieldset>';
            echo "</div></div><hr/>";
        }
        ?>

        <input type="submit" class="button" value="Envoyer" />
        </form>


    </div>



</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".btnonoff").change(function () {
            if (this.checked) {
                $(this).attr('value', '1');
            } else {
                $(this).removeAttr("value");
            }
        });
    });

</script>
