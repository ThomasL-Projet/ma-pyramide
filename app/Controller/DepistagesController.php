<?php

App::uses('AppController', 'Controller');

/**
 * 
 */
class DepistagesController extends AppController {

    // Pour utiliser des modèles spécifiques
    public $uses = array('Aliment', 'Donneescompilee', 'Suivialimentaire', 'User', 'Alimentsdetaille', 'Alimentfavori', 'Constante', 'Alimhorsclassification', 'Suiviphysique');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->set('page_cours', 'rouge');
        $this->Auth->allow();
    }

    public function index() {
       
    }
    
    public function adolescent() {
        
        
        if($this->request->is("post")) {
            
            $score = 0;
            // calcul du score 
            for($i = 1 ; $i <= 20 ; $i++) {
                $a = 'q'.$i;
                
                $score += explode("-", $_POST[$a])[1];
                
                
            }
            echo "<h1>".$score
                    ."</h1>"
                   ;
            $rsl;
            // affection du risque en fonction du score
           if($score > 0 && $score <= 6) {
               $rsl = "Risque modéré";
           } else if($score > 7 && $score <= 13) {
               $rsl = "Risque élevé";
           } else if($score >= 14 && $score <= 20) {
               $rsl = "Risque très élevé";
           }  else if($score >= 21 && $score <= 50) {
               $rsl = "Risque faible";
           } 
           $this->set("resultatScore", $rsl);
            
            
            $this->set("resultat", "1");
            // variable pour le set afin d'envoyer les réponses à la vue
            $i = 0;
            // en fonction de chaque résultat on ajoute les données associées à la réponse
            switch(explode("-",$_POST['q1'])[0]) {
                case 1;
                    $info = "Jamais : C’est une excellente chose. Il faut savoir que la

d’antibiotiques par la maman peut avoir une profonde répercussion sur son 

microbiote intestinal pouvant entrainer des altérations importantes sur ce 

dernier lesquelles peuvent  se répercuter sur le microbiote du fœtus qui est 

en train de mettre en place son système de défense adaptatif.";
                    break;
                case 2:
                    $info = "Une fois : Il faut savoir que la prise d’antibiotiques par la maman

avoir une profonde répercussion sur son propre microbiote intestinal 

pouvant entrainer des altérations importantes sur ce dernier lesquelles 

peuvent  se répercuter sur le microbiote du fœtus qui est en train de mettre 

en place son système de défense adaptatif.  C’est la porte ouverte à une 

série de pathologies liées au dérèglement de la mise en place du système 

immunitaire : asthme, allergies";
                    break;
                case 3:
                    $info = "Plus d'une fois : Il faut savoir que la prise d’antibiotiques par la

peut avoir une profonde répercussion sur son propre microbiote intestinal 

pouvant entrainer des altérations importantes sur ce dernier, lesquelles 

peuvent  se répercuter sur le microbiote du fœtus qui est en train de mettre 

en place le système de défense adaptatif.  C’est la porte ouverte à une série 

de pathologies liées au dérèglement de la mise en place du système 

immunitaire : asthme, allergies ….";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>La maman a pris des antibiotiques pendant sa grossesse</b><br/>" . $info);
            $i++;
            
            switch(explode("-",$_POST['q2'])[0]) {
                case 1;
                    $info = "Oui : La proximité des animaux domestiques apporte au fœtus son lot

bactéries amies de telle sorte que les enfants des mamans en contact avec 

ces animaux ont beaucoup moins de risques de développer des atopies 

(asthme, allergies, psoriasis…)";
                    break;
                case 2:
                    $info = "Non : La proximité des animaux domestiques apporte au fœtus son lot

bactéries amies de telle sorte que les enfants des mamans en contact avec 

ces animaux ont beaucoup moins de risques de développer des atopies 

(asthme, allergies, psoriasis…)";
                    break;
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Pendant la grossesse ; la maman était en contact avec des animaux</B><br/>".$info);
            $i++;
            
            switch(explode("-",$_POST['q3'])[0]) {
                case 1;
                    $info = "A terme : l’importance de naitre à terme vient du fait que toutes

conditions sont réunies pour un bon départ dans la vie. Des bactéries amies 

du tractus digestif de la maman ont déjà colonisé le tube digestif du fœtus et 

mis en route l’élaboration du système immunitaire de l’enfant. Le 

développement du microbiote intestinal va dépendre dans l’immédiat du 

mode de délivrance et du type d’alimentation du bébé.";
                    break;
                case 2:
                    $info = "Prématuré : La prématurité (naissance avant la 37ème semaine

d’aménorrhée) peut grandement affecter et amputer pour les années à 

venir la santé du bébé. Nous ne retiendrons que trois éléments : 

i. Le premier est lié au fait que le microbiote intestinal du fœtus n’a pas eu 

un temps suffisant pour induire un début de développement  du système 

immunitaire adaptatif.

ii. Le deuxième est lié au fait que souvent ces bébés naissent par 

césarienne ce qui les prive d’un ensemencement vaginal (bactéries 

amies) de leur tube digestif avec pour conséquence un développement 

du microbiote intestinal et du système immunitaire dysharmonieux.

iii. Le troisième élément et non le moindre est lié au fait que ces bébés 

reçoivent souvent une antibiothérapie qui achève de perturber un 

microbiote intestinal déjà atteint et par voie de conséquence leur 

fonction immunitaire dont le microbiote est l’un des artisans principaux.

iv. Pour ces raisons, ces bébés sont susceptibles de développer une 

pathologie grave qu’est l’entérocolite nécrosante : résultat non 

seulement d’une sélection de microbes résistants mais aussi d’une paroi 

intestinale insuffisamment développée (trophicité, immunité et axe 

nerveux entéro-cérébral…)";
                    break;
                case 3:
                    $info = "En dépassement de terme : on parle de dépassement de terme

les grossesses dépassent les 42 semaines d’aménorrhée. 

i. Un des risques, parmi d’autres, pour la santé future du bébé est la 

délivrance par césarienne et souvent un surpoids qui vont perturber un 

développement harmonieux de son microbiote intestinal entrainant des 

conséquences sur le développement de son tube digestif, de son 

immunité adaptative et de son axe nerveux : système nerveux entérique";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé est né</B><br/>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q4'])[0]) {
                case 1;
                    $info = "Par voie basse    I : Pour la santé future du bébé cette étape est de

importance. Lors de sa progression dans les voies maternelles, le bébé va 

ingurgiter une certaine quantité de flore vaginale et fécale de la mère. Cet 

ensemencement maternel vient rejoindre le pré-ensemencement maternel 

du fœtus (attention toutes ces bactéries sont des bactéries amies) et va 

participer activement au développement du microbiote intestinal du bébé.";
                    break;
                case 2:
                    $info = "Par césarienne    I : La naissance par césarienne prive le bébé de

ensemencement vaginal maternel bénéfique,  le bébé étant alors exposé aux 

bactéries de l’environnement qui sont toutes loin d’être amies. 

i. Ce microbiote intestinal de l’enfant se développant de manière 

disharmonieuse se répercute sur le développement du tube digestif du 

bébé et notamment sur la fonction immunitaire du bébé et de l’enfant 

plus tard.

ii. Dès lors il n’est pas étonnant que les enfants nés par césarienne 

développent un ensemble de pathologies issues d’une mauvaise 

maturation du système immunitaire dont le microbiote intestinal en est 

l’un des principaux artisans : asthme, allergies pendant la jeunesse et 

obésité, diabète, pathologies inflammatoires digestive, pathologies 

nerveuses…. plus tard.

iii. Aujourd’hui, les médecins de ce site suggèrent, aux mamans prévues 

pour une césarienne et aux sages-femmes d’introduire avant la 

césarienne de la gaze dans le vagin maternel afin d’en récupérer les 

sécrétions qui devront être sucée ensuite par le nouveau-né : une 

manière de donner au bébé les bactéries amies qui sans cela lui feraient 

défaut.";
                    break;
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé est né</B> <br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q5'])[0]) {
                case 1;
                    $info = "Avec le lait maternel     I : Pendant longtemps, le lait maternel a

considéré comme stérile. Les études récentes viennent de montrer que cette 

idée était fausse et que ce lait contient une grande quantité de bactéries 

parmi lesquelles les bactéries lactiques et les bifidobactéries, une grande 

majorité provenant du tube digestif maternel par migration interne.

i. Donc un bébé consommant environ 1 litre de lait de la mère avale entre 

quelques centaines de milliers et plus de 10 millions de bactéries.

ii. Ces bactéries amies vont se développer dans le tube digestif du bébé 

utilisant entre autre les oligosaccharides du lait maternel et participer 

notamment au développement du système immunitaire.

iii. Les études cliniques avaient depuis longtemps suggéré que les 

enfants allaités au sein présentaient un risque moindre de développer 

un certain nombre de troubles ou maladies : diarrhées, maladies 

respiratoires (asthme…) et des pathologies métaboliques (allergies…)";
                    break;
                case 2:
                    $info = "Avec du lait maternisé    I : Même si le lait maternisé, est

élaboré, il ne contient pas ces bactéries maternelles qui font toute la 

différence. Le tube digestif du bébé ne reçoit alors que les bactéries de 

l’environnement qui sont loin d’assurer un développement optimal du 

microbiote du bébé.

i. La répercussion est immédiate sur le développement du tube digestif du 

bébé sur son développement immunitaire et le développement de l’axe 

nerveux entéro-cérébral.

ii. Les études cliniques avaient depuis longtemps démontré que les 

enfants allaités au lait maternisé présentaient un risque plus élevé de 

développer un certain nombre de troubles ou maladies : diarrhées, 

maladies respiratoires (asthme…) et des pathologies métaboliques 

(allergies…)…troubles du développement de l’axe nerveux entéro-

cérébral";
                    break;
                case 3:
                    $info = "Avec les deux       I : Même si le lait maternisé, est extrêmement élaboré, il

contient pas ces bactéries maternelles qui font toute la différence. Le tube 

digestif du bébé ne reçoit alors que les bactéries de l’environnement qui sont 

loin d’assurer un développement optimal du microbiote du bébé.

i. La répercussion est immédiate sur le développement du tube digestif du 

bébé sur son développement immunitaire et le développement de l’axe 

nerveux entéro-cérébral.

ii. Les études cliniques avaient depuis longtemps démontré que les 

enfants allaités au lait maternisé présentaient un risque plus élevé de 

développer un certain nombre de troubles ou maladies : diarrhées, 

maladies respiratoires (asthme…) et des pathologies métaboliques 

(allergies…)…troubles du développement de l’axe nerveux entéro-

cérébral.";
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé a été allaité</b> <br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q6'])[0]) {
                case 1;
                    $info = "Pendant 1 mois   I : Plus l’allaitement maternel est long, plus important

l’ensemencement du microbiote du bébé et meilleure est sa diversification";
                    break;
                case 2:
                    $info = "Pendant  deux mois I : Plus l’allaitement maternel est long, plus important

est l’ensemencement du microbiote du bébé et meilleure est sa 

diversification";
                    break;
                case 3:
                    $info = "Pendant 3 mois   I : cette durée de l’allaitement semble être la

minimale pour un transfert microbien optimal. Elle peut correspondre avec 

le début du sevrage et l’introduction d’une nourriture diversifiée préparée à 

la maison. De cette manière le microbiote intestinal va continuer à se 

développer et se diversifier pour le plus grand bien de l’enfant. Ne l’oublions 

pas c’est grâce au microbiote intestinal que se développe la surface 

d’échange du tube digestif et sa cohésion, la maturation du système 

immunitaire adaptatif et la maturation de l’axe nerveux entérique-cérébral.";
                    break;
                case 4:
                    $info = "Pendant 6 mois  I : si vous en avez la possibilité c’est encore mieux.

durée de l’allaitement permet au microbiote de l’enfant de se mettre en 

place de se diversifier et de se développer. 

i. Elle peut correspondre avec le début du sevrage et l’introduction d’une 

nourriture diversifiée préparée à la maison. De cette manière le 

microbiote intestinal va continuer à se développer et se diversifier pour 

le plus grand bien de l’enfant. 

ii. Ne l’oublions pas c’est grâce au microbiote intestinal que se 

développe la surface d’échange du tube digestif et sa cohésion, la 

maturation du système immunitaire adaptatif et la maturation de l’axe 

nerveux entérique-cérébral.";
                    break;
                case 5:
                    $info = "Pendant un an  I : si vous en avez la possibilité c’est encore mieux. Cette

durée de l’allaitement permet au microbiote de l’enfant de se mettre en 

place de se diversifier et de se développer. 

i.  Elle peut correspondre avec le début du sevrage et l’introduction d’une 

nourriture diversifiée préparée à la maison. De cette manière le 

microbiote intestinal va continuer à se développer et se diversifier pour 

le plus grand bien de l’enfant.

ii.  Ne l’oublions pas c’est grâce au microbiote intestinal que se 

développe la surface d’échange du tube digestif et sa cohésion, la 

maturation du système immunitaire adaptatif et la maturation de l’axe 

nerveux entérique-cérébral.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>Le bébé a été allaité</b> " . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q7'])[0]) {
                case 1;
                    $info = "Le bébé a consommé de la nourriture préparée à la maison   I : outre le

que vous savez non seulement ce que mange votre enfant, une nourriture 

préparée à la maison peut être diversifié, adaptée à votre enfant et à son 

microbiote intestinal. 

i. N’oubliez pas que le bon développement de votre enfant est 

indissociable de celui de son microbiote intestinal. Ce microbiote 

intestinal a besoin d’une nourriture appropriée comme votre bébé. 

Consultez le bouton « Mes aliments » et vous verrez le type et la 

quantité d’aliments dont votre bébé et son microbiote ont besoin en 

fonction de leur âge (> 2 ans).";
                    break;
                case 2:
                    $info = "Le bébé a consommé plus tôt des petits pots du commerce    I : que vous

vouliez ou non, vous ne contrôlez que les étiquettes des emballages de la 

nourriture aseptisée de votre enfant. Cette nourriture n’apporte aucun 

ensemencement microbien intestinal de votre enfant : ensemencement dont 

il a besoin quotidiennement. Consultez le bouton « Mes aliments » et vous 

verrez le type et la quantité d’aliments dont votre bébé et son microbiote 

intestinal ont besoin en fonction de leur âge(> 2 ans).";
                    break;
                case 3:
                    $info = "Le bébé a consommé  les deux  I : C’est mieux que si le bébé

consommait que des petits pots mais bon, vous pouvez faire un petit effort 

supplémentaire et ne lui donnez que de la nourriture saine que vous 

contrôlez pleinement.  Consultez le bouton « Mes aliments » et vous verrez 

le type et la quantité d’aliments dont votre bébé et son microbiote intestinal 

ont besoin en fonction de leur âge (2 ans).";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Pendant le sevrage </b><br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q8'])[0]) {
                case 1;
                    $info = "Jamais  I : C’est bien. Il faut savoir que les antibiotiques dévastent en

temps le microbiote intestinal mais encore plus à ce stade de son 

développement. Les altérations sont parfois transitoires mais aussi peuvent 

être définitives et les conséquences sur la santé du bébé sont incalculables. 

i. N’oublions pas que la santé et de la diversité du microbiote intestinal à 

cet âge-là va conditionner sa santé pendant le reste de sa vie.";
                    break;
                case 2:
                    $info = "Quelques fois    I : Il faut savoir que les antibiotiques dévastent en

temps le microbiote intestinal mais encore plus à ce stade de son 

développement. Les altérations sont parfois transitoires mais aussi peuvent 

être définitives et les conséquences sur la santé du bébé sont incalculables. 

i. N’oublions pas que la santé et de la diversité du microbiote intestinal à 

cet âge-là va conditionner sa santé pendant le reste de sa vie.";
                    break;
                case 3:
                    $info = "Souvent    I : Il faut savoir que les antibiotiques dévastent en tout temps

microbiote intestinal mais encore plus à ce stade de son développement. Les 

altérations sont parfois transitoires mais aussi peuvent être définitives et les 

conséquences sur la santé du bébé sont incalculables. 

i. N’oublions pas que la santé et la diversité du microbiote intestinal à cet 

âge-là vont conditionner la santé de l’adolescent et adulte en devenir.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Jusqu’ à  l’âge de trois ans, le bébé a pris des antibiotiques</b><br/>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q9'])[0]) {
                case 1;
                    $info = "Plus de 5 fois par jour      I : C’est bien de manger des produits céréaliers

là encore le mieux peut être l’ennemi du bien. Attention aux portions que 

vous lui donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments, Produits 

céréaliers";
                    break;
                case 2:
                    $info = "4 à 5 fois par jour     I : Attention aux portions que vous lui donnez

doivent se conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Produits céréaliers »)";
                    break;
                case 3:
                    $info = "2 à 3 fois par jour   I : Attention aux portions que vous lui donnez elles

doivent se conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Produits céréaliers »)";
                    break;
                case 4:
                    $info = "Moins de 2 fois par jour    I : Attention aux portions que vous lui donnez elles

doivent se conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site";
                    break;
                /*case 4:
                    $info = "";
                    break;*/
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange régulièrement des produits céréaliers</B><br>" .$info);
            $i++;
            
            
            switch(explode("-",$_POST['q10'])[0]) {
                case 1;
                    $info = "Plus de 3 fois par jour     I : C’est bien de manger des produits laitiers mais

encore le mieux peut être l’ennemi du bien. Attention aux portions que vous 

lui donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site";
                    break;
                case 2:
                    $info = "3 fois par jour I : Attention aux portions que vous lui donnez elles doivent

conformer, en fonction de l’âge, aux recommandations quotidiennes de ce 

site";
                    break;
                case 3:
                    $info = "I : Attention aux portions que vous lui donnez elles doivent

conformer, en fonction de l’âge, aux recommandations quotidiennes de ce 

site";
                    break;
                case 4:
                    $info ="Une fois par jour ou moins    I : C’est insuffisant, pensez que les

laitiers sont les sources de calcium qui intervient entre autres dans la 

construction osseuse.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange régulièrement des produits laitiers</B><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q11'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour  I : Les fruits et légumes sont essentiels pour

qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments, Fruits» sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 2:
                    $info = "3 à 4 fois par jour   I : Les fruits et légumes sont essentiels pour les

nutritionnelles décrites dans l’onglet « Mes Aliments, Fruits » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités 

décrites dans « Mes Aliments, Fruits » sont indispensables à la 

bonne santé du microbiote intestinal laquelle conditionne la 

bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 3:
                    $info = "2 fois par jour    I : C’est insuffisant. Les fruits et légumes sont essentiels

les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

iii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 4 :
                    $info = "1 fois par jour       I : C’est insuffisant. Les fruits et légumes sont

pour les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités 

décrites dans « Mes Aliments » sont indispensables à la bonne 

santé du microbiote intestinal laquelle conditionne la bonne 

santé de l’enfant. Attention aux portions que vous lui donnez 

elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments »)";
                    break;
                case 5 : 
                    $info = "Jamais      I : C’est insuffisant. Les fruits et légumes sont essentiels pour les

qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais nous 

ttirerons l’attention sur le fait que le microbiote intestinal trouve aussi dans 

les fruits et légumes une grande partie de son alimentation que sont les 

fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités 

décrites dans « Mes Aliments » sont indispensables à la bonne 

santé du microbiote intestinal laquelle conditionne la bonne 

santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles 

doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes 

Aliments »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange régulièrement des fruits </b> <br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q12'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour  I : Les légumes sont essentiels pour les

nutritionnelles décrites dans l’onglet « Mes Aliments, Légumes » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments, Légumes » sont indispensables à la bonne santé 

du microbiote intestinal laquelle conditionne la bonne santé de l’enfant. 

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Légumes»)";
                    break;
                case 2:
                    $info = "2 fois par jour    I : C’est insuffisant. Les fruits et légumes sont essentiels

les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Légumes»";
                    break;
                case 3:
                    $info = "1 fois par jour       I : C’est insuffisant. Les fruits et légumes sont

pour les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant. 

Attention aux portions que vous lui donnez elles doivent se conformer, 

en fonction de l’âge, aux recommandations quotidiennes de ce site (voir 

« Mes Aliments »)";
                    break;
                case 4: 
                    $info = "Jamais      I : C’est insuffisant. Les fruits et légumes sont essentiels pour les

qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange régulièrement des légumes</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q13'])[0]) {
                case 1;
                    $info = "Plus de 2 fois par jour    I :   C’est bien de manger de la viande mais là

le mieux peut être l’ennemi du bien. Attention aux portions que vous lui 

donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 2:
                    $info = "2 fois par jour    I :  C’est bien de manger des produits protéinés mais là

encore le mieux peut être l’ennemi du bien. Attention aux portions que vous 

lui donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 3:
                    $info = "Une fois par jour     I : Attention aux portions que vous lui donnez

doivent se conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 4 :
                    $info = "Quelque fois par semaine    I : C’est insuffisant pour assurer le

développement de votre enfant. Les protéines sont indispensables à votre 

enfant mais sachez qu’on les rencontre dans la viande mais aussi dans 

certains légumes ";
                    break;
                case 5 :
                    $info = "Jamais     I : C’est insuffisant pour assurer le bon développement de

enfant. Les protéines sont indispensables à votre enfant mais sachez qu’on 

les rencontre dans la viande mais aussi dans certains légumes (voir « Mes 

Aliments, Protéines »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange régulièrement de la viande, du poisson, de la volaille des œufs</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q14'])[0]) {
                case 1;
                    $info = "3 fois ou plus par semaine     I : Aller au restaurant quelques fois par mois

la rigueur, pour des occasions particulières. Ce faisant vous ne donnez pas à 

votre ado la nourriture dont lui et son microbiote intestinal ont besoin.

i. Les aliments servis dans les fast-foods sont souvent bourrés de graisse, 

de calories ; de sel et ne contiennent pas des nutriments tels que les 

fibres, les vitamines ou les minéraux

ii. Vous ne contrôlez,  ce faisant, ni la qualité ni la quantité de 

nutriments dont votre ado a besoin pour son développement.";
                    break;
                case 2:
                    $info = "2 fois par semaine  I : Aller au restaurant quelques fois par mois à la rigueur,

pour des occasions particulières, Ce faisant vous ne donnez pas à votre 

enfant la nourriture dont lui et son microbiote intestinal ont besoin.

i. Les aliments servis dans les fast foods sont souvent bourrés de graisse, 

de calories ; de sel et ne contiennent pas des nutriments tels que les 

fibres, les vitamines ou les minéraux

ii. Vous ne contrôlez ni la qualité ni la quantité de nutriments dont votre 

enfant a besoin pour son développement.";
                    break;
                case 3:
                    $info = "1 fois par semaine ou moins   I : doit rester la règle si vous voulez offrir

votre enfant toutes les chances d’un bon développement.";
                    break;
                case 4 :
                    $info = "Jamais.   I : C’est bien. Le microbiote intestinal vous remercie";
                break;
                    default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado mange au fast - food</b><br>" .$info);
            $i++;
            
            
            switch(explode("-",$_POST['q15'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 2:
                    $info = "3 à 4 fois par jour  jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 3:
                    $info = "2 fois par jour  jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences :

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim. 

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 4:
                    $info = "Une fois par jour ou moins  jour    I : Ce genre de boissons contient

du sucre ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion 

pondérale et calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences :

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 5: 
                    $info = "Jamais  I : le plus beau cadeau que vous pouvez faire à votre ado en";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado boit régulièrement des jus ou des boissons aromatisés</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q16'])[0]) {
                case 1;
                    $info = "La plus part du temps  I : Ce n’est pas tout le monde qui peut manger

accord avec les recommandations de ce site en matière d’alimentation. Il y a 

aussi de la pauvreté dans des familles françaises qui ont des enfants qui plus 

qu’à leur tour disent qu’ils ont faim. C’est un drame familial que de ne 

pouvoir offrir à ses enfants la diversité de la nourriture dont ils ont besoin. 

Bien souvent ces parents vont se tourner vers de la nourriture qui « remplit 

le ventre » mais qui est loin d’apporter les nutriments nécessaires au bon 

développement de l’enfant. Voici quelques conseils qui vous permettront 

d’acheter de la nourriture diversifiée :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-preparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères, et le résultat 

est sensiblement le même.

v. Achetez des produits en promotion";
                    break;
                case 2:
                    $info = "Quelques fois  I : Ce n’est pas tout le monde qui peut manger en accord

les recommandations de ce site en matière d’alimentation. Il y a aussi de la 

pauvreté dans des familles françaises qui ont des enfants qui plus qu’à leur 

tour disent qu’ils ont faim. C’est un drame familial que de ne pouvoir offrir à 

ses enfants la diversité de la nourriture dont ils ont besoin. Bien souvent ces 

parents vont se tourner vers de la nourriture qui « remplit le ventre » mais 

qui est loin d’apporter les nutriments nécessaires au bon développement de 

l’enfant. Voici quelques conseils :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-preparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères.

v. Achetez des produits en promotion";
                    break;
                case 3:
                    $info = "Rarement  I : Ce n’est pas tout le monde qui peut manger en accord avec

recommandations de ce site en matière d’alimentation. Il y a aussi de la 

pauvreté dans des familles françaises qui ont des enfants qui plus qu’à leur 

tour disent qu’ils ont faim. C’est un drame familial que de ne pouvoir offrir à 

ses enfants la diversité de la nourriture dont ils ont besoin. Bien souvent ces 

parents vont se tourner vers de la nourriture qui « remplit le ventre » mais 

qui est loin d’apporter les nutriments nécessaires au bon développement de 

l’enfant. Voici quelques conseils :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-préparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères.

v. Achetez des produits en promotion";
                    break;
                case 4 :
                    $info = "Jamais  I : pensez à diversifier l’alimentation de votre ado, c’est pour

bien et celui de son microbiote intestinal.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>J’ai de la difficulté à acheter la nourriture qui lui conviendrait</b><br>". $info);
            $i++;
            
            
            switch(explode("-",$_POST['q17'])[0]) {
                case 1;
                    $info = "Souvent    I : A cet âge un certain nombre d’automatismes doivent

acquis incluant la mastication et la déglutition. La déglutition est un 

phénomène réflexe. Par contre une mastication lente et répétée s’apprend 

et se garde toute la vie. Prendre son temps pour bien mâcher les aliments 

est la première étape de la digestion en réduisant les aliments en petits 

morceaux qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit. Apprendre à manger 

correctement constitue une étape importante et vous devez souvent lui 

rappeler de prendre du temps pour bien mâcher ses aliments, c’est 

important, pour régler en plus sa notion d’appétit et de satiété. C’est le 

genre de remarques qui peuvent sembler superflues, mais il n’en est 

rien. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

ii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore. N’oubliez pas que c’est lui qui détermine la 

quantité.

iii. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Si tel est le cas, 

donnez à votre enfant une nourriture dont vous aurez choisi la nature et 

la dimension afin de lui faciliter la mastication et lui éviter des fausses 

routes, vous lui épargnerez le risque d’avaler de travers.

iv. Faites en sorte que votre ado, partage votre repas et mangez 

doucement vous donnerez l’exemple.

v. Si vous avez un sujet d’inquiétude, parlez en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 2:
                    $info = "Quelquefois  I :   Votre enfant apprend à manger. Un certain

d’automatismes doivent être acquis incluant la mastication et la déglutition. 

La déglutition est un phénomène réflexe. Par contre une mastication lente et 

répétée s’apprend et se garde toute la vie. Bien mâcher les aliments est la 

première étape de la digestion en réduisant les aliments en petits morceaux 

qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit, prend à peine le temps de 

mastiquer et avale.  Apprendre à manger correctement constitue une 

étape importante et vous devez souvent lui rappeler de prendre du 

temps pour bien mâcher ses aliments, c’est important, pour régler en 

plus sa notion d’appétit et de satiété. C’est le genre de remarques qui 

peuvent sembler superflues, mais il n’en est rien. Ce qui est 

fondamental, c’est qu’il conserve ces notions de faim et de satiété qui 

doivent guider sa prise alimentaire. 

ii. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

iii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore.

iv. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Si tel est le cas, 

donnez à votre enfant une nourriture dont vous aurez choisi la nature et 

la dimension afin de lui faciliter la mastication et lui éviter des fausses 

routes, vous lui épargnerez le risque d’avaler de travers.

v. Faites en sorte que votre ado, partage votre repas et mangez 

doucement vous donnerez l’exemple.

vi. Si vous avez un sujet d’inquiétude, parles en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 3:
                    $info = "Rarement  I :   Votre ado doit avoir appris à manger durant son enfance

certain nombre d’automatismes doivent être acquis incluant la mastication 

et la déglutition. La déglutition est un phénomène réflexe. Par contre une 

mastication lente et répétée s’apprend et doit se garder toute la vie. Bien 

mâcher les aliments est la première étape de la digestion en réduisant les 

aliments en petits morceaux qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit, prend à peine le temps de 

mastiquer et avale.  Apprendre à manger correctement constitue une 

étape importante et vous devez souvent lui rappeler de prendre du 

temps pour bien mâcher ses aliments, c’est important, pour régler en 

plus sa notion d’appétit et de satiété. C’est le genre de remarques qui 

peuvent sembler superflues, mais il n’en est rien. Ce qui est 

fondamental, c’est qu’il conserve ces notions de faim et de satiété qui 

doivent guider sa prise alimentaire.

ii. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

iii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore.

iv. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Donnez à votre 

enfant une nourriture dont vous aurez choisi la nature et la dimension 

afin de lui faciliter la mastication et lui éviter des fausses routes, vous 

lui épargnerez le risque d’avaler de travers.

v. Si vous avez un sujet d’inquiétude, parles en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 4 : 
                    $info = "Jamais  I :   Vous avez donné à votre ado de bonnes bases.

lentement : un repas ne doit être jamais pris en moins de 20 minutes.

i. Faites attention votre ado est en pleine croissance et vous pourriez être 

surpris de la quantité d’aliments qu’il peut ingurgiter.

ii. Si vous lui avez appris à s’arrêter quand il n’a plus faim, n’insistez 

pas, son organisme dit : il y en a assez quelle que soit la quantité qui 

reste dans l’assiette.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>Mon ado mâche ses aliments avec difficulté, avale souvent de travers, s’étouffe</b><br>". $info);
            $i++;
            
            
            switch(explode("-",$_POST['q18'])[0]) {
                case 1;
                    $info = "Toujours  I : C’est bien de planifier les repas et encas de telle sorte que

enfant arrive à table avec faim et prêt à manger. La sensation de faim doit 

être exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le 

reste de la vie. C’est un réflexe vital comme la sensation de satiété.

i. Si votre ado est physiquement actif, il faudra prévoir un surplus 

d’alimentation tout en respectant la notion de satiété.

ii. Pour des encas, qu’il ait toujours des fruits à sa portée";
                    break;
                case 2:
                    $info = "La plus part du temps  I : C’est bien de planifier les repas et encas de

sorte que votre enfant arrive à table avec faim et prêt à manger. La 

sensation de faim doit être exprimée, c’est ainsi qu’elle est ressentie et 

devra être ressentie tout le reste de la vie. C’est un réflexe vital.

i. Si votre ado arrive à table sans ressentir la sensation de faim, posez- 

vous la question de savoir s’il n’a pas bu des boissons aromatisées 

sucrées qui finissent par couper la faim. Surveillez ce que boit votre 

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en 

dehors. Bannissez les boissons gazeuses, aromatisées et sucrées de 

votre frigidaire.

ii. En plus votre enfant doit être physiquement actif entre les repas. Un 

adolescent doit être physiquement actif tous les jours.";
                    break;
                case 3:
                    $info = "Quelquefois  I : Planifier les repas et encas de telle sorte que votre

arrive à table avec faim et prêt à manger. La sensation de faim doit être 

exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste 

de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez- 

vous la question de savoir s’il n’a pas bu des boissons aromatisées 

sucrées qui finissent par couper la faim. Surveillez ce que boit votre 

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en dehors 

Bannissez les boissons gazeuses, aromatisées et sucrées de votre 

frigidaire.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si 

tel n’est pas le cas encouragez votre ado. 

iii. Si votre ado arrive à table sans avoir faim, voyez ce qui ne va pas 

dans son alimentation et son style de vie";
                    break;
                case 4: 
                    $info = "Rarement  I : Planifier les repas et encas de telle sorte que votre

arrive à table avec faim et prêt à manger. La sensation de faim doit être 

exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste 

de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez- 

vous la question de savoir s’il n’a pas bu des boissons aromatisées 

sucrées qui finissent par couper la faim. Surveillez ce que boit votre 

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en 

dehors. Bannissez les boissons gazeuses, aromatisées et sucrées de 

votre frigidaire.

ii. Si votre ado arrive à table sans avoir faim, voyez ce qui ne va pas 

dans son alimentation et son style de vie.

iii. En plus votre enfant doit être physiquement actif entre les repas. 

L’activité physique est absolument indispensable, tout le temps mais 

encore plus durant la croissance";
                    break;
                case 5 :
                    $info = "Jamais   I : Planifier les repas et encas de telle sorte que votre enfant arrive

table avec faim et prêt à manger. La sensation de faim doit être exprimée, 

c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste de la vie. 

C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez- 

vous la question de savoir s’il n’a pas bu des boissons aromatisées 

sucrées qui finissent par couper la faim. Surveillez ce que boit votre 

enfant. 

ii. Si votre ado arrive à table sans avoir faim, voyez ce qui ne va pas 

dans son alimentation et son style de vie.

iii. En plus votre enfant doit être physiquement actif entre les repas. 

L’activité physique est absolument indispensable, tout le temps mais 

encore plus durant la croissance.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado à faim au moment des repas</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q19'])[0]) {
                case 1;
                    $info = "Moins de 2 fois par jour  I : cette situation peut devenir préoccupante.

le point avec votre médecin ou pédiatre.

i. Vérifiez cependant qu’il ne mange pas entre les repas ou se goinfre pas 

de sucreries lorsque vous avez le dos tourné ou s’il boit des boissons 

aromatisées sucrées

ii. Vérifiez qu’il fait suffisamment d’activité physique

iii. Si votre enfant se développe normalement et qu’il saute un repas de 

temps en temps, cela n’a pas de conséquences.

iv. Faites confiance à l’appétit de votre ado. Laissez le décider quand il a 

faim et laissez le décider aussi quand il est rassasié. C’est ainsi que se 

développera cette sensation fondamentale d’appétit et de satiété.

v. Consultez « Mes Aliments » pour savoir comment équilibrer ses menus 

et snacks en fonction de son âge

vi.  « Supertraqueur » pourra";
                    break;
                case 2:
                    $info = "2 fois par jour   I : Chaque ado est différent et sa croissance est gérée par

génome, ses hormones et son microbiote intestinal. La quantité d’aliments 

qu’il consomme dépend de son âge, de son niveau d’activité, de son 

calendrier de croissance et de son appétit. C’est normal que son appétit 

varie d’un jour à l’autre.

i. Si votre ado se développe normalement et qu’il saute un repas de temps 

en temps, cela n’a pas de conséquences.

ii. Faites confiance à l’appétit de votre ado. Laissez le décider quand il a 

faim et laissez le décider aussi quand il est rassasié. C’est ainsi que se 

développera cette sensation fondamentale d’appétit et de satiété.

iii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

iv. « Supertraqueur » pourra vous aider.";
                    break;
                case 3:
                    $info = "3 à 4 fois par jour    I : Chaque ado est différent et sa croissance est gérée

son génome, ses hormones et son microbiote intestinal, la quantité 

d’aliments qu’il consomme et qui dépend de son âge, de son niveau 

d’activité, de son calendrier de croissance et de son appétit. C’est normal 

que son appétit varie d’un jour à l’autre.

i. Si votre ado se développe normalement et qu’il saute un repas de temps 

en temps, cela n’a pas de conséquences.

ii. Faites confiance à l’appétit de votre enfant. Laissez le décider quand 

il a faim et laissez le décider aussi quand il est rassasié. C’est ainsi que 

se développera cette sensation fondamentale d’appétit et de satiété.

iii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

iv. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                case 4:
                    $info="5 à 6 fois par jour  I : Chaque enfant est différent et la quantité

qu’il consomme dépend de son âge, de son niveau d’activité, de son rythme 

de croissance et de son appétit. C’est normal que son appétit varie d’un jour 

à l’autre.

i. Si votre ado se développe normalement et qu’il saute un repas de temps 

en temps, cela n’a pas de conséquences.

ii. Faites confiance à l’appétit de votre ado. Laissez le décider quand il a 

faim et laissez le décider aussi quand il est rassasié. C’est ainsi que se 

développera cette sensation fondamentale d’appétit et de satiété.

iii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

iv. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                    break;
                case 5 :
                    $info = "Plus de 6 fois par jour   I : Chaque ado est différent et la quantité

qu’il consomme dépend de son âge, de son niveau d’activité, de son rythme 

de croissance et de son appétit. C’est normal que son appétit varie d’un jour 

à l’autre.

i. Si votre ado se développe normalement et qu’il saute un repas de temps 

en temps, cela n’a pas de conséquences.

ii. Faites confiance à l’appétit de votre ado. Laissez le décider quand il a 

faim et laissez le décider aussi quand il est rassasié. C’est ainsi que se 

développera cette sensation fondamentale d’appétit et de satiété.

iii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

iv. « Supertraqueur » pourra vous aider à planifier son alimentation";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant mange régulièrement</b><br>".$info);
            $i++;
         
            
            
            switch(explode("-",$_POST['q20'])[0]) {
                case 1;
                    $info = "Toujours  I : C’est bien. Jusqu’ à un certain âge les enfants se

naturellement. La gourmandise met un certain temps à se développer, 

profitez de cet intermède pour diversifier au maximum sa nourriture.

i. Votre responsabilité est de décider en fonction des recommandations de 

« Mes Aliments » le type d’aliments à proposer, l’heure et le lieu.

ii. N’hésitez pas à l’impliquer dans la préparation et la présentation et 

les tâches ménagères. 

iii. La responsabilité de votre ado est de décider la quantité à mettre 

dans l’assiette.

iv. Continuez son éducation alimentaire : faites découvrir un nouveau 

plat dans lequel pourra être inclus un aliment qui n’avait pas obtenu un 

franc succès auparavant, surtout en ce qui concerne les fruits et les 

légumes car ils sont absolument indispensables à l’enfant.

v. En respectant l’appétit de votre enfant, vous lui apprendrez à écouter 

son corps (microbiote intestinal compris) et à déterminer ces sensations 

salutaires que son l’appétit et la satiété. Plus tard la perte de ses 

sensations ira de pair avec une détérioration de la santé, c’est dire si 

elles sont importantes. Si dans le domaine de l’alimentation vous 

n’écoutez pas ou ne ressentez pas  ces signaux que vous envoie votre 

corps vous devez vous poser la question de ce qui ne va pas.

vi. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

vii. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                    break;
                case 2:
                    $info = "La plus part du temps  I : C’est bien. Jusqu’ à un certain âge les enfants

limitent naturellement. La gourmandise met un certain temps à se 

développer, profitez de cet intermède pour diversifier au maximum sa 

nourriture, faites de vos enfants de gourmets et non des gourmands.

i. Votre responsabilité est de décider en fonction des recommandations de 

« Mes Aliments » le type d’aliments à proposer, l’heure et le lieu ;

ii. N’hésitez pas à l’impliquer dans la préparation et la présentation et 

les tâches ménagères. 

iii. La responsabilité de votre ado est de décider la quantité à mettre 

dans l’assiette. Mais s’il n’a plus faim avant que l’assiette ne soit vide 

ne le forcez surtout pas à finir.

iv. Faites découvrir un nouveau plat dans lequel pourra être inclus un 

aliment qui n’avait pas obtenu un franc succès auparavant, surtout en 

ce qui concerne les fruits et les légumes car ils sont absolument 

indispensables à l’enfant. 

v. En respectant l’appétit de votre ado, vous lui apprendrez à écouter son 

corps (microbiote intestinal compris) et à déterminer ces sensations 

salutaires que son l’appétit et la satiété. 

vi. Plus tard et l’adolescence en fait partie,  la perte de ses sensations ira 

de pair avec une déterioration de la santé, c’est dire si elles sont 

importantes. Si dans le domaine de l’alimentation vous n’écoutez pas 

ou ne ressentez pas  ces signaux que vous envoie votre corps vous devez 

vous poser la question de ce qui ne va pas. 

vii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

viii. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                    break;
                case 3:
                    $info = "Quelques fois I : Jusqu’ à un certain âge les enfants se

naturellement. La gourmandise met un certain temps à se développer, 

profitez de cet intermède pour diversifier au maximum sa nourriture, faites 

de vos enfants des gourmets et non des gourmands. Mais attention 

n’inversons pas les rôles :

i. Votre responsabilité est de décider en fonction des recommandations de 

« Mes Aliments » le type d’aliments à proposer, l’heure et le lieu ;

ii. N’hésitez pas à l’impliquer dans la préparation et la présentation. A 

cet âge-là on est plus sensible souvent à la présentation qu’au contenu.

iii. La responsabilité de votre enfant est de décider la quantité à mettre 

dans l’assiette.

iv. Faites découvrir un nouveau plat dans lequel pourra être inclus un 

aliment qui n’avait pas obtenu un franc succès auparavant, surtout en 

ce qui concerne les fruits et les légumes car ils sont absolument 

indispensables à l’enfant.

v. Vous devez impérativement respecter l’appétit de votre enfant. En 

respectant l’appétit de votre enfant, vous lui apprendrez à écouter son 

corps (microbiote intestinal compris) et à déterminer ces sensations 

salutaires que son l’appétit et la satiété. Plus tard la perte de ses 

sensations ira de pair avec une déterioration de la santé, c’est dire si 

elles sont importantes. Si dans le domaine de l’alimentation vous 

n’écoutez pas ou ne ressentez pas  ces signaux que vous envoie votre 

corps vous devez vous poser la question de ce qui ne va pas.

vi. Ne faites pas du repas une bataille de tranchées. Il doit rester un 

plaisir pour celui qui le prépare et celui qui le mange

vii. S’il y a un problème, commencez par vérifier s’il ne s’est pas gavé de 

boissons sucrées. 

viii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

ix. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                case 4:
                    $info="Rarement  I : Jusqu’ à un certain âge les enfants se limitent

La gourmandise met un certain temps à se développer, profitez de cet 

intermède pour diversifier au maximum sa nourriture, faites de vos enfants 

des gourmets et non des gourmands. Mais attention n’inversons pas les 

rôles :

i. Votre responsabilité est de décider en fonction des recommandations de 

« Mes Aliments » le type d’aliments à proposer, l’heure et le lieu ;

ii. N’hésitez pas à l’impliquer dans la préparation et la présentation et 

les tâches ménagères. 

iii. La responsabilité de votre ado est de décider la quantité à mettre 

dans l’assiette.

iv. Faites découvrir un nouveau plat dans lequel pourra être inclus un 

aliment qui n’avait pas obtenu un franc succès auparavant, surtout en 

ce qui concerne les fruits et les légumes car ils sont absolument 

indispensables à l’ado.

v. Vous devez impérativement respecter l’appétit de votre ado. En 

respectant l’appétit de votre ado, vous lui apprendrez à écouter son 

corps (microbiote intestinal compris) et à déterminer ces sensations 

salutaires que son l’appétit et la satiété. 

vi. Plus tard et l’adolesce en fait partie, la perte de ses sensations ira de 

pair avec une détérioration de la santé, c’est dire si elles sont 

importantes. 

vii. Si dans le domaine de l’alimentation vous n’écoutez pas ou ne 

ressentez pas  ces signaux que vous envoie votre corps vous devez vous 

poser la question de ce qui ne va pas.

viii. S’il y a un problème, commencez par vérifier s’il ne s’est pas gavé de 

boissons sucrées.

ix. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

x. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                case 5:
                    $info = "Jamais  I : Jusqu’ à un certain âge les enfants se limitent naturellement.

gourmandise met un certain temps à se développer, profitez de cet 

intermède pour diversifier au maximum sa nourriture, faites de vos enfants 

des gourmets et non des gourmands.  Mais attention n’inversons pas les 

rôles : 

i. Votre responsabilité est de décider en fonction des recommandations de 

« Mes Aliments » le type d’aliments à proposer, l’heure et le lieu ;

ii. N’hésitez pas à l’impliquer dans la préparation et la présentation. A 

cet âge-là on est plus sensible souvent à la présentation qu’au contenu.

iii. La responsabilité de votre enfant est de décider la quantité à mettre 

dans l’assiette.

iv. Faites découvrir un nouveau plat dans lequel pourra être inclus un 

aliment qui n’avait pas obtenu un franc succès auparavant, surtout en 

ce qui concerne les fruits et les légumes car ils sont absolument 

indispensables à l’enfant.

v. Vous devez impérativement respecter l’appétit de votre enfant. En 

respectant l’appétit de votre enfant, vous lui apprendrez à écouter son 

corps (microbiote intestinal compris) et à déterminer ces sensations 

salutaires que son l’appétit et la satiété. Plus tard la perte de ses 

sensations ira de pair avec une déterioration de la santé, c’est dire si 

elles sont importantes. Si dans le domaine de l’alimentation vous 

n’écoutez pas ou ne ressentez pas  ces signaux que vous envoie votre 

corps vous devez vous poser la question de ce qui ne va pas.

vi. Ne faites pas de vos repas une bataille de tranchées, un repas doit 

procurer du plaisir à celui qui le prépare et à celui qui le mange.

vii. S’il y a un problème, commencez par vérifier s’il ne s’est pas gavé de 

boissons sucrées.

viii. Consultez « Mes Aliments » pour savoir comment équilibrer ses 

menus et snacks en fonction de son âge

ix. « Supertraqueur » pourra vous aider à planifier son alimentation 

quotidienne.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon ado décide lui-même de la quantité qu'il mange</b><br>".$info);
            $i++;
            
            
            
            
            
        }
        
        
    }
    
    public function enfant() {
        
        
        
    }
    
    public function adulte() {
        
    }
    
    public function petit() {
        if($this->request->is("post")) {
            $score = 0;
            // calcul du score 
            for($i = 1 ; $i <= 20 ; $i++) {
                $a = 'q'.$i;
                
                $score += explode("-", $_POST[$a])[1];
                
                
            }
            $rsl;
            // affection du risque en fonction du score
           if($score > 0 && $score <= 6) {
               $rsl = "Risque modéré";
           } else if($score >= 7 && $score <= 13) {
               $rsl = "Risque élevé";
           } else if($score >= 14 && $score <= 20) {
               $rsl = "Risque très élevé";
           }  else if($score >= 21 && $score <= 50) {
               $rsl = "Risque faible";
           } 
           $this->set("resultatScore", $rsl);
               
            $this->set("resultat", "1");
            // variable pour le set afin d'envoyer les réponses à la vue
            $i = 0;
            // en fonction de chaque résultat on ajoute les données associées à la réponse
            switch(explode("-",$_POST['q1'])[0]) {
                case 1;
                    $info = "En surcharge pondérale I : Il a été démontré que les enfants d’une maman

en surcharge pondérale avaient un risque plus élevé de développer une

surcharge pondérale à leur tour.

i. Une maman en surcharge pondérale possède un microbiote intestinal

qui n’est pas optimal (on parle de dysbiose) qui va se répercuter sur le

microbiote intestinal de son enfant avant la naissance et après la

naissance entrainant des conséquences pouvant être graves sur la santé

de son enfant.";
                    break;
                case 2:
                    $info = "Normo-pondérée I : Le transfert du microbiote intestinal de la mère au

fœtus sera optimal pendant le troisième trimestre de grossesse et après

pendant l’allaitement maternels";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>La maman avant et au moment de la grossesse était</b><br/>" . $info);
            $i++;
            
            switch(explode("-",$_POST['q2'])[0]) {
                case 1;
                    $info = "9 à 12 kg I : Ceci est une moyenne. S’il est important de ne pas se priver

une surveillance est nécessaire. Certaines femmes prennent un peu plus

d’autres un peu moins";
                    break;
                case 2:
                    $info = "Moins de 9 kg I : Surveillez régulièrement votre poids, ne vous privez pas et

si vous avez des questions, posez les à votre gynécologue ou à votre

médecin.";
                    break;
                case 3:
                    $info = "Plus de 12 kg I : . Certaines femmes prennent un peu plus que la moyenne.

Le problème survient quand la prise de poids est excessive. Beaucoup de

mères se laissent complètement aller sous prétexte qu’elles mangent pour

deux.";
                    break;
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>La maman a pris pendant la grossesse</B><br/>".$info);
            $i++;
            
            switch(explode("-",$_POST['q3'])[0]) {
                case 1;
                    $info = "Jamais I : C’est une excellente chose. Il faut savoir que la prise

d’antibiotiques par la maman peut avoir une profonde répercussion sur son

microbiote intestinal pouvant entrainer des altérations importantes sur ce

dernier lesquelles peuvent se répercuter sur le microbiote du fœtus qui est

en train de mettre en place son système de défense adaptatif.";
                    break;
                case 2:
                    $info = "Une fois I : Il faut savoir que la prise d’antibiotiques par la maman peut

avoir une profonde répercussion sur son propre microbiote intestinal

pouvant entrainer des altérations importantes sur ce dernier lesquelles

peuvent se répercuter sur le microbiote du fœtus qui est en train de mettre

en place son système de défense adaptatif. C’est la porte ouverte à une

série de pathologies liées au dérèglement de la mise en place du système

immunitaire : asthme, allergies ….";
                    break;
                case 3:
                    $info = "Plus d’une fois I : Il faut savoir que la prise d’antibiotiques par la maman

peut avoir une profonde répercussion sur son propre microbiote intestinal

pouvant entrainer des altérations importantes sur ce dernier, lesquelles

peuvent se répercuter sur le microbiote du fœtus qui est en train de mettre

en place le système de défense adaptatif. C’est la porte ouverte à une série

de pathologies liées au dérèglement de la mise en place du système

immunitaire : asthme, allergies ….";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>La maman a pris des antibiotiques pendant sa grossesse</B><br/>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q4'])[0]) {
                case 1;
                    $info = "A terme I : l’importance de naitre à terme vient du fait que toutes les

conditions sont réunies pour un bon départ dans la vie. Des bactéries amies

du tractus digestif de la maman ont déjà colonisé le tube digestif du fœtus et

mis en route l’élaboration du système immunitaire de l’enfant. Le

développement du microbiote intestinal va dépendre dans l’immédiat du

mode de délivrance et du type d’alimentation du bébé.";
                    break;
                case 2:
                    $info = "Prématuré I : La prématurité (naissance avant la 37 ème semaine

d’aménorrhée) peut grandement affecter et amputer pour les années à

venir la santé du bébé. Nous ne retiendrons que trois éléments :

i. Le premier est lié au fait que le microbiote intestinal du fœtus n’a pas eu

un temps suffisant pour induire un début de développement du système

immunitaire adaptatif.

ii. Le deuxième est lié au fait que souvent ces bébés naissent par

césarienne ce qui les prive d’un ensemencement vaginal (bactéries

amies) de leur tube digestif avec pour conséquence un développement

du microbiote intestinal et du système immunitaire dysharmonieux.

iii. Le troisième élément et non le moindre est lié au fait que ces bébés

reçoivent souvent une antibiothérapie qui achève de perturber un

microbiote intestinal déjà atteint et par voie de conséquence leur

fonction immunitaire dont le microbiote est l’un des artisans principaux.

iv. Pour ces raisons, ces bébés sont susceptibles de développer une

pathologie grave qu’est l’entérocolite nécrosante : résultat non

seulement d’une sélection de microbes résistants mais aussi d’une paroi

intestinale insuffisamment développée (trophicité, immunité et axe

nerveux entéro-cérébral…)";
                    break;
                case 3;
                    $info = "En dépassement de terme I : on parle de dépassement de terme lorsque

les grossesses dépassent les 42 semaines d’aménorrhée.

i. Un des risques, parmi d’autres, pour la santé future du bébé est la

délivrance par césarienne et souvent un surpoids qui vont perturber un

développement harmonieux de son microbiote intestinal entrainant des

conséquences sur le développement de son tube digestif, de son

immunité adaptative et de son axe nerveux : système nerveux entérique

–système nerveux central.";
                    break;
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé est né</B> <br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q6'])[0]) {
                case 1;
                    $info = "Avec le lait maternel     I : Pendant longtemps, le lait maternel a

considéré comme stérile. Les études récentes viennent de montrer que cette 

idée était fausse et que ce lait contient une grande quantité de bactéries 

parmi lesquelles les bactéries lactiques et les bifidobactéries, une grande 

majorité provenant du tube digestif maternel par migration interne.

i. Donc un bébé consommant environ 1 litre de lait de la mère avale entre 

quelques centaines de milliers et plus de 10 millions de bactéries.

ii. Ces bactéries amies vont se développer dans le tube digestif du bébé 

utilisant entre autre les oligosaccharides du lait maternel et participer 

notamment au développement du système immunitaire.

iii. Les études cliniques avaient depuis longtemps suggéré que les 

enfants allaités au sein présentaient un risque moindre de développer 

un certain nombre de troubles ou maladies : diarrhées, maladies 

respiratoires (asthme…) et des pathologies métaboliques (allergies…)";
                    break;
                case 2:
                    $info = "Avec du lait maternisé    I : Même si le lait maternisé, est

élaboré, il ne contient pas ces bactéries maternelles qui font toute la 

différence. Le tube digestif du bébé ne reçoit alors que les bactéries de 

l’environnement qui sont loin d’assurer un développement optimal du 

microbiote du bébé.

i. La répercussion est immédiate sur le développement du tube digestif du 

bébé sur son développement immunitaire et le développement de l’axe 

nerveux entéro-cérébral.

ii. Les études cliniques avaient depuis longtemps démontré que les 

enfants allaités au lait maternisé présentaient un risque plus élevé de 

développer un certain nombre de troubles ou maladies : diarrhées, 

maladies respiratoires (asthme…) et des pathologies métaboliques 

(allergies…)…troubles du développement de l’axe nerveux entéro-

cérébral";
                    break;
                case 3:
                    $info = "Avec les deux       I : Même si le lait maternisé, est extrêmement élaboré, il

contient pas ces bactéries maternelles qui font toute la différence. Le tube 

digestif du bébé ne reçoit alors que les bactéries de l’environnement qui sont 

loin d’assurer un développement optimal du microbiote du bébé.

i. La répercussion est immédiate sur le développement du tube digestif du 

bébé sur son développement immunitaire et le développement de l’axe 

nerveux entéro-cérébral.

ii. Les études cliniques avaient depuis longtemps démontré que les 

enfants allaités au lait maternisé présentaient un risque plus élevé de 

développer un certain nombre de troubles ou maladies : diarrhées, 

maladies respiratoires (asthme…) et des pathologies métaboliques 

(allergies…)…troubles du développement de l’axe nerveux entéro-

cérébral.";
                    
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé a été allaité</b> <br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q5'])[0]) {
                case 1;
                    $info = "Par voie basse I : Pour la santé future du bébé cette étape est de première

importance. Lors de sa progression dans les voies maternelles, le bébé va

ingurgiter une certaine quantité de flore vaginale et fécale de la mère. Cet

ensemencement maternel vient rejoindre le pré-ensemencement maternel

du fœtus (attention toutes ces bactéries sont des bactéries amies) et va

participer activement au développement du microbiote intestinal du bébé.";
                    break;
                case 2:
                    $info = "Par césarienne I : La naissance par césarienne prive le bébé de cet

ensemencement vaginal maternel bénéfique, le bébé étant alors exposé aux

bactéries de l’environnement qui sont toutes loin d’être amies.

i. Ce microbiote intestinal de l’enfant se développant de manière

disharmonieuse se répercute sur le développement du tube digestif du

bébé et notamment sur la fonction immunitaire du bébé et de l’enfant

plus tard.

ii. Dès lors il n’est pas étonnant que les enfants nés par césarienne

développent un ensemble de pathologies issues d’une mauvaise

maturation du système immunitaire dont le microbiote intestinal en est

l’un des principaux artisans : asthme, allergies pendant la jeunesse et

obésité, diabète, pathologies inflammatoires digestive, pathologies

nerveuses…. plus tard.

iii. Aujourd’hui, les médecins de ce site suggèrent, aux mamans prévues

pour une césarienne et aux sages-femmes d’introduire avant la

césarienne de la gaze dans le vagin maternel afin d’en récupérer les

sécrétions qui devront être sucée ensuite par le nouveau-né : une

manière de donner au bébé les bactéries amies qui sans cela lui feraient

défaut.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>Le bébe est né :/b> " . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q7'])[0]) {
                case 1;
                    $info = "Normo-pondérée I : Une maman qui a un IMC compris entre 18 et 25 est

dite normo-pondérée. Son microbiote peut être considéré comme riche et

diversifié. Les microbes transmis par le lait maternel réflètent cette diversité

et vont coloniser le tube digestif du bébé.";
                    break;
                case 2:
                    $info = "En surcharge pondérale I : La surcharge pondérale laisse supposer une

dysbiose avec un microbiote intestinal altéré. Le transfert microbien de la

mère à l’enfant ne sera pas optimal.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>La maman qui allaitait était </b><br/>" . $info);
            $i++;
            
            
            switch(explode("-",$_POST['q8'])[0]) {
                case 1;
                    $info = "JPendant 1 mois I : Plus l’allaitement maternel est long, plus important est

l’ensemencement du microbiote du bébé et meilleure est sa diversification";
                    break;
                case 2:
                    $info = "Pendant deux mois I : Plus l’allaitement maternel est long, plus important

est l’ensemencement du microbiote du bébé et meilleure est sa

diversification";
                    break;
                case 3:
                    $info = "Pendant 3 mois I : cette durée de l’allaitement semble être la durée

minimale pour un transfert microbien optimal. Elle peut correspondre avec

le début du sevrage et l’introduction d’une nourriture diversifiée préparée à

la maison. De cette manière le microbiote intestinal va continuer à se

développer et se diversifier pour le plus grand bien de l’enfant. Ne l’oublions

pas c’est grâce au microbiote intestinal que se développe la surface

d’échange du tube digestif et sa cohésion, la maturation du système

immunitaire adaptatif et la maturation de l’axe nerveux entérique-cérébral.";
                    break;
                case 4:
                    $info = "Pendant 6 mois I : si vous en avez la possibilité c’est encore mieux. Cette

durée de l’allaitement permet au microbiote de l’enfant de se mettre en

place de se diversifier et de se développer.

i. Elle peut correspondre avec le début du sevrage et l’introduction d’une

nourriture diversifiée préparée à la maison. De cette manière le

microbiote intestinal va continuer à se développer et se diversifier pour

le plus grand bien de l’enfant.";
                    break;
                case 5:
                    $info = "Pendant un an I : si vous en avez la possibilité c’est encore mieux. Cette

durée de l’allaitement permet au microbiote de l’enfant de se mettre en

place de se diversifier et de se développer.

i. Elle peut correspondre avec le début du sevrage et l’introduction d’une

nourriture diversifiée préparée à la maison. De cette manière le

microbiote intestinal va continuer à se développer et se diversifier pour

le plus grand bien de l’enfant.

ii. Ne l’oublions pas c’est grâce au microbiote intestinal que se

développe la surface d’échange du tube digestif et sa cohésion, la

maturation du système immunitaire adaptatif et la maturation de l’axe

nerveux entérique-cérébral.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Le bébé a été allaité </b><br/>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q9'])[0]) {
                case 1;
                    $info = "Le bébé a consommé de la nourriture préparée à la maison I : outre le fait

que vous savez non seulement ce que mange votre enfant, une nourriture

préparée à la maison peut être diversifié, adaptée à votre enfant et à son

microbiote intestinal.

i. N’oubliez pas que le bon développement de votre enfant est

indissociable de celui de son microbiote intestinal. Ce microbiote

intestinal a besoin d’une nourriture appropriée comme votre bébé.

Consultez le bouton « Mes aliments » et vous verrez le type et la

quantité d’aliments dont votre bébé et son microbiote ont besoin en

fonction de leur âge";
                    break;
                case 2:
                    $info = "Le bébé a consommé plus tôt des petits pots du commerce I : que vous le

vouliez ou non, vous ne contrôlez que les étiquettes des emballages de la

nourriture aseptisée de votre enfant. Cette nourriture n’apporte aucun

ensemencement microbien intestinal de votre enfant : ensemencement dont

il a besoin quotidiennement. Consultez le bouton « Mes aliments » et vous

verrez le type et la quantité d’aliments dont votre bébé et son microbiote

intestinal ont besoin en fonction de leur âge";
                    break;
                case 3:
                    $info = "Le bébé a consommé les deux I : C’est mieux que si le bébé ne

consommait que des petits pots mais bon, vous pouvez faire un petit effort

supplémentaire et ne lui donnez que de la nourriture saine que vous

contrôlez pleinement. Consultez le bouton « Mes aliments » et vous verrez

le type et la quantité d’aliments dont votre bébé et son microbiote intestinal

ont besoin en fonction de leur âge";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Pendant le sevrage </B><br>" .$info);
            $i++;
            
            
            switch(explode("-",$_POST['q10'])[0]) {
                case 1;
                    $info = "Plus de 5 fois par jour I : C’est bien de manger des produits céréaliers mais

là encore le mieux peut être l’ennemi du bien. Attention aux portions que

vous lui donnez elles doivent se conformer, en fonction de l’âge, aux

recommandations quotidiennes de ce site (voir « Mes Aliments, Produits";
                    break;
                case 2:
                    $info = "4 à 5 fois par jour I : Attention aux portions que vous lui donnez elles

doivent se conformer, en fonction de l’âge, aux recommandations

quotidiennes de ce site (voir « Mes Aliments, Produits Céréaliers »)";
                    break;
                case 3:
                    $info = "2 à 3 fois par jour I : Attention aux portions que vous lui donnez elles

doivent se conformer, en fonction de l’âge, aux recommandations

quotidiennes de ce site (voir « Mes Aliments, Produits céréaliers »)";
                    break;
                case 4:
                    $info = "Moins de 2 fois par jour I : Attention aux portions que vous lui donnez elles

doivent se conformer, en fonction de l’âge, aux recommandations

quotidiennes de ce site (voir « Mes Aliments, Produits céréaliers »)";
                    
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon bébé mange régulièrement des produits céréaliers </B><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q11'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour  I : Les fruits et légumes sont essentiels pour

qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments, Fruits» sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 2:
                    $info = "3 à 4 fois par jour   I : Les fruits et légumes sont essentiels pour les

nutritionnelles décrites dans l’onglet « Mes Aliments, Fruits » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités 

décrites dans « Mes Aliments, Fruits » sont indispensables à la 

bonne santé du microbiote intestinal laquelle conditionne la 

bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 3:
                    $info = "2 fois par jour    I : C’est insuffisant. Les fruits et légumes sont essentiels

les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

iii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Fruits »)";
                    break;
                case 4 :
                    $info = "1 fois par jour       I : C’est insuffisant. Les fruits et légumes sont

pour les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités 

décrites dans « Mes Aliments » sont indispensables à la bonne 

santé du microbiote intestinal laquelle conditionne la bonne 

santé de l’enfant. Attention aux portions que vous lui donnez 

elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon bébé mange régulièrement des produits laitiers </b> <br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q12'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour  I : Les légumes sont essentiels pour les

nutritionnelles décrites dans l’onglet « Mes Aliments, Légumes » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments, Légumes » sont indispensables à la bonne santé 

du microbiote intestinal laquelle conditionne la bonne santé de l’enfant. 

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Légumes»)";
                    break;
                case 2:
                    $info = "2 fois par jour    I : C’est insuffisant. Les fruits et légumes sont essentiels

les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments, Légumes»";
                    break;
                case 3:
                    $info = "1 fois par jour       I : C’est insuffisant. Les fruits et légumes sont

pour les qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais 

nous attirerons l’attention sur le fait que le microbiote intestinal trouve 

aussi dans les fruits et légumes une grande partie de son alimentation que 

sont les fibres alimentaires.

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant. 

Attention aux portions que vous lui donnez elles doivent se conformer, 

en fonction de l’âge, aux recommandations quotidiennes de ce site (voir 

« Mes Aliments »)";
                    break;
                case 4: 
                    $info = "Jamais      I : C’est insuffisant. Les fruits et légumes sont essentiels pour les

qualités nutritionnelles décrites dans l’onglet « Mes Aliments » mais nous 

attirerons l’attention sur le fait que le microbiote intestinal trouve aussi 

dans les fruits et légumes une grande partie de son alimentation que sont 

les fibres alimentaires. 

i. Ces fibres qui présentent par ailleurs de nombreuses qualités décrites 

dans « Mes Aliments » sont indispensables à la bonne santé du 

microbiote intestinal laquelle conditionne la bonne santé de l’enfant.

ii. Attention aux portions que vous lui donnez elles doivent se 

conformer, en fonction de l’âge, aux recommandations quotidiennes de 

ce site (voir « Mes Aliments »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon bébé mange régulièrement des fruits et légumes</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q13'])[0]) {
                case 1;
                    $info = "Plus de 2 fois par jour    I :   C’est bien de manger de la viande mais là

le mieux peut être l’ennemi du bien. Attention aux portions que vous lui 

donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 2:
                    $info = "2 fois par jour    I :  C’est bien de manger des produits protéinés mais là

encore le mieux peut être l’ennemi du bien. Attention aux portions que vous 

lui donnez elles doivent se conformer, en fonction de l’âge, aux 

recommandations quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 3:
                    $info = "Une fois par jour     I : Attention aux portions que vous lui donnez

doivent se conformer, en fonction de l’âge, aux recommandations 

quotidiennes de ce site (voir « Mes Aliments, Protéines »)";
                    break;
                case 4 :
                    $info = "Quelque fois par semaine    I : C’est insuffisant pour assurer le

développement de votre enfant. Les protéines sont indispensables à votre 

enfant mais sachez qu’on les rencontre dans la viande mais aussi dans 

certains légumes ";
                    break;
                case 5 :
                    $info = "Jamais     I : C’est insuffisant pour assurer le bon développement de

enfant. Les protéines sont indispensables à votre enfant mais sachez qu’on 

les rencontre dans la viande mais aussi dans certains légumes (voir « Mes 

Aliments, Protéines »)";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon bébé mange régulièrement de la viande, du poisson, de la volaille des œufs ou

des alternatives (légumes secs …)</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q14'])[0]) {
                case 1;
                    $info = "3 fois ou plus par semaine     I : Aller au restaurant quelques fois par mois

la rigueur, pour des occasions particulières. Ce faisant vous ne donnez pas à 

votre ado la nourriture dont lui et son microbiote intestinal ont besoin.

i. Les aliments servis dans les fast-foods sont souvent bourrés de graisse, 

de calories ; de sel et ne contiennent pas des nutriments tels que les 

fibres, les vitamines ou les minéraux

ii. Vous ne contrôlez,  ce faisant, ni la qualité ni la quantité de 

nutriments dont votre ado a besoin pour son développement.";
                    break;
                case 2:
                    $info = "2 fois par semaine  I : Aller au restaurant quelques fois par mois à la rigueur,

pour des occasions particulières, Ce faisant vous ne donnez pas à votre 

enfant la nourriture dont lui et son microbiote intestinal ont besoin.

i. Les aliments servis dans les fast foods sont souvent bourrés de graisse, 

de calories ; de sel et ne contiennent pas des nutriments tels que les 

fibres, les vitamines ou les minéraux

ii. Vous ne contrôlez ni la qualité ni la quantité de nutriments dont votre 

enfant a besoin pour son développement.";
                    break;
                case 3:
                    $info = "1 fois par semaine ou moins   I : doit rester la règle si vous voulez offrir

votre enfant toutes les chances d’un bon développement.";
                    break;
                case 4 :
                    $info = "Jamais.   I : C’est bien. Le microbiote intestinal vous remercie";
                break;
                    default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant mange au fast - food</b><br>" .$info);
            $i++;
            
            
            switch(explode("-",$_POST['q15'])[0]) {
                case 1;
                    $info = "Plus de 4 fois par jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 2:
                    $info = "3 à 4 fois par jour  jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 3:
                    $info = "2 fois par jour  jour    I : Ce genre de boissons contient souvent du

ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion pondérale et 

calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences :

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim. 

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 4:
                    $info = "Une fois par jour ou moins  jour    I : Ce genre de boissons contient

du sucre ajouté, ce que l’on appelle des « calories vides » (Voir « Gestion 

pondérale et calories ». Ces boissons caloriques sucrées vont avoir plusieurs 

conséquences :

i. Créer un état de dépendance vis-à-vis du sucre. Les circuits cérébraux de 

cette dépendance sont les mêmes que ceux des autres drogues. C’est le 

premier pas vers l’obésité. 

ii. Apporter des calories de telle sorte qu’au moment du repas votre 

enfant soit aura moins faim soit n’aura pas faim.

iii. Si votre enfant a soif donnez-lui de l’eau tout simplement, que ce soit 

au repas ou en dehors des repas.";
                    break;
                case 5: 
                    $info = "Jamais  I : le plus beau cadeau que vous pouvez faire à votre ado en";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant boit régulièrement des jus ou des boissons aromatisés</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q16'])[0]) {
                case 1;
                    $info = "La plus part du temps  I : Ce n’est pas tout le monde qui peut manger

accord avec les recommandations de ce site en matière d’alimentation. Il y a 

aussi de la pauvreté dans des familles françaises qui ont des enfants qui plus 

qu’à leur tour disent qu’ils ont faim. C’est un drame familial que de ne 

pouvoir offrir à ses enfants la diversité de la nourriture dont ils ont besoin. 

Bien souvent ces parents vont se tourner vers de la nourriture qui « remplit 

le ventre » mais qui est loin d’apporter les nutriments nécessaires au bon 

développement de l’enfant. Voici quelques conseils qui vous permettront 

d’acheter de la nourriture diversifiée :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-preparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères, et le résultat 

est sensiblement le même.

v. Achetez des produits en promotion";
                    break;
                case 2:
                    $info = "Quelques fois  I : Ce n’est pas tout le monde qui peut manger en accord

les recommandations de ce site en matière d’alimentation. Il y a aussi de la 

pauvreté dans des familles françaises qui ont des enfants qui plus qu’à leur 

tour disent qu’ils ont faim. C’est un drame familial que de ne pouvoir offrir à 

ses enfants la diversité de la nourriture dont ils ont besoin. Bien souvent ces 

parents vont se tourner vers de la nourriture qui « remplit le ventre » mais 

qui est loin d’apporter les nutriments nécessaires au bon développement de 

l’enfant. Voici quelques conseils :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-preparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères.

v. Achetez des produits en promotion";
                    break;
                case 3:
                    $info = "Rarement  I : Ce n’est pas tout le monde qui peut manger en accord avec

recommandations de ce site en matière d’alimentation. Il y a aussi de la 

pauvreté dans des familles françaises qui ont des enfants qui plus qu’à leur 

tour disent qu’ils ont faim. C’est un drame familial que de ne pouvoir offrir à 

ses enfants la diversité de la nourriture dont ils ont besoin. Bien souvent ces 

parents vont se tourner vers de la nourriture qui « remplit le ventre » mais 

qui est loin d’apporter les nutriments nécessaires au bon développement de 

l’enfant. Voici quelques conseils :

i. Planifiez vos repas à l’avance, pour une semaine et faite une liste de vos 

courses. Achetez ce dont vous avez besoin vous permettra d’économiser 

de l’argent.

ii. Evites les plats tout préparés, les plats pré-péparés

iii. Limitez les repas congelés ou pré-préparés souvent contenant 

beaucoup de graisse et de sel.

iv. Sachez qu’il n y a pas que la viande qui contient des protéines il y a 

aussi les légumineuses qui sont beaucoup moins chères.

v. Achetez des produits en promotion";
                    break;
                case 4 :
                    $info = "Jamais  I : pensez à diversifier l’alimentation de votre ado, c’est pour

bien et celui de son microbiote intestinal.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>J’ai de la difficulté à acheter la nourriture qui lui conviendrait</b><br>". $info);
            $i++;
            
            
            switch(explode("-",$_POST['q17'])[0]) {
                case 1;
                    $info = "Souvent    I : A cet âge un certain nombre d’automatismes doivent

acquis incluant la mastication et la déglutition. La déglutition est un 

phénomène réflexe. Par contre une mastication lente et répétée s’apprend 

et se garde toute la vie. Prendre son temps pour bien mâcher les aliments 

est la première étape de la digestion en réduisant les aliments en petits 

morceaux qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit. Apprendre à manger 

correctement constitue une étape importante et vous devez souvent lui 

rappeler de prendre du temps pour bien mâcher ses aliments, c’est 

important, pour régler en plus sa notion d’appétit et de satiété. C’est le 

genre de remarques qui peuvent sembler superflues, mais il n’en est 

rien. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

ii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore. N’oubliez pas que c’est lui qui détermine la 

quantité.

iii. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Si tel est le cas, 

donnez à votre enfant une nourriture dont vous aurez choisi la nature et 

la dimension afin de lui faciliter la mastication et lui éviter des fausses 

routes, vous lui épargnerez le risque d’avaler de travers.

iv. Faites en sorte que votre ado, partage votre repas et mangez 

doucement vous donnerez l’exemple.

v. Si vous avez un sujet d’inquiétude, parlez en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 2:
                    $info = "Quelquefois  I :   Votre enfant apprend à manger. Un certain

d’automatismes doivent être acquis incluant la mastication et la déglutition. 

La déglutition est un phénomène réflexe. Par contre une mastication lente et 

répétée s’apprend et se garde toute la vie. Bien mâcher les aliments est la 

première étape de la digestion en réduisant les aliments en petits morceaux 

qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit, prend à peine le temps de 

mastiquer et avale.  Apprendre à manger correctement constitue une 

étape importante et vous devez souvent lui rappeler de prendre du 

temps pour bien mâcher ses aliments, c’est important, pour régler en 

plus sa notion d’appétit et de satiété. C’est le genre de remarques qui 

peuvent sembler superflues, mais il n’en est rien. Ce qui est 

fondamental, c’est qu’il conserve ces notions de faim et de satiété qui 

doivent guider sa prise alimentaire. 

ii. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

iii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore.

iv. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Si tel est le cas, 

donnez à votre enfant une nourriture dont vous aurez choisi la nature et 

la dimension afin de lui faciliter la mastication et lui éviter des fausses 

routes, vous lui épargnerez le risque d’avaler de travers.

v. Faites en sorte que votre ado, partage votre repas et mangez 

doucement vous donnerez l’exemple.

vi. Si vous avez un sujet d’inquiétude, parles en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 3:
                    $info = "Rarement  I :   Votre ado doit avoir appris à manger durant son enfance

certain nombre d’automatismes doivent être acquis incluant la mastication 

et la déglutition. La déglutition est un phénomène réflexe. Par contre une 

mastication lente et répétée s’apprend et doit se garder toute la vie. Bien 

mâcher les aliments est la première étape de la digestion en réduisant les 

aliments en petits morceaux qui s’imprègnent de sucs digestifs salivaires.

i. Bien souvent l’ado ne mange pas, il engloutit, prend à peine le temps de 

mastiquer et avale.  Apprendre à manger correctement constitue une 

étape importante et vous devez souvent lui rappeler de prendre du 

temps pour bien mâcher ses aliments, c’est important, pour régler en 

plus sa notion d’appétit et de satiété. C’est le genre de remarques qui 

peuvent sembler superflues, mais il n’en est rien. Ce qui est 

fondamental, c’est qu’il conserve ces notions de faim et de satiété qui 

doivent guider sa prise alimentaire.

ii. Un repas doit durer au minimum 20 minutes et plus c’est mieux.

iii. Si votre ado n’a plus faim, n’insistez pas pour qu’il termine son 

assiette s’il en reste encore.

iv. Le type, la forme, la texture et la dimension des aliments peuvent 

augmenter le risque d’avaler de travers et de s’étouffer. Donnez à votre 

enfant une nourriture dont vous aurez choisi la nature et la dimension 

afin de lui faciliter la mastication et lui éviter des fausses routes, vous 

lui épargnerez le risque d’avaler de travers.

v. Si vous avez un sujet d’inquiétude, parles en à votre médecin ou 

pédiatre. Il vous aidera à résoudre les problèmes s’ils sont présents.";
                    break;
                case 4 : 
                    $info = "Jamais  I :   Vous avez donné à votre ado de bonnes bases.

lentement : un repas ne doit être jamais pris en moins de 20 minutes.

i. Faites attention votre ado est en pleine croissance et vous pourriez être 

surpris de la quantité d’aliments qu’il peut ingurgiter.

ii. Si vous lui avez appris à s’arrêter quand il n’a plus faim, n’insistez 

pas, son organisme dit : il y en a assez quelle que soit la quantité qui 

reste dans l’assiette.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i,"<b>Mon enfant mâche ses aliments avec difficulté, avale souvent de travers, s’étouffe</b><br>". $info);
            $i++;
            
            
            switch(explode("-",$_POST['q18'])[0]) {
                case 1;
                    $info = "Toujours I : Encouragez le ! Encouragez votre enfant à manger tout seul,

qu’il commence avec les doigts et plus tard il continuera avec des ustensiles.

i. Manger avec les doigts permet en plus d’apporter des microbes amis à

son microbiote intestinal. Devant cette nourriture sur les mains, à coté

de la bouche sur les joues, ne prenez pas l’air effarouche du ‘sale »,

pensez plus tôt au côté salvateur d’un microbiote intestinal diversifié et

riche.

ii. Certes il faut passer à table à tout âge avec les mains propres, mais à

cet âge si la toilette a laissé quelques zones d’ombre, son microbiote

intestinal applaudira et si le microbiote intestinal applaudit c’est bon

signe pour la santé de votre enfant.";
                    break;
                case 2:
                    $info = "La plus part du temps I : Encouragez-le ! Encouragez votre enfant à manger

tout seul, qu’il commence avec les doigts et plus tard il continuera avec des

ustensiles.

i. Manger avec les doigts permet en plus d’apporter des microbes amis à

son microbiote intestinal. Devant cette nourriture sur les mains, à coté

de la bouche sur les joues, ne prenez pas l’air effarouche du ‘sale »,

pensez plus tôt au côté salvateur d’un microbiote intestinal diversifié et

riche.

ii. Certes il faut passer à table à tout âge avec les mains propres, mais à

cet âge si la toilette a laissé quelques zones d’ombre, son microbiote

intestinal applaudira et si le microbiote intestinal applaudit c’est bon

signe pour la santé de votre enfant.";
                    break;
                case 3:
                    $info = "Quelquefois I : Encouragez-le ! Encouragez votre enfant à manger tout seul,

qu’il commence avec les doigts et plus tard il continuera avec des ustensiles.

i. Dès l’âge de 15 mois votre enfant devrait manger tout seul que ce soit

avec ses doigts ou avec des ustensiles.

ii. Apprendre à manger avec des ustensiles prends du temps mais c’est

aussi une bonne manière d’affiner sa gestuelle et la coordination des

différents mouvements et de gagner en indépendance.

iii. Manger avec les doigts permet en plus d’apporter des microbes amis

à son microbiote intestinal. Devant cette nourriture sur les mains, à coté

de la bouche sur les joues, ne prenez pas l’air effarouche du ‘sale »,

pensez plus tôt au côté salvateur d’un microbiote intestinal diversifié et

riche.

iv. Certes il faut passer à table à tout âge avec les mains propres, mais à

cet âge si la toilette a laissé quelques zones d’ombre, son microbiote

intestinal applaudira et si le microbiote intestinal applaudit c’est bon

signe pour la santé de votre enfant.";
                    break;
                case 4: 
                    $info = "Rarement I : Encouragez-le ! Encouragez votre enfant à manger tout seul,

qu’il commence avec les doigts et plus tard il continuera avec des ustensiles.

i. Dès l’âge de 15 mois votre enfant devrait manger tout seul que ce soit

avec ses doigts ou avec des ustensiles.

ii. Apprendre à manger avec des ustensiles prends du temps mais c’est

aussi une bonne manière d’affiner sa gestuelle et la coordination des

différents mouvements et de gagner en indépendance.

iii. Manger avec les doigts permet en plus d’apporter des microbes amis

à son microbiote intestinal. Devant cette nourriture sur les mains, à coté

de la bouche sur les joues, ne prenez pas l’air effarouche du ‘sale »,

pensez plus tôt au côté salvateur d’un microbiote intestinal diversifié et

riche.

iv. Certes il faut passer à table à tout âge avec les mains propres, mais à

cet âge si la toilette a laissé quelques zones d’ombre, son microbiote

intestinal applaudira et si le microbiote intestinal applaudit c’est bon

signe pour la santé de votre enfant.";
                    break;
                case 5 :
                    $info = "Jamais   I : Planifier les repas et encas de telle sorte que votre enfant arrive

table avec faim et prêt à manger. La sensation de faim doit être exprimée, 

c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste de la vie. 

C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez- 

vous la question de savoir s’il n’a pas bu des boissons aromatisées 

sucrées qui finissent par couper la faim. Surveillez ce que boit votre 

enfant. 

ii. Si votre ado arrive à table sans avoir faim, voyez ce qui ne va pas 

dans son alimentation et son style de vie.

iii. En plus votre enfant doit être physiquement actif entre les repas. 

L’activité physique est absolument indispensable, tout le temps mais 

encore plus durant la croissance.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant mange tout seul aux repas ou aux goûters</b><br>".$info);
            $i++;
            
            
            switch(explode("-",$_POST['q19'])[0]) {
                case 1;
                    $info = "Toujours  I : Après 12 à 15 mois votre enfant n’a pas besoin de biberon ou de

gobelet. Plus il va attendre pour passer au verre, à la tasse ou au bol, plus

cela va être difficile de s’y mettre.

i. Apprendre à boire par petites gorgées est indispensable pour combiner

la déglutition des solides et des liquides.

ii. Faites-lui boire dans une tasse adaptée à la taille de sa bouche du

lait, de l’eau ou du jus de fruits pur jus, en bannissant toutes les autres

boissons type aromatisées, sucrées.

iii. En ce qui concerne la consommation quotidienne de jus de fruits et

de lait en fonction de l’âge, conformez-vous aux directives que vous

trouvez dans « Mes Aliments ».";
                    break;
                case 2:
                    $info = "La plus part du temps  I : Après 12 à 15 mois votre enfant n’a pas besoin de

biberon ou de gobelet. Plus il va attendre pour passer au verre, à la tasse ou

au bol, plus cela va être difficile de s’y mettre.

i. Apprendre à boire par petites gorgées est indispensable pour combiner

la déglutition des solides et des liquides.

ii. Faites-lui boire dans une tasse adaptée à la taille de sa bouche du

lait, de l’eau ou du jus de fruits pur jus, en bannissant toutes les autres

boissons type aromatisées, sucrées.

iii. En ce qui concerne la consommation quotidienne de jus de fruits et

de lait en fonction de l’âge, conformez-vous aux directives que vous

trouvez dans « Mes Aliments ».";
                    break;
                case 3:
                    $info = "Quelquefois I : Après 12 à 15 mois votre enfant n’a pas besoin de biberon ou

de gobelet. Plus il va attendre pour passer au verre, à la tasse ou au bol, plus

cela va être difficile de s’y mettre.

i. Apprendre à boire par petites gorgées est indispensable pour combiner

la déglutition des solides et des liquides.

ii. Faites-lui boire dans une tasse adaptée à la taille de sa bouche du

lait, de l’eau ou du jus de fruits pur jus, en bannissant toutes les autres

boissons type aromatisées, sucrées.

iii. En ce qui concerne la consommation quotidienne de jus de fruits et

de lait en fonction de l’âge, conformez-vous aux directives que vous

trouvez dans « Mes Aliments ».";
                case 4:
                    $info="Rarement I : Après 12 à 15 mois votre enfant n’a pas besoin de biberon ou

de gobelet. Plus il va attendre pour passer au verre, à la tasse ou au bol, plus

cela va être difficile de s’y mettre.

i. Apprendre à boire par petites gorgées est indispensable pour combiner

la déglutition des solides et des liquides.

ii. Faites-lui boire dans une tasse adaptée à la taille de sa bouche du

lait, de l’eau ou du jus de fruits pur jus, en bannissant toutes les autres

boissons type aromatisées, sucrées.

iii. En ce qui concerne la consommation quotidienne de jus de fruits et

de lait en fonction de l’âge, conformez-vous aux directives que vous

trouvez dans « Mes Aliments ».";
                    break;
                case 5 :
                    $info = "Jamais I : Après 12 à 15 mois votre enfant n’a pas besoin de biberon ou de

gobelet. Plus il va attendre pour passer au verre, à la tasse ou au bol, plus

cela va être difficile de s’y mettre.

i. Apprendre à boire par petites gorgées est indispensable pour combiner

la déglutition des solides et des liquides.

ii. Faites-lui boire dans une tasse adaptée à la taille de sa bouche du

lait, de l’eau ou du jus de fruits pur jus, en bannissant toutes les autres

boissons type aromatisées, sucrées.

iii. En ce qui concerne la consommation quotidienne de jus de fruits et

de lait en fonction de l’âge, conformez-vous aux directives que vous

trouvez dans « Mes Aliments ».";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant boit au biberon</b><br>".$info);
            $i++;
         
            
            
            switch(explode("-",$_POST['q20'])[0]) {
                case 1;
                    $info = "Toujours I : C’est bien de planifier les repas et encas de telle sorte que votre

enfant arrive à table avec faim et prêt à manger. La sensation de faim doit

être exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le

reste de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez-

vous la question de savoir s’il n’a pas bu des boissons aromatisées

sucrées qui finissent par couper la faim. Surveillez ce que boit votre

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en

dehors.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si

tel n’est pas le cas sortez le de devant la télévision ou autre jeux

similaires.";
                    break;
                case 2:
                    $info = "La plus part du temps I : C’est bien de planifier les repas et encas de telle

sorte que votre enfant arrive à table avec faim et prêt à manger. La

sensation de faim doit être exprimée, c’est anisi qu’elle est ressentie et

devra être ressentie tout le reste de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez-

vous la question de savoir s’il n’a pas bu des boissons aromatisées

sucrées qui finissent par couper la faim. Surveillez ce que boit votre

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en

dehors.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si

tel n’est pas le cas sortez le de devant la télévision ou autre jeux

similaires et proposez lui des activités physiques..";
                    break;
                case 3:
                    $info = "Quelquefois I : Planifier les repas et encas de telle sorte que votre enfant

arrive à table avec faim et prêt à manger. La sensation de faim doit être

exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste

de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez-

vous la question de savoir s’il n’a pas bu des boissons aromatisées

sucrées qui finissent par couper la faim. Surveillez ce que boit votre

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en

dehors.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si

tel n’est pas le cas sortez le de devant la télévision ou autre jeux

similaires.";
                case 4:
                    $info="Rarement I : Planifier les repas et encas de telle sorte que votre enfant

arrive à table avec faim et prêt à manger. La sensation de faim doit être

exprimée, c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste

de la vie. C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez-

vous la question de savoir s’il n’a pas bu des boissons aromatisées

sucrées qui finissent par couper la faim. Surveillez ce que boit votre

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en

dehors.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si

tel n’est pas le cas sortez le de devant la télévision ou autre jeux

similaires.";
                case 5:
                    $info = "Jamais I : Planifier les repas et encas de telle sorte que votre enfant arrive

à table avec faim et prêt à manger. La sensation de faim doit être exprimée,

c’est ainsi qu’elle est ressentie et devra être ressentie tout le reste de la vie.

C’est un réflexe vital.

i. Si votre enfant arrive à table sans ressentir la sensation de faim, posez-

vous la question de savoir s’il n’a pas bu des boissons aromatisées

sucrées qui finissent par couper la faim. Surveillez ce que boit votre

enfant et s’il a soif donnez-lui de l’eau que ce soit au repas ou en

dehors.

ii. En plus votre enfant doit être physiquement actif entre les repas. Si

tel n’est pas le cas sortez le de devant la télévision ou autre jeux

similaires.";
                    break;
                default:
                    $info = "Un problème est survenu.";
            }
            
            $this->set("r".$i, "<b>Mon enfant à faim au moment des repas</b><br>".$info);
            $i++;
            
            
            
            
            
        }
    }
    
    
}