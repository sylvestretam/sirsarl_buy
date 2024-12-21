<?php

    require_once('src/repository/facture.php');
    require_once('src/repository/item_facture.php');
    require_once('src/repository/bon_livraison.php');

    class FactureController{

        private $dbconnect;

        private $FournisseurRepo;
        private $FactureRepo;
        private $ItemFactureRepo;
        private $BonLivraisonRepo;
        private $BonCommandeRepo;

        private $fournisseurs = [];
        private $factures = [];
        private $item_factures = [];
        private $commandes = [];
        private $livraisons = [];

        private $FACT_FILE_NAME;

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FournisseurRepo = new FournisseurRepository($this->dbconnect);
            $this->FactureRepo = new FactureRepository($this->dbconnect);
            $this->ItemFactureRepo = new ItemFactureRepository($this->dbconnect);
            $this->BonLivraisonRepo = new BonLivraisonRepository($this->dbconnect);
            $this->BonCommandeRepo = new BonCommandeRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $livraisons = $this->livraisons;
            $factures = $this->factures;
            $commandes = $this->commandes;
            $fournisseurs = $this->fournisseurs;

            $draft = array_reduce($this->factures,function($carry, $object){ return  ($object->statut == "DRAFT") ? $carry + $object->total : $carry + 0;},0);
            $transmit = array_reduce($this->factures,function($carry, $object){ return  ($object->statut == "PAYER") ? $carry + $object->total : $carry + 0;},0);
            $abort = array_reduce($this->factures,function($carry, $object){ return  ($object->statut == "ABORT") ? $carry + $object->total : $carry + 0;},0);
            
            require("template/facture.php");
        }

        function init()
        {
            $this->livraisons = $this->BonLivraisonRepo->getAll();
            $this->commandes = $this->BonCommandeRepo->getAll();
            $this->factures = $this->FactureRepo->getAll();
            $this->item_factures = $this->ItemFactureRepo->getAll();
            $this->fournisseurs = $this->FournisseurRepo->getAll();

            array_map(function($object){$object->setITEMS($this->item_factures);},$this->factures);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveFacture':

                    $facture = new Facture();
                    $facture->numero = $_REQUEST['numero'];

                    if ($this->SaveFile($facture->numero)) {

                        $facture->date_facturation = $_REQUEST['date_facturation'];
                        $facture->adresse_fichier = $this->FACT_FILE_NAME;
                        $facture->libelle = $_REQUEST['libelle'];
                        $facture->debours = $_REQUEST['debours'];
                        $facture->commission = $_REQUEST['commission'];
                        $facture->total = $_REQUEST['total'];
                        $facture->fournisseur = $_REQUEST['fournisseur'];
                        $facture->statut = "DRAFT";

                        if( isset( $_REQUEST['bon_livraison']) )
                            $facture->bon_livraison = $_REQUEST['bon_livraison'];

                        if( isset( $_REQUEST['bon_commande']) )
                            $facture->bon_commande = $_REQUEST['bon_commande'];

                        $repo = new FactureRepository($this->dbconnect);
                        $repo->save($facture);

                        $this->saveItem($facture);

                    } else {
                        $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    }

                    break;

                case 'deleteFacture':
            
                    $facture = new Facture();
                    $facture->numero = $_REQUEST['numero'];

                    $repo = new FactureRepository($this->dbconnect);
                    $repo->delete($facture);
                    break;

                case 'updateCommande':
                    $bc = new BonCommande();
                    $bc->numero = $_REQUEST['numero'];

                    $repo = new BonCommandeRepository($this->dbconnect);

                    if( !empty($_REQUEST['statut']) ){

                        switch ( $_REQUEST['statut'] ) {

                            case 'TRANSMIT':
                                $bc->statut = 'TRANSMIT';
                                $bc->date_transmit = date("y-m-d");
                                $repo->updateStatutTransmit($bc);
                                break;
                            case 'ABORT':
                                $bc->statut = 'ABORT';
                                $bc->date_abort = date("y-m-d");
                                $repo->updateStatutAbort($bc);
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
            $uploaddir = $GLOBALS['FACTFILESERVERPATH'];
            $this->FACT_FILE_NAME = uniqid('fact_')."_". basename($_FILES['fichier']['name']);
            $uploadfile = $uploaddir . $this->FACT_FILE_NAME;
            return move_uploaded_file($_FILES['fichier']['tmp_name'], $uploadfile);
        }

        public function saveItem($facture)
        {
            if(!empty( $_REQUEST['items'] )){
                $Lignes = json_decode($_REQUEST['items']);

                foreach ($Lignes as $key => $value) 
                {
                    $item = new ItemFacture();
                    $item->designation = $value->item;
                    $item->quantite = $value->quantite;
                    $item->prix_unitaire = $value->pu;
                    $item->facture = $facture->numero;

                    $repo = new ItemFactureRepository($this->dbconnect);
                    $repo->save($item);
                }
            }
        }

    }