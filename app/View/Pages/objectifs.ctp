<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Objectifs');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿<?php
App::import('Vendor', 'Fonction_PDO');
if (!($username = AuthComponent::user('username'))) {
    ?>
    <script type="text/javascript">
        alert("Il faut etre connecte pour utiliser cette fontionnalité.");
    </script>
    <?php
} else {  // On recupere les objectifs definis
    if (isset($_POST["monAction"])) {
        switch ($_POST["monAction"]) {
            case 'postAddObj' :
                $colonne = Array("nomUtilisateur", "intitule");
                $valeur = Array($username, ucfirst($_POST["intitule"]));
                ajout_bd("objectifs_2014", $colonne, $valeur);
                break;

            case 'postHisto' :
                $colonne = Array("nomUtilisateur", "intitule", "date_validation");
                $valeur = Array($username, $_POST["histo"], date("Y/m/d"));
                ajout_bd("historique_objectifs_2014", $colonne, $valeur);
                break;

            case 'postDelObj' :
                $valeur = $_POST["objectif"];
                suppr_bd("objectifs_2014", Array("intitule = '" . $valeur . "'", "nomUtilisateur = '" . $username . "'"));
                break;
        }
    } else {
        ?>
        <div class="row">
            <div class="small-12 columns">
                <h1> Mes 5 Objectifs </h1> 
                <p> Cette page est consacré à vos objectifs presonnels. Ce sont des objectifs que vous vous fixez et que vous validez lorsque
                    vous considérez qu'ils sont accomplis. </p>
            </div>


            <form>
                <div class="row">
                    <div class="large-12 columns">
                        <label>Rédigez vos objectifs : 
                            <input type="Text" value ="" name = "Ajouter" style="width: 250px;">
                            <button type="button" class="button" name="ajouter" onclick="objectifs.onsubmit()">Ajouter</button>      
                        </label>
                    </div>
                </div>           
            </form>
        </div>
        <div class ="objectifs" >
            <table cellspacing="15px" cellpadding= "10px">
                <tr class="bordure" id="val1" style="display:none">
                    <td id="obj1"><strong>v</strong></td>
                    <td><input type=button name="valid" onclick="historique('obj1');Cache('val1')" value="Valider"></td>
                    <td><input type=button name="suppr" onclick="Cache('val1');del('obj1')" value="Supprimer"></td>
                </tr>
                <tr class="bordure" id="val2" style="display:none">
                    <td id="obj2"><strong>v</strong></td>
                    <td><input type=button name="valid" onclick="historique('obj2');Cache('val2')" value="Valider"></td>
                    <td><input type=button name="suppr" onclick="Cache('val2');del('obj2')" value="Supprimer"></td>
                </tr>
                <tr class="bordure" id="val3" style="display:none">
                    <td id="obj3"><strong>v</strong></td>
                    <td><input type=button name="valid" onclick="historique('obj3');Cache('val3')" value="Valider"></td>
                    <td><input type=button name="suppr" onclick="Cache('val3');del('obj3')" value="Supprimer"></td>
                </tr>
                <tr class="bordure" id="val4" style="display:none">
                    <td id="obj4"><strong>v</strong></td>
                    <td><input type=button name="valid" onclick="historique('obj4');Cache('val4')" value="Valider"></td>
                    <td><input type=button name="suppr" onclick="Cache('val4');del('obj4')" value="Supprimer"></td>
                </tr>
                <tr class="bordure" id="val5" style="display:none">
                    <td id="obj5"><strong>v</strong></td>
                    <td><input type=button name="valid" onclick="historique('obj5');Cache('val5')" value="Valider"></td>
                    <td><input type=button name="suppr" onclick="Cache('val5');del('obj5')" value="Supprimer"></td>
                </tr>
            </table>
        </div>

    <button class="button" type=button onclick="goBack()" style="position : absolute; margin-top : 800px;" name="retour">Retour</button>



        </div>
        </div>

        <?php
        // suite du else ligne 8
        echo '<script>
			
		i = 0;

		function historique(val) {
			$.ajax({
				type: "POST",
				url: "objectifs",
				data: {monAction: "postHisto", histo: document.getElementById(val).innerHTML}
			});
			alert("Objectif validé");
			del(val);
		}
		function aff(idDiv) {


			for(i = 1;i < 6;i++) {
				var id = idDiv + i;
				var div = document.getElementById(id);
				if (div.style.display == "none"){
					div.style.display = "";
				return;
				}
			}
		}

		function Cache(idDiv) {
			var div = document.getElementById(idDiv);
			if (div.style.display == "")
			div.style.display = "none";
		}

		function recupObj(val) {
			if (val == ""){
				alert("Un champ n\'est pas rempli");
				return false;
			} else {
				aff("val")
				obj = "obj" + i--;
				document.getElementById(obj).innerHTML=val;
			}
		}
		function del(idDiv) {
			$.ajax({
				type: "POST",
				url: "objectifs",
				data: {monAction: "postDelObj", objectif: document.getElementById(idDiv).innerHTML}
			});
		}

		
		function insert(val) {
			if (val == "") {
				return false;
			} else {
				$.ajax({
					type: "POST",
					url: "objectifs",
					data: {monAction: "postAddObj", intitule: val}
				});
			}
		}

		function goBack(){
		  window.history.back()
		}
		</script>
	';
        $requeteObjEnCour = "SELECT intitule
		 FROM objectifs_2014
		 WHERE nomUtilisateur = '" . $username . "'";

        $tab = requete_bd($requeteObjEnCour);
        // Pour passer d'un tableau en php à une variable en javasript,
        // On créé une variable telle qu'elle sera dans le javascript
        // où on insére les données du tableau en php
        // print_r($tab[0]); 
        $compte = count($tab);
        if ($compte != 0) {
            for ($i = $compte - 1; $i >= 0; $i--) {
                echo "<script> recupObj('" . $tab[$i]['intitule'] . "'); </script>";
            }
        }
    } // ferme le else ligne 22
}  // on ferme le else ligne 8 ?>