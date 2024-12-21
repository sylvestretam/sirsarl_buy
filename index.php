<?php
    session_start();
    
    require_once('src/lib/outils.php');
    require_once('src/lib/database.php');

    require_once('src/controller/dashboard.php');
    require_once('src/controller/besoin.php');
    require_once('src/controller/reponse.php');
    require_once('src/controller/commande.php');
    require_once('src/controller/livraison.php');
    require_once('src/controller/facture.php');
    require_once('src/controller/journal.php');

    if(isset($_SESSION['BUY']))
    {

        if(isset($_REQUEST['action'])){

            switch ($_REQUEST['action']) {

                case 'dashboard':
                    $controller = new DashboardController();
                    $controller->show();
                    break;
                case 'besoin':
                    $controller = new BesoinController();
                    $controller->show();
                    break;
                case 'reponse':
                    $controller = new ReponseController();
                    $controller->show();
                    break;
                case 'commande':
                    $controller = new CommandeController();
                    $controller->show();
                    break;
                case 'livraison':
                    $controller = new LivraisonController();
                    $controller->show();
                    break;
                case 'facture':
                    $controller = new FactureController();
                    $controller->show();
                    break;
                case 'journal':
                    $controller = new JournalController();
                    $controller->show();
                    break;
                case 'logout':
                    header('location:'.$SERVERPATH.'sisas_portal');
                    break;
                default:
                    $controller = new DashboardController();
                    $controller->show();
                    break;
            }
            
        }
        else
        {
            if(isset($_SESSION['matricule']))
            {
                $controller = new DashboardController();
                $controller->show();
            }
            else
            {
                header('location:'.$SERVERPATH.'sisas_portal');
            }
        }
    }
    else
    {
        $ERROR = "Vous ne pouvez acceder a cette application";
        require('template/error.php');
    }