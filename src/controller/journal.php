<?php

    require_once('src/repository/facture.php');
    require_once('src/repository/item_facture.php');
    require_once('src/repository/journal_achat.php');
    require_once('src/repository/item_journal.php');
    require_once('src/repository/compte.php');
    require_once('src/repository/fournisseur.php');

    class JournalController{

        private $dbconnect;

        private $FactureRepo;
        private $ItemFactureRepo;
        private $JournalRepo;
        private $ItemJournalRepo;
        private $CompteRepo;
        private $FournisseurRepo;

        private $factures = [];
        private $item_factures = [];
        private $comptes = [];
        private $logs = [];
        private $items_journals = [];
        private $fournisseurs = [];


        public function __construct()
        {
            $this->dbconnect = new DbConnect();

            $this->FactureRepo = new FactureRepository($this->dbconnect);
            $this->ItemFactureRepo = new ItemFactureRepository($this->dbconnect);
            $this->JournalRepo = new JournalAchatRepository($this->dbconnect);
            $this->ItemJournalRepo = new ItemJournalRepository($this->dbconnect);
            $this->CompteRepo = new CompteRepository($this->dbconnect);
            $this->FournisseurRepo = new FournisseurRepository($this->dbconnect);

            if( !empty( $_REQUEST['subaction'] ) )
                $this->subactions( $_REQUEST['subaction'] );

            $this->init();
        }

        public function show()
        {
            $factures = $this->factures;
            $logs = $this->logs;
            $comptes = $this->comptes;
            $fournisseurs = $this->fournisseurs;

            require("template/journal.php");
        }

        function init()
        {
            $this->factures = $this->FactureRepo->getALLNOTINJOURNAL();
            $this->item_factures = $this->ItemFactureRepo->getAll();
            $this->comptes = $this->CompteRepo->getAll();
            $this->fournisseurs = $this->FournisseurRepo->getAll();
            $this->logs = $this->JournalRepo->getAll();
            $this->items_journals = $this->ItemJournalRepo->getAll();

            array_map(function($object){$object->setITEMS($this->items_journals);},$this->logs);
            array_map(function($object){$object->setITEMS($this->item_factures);},$this->factures);
        }

        function subactions($subaction)
        {

            switch ($subaction) {
                case 'saveJournal':

                    $journal = new JournalAchat();
                    $journal->date_facturation = $_REQUEST['date_facturation'];
                    $journal->motif = $_REQUEST['motif'];
                    $journal->libelle = $_REQUEST['libelle'];
                    $journal->facture = $_REQUEST['facture'];
                    $journal->montant_total = $_REQUEST['montant_total'];
                    $journal->fournisseur = $_REQUEST['fournisseur'];

                    $logs_day =  $this->JournalRepo->getDAYAll($journal);
                    $journal->numero_pja = "PJA/SIRSARL/".str_replace("-","/",$journal->date_facturation)."/0".sizeof($logs_day)+1;
                    $this->JournalRepo->save($journal);

                    $this->saveItem($journal);

                    break;

                case 'deleteJournal':
            
                    $journal = new JournalAchat();
                    $journal->numero_pja = $_REQUEST['numero_pja'];

                    $repo = new JournalAchatRepository($this->dbconnect);
                    $repo->deleteAllItem($journal);
                    $repo->delete($journal);
                    break;

                default:
                    # code...
                    break;
            }

        }

        public function saveItem($journal)
        {
            if(!empty( $_REQUEST['items'] )){
                $Lignes = json_decode($_REQUEST['items']);

                foreach ($Lignes as $key => $value) 
                {
                    $item = new ItemJournal();
                    $item->compte = $key;
                    $item->type_operation = $value->type_operation;
                    $item->montant = $value->montant;
                    $item->numero_pja = $journal->numero_pja;

                    $repo = new ItemJournalRepository($this->dbconnect);
                    $repo->save($item);
                }
            }
        }

    }