<?php
// titre de la page
$this->assign('title', 'Ma Pyramide Santé - Fruits');
// balise meta pour le référencement
$this->start('meta');
echo $this->Html->meta('keywords', 'Un gestionnaire complet de votre santé grâce au suivi de votre activité physique et vos aliments consommés notamment.');
$this->end();
?>﻿
<nav class="breadcrumbs" role="menubar" aria-label="breadcrumbs">
    <li role="menuitem"><?php echo $this->Html->link('Accueil', ['full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('La diététique', ['action' => 'dietetique', 'full_base' => true]); ?></li>
    <li role="menuitem"><?php echo $this->Html->link('Les groupes alimentaires', ['action' => 'groupesalimentaires', 'full_base' => true]); ?></li>
    <li role="menuitem" class="current"><?php echo $this->Html->link('Les fruits', 'Javascript:void(0);'); ?></li>
</nav>
<div id="presentation">
    <div class="row">
        <div class="small-12 small-centered columns">
            <div class="title-area"> Les fruits </div> 
        </div>
    </div> 

    <div class="row">
        <div class="small-12 colomns">
            <h3>Voir aussi</h3>
            <ul class="button-group even-3">
                <?php
                foreach ($fruit as $unFruit) {
                    echo '<li >' . $this->Html->link($unFruit['titreonglet'], '/statiques/pages/'
                            . $unFruit['id'], array('escape' => false, 'class' => 'button')) . '</li>';
                }
                ?>      
            </ul>
        </div>
    </div>  
    <div class="row">
        <div class="small-12 colomns">
            <h3>Quels aliments intègrent le Groupe des fruits ?</h3>
            <p class="text-justify">
                N’importe quel fruit ou quel jus de fruits (pur jus) fait partie 
                du Groupe des fruits. Ces dernier peuvent être frais, en boite, 
                congelés ou secs, entiers, coupés en dés, mixés ou en compote (sans sucre ajouté).
                </br></br>
                Message-clé : Les fruits et les légumes devraient occuper une grande place dans votre repas.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h3> Quantité quotidienne conseillée </h3>
            <p class="text-justify">
                Cette quantité quotidienne dépend de l’âge, du sexe et de l’activité physique.
                Les quantités quotidiennes recommandées sont résumées dans le tableau suivant. 
                Nous verrons, par la suite, qu’il est possible d’intégrer ces recommandations avec celles des légumes.
            </p>

            <table>
                <thead>
                    <tr>
                        <th colspan=3 class="text-center">Fruits : Recommandations quotidiennes***</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td> Enfants </td> 
                        <td> 2 – 3 ans</br> 4 - 5 ans </td> 
                        <td> 2 portions standard (PSF*) : 2 × ½ Tasse = 1 Tasse (T**)</br> 2 à 3 portions standard (PSF*) : 2 à 3 × ½ Tasse = 1 à 1 ½   Tasse (T**) </td>
                    </tr>
                    <tr>
                        <td> Filles </td> 
                        <td> 9 – 18 ans </td> 
                        <td> 3 portions standard (PSF*) : 3  × ½ Tasse = 1 ½ Tasse (T**)</td>
                    </tr>
                    <tr>
                        <td> Garçons </td> 
                        <td> 9 – 13 ans</br> 14- 18 ans </td> 
                        <td> 3 portions standard (PSF*) : 3  × ½ Tasse = 1 ½ Tasse (T**)</br> 4 portions standard (PSF*) : 4 × ½ Tasse = 2   Tasse (T**) </td>
                    </tr>
                    <tr>
                        <td> Femmes </td> 
                        <td> 19 – 30 ans</br> 31 ans et + </td> 
                        <td> 4 portions standard (PSF*) : 4  × ½ Tasse =  2 Tasse (T**)</br> 3 portions standard (PSF*) : 3  × ½ Tasse = 1 ½ Tasse (T**) </td>
                    </tr>
                    <tr>
                        <td> Hommes </td> 
                        <td> 19 ans et + </td> 
                        <td> 4 portions standard (PSF*) : 4  × ½ Tasse =  2 Tasse (T**) </td>
                    </tr>
                    <tr>
                        <td colspan=3 class="text-justify"> 
                            *Une portion standard de fruits (PSF) correspond à une ½ Tasse métrique 
                            ( ½ T =125 ml) ou à son équivalent.</br></br>
                            ** Une tasse métrique (T) correspond à un volume de 250 ml.</br></br> 
                            ***Ces recommandations correspondent à des personnes qui présentent 
                            une activité physique faible (Moins de 30 minutes par jour).
                            Ceux qui sont physiquement plus actifs peuvent en consommer davantage
                            tout en restant dans les limites de leurs besoins caloriques 
                        </td>  
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h3> A quoi correspond une portion standard de fruits ? </h3>
            <p class="text-justify">
                En général, ½ Tasse (125 ml) de fruits ou de jus de fruits (100 % pur jus) 
                ou ¼ Tasse (62 ml) de fruits secs correspondent à une portion standard de fruit (1 PSF).
                Les différentes quantités de fruits du tableau suivant correspondent à une PSF.</br></br>
                Pour faire simple, il suffit de manger un fruit moyen ou une demi tasse de fruits frais, 
                congelés ou en conserve pour consommer une portion standard de fruits (PSF). 
                La liste ci-dessous, non exhaustive, vous donne quelques exemples de fruits et les 
                portions standard correspondantes.</br></br>
                Savez-vous que le jus de fruits (pur jus) ne contient pas de sucres ajoutés ?
                Les appellations « boissons », « cocktail » ou « punch »… signifient que du sucre 
                ou des édulcorants ont été ajoutés (Attention aux calories vides).
            </p>
            <div class="scrollingtable">
                <div>
                    <div>
                        <table>
                            <caption>A quoi correspond une portion standard de fruits (PSF*)</caption>
                            <thead>  
                                <tr>
                                    <th class="text-center"><div label="Fruit"></div></th>
                            <th class="text-center"><div label="PSF"></div></th>
                            <th class="scrollbarhead"/>
                            </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td> Abricot frais* </td> 
                                    <td> 3 fruits </td> 
                                </tr>
                                <tr>
                                    <td> Jus de fruits </td> 
                                    <td> 125 ml (1/2 T) </td> 
                                </tr>
                                <tr>
                                    <td> Papaye* </td>
                                    <td> ½ fruit </td>
                                </tr>
                                <tr>
                                    <td> Ananas (1 tranche) </td>
                                    <td> 125 ml (1/2 T) </td>
                                </tr>
                                <tr> 
                                    <td> Kiwi </td> 
                                    <td> 1 gros fruit </td> 
                                </tr>
                                <tr>    
                                    <td> Pastèque </td> 
                                    <td> 125 ml (1/2 T) </td>
                                </tr>
                                <tr>
                                    <td> Avocat  </td> 
                                    <td> ½ fruit </td> 
                                </tr>
                                <tr>    
                                    <td> Litchis </td> 
                                    <td> 10 fruits </td> 
                                </tr>
                                <tr>    
                                    <td> Pêche* </td> 
                                    <td> 1 moyenne </td>
                                </tr>
                                <tr>
                                    <td> Banane  </td> 
                                    <td> 1 moyenne </td> 
                                </tr>
                                <tr>    
                                    <td> Mangue* </td> 
                                    <td> 125 ml (1/2 T),</br>½ fruit </td> 
                                </tr>
                                <tr>    
                                    <td> Petits fruits</br>(baies) </td>
                                    <td> 125 ml (1/2 T) </td>
                                </tr>
                                <tr>
                                    <td> Banane plantain </td> 
                                    <td> 125 ml (1/2 T) </td> 
                                </tr>
                                <tr>    
                                    <td> Margose</br>(poire de</br>merveille) </td> 
                                    <td> 125 ml (1/2 T)</br>½ fruit </td> 
                                </tr>
                                <tr>    
                                    <td> Poire </td> 
                                    <td> 1 moyenne </td>
                                </tr>
                                <tr>
                                    <td> Cerises </td> 
                                    <td> 20 fruits </td> 
                                </tr>
                                <tr>    
                                    <td> Melon*</br>(Cavaillon) </td> 
                                    <td> 125 ml (1/2 T) </td>
                                </tr>
                                <tr>    
                                    <td> Pomme </td> 
                                    <td> 1 moyenne </td>
                                </tr>
                                <tr>
                                    <td> Chayotte </td> 
                                    <td> 125 ml (1/2 T) </td> 
                                </tr>
                                <tr>    
                                    <td> Melon miel </td> 
                                    <td> 125 ml (1/2 T) </td> 
                                </tr>
                                <tr>    
                                    <td> Prune </td> 
                                    <td> 1 fruit </td>
                                </tr>
                                <tr>
                                    <td> Figues fraiches </td> 
                                    <td> 2 moyennes </td> 
                                </tr>
                                <tr>    
                                    <td> Nectarine* </td> 
                                    <td> 1 fruit </td> 
                                </tr>
                                <tr>    
                                    <td> Raisins </td> 
                                    <td> 20 fruits </td>
                                </tr>
                                <tr>
                                    <td> Fruits séchés </td> 
                                    <td> 60 ml (1/4T) </td> 
                                </tr>
                                <tr>
                                    <td> Orange </td> 
                                    <td> 1 moyenne </td>
                                </tr>
                                <tr>
                                    <td> Goyave </td> 
                                    <td> 125 ml (1/2 T)</br>1 fruit </td> 
                                </tr>
                                <tr>
                                    <td> Pamplemousse </td> 
                                    <td> ½ fruit </td>
                                </tr>
                                <tr>
                                    <td colspan=3 class="text-justify"> 
                                        Certains fruits de couleur orangée peuvent remplacer un légume orangé.
                                        Voir les fruits accompagnés d’un astérisque (*)
                                        tout en restant dans les limites de leurs besoins caloriques
                                    </td>  
                                <tr>
                                    <td colspan=3 class="text-justify">
                                        (PSL*) La portion standard, n’est pas une norme mais une portion de référence, 
                                        de comparaison qui est destinée à vous guider dans le choix des quantités.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h3>Leurs nutriments et leurs bienfaits sur la santé </h3>
            <p class="text-justify">
                La plupart des fruits sont pauvres en sel, matières grasses et calories : 
                pas un ne contient du cholestérol.
                Les fruits sont des sources de nutriments essentiels : potassium, fibres alimentaires,
                vitamine C et folates (acide folique).</br>
                Le potassium se trouve majoritairement concentré dans nos cellules, il y régule les 
                activités cellulaires. Il permet ainsi de maintenir notre tension artérielle dans les 
                limites de la normale.</br> Les fruits, sources de potassium, sont les bananes, les prunes 
                et les jus de prunes, les abricots secs, les abricots, les melons (cantaloupe), les melons 
                miels et le jus d’orange.</br> Les fibres alimentaires des fruits, intégrées dans une 
                alimentation saine, réduisent les taux de cholestérol sanguin et par voie de conséquence 
                diminuent le risque de maladies cardiaques. </br> Elles jouent un rôle bienfaiteur dans le 
                transit intestinal : amélioration du transit, réduction de la constipation et par voie de 
                conséquence la diverticulose intestinale beaucoup plus fréquente qu’on ne le pense.</br>
                Les aliments contenant des fibres alimentaires tels diverticulose intestinale les fruits
                permettent d’éprouver cette sensation de réplétion à la fin du repas sans pour autant 
                exploser votre quota de calories. Les fruits entiers ou coupés sont des sources de fibres 
                alimentaires, les jus de fruits contiennent peu ou pas de fibres.</br>La vitamine C est 
                indispensable pour la croissance et la réparation de tous les tissus de l’organisme. 
                Notre organisme est un chantier permanent : détruisant des cellules les remplaçant par des 
                nouvelles et c’est là qu’intervient la vitamine C. C’est la vitamine C qui aide à cicatriser
                nos bobos. Elle nous aide à maintenir des dents et des gencives saines. </br> Que vous 
                arriverait-il si vous deveniez carencé en vitamine C : prenez votre smartphone et tapez
                « scorbut », vous m’en donnerez des nouvelles.</br>Les folates (acide folique)
                (on souligne trois fois) sont indispensables à la multiplication  de toutes les cellules
                et participent activement au renouvellement de nos cellules. Il manque des folates et ce
                sont les cellules sanguines à renouvellement rapide qui en souffrent les premières
                (Anémie mégaloblastique). </br>Tout le monde a besoin de sa quantité de folates et une 
                consommation raisonnable, à tout âge, de fruits est capable d’apporter la quantité de 
                folates nécessaires. Vous comprendrez pourquoi les femmes en âge de procréer ont besoin
                d’un petits plus de fruits parce que leur organisme non seulement abrite mais alimente
                aussi un autre petit organisme véritable chantier de multiplication cellulaire. </br> 
                Un déficit d’apport de folates au fœtus et c’est un risque accru de malformations du tube neural
                (qui doit donner le cerveau et la moelle épinière) : spina bifida ou plus grave l’anencéphalie
                (absence de cerveau).
            </p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h3>Equivalence pour une coupe de fruits </h3>
            <p class="text-justify">
                En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers.
            </p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 colomns">
            <h3> Conseils de consommation </h3>
            <p class="text-justify">
                En plus de vous sentir mieux dans votre corps et d’avoir une silhouette plus svelte, le maintien d’un
                poids corporel de santé est indispensable pour votre propre état de santé et de votre bien-être.
                Si, vous êtes en surpoids, ou obèse, vous présentez un risque plus élevé de développer plusieurs
                maladies parmi lesquelles : l’hypertension, le diabète de type 2, des maladies cardio-vasculaires et
                certains types de cancers.
            </p>
        </div>
    </div>

    <div class="row" data-equalizer id="imgGrAliments">
        <!-- En cliquant sur ce lien, vous êtes redirigé vers la page contenant la description des fruits ainsi qu'une liste non exhaustive de ces derniers -->
        <div class="large-6 small-12 columns">
            <div class="callout" data-equalizer-watch>
                <fieldset>
                    <legend>Fruits</legend>
                    <div class="fieldsetscrollbar">
                        <ul>
                            <?php
                            foreach ($donnees['Fruits']['Fruits'] as $groupeFruit) {
                                foreach ($groupeFruit['Aliment'] as $fruit) {
                                    $fichier = strtok($fruit['chemin'], ',');
                                    if ($fichier == '') {
                                        $fichier = 'noimage.jpg';
                                    }
                                    echo "<li>";
                                    echo $this->Html->link($fruit['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $fruit['nomFR'], 'escape' => true));
                                    echo "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </fieldset>

            </div>
        </div>
        <div class="large-6 small-12 columns">
            <div class="callout" data-equalizer-watch>
                <fieldset>
                    <legend>Jus de fruits</legend>
                    <div class="fieldsetscrollbar">
                        <ul>
                            <!-- Liste des légumes : affichage des images des différents légumes à l'aide de zoombox -->
                            <?php
                            foreach ($donnees['Fruits']['Jus de fruits'] as $groupeFruit) {
                                foreach ($groupeFruit['Aliment'] as $fruit) {
                                    $fichier = strtok($fruit['chemin'], ',');
                                    if ($fichier == '') {
                                        $fichier = 'noimage.jpg';
                                    }
                                    echo "<li>";
                                    echo $this->Html->link($fruit['nomFR'], '../img/imagesAliment/' . $fichier, array('class' => 'zoombox', 'alt' => $fruit['nomFR'], 'escape' => true));
                                    echo "</li>";
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </fieldset>

            </div>
        </div>
    </div>
</div>



