<?php

    require_once('src/repository/fournisseur.php');
    require_once('src/repository/fiche_besoin.php');
    require_once('src/repository/bon_commande.php');
    require_once('src/repository/item_bon_commande.php');
    require_once('src/repository/bon_livraison.php');
    require_once('src/repository/item_bon_livraison.php');

    class LivraisonController{

        private $dbconnect;

        private $FournisseurRepo;
        private $FicheBesoinRepo;
        private $BonCommandeRepo;
        private $BonLivraisonRepo;
        private $ItemBonLivraisonRepo;

        private $fournisseurs = [];
        private $fiches_besoins = [];
        private $commandes = [];
        private $livraisons = [];
        private $item_bon_livraisons = [];

        private $BL_FILE_NAME;

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FournisseurRepo = new FournisseurRepository($this->dbconnect);
            $this->FicheBesoinRepo = new FicheBesoinRepository($this->dbconnect);
            $this->BonCommandeRepo = new BonCommandeRepository($this->dbconnect);
            $this->BonLivraisonRepo = new BonLivraisonRepository($this->dbconnect);
            $this->ItemBonLivraisonRepo = new ItemBonLivraisonRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $fournisseurs = $this->fournisseurs;
            $fiches_besoins = $this->fiches_besoins;
            $commandes = $this->commandes;
            $livraisons = $this->livraisons;

            $draft = array_reduce($this->commandes,function($carry, $object){ return  ($object->statut == "DRAFT") ? $carry + $object->MontantTotal() : $carry + 0;},0);
            $transmit = array_reduce($this->commandes,function($carry, $object){ return  ($object->statut == "TRANSMIT") ? $carry + $object->MontantTotal() : $carry + 0;},0);
            $abort = array_reduce($this->commandes,function($carry, $object){ return  ($object->statut == "ABORT") ? $carry + $object->MontantTotal() : $carry + 0;},0);
            
            require("template/livraison.php");
        }

        function init()
        {
            $this->fournisseurs = $this->FournisseurRepo->getAll();
            $this->fiches_besoins = $this->FicheBesoinRepo->getAll();
            $this->commandes = $this->BonCommandeRepo->getAll();
            $this->livraisons = $this->BonLivraisonRepo->getAll();
            $this->item_bon_livraisons = $this->ItemBonLivraisonRepo->getAll(); //var_dump($this->item_bon_livraisons);

            array_map(function($object){$object->setITEMS($this->item_bon_livraisons);},$this->livraisons);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveLivraison':

                    $bl = new BonLivraison();
                    $bl->numero = $_REQUEST['numero'];//uniqid('bl_');

                    if ($this->SaveFile($bl->numero)) {

                        $bl->date_emmission = date("y-m-d");
                        $bl->date_livraison = $_REQUEST['date_livraison'];
                        $bl->emmetteur = $_SESSION['matricule'];
                        $bl->statut_commande = $_REQUEST['statut_commande'];
                        $bl->statut_execution = "DRAFT";
                        $bl->bon_commande = $_REQUEST['bon_commande'];
                        $bl->adresse_fichier = $this->BL_FILE_NAME;

                        $repo = new BonLivraisonRepository($this->dbconnect);
                        $repo->save($bl);

                        $this->saveItem($bl);

                    } else {
                        $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    }

                    break;

                case 'deleteLivraison':
            
                    $bl = new BonLivraison();
                    $bl->numero = $_REQUEST['numero'];

                    $repo = new BonLivraisonRepository($this->dbconnect);
                    $repo->delete($bl);
                    break;

                case 'updateLivraison':
                    $bl = new BonLivraison();
                    $bl->numero = $_REQUEST['numero'];

                    $repo = new BonLivraisonRepository($this->dbconnect);

                    if( !empty($_REQUEST['statut']) ){

                        switch ( $_REQUEST['statut'] ) {

                            case 'ABORT':
                                $bl->statut_execution = 'ABORT';
                                $repo->updateStatutExecution($bl);
                                break;
                            default:
                                break;
                        }
                    }

                    break;

                default:
                    # code...
                    break;
            }

        }

        function SaveFile($numero)
        {
            $uploaddir = $GLOBALS['BLFILESERVERPATH'];
            $this->BL_FILE_NAME = uniqid('bl_')."_". basename($_FILES['fichier']['name']);
            $uploadfile = $uploaddir . $this->BL_FILE_NAME;
            return move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile);
        }

        public function saveItem($bl)
        {
            if(!empty( $_REQUEST['items'] )){
                $Lignes = json_decode($_REQUEST['items']);

                foreach ($Lignes as $key => $value) 
                {
                    $item = new ItemBonLivraison();
                    $item->designation = $value->item;
                    $item->quantite = $value->quantite;
                    $item->bon_livraison = $bl->numero;

                    $repo = new ItemBonLivraisonRepository($this->dbconnect);
                    $repo->save($item);
                }
            }
        }

    }