<?php

    // $SERVERPATH = "https://vps-1b00c55a.vps.ovh.net/";
    $SERVERPATH = "http://localhost/";
    $PORTAL_PATH = $SERVERPATH."sisas_portal";
    
    $FILESERVERPATH = "./Files/Besoin/";
    $BCFILESERVERPATH = "./Files/BonCommande/";
    $BLFILESERVERPATH = "./Files/BonLivraison/";
    $FACTFILESERVERPATH = "./Files/Facture/";
    $OFFREFINFILESERVERPATH = "./Files/OffreFinanciere/";
    $OFFRETECHFILESERVERPATH = "./Files/OffreTechnique/";
    
    $error = "";



    function showError($error)
    {
        if(empty($error))
            return "invisible";
    }

    function pourcentage($dividende,$diviseur)
    {
        if( $diviseur == 0 )
            return 0;
        else
            return $dividende / $diviseur * 100;
    }

    function diviseur($num)
    {
        if($num<1)
            return 1;
        return $num;
    }