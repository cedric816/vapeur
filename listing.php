<?php
//le formulaire est validé, on va chercher tous les aliments dans la liste_aliments 
//qui contiennent le mot ou morceau de mot tapé dans la recherche
    if (isset($_POST['aliment']) and !($_POST['aliment'])==''){
        //encode pour éviter failles XSS
        $nom_aliment = htmlspecialchars($_POST['aliment'], ENT_QUOTES);
        //a chaque fois qu'on trouve un nom d'aliment ou portion de nom d'aliment
        //qui match avec la demande, on le stocke dans un tableau liste_matchee
        $liste_matchee = [];
        for ($n=0; $n<count($liste_aliments); $n++){
            $test = stripos($liste_aliments[$n], $nom_aliment); 
            if ($test===false){
                $liste_matchee = $liste_matchee;
            } else{
                array_push($liste_matchee, $liste_aliments[$n]);
                }
        }
        $longueur_liste_matchee = count($liste_matchee);
        //quelques conditions pour limiter le nb de resultat et orienter l'utilisateur
        if ($longueur_liste_matchee>8){
            $nom_aliment='Trop de résultats- Veuillez affiner votre recherche';
        } elseif ($longueur_liste_matchee==0){
            $nom_aliment='aucun résultat pour cette recherche';
        }else {
            //on affiche tous les aliments qui ont matchés
            for ($n=0; $n<count($liste_matchee); $n++){
                echo("<form method='POST' action='index.php'>");
                echo ("<input type='hidden' name='aliment_precis' value='".urlencode($liste_matchee[$n])."'>");
                echo ("<input type='submit' value='".htmlentities($liste_matchee[$n], ENT_QUOTES)."'>");
                echo("</form>");
            }
            $nom_aliment='';
            $duree_cuisson='';  
            }
    }
?>