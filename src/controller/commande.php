<?php

    require_once('src/repository/fournisseur.php');
    require_once('src/repository/fiche_besoin.php');
    require_once('src/repository/bon_commande.php');
    require_once('src/repository/item_bon_commande.php');
    
    require_once('src/doc/bon_commande.php');

    class CommandeController{

        private $dbconnect;

        private $FournisseurRepo;
        private $FicheBesoinRepo;
        private $BonCommandeRepo;
        private $ItemBonCommandeRepo;

        private $fournisseurs = [];
        private $fiches_besoins = [];
        private $commandes = [];
        private $today_commandes = [];
        private $item_bon_commandes = [];

        private $BC_FILE_NAME;

        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FournisseurRepo = new FournisseurRepository($this->dbconnect);
            $this->FicheBesoinRepo = new FicheBesoinRepository($this->dbconnect);
            $this->BonCommandeRepo = new BonCommandeRepository($this->dbconnect);
            $this->ItemBonCommandeRepo = new ItemBonCommandeRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $fournisseurs = $this->fournisseurs;
            $fiches_besoins = $this->fiches_besoins;
            $commandes = $this->commandes;
            $today_commandes = $this->today_commandes;

           if( !empty( $_REQUEST['subaction'] ) && $_REQUEST['subaction'] == "saveCommande" )
            {
                    $fichier = "Files/BonCommande/".$this->BC_FILE_NAME;
                    require("template/saved_commande.php");
            }
            else
                require("template/commande.php");
        }

        function init()
        {
            $this->fournisseurs = $this->FournisseurRepo->getAll();
            $this->fiches_besoins = $this->FicheBesoinRepo->getAll();
            $this->today_commandes = $this->BonCommandeRepo->getTODAYAll();
            $this->commandes = $this->BonCommandeRepo->getAll();
            $this->item_bon_commandes = $this->ItemBonCommandeRepo->getAll();

            array_map(function($object){$object->setITEMS($this->item_bon_commandes);},$this->commandes);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveCommande':
                    
                    $this->BC_FILE_NAME = uniqid("bc_").'.pdf';

                    $bc = new BonCommande();
                    $bc->numero = $_REQUEST['numero'];//uniqid('bc_');

                    // if ($this->SaveFile( $bc->numero )) {
                    // } else {
                    //     $GLOBALS['error'] =  "Un problème est survenue lors du tranfert de fichier !!!";
                    // }

                    $bc->date_emmission = $_REQUEST['date_emmission'];
                    $bc->emmetteur = $_SESSION['matricule'];
                    $bc->statut = "DRAFT";
                    $bc->fournisseur = $_REQUEST['fournisseur'];
                    $bc->besoin = $_REQUEST['besoin'];
                    $bc->debours = $_REQUEST['debours'];
                    $bc->commission = $_REQUEST['commission'];

                    $bc->adresse_fichier = $this->BC_FILE_NAME;

                    $repo = new BonCommandeRepository($this->dbconnect);
                    $repo->save($bc);

                    $this->saveItem($bc);

                    $this->SaveFile( $bc->numero );

                    break;

                case 'deleteCommande':
            
                    $bc = new BonCommande();
                    $bc->numero = $_REQUEST['numero'];

                    $repo = new BonCommandeRepository($this->dbconnect);
                    $bc = $repo->delete($bc);
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

            $pdf = new BonCommandePDF('P', 'mm', 'A4', true, 'UTF-8', false);

            $pdf->numero = $numero;

            $fournisseur = $this->FournisseurRepo->getFournisseur( $_REQUEST['fournisseur'] );
            $pdf->fournisseur = $fournisseur->denomination;
            $pdf->ville = $fournisseur->adresse;
            $pdf->rccm = $fournisseur->rccm;
            $pdf->niu = $fournisseur->niu;

            $pdf->date_emmission = $_REQUEST['date_emmission'];
            
            $pdf->commission = $_REQUEST['commission'];
            $pdf->debours = $this->TotalItem();
            $pdf->total = $pdf->debours + $pdf->commission;
            $pdf->items = json_decode($_REQUEST['items']);

            $pdf->setMargins('10', '29', '15');
            $pdf->setHeaderMargin('5');
            $pdf->setFooterMargin('10');

            $pdf->AddPage();
            $pdf->MonContenu();
            
            $pdf->Output(__DIR__."/../../Files/BonCommande/".$this->BC_FILE_NAME, 'F');

            return true;
        }

        public function saveItem($bc)
        {
            if(!empty( $_REQUEST['items'] )){
                $Lignes = json_decode($_REQUEST['items']);

                foreach ($Lignes as $key => $value) 
                {
                    $item = new ItemBonCommande();
                    $item->designation = $key;
                    $item->quantite = $value->quantite;
                    $item->prix_unitaire = $value->pu;
                    $item->bon_commande = $bc->numero;

                    $repo = new ItemBonCommandeRepository($this->dbconnect);
                    $repo->save($item);
                }
            }
        }

        public function TotalItem()
        {
            if(!empty( $_REQUEST['items'] )){
                $Lignes = json_decode($_REQUEST['items']);
                $total = 0;
                foreach ($Lignes as $key => $value) 
                {
                    $total = $total + ($value->quantite * $value->pu);
                }

                return $total;
            }

            return 0;
        }

    }