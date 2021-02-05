<?php
//a l'arrivée sur la page on va chercher l'intégralité des aliments de l'API
//et on stockera le resultat dans la variable liste_aliments
    $liste_aliments =[];
    //a l'arrivée sur la page, aucun résultat n'est affiché
    $nom_aliment='';
    $duree_cuisson='';
    $url = "https://api.hmz.tf/?id=all";
        
    $curl = curl_init();

    //on définit plusieurs options en une seule fois à la différence de curl_setopt()
    curl_setopt_array($curl, array(
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true, //le résultat sera sauvegardé dans la variable $response ci-dessous
    CURLOPT_TIMEOUT => 10, //nb de secondes à attendre avant abandon
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
        ),
    ));
          
    $response = curl_exec($curl);
    $response = json_decode($response, true); //true en second argument indique qu'on veut un tableau associatif
    //on recupere uniquement le nom de l'aliment 
    foreach ($response['message'] as $key=>$value){
        $new_aliment = $key;
        array_push($liste_aliments, $new_aliment);
    }
    curl_close($curl);

    //lorsqu'un nom précis est choisi par l'utilisateur
    if (isset($_POST['aliment_precis'])){
        //on encode pour éviter les failles XSS
        $aliment_precis = htmlspecialchars($_POST['aliment_precis'], ENT_QUOTES);
        //le string est scindé à chaque espace puis converti en tableau
        $aliment = explode(' ', $aliment_precis);
        //construction de l'id qui servira pour la requete à l'API
        $id='';
        for ($n=0; $n<count($aliment); $n++){
            $id = $id."+".$aliment[$n];
        }
        $id = substr($id,1);
        $url_precis = "https://api.hmz.tf/?id=".$id;
        $curl_precis = curl_init();

        //on définit plusieurs options en une seule fois à la différence de curl_setopt()
        curl_setopt_array($curl_precis, array(
        CURLOPT_URL => $url_precis,
        CURLOPT_RETURNTRANSFER => true, //le résultat sera sauvegardé dans la variable $response ci-dessous
        CURLOPT_TIMEOUT => 3, //nb de secondes à attendre avant abandon
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache"
            ),
        ));
          
        $response = curl_exec($curl_precis);
        $response = json_decode($response, true);

        //on affecte les bonnes valeurs à afficher dans le html
        $nom_aliment = $response['message']['nom'];
        $duree_cuisson = "Temps de cuisson: ".$response['message']['vapeur']['cuisson'];

        curl_close($curl_precis);
    } else {
        $nom_aliment='';
        $duree_cuisson='';
        }

        
        
?>